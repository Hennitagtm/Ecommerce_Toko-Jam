<?php
/**
 * Describe child theme functions
 *
 * @package Saaya
 * @subpackage Saaya Blogger
 * @since 1.0.0
 */

/*-------------------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'saaya_blogger_setup' ) ) :
    
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function saaya_blogger_setup() {

        $saaya_blogger_theme_info = wp_get_theme();
        $GLOBALS['saaya_blogger_version'] = $saaya_blogger_theme_info->get( 'Version' );
    }

endif;
add_action( 'after_setup_theme', 'saaya_blogger_setup' );

add_action( 'after_setup_theme', 'saaya_blogger_custom_fields' );

function saaya_blogger_custom_fields() {
    
    // Toggle field for Enable/Disable trending section
    Kirki::add_field(
    	'saaya_config', array(
    		'type'     => 'toggle',
    		'settings' => 'saaya_blogger_enable_trending',
    		'label'    => esc_html__( 'Enable Trending Section', 'saaya-blogger' ),
            'description' => esc_html__( 'Trending section shows the popular tags.', 'saaya-blogger' ),
    		'section'  => 'saaya_section_header_extra',
    		'default'  => '1',
    		'priority' => 20,
    	)
    );
    
    // Text filed for trending label
    Kirki::add_field(
    	'saaya_config', array(
    		'type'     => 'text',
    		'settings' => 'saaya_trending_label',
    		'label'    => esc_html__( 'Trending Label', 'saaya-blogger' ),
    		'section'  => 'saaya_section_header_extra',
    		'default'  => esc_html__( 'Trending Now', 'saaya-blogger' ),
    		'priority' => 25,
            'active_callback' => array(
    			array(
    				'setting'  => 'saaya_blogger_enable_trending',
    				'value'    => '1',
    				'operator' => '==',
    			)
    		)
    	)
    );

}

/*-------------------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'saaya_blogger_fonts_url' ) ) :
    
    /**
     * Register Google fonts
     *
     * @return string Google fonts URL for the theme.
     */
    function saaya_blogger_fonts_url() {

        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Hebbo, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Heebo font: on or off', 'saaya-blogger' ) ) {
            $font_families[] = 'Heebo:700,900';
        }
        
         /*
         * Translators: If there are characters in your language that are not supported
         * by Nunito, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Nunito font: on or off', 'saaya-blogger' ) ) {
            $font_families[] = 'Nunito:400,,600,700';
        }

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }

endif;

/*-------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue child theme styles and scripts
 */
add_action( 'wp_enqueue_scripts', 'saaya_blogger_scripts', 99 );

