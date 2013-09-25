<?php
/**
* @package WordPress
* @subpackage Sideways8: Skeleton
*/
?>
<!--<div class="one-third column omega" id="side">-->
<div class="offset-by-one four columns alpha" id="side"> 
<?php
if ( !function_exists('dynamic_sidebar')
	|| !dynamic_sidebar('Right SideBar') ) : ?>
<?php endif; ?>
</div>