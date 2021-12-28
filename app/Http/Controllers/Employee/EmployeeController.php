<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendence;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class EmployeeController extends Controller
{
    
        public function dashboard()
        {
            $user_id=Auth::user()->id;
            $c_date=date('Y-m-d'); 
            $user_atten['start_time']=Attendence::where('user_id',$user_id)->where('date',$c_date)->first();


            return view('Employee.dashboard',$user_atten);
        }
        public function attendance_history()
        {
            $user_id=Auth::user()->id;
            $atten_emp['emp_atten']=Attendence::where('user_id',$user_id)->orderBy('date','DESC')->get();
            return view('Employee.attendance_history',$atten_emp);
        }
        
        public function endtime(Request $request){
            // $request->validate([
            //     'start_time' => 'required',
            //     'end_time' => 'required'
                   
            // ]);
           // $user_id=Auth::user()->id;
           $user_id=$request->user_id;
           $atten_id=$request->atten_id;

           $In_time_update=Attendence::find($atten_id);
            $todayDate = Carbon::now()->format('d-m-Y');
            $c_time=date('h:i:s A');
            $c_date=date('Y-m-d');  

            $end_time = date('h:i:s A', strtotime($c_time));  
            $total_time_hours= Carbon::parse( $In_time_update->start_time)->floatDiffInHours($end_time, false); 
            $total_time_mint=  Carbon::parse($In_time_update->start_time)->floatDiffInMinutes($end_time,false);                    // 0.019722222222222
            $newDateTime = Carbon::now()->addHour($total_time_hours);
        

            $expire_date_string = '12:45:32';
            //  Parse date with carbon
            $carbonated_date = Carbon::parse($expire_date_string);
            //  Assuming today was 2016-07-27 12:45:32
            $diff_date = $carbonated_date->diffForHumans(Carbon::now());
            // dd($diff_date ,$total_time_hours, $newDateTime);
            $total_hours =$total_time_hours-8;
            $check_atten_one_time=Attendence::where('user_id',$user_id)->where('date',$c_date)->first();
            if(isset($check_atten_one_time))
            {
             if($total_time_hours > 8)
            {
                $In_time_update->user_id=$user_id;
                $In_time_update->end_time=$end_time;
                $In_time_update->date=$c_date;
                $In_time_update->work_time=$total_time_hours;
                $In_time_update->overtime=$total_hours;
                $In_time_update->status=0;
                $In_time_update->save();

            }else{
                $In_time_update->user_id=$user_id;
                $In_time_update->end_time=$end_time;
                $In_time_update->date=$c_date;
                $In_time_update->work_time=$total_time_hours;
                $In_time_update->overtime=0;
                $In_time_update->status=0;
                $In_time_update->save();
            }
            return redirect()->back()->with('success','Your attendance successfully!');
            }else{
                return redirect()->back()->with('error','Your attendance Already Done!');

            }
            
            // dd( $total_time_hours,$end_time);
           
        }
        public function starttime(Request $request){
            $user_id=$request->user_id;
            $c_date=date('Y-m-d');  
            $c_time=date('h:i:s A');
            $start_time = date('h:i:s A', strtotime($c_time));  
            $check_atten_one_time=Attendence::where('user_id',$user_id)->where('date',$c_date)->first();
            if(!isset($check_atten_one_time))
            {
            $atten=new Attendence();
            $atten->user_id=$user_id;
            $atten->start_time=$start_time;
            $atten->date=$c_date;
            $atten->work_time=0;
            $atten->overtime=0;
            $atten->status=0;
            $atten->save();

            return redirect()->back()->with('success','Your attendance successfully!');
        }else{
            return redirect()->back()->with('error','Your attendance Already Done!');

        }
        }
}
