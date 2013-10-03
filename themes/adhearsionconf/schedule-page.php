<?php
// Template Name: Schedule Page
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
$show_schedule = true;
if (get_field('status') == "waiting") {
	$show_schedule = false;
	// Dislay "Waiting" content.
	echo get_field('waiting');
} else if (get_field('status') == "tentative") {
	// Display "Tentative" content.
	echo get_field('tentative');
} else if (get_field('status') == "finalized") {
	// Display "Finalized" content.
	echo get_field('finalized');
}

if ($show_schedule) : 
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'ahn_event',
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'meta_key' => 'datetime_start',
		'post_status' => 'publish',
		'suppress_filters' => false
	);
	$events = get_posts($args);
	$weekday = null;
	$table_flag = false;

	for ($i = 0; $i < count($events); $i++) {
		$datetime_start = get_field('datetime_start', $events[$i]->ID);
		$date = getdate(strtotime($datetime_start));
		$minutes = $date['minutes'];
		if ($minutes < 10) $minutes = '0' . $minutes;
		$starttime = $date['hours'] . ":" . $minutes;
		$endtime = get_field('time_end', $events[$i]->ID);

		if ($weekday == null || $weekday != $date['weekday']) {
			if ($table_flag) {
				$table_flag = true; 
			} else {
				echo "</table>"; 
			}

			echo "<h3 class=\"newday\">" . $date['weekday'] . "</h3>";
			$weekday = $date['weekday']; 
			?>
			<table class="purple">
				<tr>
					<th>Time</th>
					<th>Session</th>
					<th>Speaker</th>
				</tr>
		<?php } ?>

		<tr class="event-row <?php echo ($i % 2 == 0) ? "even" : "odd" ?>">
			<td class="time"><?php echo $starttime . " - " . $endtime; ?></td>
			<td class="session">
				<?php if (get_field('has_content', $events[$i]->ID)) : ?>
					<a href="<?php echo get_permalink($events[$i]->ID); ?>"><?php echo $events[$i]->post_title; ?></a>
					<div><?php echo get_field('short_description', $events[$i]->ID); ?></div>
				<?php else : ?>
				<h4><?php echo $events[$i]->post_title; ?></h4>
				<?php endif; ?>
			</td>
			<td class="speaker">
				<?php 
					if (get_field('has_speaker', $events[$i]->ID)) :
						$speakers = get_field('speaker', $events[$i]->ID);
						$previous_speaker = false;
						for ($j = 0; $j < count($speakers); $j++) :
							if ($previous_speaker) echo ", ";
							echo "<a href=\"" . get_permalink($speakers[$j]->ID) . "\">" . get_the_title($speakers[$j]->ID) . "</a>";
							$previous_speaker = true;
						endfor;
					else:
						echo get_field('no_speaker', $events[$i]->ID);
					endif;
				?>
			</td>
		</tr>
		<?php 
		//echo $date['weekday'] . ", " . $date['month'] . " " . $date['mday'] . "<br/>";
	} ?>
<?php endif; // End if($show_schedule). ?>
</table>
</article>
</div>
</div>
</div>

<?php
get_template_part( 'sidebar', 'index' );
get_footer();
?>