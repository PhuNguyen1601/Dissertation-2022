<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng nhập</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">

    <!-- /.login-logo -->
    <div class="card">
      <div class="login-logo">
        <img style="height: 200px" src="{{ asset('dist/img/logo.png')}}" alt="">
      </div>
      <div class="text-center text-danger font-weight-bold">
        <?php
        $message = Session::get('message');
        if($message)
        echo $message;
        Session::get('message',null);
      ?>
      </div>
      <div class="card-body login-card-body">
        <form action="{{ route('checklogin') }}" method="post">
          @csrf
          <div class="input-group">
            <input type="text" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope">
                </span>
              </div>
            </div>
          </div>
          @if ($errors->has('email'))
          <strong class=" text-danger p-2">{{ $errors->first('email') }}</strong>
          @endif
          <div class="mb-3"></div>
          <div class="input-group">
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          @if ($errors->has('password'))
          <strong class="text-danger p-2">{{ $errors->first('password') }}</strong>
          @endif
          <div class="mb-3"></div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
</body>

</html>