<?php 
/**
 * @package WordPress
 * @subpackage Sideways8: Skeleton
 */
?>

<div class="content">

	<div class="two-thirds column">
		<div class="main"> 
				<?php 
					if(is_front_page()) { 
						$images = get_field('images',$post->ID); 
						if (!($images == "" || $images == null || $images == false)) {
							// display the slider! :D
							?>
							<div id="carousel" class="carousel slide">
								<ol class="carousel-indicators">
									<?php
										for ($i = 0; $i < count($images); $i++) {
											$html =  "<li data-target=\"#carousel\" data-slide-to=\"" . $i . "\"";
											if ($i == 0) {
												$html .= " class=\"active\">";
											} else {
												$html .= ">";
											}
											echo $html . "</li>";
										}
									?>
								</ol>
								<div class="carousel-inner">
									<?php for ($i = 0; $i < count($images); $i++) {
										$html = "<div class=\"";
										if ($i == 0) { $html .= "active "; }
										$html .= "item\"><img src=\"" . $images[$i]['image'] . "\" />";
										$title = $images[$i]['title'];
										$text = $images[$i]['text'];
										if (!($title == null || $title == "" || $title == false) || !($text == null || $text == "" || $text == false)) {
											$html .= "<div class=\"carousel-caption\">";
											if (!($title == null || $title == "" || $title == false)) { $html .= "<h4>" . $images[$i]['title'] . "</h4>"; }
											if (!($text == null || $text == "" || $text == false)) { $html .= "<p>" . $images[$i]['text'] . "</p>"; }
											$html .= "</div>";
										}
										echo $html . "</div>";
									} ?>
								</div>
								<a class="carousel-control left" href="#carousel" data-slide="prev">&lsaquo;</a>
								<a class="carousel-control right" href="#carousel" data-slide="next">&rsaquo;</a>
							</div>
							<script type="text/javascript">
							  jQuery(document).ready(function() {
							    jQuery('#carousel').carousel({
							      interval: 5000
							    })
							  });
							</script>
					<?php }
					?>

				<?php } ?>

		<?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
						
		<article id="post-<?php the_ID(); ?>"<?php if (!is_front_page()) { echo ' class="subpage"'; } ?>>
			<?php if (!is_front_page()) { ?>	
				<div class="title">
				<?php the_title('<h3>', '</h3>'); ?>
				</div>
			<?php } ?>
			<?php the_content("Continue reading " . the_title('', '', false)); ?> <!--The Content-->

			<!--
			  <div class="meta"> 
					Date posted: <?php echo get_the_date(); ?>
					| Author: <?php the_author_posts_link(); ?>
					| <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
				  <p>Categories: <?php the_category(' '); ?></p>
			  </div>
			-->
		</article>

		<?php endwhile; ?>

		<?php /* Display navigation to next/previous pages when applicable */ ?>

		<?php if (  $wp_query->max_num_pages > 1 ) : ?>
		<nav id="nav-below">
			<hr>
			<div class="nav-previous"><?php next_posts_link(); ?></div>
			<div class="nav-next"><?php previous_posts_link(); ?></div>
		</nav><!--nav-below-->
		<?php endif; ?>

		<?php // if(is_page() || is_single()) : comments_template( '', true ); endif; ?>

		</div><!--main-->

	</div><!-- nine columns offset-by-one alpha -->

</div><!--content-->
