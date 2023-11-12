<?php 
$query2 ="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor WHERE tr_item_ifno.item_id ='".$_GET['ID']."'";
$result = mysql_query($query2)or die(mysql_error());
$row = mysql_fetch_array( $result );
$originalDate = $row['approve_status'];
$newDate = date("d-M-Y", strtotime($originalDate)); ?>
                <div id="page-inner">
                      <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                         <h4 class="page-header" style="margin-bottom:10px; margin-top:0;">
                            <small>Print Date </small>
                            <a href="" onClick="window.print();return false" id="printLandscape"><img src="<?php echo base_url()?>images/print-icon.gif" width="36" height="35" /></a>
                        </h4>
                         <table class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        	<tr class="odd gradeX">
                                            	<th>SI.</th>
                                            	<td><?php echo $row['serialno'];?></td>
                                      </tr>
                                   	  <tr class="even gradeC">
                                            	<th>Sending date</th>
                               		<td><?php echo $row['sending_date'];?></td>
                                            </tr>
                              <tr class="odd gradeX">
                                            	<th>Vendor</th>
                   	<td><?php echo $row['vendor_name'];?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                            	<th>Style no</th>
                                            	<td><?php echo $row['style_no'];?></td>
                                            </tr>
                                            
                                            <tr class="odd gradeX">
                                            	<th>Color</th>
                                            	<td><?php echo $row['color'];?></td>
                                            </tr>
                                            <tr class="odd gradeC">
                                            	<th>Method</th>
                                            	<td><?php echo $row['method'];?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                            	<th>Item Size</th>
                                            	<td><?php echo $row['item_size'];?></td>
                                            </tr>
                                            <tr class="odd gradeC">
                                            	<th>Fabirc</th>
                                            	<td><?php echo $row['fabirc'];?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                            	<th>Care Label</th>
                                            	<td><?php echo $row['care_label'];?></td>
                                            </tr>
                                             <tr class="odd gradeC">
                                            	<th>Hanger & Sizer</th>
                                            	<td><?php echo $row['hanger'];?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                            	<th>Price tag</th>
                                            	<td><?php echo $row['price_tag'];?></td>
                                            </tr>
                                            <tr class="even gradeC">
                                            	<th>Sewing tag</th>
                                            	<td><?php echo $row['sewing_tag'];?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                            	<th>Sample Quantity</th>
                                            	<td><?php echo $row['sample_qtn'];?></td>
                                            </tr>
                                            <tr class="odd gradeC">
                                                <th>TGT comments</th>
                                            	<td><?php echo $row['tgt_comment'];?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                            	<th>TSSO Sample comments</th>
                                            	<td><?php echo $row['tssq_comment'];?></td>
                                            </tr>
                                            <tr class="odd gradeC">
                                            	<th>Comments</th>
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
                                                ?></td>
                                            </tr>
                                            
                                        
                                    </tbody>
                                </table> 
                        </div>
                     </div>
                 </div>
