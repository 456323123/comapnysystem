<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendence;
use App\Mail\TestMail;
use App\Models\Threshold;

use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PayrollController extends Controller
{
    
    public function payroll(Request $request)
    {
        $payroll['threshold']=Threshold::select('cycle','days')->distinct()->get();
        $payroll['department']=Department::select('department','id')->get();
        $payroll['users']=User::where('user_role','user')->select('first_name','id')->get();
        return view('Admin/payroll',$payroll);
    }
    public function search(Request $request)
    {
       
        $search['threshold']=Threshold::select('cycle','days')->distinct()->get();
        $search['department']=Department::select('department','id')->get();
        $search['users']=User::where('user_role','user')->select('first_name','id')->get();
        
        //  dd($request->input());
        // "cycle" => "7"
        // "start_date" => "2022-01-03"
        // "end_date" => "2022-01-07"
        // "Dept" => "2"
        // "Emp" => "12"
        if($request->cycle !='')
        {
          
  
// Add days to date and display it 
        $end_date= date('Y-m-d', strtotime($request->start_date. ' + '.$request->cycle.' days')); 
        $search['date_bw_data'] = Attendence::select('user_id')->whereBetween('date', [$request->start_date, $end_date])->distinct()->get();
  
        //dd($search['date_bw_data']);   
        // dd($request->cycle,$request->start_date);
        }
        if($request->Emp !='')
        {

            $post = User::find($request->Emp)->attendance;
            $user_id=$post[0]->user_id;
            $search['attendence_id']=$post[0]->id;

            $search['users_name']=User::where('id',$user_id)->select('first_name','id')->first();
            $hours = Attendence::where('user_id', $user_id)->sum('total_hours');
             $search['hours'] =gmdate("H:i", $hours);

        }
        if($request->Dept !='')
        {
            $search['users_name_dep']=User::where('department',$request->Dept)->select('first_name','id')->get();
        }
        return view('Admin/payroll',$search);

    }
    public function atten_get(Request $request)
    {
        $user_id= $request->atten_id;
        $get_signle_atten=Attendence::where('user_id',$user_id)->get();
        $hours_get= Attendence::where('user_id', $user_id)->sum('total_hours');
        $overtime_get= Attendence::where('user_id', $user_id)->sum('overtime');
    
        $overtime =gmdate("H:i", $overtime_get);
        $hours =gmdate("H:i", $hours_get);

        $atten_get=User::where('id',$user_id)->first();
        $first_name=$atten_get->first_name;
        $dep_id=$atten_get->department;

        $department_get=Department::where('id',$dep_id)->select('department')->first();
        $department_name= $department_get->department;
        //echo $first_name;
        //return $department_get->department;
       return response()->json(['department'=>$department_name,'first_name'=>$first_name,'total_hours'=>$hours]);
        //dd($atten_get['department'],$dep_id,$atten_get->first_name);
    }
}
