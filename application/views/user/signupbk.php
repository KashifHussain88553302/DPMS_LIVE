<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DPMS | Log in</title>
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
 <!-- <script src="<?php echo base_url().'assets/js/commonsetting.js'?>"></script>
-->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->

  <style type="text/css">
        .spanError{
          color: #ff0000;
        }
        .Errorborderclass{
          border-color: #ff0000;
        }
  </style>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script type="text/javascript">
    var BaseUrlSite = '<?php echo base_url(); ?>';
  </script>
</head>
<body class="">
<div class="">
  <div class="login-logo">
    <a href="../../index2.html"><b>DPMS</b></a>
  </div>
  <!-- /.login-logo -->
    <div class="col-md-9">
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
        ?>
        
          <div class="nav-tabs-custom">
           
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
              <!-- Start signup form -->
                <form class="form-horizontal" method="post" id="form_signup" action="">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">First Name</label>
                      <div class="col-sm-10">
                      <input type="text" class="form-control" name="txt_first_name" id="txt_first_name" placeholder="First Name" value="<?php echo $this->input->post('txt_first_name'); ?>">
                      <span id="Error_first_name" class="spanError"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="txt_last_name" id="txt_last_name" placeholder="Last Name" value="<?php echo $this->input->post('txt_last_name'); ?>">
                      <span id="Error_last_name" class="spanError"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">User Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="txt_user_name" id="txt_user_name" placeholder="User Name" value="<?php echo $this->input->post('txt_user_name'); ?>">
                      <span id="Error_user_name" class="spanError"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Password">
                      <span id="Error_password" class="spanError"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Retype Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="txt_retype_password" id="txt_retype_password" placeholder="Retype Password" >

                      <span id="Error_retype_password" class="spanError"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Ph no</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txt_ph_no" name="txt_ph_no" placeholder="Phone no" value="<?php echo $this->input->post('txt_ph_no'); ?>">
                      <span id="Error_ph_no" class="spanError"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                    <!---<a href="javascript:void(0);" onclick="ValidateSignup();" class="btn btn-danger" id="btn_createUser" name="btn_createUser">Submit
                      </a>-->
                      <button type="button" class="btn btn-danger" id="btn_createUser" name="btn_createUser">Submit
                      </button>
              
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
<script src="<?php echo base_url().'assets/js/bower_components/jquery/dist/jquery.min.js'?>"></script>
<!-- Bootstrap 3.3.7 -->
<script type="text/javascript">
  
  //function ValidateSignup()
  $("#btn_createUser").click(function()
  {
    var txt_first_name      = $("#txt_first_name").val();
    var txt_last_name       = $("#txt_last_name").val();
    var txt_user_name       = $("#txt_user_name").val();
    var txt_password        = $("#txt_password").val();
    var txt_retype_password = $("#txt_retype_password").val();
    var txt_ph_no           = $("#txt_ph_no").val();

    $(".spanError").html("");
    $(".form-control").removeClass( "Errorborderclass" );

    if(txt_first_name == '')
    {
      
      $("#Error_first_name").html("Please enter first name");
      $("#txt_first_name").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_last_name == '')
    {
      
      $("#Error_last_name").html("Please enter last name");
      $("#txt_last_name").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_user_name == '')
    {
      
      $("#Error_user_name").html("Please enter username");
      $("#txt_user_name").addClass( "Errorborderclass" );
      return false;
    }
    if( txt_user_name != '')
    {
      //loading('start');  
        $.ajax(
         {
          url:BaseUrlSite+'signup/IsUserNameAlreadyExist',
          data:{
              isAjaxCall    :'true',
              txt_user_name: txt_user_name,
              Isajaxcall : 1
            },
            type:'POST',
            success:function(data)
            {
              if(data=='Already Exist')
              {
                $("#Error_user_name").html("This user name already exist");
                $("#txt_user_name").addClass( "Errorborderclass" );
                return false;
              }
              
             // loading('end');  
            } 
        });
      }
    if(txt_password == '')
    {
      
      $("#Error_password").html("Please enter password");
      $("#txt_password").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_password.length < 8)
    {
      $("#Error_password").html("Pasword must be atleast 8 characters");
      $("#txt_password").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_retype_password == '')
    {
      $("#Error_retype_password").html("Please retype password");
      $("#txt_retype_password").addClass( "Errorborderclass" );
      return false;
    }

    if(txt_retype_password != txt_password)
    {
      $("#Error_retype_password").html("Password not match");
      $("#txt_retype_password").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_ph_no == '')
    {
      
      $("#Error_ph_no").html("Please enter phone no");
      $("#txt_ph_no").addClass( "Errorborderclass" );
      return false;
    }
    else
    {
      
    }
    $("#form_signup").submit();
  });
</script>

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
