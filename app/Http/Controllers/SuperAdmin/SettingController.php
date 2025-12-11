<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Traits\image;

class SettingController extends Controller
{
    use image;
    public function index()
    {
        $general = Setting::get('general', [
            'phone' => '0102652265',
            'logo' => null,
            'company_name' => ['ar' => 'كابيتال ارجو', 'en' => 'Capital Argo'],
            'email' => 'ahmedazoz799@gmail.com',
            'Address' => ['ar'=>'38 شارع جمال سالم المتقرع من محي الدين - الدقي','en'=>'38 gamal salem streat = eldokey'],
        ]);

        if (!empty($general['logo'])) {
            $general['logo_url'] = asset('storage/' . $general['logo']);
        } else {
            $general['logo_url'] = null;
        }

        $work_schedule = Setting::get('work_schedule', [
            'start_time' => '09:00',
            'end_time' => '17:00',
            'working_hours_per_day' => 8,
            'weekly_working_days' => ['Su', 'Mon', 'Tue', 'Wed', 'Thu']
        ]);

        $holidays = Setting::get('holidays', []);

        return view('SuperAdmin.setting.index', compact('general', 'work_schedule', 'holidays'));
    }


    public function update(Request $request)
    {
        $logo = $request->file('logo');
        $currentLogo = Setting::get('general')['logo'] ?? null;

        if ($logo) {
            if ($currentLogo) {
                $this->delete_file($currentLogo);
            }
            $uploadedLogo = $this->uploadImageimage($logo, 'Settings/images');
        }

        Setting::updateOrCreate(
            ['key' => 'general'],
            ['value' => [
                'phone' => $request->phone,
                'logo' => $uploadedLogo ?? $currentLogo,
                'company_name' => [
                    'ar' => $request->company_name_ar,
                    'en' => $request->company_name_en
                ],
                'email'=>$request->email,
                'address' => [
                    'ar' => $request->address_ar,
                    'en' => $request->address_en
                ],
            ]]
        );

        Setting::updateOrCreate(
            ['key' => 'work_schedule'],
            ['value' => $request->work_schedule]
        );

        $holidays = json_decode($request->holidays_json, true) ?? [];
        Setting::updateOrCreate(
            ['key' => 'holidays'],
            ['value' => $holidays]
        );

        return back()->with('success', 'Settings updated successfully');
    }
}
