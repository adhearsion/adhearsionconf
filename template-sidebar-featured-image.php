<?php
/*
Template Name: Featured Image on Sidebar
*/
?>
<?php get_header(); ?>

<div class="four columns alpha" id="side">
	<div class="sidebar">
		<p class="address"><?php if ($tmp = of_get_option('address1', '')) { echo $tmp; } ?></p>
		<p class="address"><?php if ($tmp = of_get_option('address2', '')) { echo $tmp; } ?></p>
	</div>

	<div class="four columns alpha" id="featured-image-sidebar">
		<?php global $post; ?>
		<?php echo get_the_post_thumbnail( $post->ID, 'sidebar-custom'); ?>
	</div>
</div><!--#side-->

<div class="content">
	<div class="twelve columns omega">

		<div class="main"> 

		<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>"<?php if (!is_front_page()) { echo ' class="subpage"'; } ?>>
			<div class="title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title('<h3>', '</h3>'); ?></a>
			</div>

			<?php the_content("Continue reading " . the_title('', '', false)); ?> <!--The Content-->

		</article>

		<?php endwhile; ?><!--  End the Loop -->

		</div><!--main-->

	</div><!-- twelve columns omega -->
</div><!--content-->

<?php get_footer(); ?>                        
          