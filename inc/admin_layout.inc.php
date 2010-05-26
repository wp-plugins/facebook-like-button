<?php

/*
File Name: admin_layout.inc.php
Descrption: Form the admin layout. 
*/

 $Layout = '
	          <div class="wrap">
			  
			    <div class="postbox">
              <form action = "" method = "POST" id="form">
	          <img s class="icon32" style="height:15px; width:auto;" src="'.plugins_url('icon.png',__FILE__).'" title="Facebook Like Button" alt="Icon"> <h2>Facebook Like Button</h2>
			  <h3>Live Preview</h3>
			  <span id="live"></span>
			  <h2>General Settings:</h2>
		  <table>
			  <tr>
				  <td>
				  App ID: 
				  </td>
				  <td>
				  <input type="text" name="appid" size="30" value = "' . $Value['appid'] .
        '"/> <a href="http://developers.facebook.com/setup/" target="_blank" title="Register Your Site on Facebook">Don&rsquo;t have one?</a>
				  </td>
			  </tr>
			  
			  <tr>
				  <td>
				  Type: 
				  </td>
			  </tr>
			  <tr>
				  <td><label for="xfbml">XFBML:</label><input type="radio" id="xfbml" name="type" value="xfbml" ' .
        $xfbml . '/></td>
				  <td><label for="iframe">iFrame:</label><input type="radio" id="iframe" name="type" value="iframe" ' .
        $iframe . '/></td>
			  </tr>
			  	  <tr>
			  <td>Show in Home:</td><td><input type = "checkbox" name = "home" value = "true" '.$home.'></td>
			  </tr>
			  <tr>
			  <td>Show in Pages:</td><td><input type = "checkbox" name = "page" value = "true" '.$page.'></td>
			  </tr>
			  <tr>
			  <td>Show in Posts:</td><td><input type = "checkbox" name = "post" value = "true" '.$post.'></td>
			  </tr>
              <tr>
              <td>
              Position:
              </td>
              <td>
              <select name = "pos" value="$pos" id="pos">
              <option value = "after" ' . $after . '>
              After Content
              </option>
              <option value = "before" ' . $before . '>
              Before Content
              </option>
              <option value = "baf" ' . $baf . '>
              Before and after content
              </option>
              </select>
              </td>
              </tr>
              <tr><td><label for="fblikes_locale">Language:</label></td>
                  <td><select name="fblikes_locale" id="fblikes_locale">';
if (get_option("fblikes_locale") == "default") {
    $Layout .= '<option value="default" selected="selected">Default</option>';
} else {
    $Layout .= '<option value="default">Default</option>';
}

$fblikes_locales = fblikes_get_locales();
$selectedLocale = get_option("fblikes_locale");
foreach($fblikes_locales as $locale => $language) {
    if ($locale == $selectedLocale) {
        $Layout .= '<option value="' . htmlentities($locale) .'" selected="selected">'. htmlentities($language) .'</option>';
    } else {
        $Layout .= '<option value="' . htmlentities($locale) .'">'. htmlentities($language) .'</option>';
    }
}

$Layout = '
	          <div class="wrap">
			  
			    
              <form action = "" method = "POST" id="form">
	          <img class="icon32" style="height:15px; width:auto;" src="'.plugins_url('icon.png',__FILE__).'" title="Facebook Like Button" alt="Icon"> <h2>Facebook Like Button</h2>
			  <h3>Live Preview</h3>
			  <div id="live" style="height:60px;"></div>
			  <h2>General Settings:</h2>
		  <table>
			  <tr>
				  <td>
				  AppID for XFBML version: 
				  </td>
				  <td>
				  <input type="text" name="appid" size="30" value = "' . $Value['appid'] .
        '"/> <a href="http://developers.facebook.com/setup/" target="_blank" title="Register Your Site on Facebook">Don&rsquo;t have one?</a>
				  </td>
			  </tr>
			  
			  <tr>
				  <td>
				  Type: 
				  </td>
			  </tr>
			  <tr>
				  <td><label for="xfbml">XFBML:</label><input type="radio" id="xfbml" name="type" value="xfbml" ' .
        $xfbml . '/></td>
				  <td><label for="iframe">iFrame:</label><input type="radio" id="iframe" name="type" value="iframe" ' .
        $iframe . '/></td>
			  </tr>
			  	  <tr>
			  <td>Show in Home:</td><td><input type = "checkbox" name = "home" value = "true" '.$home.'></td>
			  </tr>
			  <tr>
			  <td>Show in Pages:</td><td><input type = "checkbox" name = "page" value = "true" '.$page.'></td>
			  </tr>
			  <tr>
			  <td>Show in Posts:</td><td><input type = "checkbox" name = "post" value = "true" '.$post.'></td>
			  </tr>
              <tr>
              <td>
              Position:
              </td>
              <td>
              <select name = "pos" value="$pos" id="pos">
              <option value = "after" ' . $after . '>
              After Content
              </option>
              <option value = "before" ' . $before . '>
              Before Content
              </option>
              <option value = "baf" ' . $baf . '>
              Before and after content
              </option>
			   </option>
              <option value = "man" ' . $man . '>
              Manually
              </option>
              </select>
              </td>
              </tr>
			  
			  <tr>
              <td>
              Admin ID:
              </td>
              <td>
                    <input type="text" size="30" name="admeta" value="'.get_option("fb_like_admeta").'" /><i><font size = "-2" color = "red">App ID Required!</font></i> <a href = "http://www.facebook.com/insights/" target = "_blank">View Insights</a>
              </td>
              </tr>
			  
			  	  <tr>
              <td>
              Defualt Image:
              </td>
              <td>
			  <input type="text" size="30" name="dimage" value="'.get_option("fb_like_dimage").'" />
			  </td>
              </tr>
			  
              <tr><td><label for="fblikes_locale">Language:</label></td>
                  <td><select name="fblikes_locale" id="fblikes_locale">';
