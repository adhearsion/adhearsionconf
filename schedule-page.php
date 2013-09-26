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
	for ($i = 0; $i < count($events); $i++) {
		/$/date = DateTime::createFromFormat('m/d/y h:m tt', get_field('datetime_start', $events[$i]->ID));
		echo get_field('datetime_start', $events[$i]->ID) . "<br/>";
		echo $date['weekday'] . ", " . $date['month'] . " " . $date['mday'] . "<br/>";
	}
	?>
<?php endif; // End if($show_schedule). ?>

</article>
</div>
</div>
</div>

<?php
get_template_part( 'sidebar', 'index' );
get_footer();
?>