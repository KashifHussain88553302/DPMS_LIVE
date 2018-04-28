
<?php
$this->load->view('includes/header.php'); // load the header HTML 
?>

    <link rel="stylesheet" href="<?php echo base_url().'assets/Profile_files/bootstrap.min.css';?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/Profile_files/font-awesome.min.css';?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/Profile_files/ionicons.min.css';?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/Profile_files/AdminLTE.min.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/Profile_files/_all-skins.min.css';?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/Profile_files/blue.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/Profile_files/custom.css';?>">

    <link rel="stylesheet" href="<?php echo base_url().'assets/Profile_files/alert.css';?>">


      <!-- iCheck for checkboxes and radio inputs -->
      <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/iCheck/all.css';?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.m
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?php echo base_url().'assets/Profile_files/css';?>">
    
    <link rel="stylesheet" href="<?php echo base_url().'assets/Profile_files/select2.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.css';?>">
    <style type="text/css">
        .spanError{
          color: #ff0000;
        }
        .Errorborderclass{
          border-color: #ff0000;
        }
  </style>
    <style>

        .col-sm-3 {
            width: 300px !important;
        }

        .employe_student {
            margin-right: 20px;
            margin-left: 20px;
        }

        .main_form {
            padding-bottom: 40px;
        }

        .first_name_design {
            margin-right: 8px;
        }
        .header_padding{
                padding-right: 35px;
        }
    </style>

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


 <?php 

 $First_name = "";
 $Last_name = "";
 $user_uname ="";
 $Email = "";
 $phoneNo = "";
 $country = "";
 $ciity ="";
 $location ="";
 $cnic = "";
 $NAME = "" ;
 $category = "";
 $user_category_name = "";
 $Description = "";

  foreach($DoctorInfo as $Doctor)
  {
    $First_name     = $Doctor['user_fname'];
    $Last_name      =$Doctor['user_lname'];
    $NAME           = $First_name . ' '. $Last_name;
    $user_uname     =$Doctor['user_uname'];
    $Email          = $Doctor['user_email'];
    $phoneNo        = $Doctor['user_ph_no'];
    $country        = $Doctor['user_fname'];
    $ciity          =$Doctor['user_city']; //echo $city;die("j");
    $city_name      = $Doctor['user_city_name'];
    $location       =$Doctor['user_location'];
    $cnic           = $Doctor['user_cnic'];
    $category        = $Doctor['user_category_id'];
    $Description        = $Doctor['doctor_description'];
    $user_category_name        = $Doctor['user_category_name'];
    
    //echo $category ; exit();
  }

  ?>

