<?php
/**
 * search form module
 * =====================================================
 * @package  Saifa
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */
?>

<form role="form" action="<?php echo site_url( '/' ); ?>" class="searchform" method="get">
	<label for="s" class="sr-only"><?php _e( 'Search', 'saifa' ); ?></label>
	<div class="input-group">
		<input type="text" class="form-control" id="s" name="s" placeholder="<?php _e( 'Search', 'saifa' ); ?>" value="" />
		<span class="input-group-btn">
			<button type="submit" class="btn"><?php _e( 'Submit', 'saifa' ); ?> </button>
		</span>
	</div> <!-- .input-group -->
</form>
