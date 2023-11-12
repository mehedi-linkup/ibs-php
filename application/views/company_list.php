<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vendor Management</title>
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
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Company List
                            <span style="float:right"><a href="add_vendor" class="fancybox fancybox.ajax">Add New Vendor</a></span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" id="vendorlist">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>SI</th>
                                            <th>Vendor/ComPany</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
									$i=1;
									$query2 ="select * from tr_company";
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
                                            <td><?php echo $row['vendor_name'];?></td>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="edit_vendor?ID=<?php echo $row['vendor_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletevendor(<?php echo $row['vendor_id'];?>);"><i class="fa fa-pencil"></i> Delete</a></td>
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
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                         &nbsp;
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
	function deletevendor(UID){
			var txt;
			var r = confirm("Are you sure you want to Delete this?");
			if (r == true) {
				var del ="DELETEvd"
				//txt = "You pressed OK!";
				var errormessage = '<span style="color:#060;">Successfully Deleted.</span>';
				var dataString = 'send='+del +'&id='+UID;
					$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#vendorlist").html(data);
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