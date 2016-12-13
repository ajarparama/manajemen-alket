<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Manajemen Alket</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.css') }}">
  <link rel="stylesheet" href="{{ asset('css/blue.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#">Manajemen<b>Alket</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="register-box-body">
    <p class="login-box-msg">Daftar Baru</p>

                    <form role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group has-feedback{{ $errors->has('nama') ? ' has-error' : '' }}">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Nama" required autofocus>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('nip') ? ' has-error' : '' }}">
                                <input id="nip" type="number" class="form-control" name="nip" value="{{ old('nip') }}" placeholder="NIP Pendek" required>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                                @if ($errors->has('nip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Ketik Ulang Password" required>
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="radio"> 
                          <label>
                            <input name="userpic" id="userpic" type="radio" value="userpicm.jpg" checked="checked"> Laki-laki                  
                          </label>
                          <label>
                            <input name="userpic" id="userpic" type="radio" value="userpicf.jpg"> Perempuan 
                          </label>
                        </div>


                        <div class="form-group">
                        <div class="row">
                            <div class="col-xs-offset-8 col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    Daftar
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>

    <div class="text-center">
      <p>- ATAU -</p>
    </div>

    <a href="{{ url('/login') }}" class="text-center">Saya sudah punya akun</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('js/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>