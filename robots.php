<?php
error_reporting(0);
include 'inc/connect.php';
/* ==> Generating Robots.txt starts HERE <== */
header("Content-Type:text/plain");
$array = array('User-agent: *','Sitemap: '.$site_url.'/'.$sitemap_index,'Disallow: /privacy-policy','Disallow: /dmca-notice', 'Disallow: /contact-us', 'Disallow: /disclaimer', 'Disallow: /faq');$arrayss = implode("\n",$array);echo $arrayss;
?>