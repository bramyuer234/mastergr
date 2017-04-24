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
	<title>DMCA Notice &raquo; <?php echo $site_name;?></title>
	<meta name="description" property="og:description" content="DMCA Notice &raquo; <?php echo $site_name;?>"/>
	<meta name="keywords" content="DMCA Notice &raquo; <?php echo $site_name;?>"/>
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
							<h1 class="page-title ell">DMCA Notice & Policy</h1>
						</div>
						<div class="page-content">
							<p><?php echo $site_name;?> respects the intellectual property of others. <?php echo $site_name;?> takes matters of Intellectual Property very seriously and is committed to meeting the needs of content owners while helping them manage publication of their content online. It should be noted that <?php echo $site_name;?> is a simple search engine of PDFs and books available at a wide variety of third party websites.</p>
							<p>Any content shown on third party websites are the responsibility of those sites and not <?php echo $site_name;?>. We have no knowledge of whether content shown on third party websites is or is not authorized by the content owner as that is a matter between the host site and the content owner. <?php echo $site_name;?> does not host any content on its servers or network.</p>
							<p>If you believe that your copyrighted work has been copied in a way that constitutes copyright infringement and is accessible on this site, you may notify our copyright agent, as set forth in the <strong>Digital Millennium Copyright Act</strong> of 1998 (DMCA). For your complaint to be valid under the DMCA, you must provide the following information when providing notice of the claimed copyright infringement:</p>
							<ul>
								<li>A physical or electronic signature of a person authorized to act on behalf of the copyright owner Identification of the copyrighted work claimed to have been infringed</li>
								<li>Identification of the material that is claimed to be infringing or to be the subject of the infringing activity and that is to be removed</li>
								<li>Information reasonably sufficient to permit the service provider to contact the complaining party, such as an address, telephone number, and, if available, an electronic mail address</li>
								<li>A statement that the complaining party "in good faith believes that use of the material in the manner complained of is not authorized by the copyright owner, its agent, or law"</li>
								<li>A statement that the "information in the notification is accurate", and "under penalty of perjury, the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed"</li>
							</ul>
							<p class="alert alert-danger">WE CAUTION YOU THAT UNDER FEDERAL LAW, IF YOU KNOWINGLY MISREPRESENT THAT ONLINE MATERIAL IS INFRINGING, YOU MAY BE SUBJECT TO HEAVY CIVIL PENALTIES. THESE INCLUDE MONETARY DAMAGES, COURT COSTS, AND ATTORNEYS´ FEES INCURRED BY US, BY ANY COPYRIGHT OWNER, OR BY ANY COPYRIGHT OWNER´S LICENSEE THAT IS INJURED AS A RESULT OF OUR RELYING UPON YOUR MISREPRESENTATION. YOU MAY ALSO BE SUBJECT TO CRIMINAL PROSECUTION FOR PERJURY.</p>
							<p>This information should not be construed as legal advice, for further details on the information required for valid DMCA notifications, see 17 U.S.C. 512(c)(3).</p>				
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