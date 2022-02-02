<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\SaveFood;
use Validator;

/**
 * @group Complaints Endpoints
 *
 * API endpoints for managing complaints
 */

class ComplaintController extends Controller
{
    function store_complaint(Request $request){
        $messages = array(
            'issue_type.required' => __('Issue Type field is required.'),
            'address.required' => __('Address field is required.'),
            'lat.required' => __('Lat field field is required.'),
            'lng.required' => __('Lng field field is required.'),
            'city.required' => __('City field is required.'),
            'zip_code.required' => __('Zip Code field is required.'),
            'message.required' => __('Message field is required.')
        );
        $validator = Validator::make($request->all(), [
            'issue_type' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'message' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }

        $data = [
            'user_id' => $request->user()->id,
            'issue_type' => $request->issue_type,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'message' => $request->message
        ];
        if($request->hasFile('image')){

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/images/complaints/'), $imageName);
            $data['image'] = $imageName;
        }
        Complaint::create($data);
        return response()->json(['status' => true, 'message' => "Complaint has been submitted. Check history for updates!"]);

    }

    function save_food(Request $request){
        $messages = array(
            'no_of_peoples.required' => __('No of Peoples field is required.'),
            'address.required' => __('Address field is required.'),
            'lat.required' => __('Lat field field is required.'),
            'lng.required' => __('Lng field field is required.'),
            'city.required' => __('City field is required.'),
            'zip_code.required' => __('Zip Code field is required.'),
            'message.required' => __('Message field is required.')
        );
        $validator = Validator::make($request->all(), [
            'no_of_peoples' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'message' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }

        $data = [
            'user_id' => $request->user()->id,
            'no_of_peoples' => $request->no_of_peoples,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'message' => $request->message
        ];
        if($request->hasFile('image')){

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/images/save_food/'), $imageName);
            $data['image'] = $imageName;
        }
        SaveFood::create($data);

        return response()->json(['status' => true, 'message' => "Request has been submitted. Check history for updates!"]);
    }
}
