
<div class="container">

    <div class="card my-3">
        <div class="row user-profile text-center align-items-center">
            <div  class="col-6 profile-thumb-wrapper text-center mt-2 mb-1">
                <div style="width: 7.25rem; height: 7.25rem;" class="profile-thumb">
                    <div class="avatar-preview">
                        <div style="width: 7.25rem; height: 7.25rem; background-image: url( '{{ @Auth::user()->image ? getFile('user', @Auth::user()->image) : dummyImg() }}' );" class="profilePicPreview rounded-circle" style=""></div>
                    </div>
                </div>
            </div>
            <div class="col-6 text-start">
                <h3 class="mb-0 title">{{ __(auth()->user()->fullname) }}</h3>
                <span>@lang('user id'): {{ __(auth()->user()->username) }}</span>
            </div>
        </div>
    </div>

    <div class="d-none" id="currentPath">Password</div>
    <!-- Account Navigation -->
    @include('theme3.includes.user.account_nav')

    <form id="passwordChange" action="{{ route('user.update.password') }}" method="POST">
        @csrf

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="subtitle mb-0">
                    Change Password
                </h4>
            </div>

            <div class="card-body">

                {{-- <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">Old Password</label>
                        <input type="password" class="form-control" name="oldpassword" placeholder="{{ __('Enter Old Password') }}">
                    </div>
                </div> --}}

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">New Password</label>
                        <input type="password" class="form-control" name="password" placeholder="{{ __('Enter New Password') }}">
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary rounded-pill w-100 PasswordSubmitBtn">Update Password</button>
            </div>
        </div>
    </form>
</div>

<script>
    //-- Password Change --//
    $(document).on('submit', '#passwordChange', function (e) {
       e.preventDefault();
       $('.PasswordSubmitBtn').html(BtnSPIN);
       let formData = new FormData($("#passwordChange")[0])
       $.ajax({
           type: "POST",
           url: "{{route('user.update.password')}}",
           data: formData,
           processData: false,
           dataType: 'json',
           contentType: false,
           success: function (res) {
               console.log(res);
               notifyMsg(res.msg,res.cls)
               $('.PasswordSubmitBtn').html("Update Password");
               if (res.cls == 'success') {
                    $("#passwordChange")[0].reset();
               }
           },
           error: function (err) {
                let errors = err.responseJSON.errors;
                let problems = '';
                let key = 1;
                $.each(errors, function (index, value) {
                    problems += (key++)+':'+value+'<br>';
                });

                notifyMsg(problems,'error')
                $('.PasswordSubmitBtn').html("Update Password");
           }
       });
   });
</script>
