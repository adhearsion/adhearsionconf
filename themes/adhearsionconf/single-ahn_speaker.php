<?php
/*
 * Template Name: Single Speaker Page
 */
get_header();
?>
<div class="content">

	<div class="two-thirds column">
		<div class="main"> 
			<article id="post-<?php the_ID(); ?>"<?php if (!is_front_page()) { echo ' class="subpage"'; } ?>>

			<?php 
				$image = get_field('image');
				$links = get_field('links');
				if (!($image == "" || $image == null || $image == false) || !($links == "" || $links == null || $links == false)) :
			?>
			<div class="image">
				<?php if (!($image == "" || $image == null || $image == false)) { ?>
				<img src="<?php echo $image; ?>" />

				<?php }
					if (!($links == "" || $links == null || $links == false)) {
						echo "<ul class=\"speaker-links\">";
						for($i = 0; $i < count($links); $i++) {
							$prepend = $links[$i]['prepend'];
							if (!($prepend == null || $prepend == "" || $prepend == false)) $prepend .= ": ";
							echo "<li>" . $prepend . "<a href=\"http://" . $links[$i]['link'] . "\">" . $links[$i]['text'] . "</a></li>";
						}
						echo "</ul>";
					}
				?>
			</div>
			<?php endif; // End if there are images or links. ?>
			<div class="title" >
				<h3><?php the_title(); ?></h3>
				<h4><?php echo get_field('title'); ?></h4>
				<div class="sessions">
					Sessions: 
					<?php
						$sessions = get_posts(array(
							'post_type' => 'ahn_event',
							'posts_per_page' => -1,
							'meta_query' => array (
								array(
									'key' => 'speaker',
									'value' => serialize(strval($post->ID)),
									'compare' => 'LIKE'
									)
								),
							'orderby' => 'meta_value_num',
							'order' => 'ASC',
							'meta_key' => 'datetime_start'
						));
						$previous_session = false;
						for ($i = 0; $i < count($sessions); $i++) {
							if ($previous_session) echo ", ";
							echo "<a href=\"" . get_permalink($sessions[$i]->ID) . "\">" . get_the_title($sessions[$i]->ID) . "</a>";
							$previous_session = true;
						}
					?>
				</div>
			</div>

			<?php
				$content = get_field('content');
				if ($content == '' || $content == null || $content == false) {
					echo get_field('bio');
				}  else {
					echo $content;
				}
			?>
</article>
</div>
</div>
</div>

<?php
get_template_part( 'sidebar', 'index' );
get_footer();
?>