function saaya_blogger_scripts() {
    
    global $saaya_blogger_version;
    
    wp_enqueue_style( 'saaya-blogger-google-font', saaya_blogger_fonts_url(), array(), null );
    
    wp_dequeue_style( 'saaya-style' );
    wp_dequeue_style( 'saaya-responsive-style' );
    
    wp_enqueue_style( 'saaya-parent-style', get_template_directory_uri() . '/style.css', array(), esc_attr( $saaya_blogger_version ) );
    
    wp_enqueue_style( 'saaya-parent-responsive', get_template_directory_uri() . '/assets/css/mt-responsive.css', array(), esc_attr( $saaya_blogger_version ) );
    
    wp_enqueue_style( 'saaya-blogger-style', get_stylesheet_uri(), array(), esc_attr( $saaya_blogger_version ) );

    wp_dequeue_script( 'saaya-custom-scripts' );

    wp_enqueue_script( 'saaya-blogger-parent-custom-scripts', get_template_directory_uri() .'/assets/js/mt-custom-scripts.js', array( 'jquery' ), esc_attr( $saaya_blogger_version ), true );
    
    wp_enqueue_script( 'saaya-blogger-custom-scripts', get_stylesheet_directory_uri() .'/assets/js/custom-scripts.js', array( 'jquery' ), esc_attr( $saaya_blogger_version ), true );
    
    $saaya_enable_sticky_menu = get_theme_mod( 'saaya_enable_sticky_menu', true );
	if( true === $saaya_enable_sticky_menu ) {
		$sticky_value = 'on';
	} else {
		$sticky_value = 'off';
	}

    $saaya_enable_wow_animation = get_theme_mod( 'saaya_enable_wow_animation', true );
    if ( true === $saaya_enable_wow_animation ) {
        $wow_value = 'on';
    } else {
        $wow_value = 'off';
    }

    wp_localize_script( 'saaya-blogger-parent-custom-scripts', 'saayaObject', array(
        'menu_sticky' => 'off',
        'wow_effect'     => $wow_value
    ) );

	wp_localize_script( 'saaya-blogger-custom-scripts', 'saayaBloggerObject', array(
        'menu_sticky' => $sticky_value
    ) );

    $saaya_blogger_theme_color = esc_attr( get_theme_mod( 'saaya_primary_color', '#FFDD00' ) );

    $saaya_blogger_background_color = esc_attr( get_theme_mod( 'background_color', '#FFF6BE' ) );
   
    $output_css = '';
        
    $output_css .= ".edit-link .post-edit-link,.reply .comment-reply-link,.widget_search .search-submit,.mt-menu-search .mt-form-wrap .search-form .search-submit:hover,article.sticky::before,.post-format-media--quote,.saaya_social_media a:hover,.sk-spinner-pulse{ background: ". esc_attr( $saaya_blogger_theme_color ) ."}\n";

    $output_css .= "a,a:hover,a:focus,a:active,.entry-cat .cat-links a:hover,.entry-cat a:hover,.entry-footer a:hover,.comment-author .fn .url:hover,.commentmetadata .comment-edit-link,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.mt-social-icon-wrap li a:hover,#site-navigation ul li a:hover,.banner-sub-title,.entry-title a:hover,.cat-links a:hover,.entry-footer .mt-readmore-btn:hover,.btn-wrapper a:hover,.mt-readmore-btn:hover,.navigation.pagination .nav-links .page-numbers.current, .navigation.pagination .nav-links a.page-numbers:hover,#footer-menu li a:hover,.saaya_latest_posts .mt-post-title a:hover,#mt-scrollup:hover,.menu-toggle:hover,#site-navigation ul li:hover > a, #site-navigation ul li.current-menu-item > a, #site-navigation ul li.current_page_ancestor > a, #site-navigation ul li.current_page_item > a,.mt-form-close a:hover{ color: ". esc_attr( $saaya_blogger_theme_color ) ."}\n";
    
    $output_css .= ".widget_search .search-submit,.widget_search .search-submit:hover,.navigation.pagination .nav-links .page-numbers.current, .navigation.pagination .nav-links a.page-numbers:hover,.error-404.not-found,.saaya_social_media a:hover{ border-color: ". esc_attr( $saaya_blogger_theme_color ) ."}\n";

    $output_css .= "body{ background-color: ". esc_attr( $saaya_blogger_background_color ) ."}\n";


    $refine_output_css = saaya_css_strip_whitespace( $output_css );

    wp_add_inline_style( 'saaya-blogger-style', $refine_output_css );

}   

add_action( 'saaya_main_banner_content', 'saaya_blogger_trending_section', 5 );

if( ! function_exists( 'saaya_blogger_trending_section' ) ) {
    
    /**
     * function to display the trending tags sections  
     *
     */
    function saaya_blogger_trending_section() {
        $saaya_blogger_enable_trending = get_theme_mod( 'saaya_blogger_enable_trending', true );
        if( false === $saaya_blogger_enable_trending ) {
            return;
        }
        wp_reset_query();
        $trending_label = get_theme_mod( 'saaya_trending_label', __( 'Trending Now', 'saaya-blogger' ) );
?>
        <div class="trending-wrapper">
            <div class="mt-container">
                <span class="wrap-label"><?php echo esc_html( $trending_label ); ?></span>
                <div class="tags-wrapper">
                    <?php
                        $tag_args = array(
                                'orderby'   => 'count',
                                'order'     => 'DESC'
                            );
                        $get_tags = get_tags( $tag_args );
            			if ( $get_tags ) {
            			     echo '<span class="head-tags-links">';
            			     foreach( $get_tags as $tag ) {
            			         echo '<a href="'. esc_url( get_tag_link ( $tag->term_id ) ) .'" rel="tag">'. esc_html( $tag->name ) .'</a>';
            			     }
                             echo '</span>';
                        }
                    ?>
                </div><!-- .tags-wrapper -->
            </div>
        </div><!-- .trending-wrapper -->
<?php
    }
}

add_action( 'customize_register', 'saaya_blogger_customize_register', 20 );

if ( ! function_exists( 'saaya_blogger_customize_register' ) ) :

    /**
     * Customizer settings for saaya blogger
     */
    function saaya_blogger_customize_register( $wp_customize ) {

        $wp_customize->get_setting( 'background_color' )->default = '#FFF6BE';

        $wp_customize->get_setting( 'saaya_primary_color' )->default = '#FFDD00';

    }

endif;