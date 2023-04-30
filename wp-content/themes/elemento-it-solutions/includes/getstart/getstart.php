<?php
//about theme info
add_action( 'admin_menu', 'elemento_it_solutions_gettingstarted' );
function elemento_it_solutions_gettingstarted() {
	add_theme_page( esc_html__('Elemento IT Solutions', 'elemento-it-solutions'), esc_html__('Elemento IT Solutions', 'elemento-it-solutions'), 'edit_theme_options', 'elemento_it_solutions_about', 'elemento_it_solutions_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function elemento_it_solutions_admin_theme_style() {
	wp_enqueue_style('elemento-it-solutions-custom-admin-style', get_template_directory_uri() . '/includes/getstart/getstart.css');
	wp_enqueue_script('elemento-it-solutions-tabs', get_template_directory_uri() . '/includes/getstart/js/tab.js');
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css' );
}
add_action('admin_enqueue_scripts', 'elemento_it_solutions_admin_theme_style');

//guidline for about theme
function elemento_it_solutions_mostrar_guide() { 
	//custom function about theme customizer
	$elemento_it_solutions_return = add_query_arg( array()) ;
	$elemento_it_solutions_theme = wp_get_theme( 'elemento-it-solutions' );
?>

    <div class="top-head">
		<div class="top-title">
			<h2><?php esc_html_e( 'Elemento IT Solutions', 'elemento-it-solutions' ); ?></h2>
		</div>
		<div class="top-right">
			<span class="version"><?php esc_html_e( 'Version', 'elemento-it-solutions' ); ?>: <?php echo esc_html($elemento_it_solutions_theme['Version']);?></span>
		</div>
    </div>

    <div class="inner-cont">

	    <div class="tab-sec">
	    	<div class="tab">
				<button class="tablinks" onclick="elemento_it_solutions_open_tab(event, 'setup_customizer')"><?php esc_html_e( 'Setup With Customizer', 'elemento-it-solutions' ); ?></button>
				<button class="tablinks" onclick="elemento_it_solutions_open_tab(event, 'changelog_cont')"><?php esc_html_e( 'Changelog', 'elemento-it-solutions' ); ?></button>
				<button class="tablinks" onclick="elemento_it_solutions_open_tab(event, 'getting_started')"><?php esc_html_e( 'Getting Started', 'elemento-it-solutions' ); ?></button>
			</div>

			<div id="setup_customizer" class="tabcontent open">
				<div class="tab-outer-box">
				  	<div class="lite-theme-inner">
						<h3><?php esc_html_e('Theme Customizer', 'elemento-it-solutions'); ?></h3>
						<p><?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'elemento-it-solutions'); ?></p>
						<div class="info-link">
							<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'elemento-it-solutions'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Help Docs', 'elemento-it-solutions'); ?></h3>
						<p><?php esc_html_e('The complete procedure to configure and manage a WordPress Website from the beginning is shown in this documentation .', 'elemento-it-solutions'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( ELEMENTO_IT_SOLUTIONS_FREE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'elemento-it-solutions'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Need Support?', 'elemento-it-solutions'); ?></h3>
						<p><?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'elemento-it-solutions'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( ELEMENTO_IT_SOLUTIONS_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'elemento-it-solutions'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Reviews & Testimonials', 'elemento-it-solutions'); ?></h3>
						<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'elemento-it-solutions'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( ELEMENTO_IT_SOLUTIONS_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'elemento-it-solutions'); ?></a>
						</div>
						<hr>
						<div class="link-customizer">
							<h3><?php esc_html_e( 'Link to customizer', 'elemento-it-solutions' ); ?></h3>
							<div class="first-row">
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','elemento-it-solutions'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','elemento-it-solutions'); ?></a>
									</div>
								</div>
							
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=header_image') ); ?>" target="_blank"><?php esc_html_e('Header Image','elemento-it-solutions'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','elemento-it-solutions'); ?></a>
									</div>
								</div>
							</div>
						</div>
				  	</div>
				</div>
			</div>

			<div id="changelog_cont" class="tabcontent">
				<div class="tab-outer-box">
					<textarea name="banner" cols="80" rows="20">
						<?php echo file_get_contents( ELEMENTO_IT_SOLUTIONS_CHANGELOG_THEME_URL ); ?>
					</textarea>
				</div>
			</div>

			<div id="getting_started" class="tabcontent">
				<div class="tab-outer-box">
					<h2><?php esc_html_e( 'Welcome to Elemento Theme!', 'elemento-it-solutions' ); ?></h2>
					<p><?php esc_html_e( 'For setup the theme, First you need to click on the Begin activating plugins', 'elemento-it-solutions' ); ?></p>
					<p><?php esc_html_e( '1. Install Kirki Customizer Framework ', 'elemento-it-solutions' ); ?></p>
					<p><?php esc_html_e( '>> Then click to Return to Required Plugins Installer ', 'elemento-it-solutions' ); ?></p>
					<p><?php esc_html_e( '2. Install WPElemento Importer', 'elemento-it-solutions' ); ?></p>
					<p><?php esc_html_e( '>> Then click to Return to Required Plugins Installer ', 'elemento-it-solutions' ); ?></p>
					<p><?php esc_html_e( '3. Activate Kirki Customizer Framework ', 'elemento-it-solutions' ); ?></p>
					<p><?php esc_html_e( '4. Activate WPElemento Importer ', 'elemento-it-solutions' ); ?></p>
					<p><?php esc_html_e( '>> Then click to Return to the Dashboard', 'elemento-it-solutions' ); ?></p>
					<p><?php esc_html_e( '>> Click on the start now button', 'elemento-it-solutions' ); ?></p>
					<p><?php esc_html_e( '>> Click install plugins', 'elemento-it-solutions' ); ?></p>
					<p><?php esc_html_e( '>> Click import demo button to setup the theme and click visit your site button', 'elemento-it-solutions' ); ?></p>
				</div>
			</div>

		</div>

		<div class="inner-side-content">
			<h2><?php esc_html_e('Premium Theme', 'elemento-it-solutions'); ?></h2>
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" alt="" />
			<h3><?php esc_html_e('IT Solutions WordPress Theme', 'elemento-it-solutions'); ?></h3>
			<div class="iner-sidebar-pro-btn">
				<span class="premium-btn"><a href="<?php echo esc_url( ELEMENTO_IT_SOLUTIONS_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'elemento-it-solutions'); ?></a>
				</span>
				<span class="demo-btn"><a href="<?php echo esc_url( ELEMENTO_IT_SOLUTIONS_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'elemento-it-solutions'); ?></a>
				</span>
				<span class="doc-btn"><a href="<?php echo esc_url( ELEMENTO_IT_SOLUTIONS_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Doc', 'elemento-it-solutions'); ?></a>
				</span>
			</div>

			<div class="premium-features">
				<h3><?php esc_html_e('premium Features', 'elemento-it-solutions'); ?></h3>
				<ul>
					<li><?php esc_html_e( 'Multilingual', 'elemento-it-solutions' ); ?></li>
					<li><?php esc_html_e( 'Drag and drop features', 'elemento-it-solutions' ); ?></li>
					<li><?php esc_html_e( 'Zero Coding Required', 'elemento-it-solutions' ); ?></li>
					<li><?php esc_html_e( 'Mobile Friendly Layout', 'elemento-it-solutions' ); ?></li>
					<li><?php esc_html_e( 'Responsive Layout', 'elemento-it-solutions' ); ?></li>
					<li><?php esc_html_e( 'Unique Designs', 'elemento-it-solutions' ); ?></li>
				</ul>
			</div>
		</div>
	</div>

<?php } ?>

