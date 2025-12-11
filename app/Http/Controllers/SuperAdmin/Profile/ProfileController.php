<?php

namespace App\Http\Controllers\SuperAdmin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\image;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use image;

    //=========================================== SuperAdmin Profile =======================================================//
    public function get_profile_data()
    {
        $superadmin =  User::findOrFail(auth()->user()->id);
        return view('SuperAdmin.profile.profile', compact('superadmin'));
    }

    public function update_profile(ProfileRequest $request, $id)
    {
        try {



            $superadmin = User::findOrFail($id);
            if ($request->filled('password')) {
                $newPassword = Hash::make($request->password);
            } else {
                $newPassword = $superadmin->password;
            }

            if ($request->hasFile('image')) {
                $this->delete_file($superadmin->image);
                $image = $this->uploadImageimage($request->image, 'SuperAdmin/Profile');
            } else {
                $image = $superadmin->image;
            }

            $superadmin->update([
                'name'     => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'image'    => $image,
                'password' => $newPassword,
            ]);

            return redirect()->back()->with(['success' => __('Students_trans.profile_updated')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //====================================================== End SuperAdmin Profile =========================================//


    //=========================================== Admin Profile =======================================================//
    public function get_profile_admin()
    {
        $admin =  User::findOrFail(auth()->user()->id);
        return view('Admin.profile.profile', compact('admin'));
    }

    public function update_profile_admin(ProfileRequest $request, $id)
    {
        try {



            $admin = User::findOrFail($id);
            if ($request->filled('password')) {
                $newPassword = Hash::make($request->password);
            } else {
                $newPassword = $admin->password;
            }

            if ($request->hasFile('image')) {
                $this->delete_file($admin->image);
                $image = $this->uploadImageimage($request->image, 'SuperAdmin/Profile');
            } else {
                $image = $admin->image;
            }

            $admin->update([
                'name'     => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'image'    => $image,
                'password' => $newPassword,
            ]);

            return redirect()->back()->with(['success' => __('Students_trans.profile_updated')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //====================================================== End Admin Profile =========================================//


    //=========================================== Employee Profile =======================================================//
    public function get_profile_employee()
    {
        $employee =  User::findOrFail(auth()->user()->id);
        return view('Employee.profile.profile', compact('employee'));
    }

    public function update_profile_employee(ProfileRequest $request, $id)
    {
        try {
            $employee = User::findOrFail($id);
            if ($request->filled('password')) {
                $newPassword = Hash::make($request->password);
            } else {
                $newPassword = $employee->password;
            }

            if ($request->hasFile('image')) {
                $this->delete_file($employee->image);
                $image = $this->uploadImageimage($request->image, 'SuperAdmin/Profile');
            } else {
                $image = $employee->image;
            }

            $employee->update([
                'name'     => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'image'    => $image,
                'password' => $newPassword,
            ]);

            return redirect()->back()->with(['success' => __('Students_trans.profile_updated')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //====================================================== End Employee Profile =========================================//
}
