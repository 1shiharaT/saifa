<?php
/**
 * Header Minimal Version
 * =====================================================
 * @package  Saifa
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */
?>

		<header id="masthead" class="header header-minimal" role="banner">
			<div class="header-description text-center">
				<div class="container">
					<div class="grid-lg-8">
						<p><?php bloginfo( 'description' ) ?></p>
					</div>
					<div class="grid-lg-4 header-search">
						<form role="form" action="<?php echo site_url( '/' ); ?>" class="searchform" method="get">
							<div class="search-bar">
								<div class="search-and-submit">
									<input type="search" name="s" id="s" placeholder="<?php _e( 'Enter Search', 'saifa' ); ?>" />
									<button type="submit">
										<img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/search-icon.png" alt="Search Icon">
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="container">
				<h1 class="header-logo">
					<a href="<?php echo home_url(); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<div class="header-banner">
					<?php
					if ( ! dynamic_sidebar( 'header-primary' ) ) { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/dammy-banner728×90.png" alt="Demo Image">
					<?php
					}; ?>
				</div>
			</div>
			<?php
			do_action( 'get_header' );
			?>
		</header>

		<?php
		get_template_part( 'modules/navbar' ); ?>
