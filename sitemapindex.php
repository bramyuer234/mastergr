<?php
error_reporting(0);
include 'inc/simple_html_dom.php';
include 'inc/function.php';
include 'inc/connect.php';

// echo $today.'<br/>';
// echo $total.'<br/>';

$jmlh_file = 500;
date_default_timezone_set($timezone);
header('Content-Type: text/xml');
header('X-Robots-Tag: noarchive,notranslate,noodp', true);
echo '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="'.$site_url.'/inc/css-sitemap-index.xsl"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';


for($x=1; $x<=$jmlh_file; $x++){
  $file = $sitemap_single.$x;
  $today = randomDate($start_date, $end_date);
  echo '
  <sitemap>
    <loc>'.$site_url.'/sitemap-'.$file.'.xml</loc>
    <lastmod>'.date('c').'</lastmod>
  </sitemap>
  ';
}
echo '</sitemapindex>';



?>