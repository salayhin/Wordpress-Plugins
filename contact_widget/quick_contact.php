<?php
/*
        Plugin Name: Contact Widget
        Plugin URI:
        Description: WP Contact Widget
        Author: sirajus salayhin
        Version: 0.0.1
        Author URI: http://salayhin.info
        */

add_action('widgets_init', 'quickcontact_load_widgets');

function quickcontact_load_widgets()
{
    register_widget('Quick_Contact');
}

class Quick_Contact extends WP_Widget
{


    function Quick_Contact()
    {

        $widget_ops = array('classname' => 'quickcontact', 'description' => __('Quick Contact settings', 'quickcontact'));


        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'quick-contact-widget');


        $this->WP_Widget('quick-contact-widget', __('Quick Contact', 'quickcontact'), $widget_ops, $control_ops);
    }


    function widget($args, $instance)
    {
        extract($args);

        $quick_contact_email = apply_filters('widget_quick_contact_email', $instance['quick_contact_email']);

        echo $before_widget;

        echo $before_title . "Quick Contact" . $after_title;

        if (isset($_POST['c_check'])) {


            $c_name = $_POST['c_name'];
            $c_subject = $_POST['c_subject'];
            $c_body = $_POST['c_body'] . ' From: ' . $c_name;

            $c_send = wp_mail($quick_contact_email, $c_subject, $c_body);
            if ($c_send) {
                echo 'Message sent';
            }
        } else {
            echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">
		Name<br /><input type="text" name="c_name" />
		<br />Subject<br /><input type="text" name="c_subject" />
		<br />Body<br /><textarea name="c_body"></textarea>
		<input type="hidden" name="c_check" />
		<br /><input type="submit" name="c_submit" value="Send" />
		</form>';
        }
        echo $after_widget;

    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['quick_contact_email'] = $new_instance['quick_contact_email'];

        return $instance;
    }

    function form($instance)
    {

        $defaults = array('quick_contact_email' => __('', 'quickcontact'));
        $instance = wp_parse_args((array)$instance, $defaults);?>
    <p>
        <label
            for="<?php echo $this->get_field_id('quick_contact_email'); ?>"><?php _e('Enter E-mail:', 'hybrid'); ?></label>
        <input type="text" id="<?php echo $this->get_field_id('quick_contact_email'); ?>"
               name="<?php echo $this->get_field_name('quick_contact_email'); ?>" style="width:100%;"
               value="<?php echo $instance['quick_contact_email']; ?>"/>
    </p><?php
    }
}

?>
