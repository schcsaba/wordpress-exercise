<?php

function cr_number_pagination() {
	global $wp_query;
	$big = 9999999;
	echo paginate_links(
		[
			'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'  => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total'   => $wp_query->max_num_pages,
			'prev_text' => __('Page précédente', 'cefimrecettes'),
			'next_text' => __('Page suivante', 'cefimrecettes')
		]
	);
}