<body class="sidebar-collapse base_page skin-blue sidebar-mini" style="height: auto; min-height: 100%;" data-gr-c-s-loaded="true">
<div class="">
    <div class="notifcontainer row">
    </div>
    
    
    <div class="wrapper" style="height: auto; min-height: 100%;">
        
    <?php
    $this->load->view('includes/headbar'); // load the headbar HTML
    ?>


    <?php
    $this->load->view('includes/sidebar'); // load the  sidebar HTML
    ?>
     


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 548px;">


            <!-- Content Header (Page header) -->
           
            <form class="form-horizontal main_form" method="post" action="" id="form_doctor_update_profile">
                <input type="hidden" name="csrfmiddlewaretoken" value="AAUrkppWRN9sr0akDQNJTl1Mg6lFg9uXSzZNEF0ZySvxzKXqDli7sDPdZrhwGdEV">

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
                                            <p><?php echo $this->session->userdata('user_type_name');?></p>
                                        </div>
                                        <div class="widget-user-image">
                                            <img class="img-circle" src="<?php echo base_url().'assets/images/avatar5.png';?>" alt="User Avatar">
                                        </div>
                                        <div class="box-footer">
                                            <div class="row">
                                                <div class="col-sm-3 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">PMDC#</h5>
                                                        <span class="description-text">None</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-3 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Category</h5>
                                                        <span class="description-text"><?=$user_category_name?>
                                                    </span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-3  border-right">
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
                                    <div class="col-sm-3 " id="txt_first_name">
                                        <label for="barcode">First Name</label>

                                        <input class="form-control" type="text" id="first_name" value="<?=$First_name ?>" placeholder="" name="first_name" data-keeper-lock-id="k-qjq8361iz2">
                                    <span class="spanError" id="Error_first_name" ></span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="reference">Last Name</label>
                                        <input class="form-control" type="text" id="last_name" value="<?=$Last_name ?>" name="last_name" data-keeper-lock-id="k-6omqq6ok9pb">
                                    <span class="spanError" id="Error_last_name" ></span>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="barcode">User Name</label>
                                        <!--<select class="form-control select2" name="sel_doctor" id="sel_doctor" style="">
                                             <option value="0">All Doctors</option>
                                        </select>-->
                                        <input class="form-control" type="text" id="user_name" placeholder="" value="<?=$user_uname ?>" disabled name="user_name" data-keeper-lock-id="k-21416jtfr4l">
                                        <span class="spanError" id="Error_user_name" ></span>
                                    </div>
                                </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="barcode">Phone No</label>

                                        <input class="form-control" type="text" id="phoneNo" placeholder="0300-1234567" value="<?=$phoneNo ?>" minlength="12" name="phoneNo" maxlength="12" data-keeper-lock-id="k-xgx9uyqihi">
                                    <span class="spanError" id="Error_phoneNo" ></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                               

                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="barcode">Email</label>
                                        <!--<select class="form-control select2" name="sel_doctor" id="sel_doctor" style="">
                                             <option value="0">All Doctors</option>
                                        </select>-->
                                        <input class="form-control" type="text" id="email" placeholder="" value="<?=$Email ?>" name="email" data-keeper-lock-id="k-21416jtfr4l">
                                    <span class="spanError" id="Error_email" ></span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="barcode">City</label>
                                        <select class="form-control select2" name="sel_city" id="sel_city" style="">
                                             <?php 
                                              foreach($cities as $city)
                                              {
                                              ?>
                                                <option value="<?=$city['Custom_Field_Value_ID'] ?>" <?php if($ciity == $city['Custom_Field_Value_ID']){ echo "selected" ;}  ?>><?php echo $city['Custom_Field_value_name']; ?></option>
                                              <?php 
                                              }
                                              ?>
                                        </select>
                                        <!--<input class="form-control" type="text" id="city" name="city" data-keeper-lock-id="k-25balhnfte3">-->
                                    <span class="spanError" id="Error_sel_city" ></span>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="description">Location</label>
                                        <input class="form-control" type="text" id="location" name="location" value="<?=$location ?>" data-keeper-lock-id="k-qwru8dfbq7h">
                                    <keeper-lock id="k-qwru8dfbq7h" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="barcode">CNIC Number</label>
                                        <input class="form-control" type="text" id="cnic" minlength="15" placeholder="00000-0000000-0" value="<?=$cnic ?>" name="cnic" maxlength="15" data-keeper-lock-id="k-982izj23ypm">
                                    <span class="spanError" id="Error_cnic" ></span>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="barcode">Categories</label>
                                        <select class="form-control select2" name="sel_category" id="sel_category" style="">
                                            <option value="0">Select Category</option>
                                             <?php 
                                              foreach($Doctorscategories as $categoryy)
                                              {
                                              ?>
                                                <option value="<?=$categoryy['Custom_Field_Value_ID'] ?>" <?php if($category == $categoryy['Custom_Field_Value_ID']){ echo "selected" ;}  ?>><?php echo $categoryy['Custom_Field_value_name']; ?></option>
                                              <?php 
                                              }
                                              ?>
                                        </select>
                                        <!--<input class="form-control" type="text" id="city" name="city" data-keeper-lock-id="k-25balhnfte3">-->
                                    <span class="spanError" id="Error_sel_category" ></span>
                                   </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="description">Decription</label>
                                        <textarea class="form-control" id="txt_description" name="txt_description" rows="3" placeholder="Enter Description"><?=$Description?></textarea></div>
                                        <span class="spanError" id="Error_txt_description" ></span>
                                </div>
                            </div>
                            
                           
                        </div>
                        <!--
                        <div class="row">
                            

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="PMDC_no">PMDC No.</label>
                                            <input class="form-control" type="text" id="PMDC_no" name="pmdc_no" data-keeper-lock-id="k-46mip6m5jlx">
                                        <keeper-lock id="k-46mip6m5jlx" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="product_name">Home Address</label>
                                            <input class="form-control" type="text" id="home_address" name="home_address" data-keeper-lock-id="k-8guiqeeh2l5">
                                        <keeper-lock id="k-8guiqeeh2l5" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="sub_type_data">Work Address</label>
                                            <input class="form-control" type="text" id="work_address" name="work_address" data-keeper-lock-id="k-ruft6bjv9o">
                                        <keeper-lock id="k-ruft6bjv9o" style="filter: grayscale(100%); top: 34px; left: 257px; z-index: 1; visibility: hidden;"></keeper-lock></div>
                                    </div>
                                </div>
                            

                        </div>
                        
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="speciality">Assign Clinic</label>
                                            <select class="form-control select_field_class select2-hidden-accessible" multiple="" id="clinic" name="clinic" tabindex="-1" aria-hidden="true">
                                                
                                                    <option value="1" selected="">CL-0001
                                                        | Akbar chowk</option>
                                                
                                                    <option value="2" selected="">CL-0002
                                                        | Nishat Colony</option>
                                                
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 270px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="CL-0001
                                                        | Akbar chowk"><span class="select2-selection__choice__remove" role="presentation">×</span>CL-0001
                                                        | Akbar chowk</li><li class="select2-selection__choice" title="CL-0002
                                                        | Nishat Colony"><span class="select2-selection__choice__remove" role="presentation">×</span>CL-0002
                                                        | Nishat Colony</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="off_days">Off Days</label>
                                            <select class="form-control select_field_class select2-hidden-accessible" multiple="" type="text" id="off_days" name="off_days" tabindex="-1" aria-hidden="true">
                                                <option value="">----- Please Select -----</option>
                                                <option value="1"> Monday
                                                </option>
                                                <option value="2">Tuesday
                                                </option>
                                                <option value="3">Wednesday
                                                </option>
                                                <option value="4">Thurstday
                                                </option>
                                                <option value="5">Friday
                                                </option>
                                                <option value="6">Saturday
                                                </option>
                                                <option value="7">Sunday
                                                </option>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 270px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Select here" style="width: 268px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="speciality">Speciality</label>
                                            <select class="form-control select_field_class select2-hidden-accessible" type="text" multiple="" id="speciality" name="speciality" tabindex="-1" aria-hidden="true">
                                                

                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 270px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Select here" style="width: 268px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>-->

                       <input type="hidden"  id="hdn_submit_button" name="hdn_submit_button" value="hdn_submit_button">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="margin-left:0px">
                                    <button  type="button" onclick="functionValidateForm()" class="btn btn-success  btn-sm" id="submit_button" name="submit_button" value="submit_button">
                                        Update
                                        profile
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-8">
                        <div class=" col-sm-10 "></div>
                    </div>
                </div>
        <?php 
        if($this->session->userdata('user_type') == 1) // 1- Doctor
        {
        ?>
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
                  <th style="width:20%;">Start Time</th>
                  <th style="width:20%;">End Time</th>
                  <th>Action</th>
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
                    $doctor_day_plan_id = $DayPlan['doctor_day_plan_id'] ;

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
                    
                        <input onclick="funchideshowTimepickers(<?=$doctor_day_plan_id?> , 1)" type="radio" <?php if($Is_active == 1 ) { echo 'checked=""';} ?> id="day_status_on_<?=$doctor_day_plan_id?>" value="1"  name="day_status_<?=$availability_day_no?>" > on  
                        <input onclick="funchideshowTimepickers(<?=$doctor_day_plan_id?> , 0)" type="radio" <?php if($Is_active == 0 ) { echo 'checked=""';} ?> id="day_status_off_<?=$doctor_day_plan_id?>" value="0"  name="day_status_<?=$availability_day_no?>" > off
                  </td>
                  <td>
                  <?php
                    $FormatedDocotorDayStartTime = date('h:i A', strtotime($DocotorDayStartTime));

                
                ?>

                <div class="bootstrap-timepicker" id="div_DoctorDayStartTime_<?=$doctor_day_plan_id?>" <?php if($Is_active == 0 ){ echo "style='display:none;'" ; } ?>>
                    <div class="input-group " style="width:80%;">
                      <!--<label>Time picker:</label>-->
                      <input type="text" style="margin-left:10px;"  id="DoctorDayStartTime_<?=$doctor_day_plan_id?>" value="<?=$FormatedDocotorDayStartTime ?>" name="DoctorDayStartTime_<?=$doctor_day_plan_id?>" class="form-control timepicker">
                        <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                    </div>
                  </div>
                  
                    <span  id="span_emptystarttime_<?=$doctor_day_plan_id?>" <?php if($Is_active == 1 ){ echo "style='display:none;'" ; } ?> >--</span>
                    <?php 
                
                   /* if($Is_active == 1 ){ echo $DocotorDayStartTime; }
                    else
                    {
                      echo "--";
                    }*/
                    ?>
                    
                  </td>
                  <td>
                     <?php
                    $FormatedDocotorDayEndTime = date('h:i A', strtotime($DocotorDayEndTime));
?>
                     <div class="bootstrap-timepicker" id="div_DoctorDayEndTime_<?=$doctor_day_plan_id?>"  <?php if($Is_active == 0 ){ echo "style='display:none;'" ; } ?>>
                        <div class="input-group " style="width:80%;">
                          <!--<label>Time picker:</label>-->
                          <input type="text" style="margin-left:10px;" id="DoctorDayEndTime_<?=$doctor_day_plan_id?>" value="<?=$FormatedDocotorDayEndTime ?>" name="DoctorDayEndTime_<?=$doctor_day_plan_id?>" class="form-control timepicker">
                        <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                        </div>
                      </div>

                      <span  id="span_emptyendtime_<?=$doctor_day_plan_id?>" <?php if($Is_active == 1 ){ echo "style='display:none;'" ; } ?> >--</span>

                        
                  <?php 
                   /* if($Is_active == 1 ){ echo $DocotorDayEndTime; }
                    else
                    {
                      echo "--";
                    }*/
                    ?>
                    
                  </td>
                  <td>
                        
                        <button type="button" onclick="functionupdateDAySchedule(<?=$doctor_day_plan_id?>)" class="btn bg-purple btn-flat margin" >update</button>
                  </td>
                  
                </tr>
                <?php 
                }
                ?>
                </tfoot>
              </table>
            </div>
            <script type="text/javascript">
                function functionupdateDAySchedule(doctor_day_plan_id)
                {
                    
                     var day_status = $("input[name='day_status_"+doctor_day_plan_id+"']:checked").val();
                    var DoctorDayStartTime =  $("#DoctorDayStartTime_"+doctor_day_plan_id).val();
                    var DoctorDayEndTime =  $("#DoctorDayEndTime_"+doctor_day_plan_id).val();
                    $.ajax(
                     {
                      url:BaseUrlSite+'doctor/UpdateDoctorDayPlan',
                      data:{
                          isAjaxCall    :'true',
                          doctor_day_plan_id: doctor_day_plan_id,
                          day_status:day_status,
                          DoctorDayStartTime:DoctorDayStartTime,
                          DoctorDayEndTime:DoctorDayEndTime,
                          Isajaxcall : 1
                        },
                        type:'POST',
                        success:function(data)
                        {
                          location.reload();
                          
                         // loading('end');  
                        } 
                    });
                }

                function funchideshowTimepickers(doctor_day_plan_id , val)
                {
                    if(val== 1)
                    {
                        $("#div_DoctorDayStartTime_"+doctor_day_plan_id).show();
                        $("#div_DoctorDayEndTime_"+doctor_day_plan_id).show();
                        $("#span_emptystarttime_"+doctor_day_plan_id).hide();
                        $("#span_emptyendtime_"+doctor_day_plan_id).hide();
                    }
                    else
                    {
                        $("#div_DoctorDayStartTime_"+doctor_day_plan_id).hide();
                        $("#div_DoctorDayEndTime_"+doctor_day_plan_id).hide();
                        $("#span_emptystarttime_"+doctor_day_plan_id).show();
                        $("#span_emptyendtime_"+doctor_day_plan_id).show();
                    }
                }
            </script>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->  
      <?php
      } 
      ?>
            </form>

        </div>
        <!-- /.content -->
        <!-- /.content-wrapper -->
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

