    <?php 
        $query="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor WHERE suplier.suplier_id ='".$_GET['ID']."'";
        $result_id = mysql_query($query)or die(mysql_error());
        $row = mysql_fetch_array($result_id);
        $selcom = $row['receive_to'];
        $selbuying = $row['buyerteam'];
        $isstatus = $this->session->userdata('status');
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
                    <label class="control-label col-md-5">Sl</label>
                    <div class="col-md-7" id="sandbox-container">
                            <div class="input-group ">
                                <input type="text" readonly class="form-control"  value="<?php echo $row['serial']; ;?>">
                            </div>
                    </div>
                </div>
                <!-- <div class="form-group" style="width:100%; float:left;">
                    <label class="control-label col-md-5">Sl</label>
                    <div class="col-md-7" id="sandbox-container">
                            <div class="input-group ">
                                <textarea class="form-control" disabled>
                                    <?php echo $row['serial'] ;?> 
                                </textarea>
                            </div>
                    </div>
                </div> -->
                
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
                                $query3 ="select * from tr_user Where status=6";
                            $result3 = mysql_query($query3)or die(mysql_error());
                            while($row3 = mysql_fetch_array($result3)){
                                ?>
                                <option value="<?php echo $row3['user_id'];?>" <?php if($row3['user_id']==$selbuying){echo "selected";}?>><?php echo $row3['username'];?></option>
                                <?php } ?>
                            
                        </select>
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left;">
                    <label class="control-label col-md-5">Vendor comments</label>
                    <div class="col-md-7">
                        <textarea class="form-control" rows="2" name="tgt_comment" id="tgt_comment"><?php echo $row['tgt_note'];?></textarea>
                    </div>
                </div>

                <div class="form-group" style="width:100%; float:left;">
                    <label class="control-label col-md-5">Upload File</label>
                    <div class="col-md-7">
                        <input type="file" name="file_name[]" id="fileInput" value="<?php echo $row['vendor_id'];?>" multiple>
                    </div>
                </div>
                <?php }
                if($isstatus=="999"){
                ?>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5"> Select  User </label>
                    <div class="col-md-7">
                        <select class="form-control" id="userslt1" name="userslt1">
                            <option value="" selected>Select User</option>
                                <?php 
                                $query3 ="select * from tr_user Where status=1";
                            $result3 = mysql_query($query3)or die(mysql_error());
                            while($row3 = mysql_fetch_array($result3)){
                                ?>
                                <option value="<?php echo $row3['user_id'];?>" <?php if($row3['user_id']==$selcom){echo "selected";}?>><?php echo $row3['username'];?></option>
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
                                $query3 ="select * from tr_user Where status=6";
                            $result3 = mysql_query($query3)or die(mysql_error());
                            while($row3 = mysql_fetch_array($result3)){
                                ?>
                                <option value="<?php echo $row3['user_id'];?>" <?php if($row3['user_id']==$selbuying){echo "selected";}?>><?php echo $row3['username'];?></option>
                                <?php } ?>
                            
                        </select>
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5">Style no</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="styleno" id="styleno" style="height:30px;" value="<?php echo $row['style'];?>">
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;display: none;">
                    <label class="control-label col-md-5">Pk no</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="Pkno" id="pkno" style="height:30px;" value="<?php echo $row['pack_no'];?>">
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5">Color</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="color" id="color" style="height:30px;" value="<?php echo $row['color'];?>">
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5">Item Description </label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="description" id="description" style="height:30px;" value="<?php echo $row['item_desc'];?>">
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5">Submittied For Approval On</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="submit_approval" id="submit_approval" style="height:30px;" value="<?php echo $row['submitfor_approval'];?>">
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5">Submission No</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="submittion_no" id="submittion_no" style="height:30px;" value="<?php echo $row['submition_no'];?>">
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left;">
                    <label class="control-label col-md-5">Vendor comments</label>
                    <div class="col-md-7">
                        <textarea class="form-control" rows="2" name="tgt_comment" id="tgt_comment"><?php echo $row['tgt_note'];?></textarea>
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                    <label class="control-label col-md-5">Approve/Reject</label>
                    <div class="col-md-7">
                        <label class="radio-inline">
                            <input type="radio" value="1" <?php if($row['approve']==1){echo "checked";}?> id="optionsRadiosInline1" name="approved">Approved
                        </label>
                        <label class="radio-inline">
                            <input type="radio" value="3" <?php if($row['approve']==3){echo "checked";}?> id="optionsRadiosInline3" name="approved">Conditionally approved
                        </label>
                        <label class="radio-inline">
                            <input type="radio" value="2" <?php if($row['approve']==2){echo "checked";}?> id="optionsRadiosInline2" name="approved">Rejected
                        </label>
                        <label class="radio-inline">
                            <input type="radio" value="0" <?php if($row['approve']==0){echo "checked";}?> id="optionsRadiosInline4" name="approved">Reset
                        </label>
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; display:none;" id="rej">
                    <label class="control-label col-md-5">USA Sample comments</label>
                    <div class="col-md-7">
                        <textarea class="form-control" rows="2" name="tssq_comment" id="tssq_comment"><?php echo $row['buyer_comments'];?></textarea>
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left;">
                    <label class="control-label col-md-5">Upload File</label>
                    <div class="col-md-7">
                        <input type="file" name="file_name[]" id="fileInput" value="<?php echo $row['vendor_id'];?>" multiple>
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
                        <textarea class="form-control" rows="2" name="tgt_comment" id="tgt_comment"><?php echo $row['tgt_note'];?></textarea>
                    </div>
                </div>
                <?php }?>
                <div class="form-group" style="width:100%; float:left;">
                    <label class="control-label col-md-5">&nbsp;</label>
                        <input type="hidden" name="submit" value="supadupdate" id="submit">
                        <div class="col-md-7">
                    <input type="button" class="btn btn-default" value="Add Sending Date" onClick="ValiDate()">
                    </div>
                </div>
                <?php }
                else if($role=="byer"){
                ?>
                <p id="success"></p> 
                <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                    <label class="control-label col-md-5">SL</label>
                    <div class="col-md-7">
                                <div class="form-control" style="height:26px; padding:2px 12px;"><?php echo $row['serial'];?></div>
                    </div>
                </div>
                
                <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                    <label class="control-label col-md-5">Sending Date</label>
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
                        <textarea class="form-control" disabled>
                            <?php echo $row['style'];?>
                        </textarea>
                    </div>
                </div>
            <!--           <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">-->
            <!--                <label class="control-label col-md-5">Pk no</label>-->
            <!--                <div class="col-md-7">-->
                                        <!--<div class="form-control" style="height:26px; padding:2px 12px;"><?php //echo $row['pack_no'];?></div>-->
            <!--                </div>-->
            <!--            </div>-->
                <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                    <label class="control-label col-md-5">Color</label>
                    <div class="col-md-7">
                                <div class="form-control" style="height:26px; padding:2px 12px;"><?php echo $row['color'];?></div>
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom: 7px;">
                    <label class="control-label col-md-5">Approve/Reject</label>
                    <div class="col-md-7">
                                    <label class="radio-inline">
                                    <input type="radio" value="1" <?php if($row['approve']==1){echo "checked";}?> id="optionsRadiosInline1" name="approved">Approved
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="3" <?php if($row['approve']==3){echo "checked";}?> id="optionsRadiosInline3" name="approved">Conditionally approved
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="2" <?php if($row['approve']==2){echo "checked";}?> id="optionsRadiosInline2" name="approved">Rejected
                                </label>
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; display:none;" id="rej">
                    <label class="control-label col-md-5">USA Sample comments</label>
                    <div class="col-md-7">
                        <textarea class="form-control" rows="2" name="tssq_comment" id="tssq_comment"><?php echo $row['buyer_comments'];?></textarea>
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left;">
                    <label class="control-label col-md-5">&nbsp;</label>
                        <input type="hidden" name="submit" value="buyersuplierupdate" id="submit">
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
                    <label class="control-label col-md-5"> Select User </label>
                    <div class="col-md-7">
                                <select class="form-control" id="userslt" name="userslt">
                                    <option value="" selected>Select User</option>
                                        <?php 
                                        $query3 ="select * from tr_user Where status=1";
                                    $result3 = mysql_query($query3)or die(mysql_error());
                                    while($row3 = mysql_fetch_array($result3)){
                                        ?>
                                        <option value="<?php echo $row3['user_id'];?>" <?php if($row3['user_id']==$selcom){echo "selected";}?>><?php echo $row3['username'];?></option>
                                        <?php } ?>
                                    
                                </select>
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5">Style no</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="styleno" id="styleno" style="height:30px;" value="<?php echo $row['style'];?>">
                    </div>
                </div>
            <!--            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">-->
            <!--                <label class="control-label col-md-5">Pk no</label>-->
            <!--                <div class="col-md-7">-->
                                        <!--<input type="text" class="form-control" name="Pkno" id="pkno" style="height:30px;" value="<?php// echo $row['pack_no'];?>">-->
            <!--                </div>-->
            <!--            </div>-->
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5">Color</label>
                    <div class="col-md-7">
                                <input type="text" class="form-control" name="color" id="color" style="height:30px;" value="<?php echo $row['color'];?>">
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5">Item Description </label>
                    <div class="col-md-7">
                                <input type="text" class="form-control" name="description" id="description" style="height:30px;" value="<?php echo $row['item_desc'];?>">
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5">Submittied For Approval On</label>
                    <div class="col-md-7">
                                <input type="text" class="form-control" name="submit_approval" id="submit_approval" style="height:30px;" value="<?php echo $row['submitfor_approval'];?>">
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5">Submission No</label>
                    <div class="col-md-7">
                                <input type="text" class="form-control" name="submittion_no" id="submittion_no" style="height:30px;" value="<?php echo $row['submition_no'];?>">
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left;">
                    <label class="control-label col-md-5">Vendor comments</label>
                    <div class="col-md-7">
                        <textarea class="form-control" rows="2" name="tgt_comment" id="tgt_comment"><?php echo $row['tgt_note'];?></textarea>
                    </div>
                </div>
                <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                    <label class="control-label col-md-5">&nbsp;</label>
                        <input type="hidden" name="submit" value="edit_suplier" id="submit">
                        <div class="col-md-7">
                    <input type="button" id="myid" class="btn btn-default" value="Update Order" onClick="ValiDate()">
                    </div>
                </div>
                <?php } ?>
            </form> 
            </div>
        </div>
    </div>

    <?php if(($role=="0") || ($role=="assist")) { ?>
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
                //alert($(this).attr('id'));
                if($(this).attr('id') == 'optionsRadiosInline3') {
                    $('#rej').show();           
                }
                else if($(this).attr('id') == 'optionsRadiosInline2') {
                    $('#rej').show();           
                }
                else{
                    $('#rej').hide();   
                }
            }); 
        });    
                     
	function ValiDate(){  
       
		$("#myid").attr("disabled", true);
        var id = $('#ID').val();
        var send = $('#submit').val();
        var vendorname = $('#vendor').val();
        var team = $('#userslt').val();
        var team1 = $('#userslt1').val();
        var tgt_comment = $('#tgt_comment').val();		
        var setdate = $('#setdate').val();
        var styleno = $('#styleno').val();
        var pkno = $('#pkno').val();
        var color = $('#color').val();
        var description = $('#description').val();
        var submit_approval = $('#submit_approval').val();
        var submittion_no = $('#submittion_no').val();
        var tssq_comment = $('#tssq_comment').val();
        var approve_status= $('input[name=approved]:checked').val();

        // var formData = new FormData();
        // formData.append("file", 234);
        // formData.append('approved', 4324);

        // console.log(formData);
        // return;
        
        var err="";
        
        var errormessage = '';
        if(setdate == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
            $('#setdate').addClass('er');
        }
        else{$('#setdate').removeClass('er');}
        
        if(tgt_comment == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
            $('#tgt_comment').addClass('er');
        }
        else{$('#tgt_comment').removeClass('er');}
        if(team == ''){ errormessage = errormessage+'<span>Please Select Buyer.</span>';
            $('#userslt').addClass('er');
        }
        else{$('#userslt').removeClass('er');}
        
        if(errormessage==''){
        var errormessage = '<span style="color:#060;">Successfully Add Sending Date.</span>';

        const fileInput = document.getElementById('fileInput');
        const selectedFile = fileInput.files[0];

        <?php if($isstatus == '1'){?>
            var formData = new FormData();
            formData.append("send", send);
            formData.append("id", id);
            formData.append("vendorname", vendorname);
            formData.append("team", team);
            formData.append("setdate", setdate);
            formData.append("tgt_comment", escape(tgt_comment));
            // formData.append("file", selectedFile);
            var  totalfiles = document.getElementById('fileInput').files.length;
            for (var index = 0; index < totalfiles; index++) {
                formData.append("files[]", document.getElementById('fileInput').files[index]);
            }
            // var dataString = 'send='+send +'&id='+id+'&vendorname='+vendorname+'&team='+team+'&setdate='+setdate+'&tgt_comment='+escape(tgt_comment);
        <?php } if($isstatus == '999'){ ?>
        // var dataString = 'send='+escape(send) +'&id='+escape(id)+'&vendorname='+escape(vendorname)+'&team='+escape(team)+'&team1='+escape(team1)+'&setdate='+escape(setdate)+'&styleno='+escape(styleno)+'&pkno='+escape(pkno)+'&color='+escape(color)+'&description='+escape(description)+'&submit_approval='+escape(submit_approval)+'&submittion_no='+escape(submittion_no)+'&tgt_comment='+escape(tgt_comment)+'&tssq_comment='+escape(tssq_comment)+'&approve_status='+escape(approve_status);
        var formData = new FormData();
        formData.append("send", escape(send));
        formData.append("id", escape(id));
        formData.append("vendorname", escape(vendorname));
        formData.append("team", escape(team));
        formData.append("team1", escape(team1));
        formData.append("setdate", escape(setdate));
        formData.append("styleno", escape(styleno));
        formData.append("pkno", escape(pkno));
        formData.append("color", escape(color));
        formData.append("description", escape(description));
        formData.append("submit_approval", escape(submit_approval));
        formData.append("submittion_no", escape(submittion_no));
        formData.append("tgt_comment", escape(tgt_comment));
        formData.append("tssq_comment", escape(tssq_comment));
        formData.append("approve_status", escape(approve_status));
        // formData.append("file", selectedFile);
        var  totalfiles = document.getElementById('fileInput').files.length;
            for (var index = 0; index < totalfiles; index++) {
                formData.append("files[]", document.getElementById('fileInput').files[index]);
            }

        <?php }?>
            //alert(dataString);
            $.ajax({
                type: "POST",
                url: "ajax_postdata",
                data: formData,
                processData: false, 
                contentType: false, 
                success: function(data){
                    $("#supplierlist").html(data);
                    $('#dataTables-example').dataTable();
                    $("#success").html(errormessage);
                    setTimeout( function() {$.fancybox.close(); }, 1200);
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
	                    //alert($(this).attr('id'));
					   if($(this).attr('id') == 'optionsRadiosInline3') {
							$('#rej').show();           
					   }
					   
					   else if($(this).attr('id') == 'optionsRadiosInline2') {
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
				var dataString = 'send='+escape(send) +'&id='+escape(id)+'&tssq_comment='+escape(tssq_comment)+'&approve_status='+escape(approve_status);
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
				
				
				
					if(tgt_comment == ''){ errormessage = errormessage+'<span>Please enter your Branch.</span>';
					$('#tgt_comment').addClass('er');
				}
				else{$('#tgt_comment').removeClass('er');}
				
				if(errormessage==''){
				var errormessage = '<span style="color:#060;">Successfully Update Suplier.</span>';
				var dataString = 'send='+escape(send) +'&id='+escape(id)+'&vendorname='+escape(vendorname)+'&team='+escape(team)+'&styleno='+escape(styleno)+'&pkno='+escape(pkno)+'&color='+escape(color)+'&description='+escape(description)+'&submit_approval='+escape(submit_approval)+'&submittion_no='+escape(submittion_no)+'&tgt_comment='+escape(tgt_comment);
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
<?php } ?>