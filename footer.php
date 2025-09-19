<?php
/**
 * Template Files - Footer
 * 
 * @package mingo
 */

?>

	</main><!-- #content -->

	<?php get_template_part( 'template-parts/layout/footer/footer', 'cta' ); ?>
	
	<footer id="site-footer" class="site-footer">
		<?php get_template_part( 'template-parts/layout/footer/footer', 'primary' ); ?>
		<?php get_template_part( 'template-parts/layout/footer/footer', 'secondary' ); ?>
	</footer>
	
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
