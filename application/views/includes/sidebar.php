
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url().'assets/images/avatar5.png';?>" height="45px;" width="45px;" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('user_name');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Active</a>
        </div>
      </div>
      <!-- search form -->
     <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>

        <li class="active treeview <?php if($this->uri->segment(1) == 'home' ){echo "menu-open" ;}else{}?>">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" <?php if($this->uri->segment(1) == 'home' || $this->uri->segment(2) == 'viewprofile' || $this->uri->segment(2) == 'ViewDoctorProfile' ){}else{echo "style='display:none;'" ;}?>">
            <li class="<?php if($this->uri->segment(1) == 'home' ){ echo 'active';}?>"><a href="<?php echo base_url();?>"><i class="fa fa-circle-o"></i> Home </a></li>

            <?php if($this->session->userdata('user_type') == 1) // 1- Doctor
            {
            ?>
            <li class="<?php if($this->uri->segment(2) == 'ViewDoctorProfile' ){ echo 'active';}?>" ><a href="<?php echo base_url().'Doctor/ViewDoctorProfile'; ?> "><i class="fa fa-circle-o"></i> User Profile </a></li>
            <?php 
            }
            else
            {
            ?>
            <li class="<?php if($this->uri->segment(2) == 'viewprofile' ){ echo 'active';}?>" ><a href="<?php echo base_url().'patients/viewprofile'; ?> "><i class="fa fa-circle-o"></i> User Profile </a></li>
            <?php
            } 
            ?>
          </ul>
        </li>

        <li class="active treeview <?php if($this->uri->segment(2) == 'griddoctor' || $this->uri->segment(2) == 'DoctorDetail' ){echo "menu-open" ;}else{}?>">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Doctor</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"  <?php if( $this->uri->segment(2) == 'griddoctor' || $this->uri->segment(2) == 'DoctorDetail'){}else{echo "style='display:none;'" ;}?>>
            <li class="<?php if($this->uri->segment(2) == 'griddoctor' ){ echo 'active';}?>"><a href="<?php echo base_url().'doctor/griddoctor';?>"><i class="fa fa-circle-o"></i> View Doctors </a></li>
          </ul>
        </li>

        <?php if($this->session->userdata('user_type') == 1) // 1- Doctor
        {
        ?>
        <li class="active treeview <?php if($this->uri->segment(2) == 'ViewAppointment' || $this->uri->segment(2) == 'AppointmentPrescriptionDetail' || $this->uri->segment(2) == 'AppointmentPrescription' ){echo "menu-open" ;}else{}?>">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Appoinments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" <?php if( $this->uri->segment(2) == 'AppointmentPrescriptionDetail' || $this->uri->segment(2) == 'ViewAppointment' || $this->uri->segment(2) == 'AppointmentPrescription'){}else{echo "style='display:none;'" ;}?> >
            <li class="<?php if($this->uri->segment(1) == 'doctor' && $this->uri->segment(2) == 'ViewAppointment' ){ echo 'active';}?>"><a href="<?php echo base_url().'doctor/ViewAppointment';?>"><i class="fa fa-circle-o"></i> View Appoinments </a></li>
            <li class="<?php if($this->uri->segment(1) == 'Patients' && $this->uri->segment(2) == 'ViewAppointment' ){ echo 'active';}?>"><a href="<?php echo base_url().'Patients/ViewAppointment';?>"><i class="fa fa-circle-o"></i> SELF Appoinments </a></li>
          </ul>

        </li>
        <?php
        } 

        if($this->session->userdata('user_type') == 2) // 2 - Patient
        {
        ?>
        <li class="active treeview <?php if($this->uri->segment(2) == 'ViewAppointment' || $this->uri->segment(2) == 'AppointmentPrescriptionDetail'  ){echo "menu-open" ;}else{}?>">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Appoinments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" <?php if($this->uri->segment(2) == 'AppointmentPrescriptionDetail' || $this->uri->segment(2) == 'ViewAppointment'){}else{echo "style='display:none;'" ;}?> >
            <li class="<?php if($this->uri->segment(2) == 'ViewAppointment' ){ echo 'active';}?>"><a href="<?php echo base_url().'Patients/ViewAppointment';?>"><i class="fa fa-circle-o"></i> View Appoinments </a></li>
          </ul>
        </li>
        <?php 
        }
        ?>
        
        <!--
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
       
        
         <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>-->
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
