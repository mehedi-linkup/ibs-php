                <div id="page-inner">
                      <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2 class="page-header">
                            <small>Create New User</small>
                        </h2>
                         <p id="success"></p> 
                         <form role="form" action="" method="post">
                        	<div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">User Name</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="username" id="username">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Password</label>
                                <div class="col-md-7">
      										<input type="password" class="form-control" name="password" id="password">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Email</label>
                                <div class="col-md-7">
      										<input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">User Role</label>
                                <div class="col-md-7">
      										<select class="form-control" id="userrole" name="userrole">
                                            	<option value="" selected>Select User Type</option>
                                                <option value="3">Company</option>
                                                <option value="2">Buyer</option>
                                                <option value="1">Supper User</option>
                                                <option value="6">Team Member</option>
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left; display:none;" id="showdendor">
                                <label class="control-label col-md-5">Vendor Name</label>
                                <div class="col-md-7">
      										<select class="form-control" id="vendor_list" name="vendorid" onchange="(this.value)">
                                            	 <?php 
												$query2 ="select * from tr_company";
												$result = mysql_query($query2)or die(mysql_error());
												while($row = mysql_fetch_array( $result )){
												?>
                                                <option value="<?php echo $row['vendor_id']; ?>"><?php echo $row['vendor_name']; ?></option>
                                               <?php } ?>
                                            </select>
                                </div>
                            </div>
                            <div class="form-group" style="width:100%; float:left;">
                                            <label class="control-label col-md-5">&nbsp;</label>
                                             <input type="hidden" name="submit" value="add_user" id="submit">
                                             <div class="col-md-7">
                                              <input type="button" class="btn btn-default" value="Add New User" onClick="ValiDate()">
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
				var roleurl ='';
				var send = $('#submit').val();
				var username = $('#username').val();				
				var password = $('#password').val();
				var email = $('#email').val();
				var userrole = $('#userrole').val();
				
				if(userrole == 3){
					//alert(userrole);
					var vendor_list = $('#vendor_list').val();
					roleurl = '&userrole='+userrole+'&vendorid='+vendor_list;
					}
				else if(userrole == 1){
					roleurl = '&userrole='+userrole+'&vendorid=0';
					}
				else{
					//alert("False");
					roleurl = '&userrole='+userrole+'&vendorid=byer';
					}
				var err="";
				
				var errormessage = '';
				if(username == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
					$('#username').addClass('er');
				}
				else{$('#username').removeClass('er');}
				
				if(password == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#password').addClass('er');
				}
				else{$('#password').removeClass('er');}
				
				if(userrole == ''){ errormessage = errormessage+'<span>Address Not Empty.</span>';
					$('#userrole').addClass('er');
				}
				else{$('#userrole').removeClass('er');}
								
				if(email == '' ){ errormessage = errormessage+'<span>Please enter your Email.</span>';
					$('#email').addClass('er');
				}
				else if(!IsEmail(email)){errormessage = errormessage+'<span>Please enter a valid Email.</span>';
					$('#email').addClass('er');
				}
				else{$('#email').removeClass('er');}
				
				
				
				
				
				
				if(errormessage==''){
				var errormessage = '<span style="color:#060;">Successfully Added.</span>';
				var dataString = 'send='+send +'&username='+username+'&password='+password+roleurl+'&email='+email;
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
