<?php
/**
 * The template for displaying the footer
 *
 * @subpackage Cyber Security Services
 * @since 1.0
 */

?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="copyright">
			<div class="container footer-content">
				<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
			</div>
		</div>
		<?php get_template_part( 'template-parts/footer/site', 'info' ); ?>
		<?php if( get_theme_mod( 'cyber_security_services_scroll_enable',true) != '') { ?>
		<div class="scroll-top">
		<button type=button id="cyber-security-services-scroll-to-top" class="scrollup"><i class="fas fa-chevron-up"></i></button>
		</div>
		<?php }?>
	</footer>
<?php wp_footer(); ?>

</body>
</html>
