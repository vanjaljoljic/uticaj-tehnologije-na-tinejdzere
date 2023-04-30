/**
 * Theme Customizer enhancements for a better user experience.
 *
 * @package Pen
 */

;( function( $ ) {

	wp.customize.bind(
		'ready',
		function() {

			var $controls = $( '#customize-controls' ),
	  		pen_customize_url_home = pen_customize_js.url_start ? pen_customize_js.url_start : wp.customize.settings.url.home;
			if ( pen_customize_js.preset_preview ) {
				pen_customize_url_home += ( pen_customize_url_home.split( '?' )[1] ? '&' : '?' ) + 'pen_preview_color=' + pen_customize_js.preset_color + '&pen_preview_font=' + pen_customize_js.preset_font;
				/*
				 * If the user wanted to save the preset there has to be no need to
				 * change anything to have the "Publish" button enabled.
				 */
				wp.customize.state( 'saved' ).set( false );
			}
			wp.customize.previewer.previewUrl.set( pen_customize_url_home );

			var _query = wp.customize.previewer.query;
			wp.customize.previewer.query = function () {
				var query = _query.call( this );
				if ( pen_customize_js.preset_preview ) {
					query.pen_preview_color = pen_customize_js.preset_color;
					query.pen_preview_font  = pen_customize_js.preset_font;
				}
				return query;
			};

			var sections = [
				'pen_panel_content,#primary',
				'pen_panel_front,#primary',
				'pen_panel_header,#pen_header',
				'pen_section_animation_footer,#pen_footer',
				'pen_section_animation_content,#primary',
				'pen_section_animation_header,#pen_header',
				'pen_section_animation_list,#primary',
				'pen_section_animation_navigation,#pen_navigation',
				'pen_section_animation_search,#pen_search',
				'pen_section_animation_widget_areas,#pen_header',
				'pen_section_background_image_bottom,#pen_bottom',
				'pen_section_background_image_content_title,#primary',
				'pen_section_background_image_footer,#pen_footer',
				'pen_section_background_image_navigation,#pen_navigation',
				'pen_section_background_image_search,#pen_search',
				'pen_section_colors_bottom,#pen_bottom',
				'pen_section_colors_content,#primary',
				'pen_section_colors_footer,#pen_footer',
				'pen_section_colors_general,#primary',
				'pen_section_colors_header,#pen_header',
				'pen_section_colors_list,#primary',
				'pen_section_colors_navigation,#pen_navigation',
				'pen_section_colors_search,#pen_search',
				'pen_section_colors_woocommerce,#primary',
				'pen_section_content,#primary',
				'pen_section_footer,#pen_footer',
				'pen_section_front_sidebars,#primary',
				'pen_section_header_general,#pen_header',
				'pen_section_header_navigation,#pen_navigation',
				'pen_section_header_register,#pen_navigation',
				'pen_section_header_search,#pen_header',
				'pen_section_layout,#primary',
				'pen_section_list,#primary',
				'pen_section_typography_footer,#pen_footer',
				'pen_section_typography_general,#pen_header',
				'pen_section_typography_header,#pen_header',
				'pen_section_typography_navigation,#pen_navigation',
				'pen_section_typography_sidebars,#primary',
				'pen_section_woocommerce_general,#primary',
				'title_tagline,#pen_header'
			];

			for ( i = 0; i < sections.length; i++ ) {
				var data   = sections[ i ].split( ',' ),
				section_id = data[0],
				selector   = data[1];
				pen_section_change( section_id, selector );
			}

			function pen_section_change( section_id, html_id ) {
				wp.customize.section(
					section_id,
					function( section ) {
						section.expanded.bind(
							function( is_expanding ) {
								if ( is_expanding ) {
									wp.customize.previewer.send( 'pen_section_change', { selector: html_id } );
								}
							}
						);
					}
				);
			}

			wp.customize.previewer.bind(
				'pen_switch_section',
				function( data ) {
					if ( data.type === 'section' ) {
						var $container = wp.customize.section( data.target );
					}
					if ( data.type === 'panel' ) {
						var $container = wp.customize.panel( data.target );
					}

					if ( $container !== 'undefined' && $container !== undefined && $container !== null ) {
						$container.focus();
					} else {
						console.log( 'Not found: ' + data.target );
					}
				}
			);

			wp.customize.section(
				'static_front_page',
				function( section ) {
					pen_switch_to_front( section );
				}
			);

			wp.customize.section(
				'pen_section_front_sidebars',
				function( section ) {
					pen_switch_to_front( section );
				}
			);

			function pen_switch_to_front( section ) {
				var previous_url,
				clear_previous_url = function() {
					previous_url = null;
				},
				preview_url_value  = wp.customize.previewer.previewUrl;
				section.expanded.bind(
					function( is_expanded ) {
						var url;
						if ( is_expanded ) {
							url          = pen_customize_js.url_start ? pen_customize_js.url_start : wp.customize.settings.url.home;
							previous_url = preview_url_value.get();
							preview_url_value.set( url );
							preview_url_value.bind( clear_previous_url );
						} else {
							preview_url_value.unbind( clear_previous_url );
							if ( previous_url ) {
								preview_url_value.set( previous_url );
							}
						}
					}
				);
			}

			var $customizer_header = $( '#customize-info .accordion-section-title' );

			if ( pen_customize_js.url_rate ) {
				$customizer_header.append( '<p><a href="' + pen_customize_js.url_rate + '" class="button pen_rate" target="_blank" style="min-width:100%">' + pen_customize_js.text.rate + '</a></p>' );
			}

			$customizer_header.append( '<p><a href="' + pen_customize_js.url_support + '" class="button" target="_blank" style="min-width:100%">' + pen_customize_js.text.do_you_need_help + '</a></p>' );

			$customizer_header.append( '<p><a href="' + pen_customize_js.url_support_urgent + '" class="button" target="_blank" style="min-width:100%">' + pen_customize_js.text.urgent_support + '</a></p>' );

			$controls.find( "li[id^=accordion-panel-pen_]" ).add( $controls.find( "li[id^=accordion-section-pen_]" ) )
			.children( '.accordion-section-title' )
			.prepend( '<span class="pen_only" title="' + pen_customize_js.text.theme_specific + '">' + pen_customize_js.text.pen_theme + '</span>' );

			$controls.find( 'a.pen_customizer_shortcut' ).each(
				function() {
					var $this = $( this );
					$this.on(
						'click',
						function() {
							data = $this.data();
							wp.customize.previewer.trigger( 'pen_switch_section', { type: data.type, target: data.target } );
							event.preventDefault();
						}
					);
				}
			);

		}
	);

} )( jQuery );
