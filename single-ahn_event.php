<?php
/*
 * Template Name: Single Event Page
 */
get_header();
?>
<div class="content">

	<div class="two-thirds column">
		<div class="main"> 
			<article id="post-<?php the_ID(); ?>"<?php if (!is_front_page()) { echo ' class="subpage"'; } ?>>
				<?php
					$datetime_start = get_field('datetime_start');
					$date = getdate(strtotime($datetime_start));
					$minutes = $date['minutes'];
					if ($minutes < 10) $minutes = '0' . $minutes;
					$starttime = $date['hours'] . ":" . $minutes;
					$endtime = get_field('time_end', $events[$i]->ID);
				?>
			<div class="title">
				<h3><?php the_title(); ?></h3>
				<h4 class="time"><?php echo $starttime; ?> - <?php echo $endtime; ?></h4>
				<h4 class="speakers">
					<?php 
						if (get_field('has_speaker')) :
							$speakers = get_field('speaker');
							$previous_speaker = false;
							for ($j = 0; $j < count($speakers); $j++) :
								if ($previous_speaker) echo ", ";
								echo "<a href=\"" . get_permalink($speakers[$j]->ID) . "\">" . get_the_title($speakers[$j]->ID) . "</a>";
								$previous_speaker = true;
							endfor;
						else:
							echo get_field('no_speaker');
						endif;
					?>
				</h4>
			</div>
			<?php if (get_field('has_content')) : ?>
			<div class="content">
				<?php echo get_field('content'); ?>
			</div>
			<?php endif; //End if(has_content) ?>
</article>
</div>
</div>
</div>

<?php
get_template_part( 'sidebar', 'index' );
get_footer();
?>