<?php
$this->load->view('includes/header.php'); // load the header HTML 
?>
<link rel="stylesheet" href="<?php echo base_url().'assets/css/bower_components/jvectormap/jquery-jvectormap.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/AdminLTE.min.css' ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/skins/_all-skins.min.css' ?>">
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
</head>
<body class="hold-transition skin-blue sidebar-mini">
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
        Dashboard
        <small><?php echo $this->session->userdata('user_type_name');?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
if($is_firstTime == 1) 
{
?>
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content" style="width: 160%;left: -32%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Dashboard</h4>
            </div>
            <div class="modal-body" style="height: 500px;">
              <iframe  width="100%" height="100%" src="https://www.screencast.com/t/vyLP6mg8sq" frameborder="0" allowfullscreen ></iframe>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">continue..</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <?php
      } 
      ?>
      <button style="display:none;" id="modal-default_userguide" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                Launch Default Modal
              </button>
      <!-- Info boxes -->
      <div class="row">
      <?php 
        foreach($commonCounts as $Counts)
        {
        ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Registered Doctors</span>
              <span class="info-box-number"><?=$Counts['total_doctors']?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Registered Patients</span>
              <span class="info-box-number"><?=$Counts['total_patients']?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Appointments</span>
              <span class="info-box-number"><?=$Counts['successfull_appointments']?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number"><?=$Counts['total_members']?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <?php
        } 
        ?>
      </div>
      <!-- /.row -->

     <div class="row">
     <?php 
        foreach($commonDoctorCounts as $Counts)
        {
        ?>
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$Counts['Today_appointments']?></h3>

              <p>Today Approved Appointments</p>
            </div>
            <div class="icon">
              <i class="ion  ion-bag "></i>
            </div>
            <a  href="javascript:void(0)" onclick="funcviewAppointmentDetail(appintmentstate='14', IsToday='1')" class="small-box-footer">View detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$Counts['requested_appointments']?></h3>

              <p>Appointment Requests</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="javascript:void(0)" onclick="funcviewAppointmentDetail(appintmentstate='13', IsToday='0')" class="small-box-footer">View detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$Counts['approved_appointments']?></h3>

              <p>Approved Appointments</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="javascript:void(0)" onclick="funcviewAppointmentDetail(appintmentstate='14', IsToday='0')" class="small-box-footer">View detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$Counts['finished_appointments']?></h3>

              <p>Finished Appointments</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="javascript:void(0)" onclick="funcviewAppointmentDetail(appintmentstate='16', IsToday='0')" class="small-box-footer">View detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
      </div>
      <?php 
    }
      ?>
      <!-- /.row -->
    </section>
    <!-- /.content -->
   </div>


</div>
<!-- ./wrapper -->
<?php
$this->load->view('includes/footer'); // load the footer HTML
?>
<script src="<?php echo base_url().'assets/js/bower_components/chart.js/Chart.js'?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url().'assets/js/dist/js/pages/dashboard2.js'?>"></script>
<script src="<?php echo base_url().'assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'?>"></script>
<script src="<?php echo base_url().'assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'?>"></script>
<script type="text/javascript">
<?php
if($is_firstTime == 1) 
{
?>
$(document).ready(function(){
    $("#modal-default_userguide").trigger("click");
});
<?php 
}
?>

      function funcviewAppointmentDetail(Appointmentstatus,IsToday)
      {
        if(IsToday == 0)
        {
          $("#hdn_appointment_date_from").val("");
          $("#hdn_appointment_date_to").val("");
        }
        
        $("#hdn_sel_status").val(Appointmentstatus);
        //var form = "#hdn_get_view_detail";
        $("#hdn_get_view_detail").submit();
      }
</script>

<form method="post" action="<?php echo base_url().'doctor/ViewAppointment'?>" target="_blank" id="hdn_get_view_detail">
    <input type="hidden" name="appointment_date_from" id="hdn_appointment_date_from" value="<?php echo date('m/d/Y'); ?>">
    <input type="hidden" name="appointment_date_to" id="hdn_appointment_date_to" value="<?php echo date('m/d/Y'); ?>">
    <input type="hidden" name="sel_status" id="hdn_sel_status" value="">
    <input type="hidden" name="btn_search" id="btn_search" value="">
</form>
