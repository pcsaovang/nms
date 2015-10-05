<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo CW_TITLE; ?></title>
	<base href="<?php echo base_url(); ?>" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="icon" href="public/img/favicon.ico">
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="public/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="public/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	
	<!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
	<!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="public/js/app.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="public/js/demo.js" type="text/javascript"></script> -->
	<script type="text/javascript" src="plugins/datepicker/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="plugins/datepicker/locales/bootstrap-datepicker.vi.js"></script>
	<script type="text/javascript" src="plugins/input-mask/jquery.inputmask.js"></script>
	<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <body class="skin-blue fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
      <header class="main-header">
        <a href="admin" class="logo"><b>NMS</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
		  <strong class="logo" style="width: auto; background-color: #3C8DBC;">NET MANAGEMENT SYSTEM</strong>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="public/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="public/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $this->auth['username']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="public/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      Boss Net
                      <small>Member since Nov. 2006</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="admin/changepass" class="btn btn-default btn-flat">Đổi mật khẩu</a>
                    </div>
                    <div class="pull-right">
                      <a href="admin/auth/logout" class="btn btn-default btn-flat">Đăng xuất</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li class="active">
              <a href="admin">
                <i class="fa fa-dashboard"></i> <span>Trang chủ</span>
              </a>
            </li>
            <li>
              <a href="admin/members">
                <i class="fa fa-files-o"></i><span>Hội viên</span><span class="label label-primary pull-right">4</span>
              </a>
            </li>
            <li>
              <a href="admin/history/payment">
                <i class="fa fa-th"></i> <span>Giao dịch</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li>
              <a href="admin/history/service">
                <i class="fa fa-pie-chart"></i><span>Dịch vụ</span>
              </a>
            </li>
            <li>
              <a href="admin/history/weburl">
                <i class="fa fa-laptop"></i><span>Web URL</span>
              </a>
            </li>
            <li>
              <a href="admin/history/serverlog"><i class="fa fa-edit"></i> <span>Máy chủ</span>
              </a>
            </li>
            <li>
              <a href="admin/history/systemlog">
                <i class="fa fa-table"></i> <span>Hệ thống</span>
              </a>
            </li>
            <li>
              <a href="admin/clientsys">
                <i class="fa fa-desktop"></i> <span>Máy trạm</span><small class="label pull-right bg-red">3</small>
              </a>
            </li>
			<li>
              <a href="admin/events">
                <i class="glyphicon glyphicon-tasks"></i> <span>Sự kiện</span><small class="label pull-right bg-red">3</small>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="min-height: 750px;">
        <?php $this->load->view($template, isset($data) ? $data: NULL); ?>
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://netphongvan.no-ip.info/">Phong Van</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
  </body>
</html>
