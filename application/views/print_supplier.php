<?php 
$query2 ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor WHERE suplier.suplier_id ='".$_GET['ID']."'";
$result = mysql_query($query2)or die(mysql_error());
$row = mysql_fetch_array( $result );
$originalDate = $row['approve'];
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
                                            	<td><?php echo $row['serial'];?></td>
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
                                            	<td><?php echo $row['style'];?></td>
                                            </tr>
                                          
                                            <tr class="odd gradeX">
                                            	<th>Color</th>
                                            	<td><?php echo $row['color'];?></td>
                                            </tr>
                                            <tr class="even gradeC">
                                            	<th>Description</th>
                                            	<td><?php echo $row['item_desc'];?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                            	<th>Submittied for approval on</th>
                                            	<td><?php echo $row['submitfor_approval'];?></td>
                                            </tr>
                                            <tr class="odd gradeC">
                                                <th>Submission no</th>
                                            	<td><?php echo $row['submition_no'];?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                            	<th>Vendor comments</th>
                                            	<td><?php echo $row['tgt_note'];?></td>
                                            </tr>
                                            <tr class="odd gradeC">
                                            	<th>Buyer comments</th>
                                            	<td><?php echo $row['buyer_comments'];?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                            	<th>Comments</th>
                                                <td><?php $astatus = $row['approve'];
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
