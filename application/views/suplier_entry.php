<?php $role = $this->session->userdata('verdorid');
$query3 ="select * from tr_company Where vendor_id='$role'";
$result3 = mysql_query($query3)or die(mysql_error());
$row3 = mysql_fetch_array( $result3 );
?>
                <div id="page-inner">
                      <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                         <h2 class="page-header" style="margin-bottom:10px; margin-top:0;">
                            <small>Add Your Information</small>
                        </h2>
                        <form role="form" action="" method="post">
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
													$query3 ="select * from tr_user Where status=1";
												$result3 = mysql_query($query3)or die(mysql_error());
												while($row3 = mysql_fetch_array($result3)){
													?>
                                                 <option value="<?php echo $row3['user_id'];?>"><?php echo $row3['username'];?></option>
                                                 <?php } ?>
                                                
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Style no</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="styleno" id="styleno" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;display: none;">
                                <label class="control-label col-md-5">Pk no</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="Pkno" id="pkno" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Color</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="color" id="color" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Item Description </label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="description" id="description" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Submittied For Approval On</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="submit_approval" id="submit_approval" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Submission No</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="submittion_no" id="submittion_no" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">vendor comments</label>
                                <div class="col-md-7">
                                	<textarea class="form-control" rows="2" name="tgt_comment" id="tgt_comment"></textarea>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                            <label class="control-label col-md-5">&nbsp;</label>
                                             <input type="hidden" name="submit" value="supplier" id="submit">
                                             <div class="col-md-7">
                                            <input type="button" id="myid" class="btn btn-default" value="Add New Order" onClick="ValiDate()">
                                            </div>
                                        </div>
                        </form> 
                        </div>
                     </div>
                 </div>


  <script type="text/javascript">                 
	function ValiDate(){

		$("#myid").attr("disabled", true);
				var send = $('#submit').val();
				var team = $('#userslt').val();
				var vendorname = $('#vendor').val();				
				var styleno = $('#styleno').val();
				var color = $('#color').val();
				var description = $('#description').val();				
				var submit_approval = $('#submit_approval').val();
				var submittion_no = $('#submittion_no').val();
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
				
				if(description == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#description').addClass('er');
				}
				else{$('#description').removeClass('er');}
				
				if(submit_approval == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#submit_approval').addClass('er');
				}
				else{$('#submit_approval').removeClass('er');}
				
				if(submittion_no == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#submittion_no').addClass('er');
				}
				else{$('#submittion_no').removeClass('er');}
				
				if(team == '' ){ errormessage = errormessage+'<span>Please enter your Email.</span>';
					$('#userslt').addClass('er');
				}
				else{$('#userslt').removeClass('er');}
				
				
				
				
				
					
				if(tgt_comment == '' ){ errormessage = errormessage+'<span>Please enter your Email.</span>';
					$('#tgt_comment').addClass('er');
				}
				else{$('#tgt_comment').removeClass('er');}
				
				
					if(errormessage != ""){
					$("#myid").removeAttr("disabled");
				}
				
				if(errormessage==''){
				var errormessage = '<span style="color:#060;">Successfully Added New Supplier.</span>';
				var dataString = 'send='+escape(send) +'&vendorname='+escape(vendorname)+'&team='+escape(team)+'&styleno='+escape(styleno)+'&pkno='+escape(pkno)+'&color='+escape(color)+'&description='+escape(description)+'&submit_approval='+escape(submit_approval)+'&submittion_no='+escape(submittion_no)+'&tgt_comment='+escape(tgt_comment);
					$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							$("#supplierlist").html(data);
							$('#dataTables-example').dataTable();
							$("#success").html(errormessage);
							setTimeout( function() {$.fancybox.close(); },1200);
							
						}
					});
				}
				
			}
	</script>
