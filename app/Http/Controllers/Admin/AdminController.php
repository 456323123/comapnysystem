<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendence;
use App\Mail\TestMail;
use App\Models\Threshold;

use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('Admin.dashboard');
    }
    public function department()
    {
        $department['view_department']=Department::get();
        return view('Admin.department',$department);
    }

    public function  add_department( Request $request)
    {
        $add_Department=new Department();
        $add_Department->department=$request->department_name;
        $add_Department->status=0;
        $add_Department->save();

        return redirect()->back()->with('success','Department successfully Addedd!');
    }
    public function  edit_department( Request $request,$id)
    {
        $edit_department=Department::find($id);
        $edit_department->department=$request->department_name;
        $edit_department->save();

        return redirect()->back()->with('success','Department successfully Updated!');
    }
    public function depart_status_deactive($id)
    {
        $depart_status_deactive=Department::find($id);
        $depart_status_deactive->status=0;
        $depart_status_deactive->save();
        return redirect()->back()->with('error','Department successfully Deactive!');

    }
    public function depart_status_active($id)
    {
        $depart_status_active=Department::find($id);
        $depart_status_active->status=1;
        $depart_status_active->save();
        return redirect()->back()->with('success','Department successfully Active!');

    }
    public function  delete_department( Request $request,$id)
    {
        $delete_department=Department::find($id);
        $delete_department->delete();

        return redirect()->back()->with('error','Department successfully Deleted!');
    }


    public function attendance_history()
    {
        $atten_emp['emp_atten']= DB::table('attendences')
        ->leftjoin('users','users.id','=','attendences.user_id')
        ->select('users.first_name','attendences.*')->orderBy('date','DESC')->get();
        //  dd($atten_emp);
        //dd($atten_emp['emp_atten']);
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
            return back()->with('error','This user email already exists.');
        }
        else
        {
            $user= User::create(
                [
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'residence_address' => $request->residence_address,
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
                'bank_photo' => 'kkk',
                'trn' => $request->trn,
                'nis' => $request->nis,
                'user_role' => $request->user_role,
            ]
            );
            if (request()->hasfile('photo')) {
                $image = request()->file('photo');
                $filename = time() . '.' . $image->getClientOriginalName();
                $movedFile = $image->move('uploads/employees', $filename);
                $user->photo = $filename;
                $user->save();
            } else {
                $user->save();
            }
            $details = [
                'title' => 'Email and Password',
                'body' =>'Hi...'.$request->first_name.'Your Email address : '.$request->email.''.'and Your password : ->  '. $request->password
            ];

            \Mail::to($request->email)->send(new TestMail($details));

            // $user = User::where('email', '_mainaccount@briway.uk')->first();

            // \Mail::to($user->email)->send(new TestMail($details));
            // $admin = [
            //     'title' => 'user  Email and Password',
            //     'body' =>'Hi...'.$request->first_name.'Your Email address : '.$request->email.''.'and Your password : ->  '. $request->password
            // ];


            return redirect()->route('admin.employees')->with('message', 'Employee data saved successfully.');
        }
    }


    public function employeeEdit($id)
    {
        $emp = User::find($id);

        return view('Admin.employee.edit', compact('emp'));
    }


       public function employeeView($id)
    {
        $emp = User::find($id);

        return view('Admin.employee.view', compact('emp'));
    }

    public function employeeUpdate(Request $request, $id)
    {
        $emp = User::find($id);

        $emp->update([
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'email' => $request->email,
                'residence_address' => $request->residence_address,
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
                'bank_photo' => 'null',
                'trn' => $request->trn,
                'nis' => $request->nis,
                'user_role' => $request->user_role,
        ]);
 if (request()->hasfile('photo')) {
                $image = request()->file('photo');
                $filename = time() . '.' . $image->getClientOriginalName();
                $movedFile = $image->move('uploads/employees', $filename);
                $emp->photo = $filename;
                $emp->save();
            } else {
                $emp->save();
            }
        return redirect()->route('admin.employees')->with('message', 'Employee updated succeddfuly.');
    }



    public function employeeShow($id)
    {
        $emp = User::find($id);
        return view('Admin.employee.show', compact('emp'));
    }
    public function update_profile(Request $request)
    {

      $user = User::find(Auth::user()->id);
      if(isset($request->photo))
      {
      $image=$request->file('photo');
      $imageName = $image->getClientOriginalName();

      $user->update([
          'photo' => $imageName,
      ]);
      $path=$image->move(public_path('uploads/employees'),$imageName);
      }



      $user->update([
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,

  ]);

       if(isset($request->c_password))
       {
         $request->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'required_with:password|same:new_password|min:8'

        ]);
        if(Hash::check($request->c_password,$user->password)) {
                $user->update([
            'password' => Hash::make($request->new_password),
        ]);
            $msg="Your profile has been updated";
            $request->session()->flash('message',$msg);
            return redirect('/profile');

        }else{
            $msg= "Your Password does't match";
             $request->session()->flash('error',$msg);
            return redirect('/profile');
        }
      }else{
          $msg="Your profile has been updated";
          $request->session()->flash('message',$msg);
          return redirect('/profile');

      }
    }
    public function threshold(Request $request)
    {
        $threshold['threshold']=Threshold::all();
        return view('Admin/threshold',$threshold);
    }
    public function add_threshold(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'cycle' => 'required',
            'amount' => 'required',
            'days' => 'required',
            'paid_by' => 'required'

        ]);

        //Threshold data save start
        $threshold=new Threshold();
        $threshold->year=$request->year;
        $threshold->cycle=$request->cycle;
        $threshold->amount=$request->amount;
        $threshold->days=$request->days;
        $threshold->paid_by=$request->paid_by;
        $threshold->save();
        session()->flash('success','Threshold successfully addedd!');
        return redirect('admin/threshold');


    }
    public function edit_threshold(Request $request,$id)
    {
        $edit_threshold['edit_threshold']=Threshold::find($id);
        return view('Admin/edit_threshold',$edit_threshold);

    }

    public function update_threshold(Request $request,$id)
    {
        $request->validate([
            'year' => 'required',
            'cycle' => 'required',
            'amount' => 'required',
            'days' => 'required',
            'paid_by' => 'required'

            ]);
        //Threshold data save start
        $threshold=Threshold::find($id);
        $threshold->year=$request->year;
        $threshold->cycle=$request->cycle;
        $threshold->amount=$request->amount;
        $threshold->days=$request->days;
        $threshold->paid_by=$request->paid_by;
        $threshold->save();
        session()->flash('success','Threshold successfully Updated!');
        return redirect('admin/threshold');


    }
    public function delete_threshold(Request $request,$id)
    {
        $threshold=Threshold::find($id);
        $threshold->delete();
        session()->flash('error','Threshold successfully Deleted!');
        return redirect('admin/threshold');
    }


}
