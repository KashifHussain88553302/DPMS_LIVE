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
<div class="wrapper">

  <?php
  $this->load->view('includes/headbar'); // load the headbar HTML
  ?>

  <?php
  $this->load->view('includes/adminsidebar'); // load the  sidebar HTML
  ?>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Appointments 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Appointments</a></li>
        <li class="active"> ViewAppointments</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Of All Appointments</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <form action="" method="post" id="form_search_dotor">
              <div class="row">
                <!--<div class="col-sm-6">
                  <div class="dataTables_length" id="example1_length">
                    <label>
                      Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries
                    </label>
                  </div>
                </div>-->
                <div class="col-sm-12">
                  <!--<div id="example1_filter" class="dataTables_filter" style="float:left;margin-right: 10px;">
                    <label>
                      <input style="height: 33px;" type="search" name="txt_name" id="txt_name" class="form-control input-sm" placeholder="Enter Name" aria-controls="example1">
                    </label>
                  </div>-->
                  <!-- time Picker
                <div class="bootstrap-timepicker">
                  <div class="form-group"> -->
                  <!-- Div Date Range picker --> 

                  <?php
                    $sel_doctor = $this->input->post('sel_doctor');
                  ?>
                  <div class="" style="width:15%;float: left;margin-right: 10px;">
                    <select class="form-control select2" name="sel_doctor" id="sel_doctor" style="">
                      <option value="0">All Doctors</option>
                      <?php 
                      foreach($Memberdoctors as $Memberdoctor)
                      {

                      ?>
                        <option value="<?=$Memberdoctor['user_id'] ?>" <?php if($sel_doctor == $Memberdoctor['user_id']){ echo "selected" ;} ?>><?php echo $Memberdoctor['user_fname'].' '.$Memberdoctor['user_lname']; ?></option>
                      <?php 
                      }
                      ?>
                    </select>
                  </div>

                  <?php
                    $sel_patient = $this->input->post('sel_patient');
                  ?>
                  <div class="" style="width:15%;float: left;margin-right: 10px;" >
                    <select class="form-control select2" name="sel_patient" id="sel_patient" style="">
                      <option value="0">All Patients</option>
                      <?php 
                      foreach($Memberpatients as $Memberpatient)
                      {

                      ?>
                        <option value="<?=$Memberpatient['user_id'] ?>" <?php if($sel_patient == $Memberpatient['user_id']){ echo "selected" ;} ?>><?php echo $Memberpatient['user_fname'].' '.$Memberpatient['user_lname']; ?></option>
                      <?php 
                      }
                      ?>
                    </select>
                  </div>

                  <?php
                  $sel_status = $this->input->post('sel_status');
                  //echo $sel_doctor_category ; die("hello");
                  ?>

                <div class="col-md-2">
                  <!-- select -->
                  <div class="form-group">

                    <select class="form-control" name="sel_status" id="sel_status">
                      <option value="0">All Status</option>
                    <?php 
                        foreach($AppointmentStatus as $Status)
                        {
                        ?>
                          <option value="<?=$Status['Custom_Field_Value_ID'] ?>" <?php if($sel_status == $Status['Custom_Field_Value_ID']){ echo "selected" ;}  ?>><?php echo $Status['Custom_Field_value_name']; ?></option>
                        <?php 
                        }
                        ?>

                    </select>
                  </div>
                </div>
                     <?php 
                 
            $appointment_date_from     = $this->input->post('appointment_date_from');
          

          
          ?>
                <div class="col-md-3">
                <span style="float: left;">From: </span>
                  <div class="input-group date" style="margin-left:6%;width:156px;float: left;">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" style="margin-left:10px;" name="appointment_date_from" id="appointment_date_from" value="<?=$appointment_date_from ?>" class="form-control pull-right" >
                  </div>
                </div>
                     <?php

            $appointment_date_to     = $this->input->post('appointment_date_to');
          
                ?>
                <div class="col-md-3">
                <span style="float: left;">To: </span>
                  <div class="input-group date" style="margin-left:6%;width:156px;float: left;">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" style="margin-left:10px;" name="appointment_date_to" value="<?=$appointment_date_to ?>"  id="appointment_date_to" class="form-control pull-right" >
                  </div>
                 </div>
                  <!-- End div date range picker --> 
                </div>
              </div>
                <div class="row">
             
                <?php 
                 
            $appointment_Time_start     = $this->input->post('appointment_Time_start');
          
        ?>
                <div class="col-md-2">
                <span style="float: left;"></span>
                  <!-- Start time range picker -->
                  <div class="bootstrap-timepicker">
                    <div class="input-group " style="width:80%;">
                      <!--<label>Time picker:</label>-->
                      <input type="text" style="margin-left:10px;" id="appointment_Time_start" value="<?=$appointment_Time_start ?>"  name="appointment_Time_start" class="form-control timepicker">

                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                    </div>
                  </div>
                  <!-- END Time picker-->
                </div>

              <?php 
                 
            $appointment_Time_to     = $this->input->post('appointment_Time_to');
          
        ?>

                <div class="col-md-2">
                <span style="float: left;">And </span>
                  <div class="bootstrap-timepicker">
                    <div class="input-group " style="width:80%;">
                      <!--<label>Time picker:</label>-->
                      <input type="text" style="margin-left:10px;" id="appointment_Time_to" value="<?=$appointment_Time_to ?>" name="appointment_Time_to" class="form-control timepicker">

                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                    </div>
                  </div>

                </div>

                  
                  <!-- END Time picker-->

                    <!-- Date -->
              <!--<div class="form-group">
                <label>Date:</label>
