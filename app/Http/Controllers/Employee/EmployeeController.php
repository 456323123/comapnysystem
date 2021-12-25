<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendence;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    
        public function dashboard()
        {
         
            return view('Employee.dashboard');
        }
        public function attendance_history()
        {
            $user_id=Auth::user()->id;
            $atten_emp['emp_atten']=Attendence::where('user_id',$user_id)->orderBy('date','DESC')->get();
            return view('Employee.attendance_history',$atten_emp);
        }
        
        public function starttime(Request $request){
            $request->validate([
                'start_time' => 'required',
                'end_time' => 'required'
                   
            ]);
            $user_id=Auth::user()->id;
           
            $todayDate = Carbon::now()->format('d-m-Y');
            $c_date=date('Y-m-d'); 
            //echo Carbon::parse('2000-01-01 12:00')->floatDiffInDays('2000-02-11 06:00');     // 40.75
            //echo Carbon::parse('06:01:23.252987')->floatDiffInSeconds('06:02:34.321450');    // 71.068463
            //echo Carbon::parse($start_time)->floatDiffInMinutes($end_time); 
                             // 1.1833333333333
            // $end_time = date('h:i:s A', strtotime($start_time)+$hours); 
            $start_time = date('h:i:s A', strtotime($request->start_time)); 
            $end_time = date('h:i:s A', strtotime($request->end_time)); 
 
            $total_time_hours= Carbon::parse( $start_time)->floatDiffInHours($end_time, false); 
            $total_hours =$total_time_hours-8;
            $check_atten_one_time=Attendence::where('user_id',$user_id)->where('date',$c_date)->first();
            if(!isset($check_atten_one_time))
            {
             if($total_time_hours > 8)
            {
                $atten=new Attendence();
                $atten->user_id=$user_id;
                $atten->start_time=$start_time;
                $atten->end_time=$end_time;
                $atten->date=$c_date;
                $atten->work_time=$total_time_hours;
                $atten->overtime=$total_hours;
                $atten->status=0;
                $atten->save();

            }else{
                $atten=new Attendence();
                $atten->user_id=$user_id;
                $atten->start_time=$start_time;
                $atten->end_time=$end_time;
                $atten->date=$c_date;
                $atten->work_time=$total_time_hours;
                $atten->overtime=0;
                $atten->status=0;
                $atten->save();
            }
            return redirect()->back()->with('success','Your attendance successfully!');
            }else{
                return redirect()->back()->with('error','Your attendance Already Done!');

            }
            
            // dd( $total_time_hours,$end_time);
           
        }
}
