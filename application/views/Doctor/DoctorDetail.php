<?php
$sel_doctor_category = ''; 
?>


<?php
$this->load->view('includes/header.php'); // load the header HTML 
?>
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/select2/dist/css/select2.min.css';?>">

<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css';?>">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';?>"> 
<link rel="stylesheet" href="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.css';?>">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>

<?php 
    foreach($DoctorInfo as $Doctor)
  {
    $First_name = $Doctor['user_fname'];
    $Last_name =$Doctor['user_lname'];
    $NAME = $First_name . ' '. $Last_name;
    $user_category_name =$Doctor['user_category_name'];
    $Email = $Doctor['user_email'];
    $phoneNo = $Doctor['user_ph_no'];
    $country = $Doctor['user_fname'];
    $user_city_name =$Doctor['user_city_name']; //echo $city;die("j");
    $location =$Doctor['user_location'];
    $cnic = $Doctor['user_cnic'];
    $user_type_name = $Doctor['user_type_name'];
    $doctor_description = $Doctor['doctor_description'];
    
  }

?>
<div class="wrapper">

	<?php
	$this->load->view('includes/headbar'); // load the headbar HTML
	?>

	<?php
	$this->load->view('includes/sidebar'); // load the  sidebar HTML
	?>

	 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Doctor
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Doctor</a></li>
        <li class="active"></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="modal fade" id="modal-default">
           <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="register-box-body">
                        <h3 class="login-box-msg" id="myModalLabel">Make An Appointment</h3>
                        <form action="http://localhost:9000/add_patient_appointment/" method="post">
                            <input type="hidden" id="hdn_doctor_id" value="<?=$Doctor_id?>">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5 form-group has-feedback">
                                Patient Name
                                    <input type="text" disabled="" class="form-control" name="first_name" pattern="[A-Za-z0-9]*" title="only alpha numeric characters allowed" placeholder="First Name" value="<?php echo $this->session->userdata('user_name');?>" id="first_name" required="">
                                </div>
                                <div class="col-md-5 form-group has-feedback">
                                    Select Date
                                    <!-- Start time range picker -->
                                    <input type="text" disabled="" class="form-control" name="first_name" pattern="[A-Za-z0-9]*" title="only alpha numeric characters allowed" placeholder="First Name" id="first_name" required="">
                  <!-- END Time picker-->
                                    <!--<input type="text" class="form-control" name="last_name" pattern="[A-Za-z0-9]*" id="last_name" title="only alpha numeric characters allowed" placeholder="Last Name">
                                --></div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5 form-group has-feedback">
                                SELECT DATE
                                   <div class="input-group date" style="">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" style="" onchange="functiongetDoctorDayPlanDetailInfo(<?=$Doctor_id?>)" class="form-control pull-right" id="datepicker">
                                    </div>

                                    <script type="text/javascript">
                                        function functiongetDoctorDayPlanDetailInfo(Doctor_id)
                                        {
                                          $("#error").html("");
                                            
                                            var datepicker =  $("#datepicker").val();
                                            $.ajax(
                                             {
                                              url:BaseUrlSite+'doctor/getDoctorDayPlanDetailInfo',
                                              data:{
                                                  isAjaxCall    :'true',
                                                  datepicker: datepicker,
                                                  Doctor_id:Doctor_id,
                                                  Isajaxcall : 1
                                                },
                                                type:'POST',
                                                success:function(data)
                                                {
                                                  $("#div_DoctorDayPlanDetailInfo").html(data);
                                                  
                                                 // loading('end');  
                                                } 
                                            });
                                        }
                                    </script>
                                  <!--    <input type="email" class="form-control" id="email" onblur="check_email()" name="email" placeholder="Email" required="">
                                  --></div>
                                <div class="col-md-5 form-group has-feedback">
                                SELECT TIME
                                     <div class="bootstrap-timepicker">
                                      <div class="input-group " style="">
                                        <!--<label>Time picker:</label>-->
                                        <input type="text" style="" id="AppointmentTime"  class="form-control timepicker">

                                        <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                        </div>
                                      </div>
                                    </div>
                                   <!-- <input type="text" class="form-control" name="file_no" pattern="[A-Za-z0-9]*" title="only alpha numeric characters allowed" placeholder="File#" id="file_no">
                               --> </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="row">
                              <div class="col-md-1"></div>
                              <div class="col-md-10 has-feedback">
                                <textarea class="form-control" rows="3" id="textAppointmentDescription"  placeholder="Enter symtoms/ Description"></textarea>
                              </div>
                              <div class="col-md-1"></div>
                            </div>
                            <div class="row"  style="margin-top: 10px;">
                              
                            </div>
                            <div class="row" id="div_DoctorDayPlanDetailInfo">
                            
                              </div>
                            <!--<div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5 has-feedback">
                                    <input type="text" value="pt" hidden="" name="user_type">
                                    <div class="form-group has-feedback">
                                        <select class="form-control select_field_class appointment_type select2-hidden-accessible" type="text" multiple="" id="appointment_type" name="appointment_type" tabindex="-1" aria-hidden="true">
                                            
                                                <option value="1">
                                                    Regular
                                                </option>
                                            
                                        </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Appointment Type" style="width: 0px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="col-md-5 form-group has-feedback">
                                    <div class="form-group">
                                        <div>
                                            <label for="item_type" class="employe_student ">Employee</label>
                                            <label for="item_type">Student</label>
                                        </div>
                                        <div class="employe_student">
                                            <input type="radio" name="patient_type" value="employee">
                                            <input type="radio" name="patient_type" id="student" checked="" value="student" style="margin-left: 70px !important;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>-->
                            <span style="color: red;" id="error"></span>
                            <span style="color: red;" id="email_error"></span>
                            <div class="row">
                               <div class="col-md-11">
                                   <button type="button"  onclick="funvalidateAppointment()" id="btn_bookAppointment" onclick="" class="btn btn-primary
                                   btn-flat pull-right">Make an appointment</button>
                               </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        </div>
        <!-- /.modal -->

      <div class="row" style="padding-top: 30px">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="row">
                            

                                <div class="col-md-12 header_padding">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-aqua-active">
                                            <h3 class="widget-user-username"><?=$NAME ?></h3>
                                            <p></p>
                                            <p><?=$user_type_name ?></p>
                                        </div>
                                        <div class="widget-user-image">
                                            <img class="img-circle" src="<?php echo base_url().'assets/images/avatar5.png';?>" alt="User Avatar">
                                        </div>
                                        <div class="box-footer">
                                            <div class="row">
                                                <div class="col-sm-4 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">PMDC#</h5>
                                                        <span class="description-text">None</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-4 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Category</h5>
                                                        <span class="description-text"><?=$user_category_name ?>
                                                    </span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-4  border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">CNIC</h5>
                                                        <span class="description-text"><?php if($cnic != ""){ echo $cnic ; } else { echo "None"; }?></span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->


                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                    <!-- /.widget-user -->
                                </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="barcode">First Name: </label>
                                        <?=$First_name ?>
                                        
                                    <keeper-lock id="k-qjq8361iz2" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="reference">Last Name: </label><?=$Last_name ?>
                                      
                                    <keeper-lock id="Error_last_name" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                </div>
                            </div>
                             <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="barcode">Category: </label><?=$user_category_name ?>
                                        <!--<select class="form-control select2" name="sel_doctor" id="sel_doctor" style="">
                                             <option value="0">All Doctors</option>
                                        </select>-->
                                    <keeper-lock id="Error_user_name" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="barcode">Phone No: </label><?=$phoneNo ?>

                                        
                                    <keeper-lock id="Error_phoneNo" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                               

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="barcode">Email: </label><?=$Email ?>
                                        
                                    <keeper-lock id="Error_email" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;">sdfsd</keeper-lock></div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="barcode">City: </label><?=$user_city_name ?>
                                        
                                    <keeper-lock id="Error_sel_city" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="description">Location: </label><?=$location ?>
                                        
                                    <keeper-lock id="k-qwru8dfbq7h" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="barcode">CNIC Number: </label><?=$cnic ?>
                                        
                                    <keeper-lock id="k-982izj23ypm" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="reference">Title: </label>
                                    <keeper-lock id="k-zrxgwnt3ts" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="reference">Description: </label>
                                   <?=$doctor_description?>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="text-align: center;">
                                  <button type="button" class="btn btn-success  btn-sm" data-toggle="modal" data-target="#modal-default">
                                  Book Appointment
                                </button>
                                   
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Doctor Day Plan Schedule</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr No</th>
                  <th>Day</th>
                  <th>Status</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach($doctorDayPlan as $DayPlan)
                {
                	$i++;

                	$availability_day = "";

                	$availability_day_no = $DayPlan['availability_day_no'] ;

                	if($availability_day_no == 1)
                	{
                		$availability_day = "Monday";
                	}
                	elseif($availability_day_no == 2)
                	{
                		$availability_day = "Tuesday";
                	}
                	elseif($availability_day_no == 3)
                	{
                		$availability_day = "Wednesday";
                	}
                	elseif($availability_day_no == 4)
                	{
                		$availability_day = "Thursday";
                	}
                	elseif($availability_day_no == 5)
                	{
                		$availability_day = "Friday";
                	}
                	elseif($availability_day_no == 6)
                	{
                		$availability_day = "Saturday";
                	}
                	elseif($availability_day_no == 7)
                	{
                		$availability_day = "Sunday";
                	}

                	$Is_active = $DayPlan['Is_active'];
                	$dayStatus = "";
                	if($Is_active == 1)
                	{
                		$dayStatus = "Available";
                	}
                	else{
                		$dayStatus = "Day Off";
                	}

                	$DocotorDayStartTime = $DayPlan['availability_time_start'];
                	$DocotorDayEndTime = $DayPlan['availability_time_end'];

                	 //date('M j Y g:i A', strtotime('2013-11-15 13:01:02'));

                ?>
                <tr>
                  <td><?=$i ?></td>
                  <td>
                    <?=$availability_day ?>
                  </td>
                  <td>
                    <?=$dayStatus ?>
                  </td>
                  <td><?php 
                    if($Is_active == 1 ){ echo $DocotorDayStartTime; }
                    else
                    {
                      echo "--";
                    }
                    ?>
                    
                  </td>
                  <td><?php 
                    if($Is_active == 1 ){ echo $DocotorDayEndTime; }
                    else
                    {
                      echo "--";
                    }
                    ?>
                    
                  </td>
                  
                </tr>
                <?php 
                }
                ?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->  
    </section>
   </div>


