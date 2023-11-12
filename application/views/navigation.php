        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-vendor=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php"><img src="<?php echo base_url()?>assets/img/vendor.png" alt="logo"></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a class="fancybox fancybox.ajax" href="<?php echo base_url()?>vendor/manageprofile"><i class="fa fa-user fa-fw"></i>User Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url()?>vendor/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
            	<?php $role = $this->session->userdata('verdorid');
				$isstatus = $this->session->userdata('status');
				 ?>
            <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" href="<?php echo base_url()?>vendor/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>vendor/manage_order"><i class="fa fa-plus-square"></i>Sample Submission</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>vendor/manage_supplier"><i class="fa fa-plus-square"></i>Supplies Submission</a>
                    </li>
                     <?php 
					if($isstatus=="999"){
					?>
                    <li>
                        <a href="<?php echo base_url()?>vendor/vendorlist"><i class="fa fa-plus-square"></i>Add Company</a>
                    </li>
                   
                    <li>
                        <a href="<?php echo base_url()?>vendor/userlist"><i class="fa fa-users"></i>User Management</a>
                    </li>
                    <?php } ?>
					<li>
                        <a class="fancybox fancybox.ajax" href="<?php echo base_url()?>vendor/manageprofile"><i class="fa fa-cog"></i> Manage Profile</a>
                    </li>
                    <li>
                        <a class="fancybox fancybox.ajax" href="<?php echo base_url()?>vendor/changepass"><i class="fa fa-unlock-alt"></i>Change Password</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>vendor/logout"><i class="fa fa-power-off"></i> Log Out </a>
                    </li>
                </ul>
            </div>
			
        </nav>
        <!-- /. NAV SIDE  -->
