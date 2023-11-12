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
                            <small>Change your profile Information</small>
                        </h2>
                        <h4><strong><?php echo "Hello ".$row['username'];?></strong></h4>
                         <p id="success"></p> 
                         <form role="form" action="" method="post">
                         <input type="hidden" name="ID" id="ID" value="<?php echo $sessiondata;?>" />
                        	<div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">User Name</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="username" id="username" value="<?php echo $row['username'];?>" <?php if($sessiondata = $this->session->userdata('username')=='admin'){
      										}else{echo 'readonly';} ?>>
                                </div>
                            </div>
                            
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Email</label>
                                <div class="col-md-7">
      										<input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email'];?>" <?php if($sessiondata = $this->session->userdata('username')=='admin'){
      										}else{echo 'readonly';} ?>>
                                </div>
                            </div>
                            
                            <div class="form-group" style="width:100%; float:left;">
                                            <label class="control-label col-md-5">&nbsp;</label>
                                             <input type="hidden" name="submit" value="change_info" id="submit">
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
	
function ValiDate(){
				var id = $('#ID').val();
				var send = $('#submit').val();
				var username = $('#username').val();				
				var email = $('#email').val();
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
				var errormessage = '<span style="color:#060;">Successfully Change your Information.</span>';
				var dataString = 'send='+send +'&id='+id+'&username='+username+'&email='+email;
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
							$("#success").html(errormessage);
							setTimeout( function() {$.fancybox.close(); },1200);
						   }
							
						}
					});
				}
				
			}
</script>
