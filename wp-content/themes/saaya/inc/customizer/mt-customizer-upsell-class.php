<?php
/**
 * Class to render the Upsell Button.
 *
 * @package Mystery Themes
 * @subpackage Saaya
 * @since 1.0.0
 * 
/*-----------------------------------------------------------------------------------------------------------------------*/
    
    /**
     * Upsell customizer section.
     *
     * @access public
     */
    class Saaya_Customize_Section_Upsell extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'mt-upsell';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_url = '';

        

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();
            
            $json['pro_url']  = esc_url( $this->pro_url );
            

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() { ?>

            <li id="accordion-section-{{ data.id }}" class="saaya-upsell-accordion-section control-section control-section-{{ data.type }} cannot-expand">
                <h3 class="accordion-section-title"><a href="{{ data.pro_url }}" target="_blank">{{ data.title }}</a> </h3>
            </li>
        <?php }
    } // end Saaya_Customize_Section_Upsell