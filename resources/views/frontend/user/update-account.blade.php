@extends('frontend.user.user-masters')
@section('user-content')
    <div class="column content">
        <form action="{{route('self_update')}}" method = "post" class="common-form">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" value="{{$user->first_name}}" name="first_name" id="firstName">
                    <label for="firstName">First name <span>*</span></label>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" value="{{$user->last_name}}" name="last_name" id="lastName">
                    <label for="lastName">Last name <span>*</span></label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <input type="email" class="form-control" value="{{$user->email}}" name="email" id="email">
                    <label for="email">Email address <span>*</span></label>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <input type="text" class="form-control" value="{{$user->phone}}" name="phone" id="phone">
                    <label for="email">Phone <span>*</span></label>
                </div>
            </div>

            <fieldset>
                <legend>Password change</legend>

                <div class="form-group col-12">
                    <a href="#" class="btn view-password"><i class="far fa-eye" onclick="currentPassword()"></i></a>
                    <input type="password" class="form-control" name="currentPassword" id="currentPassword">
                    <label for="currentPassword">Current password (Leave blank to leave unchanged)</label>
                </div>

                <div class="form-group col-12">
                    <a href="javascript:void(0)" class="btn view-password"><i class="far fa-eye" onclick="newPassword()"></i></a>
                    <input type="password" class="form-control"  name="password" id="newPassword">
                    <div class="password-status">
                        <span class="hint">
                            Hint: The password should be at least twelve characters long. To make it stronger, use upper and lower case letters, numbers and symbols
                        </span>
                    </div>
                    <label for="newPassword">New password (Leave blank to leave unchanged)</label>
                </div>

                <div class="form-group col-12">
                    <a href="#" class="btn view-password"><i class="far fa-eye" onclick="ConfirmPassword()"></i></a>
                    <input type="password" class="form-control" name="confirm_password" id="ConfirmPassword">
                    <label for="ConfirmPassword">Confirm new password</label>
                </div>
            </fieldset>

            <button type = "submit" class="btn blue-button" id="save-changes">Save changes</button>
        </form>

    </div>



    </main>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/jquery.passwordstrength.js')}}"></script>
    <script>        

        function currentPassword() {
            var x = document.getElementById("currentPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        function newPassword() {
            var x = document.getElementById("newPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        function ConfirmPassword() {
            var x = document.getElementById("ConfirmPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        $( document ).ready(function() {
            $(function() {
                $("#newPassword").passwordStrength();
            });
        });

    </script>

@endsection
