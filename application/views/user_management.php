<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Management</title>
    <!-- Bootstrap Styles-->
    <link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>assets/css/datepicker3.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo base_url()?>assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="<?php echo base_url()?>assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="<?php echo base_url()?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
       <?php $this->load->view('navigation'); ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Dashboard <small>Welcome to Vendor Management</small>
                        </h1>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <h4 id="delete"></h4>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             User List
                             <span style="float:right"><a href="<?php echo base_url()?>vendor/add_user" class="fancybox fancybox.ajax">Create New User</a></span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" id="userlist">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>SI NO.</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>User Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
                                    $userid = $this->session->userdata('username');
                                    print_r($userid.'Say somthing');
									
									$query2 ="select * from tr_user where user_id!='".$userid."'";
									$result = mysql_query($query2)or die(mysql_error());
									while($row = mysql_fetch_array( $result )){
										$i++;
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $i-1;?></td>
                                            <td><?php echo $row['username'];?></td>
                                            <td><?php echo $row['email'];?></td>
                                            <td><?php $status= $row['status'];
											if($status==3){
												echo "Company";
												}
											if($status==2){
												echo "Buyer";
												}
											if($status==1){
												echo "Supper User";
												}
											if($status==6){
												echo "Team";
												}
											?></td>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="edit_user?ID=<?php echo $row['user_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteuser(<?php echo $row['user_id'];?>);"><i class="fa fa-pencil"></i> Delete</a></td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                
				<?php $this->load->view('footer'); ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?php echo base_url()?>assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="<?php echo base_url()?>assets/js/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url()?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url()?>assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>

    <!-- Morris Chart Js -->
    <!-- Custom Js -->
    <script src="<?php echo base_url()?>assets/js/custom-scripts.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox({
			padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,
				maxWidth    : "60%",
				autoSize    : true,
                autoScale   : true,
				fitToView   : true,

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(0,0,0,0.3)'
						}
					}
				}		
			});
		});
		function deleteuser(UID){
			var txt;
			var r = confirm("Are you sure you want to Change this?");
			if (r == true) {
				var del ="DELETE"
				//txt = "You pressed OK!";
				var errormessage = '<span style="color:#060;">Successfully Deleted.</span>';
				var dataString = 'send='+del +'&id='+UID;
					$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#userlist").html(data);
							$('#dataTables-example').dataTable();
							$("#delete").html(errormessage);
							setTimeout( function() {$("#delete").hide(); },1000);
						}
					});
			} else {
				//txt = "You pressed Cancel!";
			}
			}
	</script>

</body>

</html>