<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}



function register_my_session()
{
  if( !session_id() )
  {
    session_start();
  }
}

add_action('init', 'register_my_session');


/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	/*
	 * Enable support for custom logo.
	 *
	 * @since Twenty Fifteen 1.5
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
	
	wp_enqueue_script( 'twentyfifteen-custom-js', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '20150330', true );
	
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';



add_action('wp_ajax_found_animal_login_action','found_animal_login_action');
add_action('wp_ajax_nopriv_found_animal_login_action','found_animal_login_action');

function found_animal_login_action(){ 
	
	$data = $_REQUEST;

	global $wpdb;
    
	$emailaddress = $data['emailaddress'];
	$password = $data['password'];
	
	$curl = curl_init();
	
	$url = "http://localhost/Registry-API/login?email=$emailaddress&password=$password";

	curl_setopt_array($curl, array(
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
	"Authorization: Token 0901ea36fec4a5f0ab5fb8377f97740d:o9Ro8OmIaWP0"
	),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		//echo "cURL Error #:" . $err;
	
		echo json_encode(array('result' => 'fail', 'error_msg' =>"some error ocurred please try agian."));
	
	} else {		
		
		///echo $response;
		
		$response = json_decode($response,true);
		
		if(isset($response['error_msg'])) {
		
			echo json_encode(array('result' => 'fail', 'error_msg' =>$response['error_msg']));
			
		} else {
			
				//print_r($response);
				
				
				$_SESSION['userID'] = $response['suite_response']['sessionResponse']['userId']['internalId'];
				
				$_SESSION['userName'] = $response['suite_response']['sessionResponse']['userId']['name'];
				
				echo json_encode(array('result' => 'true', 'error_msg' =>"Login Sucess",'redirect' => "http://localhost/foundanimal-api/my-profile/"));
		}
	}
		
	//print_r(json_decode($response,true));	
		
		
	die();
}




add_action('wp_ajax_netsuite_customer_register_action','netsuite_customer_register_action');
add_action('wp_ajax_nopriv_netsuite_customer_register_action','netsuite_customer_register_action');

function netsuite_customer_register_action(){ 
	
	$data = $_REQUEST;
	global $wpdb;
	
	$netsuitearray = array();
	
	
	
	$netsuitearray['customer']['first_name'] = $data['firstname'];
	$netsuitearray['customer']['last_name'] = $data['lastname'];
	$netsuitearray['customer']['email'] = $data['emailaddress'];
	$netsuitearray['customer']['phone'] = $data['phonenumber'];
	/*$netsuitearray['customer']['company_name'] = $data['firstname'];
	$netsuitearray['customer']['alt_email'] = $data['emailaddress'];
	$netsuitearray['customer']['alt_phone'] = $data['phonenumber'];
	$netsuitearray['customer']['home_phone'] = $data['phonenumber'];
	$netsuitearray['customer']['mobile_phone'] = $data['phonenumber'];*/
	
	$netsuitearray['subsidiary']['internal_id'] = 3;
	$netsuitearray['subsidiary']['name'] = "Adopt & Shop Operations LLC";
	
	
	//echo '<pre>';
	//print_r($netsuitearray);
	
	
	$curl = curl_init();



		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://localhost/Registry-API/customer",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POST=>true,
			CURLOPT_POSTFIELDS => urldecode(http_build_query($netsuitearray)),
			CURLOPT_HTTPHEADER => array(
			"Authorization: Token 0901ea36fec4a5f0ab5fb8377f97740d:o9Ro8OmIaWP0",
			),
		));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	$response = json_decode($response,true);	
	
	if ($err) {
		
		//echo "cURL Error #:" . $err;
		
		echo json_encode(array('result' => 'fail', 'error_msg' =>"some error ocurred please try agian."));
		
	} else {
		
		//print_r(json_decode($response,true));
		
		if(isset($response['error_msg'])) {
		
			echo json_encode(array('result' => 'fail', 'error_msg' =>$response['error_msg']));
		
		} else {
			
				$InternalID = $response['suite_response']['writeResponse']['baseRef']['internalId'];
				
				//echo json_encode(array('result' => 'true', 'error_msg' =>"Register Sucess",'redirect' => "http://localhost/foundanimal-api/login"));
				
				$updatenetsuitearray = array();
				
				$updatenetsuitearray['customer']['internal_id'] = $InternalID;
				$updatenetsuitearray['address']['attention'] = $data['firstname'].' '.$data['lastname'];
				$updatenetsuitearray['address']['addr1'] = $data['street'];
				$updatenetsuitearray['address']['city'] = $data['city'];
				$updatenetsuitearray['address']['state'] = $data['state'];
				$updatenetsuitearray['address']['zip'] = $data['zip'];				
				$updatenetsuitearray['access']['name'] = $data['firstname'].' '.$data['lastname'];
				$updatenetsuitearray['access']['email'] =  $data['emailaddress'];
				$updatenetsuitearray['access']['password'] =  $data['password'];
				$updatenetsuitearray['access']['password2'] =  $data['confirmpassword'];
				$updatenetsuitearray['address_book']['is_residential'] =  true;
				$updatenetsuitearray['address_book']['default_shipping'] =  true;
				$updatenetsuitearray['address_book']['default_billing'] =  true;
				
				$updatenetsuitearray['registry_contacts']['primaryemergencyfirstname'] =  $data['primary_firstname'];
				$updatenetsuitearray['registry_contacts']['primaryemergencylastname'] =  $data['primary_lastname'];
				$updatenetsuitearray['registry_contacts']['primaryemergencyphonenumber'] =  $data['primary_phonenumber'];
				$updatenetsuitearray['registry_contacts']['primaryemergencyemail'] =  $data['primary_email'];
				$updatenetsuitearray['registry_contacts']['primaryemergencyaddressline1'] =  $data['primary_address1'];
				$updatenetsuitearray['registry_contacts']['primaryemergencyaddressline2'] =  $data['primary_address2'];
				$updatenetsuitearray['registry_contacts']['primaryemergencyaddresscity'] =  $data['primary_city'];
				$updatenetsuitearray['registry_contacts']['primaryemergencyaddressstate'] =  $data['primary_state'];
				$updatenetsuitearray['registry_contacts']['primaryemergencyaddresszip'] =  $data['primary_zip'];
				$updatenetsuitearray['registry_contacts']['primaryemergencyaddresscou'] =  $data['primary_country'];
				
				
				$updatenetsuitearray['registry_contacts']['2ndemergencyfirstname'] =  $data['secondary_firstname'];
				$updatenetsuitearray['registry_contacts']['2ndemergencylastname'] =  $data['secondary_lastname'];
				$updatenetsuitearray['registry_contacts']['2ndemergencyphonenumber'] =  $data['secondary_phonenumber'];
				$updatenetsuitearray['registry_contacts']['2ndemergencyemail'] =  $data['secondary_email'];
				$updatenetsuitearray['registry_contacts']['2ndemergencyaddressline1'] =  $data['secondary_address1'];
				$updatenetsuitearray['registry_contacts']['2ndemergencyaddressline2'] =  $data['secondary_address2'];
				$updatenetsuitearray['registry_contacts']['2ndemergencycity'] =  $data['secondary_city'];
				$updatenetsuitearray['registry_contacts']['2ndemergencystate'] =  $data['secondary_state'];
				$updatenetsuitearray['registry_contacts']['2ndemergencyzipcode'] =  $data['secondary_zip'];
				$updatenetsuitearray['registry_contacts']['2ndemergencycountry'] =  $data['secondary_country'];
				
				$updatenetsuitearray['registry_contacts']['veterinarianfacilityname'] =  $data['veterinarian_faclityname'];
				$updatenetsuitearray['registry_contacts']['veterinarianphonenumber'] =  $data['veterinarian_phonenumber'];
				$updatenetsuitearray['registry_contacts']['veterinarianemail'] =  $data['veterinarian_email'];
				
			
				$data_string = json_encode($updatenetsuitearray);
					
					$curl = curl_init();

						curl_setopt_array($curl, array(
						CURLOPT_URL => "http://localhost/Registry-API/customer",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => "",
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => "PUT",
						CURLOPT_POSTFIELDS =>  $data_string,
						CURLOPT_HTTPHEADER => array(
							"Content-Type: application/json",
							'Content-Length: ' . strlen($data_string),
							"Authorization: Token 0901ea36fec4a5f0ab5fb8377f97740d:o9Ro8OmIaWP0",
						),
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);
					
					$response = json_decode($response,true);

					curl_close($curl);

						
					if ($err) {
						//echo "cURL Error #:" . $err;
						echo json_encode(array('result' => 'fail', 'error_msg' =>"some error ocurred please try agian."));
						
					} else {
							
							if(isset($response['error_msg'])) {
		
									echo json_encode(array('result' => 'fail', 'error_msg' =>$response['error_msg']));
		
							} else {
			
								//echo $response;
								
								echo json_encode(array('result' => 'true', 'success_message' =>"Register Sucess",'redirect' => "http://localhost/foundanimal-api/login"));
							}
					}
			}
		
		//print_r($response);
	}
		
		die();
		
}	