if (get_option("fblikes_locale") == "default") {
    $Layout .= '<option value="default" selected="selected">Default</option>';
} else {
    $Layout .= '<option value="default">Default</option>';
}

$fblikes_locales = fblikes_get_locales();
$selectedLocale = get_option("fblikes_locale");
foreach($fblikes_locales as $fblikes_locale => $fblikes_language) {
    if ($fblikes_locale == $selectedLocale) {
        $Layout .= '<option value="' . htmlentities($fblikes_locale) .'" selected="selected">'. htmlentities($fblikes_language) .'</option>';
    } else {
        $Layout .= '<option value="' . htmlentities($fblikes_locale) .'">'. htmlentities($fblikes_language) .'</option>';
    }
}

$Layout .= '
                      </select></td>
              </tr>
		  </table>
		  
		  <h2>Layout Settings:</h2>
		  <table width="400px" border="0">
			<tr>
			  <td>Layout Style:</td>
			  <td>
			  <select name="layout" id="layout">
			  <option value="standard" ' . $stan . '>Standard</option>
			  <option value="button_count" ' . $count . '>Count Button</option>
			  </select>
			  </td>
			</tr>
			<tr>
			  <td>Show Faces:</td>
			  <td><input type="checkbox" id="face" name="face" value="true" ' . $face . '/>
			</tr>
			<tr>
			  <td>Verb to display:</td>
			  <td>
			  <select name="verb" id="verb">
			  <option value="like" ' . $like . '>Like</option>
			  <option value="recommend" ' . $reco . '>Recommend</option>
			  </select>
			  </td>
			</tr>
			<tr><td><label for="fblikes_font">Font:</label></td>
                            <td><select name="fblikes_font" id="fblikes_font">';
$selectedFont = get_option("fblikes_font");
foreach ($fblikes_fonts as $fontName => $font) {
    if ($font == $selectedFont) {
        $Layout .= '<option value="'. $font .'" selected=selected>'. $fontName .'</option>';
    } else {
        $Layout .= '<option value="'. $font .'">'. $fontName .'</option>';
    }
}

$Layout .= '
                                </select></td>
                        </tr>
			<tr>
			  <td>Color Scheme:</td>
			  <td>
			  <select name="color" id="color">
			  <option value="light" ' . $light . '>Light</option>
			  <option value="dark" ' . $dark . '>Dark</option>
			  </select>
			  </td>
			</tr>
            	<tr>
			  <td>Width:</td>
			  <td>
			  <input type = "text" name = "width" value = "' . $Value['width'] . '"  id="width"/>
			  </td>
			</tr>
            <tr>
			  <td>Height:</td>
			  <td>
			  <input type = "number" name = "height" value = "' . $Value['height'] . '" id="height" />
			  </td>
              <td>
              <select name = "ht" id="ht">
              <option value = "px" ' . $px . '>px</option>
              <option value = "em" ' . $em . '>em</option>
              </selecte>
              </td>
              <td style = "width: 100px;"><div><i>Default is 40px!</i></div></td>
			</tr>
            	<tr>
			  <td>Container Class:</td>
			  <td>
			  <input type = "text" name = "css" value = "' . $Value['css'] . '" id="css" />
			  </td>
			</tr>
		  </table>
          <input type = "submit" name = "sub" value = "Save Settings">
         
		</form>	  
		</div>



	              </div>
	
	
	';
	

	


?>