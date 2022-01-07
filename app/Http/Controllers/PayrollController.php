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
        $threshold=Threshold::select('cycle','days')->distinct()->get();
        $department=Department::select('department','id')->get();
        $users=User::where('user_role','user')->select('first_name','id')->get();
                return view('Admin/payroll',get_defined_vars());
    }

    public function search(Request $request)
    {



        //  dd($request->input());
        // "cycle" => "7"
        // "start_date" => "2022-01-03"
        // "end_date" => "2022-01-07"
        // "Dept" => "2"
        // "Emp" => "12"
        $threshold=Threshold::select('cycle','days')->distinct()->get();
        $department=Department::select('department','id')->get();
        $users=User::where('user_role','user')->select('first_name','id')->get();
 if($request->cycle && $request->start_date && $request->DEPARTMENT && $request->Employee)
        {

// Add days to date and display it
        $end_date= date('Y-m-d', strtotime($request->start_date. ' + '.$request->cycle.' days'));
    //  $data = Attendence::select('user_id')->whereBetween('date', [$request->start_date, $end_date])->distinct()->get();
     $user= Attendence::with('user')->whereBetween('date', [$request->start_date, $end_date])->whereHas('user', function ($query) use ($request) {
            return $query->where('department',$request->DEPARTMENT);
           })
            ->whereHas('user', function ($query) use ($request) {
            return $query->where('id', $request->Employee);
           })
        ->distinct()->get('user_id');

                return view('Admin/newsearch',get_defined_vars());


        //dd($search['date_bw_data']);
        // dd($request->cycle,$request->start_date);
        }
  if($request->cycle && $request->start_date && $request->Dept )
        {


// Add days to date and display it
        $end_date= date('Y-m-d', strtotime($request->start_date. ' + '.$request->cycle.' days'));
    //  $data = Attendence::select('user_id')->whereBetween('date', [$request->start_date, $end_date])->distinct()->get();
     $user= Attendence::with('user')->whereBetween('date', [$request->start_date, $end_date])->whereHas('user', function ($query) use ($request) {
            return $query->where('department', $request->Dept);
           })
        ->distinct()->get('user_id');

                return view('Admin/newsearch',get_defined_vars());


        //dd($search['date_bw_data']);
        // dd($request->cycle,$request->start_date);
        }

        if($request->cycle && $request->start_date)
        {


// Add days to date and display it
        $end_date= date('Y-m-d', strtotime($request->start_date. ' + '.$request->cycle.' days'));
    //  $data = Attendence::select('user_id')->whereBetween('date', [$request->start_date, $end_date])->distinct()->get();
     $user= Attendence::with('user')->whereBetween('date', [$request->start_date, $end_date]) ->distinct()->get('user_id');

         return view('Admin/newsearch',get_defined_vars());


        //dd($search['date_bw_data']);
        // dd($request->cycle,$request->start_date);
        }






           return view('Admin/newsearch',compact('threshold','department','users'));
        // if($request->Emp !='')
        // {

        //     $post = User::find($request->Emp)->attendance;
        //     $user_id=$post[0]->user_id;
        //     $search['attendence_id']=$post[0]->id;

        //     $search['users_name']=User::where('id',$user_id)->select('first_name','id')->first();
        //     $hours = Attendence::where('user_id', $user_id)->sum('total_hours');
        // $overtime= Attendence::where('user_id', $user_id)->sum(DB::raw("TIME_TO_SEC(overtime)"));
        //      $search['over'] =gmdate("H:i", $overtime);

        //      $search['hours'] =gmdate("H:i", $hours);

        // }
        // if($request->Dept !='')
        // {
        //     $search['users_name_dep']=User::where('department',$request->Dept)->select('first_name','id')->get();
        // }


    }
    public function atten_get(Request $request)
    {
        $hT=$request->total_hourse;
              $oT=  $request->overtime;
$basichourstime=$hT-$oT;
// dd($basichourstime,$hT);
        $user_id= $request->atten_id;
        $get_signle_atten=Attendence::where('user_id',$user_id)->get();
        $hours_get= Attendence::where('user_id', $user_id)->sum('total_hours');
        $basichours= Attendence::where('user_id', $user_id)->sum(DB::raw("TIME_TO_SEC(work_time)"));
                $atten_get=User::where('id',$user_id)->first();
 $hourly_rate=$atten_get->hourly_rate;

           $basichourss=gmdate("H:i", $basichourstime);
           
           $basich=gmdate("H", $basichours);
                                 $basicm=gmdate("i", $basichours);

           $divh=($hourly_rate/60)*$basicm;

$hormultple=$basich*$hourly_rate;
$totalbasichourspay=$hormultple+$divh;
// dd($hourly_rate);
        $overtime_get= Attendence::where('user_id', $user_id)->sum('overtime');


        $overtime =gmdate("H:i", $overtime_get);
        $hours =gmdate("H:i", $hours_get);


        $first_name=$atten_get->first_name;
        $dep_id=$atten_get->department;
        $ORP=$atten_get->ot_rate;
 $hourly_rate=$atten_get->hourly_rate;
        $department_get=Department::where('id',$dep_id)->select('department')->first();
        $department_name= $department_get->department;
        //echo $first_name;
        //return $department_get->department;
       return response()->json(['department'=>$department_name,'first_name'=>$first_name,'total_hours'=>$hours,'orver_time_pay'=> $ORP,'hourly_rate'=>$hourly_rate,
       'basichours'=>$basichourss,'totalbasichours'=>$totalbasichourspay]);
        //dd($atten_get['department'],$dep_id,$atten_get->first_name);
    }
}