</div>

<?php
//$this->load->view('includes/footer'); // load the footer HTML
?>
<script src="<?php echo base_url().'assets/Profile_files/jquery.min.js.download';?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url().'assets/Profile_files/bootstrap.min.js.download';?>"></script>
<script src="<?php echo base_url().'assets/Profile_files/fastclick.js.download';?>"></script>

<script src="<?php echo base_url().'assets/Profile_files/adminlte.js.download';?>"></script>
<script src="<?php echo base_url().'assets/Profile_files/demo.js.download';?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url().'assets/Profile_files/icheck.min.js.download';?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/Profile_files/alert.js.download';?>"></script>

<script src="<?php echo base_url().'assets/Profile_files/jquery.slimscroll.min.js.download';?>"></script>
<script src="<?php echo base_url().'assets/Profile_files/custom.js.download';?>"></script>
<script src="<?php echo base_url().'assets/Profile_files/modals-bootstrap.js.download';?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js';?>"></script>

<script>
    $(document).ready(function () {
        $('.mmsg').trigger("click");

    });
    $("#home_li").trigger("click");
    $('#appointment_scroll').slimScroll({
        height: '250px'
    });

    // Delete confirm dialog box
    function call_confirm_dialog(callback) {
        BootstrapDialog.show({
            title: 'Warning',
            message: 'Action is irreversible, do you want to proceed?',
            type: BootstrapDialog.TYPE_DANGER,
            size: BootstrapDialog.SIZE_SMALL,
            buttons: [{
                label: 'No',
                cssClass: '-btn btn-sm btn-danger',
                action: function (dialog) {
                    dialog.close();
                    callback(0);
                }
            }, {
                label: 'Yes, Proceed',
                cssClass: '-btn btn-sm btn-primary btn-loading',
                action: function (dialog) {
                    dialog.close();
                    callback(1);
                }
            }]
        });
    }

    $(document).on('click', '.btn-delete', function (event) {
        event.preventDefault();
        var self = $(this);
        var url = self[0].href;
        console.log(self[0].href)

        call_confirm_dialog(function (result) {
            if (!result) {
                return false;
            } else {
                window.location.href = url;
            }

        });
    });
    $(function () {
            $('input.modern').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });

