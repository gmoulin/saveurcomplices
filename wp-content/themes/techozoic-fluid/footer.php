<?php 
?>
<div id="footer">
<div id="footerdivs">
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar('Footer') ) : ?>
<?php endif; ?>
</div>
<div style="clear:both"></div>
	<p class="credit">
	<?php	do_action('tech_footer'); 
	?>
		</p>
		<?php 
			if (has_nav_menu( 'footer' ) ) {		
				wp_nav_menu( array('container' =>'','theme_location'=>'footer','menu_class' => 'footernav aligncenter','after' => ' | ','depth' => '1'));
			}
	?>

</div><!--footer-->
</div><!--page-->
<?php	wp_footer(); ?>
</body>
</html>
