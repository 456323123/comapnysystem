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
                                      <th>Name</th>
                                      <th>Start Time</th>
                                      <th>End Time</th>
                                      <th>Date</th>
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
                                      <td>{{$list->start_time}}</td>
                                      <td>{{$list->end_time}}</td>
                                      <td>{{$list->date}}</td>
                                      <td>{{$list->overtime}}</td>
                                  
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