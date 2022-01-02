@extends('layouts.admin')
@section('content')
    <section id="basic-datatable">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Employee Payroll
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form class="my-5">
                                            <div class="form-group">
                                                <label for="first-name-icon">Cycle</label>

                                                <div class="position-relative has-icon-left">
                                                    <input type="text" list="browsers" id="first-name-icon"
                                                        class="form-control" name="first_name" placeholder="Cycle"
                                                        required="">

                                                    <datalist id="browsers">
                                                        <option value="Weekly">Weekly</option>
                                                        <option value="Fortnightly">Fortnightly</option>
                                                        <option value="Monthly">Monthly</option>
                                                    </datalist>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password-icon">Duration</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="date" id="password-icon" class="form-control"
                                                                name="dob" placeholder="start date">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-calendar "></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password-icon">End Date</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="date" id="password-icon" class="form-control"
                                                                name="dob" placeholder="End date">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-calendar "></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-icon">Dept</label>

                                                <div class="position-relative has-icon-left">
                                                    <input type="text" list="Weekly" id="first-name-icon"
                                                        class="form-control" name="Dept" placeholder="Dept" required="">

                                                    <datalist id="Weekly">
                                                        <option value="Weekly">Weekly</option>
                                                        <option value="Fortnightly">Fortnightly</option>
                                                        <option value="Monthly">Monthly</option>
                                                    </datalist>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-icon">Emp</label>

                                                <div class="position-relative has-icon-left">
                                                    <input type="text" list="Emp" id="first-name-icon"
                                                        class="form-control" name="Emp" placeholder="Emp" required="">

                                                    <datalist id="Emp">
                                                        <option value="Weekly">Weekly</option>
                                                        <option value="Fortnightly">Fortnightly</option>
                                                        <option value="Monthly">Monthly</option>
                                                    </datalist>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="btn-group pull-left">
                                                <button type="reset" class="btn btn-warning pull-right">Reset</button>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                                            </div>


                                        </form>
                                        <br>
                                        <div class="">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Employee Name</th>
                                                        <th scope="col">Hrs.</th>
                                                        <th scope="col">Processed</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Laci-Anne McGowan </th>
                                                        <td>38.85</td>
                                                        <td><i class="fa fa-fw fa-check" style="color: green;"></i></td>
                                                        <td><button type="submit" class="btn btn-info btn-sm"><i
                                                                    class="fa fa-fw fa-eye"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Laci-Anne McGowan </th>
                                                        <td>38.85</td>
                                                        <td><i class="fa fa-fw fa-check" style="color: green;"></i></td>
                                                        <td><button type="submit" class="btn btn-info btn-sm"><i
                                                                    class="fa fa-fw fa-eye"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Laci-Anne McGowan </th>
                                                        <td>38.85</td>
                                                        <td><i class="fa fa-fw fa-check" style="color: green;"></i></td>
                                                        <td><button type="submit" class="btn btn-info btn-sm"><i
                                                                    class="fa fa-fw fa-eye"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Laci-Anne McGowan </th>
                                                        <td>38.85</td>
                                                        <td><i class="fa fa-fw fa-check" style="color: green;"></i></td>
                                                        <td><button type="submit" class="btn btn-info btn-sm"><i
                                                                    class="fa fa-fw fa-eye"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Laci-Anne McGowan </th>
                                                        <td>38.85</td>
                                                        <td><i class="fa fa-fw fa-check" style="color: green;"></i></td>
                                                        <td><button type="submit" class="btn btn-info btn-sm"><i
                                                                    class="fa fa-fw fa-eye"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Laci-Anne McGowan </th>
                                                        <td>38.85</td>
                                                        <td><i class="fa fa-fw fa-check" style="color: green;"></i></td>
                                                        <td><button type="submit" class="btn btn-info btn-sm"><i
                                                                    class="fa fa-fw fa-eye"></i></button></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="">

                                            <h3 class="box-title">Department &amp; Rate</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6 col-xs-6">Department: </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6"><strong>Selo-CS</strong></div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">Regular Hours: </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">8.00</div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">Overtime Rate: </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">$270.00</div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">Hourly Rate: </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">$400.00</div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">Bonus Rate: </div>
                                            </div>

                                        </div>
                                        <div class="mt-4">

                                            <h3 class="box-title">Pay Calculation</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6 col-xs-6">Employee: </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6"><strong>Bali G</strong></div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">TRN: </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">NIS:</div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">Work Hours: </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">0.00</div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">Reg Pay:</div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">$0.00</div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">OT Pay:</div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">$0.00</div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">Bonus:</div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">$0.00</div>
                                                <div class="col-md-3 col-sm-6 col-xs-6">Stat:</div>
                                            </div>

                                        </div>
                                        <div class="box my-4">
                                            <div class="box-body">
                                                <h4>Payments</h4>
                                                <div class="table-responsive no-padding">
                                                    <table class="table table-bordered" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <th>Description</th>
                                                                <th>Hr/Day</th>
                                                                <th>Rate</th>
                                                                <th>Total</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Basic Pay</th>
                                                                <td>0.00</td>
                                                                <td>$400.00</td>
                                                                <td>$0.00</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Attn.Inc</th>
                                                                <td>0.00</td>
                                                                <td>$1.00</td>
                                                                <td>$0.00</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Overtime</th>
                                                                <td>0.00</td>
                                                                <td>$270.00</td>
                                                                <td>$0.00</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Bonus</th>
                                                                <td>Selected Duration</td>
                                                                <td>$0.00</td>
                                                                <td>$0.00</td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="3">Total</th>
                                                                <td>$0.00</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <h4>Deductions</h4>
                                                <div class="table-responsive no-padding">
                                                    <table class="table table-bordered" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <th colspan="2">Reason</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="2">Total</th>
                                                                <th>$0.00</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <h4>Net: $0.00</h4>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
