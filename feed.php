<?php
include 'inc/function.php';
include 'inc/connect.php';
include 'inc/simple_html_dom.php';

header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="ISO-8859-1" ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:media="http://search.yahoo.com/mrss/" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>'.$site_title.'</title>
		<link>'.$site_url.'</link>
		<description>'.$site_desc.'</description>
		<language>en-us</language>
		<atom:link href="'.$site_url.'/rss.xml" rel="self" type="application/rss+xml" />';
	
$url = 'http://www.goodreads.com/genres';								//ada 20 item
$load = baca($url);
$html = str_get_html($load);
foreach($html->find('div.leftAlignedImage') as $posts){
	$id = cutter($posts,'<a href="/book/show/','-');
	
	if(strlen($id)>10){
		$id = cutter($posts,'<a href="/book/show/','.');
		
	}
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
	$desc = clean_character(cutter($posts,'style=\"display:none\">','<\/span>'));
	$desc = str_replace(array('\n',"\'"),array(' ',"'"),$desc);
	$desc = substr($desc,0,400);
	$link = slugify($judul);
	if($link != 'n-a' && !empty($judul)){
		echo '
		<item>
			<title>'.$judul.'</title>
			<description><![CDATA[<p><a href="'.$site_url.'/'.$id.'.'.$link.'.html"><img src="'.$image.'" width="115" height="180" alt="'.$judul.'" /></a>'.$desc.'</p>]]></description>
			<link>'.$site_url.'/'.$id.'.'.$link.'.html</link>
			<guid>'.$site_url.'/'.$id.'.'.$link.'.html</guid>
		</item>';
	}
}
echo '</channel>
</rss>';

?>