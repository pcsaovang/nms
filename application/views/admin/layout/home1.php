<!doctype html>
<html class="no-js">
  <head>
    <meta charset="UTF-8">
	<base href="<?php echo base_url(); ?>" />
    <title>Metis</title>
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="template/css/main.css">
    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="template/lib/html5shiv/html5shiv.js"></script>
      <script src="template/lib/respond/respond.min.js"></script>
      <![endif]-->
    <!--For Development Only. Not required -->
    <script>
      less = {
        env: "development",
        relativeUrls: false,
        rootpath: "../template/"
      };
    </script>
    <link rel="stylesheet" href="template/css/style-switcher.css">
    <link rel="stylesheet/less" type="text/css" href="template/less/theme.less">
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.2.0/less.min.js"></script>

    <!--Modernizr-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
	
	<!--jQuery -->
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <!--Bootstrap -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <!-- MetisMenu -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.js"></script>

    <!-- Screenfull -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/screenfull.js/2.0.0/screenfull.min.js"></script>

    <!-- Metis core scripts -->
    <script src="template/js/core.min.js"></script>

    <!-- Metis demo scripts -->
    <script src="template/js/app.js"></script>
    <script src="template/js/style-switcher.min.js"></script>
  </head>
  <body class="  ">
    <div class="bg-dark dk" id="wrap">
      <div id="top">
        <!-- .navbar -->
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <header class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
              </button>
              <a href="index.html" class="navbar-brand">
                <img src="template/img/logo.png" alt="">
              </a> 
            </header>
            <div class="topnav">
              <div class="btn-group">
                <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip" class="btn btn-default btn-sm" id="toggleFullScreen">
                  <i class="glyphicon glyphicon-fullscreen"></i>
                </a> 
              </div>
              <div class="btn-group">
                <a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-envelope"></i>
                  <span class="label label-warning">5</span> 
                </a> 
                <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-comments"></i>
                  <span class="label label-danger">4</span> 
                </a> 
                <a data-toggle="modal" data-original-title="Help" data-placement="bottom" class="btn btn-default btn-sm" href="#helpModal">
                  <i class="fa fa-question"></i>
                </a> 
              </div>
              <div class="btn-group">
                <a href="login.html" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
                  <i class="fa fa-power-off"></i>
                </a> 
              </div>
              <div class="btn-group">
                <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip" class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                  <i class="fa fa-bars"></i>
                </a> 
                <a data-placement="bottom" data-original-title="Show / Hide Right" data-toggle="tooltip" class="btn btn-default btn-sm toggle-right"> <span class="glyphicon glyphicon-comment"></span>  </a> 
              </div>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">

              <!-- .nav -->
              <ul class="nav navbar-nav">
                <li><a href="admin/members/display">Hội viên</a>  </li>
                <li><a href="#">Nhật ký giao dịch</a>  </li>
                <li><a href="#">Nhật ký web</a>  </li>
                <li><a href="#">Nhật ký máy chủ</a> 
				<li><a href="#">Đổi mật khẩu</a> 
                </li>
              </ul><!-- /.nav -->
            </div>
          </div><!-- /.container-fluid -->
        </nav><!-- /.navbar -->
        <header class="head">
          <div class="search-bar">
            <form class="main-search" action="">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Live Search ...">
                <span class="input-group-btn">
            <button class="btn btn-primary btn-sm text-muted" type="button">
                <i class="fa fa-search"></i>
            </button>
        </span> 
              </div>
            </form><!-- /.main-search -->
          </div><!-- /.search-bar -->
          <div class="main-bar">
            <h3>
              <i class="fa fa-home"></i>&nbsp; Metis</h3>
          </div><!-- /.main-bar -->
        </header><!-- /.head -->
      </div><!-- /#top -->
      <div id="left">
        <div class="media user-media bg-dark dker">
          <div class="user-media-toggleHover">
            <span class="fa fa-user"></span> 
          </div>
          <div class="user-wrapper bg-dark">
            <a class="user-link" href="">
              <img class="media-object img-thumbnail user-img" alt="User Picture" src="template/img/user.gif">
              <span class="label label-danger user-label">16</span> 
            </a> 
            <div class="media-body">
              <h5 class="media-heading">Archie</h5>
              <ul class="list-unstyled user-info">
                <li> <a href="">Administrator</a>  </li>
                <li>Last Access :
                  <br>
                  <small>
                    <i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32</small> 
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- #menu -->
        <ul id="menu" class="bg-blue dker">
          <li class="nav-header">Menu</li>
          <li class="nav-divider"></li>
          <li class="">
            <a href="dashboard.html">
              <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Dashboard</span> 
            </a> 
          </li>
          <li class="">
            <a href="javascript:;">
              <i class="fa fa-building "></i>
              <span class="link-title">Layouts</span> 
              <span class="fa arrow"></span> 
            </a> 
            <ul>
              <li>
                <a href="boxed.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Boxed Layout </a> 
              </li>
              <li>
                <a href="fixed-header-boxed.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Boxed Layout &amp; Fixed Header </a> 
              </li>
              <li>
                <a href="fixed-header-fixed-mini-sidebar.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Fixed Header and Fixed Mini Menu </a> 
              </li>
              <li>
                <a href="fixed-header-menu.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Fixed Header &amp; Menu </a> 
              </li>
              <li>
                <a href="fixed-header-mini-sidebar.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Fixed Header &amp; Mini Menu </a> 
              </li>
              <li>
                <a href="fixed-header.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Fixed Header </a> 
              </li>
              <li>
                <a href="fixed-menu-boxed.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Boxed Layout &amp; Fixed Menu </a> 
              </li>
              <li>
                <a href="fixed-menu.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Fixed Menu </a> 
              </li>
              <li>
                <a href="fixed-mini-sidebar.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Fixed &amp; Mini Menu </a> 
              </li>
              <li>
                <a href="fxhmoxed.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Boxed and Fixed Header &amp; Nav </a> 
              </li>
              <li>
                <a href="no-header-sidebar.html">
                  <i class="fa fa-angle-right"></i>&nbsp; No Header &amp; Sidebars </a> 
              </li>
              <li>
                <a href="no-header.html">
                  <i class="fa fa-angle-right"></i>&nbsp; No Header </a> 
              </li>
              <li>
                <a href="no-left-right-sidebar.html">
                  <i class="fa fa-angle-right"></i>&nbsp; No Left &amp; Right Sidebar </a> 
              </li>
              <li>
                <a href="no-left-sidebar-main-search.html">
                  <i class="fa fa-angle-right"></i>&nbsp; No Left Sidebar &amp; Main Search </a> 
              </li>
              <li>
                <a href="no-left-sidebar.html">
                  <i class="fa fa-angle-right"></i>&nbsp; No Left Sidebar </a> 
              </li>
              <li>
                <a href="no-main-search.html">
                  <i class="fa fa-angle-right"></i>&nbsp; No Main Search </a> 
              </li>
              <li>
                <a href="no-right-sidebar.html">
                  <i class="fa fa-angle-right"></i>&nbsp; No Right Sidebar </a> 
              </li>
              <li>
                <a href="sm.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Mini Sidebar </a> 
              </li>
            </ul>
          </li>
          <li class="">
            <a href="javascript:;">
              <i class="fa fa-tasks"></i>
              <span class="link-title">Components</span> 
              <span class="fa arrow"></span> 
            </a> 
            <ul>
              <li>
                <a href="bgcolor.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Bg Color </a> 
              </li>
              <li>
                <a href="bgimage.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Bg Image </a> 
              </li>
              <li>
                <a href="button.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Buttons </a> 
              </li>
              <li>
                <a href="icon.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Icon </a> 
              </li>
              <li>
                <a href="pricing.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Pricing Table </a> 
              </li>
              <li>
                <a href="progress.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Progress </a> 
              </li>
            </ul>
          </li>
          <li class="">
            <a href="javascript:;">
              <i class="fa fa-pencil"></i>
              <span class="link-title">
            Forms
	  </span> 
              <span class="fa arrow"></span> 
            </a> 
            <ul>
              <li>
                <a href="form-general.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Form General </a> 
              </li>
              <li>
                <a href="form-validation.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Form Validation </a> 
              </li>
              <li>
                <a href="form-wizard.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Form Wizard </a> 
              </li>
              <li>
                <a href="form-wysiwyg.html">
                  <i class="fa fa-angle-right"></i>&nbsp; Form WYSIWYG </a> 
              </li>
            </ul>
          </li>
          <li>
            <a href="table.html">
              <i class="fa fa-table"></i>
              <span class="link-title">Tables</span> 
            </a> 
          </li>
          <li>
            <a href="file.html">
              <i class="fa fa-file"></i>
              <span class="link-title">
      File Manager
          </span> 
            </a> 
          </li>
          <li>
            <a href="typography.html">
              <i class="fa fa-font"></i>
              <span class="link-title">
            Typography
          </span>  </a> 
          </li>
          <li>
            <a href="maps.html">
              <i class="fa fa-map-marker"></i><span class="link-title">
            Maps
          </span> 
            </a> 
          </li>
        </ul><!-- /#menu -->
      </div><!-- /#left -->
      <div id="content">
		<div class="outer">
          <div class="bg-light lter">
			  <div class="row">
				<div class="col-lg-12 ui-sortable">
				  <?php
					$this->load->view($template, isset($data) ? $data: NULL); 
				  ?>
				</div>
			  </div>
		  </div>
		</div>
      </div><!-- /#content -->
      <div id="right" class="bg-light lter">
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Warning!</strong>  Best check yo self, you're not looking too good.
        </div>

        <!-- .well well-small -->
        <div class="well well-small dark">
          <ul class="list-unstyled">
            <li>Visitor <span class="inlinesparkline pull-right">1,4,4,7,5,9,10</span> 
            </li>
            <li>Online Visitor <span class="dynamicsparkline pull-right">Loading..</span> 
            </li>
            <li>Popularity <span class="dynamicbar pull-right">Loading..</span> 
            </li>
            <li>New Users <span class="inlinebar pull-right">1,3,4,5,3,5</span> 
            </li>
          </ul>
        </div><!-- /.well well-small -->

        <!-- .well well-small -->
        <div class="well well-small dark">
          <button class="btn btn-block">Default</button>
          <button class="btn btn-primary btn-block">Primary</button>
          <button class="btn btn-info btn-block">Info</button>
          <button class="btn btn-success btn-block">Success</button>
          <button class="btn btn-danger btn-block">Danger</button>
          <button class="btn btn-warning btn-block">Warning</button>
          <button class="btn btn-inverse btn-block">Inverse</button>
          <button class="btn btn-metis-1 btn-block">btn-metis-1</button>
          <button class="btn btn-metis-2 btn-block">btn-metis-2</button>
          <button class="btn btn-metis-3 btn-block">btn-metis-3</button>
          <button class="btn btn-metis-4 btn-block">btn-metis-4</button>
          <button class="btn btn-metis-5 btn-block">btn-metis-5</button>
          <button class="btn btn-metis-6 btn-block">btn-metis-6</button>
        </div><!-- /.well well-small -->

        <!-- .well well-small -->
        <div class="well well-small dark">
          <span>Default</span> <span class="pull-right"><small>20%</small> </span> 
          <div class="progress xs">
            <div class="progress-bar progress-bar-info" style="width: 20%"></div>
          </div>
          <span>Success</span> <span class="pull-right"><small>40%</small> </span> 
          <div class="progress xs">
            <div class="progress-bar progress-bar-success" style="width: 40%"></div>
          </div>
          <span>warning</span> <span class="pull-right"><small>60%</small> </span> 
          <div class="progress xs">
            <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
          </div>
          <span>Danger</span> <span class="pull-right"><small>80%</small> </span> 
          <div class="progress xs">
            <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
          </div>
        </div>
      </div><!-- /#right -->
    </div><!-- /#wrap -->
    <footer class="Footer bg-dark dker">
      <p>2014 &copy; Metis Bootstrap Admin Template</p>
    </footer><!-- /#footer -->

    <!-- #helpModal -->
    <div id="helpModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
              in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->
  </body>