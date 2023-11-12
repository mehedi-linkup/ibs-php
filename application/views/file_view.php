<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>File Download</title>
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
                             <small>File Download</small>
                        </h1>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php
                        $query ="select * from supplier_file WHERE supplier_file.supplier_id ='".$id."'";
					    $result = mysql_query($query)or die(mysql_error());
                        while($row = mysql_fetch_array( $result )) { ?>
                            
                        <div class="col-md-3">
                            <div class="file_card">
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                      
                                      <?php
                                      $file_name = explode('.' , $row['file_name']);
                                      
                                      if (strtolower(end($file_name)) == "pdf"){ ?>
                                            <h1>PDF File</h1>
                                        <?php } 
                                        if (strtolower(end($file_name)) == "docx"){ ?>
                                            <h1>DOC File</h1>
                                        <?php } 
                                        if (strtolower(end($file_name)) == "xlsx"){ ?>
                                            <h1>Excel File</h1>
                                        <?php } 
                                        if (strtolower(end($file_name)) == "doc"){ ?>
                                            <h1>DOC File</h1>
                                        <?php } ?>
                                        
                                      <!--<iframe src="uploads/supplier<?php echo $row['file_name'];?>"></iframe>-->
                                    
                                  </div>
                                  <div class="panel-footer text-center bg-danger"><a href="/<?php echo $row['file_name']; ?>" download="/<?php echo $row['file_name']; ?>"  target="_blank" class="btn btn-danger">Download</a></div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    
                    
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


    <!-- Morris Chart Js -->
    <!-- Custom Js -->
    <script src="<?php echo base_url()?>assets/js/custom-scripts.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />


</body>

</html>