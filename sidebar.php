				<aside id="genre" class="widget">
					<h3 class="widget-title ell">Browse by Genre</h3>
					<ul class="genre-list col2">
					<?php
						$array_cat = array('Art','Biography','Business','Chick Lit','Childrens','Christian','Classics','Comics','Contemporary','Cookbooks','Crime','Ebooks','Fantasy','Fiction','Graphic Novels','Historical Fiction','History','Horror','Memoir','Music','Mystery','Non Fiction','Paranormal','Philosophy','Poetry','Psychology','Religion','Romance','Science','Science Fiction','Self Help','Suspense','Spirituality','Sports','Thriller','Travel','Young Adult');
						foreach($array_cat as $array){
							echo '<li><a href="'.$cat_slug.slugify($array).'" rel="tag">'.$array.'</a></li>';
						}
					?>
					</ul>
				</aside>
				<aside id="helper" class="widget">
					<div class="list-group">
						<a class="list-group-item" href="<?php echo $site_url; ?>"><span class="glyphicon glyphicon-home"></span> Homepage</a>
						<a class="list-group-item" href="<?php echo $site_url; ?>/privacy-policy" rel="nofollow"><span class="glyphicon glyphicon-eye-open"></span> Privacy Policy</a>
						<a class="list-group-item" href="<?php echo $site_url; ?>/dmca-notice" rel="nofollow"><span class="glyphicon glyphicon-flag"></span> DMCA Policy</a>
						<a class="list-group-item" href="<?php echo $site_url; ?>/disclaimer" rel="nofollow"><span class="glyphicon glyphicon-warning-sign"></span> Disclaimer</a>
						<a class="list-group-item" href="<?php echo $site_url; ?>/faq" rel="nofollow"><span class="glyphicon glyphicon-question-sign"></span> Frequently Asked Questions</a>
						<a class="list-group-item" href="<?php echo $site_url; ?>/contact-us" rel="nofollow"><span class="glyphicon glyphicon-envelope"></span> Contact</a>
					</div>
				</aside>
				<?php
				if(isset($id_buku) && !empty($about_author)){
					echo '
					<aside id="about-author" class="widget">
						<h3 class="widget-title ell">About the author</h3>
						<div class="widget-content">';
					if(!empty($gambar_author)){
						echo'<img class="author-photo" src="'.$gambar_author.'" alt="'.$penulis.'" width="50" height="80" />';
					}
					echo'		<p><strong>'.$penulis.'</strong> - '.$about_author.'...</p>
							<div class="clear"></div>
						</div>
					</aside>';
				}
				
				
				?>
				