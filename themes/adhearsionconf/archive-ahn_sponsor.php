<?php
/*
 * Template Name: Sponsors Archive Page
 */
get_header();
?>
<div class="content">

	<div class="sixteen columns">
		<div class="main"> 
			<article id="post-<?php the_ID(); ?>"<?php if (!is_front_page()) { echo ' class="subpage"'; } ?>>
			<?php
				$core_sponsors = get_posts(array(
					'post_type' => 'ahn_sponsor',
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'order_by' => 'post_name',
					'cat' => get_cat_ID('Core')
				));
				$edge_sponsors = get_posts(array(
					'post_type' => 'ahn_sponsor',
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'order_by' => 'post_name',
					'cat' => get_cat_ID('Edge')
				));
				$network_element_sponsors = get_posts(array(
					'post_type' => 'ahn_sponsor',
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'order_by' => 'post_name',
					'cat' => get_cat_ID('Network Element')
				));
			?>
			<div class="title"><h3>2013 Sponsors</h3></div>
			<h3 class="sponsor-type">Core Sponsors</h3>
			<div class="main-sponsors">
				<?php if (count($core_sponsors) > 0) {
					echo "<table>";
					$previous_row = false;
					$high_count = 0;
					for ($i = 0; $i < count($core_sponsors); $i++) {
						if ($i % 3 == 0) {
							if ($previous_row) echo "</tr>";
							echo "<tr>";
							$high_count = 0;
						}
						echo "<td><a href=\"" . get_permalink($core_sponsors[$i]->ID) . "\"><img src=\"" . get_field('logo', $core_sponsors[$i]->ID) . "\" /></a></td>";
						$high_count++;
					}
					for ($i = (3 - $high_count); $i > 0; $i--) {
						echo "<td class=\"empty\"></td>";
					}
					echo "</tr></table>";
				} ?>
			</div>
			<h3 class="sponsor-type">Edge Sponsors</h3>
			<div class="main-sponsors">
				<?php if (count($edge_sponsors) > 0) {
					echo "<table>";
					$previous_row = false;
					$high_count = 0;
					for ($i = 0; $i < count($edge_sponsors); $i++) {
						if ($i % 3 == 0) {
							if ($previous_row) echo "</tr>";
							echo "<tr>";							
							$high_count = 0;
						}
						echo "<td><a href=\"" . get_permalink($edge_sponsors[$i]->ID) . "\"><img src=\"" . get_field('logo', $edge_sponsors[$i]->ID) . "\" /></a></td>";
						$high_count++;
					}
					for ($i = (3 - $high_count); $i > 0; $i--) {
						echo "<td class=\"empty\"></td>";
					}
					echo "</tr></table>";
				} ?>
			</div>
			<h3 class="sponsor-type">Network Element Sponsors</h3>
			<div class="main-sponsors">
				<?php if (count($network_element_sponsors) > 0) {
					echo "<table>";
					$previous_row = false;
					$high_count = 0;
					for ($i = 0; $i < count($network_element_sponsors); $i++) {
						if ($i % 3 == 0) {
							if ($previous_row) echo "</tr>";
							echo "<tr>";
							$high_count = 0;
						}
						echo "<td><a href=\"" . get_permalink($network_element_sponsors[$i]->ID) . "\"><img src=\"" . get_field('logo', $network_element_sponsors[$i]->ID) . "\" /></a></td>";
						$high_count++;
					}
					for ($i = (3 - $high_count); $i > 0; $i--) {
						echo "<td class=\"empty\"></td>";
					}
					echo "</tr></table>";
				} ?>
			</div>
			</article>
		</div>
	</div>
</div>

<?php
get_footer();
?>