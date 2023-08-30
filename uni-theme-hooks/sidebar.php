<?php $has_sidebar = is_active_sidebar( 'sidebar' ); ?>
<aside>
	<?php
	if ( $has_sidebar ) {
		dynamic_sidebar( 'sidebar' );
	}
	?>
</aside>