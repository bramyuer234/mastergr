<?php
error_reporting(0);
include 'inc/simple_html_dom.php';
include 'inc/function.php';
include 'inc/connect.php';

/* Grab Menggunakan Api */

if(isset($_GET['id'])){
	$id = $_GET['id'];
}
$id_buku = $id;
$api = file_get_contents('http://104.236.160.23/txt/apikey.txt');
$api = explode("\r\n",$api);
shuffle($api);
// $start = getmicrotime();
$xml = simplexml_load_file("https://www.goodreads.com/book/show/".$id.".xml?format=xml&key=".$api[0]."");
$isbn = $xml->book->isbn;
if(empty($isbn)){
	$isbn13 = $xml->book->isbn13;
	$isbn = $isbn13;
}

$country_code = $xml->book->country_code;
$publication_year = $xml->book->publication_year;
$publication_month = $xml->book->publication_month;
$publication_day = $xml->book->publication_day;
$tanggal_pub = $publication_day.'/'.$publication_month.'/'.$publication_year;
$publisher = $xml->book->publisher;
$language_code = $xml->book->language_code;
$original_title = $xml->book->work->original_title;

//meta title dan meta deskripsi
//tag yg tersedia : [title], [author], [genre], [content]
$title1 = 'Download {&#9734;|&#10003;|&#'.rand(180,245).';|&#8608;} or Read [title] PDF by {&#9734;|&#10003;|&#'.rand(180,245).';|&#8608;} [author] eBook or Kindle ePUB free';
$title2 = 'Read [[genre] Book] {&#9734;|&#10003;|&#'.rand(180,245).';|&#8608;} [title] PDF by [author] {&#10003;|&#'.rand(180,245).';|&#8608;} eBook or Kindle ePUB free';
$title3 = '[author] {&#10003;|&#'.rand(180,245).';|&#9734;|&#8608;} Read [title] [[genre] Book] PDF {&#10003;|&#'.rand(180,245).';|&#9734;|&#8608;} Read Online eBook or Kindle ePUB';
$title4 = 'Read {&#9734;|&#10003;|&#'.rand(180,245).';|&#8608;} [title] by [author] {&#10003;|&#'.rand(180,245).';|&#8608;} eBook or Kindle ePUB';
$title5 = 'Read [title] {&#10003;|&#'.rand(180,245).';|&#9734;|&#8608;} PDF Ready Download by {&#9734;|&#10003;|&#'.rand(180,245).';|&#8608;} [author] eBook or Kindle ePUB free';

$meta_title = spintax('{'.$title1.'|'.$title2.'|'.$title3.'|'.$title4.'|'.$title5.'}');

$judul = $xml->book->title;
$judul = preg_replace('/\s+/', ' ',$judul);						//menghilangkan spasi yg panjang dan kosong
$judul_buku = $judul;
if($judul == 'Explore Books'){
	header( "Location: $site_url" );
	exit;
}

$desc = $xml->book->description;
// $desc = strip_tags($desc);				//Sukses
if(empty($desc)){
	$desc = preg_replace("/<\/?span[^>]*\>/i", "", $descs);
}
$desc = trim($desc);
$desc = strip_tags($desc);

//meta deskripsi
$metadesc = preg_replace('/\s+/', ' ',$desc);	
$metadesc = substr($metadesc,0,200);
$metadesc = str_replace('"','',$metadesc);
$excerpt = str_replace('"','',$metadesc);

//potong deskripsi
$long = 377;
if(strlen($desc)>$long){
	$desc = substr($desc,0,$long);
}

// grabbing image
$image_url = explode("/",$xml->book->image_url);
$image_url = $image_url[4].'/'.$image_url[5];
$image_url = str_replace("m","l",$image_url);
$image = 'https://d.gr-assets.com/books/'.$image_url;
if($image == 'https://d.gr-assets.com/books/nophoto/book'){
	$image = 'http://toastmasters.kz/wp-content/uploads/2016/05/goodreads.jpg';
}

//penulis
$penulis = $xml->book->authors->author->name;
$autor_id = $xml->book->authors->author->id;
$gambar_author = $xml->book->authors->author->image_url;

/* Detail Penulis */
$loader = simplexml_load_file('https://www.goodreads.com/author/show/'.$autor_id.'?format=xml&key='.$api[0]);
$about_author = $loader->author->about;
$about_author = clean_character(trim(strip_tags($about_author)));
if(strlen($about_author) > 600){
$about_author = substr($about_author,0,600);
}

