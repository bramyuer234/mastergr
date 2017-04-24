<?php
error_reporting(0);
include 'inc/simple_html_dom.php';
include 'inc/function.php';
include 'inc/connect.php';

$url = 'http://www.goodreads.com/genres';
$load = baca($url);
$html = str_get_html($load);

?>
<!DOCTYPE html>
<html lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo $site_title; ?></title>
	<meta name="description" property="og:description" content="<?php echo $site_title; ?> Free on PDF, E-Pub, or Kindle Ebook format. Just follow easy step to register free."/>
	<meta name="keywords" content="<?php echo $site_title; ?>, <?php echo $site_name; ?>, download, read online, e-pub, pdf, free, kindle ebook"/>
	<meta property="og:title" content="<?php echo $site_title; ?>"/>
	<meta property="og:site_name" content="<?php echo $site_name; ?>"/>
	<meta property="og:url" content="<?php echo $site_url; ?>" />

	<link rel="canonical" href="<?php echo $site_url; ?>">
	<link rel="stylesheet" id="boots-css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" media="all">
	<link rel="stylesheet" id="awesome-css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CPT+Sans+Narrow%7CSource+Sans+Pro:200,300,400,600,700,900&amp;subset=all" type="text/css">
	<link rel="stylesheet" id="stylesheet-css" href="<?php echo $site_url; ?>/style.css" type="text/css" media="all">		<link rel="icon" type="image/png" href="http://www.polyinnovations.com/images/e-book.png">
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
	<![endif]-->
</head>

<body class="home ">
<div id="page" data-domain="<?php echo $domain;?>" data-role="page">
    <div class="ui-panel-wrapper">
        <header id="header" data-role="header">
			<nav class="navbar navbar-default">
				<div class="navbar-header">
					<h1 id="site-title"><a class="navbar-brand" href="<?php echo $site_url; ?>"><?php echo $site_name; ?></a></h1>
				</div>
				<div class="collapse navbar-collapse"></div>	
			</nav>
        </header>
		<div id="primary" class="content" data-role="main">
			<div class="wrapper">
				<div id="content">
					<div class="content-wrapper">
						<?php
						foreach($html->find('div.coverBigBox') as $grup){
							$cat_html = str_get_html($grup->outertext);
							$cat_name = $cat_html->find('h2.brownBackground', 0)->plaintext;
							echo '<div class="section"><h2 class="section-header">'.$cat_name.'</h2><ul class="book-list">';
							foreach($cat_html->find('div.leftAlignedImage') as $posts){
								$id = cutter($posts,'<a href="/book/show/','-');
								$judul = cutter($posts,'<img alt="','" title');
								$slug_s = explode(" ",$judul);
								$slug_s = $slug_s[0];
								$slugs = str_replace(array("'",",",".",":",";",'"',"'s","'t"),"",$slug_s);
								$slugs = strtolower(clean_character($slugs));
								if(strlen($slugs) < 4){
									$slugs = 'download';
								}
								$image = cutter($posts,'class="bookImage" src="','"');
								$image = str_replace('l','m',$image);
								echo '<li><a href="'.$site_url.'/'.$id.'.'.slugify($judul).'.html" data-toggle="tooltip" title="'.$judul.'" rel="bookmark"><img class="book-cover" src="'.$image.'" alt="'.$judul.'" width="115" height="180" /></a></li>';
							}
							echo '</ul></div>';
						}
						?>
					</div>
				</div>	
			</div>
			<?php unset($html);?>
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