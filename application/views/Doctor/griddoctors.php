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
  if($this->session->userdata('admin_id') != '')
  {
    $this->load->view('includes/adminsidebar'); // load the  sidebar HTML
  }
  else
  {
    $this->load->view('includes/sidebar'); // load the  sidebar HTML
  }
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
        <li class="active">View Doctors</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View All Doctors</h3>
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
                  $sel_doctor_category = $this->input->post('sel_doctor_category');
                  //echo $sel_doctor_category ; die("hello");
                  ?>
                  <div class="col-md-2">
                  <!-- select -->
                <div class="form-group">

                  <select class="form-control" name="sel_doctor_category" id="sel_doctor_category">
                    <option value="0">All categories</option>
                  <?php 
                      foreach($Doctorscategories as $Doctorscategory)
                      {
                      ?>
                        <option value="<?=$Doctorscategory['Custom_Field_Value_ID'] ?>" <?php if($sel_doctor_category == $Doctorscategory['Custom_Field_Value_ID']){ echo "selected" ;}  ?>><?php echo $Doctorscategory['Custom_Field_value_name']; ?></option>
                      <?php 
                      }
                      ?>

                  </select>
                </div>
                </div>

                <?php
                  $sel_doctor_city = $this->input->post('sel_doctor_city');
                  //echo $sel_doctor_category ; die("hello");
                  ?>
                <div class="col-md-2">
                  <!-- select -->
                <div class="form-group">
                  <select class="form-control" name="sel_doctor_city" id="sel_doctor_city">
                    <option value="0">All cities</option>
                  <?php 
                      foreach($cities as $city)
                      {
                      ?>
                        <option value="<?=$city['Custom_Field_Value_ID'] ?>" <?php if($sel_doctor_city == $city['Custom_Field_Value_ID']){ echo "selected" ;}  ?>><?php echo $city['Custom_Field_value_name']; ?></option>
                      <?php 
                      }
                      ?>

                  </select>
                </div>
                </div>

                <div class="col-md-2" <?php if($this->session->userdata('admin_id') == ''){ echo "style='display:none'";}?> >
                 <!-- select -->
                <div class="form-group">
                  <select class="form-control" name="sel_isactive" id="sel_isactive">
                    <option <?php if($this->input->post('sel_isactive') == 1){ echo "selected";} ?> value="1">Active</option>
                    <option <?php if($this->input->post('sel_isactive') == 0){ echo "selected";} ?> value="0">Inactive</option>
                  </select>
                </div>
                </div>

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
                  <th>Name</th>
                  <?php
                  if($this->session->userdata('admin_id') != '' && $this->session->userdata('admin_id') != 0)
                  {
                  ?>
                  <th>User Name</th>
                  <?php
                  }
                    ?>
                  <th>City</th>
                  <th>Category</th>
                  <th>Phone No</th>
                  <?php
                  if($this->session->userdata('admin_id') != '' && $this->session->userdata('admin_id') != 0)
                  {
                  ?>
                  <th>Status</th>
                  <?php
                  }
                    ?>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                //echo count($doctors);die();
                //if(count($doctors) > 0)
                //{
                    foreach($doctors as $doctor)
                    {

                    ?>
                    <tr>
                      <td><?php echo $doctor['user_fname'].' '.$doctor['user_lname']; ?></td>
                      <?php
                        if($this->session->userdata('admin_id') != '' && $this->session->userdata('admin_id') != 0)
                        {
                          ?>
                            <td><?=$doctor['user_uname'] ?></td>
                          <?php
                        }
                        ?>
                      <td>
                        <?=$doctor['user_city_name'] ?>
                      </td>
                      <td>
                        <?=$doctor['user_category_name'] ?>
                      </td>
                      <td><?=$doctor['user_ph_no'] ?></td>

                      <?php
                        if($this->session->userdata('admin_id') != '' && $this->session->userdata('admin_id') != 0)
                        {
                        ?>
                        <td>
                            <?php
                            if($doctor['user_is_active'] == 1) 
                            {
                            ?>
                            Active
                            <?php 
                            }
                            else
                            {
                            ?>
                              Inactive
                            <?php 
                            }
                            ?>
                          </td>
                          <?php
                          }
                          ?>

                      <td>
                        <!--<a href="<?php echo base_url().'doctor/DoctorDetail/'.$doctor['user_id'];?>" target="_blank"></a>-->
                        <a  href="<?php echo base_url().'doctor/DoctorDetail/'.$doctor['user_id'];?>" target="_blank" class="btn  btn-primary btn-sm">View Detail</a>
                        <?php
                          if($this->session->userdata('admin_id') != '' && $this->session->userdata('admin_id') != 0)
                          {

                            if($doctor['user_is_active'] == 1) 
                            {
                            
                            ?>

                            <a  href="javascript:void(0)" onclick="funcUpdateUser(0,<?=$doctor['user_id'];?>)" class="btn  btn-danger btn-sm">Inactive</a>
                            <?php
                            }else
                            { 
                            ?>
                            <a  href="javascript:void(0)"  onclick="funcUpdateUser(1,<?=$doctor['user_id'];?>)" class="btn btn-success btn-sm">Active</a>
                          <?php 
                            }
                          }
                        ?>

                      </td>
                    </tr>
                    <?php 
                    }
                //}
                //else
                //{
                  ?>
                  <!--  <tr>
                      No Record Found
                    </tr>-->
                  <?php 
                //}
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


  function funcUpdateUser(status,user)
  {

    var msgConfirm="";
      if(status == 1)
      {
        msgConfirm = "Are you sure you want to active the user?";
      }
      else
      {
        msgConfirm = "Are you sure you want to Inactive the user?";
      }
      if(confirm(msgConfirm))
      {
          $.ajax(
               {
                url:BaseUrlSite+'common/funcUpdateUserStatus',
                data:{
                    isAjaxCall    :'true',
                    status: status,
                    user : user
                  },
                  type:'POST',
                  success:function(data)
                  {
                  location.reload();
                   // loading('end');  
                  } 
              });
    }
  }

   
</script>