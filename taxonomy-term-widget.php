<?php
/*
Plugin Name: Taxonomy Term Widget
Plugin URI: http://www.santoshkunwar.com.np/taxonomy-term-widget/
Description: Add advanced widget to your wordpress blog,like an extension of Categories widget
Version: 1.0
Author: Santosh Kunwar
Author URI: http://www.santoshkunwar.com.np
*/
/*=======================Taxonomy term Widget==============================*/
class coder_taxonomy_term extends WP_Widget {
    function __construct() {
        parent::__construct(
        // Base ID of your widget
            'taxonomy_term_widget',
            // Widget name will appear in UI
            __('Taxonomy Term Widget', 'coder_taxonomy_term_domain'),
            // Widget description
            array( 'description' => __( 'Add advanced widget to your wordpress blog,like an extension of Categories widget', 'coder_taxonomy_term_domain' ), )
        );
    }
// Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'coder_taxonomy_term_domain' );
        }
        if ( isset( $instance[ 'taxonomy' ] ) ) {
            $selected_taxonomy = $instance[ 'taxonomy' ];
        }
        else {
            $selected_taxonomy = '';
        }
        if ( isset( $instance[ 'tax_is_display_dropdown' ] ) ) {
            $tax_is_display_dropdown = $instance[ 'tax_is_display_dropdown' ];
        }
        else {
            $tax_is_display_dropdown = '';
        }
        if ( isset( $instance[ 'tax_is_show_posts_count' ] ) ) {
            $tax_is_show_posts_count = $instance[ 'tax_is_show_posts_count' ];
        }
        else {
            $tax_is_show_posts_count = '';
        }
        if ( isset( $instance[ 'tax_is_show_hierarchy' ] ) ) {
            $tax_is_show_hierarchy = $instance[ 'tax_is_show_hierarchy' ];
        }
        else {
            $tax_is_show_hierarchy = '';
        }
        if ( isset( $instance[ 'tax_orderby' ] ) ) {
            $tax_orderby = $instance[ 'tax_orderby' ];
        }
        else {
            $tax_orderby = '';
        }
        if ( isset( $instance[ 'tax_order' ] ) ) {
            $tax_order = $instance[ 'tax_order' ];
        }
        else {
            $tax_order = '';
        }
        if ( isset( $instance[ 'tax_exclude' ] ) ) {
            $tax_exclude = $instance[ 'tax_exclude' ];
        }
        else {
            $tax_exclude = '';
        }
        if ( isset( $instance[ 'tax_hidempty' ] ) ) {
            $tax_hidempty = $instance[ 'tax_hidempty' ];
        }
        else {
            $tax_hidempty = '';
        }
        if ( isset( $instance[ 'tax_firstoption' ] ) ) {
            $tax_firstoption = $instance[ 'tax_firstoption' ];
        }
        else {
            $tax_firstoption = '';
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Enter title:' ,'coder_taxonomy_term_domain'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>

            <label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Select Taxonomy', 'coder_taxonomy_term_domain'); ?></label>
            <select name="<?php echo $this->get_field_name('taxonomy'); ?>" id="<?php echo $this->get_field_id('taxonomy'); ?>" class="widefat">
                <?php
                $taxonomies=get_taxonomies('','objects');
                foreach ($taxonomies as $taxonomy) {
                    echo '<option value="' . $taxonomy->name . '" id="' . $taxonomy->name . '"', $selected_taxonomy == $taxonomy->name ? ' selected="selected"' : '', '>', $taxonomy->labels->name, '</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('tax_is_display_dropdown'); ?>" name="<?php echo $this->get_field_name('tax_is_display_dropdown'); ?>" type="checkbox" value="1" <?php checked( '1', $tax_is_display_dropdown ); ?> />
            <label for="<?php echo $this->get_field_id('tax_is_display_dropdown'); ?>"><?php _e('Display as dropdown', 'wp_widget_plugin'); ?></label><br>

            <input id="<?php echo $this->get_field_id('tax_is_show_posts_count'); ?>" name="<?php echo $this->get_field_name('tax_is_show_posts_count'); ?>" type="checkbox" value="1" <?php checked( '1', $tax_is_show_posts_count ); ?> />
            <label for="<?php echo $this->get_field_id('tax_is_show_posts_count'); ?>"><?php _e('Show post counts', 'wp_widget_plugin'); ?></label><br>

            <input id="<?php echo $this->get_field_id('tax_is_show_hierarchy'); ?>" name="<?php echo $this->get_field_name('tax_is_show_hierarchy'); ?>" type="checkbox" value="1" <?php checked( '1', $tax_is_show_hierarchy ); ?> />
            <label for="<?php echo $this->get_field_id('tax_is_show_hierarchy'); ?>"><?php _e('Show hierarchy', 'wp_widget_plugin'); ?></label><br>

            <input id="<?php echo $this->get_field_id('tax_hidempty'); ?>" name="<?php echo $this->get_field_name('tax_hidempty'); ?>" type="checkbox" value="1" <?php checked( '1', $tax_hidempty ); ?> />
            <label for="<?php echo $this->get_field_id('tax_hidempty'); ?>"><?php _e('Hide empty', 'wp_widget_plugin'); ?></label><br>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tax_orderby'); ?>"><?php _e('Select Order By', 'coder_taxonomy_term_domain'); ?></label>
            <select name="<?php echo $this->get_field_name('tax_orderby'); ?>" id="<?php echo $this->get_field_id('tax_orderby'); ?>" class="widefat">
                <?php
                $options_orderby = array('ID', 'NAME', 'SLUG','COUNT');
                foreach ($options_orderby as $option_orderby) {
                echo '<option value="' . $option_orderby . '" id="' . $option_orderby . '"', $tax_orderby == $option_orderby ? ' selected="selected"' : '', '>', $option_orderby, '</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tax_order'); ?>"><?php _e('Select Order', 'coder_taxonomy_term_domain'); ?></label>
            <select name="<?php echo $this->get_field_name('tax_order'); ?>" id="<?php echo $this->get_field_id('tax_order'); ?>" class="widefat">
                <?php
                $options_order = array('ASC', 'DESC');
                foreach ($options_order as $option_order) {
                echo '<option value="' . $option_order . '" id="' . $option_order . '"', $tax_order == $option_order ? ' selected="selected"' : '', '>', $option_order, '</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'tax_exclude' ); ?>"><?php _e( 'Enter comma separated id/ids to exclude:' ,'coder_taxonomy_term_domain'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'tax_exclude' ); ?>" name="<?php echo $this->get_field_name( 'tax_exclude' ); ?>" type="text" value="<?php echo esc_attr( $tax_exclude ); ?>" placeholder="<?php _e( '1,25,9' ,'coder_taxonomy_term_domain'); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'tax_firstoption' ); ?>"><?php _e( 'Enter first option value to display only if you have checked- Display as dropdown' ,'coder_taxonomy_term_domain'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'tax_firstoption' ); ?>" name="<?php echo $this->get_field_name( 'tax_firstoption' ); ?>" type="text" value="<?php echo esc_attr( $tax_firstoption ); ?>" placeholder="<?php _e( 'Select option' ,'coder_taxonomy_term_domain'); ?>"/>
        </p>
    <?php
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['taxonomy'] = ( ! empty( $new_instance['taxonomy'] ) ) ? strip_tags( $new_instance['taxonomy'] ) : '';
        $instance['tax_is_display_dropdown'] = ( ! empty( $new_instance['tax_is_display_dropdown'] ) ) ? strip_tags( $new_instance['tax_is_display_dropdown'] ) : '';
        $instance['tax_is_show_posts_count'] = ( ! empty( $new_instance['tax_is_show_posts_count'] ) ) ? strip_tags( $new_instance['tax_is_show_posts_count'] ) : '';
        $instance['tax_is_show_hierarchy'] = ( ! empty( $new_instance['tax_is_show_hierarchy'] ) ) ? strip_tags( $new_instance['tax_is_show_hierarchy'] ) : '';
        $instance['tax_hidempty'] = ( ! empty( $new_instance['tax_hidempty'] ) ) ? strip_tags( $new_instance['tax_hidempty'] ) : '';
        $instance['tax_orderby'] = ( ! empty( $new_instance['tax_orderby'] ) ) ? strip_tags( $new_instance['tax_orderby'] ) : '';
        $instance['tax_order'] = ( ! empty( $new_instance['tax_order'] ) ) ? strip_tags( $new_instance['tax_order'] ) : '';
        $instance['tax_exclude'] = ( ! empty( $new_instance['tax_exclude'] ) ) ? strip_tags( $new_instance['tax_exclude'] ) : '';
        $instance['tax_firstoption'] = ( ! empty( $new_instance['tax_firstoption'] ) ) ? strip_tags( $new_instance['tax_firstoption'] ) : '';

        return $instance;
    }
// Creating widget front-end
// This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $taxonomy = $instance['taxonomy'];
        $tax_is_display_dropdown = $instance['tax_is_display_dropdown'];
        $tax_is_show_posts_count = $instance['tax_is_show_posts_count'];
        $tax_is_show_hierarchy = $instance['tax_is_show_hierarchy'];
        $tax_hidempty = $instance['tax_hidempty'];
        if(empty($tax_hidempty)) $tax_hidempty = 0;
        $tax_orderby = $instance['tax_orderby'];
        $tax_order = $instance['tax_order'];
        $tax_exclude = $instance['tax_exclude'];
        $tax_firstoption = $instance['tax_firstoption'];
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
        if( $tax_is_display_dropdown == 1){
            $args1 = array(
                'show_option_none'   => $tax_firstoption,
                'orderby'            => $tax_orderby,
                'order'              => $tax_order,
                'show_count'         => $tax_is_show_posts_count,
                'hide_empty'         => $tax_hidempty,
                'exclude'            => $tax_exclude,
                'echo'               => 1,
                'hierarchical'       => $tax_is_show_hierarchy,
                'name'               => 'coder_taxonomy',
                'id'                 => 'coder_taxonomy',
                'class'              => 'postform',
                'taxonomy'           => $taxonomy,
                'hide_if_empty'      => false,
            );
            ?>
            <?php wp_dropdown_categories($args1); ?>
            <script type="text/javascript"> <!--
                var dropdown = document.getElementById("coder_taxonomy");
                function onCatChange() {
                    if ( dropdown.options[dropdown.selectedIndex].value > '' ) {
                        location.href = "<?php echo get_option('home'); ?>/?<?php echo $taxonomy?>="+dropdown.options[dropdown.selectedIndex].value;
                    }
                }
                dropdown.onchange = onCatChange;
            </script>
        <?php
        }
        else{
            $args = array(
                'show_option_all'    => '',
                'orderby'            => $tax_orderby,
                'order'              => $tax_order,
                'style'              => 'list',
                'show_count'         => $tax_is_show_posts_count,
                'hide_empty'         => $tax_hidempty,
                'use_desc_for_title' => 1,
                'exclude'            => $tax_exclude,
                'hierarchical'       => $tax_is_show_hierarchy,
                'title_li'           => __( '' ),
                'show_option_none'   => __('No Terms'),
                'number'             => null,
                'echo'               => 1,
                'taxonomy'           => $taxonomy,
            );
            wp_list_categories( $args );
        }
        echo $args['after_widget'];
    }
} // Class coder_taxonomy_term ends here

// Register and load the widget
function coder_taxonomy_term_widget() {
    register_widget( 'coder_taxonomy_term' );
}
add_action( 'widgets_init', 'coder_taxonomy_term_widget' );