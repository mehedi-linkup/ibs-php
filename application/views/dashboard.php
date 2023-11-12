<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vendor Management</title>
    <!-- Bootstrap Styles-->
    <link href="<?php echo base_url()?>/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>/assets/css/datepicker3.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo base_url()?>/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="<?php echo base_url()?>/assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="<?php echo base_url()?>/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
       <?php //include('navigation.php');?>
       <?php $this->load->view('navigation'); ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                       
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Sample sending Chart 
                             <span style="float:right"><a href="<?php echo base_url()?>vendor/manage_order">View All</a></span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" style="height: 400px;">
                          <h2>Welcome to IBS</h2>
                          
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                         &nbsp;
                    </div>
                    
                </div>
				<?php //include('footer.php');?>
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
	</script>

</body>

</html>