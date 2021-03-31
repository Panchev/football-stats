<?php
Carbon_Breadcrumb_Trail::output(array(
	'glue' => '',
	'link_before' => '',
	'link_after' => '',
	'wrapper_before' => '<div class="section__bar"><div class="shell"><div class="breadcrumbs">',
	'wrapper_after' => '</div></div></div>',
	'title_before' => '',
	'title_after' => '',
	'min_items' => 2,
	'last_item_link' => false,
	'display_home_item' => true,
	'home_item_title' => __('Home', 'crb'),
	'renderer' => 'Carbon_Breadcrumb_Trail_Renderer',
));
