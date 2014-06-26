<?php
/**
 * MyBB 1.8
 * Copyright 2014 MyBB Group, All Rights Reserved
 *
 * Website: http://www.mybb.com
 * License: http://www.mybb.com/about/license
 *
 */

function task_recachestylesheets($task)
{
	global $mybb, $db, $lang;

	if(file_exists(MYBB_ROOT.$mybb->config['admin_dir']."/inc/functions_themes.php"))
	{
		require_once MYBB_ROOT.$mybb->config['admin_dir']."/inc/functions_themes.php";
	}
	else if(file_exists(MYBB_ROOT."admin/inc/functions_themes.php"))
	{
		require_once MYBB_ROOT."admin/inc/functions_themes.php";
	}

	$query = $db->simple_select('themestylesheets', '*');

	$num_recached = 0;

	while($theme = $db->fetch_array($query))
	{
		if(cache_stylesheet($theme['tid'], $theme['name'], $theme['stylesheet']))
		{
			++$num_recached;
		}
	}

	add_task_log($task, $lang->sprintf($lang->task_recachestylesheets_ran, $num_recached));
}

?>
