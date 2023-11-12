<?php //session_start();
$sessiondata = $this->session->userdata('username');
$query="select * from tr_user WHERE user_id ='".$sessiondata."'";
$result_id = mysql_query($query)or die(mysql_error());
$row= mysql_fetch_array($result_id);
$selected = $row['status'];
?>
               
                <div id="page-inner">
                      <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2 class="page-header">
                            <small>Change your Password</small>
                        </h2>
                        <h4><b><?php echo "Hello ".$row['username'];?></b></h4>
                         <p id="success"></p> 
                         <form role="form" action="" method="post">
                         <input type="hidden" name="ID" id="ID" value="<?php echo $sessiondata;?>" />
                        	<div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Enter Old Password</label>
                                <div class="col-md-7">
      										<input type="password" class="form-control" name="oldpassword" id="password" value="">
                                </div>
                            </div>
                            
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Enter New Password</label>
                                <div class="col-md-7">
      										<input type="password" class="form-control" name="newpassword" id="password2" value="">
                                </div>
                            </div>
                            
                            <div class="form-group" style="width:100%; float:left;">
                                            <label class="control-label col-md-5">&nbsp;</label>
                                             <input type="hidden" name="submit" value="change_pass" id="submit">
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
function ValiDate(){
				var id = $('#ID').val();
				var send = $('#submit').val();
				var oldpass = $('#password').val();	
				var newpass = $('#password2').val();				
				var err="";
				//alert(oldpass);
				
				var errormessage = '';
				if(oldpass == ''){ errormessage = errormessage+'<span>Please Old Password.</span>';
					$('#password').addClass('er');
				}
				else{$('#password').removeClass('er');}
				
				if(newpass == '' ){ errormessage = errormessage+'<span>Please enter New Password.</span>';
					$('#password2').addClass('er');
				}
				else{$('#password2').removeClass('er');}
				
				
				if(errormessage==''){
				var errormessage = '<span style="color:#060;">Successfully Update your Password.</span>';
				var dataString = 'send='+send +'&id='+id+'&oldpass='+oldpass+'&newpass='+newpass;
					$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							var err = data;
							//alert(err);
							if(err=="404"){
								alert("Your Old Password Not Match .Please enter again your Old password");
								}
						   else{
							$("#success").html(errormessage);
							setTimeout( function() {$.fancybox.close(); },1200);
						   }
							
						}
					});
				}
				
			}
</script>
