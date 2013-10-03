<?php
/**
* @package WordPress
* @subpackage Sideways8: Skeleton
*/
?>
<!--<div class="one-third column omega" id="side">-->
<div class="offset-by-one four columns alpha" id="side"> 
	<?php
		$core_sponsors = get_field('core_sponsors_side', 'options');
		$edge_sponsors = get_field('edge_sponsors_side', 'options');
		$network_element_sponsors = get_field('network_element_sponsors_side', 'options');
		if (get_field('link_to', 'options') == "internal") {
			$external_link = false;
		} else {
			$external_link = true;
		}
	?>
	<div class="sponsors">
		<h3>Core Sponsors</h3>
		<?php 
			for($i = 0; $i < count($core_sponsors); $i++) {
				if ($external_link) {
					$link = "http://" . get_field('site', $core_sponsors[$i]['sponsor']->ID);
				} else {
					$link = get_permalink($core_sponsors[$i]['sponsor']->ID);
				}
				echo "<div class=\"sponsor\"><a href=\"" . $link . "\"><img src=\"" . get_field('logo', $core_sponsors[$i]['sponsor']->ID) . "\" /></a></div>";
			}
		?>
	</div>
	<div class="sponsors">
		<h3>Edge Sponsors</h3>
		<?php 
			for($i = 0; $i < count($edge_sponsors); $i++) {
				if ($external_link) {
					$link = "http://" . get_field('site', $edge_sponsors[$i]['sponsor']->ID);
				} else {
					$link = get_permalink($edge_sponsors[$i]['sponsor']->ID);
				}
				echo "<div class=\"sponsor\"><a href=\"" . $link . "\"><img src=\"" . get_field('logo', $edge_sponsors[$i]['sponsor']->ID) . "\" /></a></div>";
			}
		?>
	</div>
	<div class="sponsors">
		<h3>Network Element Sponsors</h3>
		<?php 
			for($i = 0; $i < count($network_element_sponsors); $i++) {
				if ($external_link) {
					$link = "http://" . get_field('site', $network_element_sponsors[$i]['sponsor']->ID);
				} else {
					$link = get_permalink($network_element_sponsors[$i]['sponsor']->ID);
				}
				echo "<div class=\"sponsor\"><a href=\"" . $link . "\"><img src=\"" . get_field('logo', $network_element_sponsors[$i]['sponsor']->ID) . "\" /></a></div>";
			}
		?>
	</div>
	<div class="sponsors">
		<a href="<?php echo get_field('advertise_page', 'options'); ?>"><?php echo get_field('advertise_link_text', 'options'); ?></a>
	</div>
</div>