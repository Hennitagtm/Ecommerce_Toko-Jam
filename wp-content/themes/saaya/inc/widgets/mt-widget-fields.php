<?php
/**
 * Define custom fields for widgets
 * 
 * @package Mystery Themes
 * @subpackage Saaya
 * @since 1.0.0
 */

function saaya_widgets_show_widget_field( $instance = '', $widget_field = '', $saaya_widget_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $saaya_widgets_field_type ) {

        /**
         * text widget field
         */
        case 'text'
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $saaya_widgets_name ) ); ?>"><?php echo esc_html( $saaya_widgets_title ); ?></label></span>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $saaya_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $saaya_widgets_name ) ); ?>" type="text" value="<?php echo esc_html( $saaya_widget_field_value ); ?>" />

                <?php if ( isset( $saaya_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $saaya_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * Select field
         */
        case 'select' :
            if( empty( $saaya_widget_field_value ) ) {
                $saaya_widget_field_value = $saaya_widgets_default;
            }

        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $saaya_widgets_name ) ); ?>"><?php echo esc_html( $saaya_widgets_title ); ?>:</label>
                <select name="<?php echo esc_attr( $instance->get_field_name( $saaya_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $saaya_widgets_name ) ); ?>" class="widefat">
                    <?php foreach ( $saaya_widgets_field_options as $select_option_name => $select_option_title ) { ?>
                        <option value="<?php echo esc_attr( $select_option_name ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $select_option_name ) ); ?>" <?php selected( $select_option_name, $saaya_widget_field_value ); ?>><?php echo esc_html( $select_option_title ); ?></option>
                    <?php } ?>
                </select>

                <?php if ( isset( $saaya_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $saaya_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * user dropdown widget field
         */
        case 'user_dropdown' :
            if( empty( $saaya_widget_field_value ) ) {
                $saaya_widget_field_value = $saaya_widgets_default;
            }
            $select_field = 'name="'. esc_attr( $instance->get_field_name( $saaya_widgets_name ) ) .'" id="'. esc_attr( $instance->get_field_id( $saaya_widgets_name ) ) .'" class="widefat"';
        ?>
                <p>
                    <label for="<?php echo esc_attr( $instance->get_field_id( $saaya_widgets_name ) ); ?>"><?php echo esc_html( $saaya_widgets_title ); ?>:</label>
                    <?php
                        $dropdown_args = wp_parse_args( array(
                            'show_option_none'  => __( '- - Select User - -', 'saaya' ),
                            'selected'          => esc_attr( $saaya_widget_field_value ),
                        ) );

                        $dropdown_args['echo'] = false;

                        $dropdown = wp_dropdown_users( $dropdown_args );
                        $dropdown = str_replace( '<select', '<select ' . $select_field, $dropdown );
                        echo $dropdown;
                    ?>
                </p>
        <?php
            break;

        /**
         * number widget field
         */
        case 'number' :
            if( empty( $saaya_widget_field_value ) ) {
                $saaya_widget_field_value = $saaya_widgets_default;
            }
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $saaya_widgets_name ) ); ?>"><?php echo esc_html( $saaya_widgets_title ); ?></label>
                <input name="<?php echo esc_attr( $instance->get_field_name( $saaya_widgets_name ) ); ?>" type="number" step="1" min="1" id="<?php echo esc_attr( $instance->get_field_id( $saaya_widgets_name ) ); ?>" value="<?php echo esc_html( $saaya_widget_field_value ); ?>" class="small-text" />

                <?php if ( isset( $saaya_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $saaya_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * upload file field
         */
        case 'upload':
            $image = $image_class = "";
            if( $saaya_widget_field_value ){ 
                $image = '<img src="'.esc_url( $saaya_widget_field_value ).'" style="max-width:100%;"/>';
                $image_class = ' hidden';
            }
            ?>
            <div class="attachment-media-view">

            <label for="<?php echo esc_attr( $instance->get_field_id( $saaya_widgets_name ) ); ?>"><?php echo esc_html( $saaya_widgets_title ); ?>:</label><br />
            
                <div class="placeholder<?php echo esc_attr( $image_class ); ?>">
                    <?php esc_html_e( 'No image selected', 'saaya' ); ?>
                </div>
                <div class="thumbnail thumbnail-image">
                    <?php echo $image; ?>
                </div>

                <div class="actions clearfix">
                    <button type="button" class="button mt-delete-button align-left"><?php esc_html_e( 'Remove', 'saaya' ); ?></button>
                    <button type="button" class="button mt-upload-button alignright"><?php esc_html_e( 'Select Image', 'saaya' ); ?></button>
                    
                    <input name="<?php echo esc_attr( $instance->get_field_name( $saaya_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $saaya_widgets_name ) ); ?>" class="upload-id" type="hidden" value="<?php echo esc_url( $saaya_widget_field_value ) ?>"/>
                </div>

            <?php if ( isset( $saaya_widgets_description ) ) { ?>
                <br />
                <small><?php echo wp_kses_post( $saaya_widgets_description ); ?></small>
            <?php } ?>

            </div>
            <?php
            break;

    }
}

function saaya_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );
    
    if ( $saaya_widgets_field_type == 'number') {
        return absint( $new_field_value );
    } elseif( $saaya_widgets_field_type == 'upload' ) {
        return esc_url( $new_field_value );
    } else {
        return sanitize_text_field( $new_field_value );
    }
}