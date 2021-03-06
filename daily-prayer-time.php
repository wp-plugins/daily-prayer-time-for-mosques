<?php
/*
Plugin Name: Daily Prayer Time
Version: 1.0
Plugin URI: https://wordpress.org/plugins/daily-prayer-time-for-mosques/
Description: Show daily prayer time vertically or horizontally
Author: mmrs151
Author URI: http://mmrs151.tumblr.com/
*/
include 'timetable.php';

class DailyPrayerTime extends WP_Widget
{
    public function __construct()
    {
        $widget_details = array(
            'className' => 'DailyPrayerTime',
            'description' => 'Show daily prayer time vertically or horizontally'
        );
        $this->add_stylesheet();
        $this->timeTable = new TimeTable();

        parent::__construct('DailyPrayerTime', 'Daily Prayer Time', $widget_details);
    }

    public function form($instance)
    {
        ?>

        <div>
            <span>
            </br></br>
                <input
                    type="checkbox"
                    name="<?php echo $this->get_field_name( 'jamahOnly' ); ?>"
                    value="jamahOnly"
                    <?php if($instance["jamahOnly"] === 'jamahOnly'){ echo 'checked="checked"'; } ?>
                />Display Jamah time only</br></br>
                <input
                    type="checkbox"
                    name="<?php echo $this->get_field_name( 'hanafiAsr' ); ?>"
                    value="hanafiAsr"
                    <?php if($instance["hanafiAsr"] === 'hanafiAsr'){ echo 'checked="checked"'; } ?>
                />Display Asr start time according to Hanafi school</br></br>
                <input
                    type="checkbox"
                    name="<?php echo $this->get_field_name( 'choice' ); ?>"
                    value="vertical"
                    <?php if($instance["choice"] === 'vertical'){ echo 'checked="checked"'; } ?>
                />Display prayer time vertically</br></br>
            </span>
        </div>

        <div class='mfc-text'>
        </div>

        <?php

        echo $args['after_widget'];
        echo "<a href='http://edgwareict.org.uk/' target='_blank'>Donate for the plugin</a></br></br>";
    }

    public function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    public function widget($args, $instance)
    {
        echo $before_widget;

        if (! empty($instance['jamahOnly'])) {
            $this->timeTable->setJamahOnly();
        }

        if (! empty($instance['hanafiAsr'])) {
            $this->timeTable->setHanafiAsr();
        }

        if ($instance['choice'] === 'vertical') {
            echo $this->timeTable->verticalTime();
        } else {
            echo $this->timeTable->horizontalTime();
        }
    }

    public function add_stylesheet() {
          // Respects SSL, Style.css is relative to the current file
          wp_register_style( 'timetable-style', plugins_url('styles.css', __FILE__) );
          wp_enqueue_style( 'timetable-style' );
    }
}


add_action('widgets_init', 'init_my_widget');

function init_my_widget()
{
    register_widget('DailyPrayerTime');
}

add_action( 'admin_menu', function (){
    add_menu_page (
        'Daily Prayer Time',
        'Prayer time',
        'manage_options',
        'daily-prayer-time-for-mosques/widget-admin.php',
        '',
        plugins_url( 'daily-prayer-time-for-mosques/icon.png' ),
        79
    );
});
