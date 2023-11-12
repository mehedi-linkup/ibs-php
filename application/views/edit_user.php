<?php //echo $_REQUEST['ID'];
$query="select * from tr_user WHERE user_id ='".$_GET['ID']."'";
$result_id = mysql_query($query)or die(mysql_error());
$row= mysql_fetch_array($result_id);
$selected = $row['status'];
$selectedvedor = $row['vendorid'];
?>
                <div id="page-inner">
                      <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2 class="page-header">
                            <small>Update Your Information</small>
                        </h2>
                         <p id="success"></p> 
                         <form role="form" action="" method="post">
                         <input type="hidden" name="ID" id="ID" value="<?php echo $_GET['ID'];?>" />
                        	<div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">User Name</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="username" id="username" value="<?php echo $row['username'];?>">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Email</label>
                                <div class="col-md-7">
      										<input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email'];?>">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">User Role</label>
                                <div class="col-md-7">
      										<select class="form-control" id="userrole" name="userrole">
                                                <option value="3" <?php if($selected==3){echo "selected";}?>>Company</option>
                                                <option value="2" <?php if($selected==2){echo "selected";}?>>Buyer</option>
                                                <option value="1" <?php if($selected==1){echo "selected";}?>>Supper User</option>
                                                <option value="6" <?php if($selected==6){echo "selected";}?>>Team Member</option>
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; display:<?php if($selected==3){ echo "block";} else{ echo "none";}?>;" id="showdendor">
                                <label class="control-label col-md-5">Vendor Name</label>
                                <div class="col-md-7">
      										<select class="form-control" id="vendor_list" name="vendorid" onchange="(this.value)">
                                            	 <?php 
												$query2 ="select * from tr_company";
												$result2 = mysql_query($query2)or die(mysql_error());
												while($row2 = mysql_fetch_array( $result2 )){
												?>
                                                <option value="<?php echo $row2['vendor_id']; ?>" <?php if($selectedvedor==$row2['vendor_id']){echo "selected";}?>><?php echo $row2['vendor_name']; ?></option>
                                               <?php } ?>
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                            <label class="control-label col-md-5">&nbsp;</label>
                                             <input type="hidden" name="submit" value="edit_user" id="submit">
                                             <div class="col-md-7">
                                              <input type="button" class="btn btn-default" value="Update" onClick="ValiDate()">
                                            </div>
                                        </div>
                        </form>
                    </div>
                </div>
                 </div>
<script type="text/javascript">                 
// Email function
function IsEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}
$( "#userrole" ).change(function() {
	var chkuserrole = $('#userrole').val();
	if(chkuserrole == 3){
		$('#showdendor').show();
		}
	else{
		$('#showdendor').hide();
		}
  
});	
	
function ValiDate(){
				var id = $('#ID').val();
				var send = $('#submit').val();
				var username = $('#username').val();				
				var email = $('#email').val();
				var userrole = $('#userrole').val();
				if(userrole == 3){
					var vendor_list = $('#vendor_list').val();
					roleurl = '&userrole='+userrole+'&vendorid='+vendor_list;
					}
				else if(userrole == 1){
					roleurl = '&userrole='+userrole+'&vendorid=0';
					}
				else{
					roleurl = '&userrole='+userrole+'&vendorid=byer';
					}
				
				var err="";
				
				var errormessage = '';
				if(username == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
					$('#username').addClass('er');
				}
				else{$('#username').removeClass('er');}
								
				if(email == '' ){ errormessage = errormessage+'<span>Please enter your Email.</span>';
					$('#email').addClass('er');
				}
				else if(!IsEmail(email)){errormessage = errormessage+'<span>Please enter a valid Email.</span>';
					$('#email').addClass('er');
				}
				else{$('#email').removeClass('er');}
				
				
				if(errormessage==''){
				var errormessage = '<span style="color:#060;">Successfully Updated.</span>';
				var dataString = 'send='+send +'&id='+id+'&username='+username+roleurl+'&email='+email;
					$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							var err = data;
							if(err=="404"){
								alert("This user name and email Already exists Please select another username and email");
								}
						   else{
							$("#userlist").html(data);
							$('#dataTables-example').dataTable();
							$("#success").html(errormessage);
							setTimeout( function() {$.fancybox.close(); },1200);
						   }
							
						}
					});
				}
				
			}
</script>