/* Rating */
$average_rating = $xml->book->average_rating;	//Avg Rating
$pages = $xml->book->num_pages;		//Jumlah 
if(empty($pages) || strlen($pages)>15){
	$pages = '-';
}
$format = $xml->book->format;		//Format Buku
$rating_count = $xml->book->ratings_count;		//Jumlah Rating
$rating_dist = $xml->book->work->rating_dist;
$rating_dist = explode("total:",$rating_dist);
$ratings = $rating_dist[1];		
$rating = $xml->book->average_rating;//Rating

//Genres
$genres = array('Art','Biography','Business','Chick Lit','Childrens','Christian','Classics','Comics','Contemporary','Cookbooks','Crime','Ebooks','Fantasy','Fiction','Graphic Novels','Historical Fiction','History','Horror','Memoir','Music','Mystery','Non Fiction','Paranormal','Philosophy','Poetry','Psychology','Religion','Romance','Science','Science Fiction','Self Help','Suspense','Spirituality','Sports','Thriller','Travel','Young Adult');

if(count($genres)>1){
	$kategori = ucwords($genres[0]);
	$genres = array_filter($genres);
	$genres = array_unique($genres);
	$genrescomas = implode(', ',$genres);
}

foreach($loader->author->books->book as $bokok){
	$related['id'] = $bokok->id;
	$related['judul'] = $bokok->title;
	$related['gambar'] = $bokok->image_url;
	$related_data[] = $related;
	
}
array_filter($related_data);
shuffle($related_data);
$canonical = $site_url.$_SERVER["REQUEST_URI"];

//replace meta
$meta_title = str_replace(array('[title]','[author]','[genre]'),array($judul_buku,$penulis,$kategori),$meta_title);
$meta_desc = str_replace(array('[title]','[author]','[genre]','[content]'),array($judul_buku,$penulis,$kategori,$excerpt),$meta_desc);

$slug_s = explode(" ",$judul);
$slug_s = $slug_s[0];
$slugs = str_replace(array("'",",",".",":",";",'"',"'s","'t"),"",$slug_s);
$slugs = strtolower(clean_character($slugs));
if(strlen($slugs) < 4){
	$slugs = 'download';
}
$landing = $LP.'/'.slugify($judul).'.html';

