			<div class="disclaimer">
				<div class="wrapper">
					<p class="text-muted" style="font-weight:normal"><?php echo $site_name;?> is in no way intended to support illegal activity. We uses Search API to find the overview of books over the internet, but we don't host any files. All document files are the property of their respective owners, please respect the publisher and the author for their copyrighted creations. If you find documents that should not be here please report them. Read our <span class="pointer" onclick="javascript:location.href='<?php echo $site_url;?>/dmca-notice'"><strong>DMCA Policies</strong></span> and <span class="pointer" onclick="javascript:location.href='<?php echo $site_url;?>/disclaimer'"><strong>Disclaimer</strong></span> for more details.</p>
				</div>
			</div>
			<nav class="navbar navbar-default">
				<div class="navbar-header">
					<span class="navbar-brand">Copyright &copy;<?php echo date('Y');?> <a href="<?php echo $site_url;?>"><?php echo $site_name;?></a> - All rights reserved.</span>
				</div>
				<div class="collapse navbar-collapse">
					<div class="nav navbar-nav navbar-right">
						<div class="btn-group btn-group-sm" role="group">
							<a href="<?php echo $site_url;?>/rss.xml" class="btn btn-default navbar-btn" data-toggle="tooltip" data-placement="top" title="RSS XML"><span class="fa fa-rss"></span></a>
							<a href="<?php echo $site_url;?>/index-sitemap.xml" class="btn btn-default navbar-btn" data-toggle="tooltip" data-placement="top" title="Sitemap XML"><span class="fa fa-sitemap"></span></a>
						</div>
					</div>
				</div>
			</nav>
        </footer>
	</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" defer></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js" defer></script>
<script>
function myFunction() {
    window.location= ("URL ADCENTER");
}

function ReadClick() {	var 	domain = $("#page").last().data("domain"),		title = $("h1.entry-title").last().data("title"),         bookid = $("article.book").attr('id');	window.location.href = "<?php echo $landing;?>"}


function adsClick() {	var	domain = $("#page").last().data("domain"),		title = "Free Download " + $("h1.entry-title").last().data("title") + " by " + $(".author").last().data("author");	window.location.href = "<?php echo $landing;?>"}
</script>
<?php include_once('histats.php');?>
