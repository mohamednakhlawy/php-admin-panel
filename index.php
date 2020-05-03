<?php
include("db.php");
$page_name = isset($_GET['page']) ? $_GET['page'] : 'home';
$statement = $DB->prepare(" select * from `pages` where `name` = ? ");
$statement->execute([$page_name]);
$page = $statement->fetchAll()[0];
if(empty($page)){
	exit("Error 404");
}
?><!doctype html>
<!--[if IE 8 ]><html lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
	<head>

		<meta name="viewport" content="initial-scale=1 maximum-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title><?= $page['title']; ?></title>

		<meta property="og:image" content="http://cdainterview.com/images/<?= $page['featured_image']; ?>" />
		<meta name="description" content="<?= $page['description']; ?>" />

		<meta name="robots" content="<?= $page['robots']; ?>" />

		<link rel="stylesheet" type="text/css" media="screen" href="css/styles.css"  />
		<style type="text/css" media="all">#feature {background-image: url(images/<?= $page['featured_image']; ?>);}</style>

		<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<script type="text/javascript" src="js/html5shiv.js"></script>
		<![endif]-->

		<script type="text/javascript" src="js/javascript.js"></script>
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/function.js"></script>
		<script type="text/javascript" src="js/jquery.fitvids.js"></script>
		<script type="text/javascript" src="js/jquery.flexslider.js"></script>
		<script type='text/javascript' charset='utf-8' src='js/stacks_page_page0.js'></script>

		<!--[if lte IE 7]>
			<link rel='stylesheet' type='text/css' media='all' href='css/stacks_ie.css' />
		<![endif]-->

		<?= base64_decode($config['head_code']); ?>

	</head>

	<body>

		<div id="wrapper">

		    <div id="hwrap">
		        <header class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
		           <?php include("header.php"); ?>
			    </header>
			</div>

		    <div class="banner video_banner">
		        <div id="feature">
		            <div id="extraContainer9">
						<div id="myExtraContent9"><?= $page['slogan']; ?></div>
					</div>
		        </div>

		    </div>

		</div>

		<div class="clear"></div>

		<div id="container">

		    <section>

		        <div id="padding">

		            <?php include('pages/'.$page['name'].".php"); ?>

		        </div>

		    </section>

		    <div id="asidewrap">
		        <aside>
		            <div id="sidecontent">
		                <a class="social" href="https://www.facebook.com/bemoacademicconsulting">F</a>
		                <a class="social" href="https://twitter.com/BeMo_AC">L</a>
		            </div>
		        </aside>
		    </div>
		    <div class="clear"></div>

		</div>

		<footer>
			<?php include("footer.php"); ?>
		</footer>

		<a href="#" class="scrollup">Scroll</a>

	</body>

</html>
