<?php
include 'inc/function.php';
include 'inc/connect.php';

?>
<!DOCTYPE html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>FAQ Page &raquo; <?php echo $site_name;?></title>
	<meta name="description" property="og:description" content="FAQ Page &raquo; <?php echo $site_name;?>"/>
	<meta name="keywords" content="FAQ Page &raquo; <?php echo $site_name;?>"/>
 	<meta name="robots" content="noindex,nofollow">
	
	<link rel="stylesheet" id="boots-css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" media="all">
	<link rel="stylesheet" id="awesome-css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CPT+Sans+Narrow%7CSource+Sans+Pro:200,300,400,600,700,900&amp;subset=all" type="text/css">
	<link rel="stylesheet" id="stylesheet-css" href="<?php echo $site_url;?>/style.css" type="text/css" media="all">
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
	<![endif]-->
</head>

<body class="single ">
<div id="page" data-domain="<?php echo $domain;?>" data-role="page">
    <div class="ui-panel-wrapper">
        <header id="header" data-role="header">
			<nav class="navbar navbar-default">
				<div class="navbar-header">
					<div id="site-title">
						<a class="navbar-brand" href="<?php echo $site_url;?>"><?php echo $site_title;?></a>
					</div>
				</div>
				<div class="collapse navbar-collapse"></div>	
			</nav>
        </header>
		<div id="primary" class="content" data-role="main">
			<div class="wrapper">
				<div id="content">
				    <div class="content-wrapper">
						<div class="page-header">
							<h1 class="page-title ell">Frequently Asked Questions</h1>
						</div>
						<div class="page-content">
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">What is "<?php echo $site_name;?>"?</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											<p><?php echo $site_name;?> is a site that provides book overview over the world. We uses Search API to find books/manuals but doesn't host any files. All document files are the property of their respective owners. Please read our <a href="<?php echo $site_url;?>/disclaimer">disclaimer</a> for more details.</p>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Does "<?php echo $site_name;?>" Legal?</a>
												</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">
											<p>As we state before, <?php echo $site_name;?> uses Search API to find books/manuals but doesn't host any files. All document files are the property of their respective owners. We're in no way intended to support illegal activity. Please read our <a href="<?php echo $site_url;?>/disclaimer">disclaimer</a> for more details.</p>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Does "<?php echo $site_name;?>" Totally Free?</a>
										</h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse">
										<div class="panel-body">
											<p>Yes, you can use <?php echo $site_name;?> as your preference as long as you agree with our <a href="<?php echo $site_url;?>/privacy-policy">privacy policy</a>. But you should realize that there're links to third party website, some of them offer you with <strong>"Free Register Account"</strong> in a periode of time (Free Trial Account). We don't responsible for the content of those website nor any interactions you take on those site.</p>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">How to cancel your account?</a>
										</h4>
									</div>
									<div id="collapseFour" class="panel-collapse collapse">
										<div class="panel-body">
											<p>You should realize that we don't provide memberships service in this site. So if you want to cancel your account, you should contact website where you signed up before. All cancel account request through our site will be ignored.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
				<div id="secondary"><!-- Sidebar Starts-->
					<?php include'sidebar.php';?>
				</div><!-- Sidebar Ends-->
				<div class="clear"></div>
			</div>
		</div>
		<footer id="footer" data-role="footer">
			<!-- footer cut to enclosed body -->
			<?php include 'footer.php';?>
</body>
</html>	