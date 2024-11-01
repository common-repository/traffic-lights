<?php

if (function_exists('user_begins_to_work'))
{
	$all_users = get_users();
	$somebody_is_green = false;
	$green = false;
	foreach($all_users as $user)
	{
		$the_user_id = $user->data->ID;
		$in_office = get_user_meta($the_user_id, "in_office", true);
		$in_pause = get_user_meta($the_user_id, "in_pause", true);
		if ($in_office == "yes" && $in_pause == "no")
		{
			update_option('ampel', 'gruen');
			$green = true;
			break;
		}
		else
		if ($in_pause == "yes" && $green == false)
		{
			update_option('ampel', 'gelb');
			break;
		}
		else
		{
			update_option('ampel', 'rot');
		}
	}
}

// Eine Funktion um eine Ampel anzuzeigen

function draw_traffic_light()
{
	echo "<div style=\"line-height:0px;padding:0;text-decoration:none;\">";
	$ampel_url = plugins_url('bilder/', __FILE__);
	if (isset($_GET['ampel']) && current_user_can('change_traffic_light', 0))
	{
		update_option('ampel', $_GET['ampel']);
	}

	$farbe = get_option('ampel');
	if ($farbe == "rot")
	{
		echo "<img src=\"" . $ampel_url . "red.png\" /><br />";
	}
	else
	{
		if (current_user_can('change_traffic_light', 0))
		{
			echo "<a href=\"?ampel=rot\">";
		}
		else
		{
		}

		echo "<img src=\"" . $ampel_url . "red-off.png\" />";
		if (current_user_can('change_traffic_light', 0))
		{
			echo "</a>";
		}

		echo "<br />";
	}

	if ($farbe == "gelb")
	{
		echo "<img src=\"" . $ampel_url . "yellow.png\" /><br />";
	}
	else
	{
		if (current_user_can('change_traffic_light', 0))
		{
			echo "<a href=\"?ampel=gelb\">";
		}

		echo "<img src=\"" . $ampel_url . "yellow-off.png\" />";
		if (current_user_can('change_traffic_light', 0))
		{
			echo "</a>";
		}

		echo "<br />";
	}

	if ($farbe == "gruen")
	{
		echo "<img src=\"" . $ampel_url . "green.png\" /><br />";
	}
	else
	{
		if (current_user_can('change_traffic_light', 0))
		{
			echo "<a href=\"?ampel=gruen\">";
		}

		echo "<img src=\"" . $ampel_url . "green-off.png\" />";
		if (current_user_can('change_traffic_light', 0))
		{
			echo "</a>";
		}

		echo "<br />";
	}

	echo "</div>";
}

?>