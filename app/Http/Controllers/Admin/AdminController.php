<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendence;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('Admin.dashboard');
    }
    public function attendance_history()
    {
        $atten_emp['emp_atten']=Attendence::where('overtime','>',0)->orderBy('date','DESC')->get();
        return view('Admin.attendance_history',$atten_emp);
    }
    public function attent_status_disapprove($id)
    {
        $attent_status_disapprove=Attendence::find($id);
        $attent_status_disapprove->status=0;
        $attent_status_disapprove->save();
        return redirect()->back()->with('success','Attendance successfully Disapproved!');

    }
    public function attent_status_approve($id)
    {
        $attent_status_disapprove=Attendence::find($id);
        $attent_status_disapprove->status=1;
        $attent_status_disapprove->save();
        return redirect()->back()->with('success','Attendance successfully Approved!');

    }
    public function employees()
    {

        $employees = User::where('user_role', 'user')->get();

        return view('Admin.employee.index', compact('employees'));
    }

    public function employeeCreate()
    {
        return view('Admin.employee.create');
    }

    public function employeeStore(Request $request)
    {
        // dd($request->all());

        $user = User::where('email',$request->email)->first();

        if($user)
        {
            return back()->with('error','This user already exists.');
        }

        $photo = $request->photo;

        $extension = $photo->getClientOriginalExtension();

        $folderPath = public_path('uploads/employees/');

        $img = time().'.'.$extension;

        $photo->move($folderPath, $img);

        $bank_photo = $request->bank_photo;

        $extension1 = $bank_photo->getClientOriginalExtension();

        $folderPath1 = public_path('uploads/bank_photo/');

        $img1 = time().'.'.$extension1;

        $bank_photo->move($folderPath1, $img1);

        User::create(
            [
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'residence_address' => $request->residence_address,
                'photo' => $img,
                'employment_status' => $request->employment_status,
                'hire_date' => $request->hire_date,
                'employee_id' => $request->employee_id,
                'regular_hours' => $request->regular_hours,
                'hourly_rate' => $request->hourly_rate,
                'ot_rate' => $request->ot_rate,
                'department' => $request->department,
                'statutory_deductions' => $request->statutory_deductions,
                'attn_inc_rate' => $request->attn_inc_rate,
                'phone_number' => $request->phone_number,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_number' => $request->emergency_contact_number,
                'education' => $request->education,
                'experience' => $request->experience,
                'id_type' => $request->id_type,
                'id_number' => $request->id_number,
                'bank' => $request->bank,
                'account_number' => $request->account_number,
                'branch' => $request->branch,
                'bank_photo' => $img1,
                'trn' => $request->trn,
                'nis' => $request->nis,
                'user_role' => $request->user_role,
            ]);


        return redirect()->route('admin.employees')->with('message', 'Employee data saved successfully.');
    }

    public function employeeEdit($id)
    {
        $emp = User::find($id);

        return view('Admin.employee.edit', compact('emp'));
    }

    public function employeeUpdate(Request $request, $id)
    {
        $emp = User::find($id);

        $img = $emp->photo;

        $img1 = $emp->bank_photo;

        if($request->photo)
        {
        $photo = $request->photo;

        $extension = $photo->getClientOriginalExtension();

        $folderPath = public_path('uploads/employees/');

        $img = time().'.'.$extension;

        $photo->move($folderPath, $img);
        }

        if($request->bank_photo)
        {
        $bank_photo = $request->bank_photo;

        $extension1 = $bank_photo->getClientOriginalExtension();

        $folderPath1 = public_path('uploads/bank_photo/');

        $img1 = time().'.'.$extension1;

        $bank_photo->move($folderPath1, $img1);
        }

        $emp->update([
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'email' => $request->email,
                'residence_address' => $request->residence_address,
                'photo' => $img,
                'employment_status' => $request->employment_status,
                'hire_date' => $request->hire_date,
                'employee_id' => $request->employee_id,
                'regular_hours' => $request->regular_hours,
                'hourly_rate' => $request->hourly_rate,
                'ot_rate' => $request->ot_rate,
                'department' => $request->department,
                'statutory_deductions' => $request->statutory_deductions,
                'attn_inc_rate' => $request->attn_inc_rate,
                'phone_number' => $request->phone_number,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_number' => $request->emergency_contact_number,
                'education' => $request->education,
                'experience' => $request->experience,
                'id_type' => $request->id_type,
                'id_number' => $request->id_number,
                'bank' => $request->bank,
                'account_number' => $request->account_number,
                'branch' => $request->branch,
                'bank_photo' => $img1,
                'trn' => $request->trn,
                'nis' => $request->nis,
                'user_role' => $request->user_role,
        ]);

        return redirect()->route('admin.employees')->with('message', 'Employee updated succeddfuly.');
    }

    public function employeeDestroy($id)
    {
        $emp = User::find($id);

        $emp->delete();

        return back()->with('message', 'Employee delete successfully.');
    }

    public function employeeShow($id)
    {
        $emp = User::find($id);

        return view('Admin.employee.show', compact('emp'));
    }
}
