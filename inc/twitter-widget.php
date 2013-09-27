<?php

if(!class_exists('s8_twitter_widget') && class_exists('WP_Widget')):
    class s8_twitter_widget extends WP_Widget {
        function s8_twitter_widget() { // creates the widget
            $name = __('Twitter'); // The widget name as users will see it
            $description = __('Displays the latest tweets in the sidebar.'); // The widget description as users will see it

            $this->WP_Widget($id_base = false,
                $name,
                $widget_options = array('classname' => strtolower(get_class($this)), 'description' => $description),
                $control_options = array());
        }

        function form($instance) { // outputs the options form on admin
            // set form variables
            $instance = wp_parse_args(
                (array) $instance,
                array(
                    'title' => 'Twitter',
                    'numberposts' => 5,
                )
            );
            $selected = 'selected="selected"';
            $checked = 'checked="checked"';
            ?>
            <p> <!-- TITLE FOR WIDGET -->
                <label 	for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label><br/>
                <input  id="<?php echo $this->get_field_id('title'); ?>"
                        name="<?php echo $this->get_field_name('title'); ?>"
                        type="text"
                        value="<?php echo $instance['title']; ?>" />
            </p>

            <p> <!-- NUMBER POSTS FOR WIDGET -->
                <label 	for="<?php echo $this->get_field_id('numberposts'); ?>"><?php _e('Number of tweets to show:'); ?></label>
                <input  id="<?php echo $this->get_field_id('numberposts'); ?>"
                        name="<?php echo $this->get_field_name('numberposts'); ?>"
                        type="text"
                        value="<?php echo $instance['numberposts']; ?>"
                        size="3"
                    />
            </p>
            <?php
        }

        function update($new_instance, $old_instance) {
            // processes widget options to be saved
            $instance = $old_instance;

            $instance['title'] = strip_tags($new_instance['title']);
            if(!empty($new_instance['numberposts']) && is_numeric($new_instance['numberposts'])) $instance['numberposts'] = (int) strip_tags($new_instance['numberposts']);
            else $instance['numberposts'] = 5;

            return $instance;
        }

        function widget($args, $instance) {
            $before_title = $before_widget = $after_widget = $after_title = '';
            extract($args, EXTR_IF_EXISTS);
            // Begin widget display
            echo $before_widget;
            echo $before_title.$instance['title'].$after_title;
            $twitter = of_get_option('twitter_user');
            if($twitter)
                s8_wp_get_twitter($twitter, $instance['numberposts']);
            echo $after_widget;
        }
    }
    // register widget
    add_action('widgets_init', create_function('', 'return register_widget("s8_twitter_widget");'));
endif;
