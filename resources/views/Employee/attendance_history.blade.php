@extends('Employee.layouts.main')
@section('content')
<div class="container"> <section id="basic-datatable">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Show All Attendance List</h4>
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
                                  </tr>
                              </thead>
                              <tbody>
                                @php
                                    $i=1;
                                    $user_name=Auth::user()->first_name;
                                @endphp
                                @foreach($emp_atten as $list)
                                  <tr>
                                      <td>{{$i++}}</td>
                                      <td>{{$user_name}}</td>
                                      <td>{{$list->date}} - {{$list->start_time}}</td>
                                      <td>{{$list->date}} - {{$list->end_time}}</td>
                                      <td>{{number_format((float)$list->work_time, 2, '.', '')}}</td>
                                      <td>08:00:00</td>
                                      @if($list->status == 0)
                                      <td>00:00:00</td>
                                        @else
                                        <td>{{number_format((float)$list->overtime, 2, '.', '')}}</td>
                                        @endif
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