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
                                      <th>User id</th>
                                      <th>Start Time</th>
                                      <th>End Time</th>
                                      <th>Date</th>
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
                                      <td>{{$list->user_id}}</td>
                                      <td>{{$list->start_time}}</td>
                                      <td>{{$list->end_time}}</td>
                                      <td>{{$list->date}}</td>
                                      <td>{{$list->overtime}}</td>
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