add_action('wp_ajax_foundanimal_update_profile_action','foundanimal_update_profile_action');
add_action('wp_ajax_nopriv_foundanimal_update_profile_action','foundanimal_update_profile_action');

function foundanimal_update_profile_action(){ 
	
	$data = $_REQUEST;
	global $wpdb;
	
	$updatenetsuitearray = array();
	
	$updatenetsuitearray['customer']['internal_id'] = $data['IntrnalID'];
	$updatenetsuitearray['customer']['first_name'] = $data['firstname'];
	$updatenetsuitearray['customer']['last_name'] = $data['lastname'];
	//$updatenetsuitearray['customer']['email'] = $data['emailaddress'];
	$updatenetsuitearray['customer']['phone'] = $data['phonenumber'];
	
	if($data['password'] != "" && $data['confirmpassword'] != ""){
		$updatenetsuitearray['access']['password'] =  $data['password'];
		$updatenetsuitearray['access']['password2'] =  $data['confirmpassword'];
	}
	
	
	$data_string = json_encode($updatenetsuitearray);
	
	
		$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => "http://localhost/Registry-API/customer",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_POSTFIELDS =>  $data_string,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				'Content-Length: ' . strlen($data_string),
				"Authorization: Token 0901ea36fec4a5f0ab5fb8377f97740d:o9Ro8OmIaWP0",
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		
		$response = json_decode($response,true);
			
		
		
		curl_close($curl);

			
		if ($err) {
			//echo "cURL Error #:" . $err;
			echo json_encode(array('result' => 'fail', 'error_msg' =>"some error ocurred please try agian."));
			
		} else {
				
				if(isset($response['error_msg'])) {

						echo json_encode(array('result' => 'fail', 'error_msg' =>$response['error_msg']));

				} else {

					//echo $response;
					
					echo json_encode(array('result' => 'true', 'error_msg' =>"Profile update sucessfully",'redirect' => "http://localhost/foundanimal-api/my-profile"));
				}
		}
	
	die();
	
}	