-->
                
                <!-- /.input group 
              </div>-->
                    <!-- /.input group 
                  </div>-->
                  <!-- /.form group
                </div> -->

                  <button type="submit" style="height:33px;" name="btn_search" class="btn btn-sm btn-info btn-flat pull-left">Search</button>
                </div>
              </div>
              
            </form>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Patient Name</th>
                  <th>Doctor Name</th>
                  <th>Day</th>
                  <th>Time</th>
                  <th style="width:30%;">Description</th>
                  <th>Status</th>

                  <!---<th>Action</th>-->
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($Appointments as $Appointment)
                {
                  $appointment_date = $Appointment['appointment_date'];
                  $Formated_appointment_date = date('D d M, Y ', strtotime($appointment_date));

                  $appointment_time = $Appointment['appointment_time'];
                  $Formated_appointment_Time = date('H:i A', strtotime($appointment_time));
                ?>
                <tr>
                  <td><?=$Appointment['appointment_id'] ;?></td>
                  <td>
                    <?=$Appointment['Appointment_patient_name'] ?>
                  </td>
                  <td>
                  <?=$Appointment['Appointment_doctor_name'] ?>
                  </td>
                  <td>
                    <?=$Formated_appointment_date ?>
                  </td>
                  <td><?=$Formated_appointment_Time?></td>
                  <td><?=$Appointment['appointment_description'] ?></td>
                  <td><?=$Appointment['appointment_status_name'] ?></td>
                 
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
    $('#appointment_date_from').datepicker({
      autoclose: true
    })

     //Date picker
    $('#appointment_date_to').datepicker({
      autoclose: true
    })

     //Timepicker
    $('#appointment_Time_start').timepicker({
      showInputs: false
    })

     //Timepicker
    $('#appointment_Time_to').timepicker({
      showInputs: false
    })
  })

  function funChangeAppointmentStatus(appointment_id , appointment_status_id , CancelAppointment)
  {
      if(confirm("Are you sure you want to approve this Appointment?"))
      {
          $.ajax(
         {
          url:BaseUrlSite+'appointment/UpdateAppointmentStatus',
          data:{
              isAjaxCall    :'true',
              appointment_id: appointment_id,
              appointment_status_id : appointment_status_id,
              CancelAppointment : CancelAppointment
            },
            type:'POST',
            success:function(data)
            {
              
              location.reload();
            } 
        });
      }
  }

   
</script>