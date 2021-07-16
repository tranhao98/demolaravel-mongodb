@extends('my-profile')
@section('profiles')
    <div class="mt-4 mb-4 text-center">
        <h4 class="text-uppercase font-weight-bold ">Personal Information</h4>
        <img src="../images/line-dec.png" alt="">
    </div>
    <div class="card shadow" style="font-size: 13px">
        <div class="card-header">
            <div class="row">
                <div class="col-6 ">
                    <h6 class="m-0 font-weight-bold">Basic Information</h6>
                </div>
                <div class="col-6 ">
                    <a href="/update-basic-infor" class="float-right m-0"><i class="fa fa-edit"
                            style="font-size: 20px"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body ">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="font-weight-bold m-0">Full name</h6><br>
                            <h6 class="font-weight-bold m-0">Gender</h6><br>
                            <h6 class="font-weight-bold m-0">Birth Date</h6><br>
                            <h6 class="font-weight-bold m-0">City</h6><br>
                            <h6 class="font-weight-bold m-0">State</h6><br>
                            <h6 class="font-weight-bold m-0">Country</h6><br>
                            <h6 class="font-weight-bold m-0">Address</h6>
                        </div>
                        <div class="col-md-7">
                            <h6 class="m-0">{{ Auth::user()->name }}</h6><br>
                            <h6 class="m-0">
                                @if (isset(Auth::user()->gender) && Auth::user()->gender != '')
                                @if (Auth::user()->gender == 1) Male @else Female
                                    @endif @else <span class="font-italic text-danger">No gender yet </span>
                                    @endif
                            </h6><br>
                            <h6 class="m-0">
                                <?php $formatBirthdate = date('d-m-Y', strtotime(Auth::user()->birthdate)); ?>
                                @if (isset(Auth::user()->birthdate) && Auth::user()->birthdate != '')
                                {{ $formatBirthdate }} @else <span class="font-italic text-danger"> No birth date
                                        yet </span> @endif
                            </h6><br>
                            <h6 class="m-0">
                                @if (isset(Auth::user()->city) && Auth::user()->city != '')
                                    {{ Auth::user()->city }}
                                @else <span class="font-italic text-danger"> No city yet </span> @endif
                            </h6><br>
                            <h6 class="m-0">
                                @if (isset(Auth::user()->state) && Auth::user()->state != '')
                                {{ Auth::user()->state }} @else <span class="font-italic text-danger"> No states
                                        yet </span> @endif
                            </h6><br>
                            <h6 class="m-0">
                                @if (isset(Auth::user()->country) && Auth::user()->country != '')
                                {{ Auth::user()->country }} @else <span class="font-italic text-danger"> No
                                        country yet </span> @endif
                            </h6><br>
                            <h6 class="m-0">
                                @if (isset(Auth::user()->address) && Auth::user()->address != '')
                                {{ Auth::user()->address }} @else <span class="font-italic text-danger"> No
                                        address yet </span> @endif
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card shadow" style="font-size: 13px">
        <div class="card-header">
            <div class="row">
                <div class="col-6 ">
                    <h6 class="m-0 font-weight-bold">Contact Information</h6>
                </div>
                <div class="col-6">
                    <a href="/update-contact-infor" class="float-right m-0"><i class="fa fa-edit"
                            style="font-size: 20px"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body ">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="font-weight-bold m-0">Mobile Number</h6><br>
                            <h6 class="font-weight-bold m-0">Email Address</h6>
                        </div>
                        <div class="col-md-7">
                            <h6 class="m-0">{{ Auth::user()->mobile }}</h6><br>
                            <h6 class="m-0">
                                {{ Auth::user()->email }}
                            </h6>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
