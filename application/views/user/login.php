<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/bower_components/bootstrap/dist/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/bower_components/font-awesome/css/font-awesome.min.css'?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/bower_components/Ionicons/css/ionicons.min.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/dist/css/AdminLTE.min.css'?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/iCheck/square/blue.css'?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
   <style type="text/css">
        .spanError{
          color: #ff0000;
        }
        .Errorborderclass{
          border-color: #ff0000;
        }
  </style>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
      <b>DPMS</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start a new journey with us</p>
    <?php 
    if($error != "")
    {
      ?>
    <div class="alert alert-danger">
    <strong>Error!</strong> <?=$error?>
    </div>
    <?php 
    }
    if($success != "")
        {
          ?>
          <div class="alert alert-success">
            <strong>Success!</strong> <?=$success?>
          </div>
          <?php
        }
      if($this->session->flashdata('success_signup') != "")
        {
          ?>
          <div class="alert alert-success">
            <strong>Success!</strong> <?php echo $this->session->flashdata('success_signup'); ?>
          </div>
          <?php
        }
    ?>
    <form action="" method="post" id="form_login">
      <div class="form-group has-feedback">
        <input id="txt_usename" name="txt_usename" type="text" class="form-control" value="<?php echo $this->input->post('txt_usename'); ?>" placeholder="User name">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span id="Error_usename" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="txt_password" id ="txt_password" value="<?php echo $this->input->post('txt_password'); ?>" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span id="Error_password" class="spanError"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!--<div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <!-- <button  class="btn btn-primary btn-block btn-flat">Sign In</button>-->
          <!---<a href="javascript:void(0);" onclick="ValidateLogin()" class="btn btn-primary btn-block btn-flat" id="btn_loginUser" name="btn_loginUser">Sign In
                      </a>-->
          <button class="btn btn-primary btn-block btn-flat" id="btn_loginUser" name="btn_loginUser">Sign In
                      </button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
     <!-- <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <!--<a href="#">I forgot my password</a><br> -->
    <a href="<?php echo base_url().'signup' ?>" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
<script src="<?php echo base_url().'assets/js/bower_components/jquery/dist/jquery.min.js'?>"></script>

<script type="text/javascript">
  
  //function ValidateLogin()
  $("#btn_loginUser").click(function()
  {
    var txt_usename        = $("#txt_usename").val();
    var txt_password        = $("#txt_password").val();

    $(".spanError").html("");
    $(".form-control").removeClass( "Errorborderclass" );

    if(txt_usename == '')
    {
      
      $("#Error_usename").html("Please enter User name");
      $("#txt_usename").addClass( "Errorborderclass" );
      return false;
    }
    
    if(txt_password == '')
    {
      
      $("#Error_password").html("Please enter password");
      $("#txt_password").addClass( "Errorborderclass" );
      return false;
    }
   
    else
    {
      
    }
    $("#form_login").submit();
  });
</script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url().'assets/js/bower_components/bootstrap/dist/js/bootstrap.min.js'?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url().'assets/js/plugins/iCheck/icheck.min.js'?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
