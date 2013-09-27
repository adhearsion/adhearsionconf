<?php get_header(); ?>

<div class="content">

	<div class="two-thirds column">
		<div class="main"> 

		<?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
						
		<article id="post-<?php the_ID(); ?>"<?php if (!is_front_page()) { echo ' class="subpage"'; } ?>>
			<div class="title">
				<?php the_title('<h3>', '</h3>'); ?>
			</div>

			<?php the_content("Continue reading " . the_title('', '', false)); ?> <!--The Content-->




	<?php
	/* mPress calendar */
	$events_number = 5;

	if( $events = s8_get_current_events( $events_number ) ) {
		foreach( $events as $event ) { ?>
			<div class="mpress-wrapper">
				<div class="mpress-title">
					<a href="<?php echo get_permalink($event->ID); ?>"><?php echo $event->post_title; ?></a>
				</div>
				<div class="mpress-excerpt">
					<?php
					$attr = array('class'	=> "attachment-$size alignleft mpress-icon");
					echo get_the_post_thumbnail($event->ID, 'mpress-icon', $attr);
	
					echo s8_get_the_excerpt($event->ID);
					?>
				</div>				
				<div class="mpress-date">
					<?php
					$start_time = s8_get_event_timestamp($event->ID);
					$end_time = s8_get_event_end_timestamp($event->ID);
					$start_day = date( 'F j', s8_get_event_timestamp($event->ID));
					$end_day = date( 'F j', s8_get_event_end_timestamp($event->ID));

					echo date( 'F j', s8_get_event_timestamp($event->ID));

					if (
						($start_day != $end_day) &&
						($start_time < $end_time)
						) {		
						echo ' - ';
						echo date( 'F j h a', s8_get_event_end_timestamp($event->ID));
					}
					?>
				</div>
			</div><!-- sb-opp-wrapper --><?php
		}
	}
	?>




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

<?php get_template_part( 'sidebar', 'index' ); ?>
<?php get_footer(); ?>