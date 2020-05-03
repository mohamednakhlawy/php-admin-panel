<?php
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!==true){
	include("login.php");
	exit;
}
include("../db.php");
$page_name = isset($_GET['page']) ? $_GET['page'] : 'home';
if($page_name=="logout"){
	$_SESSION['logged_in'] = false;
	header("location: /admin/");
}
?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Ela Admin</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
	    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
	    <link rel="stylesheet" href="assets/css/style.css">
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/lib/chosen/chosen.min.css">
	</head>

	<body>
	    <!-- Left Panel -->
	    <aside id="left-panel" class="left-panel">
	        <nav class="navbar navbar-expand-sm navbar-default">
	            <div id="main-menu" class="main-menu collapse navbar-collapse">
	                <ul class="nav navbar-nav">
						<li<?php if($page_name=="home"){echo ' class="active"';} ?>>
	                        <a href="../admin/index.php?page=home"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
	                    </li>

						<li<?php if($page_name=="pages"){echo ' class="active"';} ?>>
	                        <a href="../admin/index.php?page=pages"><i class="menu-icon fa fa-book"></i>Pages </a>
	                    </li>

						<li<?php if($page_name=="config"){echo ' class="active"';} ?>>
	                        <a href="../admin/index.php?page=config"><i class="menu-icon fa fa-cog"></i>Config </a>
	                    </li>

	                </ul>
	            </div><!-- /.navbar-collapse -->
	        </nav>
	    </aside>
	    <!-- /#left-panel -->
	    <!-- Right Panel -->
	    <div id="right-panel" class="right-panel">
	        <!-- Header-->
	        <header id="header" class="header">
	            <div class="top-left">
	                <div class="navbar-header">
	                    <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
	                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
	                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
	                </div>
	            </div>
	            <div class="top-right">
	                <div class="header-menu">

	                    <div class="user-area dropdown float-right">
	                        <a href="#">
	                        	Logout <i class="menu-icon fa fa-sign-out"></i>
	                        </a>
	                    </div>

	                </div>
	            </div>
	        </header>
	        <!-- /#header -->
	        <!-- Content -->
	        <div class="content">
	         	<?php include("pages/".$page_name.".php"); ?>
	        </div>
	        <!-- /.content -->
	        <div class="clearfix"></div>
	        <!-- Footer -->
	        <footer class="site-footer">
	            <div class="footer-inner bg-white">
	                <div class="row">
	                    <div class="col-sm-6">
	                        Copyright &copy; 2018 Ela Admin
	                    </div>
	                    <div class="col-sm-6 text-right">
	                        Designed by <a href="https://colorlib.com">Colorlib</a>
	                    </div>
	                </div>
	            </div>
	        </footer>
	        <!-- /.site-footer -->
	    </div>
	    <!-- /#right-panel -->

	    <!-- Scripts -->
	    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.min.js"></script>
		<script src="assets/js/lib/chosen/chosen.jquery.min.js"></script>
		<script src="assets/js/main.js"></script>


	</body>
</html>
