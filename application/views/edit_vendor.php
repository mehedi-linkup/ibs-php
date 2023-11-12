  <?php 
$query="select * from tr_company WHERE 	vendor_id ='".$_GET['ID']."'";
$result_id = mysql_query($query)or die(mysql_error());
$row= mysql_fetch_array($result_id);
?>              
                <div id="page-inner">
                      <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                         <h2 class="page-header">
                            <small>Update Vendor</small>
                        </h2>
                         <p id="success"></p> 
                        <form role="form" action="" method="post">
                        	<input type="hidden" name="ID" id="ID" value="<?php echo $_GET['ID'];?>" />
                            <div class="form-group" style="width:100%; float:left;">
                                <label class="control-label col-md-5">Enter Vendor Name</label>
                                <div class="col-md-7">
      										<input type="text" class="form-control" name="vemdor" id="vendor" value="<?php echo $row['vendor_name'];?>"> 
                                </div>
                            </div>
                            
                            <div class="form-group" style="width:100%; float:left;">
                                            <label class="control-label col-md-5">&nbsp;</label>
                                            <input type="hidden" name="submit" value="edit_vendor" id="submit">
                                             <div class="col-md-7">
                                             <input type="button" class="btn btn-default" value="Update Vendor" onClick="ValiDate()">
                                            </div>
                                        </div>
                        </form> 
                        </div>
                     </div>
                 </div>
<script>
        $(document).ready(function() {       
          $('#sandbox-container .input-group.date').datepicker({
				format: "dd-mm-yyyy",
				autoclose: true
			});
        }); 
		
		function ValiDate(){
				var id = $('#ID').val();
				var send = $('#submit').val();
				var vendor = $('#vendor').val();				
				var err="";
				
				var errormessage = '';
				if(vendor == ''){ errormessage = errormessage+'<span>Please enter your Vendor Name.</span>';
					$('#vendor').addClass('er');
				}
				else{$('#vendor').removeClass('er');}
				
				if(errormessage==''){
				var errormessage = '<span style="color:#060;">Successfully Updated.</span>';
				var dataString = 'send='+send +'&id='+id+'&vendor='+vendor;
					$.ajax({
						type: "POST",
						url: "ajax_postdata",
						data: dataString,
						success: function(data){
							var err = data;
							if(err=="404"){
								alert("This Vendor Already exists Please select another One");
								}
						   else{
							$("#vendorlist").html(data);
							$('#dataTables-example').dataTable();
							$("#success").html(errormessage);
							setTimeout( function() {$.fancybox.close(); },1200);
						   }
							
						}
					});
				}
				
			}  
    </script>