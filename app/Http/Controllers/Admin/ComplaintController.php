<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Ladumor\OneSignal\OneSignal;
use DataTables;

class ComplaintController extends Controller
{
    function index() {
        $complaints = Complaint::orderBy('id')->with('user')->get();
        // dd($complaints);
        return view('admin.modules.complaints.list', compact('complaints'));
    }

    function get_complaints(Request $request){

        if ($request->ajax()) {
            $data = Complaint::select('id','user_id', 'status', 'issue_type', 'created_at')
            ->with('user')
            ->orderBy('id', 'desc')
            ->get();
           // dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function(Complaint $complaint){
                $select = '<select class="form-control form-control-sm complaint_status" rel="'.$complaint->id.'"><option '. ($complaint->status == "Pending" ? 'selected' : '' ) .'>Pending</option><option '. ($complaint->status == "Processing" ? 'selected' : '' ) .'>Processing</option><option '. ($complaint->status == "Completed" ? 'selected' : '' ) .'>Completed</option><option '. ($complaint->status == "Cancelled" ? 'selected' : '' ) .'>Cancelled</option></select>';
                    return $select;
                })
                ->addColumn('user', function(Complaint $complaint){
                    return $complaint->user->name;
                })
                ->addColumn('user_email', function(Complaint $complaint){
                    return $complaint->user->email;
                })
                ->editColumn('created_at', function(Complaint $complaint){
                    return $complaint->created_at->format('Y-m-d H:i:s');
                })
                ->rawColumns(['status', 'created_at'])
                ->make(true);
        }

    }


    function change_status(Request $request){

        if ($request->ajax()) {
            $allowedStatus = ['processing', 'cancelled', 'pending'];

            if(!in_array(strtolower($request->status),$allowedStatus))
            {
               return response()->json(['status' => false, 'message'=> 'This action can be done by Driver!'], 200);
            }

            $Complaint = Complaint::find($request->id);
            if($request->status == 'Pending' && $Complaint->status == 'Processing' || $Complaint->status == 'Cancelled'){
                return response()->json(['status' => false, 'message'=> 'This status cannot be undone!'], 200);
            }
            $Complaint->status = $request->status;


            if($request->status == 'Cancelled'){
                $Complaint->cancelled_reason = $request->cancel_reason;
                $Complaint->cancelled_by = auth()->user()->roles->pluck('name')[0];
            }
            $Complaint->save();
            $tokenArray = array();
            $device_tokens = CustomerToken::where('user_id', $Complaint->user_id)->get('token')->toArray();
            if($device_tokens){
                foreach($device_tokens as $token)
                {
                    $tokenArray[] = $token['token'];
                }
                $fields['include_player_ids'] = $tokenArray;
                $notificationMsg = $this->notifyMessage($Complaint->status, $Complaint);
                try{
                    OneSignal::sendPush($fields, $notificationMsg);
                    //Save Notification log
                    $notification = array();
                    $notification['user_id'] = $Complaint->user_id;
                    $notification['message'] = $notificationMsg;
                    Notification::create($notification);
                }catch(Exception $e){
                    dd($e->getMessage());
                }

            }
            return response()->json(['status' => true, 'message'=> 'Status has been changed and notified to Customer!'], 200);
        }

    }

    function notifyMessage($status, $Complaint){

        $message = '';
        if($status == 'Processing')
        {
            $message = __('Your Complaint with Tracking# '.$Complaint->id.' has been accepted. You will be notified on Complaint dispatch!');
        }
        elseif($status == 'Cancelled'){
            $message = __('Your Complaint with Tracking# '.$Complaint->id.' has been cancelled. For reason check Complaint detaIls!');
        }

        return $message;
    }
}
