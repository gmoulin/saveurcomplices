<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 lt-ie9 lt-ie8 lt-ie7" <?php echo language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 lt-ie9 lt-ie8" <?php echo language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 lt-ie9" <?php echo language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php echo language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width">
		<title><?php brunelleschi_title(); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<style type="text/css">
			#wrapper { max-width: <?php echo brunelleschi_options('content-width'); ?>px !important;
			<?php if( brunelleschi_options('box-shadow') ) : ?>
				-webkit-box-shadow: 0 .7em 2em -10px #000;
				-moz-box-shadow: 0 .7em 2em -10px #000;
				-o-box-shadow: 0 .7em 2em -10px #000;
				box-shadow: 0 .7em 2em -10px #000;
			<?php endif; ?> }
			<?php if( brunelleschi_options('fonts') === __('Modern','brunelleschi') ) : ?>
				body { font-weight: 300; font-family: "Times New Roman", Times, serif; }
				h1, h2, h3, h4, h5, h6,
				.page-title span,
				.pingback a.url,
				#site-title,
				#site-description,
				.entry-title,
				.widget-title{
					font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
					font-weight: 300;
				}
				h3#comments-title,
				h3#reply-title,
				#access .menu,
				#access div.menu ul,
				#cancel-comment-reply-link,
				.form-allowed-tags,
				#site-info,
				#wp-calendar,
				.comment-meta,
				.comment-body tr th,
				.comment-body thead th,
				.entry-content label,
				.entry-content tr th,
				.entry-content thead th,
				.entry-meta,
				.entry-utility,
				#respond label,
				.navigation,
				.page-title,
				.pingback p,
				.reply,
				.wp-caption-text,
				.home .hentry.format-aside:before,
				.home .hentry.category-asides:before,
				#entry-author-info h2 {
					font-family: "Times New Roman", Times, serif;
					letter-spacing: .2em;
				}
				input[type=submit] {
					font-family: "Times New Roman", Times, serif;
				}
			<?php elseif( brunelleschi_options('fonts') === __('Nouveau','brunelleschi') ): ?>
				body { font-weight: 300; font-family: Garamond, Baskerville,'Palatino Linotype', Palatino, Georgia, serif; }
				@font-face { font-family: 'Caviar Dreams'; src: url('<?php echo get_template_directory_uri(); ?>/fonts/CaviarDreams.ttf'); }
				@font-face { font-family: 'Caviar Dreams'; font-weight: bold; src: url('<?php echo get_template_directory_uri(); ?>/fonts/CaviarDreams_Bold.ttf'); }
				h1, h2, h3, h4, h5, h6,
				.page-title span,
				.pingback a.url,
				#site-title,
				#site-description,
				.entry-title,
				.widget-title {
					font-family: 'Caviar Dreams';
				}
				h3#comments-title,
				h3#reply-title,
				#access .menu,
				#access div.menu ul,
				#cancel-comment-reply-link,
				.form-allowed-tags,
				#site-info,
				#wp-calendar,
				.comment-meta,
				.comment-body tr th,
				.comment-body thead th,
				.entry-content label,
				.entry-content tr th,
				.entry-content thead th,
				.entry-meta,
				.entry-utility,
				#respond label,
				.navigation,
				.page-title,
				.pingback p,
				.reply,
				.wp-caption-text,
				.home .hentry.format-aside:before,
				.home .hentry.category-asides:before,
				#entry-author-info h2 {
					font-family: Garamond, Baskerville,'Palatino Linotype', Palatino, Georgia, serif;
					letter-spacing: .2em;
				}
				input[type=submit], #main {
					font-family: Baskerville,'Palatino Linotype', Palatino, Georgia, serif;
				}
			<?php endif;?>
			<?php if( brunelleschi_options('center-navigation')) : ?>
				#access .menu, #access .menu-header {
					float: left;
					position: relative;
					left: 50%;
					margin-left: 0 !important;
				}
				#access .menu>ul, #access .menu-header>ul {
					float: left;
					position: relative;
					left: -50%;
					text-align: center;
				}
				#access .menu>ul li, #access .menu-header>ul li{
					float: none;
					display: inline-block;
				}
			<?php endif; ?>
			<?php if( brunelleschi_options('left-heading')) : ?>
				#branding { text-align: left; }
			<?php endif; ?>
			<?php if( brunelleschi_options('left-heading') || brunelleschi_options('header-order') === __('Text on the Left','brunelleschi') || brunelleschi_options('header-order') === __('Text on the Right','brunelleschi')) : ?>
				#site-title { font-size: 20px; }
			<?php endif; ?>
			<?php if( brunelleschi_options('navigation-position') === __('Nav Above Banner','brunelleschi')) : ?>
				#access { margin-bottom: 18px; }
			<?php endif; ?>
			<?php if( brunelleschi_options('sidebar') === __('left','brunelleschi') ){ ?> #main { float: right } <?php } ?>
			<?php if( brunelleschi_options('remove-header-image-border') === '1' ){ ?> #headerimg { border: none } <?php } ?>
			<?php if( brunelleschi_options('sidebar') === __('both','brunelleschi') && brunelleschi_options('sidebar-width') === __('two','brunelleschi')){ ?>
				#sidebar-two.left { margin-left: -86.5%; }
				#main { margin-left: 17.6%;}
				
				@media handheld, only screen and (max-width: 767px) {
					#main { margin-left: 0;}
					#sidebar-two.left { margin-left: 0}
				}
			<?php }elseif(brunelleschi_options('sidebar') === __('both','brunelleschi') && brunelleschi_options('sidebar-width') === __('four','brunelleschi')){ ?>
				#sidebar-two.left { margin-left: -68.6%; }
				#main { margin-left: 34.8%;}
				
				@media handheld, only screen and (max-width: 767px) {
					#main { margin-left: 0;}
					#sidebar-two.left { margin-left: 0}
				}
			<?php }elseif(brunelleschi_options('sidebar') === __('both','brunelleschi')){ ?>
				#sidebar-two.left { margin-left: -77.5%; }
				#main { margin-left: 26%;}
				
				@media handheld, only screen and (max-width: 767px) {
					#main { margin-left: 0;}
					#sidebar-two.left { margin-left: 0}
				}
			<?php } ?>
			<?php if(brunelleschi_options('extra-css')){ echo brunelleschi_options('extra-css'); }?>
		</style>
		<?php
			if ( is_singular() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );
			wp_head();
		?>
	</head>
	<body <?php body_class(); ?>>
	<div id="wrapper" class="hfeed container">
		<header id="header" class="row clearfix">
			<?php if( (brunelleschi_options('header-order') === __('Text on Top','brunelleschi') || brunelleschi_options('header-order') === __('Text on the Left','brunelleschi') || ! brunelleschi_options('header-order')) && !(brunelleschi_options('navigation-position') === __('Nav Above Banner','brunelleschi') && brunelleschi_options('header-order') === __('Text on the Left','brunelleschi')) ) : ?>
				<div id="branding" class="<?php brunelleschi_branding_class(); ?>">
					<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
					<<?php echo $heading_tag; ?> id="site-title" <?php if( brunelleschi_options('site-title') ) { echo 'class="hidden"'; } ?>>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</<?php echo $heading_tag; ?>>
					<div id="site-description" <?php if( brunelleschi_options('site-description') ) { echo 'class="hidden"'; } ?>><?php bloginfo( 'description' ); ?></div>
				</div><!-- #branding -->
			<?php endif; ?>
			<?php if(!brunelleschi_options('hide-navigation') && brunelleschi_options('navigation-position') === __('Nav Above Banner','brunelleschi')): ?>
				<div id="access" role="navigation" class="twelvecol last clearfix">
					<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'brunelleschi' ); ?>"><?php _e( 'Skip to content', 'brunelleschi' ); ?></a></div>
					<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
				</div><!-- #access -->
			<?php endif; ?>
			<?php if( brunelleschi_options('navigation-position') === __('Nav Above Banner','brunelleschi') && ( brunelleschi_options('header-order') === __('Text on the Left','brunelleschi') || ! brunelleschi_options('header-order') )) : ?>
				<div id="branding" class="<?php brunelleschi_branding_class(); ?>">
					<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
					<<?php echo $heading_tag; ?> id="site-title" <?php if( brunelleschi_options('site-title') ) { echo 'class="hidden"'; } ?>>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</<?php echo $heading_tag; ?>>
					<div id="site-description" <?php if( brunelleschi_options('site-description') ) { echo 'class="hidden"'; } ?>><?php bloginfo( 'description' ); ?></div>
				</div><!-- #branding -->
			<?php endif; ?>
			<?php if(brunelleschi_options('use-featured-content')): ?>
				<?php get_template_part( 'featured', 'content' ); ?>
			<?php elseif(brunelleschi_options('use-header-image')) : ?>
				<?php
				// Check if this is a post or page, if it has a thumbnail, and if it's a big one
				if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
						has_post_thumbnail( $post->ID ) &&
						( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
						$image[1] >= HEADER_IMAGE_WIDTH ) :
					// Houston, we have a new header image!
					echo get_the_post_thumbnail( $post->ID, array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT ), array( 'id' => 'headerimg') );
				elseif ( get_header_image() ) : ?>
					<a href="<?php echo home_url( '/' ); ?>" class="<?php brunelleschi_banner_class(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" alt="" id="headerimg" />
					</a>
				<?php endif; ?>	
			<?php endif; ?>
			<?php if(brunelleschi_options('header-order') === __('Text on the Bottom','brunelleschi') || brunelleschi_options('header-order') === __('Text on the Right','brunelleschi')) : ?>
				<div id="branding" class="<?php brunelleschi_branding_class(); ?>">
					<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
					<<?php echo $heading_tag; ?> id="site-title" <?php if( brunelleschi_options('site-title') ) { echo 'class="hidden"'; } ?>>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</<?php echo $heading_tag; ?>>
					<div id="site-description" <?php if( brunelleschi_options('site-description') ) { echo 'class="hidden"'; } ?>><?php bloginfo( 'description' ); ?></div>
				</div><!-- #branding -->
			<?php endif; ?>
			<?php if((brunelleschi_options('navigation-position')) == false || !brunelleschi_options('hide-navigation') && brunelleschi_options('navigation-position') === __('Nav Below Banner','brunelleschi')): ?>
				<div id="access" role="navigation" class="twelvecol last clearfix">
					<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'brunelleschi' ); ?>"><?php _e( 'Skip to content', 'brunelleschi' ); ?></a></div>
					<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
				</div><!-- #access -->
			<?php endif; ?>
		</header><!-- #header -->
		<div id="container" class="row clearfix">