</div>
<!-- ./wrapper -->
<?php
$this->load->view('includes/footer'); // load the footer HTML
?>
<!-- Select2 -->
<script src="<?php echo base_url().'assets/bower_components/select2/dist/js/select2.full.min.js';?>"></script>

<!-- DataTables -->
<script src="<?php echo base_url().'assets/bower_components/datatables.net/js/jquery.dataTables.min.js';?>"></script>
<script src="<?php echo base_url().'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js';?>"></script>
<script src="<?php echo base_url().'assets/bower_components/bootstrap-daterangepicker/daterangepicker.js';?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.js';?>"></script>
<script>
  $(function () {
    $('.select2').select2()
    //$('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      //'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

   

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

     //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })

  function funvalidateAppointment()
  {
    var Doctor_id = $("#hdn_doctor_id").val();
    var AppointmentDate = $("#datepicker").val();
    var AppointmentTime = $("#AppointmentTime").val();
    var AppointmentDescription = $("#textAppointmentDescription").val();
    //AppointmentDescription = AppointmentDescription.trim();

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 

    today = mm + '/' + dd + '/' + yyyy;
    //document.write(today);


    if(Doctor_id == '' || Doctor_id == 0)
    {
      $("#error").html("Invalid Doctor selected");
    }
    else if(AppointmentDate == '')
    {
      $("#error").html("Invalid Appointment date");
    }
    else if(AppointmentDate < today)
    {
      $("#error").html("Appointment date must be greater then current date");
    }
    else if(AppointmentTime == '')
    {
      $("#error").html("Invalid Appointment time");
    }
    else if(AppointmentDescription == "")
    {
      $("#error").html("Please add the Appointment description");
      
    }
    else
    {
       $.ajax(
         {
          url:BaseUrlSite+'appointment/ValidateAndBookAppointment',
          data:{
              isAjaxCall    :'true',
              Doctor_id: Doctor_id,
              AppointmentDate: AppointmentDate,
              AppointmentTime: AppointmentTime,
              AppointmentDescription:AppointmentDescription,
              Isajaxcall : 1
            },
            type:'POST',
            success:function(data)
            {
              if(data=='Success')
              {
                $(location).attr('href', BaseUrlSite+'Patients/ViewAppointment')
              }
              else
              {
                $("#error").html(data);
              }
              
             // loading('end');  
            } 
        });
    }
  }

   
</script>