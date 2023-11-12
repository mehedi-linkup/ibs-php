<?php 
if($_POST['send'] == 'add_user'){
	$username = $_POST['username'];	
	$password = md5($_POST['password']);	
	$userrole = $_POST['userrole'];	
	$vendor = $_POST['vendorid'];
	$email = $_POST['email'];	
	
$query2 ="select * from tr_user where username='$username' OR email='$email'";
$result = mysql_query($query2)or die(mysql_error());
$row = mysql_fetch_array( $result );
if (mysql_num_rows($result) >0) {
  echo "404";
}else{
	$query = "INSERT INTO tr_user(username, password, email, status, vendorid)
	VALUES('$username', '$password', '$email', '$userrole', '$vendor')";
	mysql_query($query) or die(mysql_error());	
?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
			<th>SI NO.</th>
			<th>Username</th>
			<th>Email</th>
			<th>User Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	$userid = $this->session->userdata('username');
	$query2 = "select * from tr_user where user_id!='".$userid."'";
	$result = mysql_query($query2)or die(mysql_error());
	while($row = mysql_fetch_array( $result )){
		$i++;
	if($i%2 ==0){
	?>
		<tr class="odd gradeX">
		<?php }
		else{
		?>
			<tr class="even gradeC">
			<?php } ?>
			<td><?php echo $i-1;?></td>
			<td><?php echo $row['username'];?></td>
			<td><?php echo $row['email'];?></td>
			<td><?php $status= $row['status'];
			if($status==3){
				echo "Company";
				}
			if($status==2){
				echo "Buyer";
				}
			if($status==1){
				echo "Supper User";
				}
			if($status==6){
				echo "Team";
				}
			?></td>
			<td><a class="btn btn-primary fancybox fancybox.ajax"  href="edit_user?ID=<?php echo $row['user_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteuser(<?php echo $row['user_id'];?>);"><i class="fa fa-pencil"></i> Delete</a></td>
		</tr>
		<?php } ?>
		
	</tbody>
</table>	
<?php } } 
if($_POST['send'] == 'edit_user') {
	$username = $_POST['username'];	
	$userrole = $_POST['userrole'];	
	$email = $_POST['email'];
	$vendor = $_POST['vendorid'];	
	
	$query2 ="select * from tr_user where username='$username' OR email='$email'";
	$result = mysql_query($query2)or die(mysql_error());
	$row = mysql_fetch_array( $result );
if (mysql_num_rows($result) >1) {
  echo "404";
} 
else{
	mysql_query("UPDATE tr_user SET username = '$username', email='$email', status='$userrole', vendorid='$vendor'  WHERE user_id ='".$_POST['id']."'") or die(mysql_error());?>

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
			<th>SI NO.</th>
			<th>Username</th>
			<th>Email</th>
			<th>User Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$i=1;
		$userid = $this->session->userdata('username');
		$query2 ="select * from tr_user where user_id!='".$userid."'";
		$result = mysql_query($query2)or die(mysql_error());
		while($row = mysql_fetch_array( $result )){
			$i++;
		if($i%2 ==0){
	?>
		<tr class="odd gradeX">
		<?php }
		else{
		?>
			<tr class="even gradeC">
			<?php } ?>
			<td><?php echo $i-1;?></td>
			<td><?php echo $row['username'];?></td>
			<td><?php echo $row['email'];?></td>
			<td><?php $status= $row['status'];
			if($status==3){
				echo "Company";
				}
			if($status==2){
				echo "Buyer";
				}
			if($status==1){
				echo "Supper User";
				}
			if($status==6){
				echo "Team";
				}
			?></td>
			<td><a class="btn btn-primary fancybox fancybox.ajax"  href="edit_user?ID=<?php echo $row['user_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteuser(<?php echo $row['user_id'];?>);"><i class="fa fa-pencil"></i> Delete</a></td>
		</tr>
		<?php } ?>
		
	</tbody>
</table>

<?php } }
if($_POST['send'] == 'DELETE'){
	$uid = $_POST['id'];	
	mysql_query("DELETE FROM tr_user WHERE user_id = '$uid'") or die(mysql_error()); ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th>SI NO.</th>
				<th>Username</th>
				<th>Email</th>
				<th>User Type</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$i=1;
		$userid = $this->session->userdata('username');
		$query2 ="select * from tr_user where user_id!='".$userid."'";
		$result = mysql_query($query2)or die(mysql_error());
		while($row = mysql_fetch_array( $result )){
			$i++;
		if($i%2 ==0){
		?>
			<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $i-1;?></td>
				<td><?php echo $row['username'];?></td>
				<td><?php echo $row['email'];?></td>
				<td><?php $status= $row['status'];
				if($status==3){
					echo "Company";
					}
				if($status==2){
					echo "Buyer";
					}
				if($status==1){
					echo "Supper User";
					}
				if($status==6){
					echo "Team";
					}
				?></td>
				<td><a class="btn btn-primary fancybox fancybox.ajax"  href="edit_user?ID=<?php echo $row['user_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteuser(<?php echo $row['user_id'];?>);"><i class="fa fa-pencil"></i> Delete</a></td>
			</tr>
			<?php } ?>
			
		</tbody>
	</table>
<?php }
if($_POST['send'] == 'change_info'){
	$username = $_POST['username'];	
	$email = $_POST['email'];	
	
	$query2 ="select * from tr_user where username='$username' OR email='$email'";
	$result = mysql_query($query2)or die(mysql_error());
	$row = mysql_fetch_array( $result );
	if (mysql_num_rows($result) >1) {
	echo "404";
	} 
	else{
	mysql_query("UPDATE tr_user SET username = '$username', email='$email' WHERE user_id ='".$_POST['id']."'") or die(mysql_error());?>
	
<?php } }
if($_POST['send'] == 'change_pass'){
	$oldpass = md5($_POST['oldpass']);	
	$newpass = md5($_POST['newpass']);	
	$userid = $_POST['id'];	
	
	$query2 = "select * from tr_user where user_id='$userid'";
	$result = mysql_query($query2)or die(mysql_error());
	$row = mysql_fetch_array( $result );
	$checkpass = $row['password'];
if ($checkpass == md5($_POST['oldpass'])) {
  	mysql_query("UPDATE tr_user SET password = '$newpass' WHERE user_id ='".$userid."'") or die(mysql_error());
} 
else{
	echo "404";
  }
  }
if($_POST['send'] == 'add_vendor'){
	$vendorname = $_POST['vendor'];	
	
	$query2 ="select * from tr_company where vendor_name='$vendorname'";
	$result = mysql_query($query2)or die(mysql_error());
	$row = mysql_fetch_array( $result );
if (mysql_num_rows($result) >0) {
  echo "404";
} 
else{
$query = "INSERT INTO tr_company(vendor_name)
VALUES('$vendorname')";
mysql_query($query) or die(mysql_error());	
?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
			<th>SI</th>
			<th>Vendor/ComPany</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$i=1;
		$query2 ="select * from tr_company";
		$result = mysql_query($query2)or die(mysql_error());
	while($row = mysql_fetch_array( $result )){
		$i++;
	if($i%2 ==0){
	?>
		<tr class="odd gradeX">
		<?php }
		else{
		?>
			<tr class="even gradeC">
			<?php } ?>
			<td><?php echo $i-1;?></td>
			<td><?php echo $row['vendor_name'];?></td>
			<td><a class="btn btn-primary fancybox fancybox.ajax"  href="edit_vendor?ID=<?php echo $row['vendor_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletevendor(<?php echo $row['vendor_id'];?>);"><i class="fa fa-pencil"></i> Delete</a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php } } 
if($_POST['send'] == 'edit_vendor'){
	$vendorname = $_POST['vendor'];	
	
$query2 ="select * from tr_company where vendor_name='$vendorname'";
$result = mysql_query($query2)or die(mysql_error());
$row = mysql_fetch_array( $result );
if (mysql_num_rows($result) >1) {
  echo "404";
} 
else{
mysql_query("UPDATE tr_company SET vendor_name = '$vendorname' WHERE vendor_id ='".$_POST['id']."'") or die(mysql_error());	
?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
			<th>SI</th>
			<th>Vendor/ComPany</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
	$i=1;
	$query2 ="select * from tr_company";
	$result = mysql_query($query2)or die(mysql_error());
	while($row = mysql_fetch_array( $result )){
		$i++;
	if($i%2 ==0){
	?>
		<tr class="odd gradeX">
		<?php }
		else{
		?>
			<tr class="even gradeC">
			<?php } ?>
			<td><?php echo $i-1;?></td>
			<td><?php echo $row['vendor_name'];?></td>
			<td><a class="btn btn-primary fancybox fancybox.ajax"  href="edit_vendor?ID=<?php echo $row['vendor_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletevendor(<?php echo $row['vendor_id'];?>);"><i class="fa fa-pencil"></i> Delete</a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>	
<?php } } 
if($_POST['send'] == 'DELETEvd'){
$uid = $_POST['id'];	
	mysql_query("DELETE FROM tr_company WHERE vendor_id = '$uid'") or die(mysql_error());
?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
			<th>SI</th>
			<th>Vendor/ComPany</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
	$i=1;
	$query2 ="select * from tr_company";
	$result = mysql_query($query2)or die(mysql_error());
	while($row = mysql_fetch_array( $result )){
		$i++;
	if($i%2 ==0){
	?>
		<tr class="odd gradeX">
		<?php }
		else{
		?>
			<tr class="even gradeC">
			<?php } ?>
			<td><?php echo $i-1;?></td>
			<td><?php echo $row['vendor_name'];?></td>
			<td><a class="btn btn-primary fancybox fancybox.ajax"  href="edit_vendor?ID=<?php echo $row['vendor_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletevendor(<?php echo $row['vendor_id'];?>);"><i class="fa fa-pencil"></i> Delete</a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>	
<?php }
if($_POST['send'] == 'order'){
	$role2 = $this->session->userdata('verdorid');
	$isuser = $this->session->userdata('username');
	$isstatus = $this->session->userdata('status');
	$qrlastserial ="select * from tr_item_ifno Order By item_id Desc limit 1";
	$resultsrl = mysql_query($qrlastserial)or die(mysql_error());
	$rowserial = mysql_fetch_array( $resultsrl );
	$sirial = $rowserial['serialno']+1;
	$si_length = strlen((int)$sirial); 
	$str = '0000';
	$cutstr = substr($str, $si_length); 
	$sino = $cutstr.$sirial;

	$entry_date = date('Y-m-d');
	$vendorname = mysql_real_escape_string($_POST['vendorname']);	
	$team = mysql_real_escape_string($_POST['team']);	
	$styleno = mysql_real_escape_string($_POST['styleno']);	
	$pkno = mysql_real_escape_string($_POST['pkno']);	
	$color =mysql_real_escape_string($_POST['color']);	
	$smethod = mysql_real_escape_string($_POST['smethod']);	
	$size = mysql_real_escape_string($_POST['size']);	
	$fabric = mysql_real_escape_string($_POST['fabric']);	
	$care_lebel = mysql_real_escape_string($_POST['care_lebel']);	
	$hanger = mysql_real_escape_string($_POST['hanger']);	
	$price_tag = mysql_real_escape_string($_POST['price_tag']);	
	$sewing_tag = mysql_real_escape_string($_POST['sewing_tag']);	
	$sample_quantity = mysql_real_escape_string($_POST['sample_quantity']);
	$tgt_comment = mysql_real_escape_string($_POST['tgt_comment']);	
	

$query = "INSERT INTO tr_item_ifno(serialno,vendor,style_no,pkno,color,method,item_size,fabirc,care_label,hanger,price_tag,sewing_tag,sample_qtn,tgt_comment,entry_date,create_to,receive_to)
VALUES('$sino','$vendorname','$styleno','$pkno','$color','$smethod','$size','$fabric','$care_lebel','$hanger','$price_tag','$sewing_tag','$sample_quantity','$tgt_comment','$entry_date','$isuser','$team')";
mysql_query($query) or die(mysql_error());	
 	
	 
?>
 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
			<th>SI.</th>
			<th>Comments</th>
			<th>Vendor</th>
			<th>Status</th>
			<th>Style no</th>
			<th>Pk no</th>
			<th>Color</th>
			<th>Sample Method</th>
			<th>Size</th>
			<th>Fabirc</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	$query2 ="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor Where tr_item_ifno.vendor='$role2' AND tr_item_ifno.create_to='".$isuser."' Order By tr_item_ifno.item_id Desc";
	$result = mysql_query($query2)or die(mysql_error());
	while($row = mysql_fetch_array( $result )){
		$i++;
	if($i%2 ==0){
	?>
		<tr class="odd gradeX">
		<?php }
		else{
		?>
			<tr class="even gradeC">
			<?php } ?>
			<td><?php echo $row['serialno']?></td>
			<td><?php $astatus = $row['approve_status'];
			if($astatus==1){
				echo "<span style='color:green;'>Approved</style>";
				}
			if($astatus==2){
				echo "<span style='color:red;'>Rejected</style>";
				}
			if($astatus==3){
				echo "<span style='color:red;'>Conditionally Approved</style>";
				}
			if($astatus==0){
				echo "<span style='color:#df6565;'>Pending</style>";
				}
			?></td>
			<td><?php echo $row['vendor_name'];?></td>
			<td><?php if($isstatus =="999"){
				$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				
				
				$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
				$result_method4 = mysql_query($query_method4)or die(mysql_error());
				$row_method4 = mysql_fetch_array( $result_method4);
				
				$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
				$result_method3 = mysql_query($query_method3)or die(mysql_error());
				$row_method3 = mysql_fetch_array( $result_method3);
				
				echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
			}
			if($isstatus =="1"){
				$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				echo $row_method2['username'];
				}
			if($isstatus =="3"){
				$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				echo $row_method2['username'];
				}
			?></td>
			<td><?php echo $row['style_no'];?></td>
			<td><?php echo $row['pkno'];?></td>
			<td><?php echo $row['color'];?></td>
			<td><?php echo $row['method'];?></td>
			<td><?php echo $row['item_size'];?></td>
			<td><?php echo $row['fabirc'];?></td>
			<td><?php if(empty($row['sending_date'])){?><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<?php } ?><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
		</tr>
		<?php } ?>
		
	</tbody>
</table>
<?php } 
if($_POST['send'] == 'edit_order'){
	$isuser = $this->session->userdata('username');
	$isstatus = $this->session->userdata('status');
	$vendorname = mysql_real_escape_string($_POST['vendorname']);	
	$styleno = mysql_real_escape_string($_POST['styleno']);	
	$pkno = mysql_real_escape_string($_POST['pkno']);	
	$color = mysql_real_escape_string($_POST['color']);	
	$smethod = mysql_real_escape_string($_POST['smethod']);	
	$size = mysql_real_escape_string($_POST['size']);	
	$fabric = mysql_real_escape_string($_POST['fabric']);	
	$care_lebel = mysql_real_escape_string($_POST['care_lebel']);	
	$hanger = mysql_real_escape_string($_POST['hanger']);	
	$price_tag = mysql_real_escape_string($_POST['price_tag']);	
	$sewing_tag = mysql_real_escape_string($_POST['sewing_tag']);	
	$sample_quantity = mysql_real_escape_string($_POST['sample_quantity']);
	$tgt_comment = mysql_real_escape_string($_POST['tgt_comment']);
	$team = mysql_real_escape_string($_POST['team']);
	
mysql_query("UPDATE tr_item_ifno SET vendor = '$vendorname', style_no='$styleno', pkno='$pkno', color='$color', method='$smethod', item_size='$size', fabirc='$fabric', care_label='$care_lebel', hanger='$hanger', price_tag='$price_tag', sewing_tag='$sewing_tag', sample_qtn='$sample_quantity', tgt_comment='$tgt_comment',receive_to='$team' WHERE item_id ='".$_POST['id']."'") or die(mysql_error());
?>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th>SI.</th>
				<th>Comments</th>
				<th>Vendor</th>
				<th>Status</th>
				<th>Style no</th>
				<th>Pk no</th>
				<th>Color</th>
				<th>Sample Method</th>
				<th>Fabirc</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$i=1;
		$query2 ="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor Where tr_company.vendor_id='$vendorname' AND tr_item_ifno.create_to='".$isuser."' Order By tr_item_ifno.item_id Desc";
		$result = mysql_query($query2)or die(mysql_error());
		while($row = mysql_fetch_array( $result )){
			$i++;
		if($i%2 ==0){
		?>
			<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row['serialno']?></td>
				<td><?php $astatus = $row['approve_status'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php echo $row['vendor_name'];?></td>
				<td><?php if($isstatus =="999"){
					$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					
					
					$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
					$result_method4 = mysql_query($query_method4)or die(mysql_error());
					$row_method4 = mysql_fetch_array( $result_method4);
					
					$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
					$result_method3 = mysql_query($query_method3)or die(mysql_error());
					$row_method3 = mysql_fetch_array( $result_method3);
					
					echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
				}
				if($isstatus =="1"){
					$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				if($isstatus =="3"){
					$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				?></td>
				<td><?php echo $row['style_no'];?></td>
				<td><?php echo $row['pkno'];?></td>
				<td><?php echo $row['color'];?></td>
				<td><?php echo $row['method'];?></td>
				<td><?php echo $row['fabirc'];?></td>
				<td><?php if(empty($row['sending_date'])){?><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<?php } ?><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			</tr>
			<?php } ?>
			
		</tbody>
	</table>
<?php } 
if($_POST['send'] == 'adminupdate'){
	$erole = $this->session->userdata('verdorid');
	 $isstatus = $this->session->userdata('status');
	 $isuser = $this->session->userdata('username');
	$assist='';
	if($erole=="assist"){
		$assist = "editinfo";
		}
	if($isstatus=='1'){
	$vendorname = mysql_real_escape_string($_POST['vendorname']);	
	$team = mysql_real_escape_string($_POST['team']);	
	$setdate = mysql_real_escape_string($_POST['setdate']);
	$tgt_comment = mysql_real_escape_string($_POST['tgt_comment']);
	$approve_status = "0";
	}
	else{
	$vendorname = mysql_real_escape_string($_POST['vendorname']);	
	$team = mysql_real_escape_string($_POST['team']);	
	$team1 = mysql_real_escape_string($_POST['team1']);
	$setdate = mysql_real_escape_string($_POST['setdate']);
	$styleno = mysql_real_escape_string($_POST['styleno']);	
	$pkno = mysql_real_escape_string($_POST['pkno']);	
	$color = mysql_real_escape_string($_POST['color']);	
	$smethod = mysql_real_escape_string($_POST['smethod']);	
	$size = mysql_real_escape_string($_POST['size']);	
	$fabric = mysql_real_escape_string($_POST['fabric']);	
	$care_lebel = mysql_real_escape_string($_POST['care_lebel']);	
	$hanger = mysql_real_escape_string($_POST['hanger']);	
	$price_tag = mysql_real_escape_string($_POST['price_tag']);	
	$sewing_tag = mysql_real_escape_string($_POST['sewing_tag']);	
	$sample_quantity = mysql_real_escape_string($_POST['sample_quantity']);

	$tgt_comment = mysql_real_escape_string($_POST['tgt_comment']);	
	
	$approve_status = mysql_real_escape_string($_POST['approve_status']);
	$tssq_comment = mysql_real_escape_string($_POST['tssq_comment']);
	}
	if($approve_status==0){
	 if($isstatus=='1'){
			mysql_query("UPDATE tr_item_ifno SET sending_date = '$setdate',tgt_comment='$tgt_comment',buyerteam='$team' WHERE item_id ='".$_POST['id']."'") or die(mysql_error());
		 }
	  else{
			mysql_query("UPDATE tr_item_ifno SET sending_date = '$setdate', style_no='$styleno', pkno='$pkno', color='$color', method='$smethod', item_size='$size', fabirc='$fabric', care_label='$care_lebel', hanger='$hanger', price_tag='$price_tag', sewing_tag='$sewing_tag', sample_qtn='$sample_quantity', approve_status = '0', tgt_comment='$tgt_comment', tssq_comment='$tssq_comment', approve_date='0000-00-00', receive_to='$team1', buyerteam='$team' WHERE item_id ='".$_POST['id']."'") or die(mysql_error());
		}
	}
	else{
	 if($isstatus=='1'){
			mysql_query("UPDATE tr_item_ifno SET sending_date = '$setdate',tgt_comment='$tgt_comment',buyerteam='$team' WHERE item_id ='".$_POST['id']."'") or die(mysql_error());
		}
	  else{
			mysql_query("UPDATE tr_item_ifno SET sending_date = '$setdate', style_no='$styleno', pkno='$pkno', color='$color', method='$smethod', item_size='$size', fabirc='$fabric', care_label='$care_lebel', hanger='$hanger', price_tag='$price_tag', sewing_tag='$sewing_tag', sample_qtn='$sample_quantity', tgt_comment='$tgt_comment', receive_to='$team1', buyerteam='$team' WHERE item_id ='".$_POST['id']."'") or die(mysql_error());
		}
		}
?>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th>SI.</th>
				<th>Sending date</th>
				<th>Vendor</th>
				<th>Status</th>
				<th>Style no</th>
				<th>Pk no</th>
				<th>Color</th>
				<th>Sample Method</th>
				<th>Fabirc</th>
				<th>Comments</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$statement2 ='';
		if($isstatus=="1") {
			$statement2 = "Where tr_item_ifno.receive_to='".$isuser."'";
		}
		if($isstatus=="6") {
			$statement2 = "Where tr_item_ifno.buyerteam='".$isuser."'";
		}

		$i=1;
		$query2 = "select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement2} Order By tr_item_ifno.item_id DESC";
		$result = mysql_query($query2)or die(mysql_error());
		while($row = mysql_fetch_array( $result )){
			$i++;
		if($i%2 ==0){
		?>
			<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row['serialno'];?></td>
				<td><?php echo $row['sending_date'];?></td>
				<td><?php echo $row['vendor_name'];?></td>
				<td><?php if($isstatus =="999"){
					$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					
					$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
					$result_method4 = mysql_query($query_method4)or die(mysql_error());
					$row_method4 = mysql_fetch_array($result_method4);
					
					$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
					$result_method3 = mysql_query($query_method3)or die(mysql_error());
					$row_method3 = mysql_fetch_array( $result_method3);
					
					echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
				}
				if($isstatus =="1"){
					$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				if($isstatus =="3"){
					$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				?></td>
				<td><?php echo $row['style_no'];?></td>
				<td><?php echo $row['pkno'];?></td>
				<td><?php echo $row['color'];?></td>
				<td><?php echo $row['method'];?></td>
				<td><?php echo $row['fabirc'];?></td>
				<td><?php $astatus = $row['approve_status'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<?php if($isstatus=="1"){
					if($astatus==0){
					?>
				<td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php }
				else{
				?>
				<td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php  }
				}
				else{
				?>
				<td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php } ?>
				
			</tr>
			<?php } ?>
			
		</tbody>
	</table>
<?php }
if($_POST['send'] == 'buyerupdate'){
		$erole = $this->session->userdata('verdorid');
	 $isstatus = $this->session->userdata('status');
	 $isuser = $this->session->userdata('username');

	$approve_date = date('Y-m-d');
	$approve_status = $_POST['approve_status'];
	$tssq_comment = mysql_real_escape_string($_POST['tssq_comment']); 
	mysql_query("UPDATE tr_item_ifno SET approve_status = '$approve_status', tssq_comment='$tssq_comment', approve_date='$approve_date' WHERE item_id ='".$_POST['id']."'") or die(mysql_error());
	?>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th>SI.</th>
				<th>Sending date</th>
				<th>Comments</th>
				<th>Vendor</th>
				<th>Style no</th>
				<th>Pk no</th>
				<th>Color</th>
				<th>Sample Method</th>
				<th>Fabirc</th>
				<th style="width:190px;">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$statement2 ='';
		if($isstatus=="1"){
		$statement2 = "Where tr_item_ifno.receive_to='".$isuser."'";
		}
		if($isstatus=="6"){
			$statement2 = "Where tr_item_ifno.buyerteam='".$isuser."'";
			}
		$i=1;
		$query2 ="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement2} Order By tr_item_ifno.item_id Desc";
		$result = mysql_query($query2)or die(mysql_error());
		while($row = mysql_fetch_array( $result )){
			$i++;
		if(!empty($row['sending_date'])){
		if($i%2 ==0){
		?>
			<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
					<td><?php echo $row['serialno'];?></td>
				<td><?php echo $row['sending_date'];?></td>
				<td><?php $astatus = $row['approve_status'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php echo $row['vendor_name'];?></td>
				<td><?php echo $row['style_no'];?></td>
				<td><?php echo $row['pkno'];?></td>
				<td><?php echo $row['color'];?></td>
				<td><?php echo $row['method'];?></td>
				<td><?php echo $row['fabirc'];?></td>
				<td><?php if($astatus==0){?><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row['item_id'];?>"><i class="fa fa-edit "></i> Comments</a> &nbsp;<?php } ?><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			</tr>
			<?php } } ?>
			
		</tbody>
	</table>
<?php } 
if($_POST['send'] == 'DELETEitem'){
	$erole = $this->session->userdata('verdorid');
	 $isstatus = $this->session->userdata('status');
	 $isuser = $this->session->userdata('username');
	
$uid = $_POST['id'];	
	mysql_query("DELETE FROM tr_item_ifno WHERE item_id = '$uid'") or die(mysql_error());
?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
			<th>SI.</th>
			<th>Sending date</th>
			<th>Vendor</th>
			<th>Status</th>
			<th>Style no</th>
			<th>Pk no</th>
			<th>Color</th>
			<th>Sample Method</th>
			<th>Fabirc</th>
			<th>Comments</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$statement2 ='';
	if($isstatus=="1"){
	$statement2 = "Where tr_item_ifno.receive_to='".$isuser."'";
	}
	if($isstatus=="6"){
		$statement2 = "Where tr_item_ifno.buyerteam='".$isuser."'";
		}

	$i=1;
	$query2 ="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement2} Order By tr_item_ifno.item_id Desc";
	$result = mysql_query($query2)or die(mysql_error());
	while($row = mysql_fetch_array( $result )){
		$i++;
	if($i%2 ==0){
	?>
		<tr class="odd gradeX">
		<?php }
		else{
		?>
			<tr class="even gradeC">
			<?php } ?>
			<td><?php echo $i-1;?></td>
			<td><?php echo $row['sending_date'];?></td>
			<td><?php echo $row['vendor_name'];?></td>
			<td><?php if($isstatus =="999"){
				$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				
				
				$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
				$result_method4 = mysql_query($query_method4)or die(mysql_error());
				$row_method4 = mysql_fetch_array( $result_method4);
				
				$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
				$result_method3 = mysql_query($query_method3)or die(mysql_error());
				$row_method3 = mysql_fetch_array( $result_method3);
				
				echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
			}
			if($isstatus =="1"){
				$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				echo $row_method2['username'];
				}
			if($isstatus =="3"){
				$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				echo $row_method2['username'];
				}
			?></td>
			<td><?php echo $row['style_no'];?></td>
			<td><?php echo $row['pkno'];?></td>
			<td><?php echo $row['color'];?></td>
			<td><?php echo $row['method'];?></td>
			<td><?php echo $row['fabirc'];?></td>
			<td><?php $astatus = $row['approve_status'];
			if($astatus==1){
				echo "<span style='color:green;'>Approved</style>";
				}
			if($astatus==2){
				echo "<span style='color:red;'>Rejected</style>";
				}
			if($astatus==3){
				echo "<span style='color:red;'>Conditionally Approved</style>";
				}
			if($astatus==0){
				echo "<span style='color:#df6565;'>Pending</style>";
				}
			?></td>
			<td> <?php if(($erole=="0") || ($erole=="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> <?php } ?> <?php if($erole=="0"){?>&nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
		</tr>
		<?php } ?>
		
	</tbody>
</table>	
<?php }
if($_POST['send'] == 'sdate'){
$srole = $this->session->userdata('verdorid');
$isstatus = $this->session->userdata('status');
$isuser = $this->session->userdata('username');
$statement2 ='';
	$vendor = $_POST['vendor'];	
	$style = $_POST['style'];
	$method = $_POST['method'];	
	$emdat = $_POST['emdate'];	
	$statement = "";
	
	
	if($_POST['emdate']!="0"){
		//echo "Test";
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5") && ($_POST['emdate']!="0")){
		$statement = "Where tr_item_ifno.sending_date LIKE ''";
		}
		if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
	}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
	}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	}
	else{
		//echo "Test2";
	if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."'";
	}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
	}

	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['emdate']=="0") && ($_POST['comt']=="5")){
		$statement = "";
		}
	}
if($isstatus=="1"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.receive_to='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.receive_to='".$isuser."'";
		}
}
if($isstatus=="3"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.vendor='".$srole."' AND tr_item_ifno.create_to='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.vendor='".$srole."' AND tr_item_ifno.create_to='".$isuser."'";
		}
}
if($isstatus=="6"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.buyerteam='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.buyerteam='".$isuser."'";
		}
}
?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
			<tr>
			<th>SI.</th>
			<th>Sending date</th>
			<th>Comments</th>
			<th>Vendor</th>
			<?php if($srole!="byer"){?>
			<th>Status</th>
			<?php } ?>
			<th>Style no</th>
			<th>Pk no</th>
			<th>Color</th>
			<th>Sample Method</th>
			<th>Fabirc</th>
			<th>Action</th>
		</tr>
		</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	//echo "select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} {$statement2} Order By tr_item_ifno.item_id Desc";
	$query_fit ="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} {$statement2} Order By tr_item_ifno.item_id Desc";
	$result_flt = mysql_query($query_fit)or die(mysql_error());
	while($row_flt = mysql_fetch_array( $result_flt )){
		$i++;
	if((!empty($row_flt['sending_date'])) && ($srole=="byer")){
	if($i%2 ==0){
	?>
		<tr class="odd gradeX">
		<?php }
		else{
		?>
			<tr class="even gradeC">
			<?php } ?>
			<td><?php echo $row_flt['serialno'];?></td>
			<td><?php echo $row_flt['sending_date'];?></td>
			<td><?php $astatus = $row_flt['approve_status'];
			if($astatus==1){
				echo "<span style='color:green;'>Approved</style>";
				}
			if($astatus==2){
				echo "<span style='color:red;'>Rejected</style>";
				}
			if($astatus==3){
				echo "<span style='color:red;'>Conditionally Approved</style>";
				}
			if($astatus==0){
				echo "<span style='color:#df6565;'>Pending</style>";
				}
			?></td>
			<td><?php echo $row_flt['vendor_name'];?></td>
			<td><?php echo $row_flt['style_no'];?></td>
			<td><?php echo $row_flt['pkno'];?></td>
			<td><?php echo $row_flt['color'];?></td>
			<td><?php echo $row_flt['method'];?></td>
			<td><?php echo $row_flt['fabirc'];?></td>
			<td> <?php if($srole=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($srole=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
		</tr>
		<?php } 
		else if($srole=="0"){
			if($i%2 ==0){?>
				<tr class="odd gradeX">
		<?php }
		else{
		?>
			<tr class="even gradeC">
			<?php } ?>
			<td><?php echo $row_flt['serialno'];?></td>
			<td><?php echo $row_flt['sending_date'];?></td>
			<td><?php $astatus = $row_flt['approve_status'];
			if($astatus==1){
				echo "<span style='color:green;'>Approved</style>";
				}
			if($astatus==2){
				echo "<span style='color:red;'>Rejected</style>";
				}
			if($astatus==3){
				echo "<span style='color:red;'>Conditionally Approved</style>";
				}
			if($astatus==0){
				echo "<span style='color:#df6565;'>Pending</style>";
				}
			?></td>
			<td><?php echo $row_flt['vendor_name'];?></td>
			<td><?php if($isstatus =="999"){
				$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				
				
				$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
				$result_method4 = mysql_query($query_method4)or die(mysql_error());
				$row_method4 = mysql_fetch_array( $result_method4);
				
				$query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
				$result_method3 = mysql_query($query_method3)or die(mysql_error());
				$row_method3 = mysql_fetch_array( $result_method3);
				
				echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
			}
			if($isstatus =="1"){
				$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				echo $row_method2['username'];
				}
			if($isstatus =="3"){
				$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				echo $row_method2['username'];
				}
			?></td>
			<td><?php echo $row_flt['style_no'];?></td>
			<td><?php echo $row_flt['pkno'];?></td>
			<td><?php echo $row_flt['color'];?></td>
			<td><?php echo $row_flt['method'];?></td>
			<td><?php echo $row_flt['fabirc'];?></td>
			<?php if($isstatus=="1"){
				if($astatus==0){
				?>
			<td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			<?php }
			else{
			?>
			<td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			<?php  }
			}
			else{
			?>
			<td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			<?php } ?>
		</tr>
		<?php } 
		else if(($srole=="assist") || ($srole=="checker")){
			if($i%2 ==0){?>
				<tr class="odd gradeX">
		<?php }
		else{
		?>
			<tr class="even gradeC">
			<?php } ?>
			<td><?php echo $row_flt['serialno'];?></td>
			<td><?php echo $row_flt['sending_date'];?></td>
			<td><?php $astatus = $row_flt['approve_status'];
			if($astatus==1){
				echo "<span style='color:green;'>Approved</style>";
				}
			if($astatus==2){
				echo "<span style='color:red;'>Rejected</style>";
				}
			if($astatus==3){
				echo "<span style='color:red;'>Conditionally Approved</style>";
				}
			if($astatus==0){
				echo "<span style='color:#df6565;'>Pending</style>";
				}
			?></td>
			<td><?php echo $row_flt['vendor_name'];?></td>
			<td><?php if($isstatus =="999"){
				$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				
				
				$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
				$result_method4 = mysql_query($query_method4)or die(mysql_error());
				$row_method4 = mysql_fetch_array( $result_method4);
				
				$query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
				$result_method3 = mysql_query($query_method3)or die(mysql_error());
				$row_method3 = mysql_fetch_array( $result_method3);
																
				echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
			}
			if($isstatus =="1"){
				$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				echo $row_method2['username'];
				}
			if($isstatus =="3"){
				$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				echo $row_method2['username'];
				}
			?></td>
			<td><?php echo $row_flt['style_no'];?></td>
			<td><?php echo $row_flt['pkno'];?></td>
			<td><?php echo $row_flt['color'];?></td>
			<td><?php echo $row_flt['method'];?></td>
			<td><?php echo $row_flt['fabirc'];?></td>
			<td><?php if($srole=="assist"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
		</tr>
		<?php }
		else if($srole!="0" && $srole!="byer"){
			if($i%2 ==0){?>
				<tr class="odd gradeX">
		<?php }
		else{
		?>
			<tr class="even gradeC">
			<?php } ?>
			<td><?php echo $row_flt['serialno'];?></td>
			<td><?php echo $row_flt['sending_date'];?></td>
			<td><?php $astatus = $row_flt['approve_status'];
			if($astatus==1){
				echo "<span style='color:green;'>Approved</style>";
				}
			if($astatus==2){
				echo "<span style='color:red;'>Rejected</style>";
				}
			if($astatus==3){
				echo "<span style='color:red;'>Conditionally Approved</style>";
				}
			if($astatus==0){
				echo "<span style='color:#df6565;'>Pending</style>";
				}
			?></td>
			<td><?php echo $row_flt['vendor_name'];?></td>
			<td><?php if($isstatus =="999"){
				$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				
				$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
				$result_method4 = mysql_query($query_method4)or die(mysql_error());
				$row_method4 = mysql_fetch_array( $result_method4);

				$query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
				$result_method3 = mysql_query($query_method3)or die(mysql_error());
				$row_method3 = mysql_fetch_array( $result_method3);
				
				echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
			}
			if($isstatus =="1"){
				$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				echo $row_method2['username'];
				}
			if($isstatus =="3"){
				$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
				$result_method2 = mysql_query($query_method2)or die(mysql_error());
				$row_method2 = mysql_fetch_array( $result_method2);
				echo $row_method2['username'];
				}
			?></td>
			<td><?php echo $row_flt['style_no'];?></td>
			<td><?php echo $row_flt['pkno'];?></td>
			<td><?php echo $row_flt['color'];?></td>
			<td><?php echo $row_flt['method'];?></td>
			<td><?php echo $row_flt['fabirc'];?></td>
<td> <?php if((empty($row_flt['sending_date'])) && ($srole!="0") && ($srole!="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } if($srole=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($srole=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
		</tr>
		<?php }
		} ?>
		
	</tbody>
</table>
<?php }
if($_POST['send'] == 'svendor'){
	$srole = $this->session->userdata('verdorid');
	$isstatus = $this->session->userdata('status');
	$isuser = $this->session->userdata('username');
	$statement2 ='';
	if(($_POST['emdate']!="0")){
		if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5") && ($_POST['emdate']!="0")){
		$statement = "Where tr_item_ifno.sending_date LIKE ''";
		}
		if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	}
	
	else{
		if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5") && ($_POST['emdate']=="0")){
		$vendor="";
		$style="";
		$method="";
		$emdat = "";	
		$statement ='';
		}
		if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	}
if($isstatus=="1"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.receive_to='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.receive_to='".$isuser."'";
		}
}
if($isstatus=="3"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.vendor='".$srole."' AND tr_item_ifno.create_to='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.vendor='".$srole."' AND tr_item_ifno.create_to='".$isuser."'";
		}
}
if($isstatus=="6"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.buyerteam='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.buyerteam='".$isuser."'";
		}
}
?>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<tr>
				<th>SI.</th>
				<th>Sending date</th>
				<th>Comments</th>
				<th>Vendor</th>
				<?php if($srole!="byer"){?>
				<th>Status</th>
				<?php } ?>
				<th>Style no</th>
				<th>Pk no</th>
				<th>Color</th>
				<th>Sample Method</th>
				<th>Fabirc</th>
				<th>Action</th>
			</tr>
			</tr>
		</thead>
		<tbody>
		<?php 
		$i=1;
		//echo "select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} Order By tr_item_ifno.item_id Asc";
		$query_fit ="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} {$statement2} Order By tr_item_ifno.item_id Desc";
		$result_flt = mysql_query($query_fit)or die(mysql_error());
		while($row_flt = mysql_fetch_array( $result_flt )){
			$i++;
		if((!empty($row_flt['sending_date'])) && ($srole=="byer")){
		if($i%2 ==0){
		?>
			<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row_flt['serialno'];?></td>
				<td><?php echo $row_flt['sending_date'];?></td>
				<td><?php $astatus = $row_flt['approve_status'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php echo $row_flt['vendor_name'];?></td>
				<td><?php echo $row_flt['style_no'];?></td>
				<td><?php echo $row_flt['pkno'];?></td>
				<td><?php echo $row_flt['color'];?></td>
				<td><?php echo $row_flt['method'];?></td>
				<td><?php echo $row_flt['fabirc'];?></td>
				<td> <?php if($srole=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($srole=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			</tr>
			<?php } 
			else if($srole=="0"){
				if($i%2 ==0){?>
					<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row_flt['serialno'];?></td>
				<td><?php echo $row_flt['sending_date'];?></td>
				<td><?php $astatus = $row_flt['approve_status'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php echo $row_flt['vendor_name'];?></td>
				<td><?php if($isstatus =="999"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					
					
					$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method4 = mysql_query($query_method4)or die(mysql_error());
					$row_method4 = mysql_fetch_array( $result_method4);
					
					$query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
					$result_method3 = mysql_query($query_method3)or die(mysql_error());
					$row_method3 = mysql_fetch_array( $result_method3);
					
					echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
				}
				if($isstatus =="1"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				if($isstatus =="3"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				?></td>
				<td><?php echo $row_flt['style_no'];?></td>
				<td><?php echo $row_flt['pkno'];?></td>
				<td><?php echo $row_flt['color'];?></td>
				<td><?php echo $row_flt['method'];?></td>
				<td><?php echo $row_flt['fabirc'];?></td>
				<?php if($isstatus=="1"){
					if($astatus==0){
					?>
				<td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php }
				else{
				?>
				<td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php  }
				}
				else{
				?>
				<td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php } ?>
			</tr>
			<?php }
			else if(($srole=="assist") || ($srole=="checker")){
				if($i%2 ==0){?>
					<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row_flt['serialno'];?></td>
				<td><?php echo $row_flt['sending_date'];?></td>
				<td><?php $astatus = $row_flt['approve_status'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php echo $row_flt['vendor_name'];?></td>
				<td><?php if($isstatus =="999"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					
					
					$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method4 = mysql_query($query_method4)or die(mysql_error());
					$row_method4 = mysql_fetch_array( $result_method4);
					
					$query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
					$result_method3 = mysql_query($query_method3)or die(mysql_error());
					$row_method3 = mysql_fetch_array( $result_method3);
					
					echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
				}
				if($isstatus =="1"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				if($isstatus =="3"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				?></td>
				<td><?php echo $row_flt['style_no'];?></td>
				<td><?php echo $row_flt['pkno'];?></td>
				<td><?php echo $row_flt['color'];?></td>
				<td><?php echo $row_flt['method'];?></td>
				<td><?php echo $row_flt['fabirc'];?></td>
				<td><?php if($srole=="assist"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			</tr>
			<?php }
			else if($srole!="0" && $srole!="byer"){
				if($i%2 ==0){?>
					<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row_flt['serialno'];?></td>
				<td><?php echo $row_flt['sending_date'];?></td>
				<td><?php $astatus = $row_flt['approve_status'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php echo $row_flt['vendor_name'];?></td>
				<td><?php if($isstatus =="999"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					
					
					$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method4 = mysql_query($query_method4)or die(mysql_error());
					$row_method4 = mysql_fetch_array( $result_method4);
					
					$query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
					$result_method3 = mysql_query($query_method3)or die(mysql_error());
					$row_method3 = mysql_fetch_array( $result_method3);
					
					echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
				}
				if($isstatus =="1"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				if($isstatus =="3"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				?></td>
				<td><?php echo $row_flt['style_no'];?></td>
				<td><?php echo $row_flt['pkno'];?></td>
				<td><?php echo $row_flt['color'];?></td>
				<td><?php echo $row_flt['method'];?></td>
				<td><?php echo $row_flt['fabirc'];?></td>
	<td> <?php if((empty($row_flt['sending_date'])) && ($srole!="0") && ($srole!="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } if($srole=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($srole=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			</tr>
			<?php }										 
			} ?>
			
		</tbody>
	</table>
<?php }
if($_POST['send'] == 'sstyle'){
	$srole = $this->session->userdata('verdorid');
	$isstatus = $this->session->userdata('status');
	$isuser = $this->session->userdata('username');
	$statement2 ='';
	$vendor = $_POST['vendor'];	
	$style = $_POST['style'];
	$method = $_POST['method'];	
	$statement = "";
	if(($_POST['emdate']!="0")){
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5") && ($_POST['emdate']!="0")){
		$statement = "Where tr_item_ifno.sending_date LIKE ''";
		}
		if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	}
	else{
	if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."'";
	}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
	}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['emdate']=="0") && ($_POST['comt']=="5")){
		$statement = "";
		}
		}
		
if($isstatus=="1"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.receive_to='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.receive_to='".$isuser."'";
		}
}
if($isstatus=="3"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.vendor='".$srole."' AND tr_item_ifno.create_to='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.vendor='".$srole."' AND tr_item_ifno.create_to='".$isuser."'";
		}
}
if($isstatus=="6"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.buyerteam='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.buyerteam='".$isuser."'";
		}
}

?>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<tr>
				<th>SI.</th>
				<th>Sending date</th>
				<th>Comments</th>
				<th>Vendor</th>
				<?php if($srole!="byer"){?>
				<th>Status</th>
				<?php } ?>
				<th>Style no</th>
				<th>Pk no</th>
				<th>Color</th>
				<th>Sample Method</th>
				<th>Fabirc</th>
				<th>Action</th>
			</tr>
			</tr>
		</thead>
		<tbody>
		<?php 
		$i=1;
		//echo "select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} Order By tr_item_ifno.item_id Asc";
		$query_fit ="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} {$statement2} Order By tr_item_ifno.item_id Desc";
		$result_flt = mysql_query($query_fit)or die(mysql_error());
		while($row_flt = mysql_fetch_array( $result_flt )){
			$i++;
		if((!empty($row_flt['sending_date'])) && ($srole=="byer")){
		if($i%2 ==0){
		?>
			<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row_flt['serialno'];?></td>
				<td><?php echo $row_flt['sending_date'];?></td>
				<td><?php $astatus = $row_flt['approve_status'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php echo $row_flt['vendor_name'];?></td>
				<td><?php echo $row_flt['style_no'];?></td>
				<td><?php echo $row_flt['pkno'];?></td>
				<td><?php echo $row_flt['color'];?></td>
				<td><?php echo $row_flt['method'];?></td>
				<td><?php echo $row_flt['fabirc'];?></td>
				<td> <?php if($srole=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($srole=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			</tr>
			<?php } 
			else if($srole=="0"){
				if($i%2 ==0){?>
					<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row_flt['serialno'];?></td>
				<td><?php echo $row_flt['sending_date'];?></td>
				<td><?php $astatus = $row_flt['approve_status'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php echo $row_flt['vendor_name'];?></td>
				<td><?php if($isstatus =="999"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					
					
					$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method4 = mysql_query($query_method4)or die(mysql_error());
					$row_method4 = mysql_fetch_array( $result_method4);
					
					$query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
					$result_method3 = mysql_query($query_method3)or die(mysql_error());
					$row_method3 = mysql_fetch_array( $result_method3);
					
					echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
				}
				if($isstatus =="1"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				if($isstatus =="3"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				?></td>
				<td><?php echo $row_flt['style_no'];?></td>
				<td><?php echo $row_flt['pkno'];?></td>
				<td><?php echo $row_flt['color'];?></td>
				<td><?php echo $row_flt['method'];?></td>
				<td><?php echo $row_flt['fabirc'];?></td>
				<?php if($isstatus=="1"){
					if($astatus==0){
					?>
				<td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php }
				else{
				?>
				<td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php  }
				}
				else{
				?>
				<td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php } ?>
			</tr>
			<?php }
			else if(($srole=="assist") || ($srole=="checker")){
				if($i%2 ==0){?>
					<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row_flt['serialno'];?></td>
				<td><?php echo $row_flt['sending_date'];?></td>
				<td><?php $astatus = $row_flt['approve_status'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php echo $row_flt['vendor_name'];?></td>
				<td><?php if($isstatus =="999"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					
					
					$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method4 = mysql_query($query_method4)or die(mysql_error());
					$row_method4 = mysql_fetch_array( $result_method4);
					
					$query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
					$result_method3 = mysql_query($query_method3)or die(mysql_error());
					$row_method3 = mysql_fetch_array( $result_method3);
					
					echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
				}
				if($isstatus =="1"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				if($isstatus =="3"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				?></td>
				<td><?php echo $row_flt['style_no'];?></td>
				<td><?php echo $row_flt['pkno'];?></td>
				<td><?php echo $row_flt['color'];?></td>
				<td><?php echo $row_flt['method'];?></td>
				<td><?php echo $row_flt['fabirc'];?></td>
				<td><?php if($srole=="assist"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			</tr>
			<?php }
			else if($srole!="0" && $srole!="byer"){
				if($i%2 ==0){?>
					<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row_flt['serialno'];?></td>
				<td><?php echo $row_flt['sending_date'];?></td>
				<td><?php $astatus = $row_flt['approve_status'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php echo $row_flt['vendor_name'];?></td>
				<td><?php if($isstatus =="999"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					
					
					$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method4 = mysql_query($query_method4)or die(mysql_error());
					$row_method4 = mysql_fetch_array( $result_method4);
					
					$query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
					$result_method3 = mysql_query($query_method3)or die(mysql_error());
					$row_method3 = mysql_fetch_array( $result_method3);
					
					echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
				}
				if($isstatus =="1"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				if($isstatus =="3"){
					$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				?></td>
				<td><?php echo $row_flt['style_no'];?></td>
				<td><?php echo $row_flt['pkno'];?></td>
				<td><?php echo $row_flt['color'];?></td>
				<td><?php echo $row_flt['method'];?></td>
				<td><?php echo $row_flt['fabirc'];?></td>
	<td> <?php if((empty($row_flt['sending_date'])) && ($srole!="0") && ($srole!="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } if($srole=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($srole=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			</tr>
			<?php }
				} ?>
			
		</tbody>
	</table>
<?php }
if($_POST['send'] == 'smethod'){
$srole = $this->session->userdata('verdorid');
	$isstatus = $this->session->userdata('status');
	$isuser = $this->session->userdata('username');
	$statement2 ='';
	
	$vendor = $_POST['vendor'];	
	$style = $_POST['style'];
	$method = $_POST['method'];	
	$statement = "";
	if(($_POST['emdate']!="0")){
		//echo "test";
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5") && ($_POST['emdate']!="0")){
		$statement = "Where tr_item_ifno.sending_date LIKE ''";
		}
		if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	}
	else{
	if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."'";
	}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
	}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['emdate']=="0") && ($_POST['comt']=="5")){
		$statement = "";
		}
	}
	
if($isstatus=="1"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.receive_to='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.receive_to='".$isuser."'";
		}
}
if($isstatus=="3"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.vendor='".$srole."' AND tr_item_ifno.create_to='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.vendor='".$srole."' AND tr_item_ifno.create_to='".$isuser."'";
		}
}
if($isstatus=="6"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.buyerteam='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.buyerteam='".$isuser."'";
		}
}

?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                            <?php if($srole!="byer"){?>
                                            <th>Status</th>
                                            <?php } ?>
                                            <th>Style no</th>
                                            <th>Pk no</th>
                                            <th>Color</th>
                                            <th>Sample Method</th>
                                            <th>Fabirc</th>
                                            <th>Action</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									//echo "select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} Order By tr_item_ifno.item_id Asc";
									$query_fit ="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} {$statement2} Order By tr_item_ifno.item_id Desc";
									$result_flt = mysql_query($query_fit)or die(mysql_error());
									while($row_flt = mysql_fetch_array( $result_flt )){
										$i++;
								if((!empty($row_flt['sending_date'])) && ($srole=="byer")){
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serialno'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve_status'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php echo $row_flt['style_no'];?></td>
                                            <td><?php echo $row_flt['pkno'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['method'];?></td>
                                            <td><?php echo $row_flt['fabirc'];?></td>
                                            <td> <?php if($srole=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($srole=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php } 
										else if($srole=="0"){
											if($i%2 ==0){?>
                                             <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serialno'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve_status'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row_flt['style_no'];?></td>
                                            <td><?php echo $row_flt['pkno'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['method'];?></td>
                                            <td><?php echo $row_flt['fabirc'];?></td>
                                            <?php if($isstatus=="1"){
												if($astatus==0){
												?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php }
											else{
											?>
                                            <td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
											<?php  }
											}
											else{
											?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php } ?>
                                        </tr>
										<?php } 
										else if(($srole=="assist") || ($srole=="checker")){
											if($i%2 ==0){?>
                                             <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serialno'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve_status'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row_flt['style_no'];?></td>
                                            <td><?php echo $row_flt['pkno'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['method'];?></td>
                                            <td><?php echo $row_flt['fabirc'];?></td>
                                            <td><?php if($srole=="assist"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										else if($srole!="0" && $srole!="byer"){
											if($i%2 ==0){?>
                                             <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serialno'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve_status'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row_flt['style_no'];?></td>
                                            <td><?php echo $row_flt['pkno'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['method'];?></td>
                                            <td><?php echo $row_flt['fabirc'];?></td>
                                <td> <?php if((empty($row_flt['sending_date'])) && ($srole!="0") && ($srole!="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } if($srole=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($srole=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										} ?>
                                        
                                    </tbody>
                                </table>
<?php }
if($_POST['send'] == 'scomt'){
$srole = $this->session->userdata('verdorid');
	$isstatus = $this->session->userdata('status');
	$isuser = $this->session->userdata('username');
	$statement2 ='';

	$vendor = $_POST['vendor'];	
	$style = $_POST['style'];
	$method = $_POST['method'];	
	$statement = "";
	if(($_POST['emdate']!="0")){
		//echo "test";
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5") && ($_POST['emdate']!="0")){
		$statement = "Where tr_item_ifno.sending_date LIKE ''";
		}
		if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."' AND (tr_item_ifno.sending_date LIKE '')";
		}
	}
	else{
	if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.pkno='".$_POST['style']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.method='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.method='".$_POST['method']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.vendor='".$_POST['vendor']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.approve_status='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.method='".$_POST['method']."'";
	}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where tr_item_ifno.pkno='".$_POST['style']."' AND tr_item_ifno.approve_status='".$_POST['comt']."'";
	}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['emdate']=="0") && ($_POST['comt']=="5")){
		$statement = "";
		}
	}
	
if($isstatus=="1"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.receive_to='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.receive_to='".$isuser."'";
		}
}
if($isstatus=="3"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.vendor='".$srole."' AND tr_item_ifno.create_to='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.vendor='".$srole."' AND tr_item_ifno.create_to='".$isuser."'";
		}
}
if($isstatus=="6"){
	if($statement ==''){
	$statement2 = "Where tr_item_ifno.buyerteam='".$isuser."'";
	}
	else{
	$statement2 = " AND tr_item_ifno.buyerteam='".$isuser."'";
		}
}

?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                            <?php if($srole!="byer"){?>
                                            <th>Status</th>
                                            <?php } ?>
                                            <th>Style no</th>
                                            <th>Pk no</th>
                                            <th>Color</th>
                                            <th>Sample Method</th>
                                            <th>Fabirc</th>
                                            <th>Action</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									//echo "select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} Order By tr_item_ifno.item_id Asc";
									$query_fit ="select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} {$statement2} Order By tr_item_ifno.item_id Desc";
									$result_flt = mysql_query($query_fit)or die(mysql_error());
									while($row_flt = mysql_fetch_array( $result_flt )){
										$i++;
								if((!empty($row_flt['sending_date'])) && ($srole=="byer")){
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serialno'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve_status'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php echo $row_flt['style_no'];?></td>
                                            <td><?php echo $row_flt['pkno'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['method'];?></td>
                                            <td><?php echo $row_flt['fabirc'];?></td>
                                            <td> <?php if($srole=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($srole=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php } 
										else if($srole=="0"){
											if($i%2 ==0){?>
                                             <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serialno'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve_status'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row_flt['style_no'];?></td>
                                            <td><?php echo $row_flt['pkno'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['method'];?></td>
                                            <td><?php echo $row_flt['fabirc'];?></td>
                                            <?php if($isstatus=="1"){
												if($astatus==0){
												?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php }
											else{
											?>
                                            <td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
											<?php  }
											}
											else{
											?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php } ?>
                                        </tr>
										<?php } 
										else if(($srole=="assist") || ($srole=="checker")){
											if($i%2 ==0){?>
                                             <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serialno'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve_status'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row_flt['style_no'];?></td>
                                            <td><?php echo $row_flt['pkno'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['method'];?></td>
                                            <td><?php echo $row_flt['fabirc'];?></td>
                                            <td><?php if($srole=="assist"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										else if($srole!="0" && $srole!="byer"){
											if($i%2 ==0){?>
                                             <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serialno'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve_status'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row_flt['style_no'];?></td>
                                            <td><?php echo $row_flt['pkno'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['method'];?></td>
                                            <td><?php echo $row_flt['fabirc'];?></td>
                                <td> <?php if((empty($row_flt['sending_date'])) && ($srole!="0") && ($srole!="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } if($srole=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deleteitem(<?php echo $row_flt['item_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($srole=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_entry?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['item_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										} ?>
                                        
                                    </tbody>
                                </table>
<?php }
if($_POST['send'] == 'supplier'){
$role2 = $this->session->userdata('verdorid');
$isstatus = $this->session->userdata('status');
$isuser = $this->session->userdata('username');
$qrlastserial ="select * from suplier Order By suplier_id Desc limit 1";
$resultsrl = mysql_query($qrlastserial)or die(mysql_error());
$rowserial = mysql_fetch_array( $resultsrl );
//$sinum = (int)$rowserial['serial'];
$sirial = $rowserial['serial']+1;
$si_length = strlen((int)$sirial); 
$str = '0000';
$cutstr = substr($str, $si_length); 
$sino = $cutstr.$sirial;

	$entry_date = date('Y-m-d');
	$vendorname = mysql_real_escape_string($_POST['vendorname']);	
	$team = mysql_real_escape_string($_POST['team']);	
	$styleno = mysql_real_escape_string($_POST['styleno']);	
	$pkno = mysql_real_escape_string($_POST['pkno']);	
	$color = mysql_real_escape_string($_POST['color']);	
	$description = mysql_real_escape_string($_POST['description']);	
	$submit_approval = mysql_real_escape_string($_POST['submit_approval']);	
	$submittion_no = mysql_real_escape_string($_POST['submittion_no']);
	$tgt_comment = mysql_real_escape_string($_POST['tgt_comment']);	
	
$query = "INSERT INTO suplier(serial,vendor,style,pack_no,color,item_desc,submitfor_approval,submition_no,tgt_note,submit_date,create_to,receive_to)
VALUES('$sino','$vendorname','$styleno','$pkno','$color','$description','$submit_approval','$submittion_no','$tgt_comment','$entry_date','$isuser',$team)";
mysql_query($query) or die(mysql_error());	
 	
	 
?>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th>SI.</th>
				<th>Vendor</th>
				<th>Status</th>
				<th>Style no</th>
				<th>Pk no</th>
				<th>Color</th>
				<th>Description</th>
				<th>Submittied for approval on</th>
				<th>Submission no</th>
				<th>Comments</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$statement2 ='';
		if($isstatus=="1"){
		$statement2 = "Where suplier.receive_to='".$isuser."'";
		}
		if($isstatus=="6"){
			$statement2 = "Where suplier.buyerteam='".$isuser."'";
			}
		$i=1;
		//echo "select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor Where suplier.vendor='$role2' Order By suplier.suplier_id Desc";
		$query2 ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor Where suplier.vendor='$role2' AND suplier.create_to='".$isuser."' Order By suplier.suplier_id Desc";
		$result = mysql_query($query2)or die(mysql_error());
		while($row = mysql_fetch_array( $result )){
			$i++;
		if($i%2 ==0){
		?>
			<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row['serial'];?></td>
				<td><?php echo $row['vendor_name'];?></td>
				<td><?php if($isstatus =="999"){
					$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					
					
					$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
					$result_method4 = mysql_query($query_method4)or die(mysql_error());
					$row_method4 = mysql_fetch_array( $result_method4);
					
					$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
					$result_method3 = mysql_query($query_method3)or die(mysql_error());
					$row_method3 = mysql_fetch_array( $result_method3);
					
					echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
				}
				if($isstatus =="1"){
					$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				if($isstatus =="3"){
					$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				?></td>
				<td><?php echo $row['style'];?></td>
				<td><?php echo $row['pack_no'];?></td>
				<td><?php echo $row['color'];?></td>
				<td><?php echo $row['item_desc'];?></td>
				<td><?php echo $row['submitfor_approval'];?></td>
				<td><?php echo $row['submition_no'];?></td>
				<td><?php $astatus = $row['approve'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php if(empty($row['sending_date'])){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<?php } ?><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			</tr>
			<?php } ?>
			
		</tbody>
	</table>
<?php } 

if($_POST['send'] == 'edit_suplier') {
	$role2 = $this->session->userdata('verdorid');
	$isstatus = $this->session->userdata('status');
	$isuser = $this->session->userdata('username');
	$entry_date = date('Y-m-d');
	$vendorname = mysql_real_escape_string($_POST['vendorname']);	
	$styleno = mysql_real_escape_string($_POST['styleno']);	
	$pkno = mysql_real_escape_string($_POST['pkno']);	
	$color = mysql_real_escape_string($_POST['color']);	
	$description = mysql_real_escape_string($_POST['description']);	
	$submit_approval = mysql_real_escape_string($_POST['submit_approval']);	
	$submittion_no = mysql_real_escape_string($_POST['submittion_no']);
	$tgt_comment = mysql_real_escape_string($_POST['tgt_comment']);
	$team = mysql_real_escape_string($_POST['team']);
	
	//echo "UPDATE suplier SET style='$styleno', pack_no='$pkno', color='$color', item_desc='$description', submitfor_approval='$submit_approval', submition_no='$submittion_no', tgt_note='$tgt_comment' WHERE suplier_id ='".$_POST['id']."'";
	mysql_query("UPDATE suplier SET style='$styleno', pack_no='$pkno', color='$color', item_desc='$description', submitfor_approval='$submit_approval', submition_no='$submittion_no', tgt_note='$tgt_comment',receive_to='$team' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
	 
?>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th>SI.</th>
				<th>Vendor</th>
				<th>Staus</th>
				<th>Style no</th>
				<th>Pk no</th>
				<th>Color</th>
				<th>Description</th>
				<th>Submittied for approval on</th>
				<th>Submission no</th>
				<th>Comments</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$statement2 ='';
		if($isstatus=="1"){
		$statement2 = "Where suplier.receive_to='".$isuser."'";
		}
		if($isstatus=="6"){
			$statement2 = "Where suplier.buyerteam='".$isuser."'";
			}
		$i=1;
		$query2 ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor Where suplier.vendor='$vendorname' AND suplier.create_to='".$isuser."' Order By suplier.suplier_id Desc";
		$result = mysql_query($query2)or die(mysql_error());
		while($row = mysql_fetch_array( $result )){
			$i++;
		if($i%2 ==0){
		?>
			<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row['serial'];?></td>
				<td><?php echo $row['vendor_name'];?></td>
				<td><?php if($isstatus =="999"){
					$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					
					
					$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
					$result_method4 = mysql_query($query_method4)or die(mysql_error());
					$row_method4 = mysql_fetch_array( $result_method4);
					
					$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
					$result_method3 = mysql_query($query_method3)or die(mysql_error());
					$row_method3 = mysql_fetch_array( $result_method3);
					
					echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
				}
				if($isstatus =="1"){
					$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				if($isstatus =="3"){
					$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				?></td>
				<td><?php echo $row['style'];?></td>
				<td><?php echo $row['pack_no'];?></td>
				<td><?php echo $row['color'];?></td>
				<td><?php echo $row['item_desc'];?></td>
				<td><?php echo $row['submitfor_approval'];?></td>
				<td><?php echo $row['submition_no'];?></td>
				<td><?php $astatus = $row['approve'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php if(empty($row['sending_date'])){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<?php } ?><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
			</tr>
			<?php } ?>
			
		</tbody>
	</table>
<?php } 
	if($_POST['send'] == 'supadupdate'){
		$role2 = $this->session->userdata('verdorid');
		$isstatus = $this->session->userdata('status');
		$isuser = $this->session->userdata('username');
	if($isstatus=='1'){
		$vendorname = mysql_real_escape_string($_POST['vendorname']);	
		$setdate = mysql_real_escape_string($_POST['setdate']);
		$team = mysql_real_escape_string($_POST['team']);
		$tgt_comment = mysql_real_escape_string($_POST['tgt_comment']);
		$approve_status = '0';
	}else{
		$vendorname = mysql_real_escape_string($_POST['vendorname']);	
		$setdate = mysql_real_escape_string($_POST['setdate']);
		$team = mysql_real_escape_string($_POST['team']);
		$team1 = mysql_real_escape_string($_POST['team1']);
		$styleno = mysql_real_escape_string($_POST['styleno']);	
		$pkno = mysql_real_escape_string($_POST['pkno']);	
		$color = mysql_real_escape_string($_POST['color']);	
		$description = mysql_real_escape_string($_POST['description']);	
		$submit_approval = mysql_real_escape_string($_POST['submit_approval']);	
		$submittion_no = mysql_real_escape_string($_POST['submittion_no']);
		$tgt_comment = mysql_real_escape_string($_POST['tgt_comment']);
		$approve_status = mysql_real_escape_string($_POST['approve_status']);
		$tssq_comment = mysql_real_escape_string($_POST['tssq_comment']);
	}
	
	
// jack code start
    if(isset($_FILES['files'])) {
        // Count total files
        $countfiles = count($_FILES['files']['name']);
        // Upload Location
        $upload_location = "uploads/supplier/";
        // To store uploaded files path
        $files_arr = array();
        // Loop all files
        for($index = 0;$index < $countfiles;$index++){
            if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != ''){
              // File name
              $filename = $_FILES['files']['name'][$index];
              // Get extension
              $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
              // Valid image extension
              $valid_ext = array("pdf", "docx", "xls", "xlsx", "doc");
  
              // Check extension
              if(in_array($ext, $valid_ext)){
                // File path
                $path = $upload_location.rand(1111, 9999).$filename;

                // Upload file
                if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
                      $files_arr[] = $path;
                }
              }
            }
       }
       
       // insert supplier file table
       if(count($files_arr) > 0) {
            foreach($files_arr as $value) {
                mysql_query("insert into supplier_file set supplier_id ='".$_POST['id']."', file_name ='".$value."'") or die(mysql_error());
            }
        }
    }
// jack code end

/*if($approve_status==0){
mysql_query("UPDATE suplier SET sending_date = '$setdate', style='$styleno', pack_no='$pkno', color='$color', item_desc='$description', submitfor_approval='$submit_approval', submition_no='$submittion_no', tgt_note='$tgt_comment', buyer_comments = '', approve='0', approve_date='0000-00-00' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
}
else{
mysql_query("UPDATE suplier SET sending_date = '$setdate', style='$styleno', pack_no='$pkno', color='$color', item_desc='$description', submitfor_approval='$submit_approval', submition_no='$submittion_no', tgt_note='$tgt_comment' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
}*/
// echo "<pre>";
// print_r($_FILES['file']);
// echo "</pre>";
// return; 
if(isset($_FILES['file'])) {
	

	if($approve_status==0){
		 if($isstatus=='1'){
			mysql_query("UPDATE suplier SET sending_date = '$setdate', tgt_note='$tgt_comment', buyerteam='$team', file='" . $_FILES['file']['name'] . "' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
		} else {
			mysql_query("UPDATE suplier SET sending_date = '$setdate', style='$styleno', pack_no='$pkno', color='$color', item_desc='$description', submitfor_approval='$submit_approval', submition_no='$submittion_no', tgt_note='$tgt_comment', buyer_comments = '', approve='0', approve_date='0000-00-00',receive_to='$team1', buyerteam='$team', file='" . $_FILES['file']['name'] . "' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
		}
	}
	else {
		if($isstatus=='1'){
			mysql_query("UPDATE suplier SET sending_date = '$setdate', tgt_note='$tgt_comment', buyerteam='$team', file='" . $_FILES['file']['name'] . "' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
		} else {
			mysql_query("UPDATE suplier SET sending_date = '$setdate', style='$styleno', pack_no='$pkno', color='$color', item_desc='$description', submitfor_approval='$submit_approval', submition_no='$submittion_no', tgt_note='$tgt_comment', receive_to='$team1', buyerteam='$team', file='" . $_FILES['file']['name'] . "' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
		}
	}
} else {
	if($approve_status==0){
		if($isstatus=='1'){
		   mysql_query("UPDATE suplier SET sending_date = '$setdate', tgt_note='$tgt_comment', buyerteam='$team' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
	   } else {
		   mysql_query("UPDATE suplier SET sending_date = '$setdate', style='$styleno', pack_no='$pkno', color='$color', item_desc='$description', submitfor_approval='$submit_approval', submition_no='$submittion_no', tgt_note='$tgt_comment', buyer_comments = '', approve='0', approve_date='0000-00-00',receive_to='$team1', buyerteam='$team' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
	   }
   }
   else {
	   if($isstatus=='1'){
		   mysql_query("UPDATE suplier SET sending_date = '$setdate', tgt_note='$tgt_comment', buyerteam='$team' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
	   } else {
		   mysql_query("UPDATE suplier SET sending_date = '$setdate', style='$styleno', pack_no='$pkno', color='$color', item_desc='$description', submitfor_approval='$submit_approval', submition_no='$submittion_no', tgt_note='$tgt_comment', receive_to='$team1', buyerteam='$team' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
	   }
   }
}

?>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th>SI.</th>
				<th>Sending date</th>
				<th>Comments</th>
				<th>Vendor</th>
				<th>Status</th>
				<th>Style no</th>
				<th>Pk no</th>
				<th>Color</th>
				<th>Description</th>
				<th>Submittied for approval on</th>
				<th>Submission no</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$statement2 ='';
		if($isstatus=="1"){
		$statement2 = "Where suplier.receive_to='".$isuser."'";
		}
		if($isstatus=="6"){
			$statement2 = "Where suplier.buyerteam='".$isuser."'";
			}
		$i=1;
		//echo "select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor Order By suplier.suplier_id Asc";
		$query2 ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement2} Order By suplier.suplier_id Desc";
		$result = mysql_query($query2)or die(mysql_error());
		while($row = mysql_fetch_array( $result )){
		
		
			$i++;
		if($i%2 ==0){
		?>
			<tr class="odd gradeX">
			<?php }
			else{
			?>
				<tr class="even gradeC">
				<?php } ?>
				<td><?php echo $row['serial'];?></td>
				<td><?php echo $row['sending_date'];?></td>
				<td><?php $astatus = $row['approve'];
				if($astatus==1){
					echo "<span style='color:green;'>Approved</style>";
					}
				if($astatus==2){
					echo "<span style='color:red;'>Rejected</style>";
					}
				if($astatus==3){
					echo "<span style='color:red;'>Conditionally Approved</style>";
					}
				if($astatus==0){
					echo "<span style='color:#df6565;'>Pending</style>";
					}
				?></td>
				<td><?php echo $row['vendor_name'];?></td>
				<td><?php if($isstatus =="999"){
					$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					
					
					$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
					$result_method4 = mysql_query($query_method4)or die(mysql_error());
					$row_method4 = mysql_fetch_array( $result_method4);
					
					$query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
					$result_method3 = mysql_query($query_method3)or die(mysql_error());
					$row_method3 = mysql_fetch_array( $result_method3);
					
					echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
				}
				if($isstatus =="1"){
					$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				if($isstatus =="3"){
					$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
					$result_method2 = mysql_query($query_method2)or die(mysql_error());
					$row_method2 = mysql_fetch_array( $result_method2);
					echo $row_method2['username'];
					}
				?></td>
				<td><?php echo $row['style'];?></td>
				<td><?php echo $row['pack_no'];?></td>
				<td><?php echo $row['color'];?></td>
				<td><?php echo $row['item_desc'];?></td>
				<td><?php echo $row['submitfor_approval'];?></td>
				<td><?php echo $row['submition_no'];?></td>
				<?php if($isstatus=="1"){
					if($astatus==0){
					?>
				<td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php }
				else{
				?>
				<td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php  }
				}else{
				?>
				<td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
				<?php } ?>
			</tr>
			<?php } ?>
			
		</tbody>
	</table>
<?php }
if($_POST['send'] == 'buyersuplierupdate'){
	$approve_date = date('Y-m-d');
	$approve_status = $_POST['approve_status'];
	$tssq_comment = mysql_real_escape_string($_POST['tssq_comment']);
	$isstatus = $this->session->userdata('status');
$isuser = $this->session->userdata('username');

	//echo "UPDATE suplier SET buyer_comments = '$tssq_comment', approve='$approve_status', approve_date='$approve_date' WHERE suplier_id ='".$_POST['id']."'";
	mysql_query("UPDATE suplier SET buyer_comments = '$tssq_comment', approve='$approve_status', approve_date='$approve_date' WHERE suplier_id ='".$_POST['id']."'") or die(mysql_error());
?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                            <th>Style no</th>
                                            <th>Pk no</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Submittied for approval on</th>
                                            <th>Submission no</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$statement2 ='';
									if($isstatus=="1"){
									$statement2 = "Where suplier.receive_to='".$isuser."'";
									}
									if($isstatus=="6"){
										$statement2 = "Where suplier.buyerteam='".$isuser."'";
										}
									$i=1;
									$query2 ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement2} Order By suplier.suplier_id Desc";
									$result = mysql_query($query2)or die(mysql_error());
									while($row = mysql_fetch_array( $result )){
										$i++;
									if(!empty($row['sending_date'])){
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row['serial'];?></td>
                                            <td><?php echo $row['sending_date'];?></td>
                                            <td><?php $astatus = $row['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row['vendor_name'];?></td>
                                            <td><?php echo $row['style'];?></td>
                                            <td><?php echo $row['pack_no'];?></td>
                                            <td><?php echo $row['color'];?></td>
                                            <td><?php echo $row['item_desc'];?></td>
                                            <td><?php echo $row['submitfor_approval'];?></td>
                                            <td><?php echo $row['submition_no'];?></td>
                                            <td><?php if($astatus==0){?><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a> &nbsp;<?php } ?><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php } } ?>
                                        
                                    </tbody>
                                </table>
<?php } 
if($_POST['send'] == 'spdate'){
$role2 = $this->session->userdata('verdorid');
$isstatus = $this->session->userdata('status');
$isuser = $this->session->userdata('username');
$statement2='';
if(($_POST['emdate']!="0")){
		//echo "test";
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5") && ($_POST['emdate']!="0")){
		$statement = "Where suplier.sending_date LIKE ''";
		}
		if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	}
	else{
	if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['emdate']=="0") && ($_POST['comt']=="5")){
		$statement = "";
		}
	}	
if($isstatus=="1"){
	if($statement ==''){
	$statement2 = "Where suplier.receive_to='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.receive_to='".$isuser."'";
		}
}
if($isstatus=="3"){
	if($statement ==''){
	$statement2 = "Where suplier.vendor='".$role2."' AND suplier.create_to='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.vendor='".$role2."' AND suplier.create_to='".$isuser."'";
		}
}
if($isstatus=="6"){
	if($statement ==''){
	$statement2 = "Where suplier.buyerteam='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.buyerteam='".$isuser."'";
		}
}

?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                            <?php if($role2!="byer"){?>
                                            <th>Status</th>
                                            <?php } ?>
                                            <th>Style no</th>
                                            <th>Pk no</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Submittied for approval on</th>
                                            <th>Submission no</th>
                                            <th>Action</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									//echo "select tr_item_ifno.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} Order By tr_item_ifno.item_id Asc";
									$query_fit ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement} {$statement2} Order By suplier.suplier_id Desc";
									$result_flt = mysql_query($query_fit)or die(mysql_error());
									while($row_flt = mysql_fetch_array( $result_flt )){
										$i++;
									if((!empty($row_flt['sending_date'])) && ($role2=="byer")){
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td> <?php if($role2=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role2=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php }
										else if($role2=="0"){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <?php if($isstatus=="1"){
												if($astatus==0){
												?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php }
											else{
											?>
                                            <td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
											<?php  }
											}else{
											?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php } ?>
                                        </tr>
										<?php }
										else if(($role2=="assist") || ($role2=="checker")){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td> <?php if($role2=="assist"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										else if($role2!="0" && $role2!="byer"){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td><?php if((empty($row_flt['sending_date'])) && ($role2!="0") && ($role2!="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> <?php } if($role2=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role2=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										 }?>
                                        
                                    </tbody>
                                </table>
<?php }
if($_POST['send'] == 'spvendor'){
$role2 = $this->session->userdata('verdorid');
$isstatus = $this->session->userdata('status');
$isuser = $this->session->userdata('username');
$statement2='';

if(($_POST['emdate']!="0")){
		//echo "test";
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5") && ($_POST['emdate']!="0")){
		$statement = "Where suplier.sending_date LIKE ''";
		}
		if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	}
	else{
	if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['emdate']=="0") && ($_POST['comt']=="5")){
		$statement = "";
		}
	}	
if($isstatus=="1"){
	if($statement ==''){
	$statement2 = "Where suplier.receive_to='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.receive_to='".$isuser."'";
		}
}
if($isstatus=="3"){
	if($statement ==''){
	$statement2 = "Where suplier.vendor='".$role2."' AND suplier.create_to='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.vendor='".$role2."' AND suplier.create_to='".$isuser."'";
		}
}

if($isstatus=="6"){
	if($statement ==''){
	$statement2 = "Where suplier.buyerteam='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.buyerteam='".$isuser."'";
		}
}
  
?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                             <?php if($role2!="byer"){?>
                                            <th>Status</th>
                                            <?php } ?>
                                            <th>Style no</th>
                                            <th>Pk no</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Submittied for approval on</th>
                                            <th>Submission no</th>
                                            <th>Action</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									//echo "select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement} Order By suplier.suplier_id Asc";
									$query_fit ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement} {$statement2} Order By suplier.suplier_id Desc";
									$result_flt = mysql_query($query_fit)or die(mysql_error());
									while($row_flt = mysql_fetch_array( $result_flt )){
										$i++;
									if((!empty($row_flt['sending_date'])) && ($role2=="byer")){
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td> <?php if($role2=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role2=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php }
										else if($role2=="0"){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                           <?php if($isstatus=="1"){
												if($astatus==0){
												?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php }
											else{
											?>
                                            <td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
											<?php  }
											}else{
											?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php } ?>
                                        </tr>
										<?php } 
										else if(($role2=="assist") || ($role2=="checker")){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td> <?php if($role2=="assist"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										else if($role2!="0" && $role2!="byer"){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td><?php if((empty($row_flt['sending_date'])) && ($role2!="0") && ($role2!="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> <?php } if($role2=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role2=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }

										}?>
                                        
                                    </tbody>
                                </table>
<?php }
if($_POST['send'] == 'spstyle'){
$role2 = $this->session->userdata('verdorid');
$isstatus = $this->session->userdata('status');
$isuser = $this->session->userdata('username');
$statement2='';

if(($_POST['emdate']!="0")){
		//echo "test";
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5") && ($_POST['emdate']!="0")){
		$statement = "Where suplier.sending_date LIKE ''";
		}
		if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	}
	else{
	if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['emdate']=="0") && ($_POST['comt']=="5")){
		$statement = "";
		}
	}
if($isstatus=="1"){
	if($statement ==''){
	$statement2 = "Where suplier.receive_to='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.receive_to='".$isuser."'";
		}
}
if($isstatus=="3"){
	if($statement ==''){
	$statement2 = "Where suplier.vendor='".$role2."' AND suplier.create_to='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.vendor='".$role2."' AND suplier.create_to='".$isuser."'";
		}
}

if($isstatus=="6"){
	if($statement ==''){
	$statement2 = "Where suplier.buyerteam='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.buyerteam='".$isuser."'";
		}
}
	?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                             <?php if($role2!="byer"){?>
                                            <th>Status</th>
                                            <?php } ?>
                                            <th>Style no</th>
                                            <th>Pk no</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Submittied for approval on</th>
                                            <th>Submission no</th>
                                            <th>Action</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									//echo "select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement} Order By suplier.suplier_id Asc";
									$query_fit ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement} {$statement2} Order By suplier.suplier_id Desc";
									$result_flt = mysql_query($query_fit)or die(mysql_error());
									while($row_flt = mysql_fetch_array( $result_flt )){
										$i++;
									if((!empty($row_flt['sending_date'])) && ($role2=="byer")){
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td> <?php if($role2=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role2=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php }
										else if($role2=="0"){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <?php if($isstatus=="1"){
												if($astatus==0){
												?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php }
											else{
											?>
                                            <td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
											<?php  }
											}else{
											?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php } ?>
                                        </tr>
										<?php }
										else if(($role2=="assist") || ($role2=="checker")){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td> <?php if($role2=="assist"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										else if($role2!="0" && $role2!="byer"){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td><?php if((empty($row_flt['sending_date'])) && ($role2!="0") && ($role2!="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> <?php } if($role2=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role2=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }

										 }?>                                        
                                    </tbody>
                                </table>
<?php }
if($_POST['send'] == 'spmethod'){
$role2 = $this->session->userdata('verdorid');
$isstatus = $this->session->userdata('status');
$isuser = $this->session->userdata('username');
$statement2='';

if(($_POST['emdate']!="0")){
		//echo "test";
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5") && ($_POST['emdate']!="0")){
		$statement = "Where suplier.sending_date LIKE ''";
		}
		if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	}
	else{
	if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['emdate']=="0") && ($_POST['comt']=="5")){
		$statement = "";
		}
	}
	//echo $statement;
if($isstatus=="1"){
	if($statement ==''){
	$statement2 = "Where suplier.receive_to='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.receive_to='".$isuser."'";
		}
}
if($isstatus=="3"){
	if($statement ==''){
	$statement2 = "Where suplier.vendor='".$role2."' AND suplier.create_to='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.vendor='".$role2."' AND suplier.create_to='".$isuser."'";
		}
}

if($isstatus=="6"){
	if($statement ==''){
	$statement2 = "Where suplier.buyerteam='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.buyerteam='".$isuser."'";
		}
}

?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                             <?php if($role2!="byer"){?>
                                            <th>Status</th>
                                            <?php } ?>
                                            <th>Style no</th>
                                            <th>Pk no</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Submittied for approval on</th>
                                            <th>Submission no</th>
                                            <th>Action</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									//echo "select suplier.*,tr_company.* from tr_item_ifno Left Join tr_company ON tr_company.vendor_id=tr_item_ifno.vendor {$statement} Order By tr_item_ifno.item_id Asc";
									$query_fit ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement} {$statement2} Order By suplier.suplier_id Desc";
									$result_flt = mysql_query($query_fit)or die(mysql_error());
									while($row_flt = mysql_fetch_array( $result_flt )){
										$i++;
									if((!empty($row_flt['sending_date'])) && ($role2=="byer")){
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td> <?php if($role2=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role2=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php }
										else if($role2=="0"){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <?php if($isstatus=="1"){
												if($astatus==0){
												?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php }
											else{
											?>
                                            <td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
											<?php  }
											}else{
											?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php } ?>
                                        </tr>
										<?php } 
										else if(($role2=="assist") || ($role2=="checker")){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td> <?php if($role2=="assist"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										else if($role2!="0" && $role2!="byer"){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td><?php if((empty($row_flt['sending_date'])) && ($role2!="0") && ($role2!="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> <?php } if($role2=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role2=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										}?>                                        
                                    </tbody>
                                </table>
<?php }
if($_POST['send'] == 'spcomt'){
$role2 = $this->session->userdata('verdorid');
$isstatus = $this->session->userdata('status');
$isuser = $this->session->userdata('username');
$statement2='';

if(($_POST['emdate']!="0")){
		//echo "test";
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5") && ($_POST['emdate']!="0")){
		$statement = "Where suplier.sending_date LIKE ''";
		}
		if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.approve='".$_POST['comt']."' AND (suplier.sending_date LIKE '')";
		}
	}
	else{
	if(($_POST['vendor'] !="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.pack_no='".$_POST['style']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']!="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.color='".$_POST['method']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']!="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.vendor='".$_POST['vendor']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']!="0") && ($_POST['comt']=="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.color='".$_POST['method']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']!="0") && ($_POST['method']=="0") && ($_POST['comt']!="5")){
		$statement = "Where suplier.pack_no='".$_POST['style']."' AND suplier.approve='".$_POST['comt']."'";
		}
	if(($_POST['vendor']=="0") && ($_POST['style']=="0") && ($_POST['method']=="0") && ($_POST['emdate']=="0") && ($_POST['comt']=="5")){
		$statement = "";
		}
	}	
if($isstatus=="1"){
	if($statement ==''){
	$statement2 = "Where suplier.receive_to='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.receive_to='".$isuser."'";
		}
}
if($isstatus=="3"){
	if($statement ==''){
	$statement2 = "Where suplier.vendor='".$role2."' AND suplier.create_to='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.vendor='".$role2."' AND suplier.create_to='".$isuser."'";
		}
}

if($isstatus=="6"){
	if($statement ==''){
	$statement2 = "Where suplier.buyerteam='".$isuser."'";
	}
	else{
	$statement2 = " AND suplier.buyerteam='".$isuser."'";
		}
}

?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                             <?php if($role2!="byer"){?>
                                            <th>Status</th>
                                            <?php } ?>
                                            <th>Style no</th>
                                            <th>Pk no</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Submittied for approval on</th>
                                            <th>Submission no</th>
                                            <th>Action</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									//echo "select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement} Order By suplier.suplier_id Asc";
									$query_fit ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement} {$statement2} Order By suplier.suplier_id Desc";
									$result_flt = mysql_query($query_fit)or die(mysql_error());
									while($row_flt = mysql_fetch_array( $result_flt )){
										$i++;
									if((!empty($row_flt['sending_date'])) && ($role2=="byer")){
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td> <?php if($role2=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role2=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php }
										else if($role2=="0"){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <?php if($isstatus=="1"){
												if($astatus==0){
												?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_order?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php }
											else{
											?>
                                            <td><a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
											<?php  }
											}else{
											?>
                                            <td><a class="btn btn-primary fancybox fancybox.ajax"  href="update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                            <?php } ?>
                                        </tr>
										<?php }
										else if(($role2=="assist") || ($role2=="checker")){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td> <?php if($role2=="assist"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										else if($role2!="0" && $role2!="byer"){
											if($i%2 ==0){
											?>
										 <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row_flt['serial'];?></td>
                                            <td><?php echo $row_flt['sending_date'];?></td>
                                            <td><?php $astatus = $row_flt['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row_flt['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row_flt['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row_flt['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                           <td><?php echo $row_flt['style'];?></td>
                                            <td><?php echo $row_flt['pack_no'];?></td>
                                            <td><?php echo $row_flt['color'];?></td>
                                            <td><?php echo $row_flt['item_desc'];?></td>
                                            <td><?php echo $row_flt['submitfor_approval'];?></td>
                                            <td><?php echo $row_flt['submition_no'];?></td>
                                            <td><?php if((empty($row_flt['sending_date'])) && ($role2!="0") && ($role2!="byer")){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> <?php } if($role2=="0"){?><a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row_flt['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> <?php } if(($role2=="byer") && ($astatus=="0")){ ?> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-edit "></i> Comments</a><?php } ?> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row_flt['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
										<?php }
										 }?>
                                        
                                    </tbody>
                                </table>
<?php }
if($_POST['send'] == 'DELETEsup'){
$isstatus = $this->session->userdata('status');
$isuser = $this->session->userdata('username');

$uid = $_POST['id'];

$fileDQuery ="select suplier.* from suplier WHERE suplier.suplier_id ='".$_POST['id']."'";
$filed_result = mysql_query($fileDQuery) or die(mysql_error());
$filed_arr = mysql_fetch_array($filed_result);

	if (!empty($filed_arr['file']) && file_exists("uploads/supplier/" . $filed_arr['file'])) {
		unlink("uploads/supplier/" . $filed_arr['file']); 
	}
	mysql_query("DELETE FROM suplier WHERE 	suplier_id = '$uid'") or die(mysql_error());

?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <tr>
                                            <th>SI.</th>
                                            <th>Sending date</th>
                                            <th>Comments</th>
                                            <th>Vendor</th>
                                            <th>Status</th>
                                            <th>Style no</th>
                                            <th>Pk no</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Submittied for approval on</th>
                                            <th>Submission no</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$statement2 ='';
									if($isstatus=="1"){
									$statement2 = "Where suplier.receive_to='".$isuser."'";
									}
									if($isstatus=="6"){
										$statement2 = "Where suplier.buyerteam='".$isuser."'";
										}
									$i=1;
									//echo "select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor Order By suplier.suplier_id Asc";
									$query2 ="select suplier.*,tr_company.* from suplier Left Join tr_company ON tr_company.vendor_id=suplier.vendor {$statement2} Order By suplier.suplier_id Desc";
									$result = mysql_query($query2)or die(mysql_error());
									while($row = mysql_fetch_array( $result )){
									
									
										$i++;
									if($i%2 ==0){
									?>
                                        <tr class="odd gradeX">
                                        <?php }
										else{
										?>
                                         <tr class="even gradeC">
                                         <?php } ?>
                                            <td><?php echo $row['serial'];?></td>
                                            <td><?php echo $row['sending_date'];?></td>
                                            <td><?php $astatus = $row['approve'];
											if($astatus==1){
												echo "<span style='color:green;'>Approved</style>";
												}
											if($astatus==2){
												echo "<span style='color:red;'>Rejected</style>";
												}
											if($astatus==3){
												echo "<span style='color:red;'>Conditionally Approved</style>";
												}
											if($astatus==0){
												echo "<span style='color:#df6565;'>Pending</style>";
												}
											?></td>
                                            <td><?php echo $row['vendor_name'];?></td>
                                            <td><?php if($isstatus =="999"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												
												
												$query_method4 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method4 = mysql_query($query_method4)or die(mysql_error());
												$row_method4 = mysql_fetch_array( $result_method4);
												
											    $query_method3 ="select * from tr_user Where vendorid='".$row['vendor']."'";
												$result_method3 = mysql_query($query_method3)or die(mysql_error());
												$row_method3 = mysql_fetch_array( $result_method3);
												
											    echo $row_method3['username'].", ".$row_method2['username'].", ".$row_method4['username'];
											}
											if($isstatus =="1"){
												$query_method2 ="select * from tr_user Where user_id='".$row['buyerteam']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											if($isstatus =="3"){
												$query_method2 ="select * from tr_user Where user_id='".$row['receive_to']."'";
												$result_method2 = mysql_query($query_method2)or die(mysql_error());
												$row_method2 = mysql_fetch_array( $result_method2);
												echo $row_method2['username'];
												}
											?></td>
                                            <td><?php echo $row['style'];?></td>
                                            <td><?php echo $row['pack_no'];?></td>
                                            <td><?php echo $row['color'];?></td>
                                            <td><?php echo $row['item_desc'];?></td>
                                            <td><?php echo $row['submitfor_approval'];?></td>
                                            <td><?php echo $row['submition_no'];?></td>
                                            <td> <a class="btn btn-primary fancybox fancybox.ajax"  href="<?php echo base_url()?>vendor/update_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-edit "></i> Edit</a> &nbsp;<a class="btn btn-danger" onclick="deletesupplier(<?php echo $row['suplier_id'];?>);"><i class="fa fa-pencil"></i> Delete</a> &nbsp;<a class="btn btn-primary fancyboxview fancybox.ajax"  href="view_supplier?ID=<?php echo $row['suplier_id'];?>"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>	
<?php }
?>
