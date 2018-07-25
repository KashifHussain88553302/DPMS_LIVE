<?php
$this->load->view('includes/header.php'); // load the header HTML 
?>
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
        User Guide
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>User Guide</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    Dashboard
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Home</a> </h3>

                <div class="timeline-body">
                  Here you can see count of all the doctors, patients, appointments and new members.<br>
                  Also you can view the count of Today appointments, Requested Appointments, Approved and Finished Appointments. You can also view the detail by clicking on the link below to get the detail of  the appointments.<br><br>

                  <img style="width:100%;height:100%;" src="<?php echo base_url().'assets/images/doctor_home.png';?>">
                </div>
                </div>
            </li>
            <!-- END timeline item -->

            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">User Profile</a> </h3>

                <div class="timeline-body">
                  Here you can view and edit your profile.
                  You can also update your password by clicking on a link. By clicking on the link you have to give the old password along  with the new password and update.
                  <br>
                  You can also manage you day plan schedule. You can update the day as on or off also you can manage the timing of any day.
                  <br><br>
                  <img style="width:100%;height:100%;" src="<?php echo base_url().'assets/images/doctor_user_profile.png';?>">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    Doctor
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">View Doctors</a></h3>

                <div class="timeline-body">
                    By using this interface you can all doctors register in the system. You can also filter the doctors by name category and city.<br>
                    You can view detail of the doctor by clickin on the link.
                    <br><br>
                    <img style="width:100%;height:100%;" src="<?php echo base_url().'assets/images/doctor_view_doctor.png';?>">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
             <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Doctor Detail and Book appointment.</a></h3>

                <div class="timeline-body">
                    By using this interface you can view detail of the doctor and their time schedule.
                    You can book appointment by clickin on the link.
                    <br><br>
                    By clicking on the link an allied box will open where you have to give the Date  and time of  the appointment along with the deiscription.
                    <br>
                    <span style="color:red;"> Note: you cannot book appointment with the doctor if the doctor is not available at specific date and time also if the doctor has already has an appointment.</span>
                    <br><br>
                    <img style="width:100%;height:100%;" src="<?php echo base_url().'assets/images/doctor_detail.png';?>">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-green">
                    Appointment
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">View Appointments</a></h3>

                <div class="timeline-body">
                    By using this interface you can view all the appointments the patient have made agaist you. 
                    <br>
                    You can also filter appointments by doctor, Appointment status, Date and time.
                    <br>
                    You also have the option approve and cancel the appointment before it is finished.
                    <br>
                    You can also process the appointment on any patient by clicking on the link
                    <br>
                    You can also view the priscription added by the doctor against an appointment by clicking on the link.
                    <br><br>
                    <img style="width:100%;height:100%;" src="<?php echo base_url().'assets/images/doctor_appointment.png';?>">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">SELF Appointments</a></h3>

                <div class="timeline-body">
                    Our application has an extra feature for Doctors: Doctors can also book appointments with other doctors with in the system.
                    By using this interface you can view all the appointments the you have made agaist any doctors. 
                    <br>
                    You can also filter appointments by doctor, Appointment status, Date and time.
                    <br>
                    You also have the option to cancel the appointment before it is finished.
                    <br>
                    You can also view the priscription added by the doctor against an appointment by clicking on the link.
                    <br><br>
                    <img style="width:100%;height:100%;" src="<?php echo base_url().'assets/images/doctor_doctor_appointment.png';?>">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Add priscription</a></h3>

                <div class="timeline-body">
                    By using this interface you can add priscription and vitals of any appointments. 
                    <br><br>
                    <img style="width:100%;height:100%;" src="<?php echo base_url().'assets/images/doctor_addvitals.png';?>">
                    <img style="width:100%;height:100%;" src="<?php echo base_url().'assets/images/doctor_add_priscription.png';?>">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">View priscription</a></h3>

                <div class="timeline-body">
                    By using this interface you can view the detail of medicines, diseases, vitals and priscriptions.
                    <br><br>
                    <img style="width:100%;height:100%;" src="<?php echo base_url().'assets/images/doctor_view_priscription.png';?>">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-video-camera bg-maroon"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">DPMS</a> shared a video for you convenience</h3>

                <div class="timeline-body">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.screencast.com/t/vyLP6mg8sq"
                            frameborder="0" allowfullscreen></iframe>
                  </div>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php
$this->load->view('includes/footer'); // load the footer HTML
?>
<!-- jQuery 3 -->

