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
	echo get_field('speakers_text');
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