<?php
class traffic_light_Widget extends WP_Widget

{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct('traffic_light_Widget', // Base ID
		__('Traffic Lights', 'text_domain') , // Name
		array(
			'description' => __('A traffic Light Widget', 'text_domain') ,
		) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance)
	{
		if (! empty( $instance['title'] ) ) 
		{
			$title = apply_filters('widget_title', $instance['title'] );
		}
		
		echo $args['before_widget'];
		if (!empty($title)) echo $args['before_title'] . $title . $args['after_title'];
		draw_traffic_light();
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance)
	{
		if (isset($instance['title']))
		{
			$title = $instance['title'];
		}
		else
		{
			$title = __('New title', 'text_domain');
		}

?>
		<p>
		<label for="<?php
		echo $this->get_field_id('title');
?>"><?php
		_e('Title:');
?></label>
		<input class="widefat" id="<?php
		echo $this->get_field_id('title');
?>" name="<?php
		echo $this->get_field_name('title');
?>" type="text" value="<?php
		echo esc_attr($title);
?>" />
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		return $instance;
	}
} // class traffic_light_Widget

?>