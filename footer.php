<?php
/**
* @package WordPress
* @subpackage Sideways8: Skeleton
*/
?>
</div><!-- container -->
</div><!-- container-wrapper -->

<div class="container-wrapper footer-bg">
	<div class="container">

		<div class="clear"></div>

		<div class="footer">
			<div class="sixteen columns">

				<div class="four columns alpha">
					<h2>Adhearsion</h2>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-1' ) ); ?>
				</div>

				<div class="eight columns">
					<h2>Latest Tweets</h2>
					<?php echo do_shortcode('[kebo_tweets]'); ?>
				</div>

				<div class="four columns omega">
					<h2>Get Social &amp; Such</h2>
					<ul class='social'>
					              <li>
					                <a class='github' href='<?php echo of_get_option('github_link', ''); ?>'>Github</a>
					              </li>
					              <li class='last'>
					                <a class='vimeo' href='<?php echo of_get_option('vimeo_link', ''); ?>'>Vimeo</a>
					              </li>
					              <li>
					                <a class='twitter' href='<?php echo of_get_option('twitter_link', ''); ?>'>Twitter</a>
					              </li>
					              <li class='last'>
					                <a class='slideshare' href='<?php echo of_get_option('slideshare_link', ''); ?>'>Slideshare</a>
					              </li>
					              <li>
					                <a class='google-groups' href='<?php echo of_get_option('mailing_list_link', ''); ?>'>Mailing List</a>
					              </li>
					              <li class='last'>
					                <a class='rss' href='<?php echo of_get_option('rss_link', ''); ?>'>RSS</a>
					              </li>
					            </ul>
					            <div class='clear'></div>
				</div>

			</div><!--sixteen columns-->
		</div><!--footer-->
	</div><!-- container -->
</div><!-- container-wrapper -->
<div class="container-wrapper footer-small">
	<div class="container">
		<div class="sixteen columns">
			<div id="copyright">
			<?php
				$start_year = of_get_option('footer_copyright_year', '');
				$current_year = date("Y");
				$footer_copyright = of_get_option('footer_copyright', '');
				if ( ($current_year > $start_year) && ($start_year != NULL) ) {
					echo $start_year . '-';
				}
					print "$current_year ";
					echo $footer_copyright;
			?>
			</div><!--copyright-->
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
