<?php
/*
        Plugin Name: Paypal Donate Widget
        Plugin URI:
        Description: Paypal Donate
        Author: sirajus salayhin
        Version: 0.0.1
        Author URI: http://salayhin.info
        */
add_action('widgets_init', 'payd_load_widgets');

function payd_load_widgets()
{
    register_widget('Paypal_Donate');
}

class Paypal_Donate extends WP_Widget
{


    function Paypal_Donate()
    {

        $widget_ops = array('classname' => 'paypaldonate', 'description' => __('Paypal donate button with custom settings', 'paypaldonate'));


        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'paypal-donate-widget');


        $this->WP_Widget('paypal-donate-widget', __('Paypal Donate', 'paypaldonate'), $widget_ops, $control_ops);
    }


    function widget($args, $instance)
    {
        extract($args);

        $pp_email = apply_filters('widget_pp_email', $instance['pp_email']);
        $sname = $instance['sname'];

        $show_cc = isset($instance['show_cc']) ? $instance['show_cc'] : false;

        echo $before_widget;


        //	echo $before_title . "" . $after_title;


        if ($show_cc) {

            echo '
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="' . $pp_email . '">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="' . $sname . '">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" align="center">
</form>
';

        } else {

            echo '
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="' . $pp_email . '">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="' . $sname . '">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>
';

        }
        echo $after_widget;

    }


    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;


        $instance['pp_email'] = strip_tags($new_instance['pp_email']);
        $instance['sname'] = strip_tags($new_instance['sname']);


        $instance['show_cc'] = $new_instance['show_cc'];

        return $instance;
    }

    function form($instance)
    {

        $defaults = array('pp_email' => __('example@example.com', 'paypaldonate'), 'sname' => __('Your service name', 'paypaldonate'), 'show_cc' => true);
        $instance = wp_parse_args((array)$instance, $defaults); ?>

    <p>
        <label for="<?php echo $this->get_field_id('pp_email'); ?>"><?php _e('Paypal email:', 'hybrid'); ?></label>
        <input id="<?php echo $this->get_field_id('pp_email'); ?>"
               name="<?php echo $this->get_field_name('pp_email'); ?>" value="<?php echo $instance['pp_email']; ?>"
               style="width:100%;"/>
    </p>


    <p>
        <label
            for="<?php echo $this->get_field_id('sname'); ?>"><?php _e('Service Name/Organization:', 'paypaldonate'); ?></label>
        <input id="<?php echo $this->get_field_id('sname'); ?>" name="<?php echo $this->get_field_name('sname'); ?>"
               value="<?php echo $instance['sname']; ?>" style="width:100%;"/>
    </p>

    <p>
        <label
            for="<?php echo $this->get_field_id('show_cc'); ?>"><?php _e('Display credit cards?', 'paypaldonate'); ?></label>
        <input class="checkbox" type="checkbox" <?php checked($instance['show_cc'], true); ?>
               id="<?php echo $this->get_field_id('show_cc'); ?>"
               name="<?php echo $this->get_field_name('show_cc'); ?>"/>

    </p>

    <?php
    }
}


?>
