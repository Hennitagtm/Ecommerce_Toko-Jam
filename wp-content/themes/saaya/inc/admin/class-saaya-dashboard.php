<?php
/**
 * Saaya Dashboard
 *
 * @package saaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Saaya_Admin_Dashboard' ) ) :

    /**
     * Class Saaya_Admin_Main
     */
    class Saaya_Admin_Dashboard {

    	public $theme_name;
        public $theme_slug;
        public $theme_author_uri;
        public $theme_author_name;
        public $free_plugins;

       
        /**
         * Saaya_Admin_Dashboard constructor.
         */
        public function __construct() {

            global $admin_main_class;

            add_action( 'admin_menu', array( $this, 'saaya_admin_menu' ) );

            //theme details
            $theme                      = wp_get_theme();
            $this->theme_name           = $theme->get( 'Name' );
            $this->theme_slug           = $theme->get( 'TextDomain' );
            $this->theme_author_uri     = $theme->get( 'AuthorURI' );
            $this->theme_author_name    = $theme->get( 'Author' );
            $this->free_plugins = $admin_main_class->saaya_free_plugins_lists();
        }

        /**
         * Add admin menu.
         */
        public function saaya_admin_menu() {
            add_theme_page( sprintf( esc_html__( '%1$s Dashboard', 'saaya' ), $this->theme_name ), sprintf( esc_html__( '%1$s Dashboard', 'saaya' ), $this->theme_name ) , 'edit_theme_options', 'saaya-dashboard', array( $this, 'saaya_get_started_screen' ) );
        }

        public function saaya_get_started_screen() {
             $current_tab = empty( $_GET['tab'] ) ? 'saaya_welcome' : sanitize_title( $_GET['tab'] );

            // Look for a {$current_tab}_screen method.
            if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
                return $this->{ $current_tab . '_screen' }();
            }

            // Fallback to about screen.
            return $this->saaya_welcome_screen();
        }

        /**
         * Dashboard header
         *
         * @access private
         */
        private function saaya_dashboard_header() {
            ?>
            <div class="dashboard-header">
                <div class="saaya-container">
                    <div class="header-top">
                        <h1 class="heading"><?php printf( esc_html__( '%1$s Options', 'saaya' ), $this->theme_name ); ?></h1>
                        <span class="theme-version"><?php printf( esc_html__( 'Version: %1$s', 'saaya' ), SAAYA_VERSION ); ?></span>
                        <span class="author-link"><?php printf( wp_kses_post( 'By <a href="%1$s" target="_blank">%2$s</a>', 'saaya' ), $this->theme_author_uri, $this->theme_author_name ); ?></span>
                    </div><!-- .header-top -->
                    <div class="header-nav">
                        <nav class="dashboard-nav">
                            <li>
                                <a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'saaya-dashboard' ) echo 'active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'saaya-dashboard' ), 'themes.php' ) ) ); ?>">
                                    <span class="dashicons dashicons-admin-appearance"></span> <?php esc_html_e( 'Welcome', 'saaya' ); ?>
                                </a>
                            </li>
                            <li>
                                <a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'saaya_starter' ) echo 'active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'saaya-dashboard', 'tab' => 'saaya_starter' ), 'themes.php' ) ) ); ?>">
                                    <span class="dashicons dashicons-images-alt2"></span> <?php esc_html_e( 'Stater Sites', 'saaya' ); ?>
                                </a>
                            </li>
                             <li>
                                <a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'saaya_plugin' ) echo 'active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'saaya-dashboard', 'tab' => 'saaya_plugin' ), 'themes.php' ) ) ); ?>">
                                    <span class="dashicons dashicons-admin-plugins"></span> <?php esc_html_e( 'Plugin', 'saaya' ); ?>
                                </a>
                            </li>
                            <li>
                                <a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'saaya_free_pro' ) echo 'active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'saaya-dashboard', 'tab' => 'saaya_free_pro' ), 'themes.php' ) ) ); ?>">
                                    <span class="dashicons dashicons-dashboard"></span> <?php esc_html_e( 'Free Vs Pro', 'saaya' ); ?>
                                </a>
                            </li>
                            <li>
                                <a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'saaya_changelog' ) echo 'active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'saaya-dashboard', 'tab' => 'saaya_changelog' ), 'themes.php' ) ) ); ?>">
                                    <span class="dashicons dashicons-flag"></span> <?php esc_html_e( 'Changelog', 'saaya' ); ?>
                                </a>
                            </li>
                        </nav>
                        <div class="upgrade-pro">
                            <a href="<?php echo esc_url( 'https://mysterythemes.com/wp-themes/saaya-pro' ); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'More Features With Pro', 'saaya' ); ?></a>
                        </div><!-- .upgrade-pro -->
                    </div><!-- .header-nav -->
                </div><!-- .saaya-container -->
            </div><!-- .dashboard-header -->
        <?php
            }


        /**
         * Dashboard sidebar
         * 
         * @access private
         */
        private function saaya_dashboard_sidebar() {

            $review_url = 'https://wordpress.org/support/theme/'. $this->theme_slug .'/reviews/?filter=5#new-post';

        ?>
            <div class="sidebar-wrapper">
                <aside class="sidebar">
                    <div class="sidebar-block">
                        <h4 class="block-title"><?php esc_html_e( 'Leave us a reivew', 'saaya' ); ?></h4>
                        <p><?php printf( wp_kses_post( 'Are you are enjoying <b>%1$s</b>? We would love to hear your feedback.', 'saaya' ), $this->theme_name ); ?></p>
                        <a class="button button-primary" href="<?php echo esc_url( $review_url ); ?>" target="_blank" rel="external noopener noreferrer">
                            <?php esc_html_e( 'Submit a review', 'saaya' ); ?>
                            <span class="dashicons dashicons-external"></span>
                        </a>
                    </div><!-- .sidebar-block -->
                </aside>
            </div><!-- .sidebar-wrapper -->
            <?php
            }

        /**
         * render the welcome screen.
         */
        public function saaya_welcome_screen() {
            $doc_url        = 'https://docs.mysterythemes.com/saaya';
            $support_url    = 'https://wordpress.org/support/theme/'.$this->theme_slug;
            ?>
            <div id="saaya-dashboard">
                <?php $this->saaya_dashboard_header(); ?>
                <div class="dashboard-content-wrapper">
                    <div class="saaya-container">
                        
                        <div class="main-content welcome-content-wrapper">
                            
                            <div class="welcome-block quick-links">
                                <div class="block-header">
                                    <img class="block-icon" src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/assets/img/quick-link.svg' ); ?>" alt="icon">
                                    <h3 class="block-title"><?php esc_html_e( 'Customizer quick link', 'saaya' ); ?></h3>
                                </div><!-- .block-header -->
                                <div class="block-content content-column">
                                    <div class="col">
                                        <li>
                                            <a href="<?php echo esc_url( admin_url( 'customize.php' ).'?autofocus[section]=title_tagline' ); ?>" target="_blank" class="welcome-icon"><span class="dashicons dashicons-visibility"></span><?php esc_html_e( 'Setup site logo', 'saaya' ); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo esc_url( admin_url( 'customize.php' ).'?autofocus[section]=saaya_section_social_icons' ); ?>" target="_blank" class="welcome-icon"> <span class="dashicons dashicons-networking"> </span><?php esc_html_e( 'Social Icons', 'saaya' ); ?></a>
                                        </li>
                                    </div>
                                    <div class="col">
                                        <li>
                                            <a href="<?php echo esc_url( admin_url( 'customize.php' ).'?autofocus[panel]=saaya_design_panel' ); ?>" target="_blank" class="welcome-icon"><span class="dashicons dashicons-media-document"> </span><?php esc_html_e( 'Design Settings', 'saaya' ); ?></a>
                                        </li>
                                         <li>
                                            <a href="<?php echo esc_url( admin_url( 'customize.php' ).'?autofocus[panel]=saaya_footer_panel' ); ?>" target="_blank" class="welcome-icon"> <span class="dashicons dashicons-slides"> </span> <?php esc_html_e( 'Footer Setting', 'saaya' ); ?></a>
                                        </li>
                                    </div>
                                </div><!-- .block-content -->
                            </div><!-- .welcome-block.quick-links -->

                            <div class="welcome-block documentation">
                                <div class="block-header">
                                    <img class="block-icon" src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/assets/img/docs.svg' ); ?>" alt="icon">
                                    <h3 class="block-title"><?php esc_html_e( 'Theme Documentation', 'saaya' ); ?></h3>
                                </div><!-- .block-header -->
                                <div class="block-content">
                                    <p>
                                        <?php printf( wp_kses_post( 'Need more details? Please check our full documentation for detailed information on how to use <b>%1$s</b>.', 'saaya' ), $this->theme_name ); ?>
                                        <a href="<?php echo esc_url( $doc_url ); ?>" target="_blank"><?php esc_html_e( 'Go to doc', 'saaya' ); ?><span class="dashicons dashicons-external"></span></a>
                                    </p>
                                </div><!-- .block-content -->
                            </div><!-- .welcome-block documentation -->

                            <div class="welcome-block support">
                                <div class="block-header">
                                    <img class="block-icon" src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/assets/img/support.svg' ); ?>" alt="icon">
                                    <h3 class="block-title"><?php esc_html_e( 'Contact Support', 'saaya' ); ?></h3>
                                </div><!-- .block-header -->
                                <div class="block-content">
                                    <p>
                                        <?php printf( wp_kses_post( 'We want to make sure you have the best experience using <b>%1$s</b>, and that is why we have gathered all the necessary information here for you. We hope you will enjoy using <b>%1$s</b> as much as we enjoy creating great products.', 'saaya' ), $this->theme_name ); ?>
                                        <a href="<?php echo esc_url( $support_url ); ?>" target="_blank"><?php esc_html_e( 'Contact Support', 'saaya' ); ?><span class="dashicons dashicons-external"></span></a>
                                    </p>
                                </div><!-- .block-content -->
                            </div><!-- .welcome-block support -->

                            <div class="welcome-block tutorial">
                                <div class="block-header">
                                    <img class="block-icon" src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/assets/img/tutorial.svg' ); ?>" alt="icon">
                                    <h3 class="block-title"><?php esc_html_e( 'Tutorial', 'saaya' ); ?></h3>
                                </div><!-- .block-header -->
                                <div class="block-content">
                                    <p>
                                        <?php printf( wp_kses_post( 'This tutorial has been prepared for those who have a basic knowledge of HTML and CSS and has an urge to develop websites. After completing this tutorial, you will find yourself at a moderate level of expertise in developing sites or blogs using WordPress.', 'saaya' ), $this->theme_name ); ?>
                                        <a href="<?php echo esc_url( 'https://wpallresources.com/' ); ?>" target="_blank"><?php esc_html_e( 'WP Tutorials', 'saaya' ); ?><span class="dashicons dashicons-external"></span></a>
                                    </p>
                                </div><!-- .block-content -->
                            </div><!-- .welcome-block tutorial -->

                            <div class="return-to-dashboard">
                                <?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
                                    <a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
                                        <?php is_multisite() ? esc_html_e( 'Return to Updates', 'saaya' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'saaya' ); ?>
                                    </a> |
                                <?php endif; ?>
                                <a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'saaya' ) : esc_html_e( 'Go to Dashboard', 'saaya' ); ?></a>
                            </div><!-- .return-to-dashboard -->

                        </div><!-- .welcome-content-wrapper -->

                        <?php $this->saaya_dashboard_sidebar(); ?>

                    </div><!-- .saaya-container -->
                </div><!-- .dashboard-content-wrapper -->
            </div><!-- #saaya-dashboard -->
        <?php
        }

        /**
         * render the starter sites screen
         */
        public function saaya_starter_screen() {
            global $admin_main_class;

            $is_child_theme     = is_child_theme();
            $activated_theme    = get_template();
            $parent_theme       = get_template();

            $demodata           = get_transient( 'saaya_demo_packages' );
            
            if ( empty( $demodata ) || $demodata == false ) {
                $demodata = get_transient( 'mtdi_theme_packages' );
                if ( $demodata ) {
                    set_transient( 'saaya_demo_packages', $demodata, WEEK_IN_SECONDS );
                }
            }

            $activated_demo_check   = get_option( 'mtdi_activated_check' );

            ?>
            <div id="saaya-dashboard">
                <?php $this->saaya_dashboard_header(); ?>
                <div class="dashboard-content-wrapper starter-dashboard-content-wrapper">
                    <div class="saaya-container">

                        <div class="main-content starter-content-wrapper">
                            <div class="saaya-theme-demos rendered <?php if( isset( $demodata ) && empty( $demodata ) ) echo "no-demo-sites" ?>">
                                <?php 
                                $admin_main_class->saaya_install_demo_import_plugin_popup(); 
                                ?>
                                <div class="demo-listing-wrapper wp-clearfix">
                                    <?php if ( isset( $demodata ) && empty( $demodata ) ) { ?>
                                        <span class="configure-msg"><?php esc_html_e( 'No demos are configured for this theme, please contact the theme author', 'saaya' ); ?></span>
                                    <?php
                                        } else {
                                    ?>
                                        <div class="all-demos-wrap">
                                            <?php

                                                // List child theme demo if exists
                                                if ( $is_child_theme ) {
                                                    $is_child_exists = ( isset( $demodata[$parent_theme]['is_child_exists'] ) ) ? $demodata[$parent_theme]['is_child_exists'] : false;
                                                    if ( isset( $is_child_exists ) && $is_child_exists ) {
                                                        $child_theme_demodatas  = $demodata[$parent_theme]['child_themes'];
                                                        foreach( $child_theme_demodatas as $child_theme_value ) {
                                                            $theme_name         = $child_theme_value['name'];
                                                            $theme_slug         = $child_theme_value['theme_slug'];
                                                            $preview_screenshot = $child_theme_value['preview_screen'];
                                                            $demourl            = $child_theme_value['preview_url'];
                                                            if ( ( strpos( $activated_theme, 'pro' ) !== false && strpos( $theme_slug, 'pro' ) !== false ) || ( strpos( $activated_theme, 'pro' ) == false ) ) {
                                                        ?>
                                                                <div class="single-demo<?php if  ( strpos( $activated_theme, 'pro' ) == false && strpos( $theme_slug, 'pro' ) !== false ) { echo ' pro-demo'; } ?>" data-categories="ltrdemo" data-name="<?php echo esc_attr ( $theme_slug ); ?>" style="display: block;">
                                                                    <div class="preview-screenshot">
                                                                        <a href="<?php echo esc_url ( $demourl ); ?>" target="_blank">
                                                                            <img class="preview" src="<?php echo esc_url ( $preview_screenshot ); ?>" />
                                                                        </a>
                                                                    </div><!-- .preview-screenshot -->
                                                                    <div class="demo-info-wrapper">
                                                                        <h2 class="mtdi-theme-name theme-name" id="nokri-name"><?php echo esc_html ( $theme_name ); ?></h2>
                                                                        <div class="mtdi-theme-actions theme-actions">
                                                                            <?php
                                                                                if ( $activated_demo_check != '' && $activated_demo_check == $theme_slug ) {
                                                                            ?>
                                                                                    <a class="button disabled button-primary hide-if-no-js" href="javascript:void(0);" data-name="<?php echo esc_attr ( $theme_name ); ?>" data-slug="<?php echo esc_attr ( $theme_slug ); ?>" aria-label="<?php printf ( esc_html__( 'Imported %1$s', 'saaya' ), $theme_name ); ?>">
                                                                                        <?php esc_html_e( 'Imported', 'saaya' ); ?>
                                                                                    </a>
                                                                            <?php
                                                                                } else {
                                                                                    if ( is_plugin_active( 'mysterythemes-demo-importer/mysterythemes-demo-importer.php' ) ) {
                                                                                        $button_tooltip = esc_html__( 'Click to import demo', 'saaya' );
                                                                                    } else {
                                                                                        $button_tooltip = esc_html__( 'Demo importer plugin is not installed or activated', 'saaya' );
                                                                                    }
                                                                            ?>
                                                                                    <a title="<?php echo esc_attr( $button_tooltip ); ?>" class="button button-primary hide-if-no-js mtdi-demo-import" href="javascript:void(0);" data-name="<?php echo esc_attr ( $theme_name ); ?>" data-slug="<?php echo esc_attr ( $theme_slug ); ?>" aria-label="<?php printf ( esc_attr__( 'Import %1$s', 'saaya' ), $theme_name ); ?>">
                                                                                        <?php esc_html_e( 'Import', 'saaya' ); ?>
                                                                                    </a>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                            <a class="button preview install-demo-preview" target="_blank" href="<?php echo esc_url ( $demourl ); ?>">
                                                                                <?php esc_html_e( 'View Demo', 'saaya' ); ?>
                                                                            </a>
                                                                        </div><!-- .mtdi-theme-actions -->
                                                                    </div><!-- .demo-info-wrapper -->
                                                                </div><!-- .single-demo -->
                                                        <?php
                                                            }
                                                        }
                                                    }
                                                } // Endif ( $is_child_theme )

                                                foreach ( $demodata as $value ) {
                                                    $theme_name         = $value['name'];
                                                    $theme_slug         = $value['theme_slug'];
                                                    $preview_screenshot = $value['preview_screen'];
                                                    $demourl            = $value['preview_url'];
                                                    if ( ( strpos( $activated_theme, 'pro' ) !== false && strpos( $theme_slug, 'pro' ) !== false ) || ( strpos( $activated_theme, 'pro' ) == false ) ) {
                                            ?>
                                                        <div class="single-demo<?php if ( strpos( $activated_theme, 'pro' ) == false && strpos( $theme_slug, 'pro' ) !== false ) { echo ' pro-demo'; } ?>" data-categories="ltrdemo" data-name="<?php echo esc_attr ( $theme_slug ); ?>" style="display: block;">
                                                            <div class="preview-screenshot">
                                                                <a href="<?php echo esc_url ( $demourl ); ?>" target="_blank">
                                                                    <img class="preview" src="<?php echo esc_url ( $preview_screenshot ); ?>" />
                                                                </a>
                                                            </div><!-- .preview-screenshot -->
                                                            <div class="demo-info-wrapper">
                                                                <h2 class="mtdi-theme-name theme-name" id="nokri-name"><?php echo esc_html ( $theme_name ); ?></h2>
                                                                <div class="mtdi-theme-actions theme-actions">
                                                                    <?php
                                                                        if ( $activated_demo_check != '' && $activated_demo_check == $theme_slug ) {
                                                                    ?>
                                                                            <a class="button disabled button-primary hide-if-no-js" href="javascript:void(0);" data-name="<?php echo esc_attr ( $theme_name ); ?>" data-slug="<?php echo esc_attr ( $theme_slug ); ?>" aria-label="<?php printf ( esc_html__( 'Imported %1$s', 'saaya' ), $theme_name ); ?>">
                                                                                <?php esc_html_e( 'Imported', 'saaya' ); ?>
                                                                            </a>
                                                                    <?php
                                                                        } else {
                                                                            if ( strpos( $activated_theme, 'pro' ) == false && strpos( $theme_slug, 'pro' ) !== false ) {
                                                                                $s_slug = explode( "-pro", $theme_slug );
                                                                                $purchaseurl = 'https://mysterythemes.com/wp-themes/'.$s_slug[0].'-pro';
                                                                    ?>
                                                                                <a class="button button-primary mtdi-purchasenow" href="<?php echo esc_url( $purchaseurl ); ?>" target="_blank" data-name="<?php echo esc_attr ( $theme_name ); ?>" data-slug="<?php echo esc_attr ( $theme_slug ); ?>" aria-label="<?php printf ( esc_html__( 'Purchase Now', 'saaya' ), $theme_name ); ?>">
                                                                                    <?php esc_html_e( 'Buy Now', 'saaya' ); ?>
                                                                                </a>
                                                                    <?php
                                                                            } else {
                                                                                if ( is_plugin_active( 'mysterythemes-demo-importer/mysterythemes-demo-importer.php' ) ) {
                                                                                    $button_tooltip = esc_html__( 'Click to import demo', 'saaya' );
                                                                                } else {
                                                                                    $button_tooltip = esc_html__( 'Demo importer plugin is not installed or activated', 'saaya' );
                                                                                }
                                                                    ?>
                                                                                <a title="<?php echo esc_attr( $button_tooltip ); ?>" class="button button-primary hide-if-no-js mtdi-demo-import" href="javascript:void(0);" data-name="<?php echo esc_attr ( $theme_name ); ?>" data-slug="<?php echo esc_attr ( $theme_slug ); ?>" aria-label="<?php printf ( esc_attr__( 'Import %1$s', 'saaya' ), $theme_name ); ?>">
                                                                                    <?php esc_html_e( 'Import', 'saaya' ); ?>
                                                                                </a>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                        <a class="button preview install-demo-preview" target="_blank" href="<?php echo esc_url ( $demourl ); ?>">
                                                                            <?php esc_html_e( 'View Demo', 'saaya' ); ?>
                                                                        </a>
                                                                </div><!-- .mtdi-theme-actions -->
                                                            </div><!-- .demo-info-wrapper -->
                                                        </div><!-- .single-demo -->
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div><!-- .mtdi-demo-wrapper -->
                                <?php
                                    }
                                ?>
                                </div><!-- .demo-listing-wrapper -->

                            </div><!-- .saaya-theme-demos -->

                        </div><!-- .starter-content-wrapper -->
                    </div><!-- .saaya-container -->
                </div><!-- .dashboard-content-wrapper -->
            </div><!-- #saaya-dashboard -->
    <?php
        }

        /**
         * render the free vs pro screen
         */
        public function saaya_free_pro_screen() {
    ?>
            <div id="saaya-dashboard">
                <?php $this->saaya_dashboard_header(); ?>
                <div class="dashboard-content-wrapper">
                    <div class="saaya-container">

                        <div class="main-content free-pro-content-wrapper">
                            
                            <table class="compare-table">
                                <thead>
                                    <tr>
                                        <th class="table-feature-title"><h3><?php esc_html_e( 'Features', 'saaya' ); ?></h3></th>
                                        <th><h3><?php echo esc_html( $this->theme_name ); ?></h3></th>
                                        <th><h3><?php esc_html_e( 'Saaya Pro', 'saaya' ); ?></h3></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><h3><?php esc_html_e( 'Price', 'saaya' ); ?></h3></td>
                                        <td><?php esc_html_e( 'Free', 'saaya' ); ?></td>
                                        <td><?php esc_html_e( '$59.99', 'saaya' ); ?></td>
                                    </tr>
                                    <tr>
                                        <td><h3><?php esc_html_e( 'Import Demo Data', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                    </tr>
                                     <tr>
                                        <td><h3><?php esc_html_e( 'Multiple Layouts', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-no-alt"></span></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                    </tr>
                                    <tr>
                                        <td><h3><?php esc_html_e( 'WooCommerce Plugin Compatible', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                    </tr>
                                     <tr>
                                        <td><h3><?php esc_html_e( 'Header Layouts', 'saaya' ); ?></h3></td>
                                        <td><?php esc_html_e( '1', 'saaya' ); ?></td>
                                        <td><?php esc_html_e( '4', 'saaya' ); ?></td>
                                    </tr>
                                     <tr>
                                        <td><h3><?php esc_html_e( 'Google Fonts', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-no-alt"></span></td>
                                        <td><?php esc_html_e( '600+', 'saaya' ); ?></td>
                                    </tr>                
                                    <tr>
                                        <td><h3><?php esc_html_e( 'Typography Options', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-no-alt"></span></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                    </tr>
                                    <tr>
                                        <td><h3><?php esc_html_e( 'CSS3 Animation', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-no-alt"></span></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                    </tr>
                                    <tr>
                                        <td><h3><?php esc_html_e( 'Custom 404 Page', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-no-alt"></span></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                    </tr>
                                    <tr>
                                        <td><h3><?php esc_html_e( 'Footer Layout Option', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-no-alt"></span></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                    </tr>
                                     <tr>
                                        <td><h3><?php esc_html_e( 'Slider Option', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-no-alt"></span></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                    </tr>
                                     <tr>
                                        <td><h3><?php esc_html_e( 'Footer Widget Area', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                    </tr>
                                    <tr>
                                        <td><h3><?php esc_html_e( 'WordPress Page Builder Compatible', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                    </tr>
                                    <tr>
                                        <td><h3><?php esc_html_e( 'GDPR Compatible', 'saaya' ); ?></h3></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                        <td><span class="dashicons dashicons-yes"></span></td>
                                    </tr>
                                   
                                    <tr>
                                        <td><?php esc_html_e( 'Get access to all Pro features and power-up your website', 'saaya' ); ?></td>
                                        <td></td>
                                        <td class="btn-wrapper">
                                        <a href="<?php echo esc_url( apply_filters( 'saaya_pro_theme_url', 'https://mysterythemes.com/wp-themes/saaya-pro' ) ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Buy Pro', 'saaya' ); ?></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div><!-- .free-pro-content-wrapper -->

                        <?php $this->saaya_dashboard_sidebar(); ?>

                    </div><!-- .saaya-container -->
                </div><!-- .dashboard-content-wrapper -->
            </div><!-- #saaya-dashboard -->
    <?php
        }
        
        /**
         * render the changelog screen
         */
        public function saaya_changelog_screen() {

            global $admin_main_class;

            if ( ! is_child_theme() ) {
                $changelogFilePath = get_template_directory() . '/changelog.txt';
            } else {
                $changelogFilePath = get_stylesheet_directory() . '/changelog.txt';
            }

            $get_changelog = $admin_main_class->get_changelog( $changelogFilePath );

            ?>
            <div id="saaya-dashboard">
                <?php $this->saaya_dashboard_header(); ?>
                <div class="dashboard-content-wrapper">
                    <div class="changelog-top-wrapper">
                        <ul class="saaya-container">
                            <li>
                                <span class="new"><?php esc_html_e( 'N', 'saaya' ); ?></span>
                                <?php esc_html_e( 'New', 'saaya' ); ?>
                            </li>
                            <li>
                                <span class="improvement"><?php esc_html_e( 'I', 'saaya' ); ?></span>
                                <?php esc_html_e( 'Improvement', 'saaya' ); ?>
                            </li>
                            <li>
                                <span class="fixed"><?php esc_html_e( 'F', 'saaya' ); ?></span>
                                <?php esc_html_e( 'Fixed', 'saaya' ); ?>
                            </li>
                            <li>
                                <span class="tweak"><?php esc_html_e( 'T', 'saaya' ); ?></span>
                                <?php esc_html_e( 'Tweak', 'saaya' ); ?>
                            </li>
                        </ul>
                    </div><!-- .changelog-top-wrapper -->
                    <div class="saaya-container">
                        <div class="changelog-content-wrapper">
                            <?php
                                foreach( $get_changelog as $log ) {
                            ?>
                                    <section class="changelog-block">
                                        <div class="block-top">
                                            <span class="block-version"><?php printf( esc_html__( 'Version: %1$s', 'saaya' ), $log['version'] ); ?></span>
                                            <span class="block-date"><?php printf( esc_html__( 'Released on: %1$s', 'saaya' ), $log['date'] ); ?></span>
                                        </div><!-- .block-top -->
                                        <div class="block-content">
                                            <ul>
                                                <?php
                                                    // loop for new 
                                                    if ( ! empty( $log['new'] ) ) {
                                                        foreach( $log['new'] as $note ) {
                                                            echo '<li><span class="new" title="New">N</span>'. esc_html( $note ) .'</li>';
                                                        }
                                                    }
                                                    
                                                    // loop for improvement
                                                    if ( ! empty( $log['imp'] ) ) {
                                                        foreach( $log['imp'] as $note ) {
                                                            echo '<li><span class="improvement" title="Improvement">I</span>'. esc_html( $note ) .'</li>';
                                                        }
                                                    }

                                                    // loop for fixed
                                                    if ( ! empty( $log['fix'] ) ) {
                                                        foreach( $log['fix'] as $note ) {
                                                            echo '<li><span class="fixed" title="Fixed">F</span>'. esc_html( $note ) .'</li>';
                                                        }
                                                    }

                                                    // loop for tweak
                                                    if ( ! empty( $log['tweak'] ) ) {
                                                        foreach( $log['tweak'] as $note ) {
                                                            echo '<li><span class="tweak" title="Tweak">T</span>'. esc_html( $note ) .'</li>';
                                                        }
                                                    }
                                                ?>
                                            </ul>
                                        </div><!-- .block-content -->
                                    </section><!-- .changelog-block -->
                            <?php
                                }
                            ?>
                        </div><!-- .changelog-content-wrapper -->

                        <?php $this->saaya_dashboard_sidebar(); ?>

                    </div><!-- .saaya-container -->
                </div><!-- .dashboard-content-wrapper -->
            </div><!-- #saaya-dashboard -->
    <?php
        }

        /**
         * render the plugin screen
         */
        public function saaya_plugin_screen() {

            global $admin_main_class;

            $free_plugins = $this->free_plugins;
            ?>
            <div id="saaya-dashboard">
                <?php $this->saaya_dashboard_header(); ?>
                <div class="dashboard-content-wrapper">
                    <div class="saaya-container">

                        <div class="plugin-content-wrapper">
                            <div class="header-content">
                                <h3><?php esc_html_e( 'Recommended Free Plugins', 'saaya' ); ?></h3>
                                <p><?php esc_html_e( 'These Free Plugins might be handy for you.', 'saaya' ); ?></p>
                            </div><!-- .header-content -->
                            <div class="plugin-listing">
                                <?php
                                    foreach( $free_plugins as $key => $value ) {

                                        switch( $value['action'] ) {
                                            case 'install' :
                                                $btn_class  = 'mt-action-btn install-online button';
                                                $label      = esc_html__( 'Install and Activate', 'saaya' );
                                                break;

                                            case 'inactive' :
                                                $btn_class  = 'mt-action-btn deactivate-online button disabled';
                                                $label      = esc_html__( 'Deactivate', 'saaya' );
                                                break;

                                            case 'active' :
                                                $btn_class  = 'mt-action-btn activate-online button button-primary';
                                                $label      = esc_html__( 'Activate', 'saaya' );
                                                break;
                                        }
                                ?>
                                        <div class="single-plugin-wrap">
                                            <div class="plugin-thumb-wrap">
                                                <div class="plugin-thumb">
                                                    <?php
                                                        if ( ! empty( $value['icon_url'] ) ) {
                                                            echo '<img src="'. esc_url( $value['icon_url'] ) .'" />';
                                                        }
                                                    ?>
                                                </div>
                                            </div><!-- .plugin-thumb-wrap -->
                                            <div class="plugin-content-wrap">
                                                <h4 class="plugin-name"><?php echo esc_html( $value['name'] ); ?></h4>
                                                <div class="plugin-meta-wrap">
                                                    <span class="version"><?php printf( esc_html__( 'Version %1$s', 'saaya' ), $value['version'] ); ?></span>
                                                    <span class="seperator">|</span>
                                                    <span class="author"><?php echo wp_kses_post( $value['author'] ); ?></span><br>
                                                    <span class="description"><?php echo wp_kses_post( $value['description'] ); ?></span>

                                                </div><!-- .plugin-meta-wrap -->
                                                <div class="plugin-button-wrap plugin-card-<?php echo esc_attr( $value['slug'] ); ?>">
                                                    <button class="<?php echo esc_attr( $btn_class ); ?>" data-status = <?php echo esc_attr( $value['action'] ); ?> data-slug="<?php echo esc_attr( $value['slug'] ); ?>" data-redirect="<?php echo esc_url( admin_url( 'themes.php' ).'?page=saaya-dashboard&tab=saaya_plugin' ); ?>"><?php echo esc_html( $label ); ?></button>
                                                </div><!-- .plugin-button-wrap -->
                                            </div><!-- .plugin-content-wrap -->
                                        </div><!-- .single-plugin-wrap -->
                                <?php
                                    }
                                ?>
                            </div><!-- .plugin-listing -->
                        </div><!-- .plugin-content-wrapper -->

                        <?php $this->saaya_dashboard_sidebar(); ?>

                    </div><!-- .saaya-container -->
                </div><!-- .dashboard-content-wrapper -->
            </div><!-- #saaya-dashboard -->
    <?php
        }
    }

    new Saaya_Admin_Dashboard();

endif;
