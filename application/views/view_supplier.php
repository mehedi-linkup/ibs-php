                <div id="page-inner">
                      <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                         <h4 class="page-header" style="margin-bottom:10px; margin-top:0;">
                            <small>View Sample Date</small>
                            <span><a href="print_supplier?ID=<?php echo $_GET['ID'];?>" class="fancyboxview fancybox.ajax" style="float:right;">Print Preview</a></span>
                        </h4>
                         <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                       <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Vendor</th>
                                            <th>Style no</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Submittied for approval on</th>
                                            <th>Submission no</th>
                                            <th>Vendor comments</th>
                                            <th>USA comments</th>
                                            <th>Comments</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									$query2 ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor WHERE suplier.suplier_id ='".$_GET['ID']."'";
									$result = mysql_query($query2)or die(mysql_error());
									while($row = mysql_fetch_array( $result )){
									$originalDate = $row['approve_date'];
									$newDate = date("d-M-Y", strtotime($originalDate));
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
                                            <td><?php echo $row['vendor_name'];?></td>
                                            <td><?php echo $row['style'];?></td>
                                            <td><?php echo $row['color'];?></td>
                                            <td><?php echo $row['item_desc'];?></td>
                                            <td><?php echo $row['submitfor_approval'];?></td>
                                            <td><?php echo $row['submition_no'];?></td>
                                            <td><?php echo $row['tgt_note'];?></td>
                                            <td><?php echo $row['buyer_comments'];?></td>
                                            <td><?php $astatus = $row['approve'];
											//echo  $row['approve'];
											if($astatus==1){
												echo "Approved"."<br/>".$newDate;
												}
											if($astatus==2){
												echo "Rejected"."<br/>".$newDate;
												}
											if($astatus==0){
												echo "Pending";
												}
											if($astatus==3){
												echo "Conditionally Approved"."<br/>".$newDate;;
												}
											?></td>
                                            <td>
                                                
                                                    <a href="<?php echo base_url();?>vendor/file_view/<?php echo $row['suplier_id'];?>" style="padding:4px" target="_blank"><i class="fa fa-eye"></i></a>
                                                    <!--<a href="" download="" style="padding:4px"><i class="fa fa-download"></i></a>-->
                                                
                                                
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                        
                                    </tbody>
                                </table> 
                        </div>
                     </div>
                 </div>
