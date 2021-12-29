<?php

/**
 * @package Travelbase
 */

namespace Inc;

class IframeLoader
{

	function __construct()
	{

		if (get_option('travelbase_plugin_settings_activate')['iframeslide']) {
			self::loadHtml();
		}
	}

	function loadHtml()
	{
		add_action('wp_footer', array($this, 'insert_ciframe_footer'), 12);
	}

	function insert_ciframe_footer()
	{

		echo '
		<div id="js-iframe" class="c-iframe">
    	<span class="c-iframe__loader">
    		
    	</span>
			<div class="c-iframe__inner">
			<div class="c-iframe__menu">
				<span class="c-iframe__close" id="js-iframe-close" title="Sluit dit venster"><svg height="512px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M443.6,387.1L312.4,255.4l131.5-130c5.4-5.4,5.4-14.2,0-19.6l-37.4-37.6c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4  L256,197.8L124.9,68.3c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4L68,105.9c-5.4,5.4-5.4,14.2,0,19.6l131.5,130L68.4,387.1  c-2.6,2.6-4.1,6.1-4.1,9.8c0,3.7,1.4,7.2,4.1,9.8l37.4,37.6c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1L256,313.1l130.7,131.1  c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1l37.4-37.6c2.6-2.6,4.1-6.1,4.1-9.8C447.7,393.2,446.2,389.7,443.6,387.1z"/></svg></span>
				<span class="c-iframe__expand" id="js-iframe-expand" title="Vergroot dit venster"><i class="far fa-window-maximize"></i></span>
			</div>
    	<iframe></iframe>
    	</div>
    </div>
		';
	}
}
