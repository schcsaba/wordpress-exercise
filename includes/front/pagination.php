<?php

function cr_number_pagination($search = []) {
	if ($search) {
		$total = $search->max_num_pages;
	} else {
		global $wp_query;
		$total = $wp_query->max_num_pages;
	}
	$big = 9999999;
	echo '<nav class="pagination">' . paginate_links(
			[
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => max( 1, get_query_var( 'paged' ) ),
				'total'     => $total,
				'prev_text' => __( 'Page précédente', 'cefimrecettes' ),
				'next_text' => __( 'Page suivante', 'cefimrecettes' )
			]
		) . '</nav>';
}
