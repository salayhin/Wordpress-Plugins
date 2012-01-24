<?php
/*
        Plugin Name: Adsense Widget
        Plugin URI:
        Description: Easy Way to add adsence code
        Author: sirajus salayhin
        Version: 0.0.1
        Author URI: http://salayhin.info
        */
add_action('widgets_init', 'simpleadsense_load_widgets');

function simpleadsense_load_widgets()
{
    register_widget('Simple_Adsense');
}

class Simple_Adsense extends WP_Widget
{


    function Simple_Adsense()
    {

        $widget_ops = array('classname' => 'simpleadsense', 'description' => __('Adsense code settings', 'simpleadsense'));


        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'simple-adsense-widget');


        $this->WP_Widget('simple-adsense-widget', __('Simple Adsense', 'simpleadsense'), $widget_ops, $control_ops);
    }


    function widget($args, $instance)
    {
        extract($args);

        $adsense_code = apply_filters('widget_adsense_code', $instance['adsense_code']);

        echo $before_widget;

        echo $adsense_code;

        echo $after_widget;

    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['adsense_code'] = $new_instance['adsense_code'];

        return $instance;
    }

    function form($instance)
    {

        $defaults = array('adsense_code' => __('', 'simpleadsense'));
        $instance = wp_parse_args((array)$instance, $defaults);?>
    <p>
        <label for="<?php echo $this->get_field_id('adsense_code'); ?>"><?php _e('Adsense Code:', 'hybrid'); ?></label>
        <textarea id="<?php echo $this->get_field_id('adsense_code'); ?>"
                  name="<?php echo $this->get_field_name('adsense_code'); ?>" style="width:100%;"
                  rows="10"><?php echo $instance['adsense_code']; ?></textarea>
    </p><?php
    }
}

?>
