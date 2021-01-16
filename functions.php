<?php

	add_theme_support('post-thumbnails');

	function mash_theme_files()
	{
		// Styles

		wp_enqueue_style('foundation-css',get_template_directory_uri().'/css/foundation.css');
		//wp_enqueue_style('normalize-css',get_template_directory_uri().'/css/normalize.css');
		wp_enqueue_style('font-css','http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic');
		wp_enqueue_style('style-css',get_stylesheet_uri());

		// Scripts

		wp_enqueue_script('modernizr-js',get_template_directory_uri().'/js/modernizr.js','','',false);
		wp_enqueue_script('foundation-js',get_template_directory_uri().'/js/foundation.js',array('jquery'),'',true);
		wp_enqueue_script('app-js',get_template_directory_uri().'/js/app.js',array('jquery','foundation-js'),'',true);

	}

	add_action('wp_enqueue_scripts','mash_theme_files');

	// create menu

	add_theme_support('menus');

	function mash_register_nav()
	{
		$args = array(

			'header-menu'	=> __('Header Menu'),
			);
		register_nav_menus($args);
	}

	add_action('init','mash_register_nav');

	// excerpt length

	function mash_excerpt_length($length)
	{
		return 15;
	}

	add_filter('excerpt_length','mash_excerpt_length',999);

	// add sidebar


	function mash_register_sidebar($name,$id,$description) {
	    register_sidebar( array(
	        'name' => __( $name ),
	        'id' =>  $id ,
	        'description' => __( $description ),
	        'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="module-heading">',
			'after_title'   => '</h2>',
	    ) );
	}

	mash_register_sidebar('page sidebar','page','This is page sidebar');
	mash_register_sidebar('blog sidebar','blog','This is blog sidebar');

	// Theme Options

	function add_theme_menu_item()
	{
		add_menu_page("Theme Panel", "Theme Panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
	}

	add_action("admin_menu", "add_theme_menu_item");

	function theme_settings_page()
	{
	    ?>
		    <div class="wrap">
			    <h1>Theme Panel</h1>
			    <form method="post" action="options.php">
			        <?php
			            settings_fields("section");
			            do_settings_sections("theme-options");      
			            submit_button(); 
			        ?>          
			    </form>
			</div>
		<?php
	}

	function display_twitter_element()
	{
		?>
	    	<input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
	    <?php
	}

	function display_facebook_element()
	{
		?>
	    	<input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
	    <?php
	}

	function display_vimeo_element()
	{
		?>
	    	<input type="text" name="vimeo_url" id="vimeo_url" value="<?php echo get_option('vimeo_url'); ?>" />
	    <?php
	}

	function display_youtube_element()
	{
		?>
	    	<input type="text" name="youtube_url" id="youtube_url" value="<?php echo get_option('youtube_url'); ?>" />
	    <?php
	}

	function display_linkedin_element()
	{
		?>
	    	<input type="text" name="linkedin_url" id="linkedin_url" value="<?php echo get_option('linkedin_url'); ?>" />
	    <?php
	}

	function display_github_element()
	{
		?>
	    	<input type="text" name="github_url" id="github_url" value="<?php echo get_option('github_url'); ?>" />
	    <?php
	}

	function display_flickr_element()
	{
		?>
	    	<input type="text" name="flickr_url" id="flickr_url" value="<?php echo get_option('flickr_url'); ?>" />
	    <?php
	}

	function display_google_element()
	{
		?>
	    	<input type="text" name="google_url" id="google_url" value="<?php echo get_option('google_url'); ?>" />
	    <?php
	}

	function display_email_element()
	{
		?>
	    	<input type="text" name="email_url" id="email_url" value="<?php echo get_option('email_url'); ?>" />
	    <?php
	}

	function display_layout_element()
	{
		?>
			<input type="checkbox" name="theme_layout" value="1" <?php checked(1, get_option('theme_layout'), true); ?> /> 
		<?php
	}

	function logo_display()
	{
		?>
	        <input type="file" name="logo" /> 
	        <?php echo get_option('logo'); ?>
	   <?php
	}

	function handle_logo_upload()
	{
		if(!empty($_FILES["demo-file"]["tmp_name"]))
		{
			$urls = wp_handle_upload($_FILES["logo"], array('test_form' => FALSE));
		    $temp = $urls["url"];
		    return $temp;   
		}
		  
		return $option;
	}

	function display_theme_panel_fields()
	{
		add_settings_section("section", "All Settings", null, "theme-options");
		
		add_settings_field("twitter_url" , "Twitter Profile Url", "display_twitter_element", "theme-options", "section");
	    add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-options", "section");
	    add_settings_field("vimeo_url"   , "Vimeo Profile Url", "display_vimeo_element", "theme-options", "section");
	    add_settings_field("youtube_url" , "Youtube Profile Url", "display_youtube_element", "theme-options", "section");
	    add_settings_field("linkedin_url", "Linkedin Profile Url", "display_linkedin_element", "theme-options", "section");
	    add_settings_field("github_url"  , "Github Profile Url", "display_github_element", "theme-options", "section");
	    add_settings_field("flickr_url"  , "Flickr Profile Url", "display_flickr_element", "theme-options", "section");
	    add_settings_field("google_url"  , "Google Profile Url", "display_google_element", "theme-options", "section");
	    add_settings_field("email_url"   , "Email Profile Url", "display_email_element", "theme-options", "section");
	    add_settings_field("theme_layout", "Do you want the layout to be responsive?", "display_layout_element", "theme-options", "section");
	    add_settings_field("logo", "Logo", "logo_display", "theme-options", "section"); 

	    register_setting("section", "twitter_url");
	    register_setting("section", "facebook_url");
	    register_setting("section", "vimeo_url");
	    register_setting("section", "youtube_url");
	    register_setting("section", "linkedin_url");
	    register_setting("section", "github_url");
	    register_setting("section", "flickr_url");
	    register_setting("section", "google_url");
	    register_setting("section", "email_url");
	    register_setting("section", "theme_layout");
	    register_setting("section", "logo", "handle_logo_upload");
	}

	add_action("admin_init", "display_theme_panel_fields");

?>