$content = explode("\n",file_get_contents($LP."/bad.txt"));
if (in_array(slugify($judul), $content)){
  echo "<i>We Apologize. This Content Has Been <strong>BANNED</strong>.</i><hr><h1>404<h1>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo $meta_title;?></title>
	
	<meta name="description" property="og:description" content="<?php echo $judul;?> Books by <?php echo $penulis;?>. <?php echo $metadesc;?>"/>
	<meta name="keywords" content="<?php echo $judul_buku; ?>, <?php echo $penulis; ?>, download, read online, e-pub, pdf, free, kindle ebook"/>
	
	<meta property="og:title" content="<?php echo $meta_title;?>" />
	<meta property="og:url" content="<?php echo $canonical; ?>" />
	<meta property="og:site_name" content="<?php echo $site_name; ?>" />
	<meta property="og:image" content="<?php echo $image_path.$image;?>"/>
	<?php
	if(count($genres)>1){
		foreach($genres as $tags){
		echo '
		<meta property="article:tag" content="'.$tags.'" />';
		}
	}
	?>
	
    <link rel="canonical" href="<?php echo $canonical;?>">
	<link rel="stylesheet" id="boots-css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" media="all">
	<link rel="stylesheet" id="awesome-css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CPT+Sans+Narrow%7CSource+Sans+Pro:200,300,400,600,700,900&amp;subset=all" type="text/css">
	<link rel="stylesheet" id="stylesheet-css" href="<?php echo $site_url;?>/style.css" type="text/css" media="all">
	<link rel="icon" type="image/png" href="http://www.polyinnovations.com/images/e-book.png">
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
						<article id="book-<?php echo $id_buku;?>" class="book" itemscope itemtype="http://schema.org/Book">
							<header class="entry-header">
								<h1 class="entry-title ell" data-title="<?php echo $judul_buku;?>">Read <span itemprop="name"><?php echo $judul_buku;?></span> <small>by <?php echo $penulis;?></small> Online</h1>
								<div class="entry-meta ell"><div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"><meta itemprop="ratingValue" content="<?php echo $rating;?>"><meta itemprop="ratingCount" content="<?php echo $rating_count;?>"></div></div>
								<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#dmcaModal" onclick="myFunction()"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> Report this Page</button>
							</header>
							<div class="entry-content">
								<div class="cover-wrapper">
									<div class="cover-image">
										<img itemprop="image" class="book-cover" src="<?php echo $image;?>" alt="<?php echo $judul_buku;?>" width="150" height="225" />
									</div>
									<div class="overview">
										<p itemprop="description"><?php echo $desc;?>...</p>
										<div class="text-center">
											<button type="button" data-toggle="tooltip" title="Advertisement" class="close adsinfo"><span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span></button>
											<div class="btn-group btn-group-lg button-wrapper" role="group">
												<button class="btn btn-info" onclick="adsClick()" data-toggle="tooltip" title="Download <?php echo $judul_buku;?>"><i class="fa fa-cloud-download"></i> Download</button>
												<button class="btn btn-info" onclick="ReadClick()" data-toggle="tooltip" title="Read Online <?php echo $judul_buku;?>"><i class="fa fa-book"></i> Read Online</button>
											</div>
										</div>
									</div>
								</div>
								<div class="detail-wrapper">
									<table class="book-meta table table-striped table-hover table-condensed">
										<tr>
											<td class="meta-title">Title</td>
											<td class="meta-sep">:</td>
											<td class="meta-value fwb"><?php echo $judul_buku;?></td>
										</tr>
										<tr>
											<td class="meta-title">Author</td>
											<td class="meta-sep">:</td>
											<td class="meta-value"><span itemprop="author" itemscope itemtype="http://schema.org/Person"><span class="author" itemprop="name"><?php echo $penulis;?></span></span></td>
										</tr>
										<tr>
											<td class="meta-title">Rating</td>
											<td class="meta-sep">:</td>
											<td class="meta-value"><div class="rating-star" ><span title="<?php echo $rating;?> out of 5 stars" data-toggle="tooltip" data-placement="right"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span></span></div></td>
										</tr>
										<tr>
											<td class="meta-title">ISBN</td>
											<td class="meta-sep">:</td>
											<td class="meta-value"><span itemprop="isbn"><?php echo $isbn;?></span></td>
										</tr>
										<tr>
											<td class="meta-title">Format Type</td>
											<td class="meta-sep">:</td>
											<td class="meta-value"><span itemprop="bookFormat"><?php echo $format;?></span></td>
										</tr>
										<tr>
											<td class="meta-title">Number of Pages</td>
											<td class="meta-sep">:</td>
											<td class="meta-value"><span itemprop="numberOfPages"><?php echo $pages;?></span></td>
										</tr>
										<tr>
											<td class="meta-title">Url Type</td>
											<td class="meta-sep">:</td>
											<td class="meta-value-genres">
											<?php echo '
											<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
											<meta itemprop="url" content="'.$site_url.''.$_SERVER['REQUEST_URI'].'"/>
												<a href="'.$site_url.'">Home</a> &raquo; <a href="'.$site_url.'">'.ucfirst($slugs).'</a> &raquo; <span itemprop="title">'.$judul.'</span>
											</span>' ?></td>
										</tr>
									</table>
								</div>
								<hr>
								<div id="reviews">
									<!--<h3 class="ell">Reviews</h3>-->
									
								</div>
								<div id="ads" class="text-center">
									<button type="button" data-toggle="tooltip" title="Advertisement" class="close adsinfo"><span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span></button>
									<div class="btn-group btn-group-lg button-wrapper" role="group">
										<button class="btn btn-success" onclick="adsClick()" data-toggle="tooltip" title="Download Getting Things Done: The Art of Stress-Free Productivity"><i class="fa fa-cloud-download"></i> Download</button>
										<button class="btn btn-success" onclick="ReadClick()" data-toggle="tooltip" title="Read Online Getting Things Done: The Art of Stress-Free Productivity"><i class="fa fa-book"></i> Read Online</button>
									</div>
								</div>
							</div>
							
							<footer class="entry-meta"></footer>
						</article>
						<hr>
						<div id="related">
							<h3 class="section-header ell">Books Related with <?php echo $judul_buku;?> by <?php echo $penulis;?></h3>
							<ul class="book-list">
							<?php
							for($x=0;	$x<5;	$x++){
								$judul = $related_data[$x]['judul'];
								$slug_s = explode(" ",$judul);
								$slug_s = $slug_s[0];
								$slugs = str_replace(array("'",",",".",":",";",'"',"'s","'t","!","#"),"",$slug_s);
								$slugs = strtolower(clean_character($slugs));
								if(strlen($slugs) < 4){
									$slugs = 'download';
								}
								echo '<li><a href="'.$site_url.'/'.$related_data[$x]['id'].'.'.slugify($related_data[$x]['judul']).'.html" title="'.$related_data[$x]['judul'].'" rel="bookmark" data-toggle="tooltip"><img class="book-cover" src="'.$related_data[$x]['gambar'].'" alt="'.$related_data[$x]['judul'].'" width="115" height="180" /></a></li>';
							}
							
							?>
							</ul>
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