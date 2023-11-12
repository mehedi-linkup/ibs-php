<?php /*session_start();
if(isset($_SESSION['username'])){
			header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/dashboard.php");
}
include('setting.php');
$error="";
if($_POST['login'] == 'Login'){
$username = mysql_real_escape_string($_POST['username']);
$password = md5(mysql_real_escape_string($_POST['password']));
$query ="select * from tr_user where username='$username' and password='$password'";
$result = mysql_query($query)or die(mysql_error());
$row = mysql_fetch_array( $result );
$myid = $row['user_id'];
if (mysql_num_rows($result) != 1) {
   $error="Wrong username or Password";
} 
else{
$_SESSION['username'] = "$myid";
header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/dashboard.php");
}
}*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vendor Management</title>
    <!-- Bootstrap Styles-->
    <link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo base_url()?>assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="<?php echo base_url()?>assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper" style="padding-top:60px; min-height:656px;">
            <div id="page-inner" style="width:auto;">
            <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                         &nbsp;
                    </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
             <h3 id="s2" style="color:#FFF;">Welcome to IBS &nbsp;</h3>
             <center style="padding-bottom:15px;"><img src="<?php echo base_url()?>assets/img/target.png" alt="logo"></center>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                         &nbsp;
                    </div>
            </div>
				<div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                         &nbsp;
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                        <div class="panel-footer back-footer-blue">
                        		Login To Admin Panel
                            </div>
                            <div class="panel-body">
                             <?php if(!empty($message)){?>
                            <div class="alert alert-danger">
									<strong>Oh snap!</strong> <?php echo $message?>
								</div>
                                <?php } ?>
                                <?php echo validation_errors(); ?>
                               <form role="form" action="<?php echo base_url();?>vendor/login" method="post">
                                        <div class="form-group">
                                            <label>UserName</label>
                                            <input class="control" name="username" value="" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="control" type="password" name="password" >
                                        </div>
                                        <div class="form-group">
                                            <label style="float:left; width:35%;">&nbsp;</label>
                                             <input type="hidden" name="login" value="Login">
                                            <button type="submit" class="btn btn-default" style="float:left;">Login</button>
                                        </div>
                                        
                                    </form>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        &nbsp;
                    </div>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?php echo base_url()?>assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url()?>assets/js/endless_scroll_min.js" type="text/javascript"></script>
<script>
    if(("standalone" in window.navigator) && window.navigator.standalone){
	// If you want to prevent remote links in standalone web apps opening Mobile Safari, change 'remotes' to true
	var noddy, remotes = true;

	document.addEventListener('click', function(event) {
		noddy = event.target;
		// Bubble up until we hit link or top HTML element. Warning: BODY element is not compulsory so better to stop on HTML
		while(noddy.nodeName !== "A" && noddy.nodeName !== "HTML") {
	        noddy = noddy.parentNode;
	    }

		if('href' in noddy && noddy.href.indexOf('http') !== -1 && (noddy.href.indexOf(document.location.host) !== -1 || remotes))
		{
			event.preventDefault();
			document.location.href = noddy.href;
		}

	},false);
}
</script> 
<script type="text/javascript">
    $(window).load(function () {
        $("#s2").endlessScroll({ 
		width: '420px', 
		height: '48px', 
		steps: -2, 
		speed: 40, 
		mousestop: false });
    });
</script>
    <!-- Bootstrap Js -->
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>



</body>

</html>