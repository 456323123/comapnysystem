@extends('layouts.admin')
@section('content')
<div class="container"> <section id="basic-datatable">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Show All Attendance List</h4>
                  @if ($message = Session::get('success'))
                  <div class="alert alert-success ">    
                      <strong>{{ $message }}</strong>
                  </div>
                  @endif   
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <p class="card-text">Attendance List</p>
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                              <thead>
                                  <tr>
                                    <th>#id</th>
                                    <th>Employee Name</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Work Time</th>
                                    <th>Basic Hours</th>
                                    <th>Over Time</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @php
                                    $i=1;
                                  
                                @endphp
                                @foreach($emp_atten as $list)
                                @php
                                $user_name=Auth::user()->first_name;
                            @endphp
                                  <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$list->first_name}}</td>
                                    <td>{{$list->date}} - {{$list->start_time}}</td>
                                    <td>{{$list->date}} - {{$list->end_time}}</td>
                                    <td>
                                      @php
                                          $work_time=number_format((float)$list->work_time, 2, '.', '');
                                          $per_hours=explode('.',$work_time);
                                      @endphp
                                  {{'0'.$per_hours[0] .':'. $per_hours[1].':'. $per_hours[1]}} 
                                  </td>
                                    <td>08:00:00</td>
                                    <td>
                                      @php
                                          $overtime=number_format((float)$list->overtime, 2, '.', '');
                                          $per_hours=explode('.',$overtime);
                                      @endphp
                                  {{'0'.$per_hours[0] .':'. $per_hours[1].':'. $per_hours[1]}} 
                                  </td>

                                      <td>
                                        @if($list->status != 0)
                                        <div class="col-3">
                                          <a class="btn btn-warning btn-sm text-white"  
                                           href="{{ route('admin.attent_status_disapprove', $list->id)}}">disapprove</a>   
                                         </div>
                                         @else
                                         <div class="col-3">                 
                                          <a class="btn btn-success btn-sm text-white"
                                            href="{{route('admin.attent_status_approve', $list->id)}}">Approve</a>   
                                        </div> 
                                        @endif 
                                      </td>
                                  </tr>
                                @endforeach  
                              </tbody>
                              
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
</div>
@endsection