</script>


    <script src="<?php echo base_url().'assets/Profile_files/jquery.mask.js.download';?>"></script>
    <script src="<?php echo base_url().'assets/Profile_files/jquery-ui.js.download';?>"></script>
    <script src="<?php echo base_url().'assets/Profile_files/select2.full.js.download';?>"></script>

<!-- bootstrap time picker -->
<script src="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.js';?>"></script>
    <script>
        $('.select_field_class').select2({placeholder: "Select here", maximumSelectionSize: 100});
        $("#cnic").mask('00000-0000000-0');
        $("#phoneNo").mask('0000-0000000');

    $(".sidebar-toggle").click();

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    //Date picker
   
$('.timepicker').timepicker({
      showInputs: false
    })

function functionValidateForm()
{
   var txt_first_name       = $("#first_name").val();
    var txt_last_name       = $("#last_name").val();
    var phoneNo       = $("#phoneNo").val();
    var txt_email           = $("#email").val();
    var sel_city            = $("#sel_city").val();
    var location            = $("#location").val();
    var txt_cnic                = $("#cnic").val();
    var sel_category                = $("#sel_category").val();
    var txt_description                = $("#txt_description").val();
    
    

    

    $(".spanError").html("");
    $(".form-control").removeClass( "Errorborderclass" );

    if(txt_first_name == '')
    {
      
      $("#Error_first_name").html("Please enter first name");
      $("#first_name").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_last_name == '')
    {
      
      $("#Error_last_name").html("Please enter last name");
      $("#last_name").addClass( "Errorborderclass" );
      return false;
    }
    if(phoneNo == "" || phoneNo.length < 12)
    {
      $("#Error_phoneNo").html("Invalid Phone No");
      $("#phoneNo").addClass( "Errorborderclass" );
      return false;
    }

    if(txt_email == "" )
    {
      $("#Error_email").html("Invalid Email");
      $("#email").addClass( "Errorborderclass" );
      return false;
    }
    if(sel_city == "" || sel_city == 0)
    {
      $("#Error_sel_city").html("Select user type");
      $("#sel_city").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_cnic == "" || txt_cnic.length < 13)
    {
      $("#Error_cnic").html("Invalid CNIC");
      $("#cnic").addClass( "Errorborderclass" );
      return false;
    }
    if(sel_category == "" || sel_category == 0)
    {
      $("#Error_sel_category").html("Invalid category");
      $("#sel_category").addClass( "Errorborderclass" );
      return false;
    }

    if(txt_description == "")
    {
      $("#Error_txt_description").html("Invalid Description");
      $("#txt_description").addClass( "Errorborderclass" );
      return false;
    }
   
    
    /*if(txt_password == '')
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
    }*/
    else
    {
      
    
    }

    $("#form_doctor_update_profile").submit();
}
    </script>





<style></style>

 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b></b>
    </div>
    <strong>Copyright &copy; 2018-2028 <a href="https://adminlte.io">DPMS</a>.</strong> All rights
    reserved.
  </footer>

  </body>
</html>