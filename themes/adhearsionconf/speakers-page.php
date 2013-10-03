<?php
/*
 * Template Name: Speakers Page
 */
get_header();
?>
<div class="content">

	<div class="two-thirds column">
		<div class="main"> 
			<article id="post-<?php the_ID(); ?>"<?php if (!is_front_page()) { echo ' class="subpage"'; } ?>>
			<div class="title">
				<h3><?php the_title(); ?></h3>
			</div>
<?php
if (get_field('status') == "cfp") {
	// Dislay "Call For Papers" content.
	echo get_field('call_for_papers');
} else if (get_field('status') == "closed") {
	// Display "Submissions Closed" content.
	echo get_field('submissions_closed');
} else if (get_field('status') == "speakers") {
	// Display "Speakers Text" content and list speakers out below.
	echo get_field('speakers_text'); ?>
	<table class="purple">
		<tr>
			<th>Name</th>
			<th>Bio</th>
			<th>Sessions</th>
		</tr>
		<?php
			$speakers = get_field('speakers');
			for ($i = 0; $i < count($speakers); $i++) : ?>
				<tr class="speaker-row <?php echo ($i % 2 == 0) ? "even" : "odd"; ?>">
					<td><a href="<?php echo get_permalink($speakers[$i]['speaker']->ID); ?>"><?php echo $speakers[$i]['speaker']->post_title; ?></a></td>
					<td class="bio"><?php echo get_field('bio', $speakers[$i]['speaker']->ID); ?></td>
					<td>
						<?php
							$sessions = get_posts(array(
								'post_type' => 'ahn_event',
								'posts_per_page' => -1,
								'meta_query' => array (
									array(
										'key' => 'speaker',
										'value' => serialize(strval($speakers[$i]['speaker']->ID)),
										'compare' => 'LIKE'
										)
									),
								'orderby' => 'meta_value_num',
								'order' => 'ASC',
								'meta_key' => 'datetime_start'
							));
							$previous_session = false;
							for ($j = 0; $j < count($sessions); $j++) {
								if ($previous_session) echo ", ";
								echo "<a href=\"" . get_permalink($sessions[$j]->ID) . "\">" . get_the_title($sessions[$j]->ID) . "</a>";
								$previous_session = true;
							}
						?>
					</td>
				</tr>
			<?php endfor; ?>
		</table>
<?php } // End status == speakers ?>
</article>
</div>
</div>
</div>

<?php
get_template_part( 'sidebar', 'index' );
get_footer();
?>