<?php global $theme; ?>

</div>

<div class="container">

    <div id="footer-wrap" class="span-24">
        
        <div id="footer">
        
            <div id="copyrights">
                <?php
                    if($theme->display('footer_custom_text')) {
                        $theme->option('footer_custom_text');
                    } else { 
                        ?> &copy; <?php echo date('Y'); ?>  <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a>. <?php _e('All Rights Reserved.', 'themater');
                    }
                ?> 
            </div>
            
            <?php /* 
                    All links in the footer should remain intact. 
                    These links are all family friendly and will not hurt your site in any way. 
                    Warning! Your site may stop working if these links are edited or deleted 
                    
                    You can buy this theme without footer links online at http://fthemes.com/buy/?theme=fashionable 
                */ ?>
            
            <div id="credits">Powered by <a href="http://wordpress.org/"><strong>WordPress</strong></a> | Designed by: <a href="http://www.hi-mama.com/new/">woman</a> | Thanks to <a href="http://suv.reviewitonline.net/">suv</a>, <a href="http://suv.reviewitonline.net/infiniti-suv/">infiniti suv</a> and <a href="http://woobacklinks.com">Backlink Service</a></div><!-- #credits -->
            
        </div><!-- #footer -->
        
    </div><!-- #wrap-footer -->
    
</div>

</div><!-- #wrapper -->

<?php wp_footer(); ?>
<?php $theme->hook('html_after'); ?>
</body>
</html>