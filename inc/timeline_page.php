<?php

class Timeline
{
	public function adminHook()
	{

		add_submenu_page("main.php", 'Timeline Plugin Settings', 'Timeline', 8, basename(__file__),
	        array('Timeline', 'pageLayout'));
	}
	
	public function pageLayout()
	{
		include(dirname(__file__) . '/layouts/timeline.php');
	}
}

?>