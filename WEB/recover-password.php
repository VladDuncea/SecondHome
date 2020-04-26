<!DOCTYPE html>
<html>
<head>
<?php include 'pieces/head.php' ?>
</head>

<body class="hold-transition login-page">

<div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>S</b>econd<b>H</b>ome</a>
        </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Intoduceti noua parola.</p>
      <form id="reset_pass_form" action="">

        <div class="input-group mb-3">
          <input type="password" class="form-control" id="pass1" name="password" placeholder="Parolă">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password_again" id="recoverpass" placeholder="Rescrie parola">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" >Schimbă parola</button>
          </div>
          <!-- /.col -->
        </div>

      </form>
      <p class="mt-3 mb-1">
        <a href="login.php">Autentificare</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<style>
        .login-page{
        background: url("pet.png");
        background-size: auto;
        }
        .login-logo {
            background-color:white;
            /* text-shadow: 2px 2px; */
        }
    </style>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../dist/js/utils.js"></script>
<script>
    $(document).ready(function () {
        $('#reset_pass_form').validate({
            submitHandler: function(form) {
              recoverpass();
              form.reset();
            },
            rules: {
            password: {
                required: true,
                minlength: 6
            },
            password_again:
            {
                equalTo: '#pass1'
            },
            },
            messages: {
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            password_again:
            {
                equalTo: "Passwords do no match"
            },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            }
        });
        });
  </script>
</body>
</html>
