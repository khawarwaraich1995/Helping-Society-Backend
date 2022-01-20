<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Models\SMTPSetting;
use App\Models\SmsSetting;
use App\Models\NotificationSetting;

class SettingsController extends Controller
{
    private $settingID = 1;

    function business_index()
    {
        $b_settings = BusinessSetting::where('id', $this->settingID)->first();
        return view('admin.modules.settings.business', compact('b_settings'));
    }

    function smtp_index()
    {
        $settings = SMTPSetting::where('id', $this->settingID)->first();
        return view('admin.modules.settings.smtp', compact('settings'));
    }

    function sms_index()
    {

        $settings = SmsSetting::where('id', $this->settingID)->first();
        return view('admin.modules.settings.sms', compact('settings'));
    }

    function notifications_index()
    {

        $settings = NotificationSetting::where('id', $this->settingID)->first();
        return view('admin.modules.settings.notifications', compact('settings'));
    }

    function update_business_settings(Request $request)
    {

        $request->validate([
            'name' => 'nullable|max:50|min:3',
            'email' => 'nullable|email',
            'distance_unit' => 'nullable|max:10',
        ]);


        BusinessSetting::updateOrCreate(['id' => $this->settingID], $request->except('_token'));
        notify()->success('Settings updated successfully!');
        return redirect()->back();
    }

    function update_smtp_settings(Request $request)
    {


        SMTPSetting::updateOrCreate(['id' => $this->settingID], $request->except('_token'));
        notify()->success('Settings updated successfully!');
        return redirect()->back();
    }

    function update_sms_settings(Request $request)
    {


        $request_data  = $request->except('_token');
        $request_data['sms_enabled'] = ($request->sms_enabled == 'on' ? 1 : 0);
        SmsSetting::updateOrCreate(['id' => $this->settingID], $request_data);
        notify()->success('Settings updated successfully!');
        return redirect()->back();
    }

    function update_notifications_settings(Request $request)
    {
        $request_data  = $request->except('_token');
        $request_data['notifications_enabled'] = ($request->notifications_enabled == 'on' ? 1 : 0);
        NotificationSetting::updateOrCreate(['id' => $this->settingID], $request_data);
        notify()->success('Settings updated successfully!');
        return redirect()->back();
    }
}
