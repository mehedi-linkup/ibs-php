                <div id="page-inner">
                      <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                         <h2 class="page-header" style="margin-bottom:10px; margin-top:0;">
                            <small>View Sample Date</small>
                            <span><a href="print_sample?ID=<?php echo $_GET['ID'];?>" class="fancyboxview fancybox.ajax" style="float:right;">Print Preview</a></span>
                        </h2>
                         <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                       <tr>
                                           <th>SL</th>
                                            <th>Sending date</th>
                                            <th>Vendor</th>
                                            <th>Style no</th>
                                            <th>Color</th>
                                            <th>Sample Method</th>
                                            <th>Size</th>
                                            <th>Fabirc</th>
                                            <th>Care Label</th>
                                            <th>Others trims & accessories</th>
                                         <!--    <th>Price tag</th>
                                            <th>Sewing tag</th> -->
                                            <th>Quantity</th>
                                            <th>Vendor comments</th>
                                            <th>USA  Comments</th>
                                            <th>Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									$query2 ="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor WHERE tr_item_ifno.item_id ='".$_GET['ID']."'";
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
                                         <td><?php echo $row['serialno'];?></td>
                                            <td><?php echo $row['sending_date'];?></td>
                                            <td><?php echo $row['vendor_name'];?></td>
                                            <td><?php echo $row['style_no'];?></td>
                                            <td><?php echo $row['color'];?></td>
                                            <td><?php echo $row['method'];?></td>
                                            <td><?php echo $row['item_size'];?></td>
                                            <td><?php echo $row['fabirc'];?></td>
                                            <td><?php echo $row['care_label'];?></td>
                                            <td><?php echo $row['hanger'];?></td>
                                          <!--   <td><?php //echo $row['price_tag'];?></td>
                                            <td><?php //echo $row['sewing_tag'];?></td> -->
                                            <td><?php echo $row['sample_qtn'];?></td>
                                            <td><?php echo $row['tgt_comment'];?></td>
                                            <td><?php echo $row['tssq_comment'];?></td>
                                            <td><?php $astatus = $row['approve_status'];
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
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table> 
                        </div>
                     </div>
                 </div>
