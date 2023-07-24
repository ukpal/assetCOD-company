<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AssetCOD | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL::asset('public/Administrator/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{URL::asset('public/Administrator/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('public/Administrator/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">


        <div class="login-logo">
            <img id="company-logo" class="d-none" src="" width="40%" alt="" style="border-radius:50%">
            <img id="default-logo" class="d-none" src="{{URL::asset('public/Administrator/dist/img/logo.png')}}" width="40%" alt="">
        </div>


        <div class="card">
            <div class="col-md-5 d-flex align-items-stretch ">
                @include('Administrator.notification')
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{route('postLogin')}}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">
                        <div class="input-group-append">
                            @error('email')
                            <small class="text-danger" data-error='email'>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                        <div class="input-group-append">
                            @error('password')
                            <small class="text-danger" data-error='password'>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="form-group mb-3">
                        <input type="code" name="code" class="form-control @error('password') is-invalid @enderror" id="code" placeholder="Access Code">
                        <div class="input-group-append">
                            @error('code')
                            <small class="text-danger" data-error='code'>{{ $message }}</small>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{URL::asset('public/Administrator/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{URL::asset('public/Administrator/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::asset('public/Administrator/dist/js/adminlte.min.js')}}"></script>

    <script src="{{URL::asset('public/Administrator/plugins/alphanum/jquery.alphanum.js')}}"></script>

    <script src="{{URL::asset('public/Administrator/plugins/toastr/toastr.min.js')}}"></script>

    <script>
        setTimeout(function() {
            $('.toast').fadeOut();
        }, 4000);
        
    </script>

    <script type="text/javascript">
        $(function() {
            if (localStorage.getItem('company_logo')) {
                $('#company-logo').attr("src", "{{url('/public')}}"+"/Administrator/images/logo/" + localStorage.getItem('company_logo'));
                $('#company-logo').removeClass('d-none');
            }else{
                $('#default-logo').removeClass('d-none');
            }

            $("[name='email']").on("focus", function() {
                // $(this).alpha();
                $("[data-error='email']").html("");
                $(this).removeClass("is-invalid");
            });
            $("[name='password']").on("focus", function() {
                // $(this).numeric();
                $("[data-error='password']").html("");
                $(this).removeClass("is-invalid");
            });
            // $("[name='code']").on("focus", function() {
            //     // $(this).numeric();
            //     $("[data-error='code']").html("");
            //     $(this).removeClass("is-invalid");
            // });
        });
    </script>
</body>

</html>
