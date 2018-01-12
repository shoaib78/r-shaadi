<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') Administration @show</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link href="{{ asset('public/assets/admin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link href="{{ asset('public/assets/admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('public/assets/admin/plugins/iCheck/square/blue.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .has-error{
            color:#dd4b39;
        }
    </style>
</head>
<body class="hold-transition login-page">

@yield('content')
<!-- Scripts -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('public/assets/admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('public/assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('public/assets/admin/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
    $('document').ready(function()
    {
        /* For login form validation */
        $("#login-form").validate({
            errorClass: 'has-error',
            validClass: 'has-success',
            errorElement: 'span',
            highlight: function(element, errorClass, validClass) {
                $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents("div.form-group").removeClass(errorClass).addClass(validClass);
            },
            rules:
                {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                    },
                },
            messages:
                {
                    email:{
                        required: "Email field is required.",
                        email: "Please enter valid email.",
                    },
                    password:{
                        required: "Password field is required.",
                    },
                },
            submitHandler: function(form) {
                form.submit();
            }
        });
        /* End login form validation */
    });
</script>
</body>
</html>

