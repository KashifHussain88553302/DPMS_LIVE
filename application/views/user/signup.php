<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/bootstrap/dist/css/bootstrap.min.css';?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/font-awesome/css/font-awesome.min.css';?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/Ionicons/css/ionicons.min.css';?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css';?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/iCheck/square/blue.css';?>">

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
  <script type="text/javascript">
    var BaseUrlSite = '<?php echo base_url(); ?>';
  </script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>DPMS</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>
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

    <form class="" method="post" id="form_signup" action="">
      <div class="form-group has-feedback">
        <input type="text" name="txt_first_name" value="<?php echo $this->input->post('txt_first_name'); ?>" id="txt_first_name" class="form-control" placeholder="First Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span id="Error_first_name" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="txt_last_name" value="<?php echo $this->input->post('txt_last_name'); ?>" id="txt_last_name" class="form-control" placeholder="Last Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span id="Error_last_name" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="txt_user_name" value="<?php echo $this->input->post('txt_user_name'); ?>" id="txt_user_name" class="form-control" placeholder="User Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span id="Error_user_name" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" id="txt_email" value="<?php echo $this->input->post('txt_email'); ?>" name="txt_email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span id="Error_txt_email" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        
        <input class="form-control" type="text" id="phoneNo" placeholder="0300-1234567" value="<?php echo $this->input->post('phoneNo'); ?>" minlength="12" name="phoneNo" maxlength="12" data-keeper-lock-id="k-xgx9uyqihi">
        <span class="glyphicon fa-mobile-phone form-control-feedback"></span>
        <span id="Error_phoneNo" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        
        <input class="form-control" type="text" id="txt_cnic" minlength="15" placeholder="00000-0000000-0" value="<?php echo $this->input->post('txt_cnic'); ?>" name="txt_cnic" maxlength="15" data-keeper-lock-id="k-982izj23ypm">
        <span class="glyphicon fa-mobile-phone form-control-feedback"></span>
        <span id="Error_cnic" class="spanError"></span>
      </div>
      
      <div class="form-group has-feedback">
          <select name="sel_city" id="sel_city" class="form-control" required="">
              <option value="0" selected="">Select city</option>
               <?php 
                foreach($cities as $city)
                {
                ?>
                  <option value="<?=$city['Custom_Field_Value_ID'] ?>" <?php if($this->input->post('sel_city') == $city['Custom_Field_Value_ID']){ echo "selected" ;}  ?>><?php echo $city['Custom_Field_value_name']; ?></option>
                <?php 
                }
                ?>
          </select>
          <span class="glyphicon glyphicons-parents form-control-feedback"></span>
          <span id="Error_sel_city" class="spanError"></span>
      </div>
      

      <div class="form-group has-feedback">
          <select name="user_type" id="user_type" onchange="funcHideShowData()" class="form-control" required="">
              <option value="0" selected="">-- Account Type --</option>
               <?php 
                foreach($UserTypes as $UserType)
                {
                ?>
                  <option value="<?=$UserType['Custom_Field_Value_ID'] ?>" <?php if($this->input->post('user_type') == $UserType['Custom_Field_Value_ID']){ echo "selected" ;}  ?>><?php echo $UserType['Custom_Field_value_name']; ?></option>
                <?php 
                }
                ?>
          </select>
          <span class="glyphicon glyphicons-parents form-control-feedback"></span>
          <span id="Error_user_type" class="spanError"></span>
      </div>

      <div class="form-group has-feedback" id="div_sel_doctor_category" style="display:none;">
          <select name="sel_doctor_category"  id="sel_doctor_category" class="form-control" required="">
              <option value="0" selected="">Select category</option>
               <?php 
                foreach($DoctorCategories as $DoctorCategory)
                {
                ?>
                  <option value="<?=$DoctorCategory['Custom_Field_Value_ID'] ?>" <?php if($this->input->post('sel_doctor_category') == $DoctorCategory['Custom_Field_Value_ID']){ echo "selected" ;}  ?>><?php echo $DoctorCategory['Custom_Field_value_name']; ?></option>
                <?php 
                }
                ?>
          </select>
          <span class="glyphicon glyphicons-parents form-control-feedback"></span>
          <span id="Error_sel_doctor_category" class="spanError"></span>
      </div>
      

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span id="Error_password" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="txt_retype_password" id="txt_retype_password" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <span id="Error_retype_password" class="spanError"></span>
      </div>
      <!-- phone mask 
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-phone"></i>
          </div>
          <input type="text" class="form-control" id="txt_ph_no" name="txt_ph_no" data-inputmask='"mask": "+99-999-9999999"' value="<?php echo $this->input->post('txt_ph_no'); ?>" data-mask>
                  </div>
                  <span id="Error_ph_no" class="spanError"></span>

        <!-- /.input group -->
      <!--</div>-->
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button  class="btn btn-primary btn-block btn-flat" id="btn_createUser" name="btn_createUser">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!--<div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>-->

    <a href="<?php echo base_url(); ?> " class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url().'assets/bower_components/jquery/dist/jquery.min.js';?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url().'assets/bower_components/bootstrap/dist/js/bootstrap.min.js';?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js';?>"></script>

<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.date.extensions.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.extensions.js';?>"></script>
<script src="<?php echo base_url().'assets/Profile_files/jquery.mask.js.download';?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

    $('[data-mask]').inputmask()

    $("#phoneNo").mask('0000-0000000');
    $("#cnic").mask('00000-0000000-0');
  });
</script>

<script type="text/javascript">

  function funcHideShowData()
  {
     //alert("hello");
    var user_type = $( "#user_type" ).val();
    if(user_type == 1 )
    {
        $("#div_sel_doctor_category").show();
    }
    else
    {
      $("#div_sel_doctor_category").hide();
    }
  }
  
  //function ValidateSignup()
  $("#btn_createUser").click(function()
  {
    var txt_first_name      = $("#txt_first_name").val();
    var txt_last_name       = $("#txt_last_name").val();
    var txt_user_name       = $("#txt_user_name").val();
    var txt_password        = $("#txt_password").val();
    var txt_retype_password = $("#txt_retype_password").val();
    var phoneNo             = $("#phoneNo").val();
    var txt_cnic             = $("#txt_cnic").val();
    var user_type              = $('#user_type').val();
    var txt_email              = $('#txt_email').val();
    var sel_city              = $('#sel_city').val();
    

    

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

    if(txt_email == "" )
    {
      $("#Error_txt_email").html("Invalid Email");
      $("#txt_email").addClass( "Errorborderclass" );
      return false;
    }
    if(phoneNo == "" || phoneNo.length < 12)
    {
      $("#Error_phoneNo").html("Invalid Phone No");
      $("#phoneNo").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_cnic == "" || txt_cnic.length < 13)
    {
      $("#Error_cnic").html("Invalid CNIC");
      $("#txt_cnic").addClass( "Errorborderclass" );
      return false;
    }
    if(sel_city == "" || sel_city == 0)
    {
      $("#Error_sel_city").html("Select user type");
      $("#sel_city").addClass( "Errorborderclass" );
      return false;
    }
    if(user_type == "" || user_type == 0)
    {
      $("#Error_user_type").html("Select user type");
      $("#user_type").addClass( "Errorborderclass" );
      return false;
    }
    if(user_type == 1 && (sel_doctor_category == "" || sel_doctor_category == 0))
    {
      $("#Error_sel_doctor_category").html("Select category");
      $("#sel_doctor_category").addClass( "Errorborderclass" );
      return false;
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
   // $("#form_signup").submit();
  });
</script>
</body>
</html>
