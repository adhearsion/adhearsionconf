<?php
/*
 * Template Name: Single Sponsor Page
 */
get_header();
?>
<div class="content">

	<div class="two-thirds column">
		<div class="main"> 
			<article id="post-<?php the_ID(); ?>"<?php if (!is_front_page()) { echo ' class="subpage"'; } ?>>
			<?php 
				if (!(get_field('logo') == "" || get_field('logo') == null || get_field('logo') == false) || !(get_field('links') == "" || get_field('links') == null || get_field('links') == false)) {
					echo "<div class=\"image\">";

					if (!(get_field('logo') == "" || get_field('logo') == null || get_field('logo') == false)) {
						echo "<img src=\"" . get_field('logo') . "\" />";
					}

					if (!(get_field('links') == "" || get_field('links') == null || get_field('links') == false)) {
						echo "<ul class=\"speaker-links\">";
						$links = get_field('links');
						for($i = 0; $i < count($links); $i++) {
							$prepend = $links[$i]['prepend'];
							if (!($prepend == null || $prepend == "" || $prepend == false)) $prepend .= ": ";
							echo "<li>" . $prepend . "<a href=\"http://" . $links[$i]['link'] . "\">" . $links[$i]['text'] . "</a></li>";
						}
						echo "</ul>";
					}

					echo "</div>";
				}
			?>
			<div class="title">
				<h3><?php echo $post->post_title; ?></h3>
				<?php 
					$group = get_the_category(); 
				?>
				<h4>2013 <?php echo $group[0]->name; ?> Sponsor</h4> 
			</div>
			<?php echo get_field('content'); ?>
</article>
</div>
</div>
</div>

<?php
get_template_part( 'sidebar', 'index' );
get_footer();
?>