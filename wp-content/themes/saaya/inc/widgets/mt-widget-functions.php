<?php
/**
 * custom function and work related to widgets.
 *
 * @package Mystery Themes
 * @subpackage Saaya
 * @since 1.0.0
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function saaya_widgets_init() {

	/**
	 * Register default sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'saaya' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'saaya' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register 4 different footer area 
	 *
	 * @since 1.0.0
	 */
	register_sidebars( 4 , array(
		'name'          => esc_html__( 'Footer %d', 'saaya' ),
		'id'            => 'footer-sidebar',
		'description'   => esc_html__( 'Added widgets are display at Footer Widget Area.', 'saaya' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'saaya_widgets_init' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register different widgets
 *
 * @since 1.0.1
 */
add_action( 'widgets_init', 'saaya_register_widgets' );

function saaya_register_widgets() {

	// Author Info
	register_widget( 'Saaya_Author_Info' );

	// Latest Posts
	register_widget( 'Saaya_Latest_Posts' );

	//Social Media
	register_widget( 'Saaya_Social_Media' );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load widget required files
 *
 * @since 1.0.0
 */

require get_template_directory() . '/inc/widgets/mt-widget-fields.php';    // Widget fields

require get_template_directory() . '/inc/widgets/mt-author-info.php';    // Author Info
require get_template_directory() . '/inc/widgets/mt-latest-posts.php';    // Latest Posts
require get_template_directory() . '/inc/widgets/mt-social-media.php';    // Social Media