add_action('wp_ajax_netsuite_customer_address_update_action','netsuite_customer_address_update_action');
add_action('wp_ajax_nopriv_netsuite_customer_address_update_action','netsuite_customer_address_update_action');

function netsuite_customer_address_update_action(){ 
	
	$data = $_REQUEST;
	global $wpdb;
	
	$updatenetsuitearray = array();
	
	$updatenetsuitearray['customer']['internal_id'] = $data['customer_inernal_id'];
	$updatenetsuitearray['address']['attention'] = $data['attention'];
	$updatenetsuitearray['address']['addr1'] = $data['address1'];
	$updatenetsuitearray['address']['addr2'] = $data['address2'];
	$updatenetsuitearray['address']['city'] = $data['city'];
	$updatenetsuitearray['address']['state'] = $data['state'];
	$updatenetsuitearray['address']['zip'] = $data['zip'];				
	
	$updatenetsuitearray['address_book']['internal_id'] =  $data['address_internalid'];
	$updatenetsuitearray['address_book']['is_residential'] =  true;
	$updatenetsuitearray['address_book']['default_shipping'] =  true;
	$updatenetsuitearray['address_book']['default_billing'] =  true;
	
	
	
	$data_string = json_encode($updatenetsuitearray);
	
	
		$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => "http://localhost/Registry-API/customer",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_POSTFIELDS =>  $data_string,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				'Content-Length: ' . strlen($data_string),
				"Authorization: Token 0901ea36fec4a5f0ab5fb8377f97740d:o9Ro8OmIaWP0",
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		
		$response = json_decode($response,true);
			
	
		
		curl_close($curl);

			
		if ($err) {
			//echo "cURL Error #:" . $err;
			echo json_encode(array('result' => 'fail', 'error_msg' =>"some error ocurred please try agian."));
			
		} else {
				
				if(isset($response['error_msg'])) {

						echo json_encode(array('result' => 'fail', 'error_msg' =>$response['error_msg']));

				} else {

					//echo $response;
					
					echo json_encode(array('result' => 'true', 'error_msg' =>"Address update sucessfully",'redirect' => "http://localhost/foundanimal-api/my-profile"));
				}
		}
	
	die();
	
}	

add_action('wp_logout', 'myEndSession');

function myEndSession() {
    session_destroy ();
}