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
                                <label class="control-label col-md-5"> Sample Method </label>
                                <div class="col-md-7">
      										<select class="form-control" id="smethod" name="Sample_Method">
                                            	<option value="" selected>Select Method</option>
                                                 <option value="LA Sample">LA Sample</option>
                                                 <option value="Fit Sample">Fit Sample</option>
                                                 <option value="PP Sample">PP Sample</option>
                                                 <option value="DC Sample">DC Sample</option>
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Size</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="Size" id="size" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Fabirc- available/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="fabric" id="fabric" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Care Label-avalable/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="care_lebel" id="care_lebel" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Others trims & accessories</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="hanger" id="hanger" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;display: none;">
                                <label class="control-label col-md-5">Price tag-avalable/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="price_tag" id="price_tag" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%;display: none; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Sewing tag-avalable/ actual</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="sewing_tag" id="sewing_tag" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label class="control-label col-md-5">Sample Quantity/PCS (for Assesment)</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="sample_quantity" id="sample_quantity" style="height:30px;">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Vendor  comments</label>
                                <div class="col-md-7">
                                	<textarea class="form-control" rows="2" name="tgt_comment" id="tgt_comment"></textarea>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                            <label class="control-label col-md-5">&nbsp;</label>
                                             <input type="hidden" name="submit" value="order" id="submit">
                                             <div class="col-md-7">
                                            <input type="button"  class="btn btn-default" id="myid" value="Add New Order" onClick="ValiDate()">
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
				
			     
			     
			     
			     	if(team == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#userslt').addClass('er');
				}
				else{$('#userslt').removeClass('er');}
				
				
				
				
				
					if(hanger == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#hanger').addClass('er');
				}
				else{$('#hanger').removeClass('er');}
				
				
				
					if(sample_quantity == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#sample_quantity').addClass('er');
				}
				else{$('#sample_quantity').removeClass('er');}
				
				
				
				var tgt_comment = $('#tgt_comment').val();
				
				if(tgt_comment == ''){ 
					    errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#tgt_comment').addClass('er');
				}
				else{$('#tgt_comment').removeClass('er');}
				if(errormessage != ""){
					$("#myid").removeAttr("disabled");
				}
				
				if(errormessage==''){
				var errormessage = '<span style="color:#060;">Successfully Added Order.</span>';
				var dataString = 'send='+escape(send) +'&vendorname='+escape(vendorname)+'&team='+escape(team)+'&styleno='+escape(styleno)+'&pkno='+escape(pkno)+'&color='+escape(color)+'&smethod='+escape(smethod)+'&size='+escape(size)+'&fabric='+escape(fabric)+'&care_lebel='+escape(care_lebel)+'&hanger='+escape(hanger)+'&price_tag='+escape(price_tag)+'&sewing_tag='+escape(sewing_tag)+'&sample_quantity='+escape(sample_quantity)+'&tgt_comment='+escape(tgt_comment);
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
