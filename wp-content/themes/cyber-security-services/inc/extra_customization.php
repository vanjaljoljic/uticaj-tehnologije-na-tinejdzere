<?php

	/*---------------------------Width -------------------*/

	$cyber_security_services_custom_style= "";

	$cyber_security_services_theme_width = get_theme_mod( 'cyber_security_services_width_options','full_width');

    if($cyber_security_services_theme_width == 'full_width'){

		$cyber_security_services_custom_style .='body{';

			$cyber_security_services_custom_style .='max-width: 100%;';

		$cyber_security_services_custom_style .='}';

	}else if($cyber_security_services_theme_width == 'Container'){

		$cyber_security_services_custom_style .='body{';

			$cyber_security_services_custom_style .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';

		$cyber_security_services_custom_style .='}';

	}else if($cyber_security_services_theme_width == 'container_fluid'){

		$cyber_security_services_custom_style .='body{';

			$cyber_security_services_custom_style .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';

		$cyber_security_services_custom_style .='}';
	}

	/*---------------------------Scroll-top-position -------------------*/

	$cyber_security_services_scroll_options = get_theme_mod( 'cyber_security_services_scroll_options','right_align');

    if($cyber_security_services_scroll_options == 'right_align'){

		$cyber_security_services_custom_style .='.scroll-top button{';

			$cyber_security_services_custom_style .='';

		$cyber_security_services_custom_style .='}';

	}else if($cyber_security_services_scroll_options == 'center_align'){

		$cyber_security_services_custom_style .='.scroll-top button{';

			$cyber_security_services_custom_style .='right: 0; left:0; margin: 0 auto; top:85% !important';

		$cyber_security_services_custom_style .='}';

	}else if($cyber_security_services_scroll_options == 'left_align'){

		$cyber_security_services_custom_style .='.scroll-top button{';

			$cyber_security_services_custom_style .='right: auto; left:5%; margin: 0 auto';

		$cyber_security_services_custom_style .='}';
	}

	//---------------------------------------sticky---------------------------------------------------//

	$cyber_security_services_sticky_header = get_theme_mod('cyber_security_services_sticky_header');

$cyber_security_services_custom_style= "";

if($cyber_security_services_sticky_header != true){

	$cyber_security_services_custom_style .='.menubarr.fixed{';

		$cyber_security_services_custom_style .='position: static !important;';

	$cyber_security_services_custom_style .='}';
}

$cyber_security_services_logo_max_height = get_theme_mod('cyber_security_services_logo_max_height');

	if($cyber_security_services_logo_max_height != false){

		$cyber_security_services_custom_style .='.custom-logo-link img{';

			$cyber_security_services_custom_style .='max-height: '.esc_html($cyber_security_services_logo_max_height).'px;';

		$cyber_security_services_custom_style .='}';
	}
