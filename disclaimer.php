<?php
include 'inc/function.php';
include 'inc/connect.php';
$canonical = $site_url.$_SERVER["REQUEST_URI"];
?>
<!DOCTYPE html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Disclaimer Page &raquo; <?php echo $site_name;?></title>
	<meta name="description" property="og:description" content="Disclaimer Page &raquo; <?php echo $site_name;?>"/>
	<meta name="keywords" content="Disclaimer Page &raquo; <?php echo $site_name;?>"/>
 	<meta name="robots" content="noindex,nofollow">
	<link rel="canonical" href="<?php echo $canonical;?>">
	
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
							<h1 class="page-title ell">Disclaimer</h1>
						</div>
						<div class="page-content">
							<p><?php echo $site_name;?> provides this website as a service. While the information contained within the site is periodically updated, no guarantee is given that the information provided in this website is correct, complete, and/or up-to- date.</p>
							<p><?php echo $site_name;?> is in no way intended to support illegal activity. We uses Search API to find books/manuals but doesn&acute;t host any files. All document files are the property of their respective owners. Please respect the publisher and the author for their copyrighted creations. If you find documents that should not be here please report them at <a href="/dmca-policy.html">here</a>. The materials contained on this website are provided for general information purposes only. <?php echo $site_name;?> does not accept any responsibility for any loss which may arise from reliance on information contained on this site.</p>
							<p>Permission is given for the downloading and temporary storage of one or more of these pages for the purpose of viewing on a personal computer. The contents of this site are protected by copyright under international conventions and, apart from the permission stated, the reproduction, permanent storage, or retransmission of the contents of this site is prohibited without the prior written consent of <?php echo $site_name;?>.</p>
							<p>Some links within this website may lead to other websites, including those operated and maintained by third parties. <?php echo $site_name;?> includes these links solely as a convenience to you, and the presence of such a link does not imply a responsibility for the linked site or an endorsement of the linked site, its operator, or its contents (exceptions may apply).</p>
							<p>This website and its contents are provided 'AS IS' without warranty of any kind, either express or implied, including, but not limited to, the implied warranties of merchantability, fitness for a particular purpose, or non-infringement.</p>
							<p>Reproduction, distribution, republication, and/or retransmission of material contained within this website are prohibited unless the prior written permission of <?php echo $site_name;?> has been obtained.</p>
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