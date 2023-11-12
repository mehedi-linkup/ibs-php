<?php 
$isstatus = $this->session->userdata('status');
 $query="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor WHERE tr_item_ifno.item_id ='".$_GET['ID']."'";
$result_id = mysql_query($query)or die(mysql_error());
$row= mysql_fetch_array($result_id); 
$selcom = $row['receive_to'];
$selbuying = $row['buyerteam'];

?>
                
                <div id="page-inner">
                      <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                        <?php $role = $this->session->userdata('verdorid');?>
                         <h2 class="page-header" style="margin-bottom:10px; margin-top:0;">
                         <?php if($role=="0"){?>
                            <small>Add/Update Sample Date</small>
                          <?php } 
						  else if($role=="byer"){
						  ?>
                           <small>Update And Approve Information</small>
                          <?php } 
						  else{
						  ?>
                           <small>Update Information</small>
                          <?php }  ?>
                        </h2>
                        <form role="form" action="" method="post">
                        <input type="hidden" name="ID" id="ID" value="<?php echo $_GET['ID'];?>" />
                        <?php 
						if(($role=="0") || ($role=="assist")){?>
                         <p id="success"></p> 
                         	<div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">SL</label>
                                <div class="col-md-7" id="sandbox-container">
                                        <div class="input-group ">
      										<input type="text" readonly class="form-control" value="<?php echo $row['serialno'];?>" >
    									</div>
                                </div>
                            </div>
                        	<div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Enter Date</label>
                                <div class="col-md-7" id="sandbox-container">
                                        <div class="input-group date">
      										<input type="text" class="form-control" name="entdate" value="<?php echo $row['sending_date'];?>" id="setdate">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    									</div>
                                </div>
                            </div>
                            <?php if($role=="0"){
								if($isstatus=="1"){
								?>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Company/Vendor</label>
                                <div class="col-md-7">
      										<div class="form-control" style="height:30px;"><?php echo $row['vendor_name'];?></div><input type="hidden" class="form-control" name="vemdor" value="<?php echo $row['vendor_id'];?>" id="vendor" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5"> Select  Buyer </label>
                                <div class="col-md-7">
      										<select class="form-control" id="userslt" name="userslt">
                                            	<option value="">Select Buyer</option>
                                                	<?php 
													$query4 ="select * from tr_user Where status=6";
												$result4 = mysql_query($query4)or die(mysql_error());
												while($row4 = mysql_fetch_array($result4)){
													?>
                                                 <option value="<?php echo $row4['user_id'];?>" <?php if($row4['user_id']==$selbuying){echo "selected";}?>><?php echo $row4['username'];?></option>
                                                 <?php } ?>
                                                
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Vendor comments</label>
                                <div class="col-md-7">
                                	<textarea class="form-control" rows="2" name="tgt_comment" id="tgt_comment"><?php echo $row['tgt_comment'];?></textarea>
                                </div>
                            </div>
                            <?php }
							if($isstatus=="999"){
							?>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Company/Vendor</label>
                                <div class="col-md-7">
      										<div class="form-control" style="height:30px;"><?php echo $row['vendor_name'];?></div><input type="hidden" class="form-control" name="vemdor" value="<?php echo $row['vendor_id'];?>" id="vendor" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5"> Select  User </label>
                                <div class="col-md-7">
      										<select class="form-control" id="userslt1" name="userslt1">
                                            	<option value="" selected>Select User</option>
                                                	<?php 
													$query4 ="select * from tr_user Where status=1";
												$result4 = mysql_query($query4)or die(mysql_error());
												while($row4 = mysql_fetch_array($result4)){
													?>
                                                 <option value="<?php echo $row4['user_id'];?>" <?php if($row4['user_id']==$selcom){echo "selected";}?>><?php echo $row4['username'];?></option>
                                                 <?php } ?>
                                                
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5"> Select  Buyer </label>
                                <div class="col-md-7">
      										<select class="form-control" id="userslt" name="userslt">
                                            	<option value="">Select Buyer</option>
                                                	<?php 
													$query4 ="select * from tr_user Where status=6";
												$result4 = mysql_query($query4)or die(mysql_error());
												while($row4 = mysql_fetch_array($result4)){
													?>
                                                 <option value="<?php echo $row4['user_id'];?>" <?php if($row4['user_id']==$selbuying){echo "selected";}?>><?php echo $row4['username'];?></option>
                                                 <?php } ?>
                                                
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Style no</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="styleno" id="styleno" style="height:30px;" value="<?php echo $row['style_no'];?>">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;display: none;">
                                <label class="control-label col-md-5">Pk no</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="Pkno" id="pkno" value="<?php echo $row['pkno'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Color</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="color" id="color" value="<?php echo $row['color'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                               
                                <label class="control-label col-md-5"> Sample Method </label>
                                <div class="col-md-7">
                                <select  class="form-control" id="smethod" name="Sample_Method">
                                            	<option value="" selected>Select Method</option>
                                                 <option value="LA Sample" <?php if($row['method']=="LA Sample"){echo "selected";}?>>LA Sample</option>
                                                 <option value="Fit Sample" <?php if($row['method']=="Fit Sample"){echo "selected";}?>>Fit Sample </option>
                                                 <option value="PP Sample" <?php if($row['method']=="PP Sample"){echo "selected";}?>>PP Sample</option>
                                                 <option value="DC Sample" <?php if($row['method']=="DC Sample"){echo "selected";}?>>DC Sample</option>
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Size</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="Size" id="size" value="<?php echo $row['item_size'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Fabirc- available/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="fabric" id="fabric" value="<?php echo $row['fabirc'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Care Label-avalable/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="care_lebel" id="care_lebel" value="<?php echo $row['care_label'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Others trims & accessories
                                </label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="hanger" id="hanger" value="<?php echo $row['hanger'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;display: none;">
                                <label class="control-label col-md-5">Price tag-avalable/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="price_tag" id="price_tag" value="<?php echo $row['price_tag'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;display: none;">
                                <label class="control-label col-md-5">Sewing tag-avalable/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="sewing_tag" id="sewing_tag" value="<?php echo $row['sewing_tag'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Sample Quantity/PCS (for Assesment)</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="sample_quantity" id="sample_quantity" value="<?php echo $row['sample_qtn'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5"> Comments</label>
                                <div class="col-md-7">
                                	<textarea class="form-control" rows="2" name="tgt_comment" id="tgt_comment"><?php echo $row['tgt_comment'];?></textarea>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                                <label class="control-label col-md-5">Approve/Reject</label>
                                <div class="col-md-7">
      										 <label class="radio-inline">
                                                <input type="radio" value="1" <?php if($row['approve_status']==1){echo "checked";}?> id="optionsRadiosInline1" name="approved">Approved
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" value="3" <?php if($row['approve_status']==3){echo "checked";}?> id="optionsRadiosInline3" name="approved">Conditionally Approved
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" value="2" <?php if($row['approve_status']==2){echo "checked";}?> id="optionsRadiosInline2" name="approved">Rejected
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" value="0" <?php if($row['approve_status']==0){echo "checked";}?> id="optionsRadiosInline4" name="approved">Reset
                                            </label>
                                            
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; display:none;" id="rej">
                                <label class="control-label col-md-5">USA Sample comments</label>
                                <div class="col-md-7">
                                	<textarea class="form-control" rows="2" name="tssq_comment" id="tssq_comment"><?php echo $row['tssq_comment'];?></textarea>
                                </div>
                            </div>

                            <?php }
							 } 
							else if($role=="assist"){
							?>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Company/Vendor</label>
                                <div class="col-md-7">
      										<div class="form-control" style="height:30px;"><?php echo $row['vendor_name'];?></div><input type="hidden" class="form-control" name="vemdor" value="<?php echo $row['vendor_id'];?>" id="vendor" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Vendor comments</label>
                                <div class="col-md-7">
                                	<textarea class="form-control" rows="2" name="tgt_comment" id="tgt_comment"><?php echo $row['tgt_comment'];?></textarea>
                                </div>
                            </div>
                            <?php }?>

                            <div class="form-group" style="width:100%; float:left;">
                                            <label class="control-label col-md-5">&nbsp;</label>
                                             <input type="hidden" name="submit" value="adminupdate" id="submit">
                                             <div class="col-md-7">
                                            <input type="button" class="btn btn-default" value="Add Sending Date" onClick="ValiDate()">
                                            </div>
                                        </div>
                          <?php }
						 else if($role=="byer"){
						  ?>
                           <p id="success"></p> 
                               <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Sl</label>
                                <div class="col-md-7" id="sandbox-container">
                                        <div class="input-group ">
      										<input type="text" readonly class="form-control"  value="<?php echo  $row['serialno'] ;?>">
    									</div>
                                </div>
                            </div>
                             <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Vendor</label>
                                <div class="col-md-7" id="sandbox-container">

      										<input type="text" readonly class="form-control"  value="<?php echo $row['vendor_name']; ?>">
                                </div>
                            </div>
                            
                           <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                                <label class="control-label col-md-5">Sample Sending Date</label>
                                <div class="col-md-7">
      										<div class="form-control" style="height:26px; padding:2px 12px;"><?php echo $row['sending_date'];?></div>
                                </div>
                            </div>
                           <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                                <label class="control-label col-md-5">Company/Vendor</label>
                                <div class="col-md-7">
      										<div class="form-control" style="height:26px; padding:2px 12px;"><?php echo $row['vendor_name'];?></div><input type="hidden" class="form-control" name="vemdor" value="<?php echo $row['vendor_id'];?>" id="vendor" style="height:30px;">
                                </div>
                            </div>
                          <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                                <label class="control-label col-md-5">Style no</label>
                                <div class="col-md-7">
      										<div class="form-control" style="height:26px; padding:2px 12px;"><?php echo $row['style_no'];?></div>
                                </div>
                            </div>
                           <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;display: none;">
                                <label class="control-label col-md-5">Pk no</label>
                                <div class="col-md-7">
      										<div class="form-control" style="height:26px; padding:2px 12px;"><?php echo $row['pkno'];?></div>
                                </div>
                            </div>
                          <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                                <label class="control-label col-md-5">Color</label>
                                <div class="col-md-7">
      										<div class="form-control" style="height:26px; padding:2px 12px;"><?php echo $row['color'];?></div>
                                </div>
                            </div>
                           <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                                <label class="control-label col-md-5">Sample Method</label>
                                <div class="col-md-7">
      										
                                             <select disabled="1" class="form-control" id="smethod" name="Sample_Method">
                                                <option value="" selected>Select Method</option>
                                                 <option value="LA Sample" <?php if($row['method']=="LA Sample"){echo "selected";}?>>LA Sample</option>
                                                 <option value="Fit Sample" <?php if($row['method']=="Fit Sample"){echo "selected";}?>>Fit Sample </option>
                                                 <option value="PP Sample" <?php if($row['method']=="PP Sample"){echo "selected";}?>>PP Sample</option>
                                                 <option value="DC Sample" <?php if($row['method']=="DC Sample"){echo "selected";}?>>DC Sample</option>
                                            </select>
                                </div>
                            </div>
                          <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                                <label class="control-label col-md-5">Fabirc- available/ actual</label>
                                <div class="col-md-7">
      										<div class="form-control" style="height:26px; padding:2px 12px;"><?php echo $row['fabirc'];?></div>
                                </div>
                            </div>
                             <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                                <label class="control-label col-md-5">Vendor Comments</label>
                                <div class="col-md-7" >
                                    <textarea disabled class="form-control">
                                        <?php echo $row['tgt_comment'];?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                                <label class="control-label col-md-5">Approve/Reject</label>
                                <div class="col-md-7">
      										 <label class="radio-inline">
                                                <input type="radio" value="1" <?php if($row['approve_status']==1){echo "checked";}?> id="optionsRadiosInline1" name="approved">Approved
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" value="3" <?php if($row['approve_status']==3){echo "checked";}?> id="optionsRadiosInline3" name="approved">Conditionally Approved
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" value="2" <?php if($row['approve_status']==2){echo "checked";}?> id="optionsRadiosInline2" name="approved">Rejected
                                            </label>
                                            
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; display:none;" id="rej">
                                <label class="control-label col-md-5">USA Sample comments</label>
                                <div class="col-md-7">
                                	<textarea class="form-control" rows="2" name="tssq_comment" id="tssq_comment"><?php echo $row['tssq_comment'];?></textarea>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                            <label class="control-label col-md-5">&nbsp;</label>
                                             <input type="hidden" name="submit" value="buyerupdate" id="submit">
                                             <div class="col-md-7">
                                            <input type="button" class="btn btn-default" value="Approval" onClick="ValiDate()">
                                            </div>
                                        </div>
                          <?php }
						  else{
							       $query3 ="select * from tr_company Where vendor_id='$role'";
									$result3 = mysql_query($query3)or die(mysql_error());
									$row3 = mysql_fetch_array( $result3 );
						  ?>
                           <p id="success"></p> 
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Company/Vendor</label>
                                <div class="col-md-7">
      										<div class="form-control" style="height:30px;"><?php echo $row3['vendor_name'];?></div><input type="hidden" class="form-control" name="vemdor" value="<?php echo $row3['vendor_id'];?>" id="vendor" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5"> Select  User </label>
                                <div class="col-md-7">
      										<select class="form-control" id="userslt" name="userslt">
                                            	<option value="" selected>Select User</option>
                                                	<?php 
													$query4 ="select * from tr_user Where status=1";
												$result4 = mysql_query($query4)or die(mysql_error());
												while($row4 = mysql_fetch_array($result4)){
													?>
                                                 <option value="<?php echo $row4['user_id'];?>" <?php if($row4['user_id']==$selcom){echo "selected";}?>><?php echo $row4['username'];?></option>
                                                 <?php } ?>
                                                
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Style no</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="styleno" id="styleno" style="height:30px;" value="<?php echo $row['style_no'];?>">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;display: none;">
                                <label class="control-label col-md-5">Pk no</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="Pkno" id="pkno" value="<?php echo $row['pkno'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Color</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="color" id="color" value="<?php echo $row['color'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5"> Sample Method </label>
                                <div class="col-md-7">
      										    <select  class="form-control" id="smethod" name="Sample_Method">
                                                <option value="" selected>Select Method</option>
                                                 <option value="LA Sample" <?php if($row['method']=="LA Sample"){echo "selected";}?>>LA Sample</option>
                                                 <option value="Fit Sample" <?php if($row['method']=="Fit Sample"){echo "selected";}?>>Fit Sample </option>
                                                 <option value="PP Sample" <?php if($row['method']=="PP Sample"){echo "selected";}?>>PP Sample</option>
                                                 <option value="DC Sample" <?php if($row['method']=="DC Sample"){echo "selected";}?>>DC Sample</option>
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Size</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="Size" id="size" value="<?php echo $row['item_size'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Fabirc- available/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="fabric" id="fabric" value="<?php echo $row['fabirc'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Care Label-avalable/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="care_lebel" id="care_lebel" value="<?php echo $row['care_label'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Others trims and accessories</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="hanger" id="hanger" value="<?php echo $row['hanger'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;display: none;">
                                <label class="control-label col-md-5">Price tag-avalable/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="price_tag" id="price_tag" value="<?php echo $row['price_tag'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;display: none">
                                <label class="control-label col-md-5">Sewing tag-avalable/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="sewing_tag" id="sewing_tag" value="<?php echo $row['sewing_tag'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Sample Quantity/PCS (for Assesment)</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="sample_quantity" id="sample_quantity" value="<?php echo $row['sample_qtn'];?>" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Vendor comments</label>
                                <div class="col-md-7">
                                	<textarea class="form-control" rows="2" name="tgt_comment" id="tgt_comment"><?php echo $row['tgt_comment'];?></textarea>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                            <label class="control-label col-md-5">&nbsp;</label>
                                             <input type="hidden" name="submit" value="edit_order" id="submit">
                                             <div class="col-md-7">
                                            <input type="button" class="btn btn-default" value="Update Order" onClick="ValiDate()">
                                            </div>
                                        </div>
                            <?php } ?>
                        </form> 
                        </div>
                     </div>
                 </div>
<?php if(($role=="0") || ($role=="assist")){?>
<script>
        $(document).ready(function() {       
          $('#sandbox-container .input-group.date').datepicker({
				format: "dd-M-yyyy",
				autoclose: true
			});
        });   
    </script>
	<script type="text/javascript"> 
	$(document).ready(function() {
	$('input[name="approved"]').click(function() {
						   if($(this).attr('id') == 'optionsRadiosInline2') {
								$('#rej').show();           
						   }
						   else if($(this).attr('id') == 'optionsRadiosInline3') {
								$('#rej').show();           
						   }
					
						   else{
								$('#rej').hide();   
						   }
					   }); 
	});               
                
	function ValiDate(){
		        var id = $('#ID').val();
				var send = $('#submit').val();
				var vendorname = $('#vendor').val();
				var team = $('#userslt').val();
				var team1 = $('#userslt1').val();
				var styleno = $('#styleno').val();
				var pkno = $('#pkno').val();
				var color = $('#color').val();
				var smethod = $('#smethod').val();				
				var size = $('#size').val();
				var fabric = $('#fabric').val();
				var care_lebel = $('#care_lebel').val();
				var hanger = $('#hanger').val();
				var price_tag = $('#price_tag').val();
				var sewing_tag = $('#sewing_tag').val();
				var sample_quantity = $('#sample_quantity').val();

				var tgt_comment = $('#tgt_comment').val();		
				var setdate = $('#setdate').val();		
				
				var tssq_comment = $('#tssq_comment').val();
				var approve_status= $('input[name=approved]:checked').val();
		
				
				var err="";
				
				var errormessage = '';
				if(vendorname == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
					$('#vendor').addClass('er');
				}
				else{$('#vendor').removeClass('er');}
				
				if(team == '' ){ errormessage = errormessage+'<span>Please enter your Email.</span>';
					$('#userslt').addClass('er');
				}
				else{$('#userslt').removeClass('er');}
				
				if(setdate == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
					$('#setdate').addClass('er');
				}
				else{$('#setdate').removeClass('er');}
				
				if(tgt_comment == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
					$('#tgt_comment').addClass('er');
				}
				else{$('#tgt_comment').removeClass('er');}
				
				
				if(errormessage==''){
				var errormessage = '<span style="color:#060;">Successfully Add Sending Date.</span>';
				<?php if($isstatus == '1'){?>
				var dataString = 'send='+send +'&id='+id+'&vendorname='+vendorname+'&team='+team+'&setdate='+setdate+'&tgt_comment='+escape(tgt_comment);
				<?php }
				if($isstatus == '999'){
				?>
				var dataString = 'send='+send +'&id='+id+'&vendorname='+vendorname+'&team='+team+'&team1='+team1+'&setdate='+setdate+'&styleno='+styleno+'&pkno='+pkno+'&color='+color+'&smethod='+smethod+'&size='+size+'&fabric='+fabric+'&care_lebel='+care_lebel+'&hanger='+hanger+'&price_tag='+price_tag+'&sewing_tag='+sewing_tag+'&sample_quantity='+sample_quantity+'&tgt_comment='+escape(tgt_comment)+'&tssq_comment='+escape(tssq_comment)+'&approve_status='+approve_status;
				<?php }?>
					$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#orderlist").html(data);
							$('#dataTables-example').dataTable();
							$("#success").html(errormessage);
							setTimeout( function() {$.fancybox.close(); },1200);
							
						}
					});
				}
				
			}
	</script>
<?php }
else if($role=="byer"){?>
<script type="text/javascript"> 
$(document).ready(function() {
$('input[name="approved"]').click(function() {
					   if($(this).attr('id') == 'optionsRadiosInline2') {
							$('#rej').show();           
					   }
					   else if($(this).attr('id') == 'optionsRadiosInline3') {
							$('#rej').show();           
					   }
				
					   else{
							$('#rej').hide();   
					   }
				   }); 
});               
	function ValiDate(){
		        var id = $('#ID').val();
				var send = $('#submit').val();
				var tssq_comment = $('#tssq_comment').val();
				var approve_status= $('input[name=approved]:checked').val();
				//alert(tssq_comment);
				//if ($('[name="test"]').is(':checked'))
				
				
				
				var err="";
				
				var errormessage = '';
				
				/*if(tssq_comment == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
					$('#tssq_comment').addClass('er');
				}
				else{$('#tssq_comment').removeClass('er');}*/
				 
				
				if($('[name="approved"]').is(':checked')){
					$('[name="approved"]').removeClass('er');
					if((approve_status==2 || approve_status==3) && (tssq_comment=='')){
						//alert("Please Add your TSSO Sample comments and Reason");
						errormessage = errormessage+'<span>Please enter your Branch.</span>';
						$('#tssq_comment').addClass('er');
						}
					
					}
				else{
					errormessage = errormessage+'<span>Please enter your Branch.</span>';
					alert("Please Select any one of Approve/Reject");
					}
				
				//alert(approve_status);
				
				if(errormessage==''){
				var errormessage = '<span style="color:#060;">Successfully Update Order.</span>';
				var dataString = 'send='+send +'&id='+id+'&tssq_comment='+escape(tssq_comment)+'&approve_status='+approve_status;
					$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#orderlist").html(data);
							$('#dataTables-example').dataTable();
							$("#success").html(errormessage);
							setTimeout( function() {$.fancybox.close(); },1200);
							
						}
					});
				}
				
			}
	</script>
<?php }
else{?>

  <script type="text/javascript">                 
	function ValiDate(){
		        var id = $('#ID').val();
				var send = $('#submit').val();
				var vendorname = $('#vendor').val();
				var team = $('#userslt').val();				
				var styleno = $('#styleno').val();
				var pkno = $('#pkno').val();
				var color = $('#color').val();
				var smethod = $('#smethod').val();				
				var size = $('#size').val();
				var fabric = $('#fabric').val();
				var care_lebel = $('#care_lebel').val();
				var hanger = $('#hanger').val();
				var price_tag = $('#price_tag').val();
				var sewing_tag = $('#sewing_tag').val();
				var sample_quantity = $('#sample_quantity').val();
				var tgt_comment = $('#tgt_comment').val();
				
				var err="";
				
				var errormessage = '';
				if(vendorname == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
					$('#vendor').addClass('er');
				}
				else{$('#vendor').removeClass('er');}
				
				if(styleno == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
					$('#styleno').addClass('er');
				}
				else{$('#styleno').removeClass('er');}
				
			
				
				if(color == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
					$('#color').addClass('er');
				}
				else{$('#color').removeClass('er');}
				
				if(smethod == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#smethod').addClass('er');
				}
				else{$('#smethod').removeClass('er');}
				
				if(size == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#size').addClass('er');
				}
				else{$('#size').removeClass('er');}
				
				if(fabric == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#fabric').addClass('er');
				}
				else{$('#fabric').removeClass('er');}
				
				if(care_lebel == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#care_lebel').addClass('er');
				}
				else{$('#care_lebel').removeClass('er');}
				
				if(hanger == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#hanger').addClass('er');
				}
				else{$('#hanger').removeClass('er');}
				
			
				
			
								
				if(sample_quantity == '' ){ errormessage = errormessage+'<span>Please enter your Email.</span>';
					$('#sample_quantity').addClass('er');
				}
				else{$('#sample_quantity').removeClass('er');}
				
				if(team == '' ){ errormessage = errormessage+'<span>Please enter your Email.</span>';
					$('#userslt').addClass('er');
				}
				else{$('#userslt').removeClass('er');}
				
				
				
					if(tgt_comment == '' ){ errormessage = errormessage+'<span>Please enter your Email.</span>';
					$('#tgt_comment').addClass('er');
				}
				else{$('#tgt_comment').removeClass('er');}
				
				
				if(errormessage==''){
				var errormessage = '<span style="color:#060;">Successfully Update Order.</span>';
				var dataString = 'send='+escape(send) +'&id='+id+'&vendorname='+escape(vendorname)+'&team='+escape(team)+'&styleno='+escape(styleno)+'&pkno='+escape(pkno)+'&color='+escape(color)+'&smethod='+escape(smethod)+'&size='+escape(size)+'&fabric='+escape(fabric)+'&care_lebel='+escape(care_lebel)+'&hanger='+escape(hanger)+'&price_tag='+escape(price_tag)+'&sewing_tag='+escape(sewing_tag)+'&sample_quantity='+escape(sample_quantity)+'&tgt_comment='+escape(tgt_comment);
					$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#orderlist").html(data);
							$('#dataTables-example').dataTable();
							$("#success").html(errormessage);
							setTimeout( function() {$.fancybox.close(); },1200);
							
						}
					});
				}
				
			}
	</script>
<?php } ?>