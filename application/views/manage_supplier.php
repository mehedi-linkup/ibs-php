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
                             <small>Supplies Submission</small>
                        </h1>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <h4 id="delete"></h4>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Supplies Submission
                             <?php $role = $this->session->userdata('verdorid');
							  $isstatus = $this->session->userdata('status');
							 $isuser = $this->session->userdata('username');
							 if(($role=="0") || ($role=="byer")){echo "";}
							 else if(($role=="assist") || ($role=="checker")){echo "";}
							 else{
							 ?>
                             <span style="float:right;"><a href="<?php echo base_url()?>vendor/add_supplier" class="fancybox fancybox.ajax">Entry of Supplies Submission</a></span>
                             <?php } ?>
                        </div>
                        <div class="panel-body">
							<div class="form-group" style="width:100%; float:left;">
                                <!--<div class="col-md-3" style="padding-right: 0px;">
      										<select class="form-control" id="userrole" name="userrole">
                                            	<option value="" selected>Select Serial</option>
                                                <?php 
												/*$query_date ="select serialno from tr_item_ifno Order By sending_date Asc";
												$result_date = mysql_query($query_date)or die(mysql_error());
												while($row_date = mysql_fetch_array( $result_date)){*/
												?>
                                                <option value="<?php //echo $row_date['serialno']; ?>"><?php //echo $row_date['serialno']; ?></option>
                                                <?php //} ?>
                                            </select>
                                </div>-->
                                <div class="col-md-2" style="padding-right: 0px;">
									<select class="form-control" id="emtdat" name="emptydate">
										<option value="" selected>Select Date</option>
										<option value="1">Empty Date</option>
									</select>
                                </div>

                                <?php if(($role=="0") || ($role=="byer") || ($role=="checker")|| ($role=="assist")){?>
                                <div class="col-md-2" style="padding-right: 0px;">
									<select class="form-control" id="sldendor" name="vendor">
										<option value="" selected>Select Vendor</option>
											<?php 
										$query_vendor ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor Group By suplier.vendor Order By suplier.suplier_id Asc";
										$result_vendor = mysql_query($query_vendor)or die(mysql_error());
										while($row_vendor = mysql_fetch_array($result_vendor)){
										?>
										<option value="<?php echo $row_vendor['vendor']; ?>"><?php echo $row_vendor['vendor_name']; ?></option>
										<?php } ?>
									</select>
                                </div>
                                <?php } ?>
                                <div class="col-md-2" style="padding-right: 0px;">
      								<input type="text" class="form-control" name="style" id="slstyle" style="height:30px;" value="" placeholder="Pack No.">
                                </div>
                                <div class="col-md-2" style="padding-right: 0px;">
                                	<input type="text" class="form-control" id="slmethod" name="method" style="height:30px;" value="" placeholder="Color">
                                </div>
                               <div class="col-md-2" style="padding-right: 0px;">
									<select class="form-control" id="comt" name="comt">
										<option value="" selected>Select Comments</option>
											<option value="1">Approved</option>
											<option value="3">Conditionally Approved</option>
											<option value="2">Rejected</option>
											<option value="0">Pending</option>
									</select>
                                </div>
                            </div>
                        	
                            <div class="table-responsive" id="supplierlist">
                            <?php 
							 	if(($role=="0") || ($role=="byer")){
							?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <th>SI.</th>
                                            <?php if(($role=="0") || ($role=="byer")){?>
                                            <th>Sending date</th>
                                             <?php } ?>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                            <?php if($role!="byer"){?>
                                            <th>Status</th>
                                            <?php } ?>
                                            <th >Style no</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Submittied for approval on</th>
                                            <th>Submission no</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$statement2 ='';
									if($isstatus=="1"){
									$statement2 = "Where suplier.receive_to='".$isuser."'";
									}
									if($isstatus=="6"){
										$statement2 = "Where suplier.buyerteam='".$isuser."'";
										}
									if($isstatus=="3"){
										$statement2 = "Where suplier.create_to='".$isuser."'";
										}
									if($isstatus=="999"){
										$statement2 = "";
										}
									$i=1;
									$query2 ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement2} Order By suplier.suplier_id DESC";
									$result = mysql_query($query2)or die(mysql_error());
									while($row = mysql_fetch_array( $result )){
										$i++;
									if((!empty($row['sending_date'])) && ($role=="byer")){
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row['serial'];?></td>
                                             <?php if(($role=="0") || ($role=="byer")){?>
                                            <td><?php echo $row['sending_date'];?></td>
                                            <?php } ?>
                                            <td><?php $astatus = $row['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											?></td>
                                            <td><?php echo $row['vendor_name'];?></td>
                                            <td><?php echo $row['style'];?></td>
                                            <td><?php echo $row['color'];?></td>
                                            <td><?php echo $row['item_desc'];?></td>
                                            <td><?php echo $row['submitfor_approval'];?></td>
                                            <td><?php echo $row['submition_no'];?></td>
                                            <td> 
												<?php if($role=="6"){?>
													<a class="btn btn-primary fancybox fancybox.ajax" href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>">
														<i class="fa fa-edit "></i> Edit
													</a>&nbsp;
													<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row['suplier_id'];?>);">
														<i class="fa fa-pencil"></i> Delete
													</a> 
													<?php } if(($role=="byer") && ($astatus=="0")){ ?> 
													<a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>
														vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>">
														<i class="fa fa-edit "></i> Comments
													</a>
													<?php } ?> &nbsp;
													<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>">
														<i class="fa fa-eye"></i> View
													</a>
											</td>
                                        </tr>
                                        	<?php }
										else if($role=="0"){
											if($i%2 ==0){
										 ?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row['serial'];?></td>
                                             <?php if(($role=="0") || ($role=="byer")){?>
                                            <td><?php echo $row['sending_date'];?></td>
                                            <?php } ?>
                                            <td><?php $astatus = $row['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											?></td>
                                            <td><?php echo $row['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
												$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row['style'];?></td>
                                            <td><?php echo $row['color'];?></td>
                                            <td><?php echo $row['item_desc'];?></td>
                                            <td><?php echo $row['submitfor_approval'];?></td>
                                            <td><?php echo $row['submition_no'];?></td>
                                            <?php if($isstatus=="1"){
												if($astatus==0){
												?>
                                            <td>
                                                <!--<a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a>-->
                                                &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php }
											else{
											?>
                                            <td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
											<?php  }
											}else{
											?>
                                            <td>
                                                <!--<a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a>-->
                                                &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php } ?>
                                        </tr>
                                        <?php }} ?>
                                    </tbody>
                                </table>
                                <?php }
							else if(($role=="assist") || ($role=="checker")){
							?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                            <th>Status</th>

                                            <th>Style no</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Submittied for approval on</th>
                                            <th>Submission no</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									$query2 ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor Order By suplier.suplier_id DESC";
									$result = mysql_query($query2)or die(mysql_error());
									while($row = mysql_fetch_array( $result )){
										$i++;
									if((!empty($row['sending_date'])) && ($role=="byer")){
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row['serial'];?></td>
                                             <?php if(($role=="0") || ($role=="byer")){?>
                                            <td><?php echo $row['sending_date'];?></td>
                                            <?php } ?>
                                            <td><?php $astatus = $row['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
												$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row['style'];?></td>
                                            <td><?php echo $row['color'];?></td>
                                            <td><?php echo $row['item_desc'];?></td>
                                            <td><?php echo $row['submitfor_approval'];?></td>
                                            <td><?php echo $row['submition_no'];?></td>
                                            <td> 
                                            <?php if($role=="0"){?>
                                            <!--<a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> -->
                                            &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role=="byer") && ($astatus=="0")){ ?> 
                                            <!--<a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> -->
                                            Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php }
										else if($role=="0"){
											if($i%2 ==0){
										 ?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row['serial'];?></td>
                                             <?php if(($role=="0") || ($role=="byer")){?>
                                            <td><?php echo $row['sending_date'];?></td>
                                            <?php } ?>
                                            <td><?php $astatus = $row['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											?></td>
                                            <td><?php echo $row['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
												$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row['style'];?></td>
                                            <td><?php echo $row['color'];?></td>
                                            <td><?php echo $row['item_desc'];?></td>
                                            <td><?php echo $row['submitfor_approval'];?></td>
                                            <td><?php echo $row['submition_no'];?></td>
                                            <td> <?php if($role=="0"){?>
                                            <!--<a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> -->
                                            &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role=="byer") && ($astatus=="0")){ ?> 
                                            <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php }
										else if(($role=="assist") || ($role=="checker")){
											if($i%2 ==0){
										 ?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row['serial'];?></td>
                                            <td><?php echo $row['sending_date'];?></td>
                                            <td><?php $astatus = $row['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											?></td>
                                            <td><?php echo $row['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
												$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row['style'];?></td>
                                            <td><?php echo $row['pack_no'];?></td>
                                            <td><?php echo $row['color'];?></td>
                                            <td><?php echo $row['item_desc'];?></td>
                                            <td><?php echo $row['submitfor_approval'];?></td>
                                            <td><?php echo $row['submition_no'];?></td>
                                            <td> <?php if($role=="assist"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php }
										
										} ?>
                                    </tbody>
                                </table>
                                <?php }
								else{
								?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                            <th>Status</th>
                                            <th style="width:10%">Style no</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Submittied for approval on</th>
                                            <th>Submission no</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									$query2 ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor Where suplier.vendor='$role' AND suplier.create_to='".$isuser."' Order By suplier.suplier_id Desc";
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
                                            <td><?php echo $row['serial'];?></td>
                                            <td><?php echo $row['sending_date'];?></td>
                                            <td><?php $astatus = $row['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											?></td>
                                            <td><?php echo $row['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
												$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row['style'];?></td>
                                            <td><?php echo $row['color'];?></td>
                                            <td><?php echo $row['item_desc'];?></td>
                                            <td><?php echo $row['submitfor_approval'];?></td>
                                            <td><?php echo $row['submition_no'];?></td>
                                            <td><?php if((empty($row['sending_date'])) && ($role!="0") && ($role!="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> <?php } if($role=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                                <?php } ?>
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
			$('.fancyboxview').fancybox({
			padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,
				maxWidth    : "95%",
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
		function deletesupplier(UID){
			var txt;
			var r = confirm("Are you sure you want to Change this?");
			if (r == true) {
				var del ="DELETEsup"
				//txt = "You pressed OK!";
				var errormessage = '<span style="color:#060;">Successfully Deleted.</span>';
				var dataString = 'send='+del +'&id='+UID;
					$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#supplierlist").html(data);
							$('#dataTables-example').dataTable();
							$("#delete").html(errormessage);
							setTimeout( function() {$("#delete").hide(); },1000);
						}
					});
			} else {
				//txt = "You pressed Cancel!";
			}
			}
			
	$("#sldendor" ).change(function() {
	<?php if(($role=="0") || ($role=="byer") || ($role=="checker")|| ($role=="assist")){?>
	var vendor = $('#sldendor').val();
	<?php } else{?>
	var vendor = <?php echo $role;?>;
	<?php } ?>	

	var style = $('#slstyle').val();
	var method = $('#slmethod').val();
	var emtdat = $('#emtdat').val();
	var comt = $('#comt').val();
	var submitvendor ="spvendor"
	if(vendor == ""){
		vendor =0;
		}
	if(style == ""){
		style =0;
		}
	if(method == ""){
		method =0;
		}
		if(emtdat == ""){
		emtdat =0;
		}
	if(comt == ""){
		comt =5;
		}
	var dataString = 'send='+submitvendor +'&vendor='+vendor+'&style='+style+'&method='+method+'&emdate='+emtdat+'&comt='+comt;

	//alert(dataString);
	$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#supplierlist").html(data);
							$('#dataTables-example').dataTable();
							//$("#delete").html(errormessage);
							//setTimeout( function() {$("#delete").hide(); },1000);
						}
					});
  
});

$('#dataTables-example').dataTable();


$('#slstyle').on('blur', function() {
<?php if(($role=="0") || ($role=="byer") || ($role=="checker")|| ($role=="assist")){?>
	var vendor = $('#sldendor').val();
	<?php } else{?>
	var vendor = <?php echo $role;?>;
	<?php } ?>	
	var style = $('#slstyle').val();
	var method = $('#slmethod').val();
	var emtdat = $('#emtdat').val();
	var comt = $('#comt').val();
	var submitvendor ="spstyle"
	if(vendor == ""){
		vendor =0;
		}
	if(style == ""){
		style =0;
		}
	if(method == ""){
		method =0;
		}
		if(emtdat == ""){
		emtdat =0;
		}
	if(comt == ""){
		comt =5;
		}
	var dataString = 'send='+submitvendor +'&vendor='+vendor+'&style='+style+'&method='+method+'&emdate='+emtdat+'&comt='+comt;

	//alert(dataString);
	$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#supplierlist").html(data);
							
							//$("#delete").html(errormessage);
							//setTimeout( function() {$("#delete").hide(); },1000);
						}
					});
  
});	
$('#slmethod').on('blur', function() {
<?php if(($role=="0") || ($role=="byer") || ($role=="checker")|| ($role=="assist")){?>
	var vendor = $('#sldendor').val();
	<?php } else{?>
	var vendor = <?php echo $role;?>;
	<?php } ?>	
	var style = $('#slstyle').val();
	var method = $('#slmethod').val();
	var emtdat = $('#emtdat').val();
	var comt = $('#comt').val();
	var submitvendor ="spmethod"
	if(vendor == ""){
		vendor =0;
		}
	if(style == ""){
		style =0;
		}
	if(method == ""){
		method =0;
		}
		if(emtdat == ""){
		emtdat =0;
		}
	if(comt == ""){
		comt =5;
		}
	var dataString = 'send='+submitvendor +'&vendor='+vendor+'&style='+style+'&method='+method+'&emdate='+emtdat+'&comt='+comt;

	//alert(dataString);
	$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#supplierlist").html(data);
							$('#dataTables-example').dataTable();
							//$("#delete").html(errormessage);
							//setTimeout( function() {$("#delete").hide(); },1000);
						}
					});
  
});	
$("#emtdat" ).change(function() {
<?php if(($role=="0") || ($role=="byer") || ($role=="checker")|| ($role=="assist")){?>
	var vendor = $('#sldendor').val();
	<?php } else{?>
	var vendor = <?php echo $role;?>;
	<?php } ?>	
	var style = $('#slstyle').val();
	var method = $('#slmethod').val();
	var emtdat = $('#emtdat').val();
	var comt = $('#comt').val();
	var submitvendor ="spdate"
	if(vendor == ""){
		vendor =0;
		}
	if(style == ""){
		style =0;
		}
	if(method == ""){
		method =0;
		}
	if(emtdat == ""){
		emtdat =0;
		}
	if(comt == ""){
		comt =5;
		}
	var dataString = 'send='+submitvendor +'&vendor='+vendor+'&style='+style+'&method='+method+'&emdate='+emtdat+'&comt='+comt;
	//alert(dataString);
	$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#supplierlist").html(data);
							$('#dataTables-example').dataTable();
							//$("#delete").html(errormessage);
							//setTimeout( function() {$("#delete").hide(); },1000);
						}
					});
  
});
$("#comt").change(function() {
<?php if(($role=="0") || ($role=="byer") || ($role=="checker")|| ($role=="assist")){?>
	var vendor = $('#sldendor').val();
	<?php } else{?>
	var vendor = <?php echo $role;?>;
	<?php } ?>	
	var style = $('#slstyle').val();
	var method = $('#slmethod').val();
	var emtdat = $('#emtdat').val();
	var comt = $('#comt').val();
	var submitvendor ="spcomt"
	if(vendor == ""){
		vendor =0;
		}
	if(style == ""){
		style =0;
		}
	if(method == ""){
		method =0;
		}
	if(emtdat == ""){
		emtdat =0;
		}
	if(comt == ""){
		comt =5;
		}
	var dataString = 'send='+submitvendor +'&vendor='+vendor+'&style='+style+'&method='+method+'&emdate='+emtdat+'&comt='+comt;
	//alert(dataString);
	$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#supplierlist").html(data);
							$('#dataTables-example').dataTable();
							//$("#delete").html(errormessage);
							//setTimeout( function() {$("#delete").hide(); },1000);
						}
					});
  
});	
	
	</script>

</body>

</html>