@extends('admin.layouts.master')

@section('page', 'Profile')

@section('mainContent')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center position-relative">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset(Auth::guard('admin')->user()->image_path) }}" alt="profile-picture">

                            <div class="change-image">
                                <label for="upload_image" class="badge badge-primary" title="Change profile picture"><i class="fas fa-camera"></i></label>
                                <input type="file" name="upload_image" id="upload_image" class="d-none" accept="image/*">
                            </div>
                        </div>
                        <div class="text-center my-3">
                            <span class="badge bg-danger rounded-0"><h6 class="mb-0 font-weight-bold">Administrator</h6></span>
                        </div>
                        <h3 class="profile-username text-center">{{ Auth::guard('admin')->user()->first_name.' '.Auth::guard('admin')->user()->last_name }}</h3>
                        <p class="text-muted text-center">{{ Auth::guard('admin')->user()->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings-tab" data-toggle="tab">Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#password-tab" data-toggle="tab">Password</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings-tab">
                                <p class="small text-muted">Please note, Your information is always safe with us. We do not display your content anywhere else </p>

                                <div id="show-profile-container">
                                    <div class="form-group row">
                                        <label for="first_name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9 pt-2">{{ Auth::guard('admin')->user()->first_name }} {{ Auth::guard('admin')->user()->middle_name }} {{ Auth::guard('admin')->user()->last_name }}</div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9 pt-2 text-muted">{{ Auth::guard('admin')->user()->email }}</div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone_number" class="col-sm-3 col-form-label">Phone number</label>
                                        <div class="col-sm-9 pt-2">{{ Auth::guard('admin')->user()->phone_number }}</div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button class="btn btn-primary" id="tap-to-edit">Tap to edit</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="edit-profile-container" style="display: none">
                                    <form class="form-horizontal" method="POST" action="{{ route('admin.profile.update') }}" id="profile-form">
                                        <div class="form-group row">
                                            <label for="first_name" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="{{ Auth::guard('admin')->user()->first_name }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle name" value="{{ Auth::guard('admin')->user()->middle_name }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" value="{{ Auth::guard('admin')->user()->last_name }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ Auth::guard('admin')->user()->email }}" disabled>

                                                <p class="small text-muted mt-2 mb-0">Email id cannot be changed once registered</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone_number" class="col-sm-3 col-form-label">Phone number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number" value="{{ Auth::guard('admin')->user()->phone_number }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-success">Update</button>
                                                <button type="button" class="btn btn-light border" id="tap-to-cancel">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane" id="password-tab">
                                <form class="form-horizontal" method="POST" action="#" id="password-form">
                                    <div class="form-group row">
                                        <label for="oldPassword" class="col-sm-2 col-form-label">Old</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newPassword" class="col-sm-2 col-form-label">New</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // tap to profile edit
            $('#tap-to-edit').on('click', function() {
                $('#edit-profile-container').show();
                $('#show-profile-container').hide();
            });
            // tap to cancel profile edit
            $('#tap-to-cancel').on('click', function() {
                $('#show-profile-container').show();
                $('#edit-profile-container').hide();
            });
            // profile update
            $('#profile-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url : $(this).attr('action'),
                    method : $(this).attr('method'),
                    data : {
                        '_token' : '{{csrf_token()}}',
                        first_name : $('input[name="first_name"]').val(),
                        middle_name : $('input[name="middle_name"]').val(),
                        last_name : $('input[name="last_name"]').val(),
                        phone_number : $('input[name="phone_number"]').val(),
                    },
                    success : function(result) {
                        if(result.error === false) {
                            toastFire(result.message, 'success');
                        } else {
                            toastFire(result.message, 'failure');
                        }
                    },
                    error: function(xhr, status, error) {
                        // toastFire('danger', 'Something Went wrong');
                    }
                });
            });
        });
    </script>
@endsection