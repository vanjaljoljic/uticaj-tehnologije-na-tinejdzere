<?php
/**
 * Title: Footer
 * Slug: pumori/footer
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"var:preset|spacing|50","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","top":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|40","margin":{"top":"0","bottom":"0"}},"dimensions":{"minHeight":"40vh"},"border":{"top":{"color":"#e2e2e2","width":"1px"}},"color":{"background":"#f7f7f7"}},"textColor":"contrast","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group alignfull has-contrast-color has-text-color has-background" style="border-top-color:#e2e2e2;border-top-width:1px;background-color:#f7f7f7;min-height:40vh;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:site-logo {"align":"center","style":{"spacing":{"margin":{"bottom":"6px"}}}} /-->

<!-- wp:paragraph -->
<p><?php _e('Copyright All Rights Reserved', 'pumori'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">
<?php
		printf(
			/* Translators: WordPress link. */
			esc_html__( 'Proudly powered by %s', 'pumori' ),
			'<a href="' . esc_url( __( 'https://wordpress.org', 'pumori' ) ) . '" rel="nofollow">WordPress</a>'
		)
		?>
		<span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf(esc_html__('Theme: %1$s by %2$s.', 'pumori'), 'Pumori', '<a href="https://www.wpmount.com/" target="_blank">WPMount</a>');
			?>
</p>
<!-- /wp:paragraph -->

<!-- wp:social-links {"size":"has-normal-icon-size","style":{"spacing":{"blockGap":{"top":"12px","left":"12px"}}},"className":"is-style-logos-only","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<ul class="wp-block-social-links has-normal-icon-size is-style-logos-only"><!-- wp:social-link {"url":"#","service":"facebook"} /-->

<!-- wp:social-link {"url":"#","service":"twitter"} /-->

<!-- wp:social-link {"url":"#","service":"wordpress"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group -->