<?php


/*
File Name: admin.inc.php
Descrption: Form the admin section 
*/


function FB_Admin_Cont()
{

// available fonts
$fblikes_fonts = array("Default"        => "",
                       "Arial"          => "arial",
                       "Lucida Grande"  => "lucida grande",
                       "Segoe Ui"       => "segoe ui",
                       "Tahoma"         => "tahoma",
                       "Trebuchet MS"   => "trebuchet ms",
                       "Verdana"        => "verdana",
                      );
			

    $Names = array(
            
			'appid'  => 'appid', //AppID
			'type'   => 'type', //Button Type
			'pos'    => 'pos', //Position
			'layout' => 'layout', //Layout
			'face'   => 'face', //Show Faces
			'verb'   => 'verb', //Verb to display
			'color'  => 'color', //Button Color
			'width'  => 'width', //Container Width
			'height' => 'height', //Container Height
			'ht'     => 'ht', //Height Type px or em
			'css'    => 'css', //Container CSS Class
			'home'   => 'home', //Show in home
			'page'   => 'page', //Show in pages
			'post'   => 'post'  //show in posts
               
			   );

$Value = array();
			   
foreach($Names as $Na){ //Get Options Names
		
		$Value["$Na"] = get_option("fb_like_".$Na);
		
	}

    
	
    $xfbml = ($Value['type'] == 'xfbml') ? 'CHECKED' : '';
    $iframe = ($Value['type'] == 'iframe') ? 'CHECKED' : '';

    $stan = ($Value['layout'] == 'standard') ? 'SELECTED' : '';
    $count = ($Value['layout'] == 'button_count') ? 'SELECTED' : '';

    $face = ($Value['face'] == 'true') ? 'CHECKED' : '';

    $like = ($Value['verb'] == 'like') ? 'SELECTED' : '';
    $reco = ($Value['verb'] == 'recommend') ? 'SELECTED' : '';

    $light = ($Value['color'] == 'light') ? 'SELECTED' : '';
    $dark = ($Value['color'] == 'dark') ? 'SELECTED' : '';
    $evil = ($Value['color'] == 'evil') ? 'SELECTED' : '';

    $after = ($Value['pos'] == 'after') ? 'SELECTED' : '';
    $before = ($Value['pos'] == 'before') ? 'SELECTED' : '';
    $baf = ($Value['pos'] == 'baf') ? 'SELECTED' : '';

    $px = ($Value['ht'] == "px") ? 'SELECTED' : '';
    $em = ($Value['ht'] == "em") ? 'SELECTED' : '';
    
	$home = ($Value['home'] == 'true') ? 'CHECKED' : '';
	$page = ($Value['page'] == 'true') ? 'CHECKED' : '';
	$post = ($Value['post'] == 'true') ? 'CHECKED' : '';
	
    $Width = ($Value['width'] == null) ? '450' : $width;
	
	$Live  = 

  "
  <script src='". plugins_url('js/jquery.js',__FILE__)."' type = 'text/javascript'></script>
  <script>
  $(document).ready(function(){
	  
	  var appid = $(\"#appid\").val();
		  var xfbml =  ($(\"#xfbml\").is(':checked')) ? true : false;
		  var iframe= ($(\"#iframe\").is(':checked')) ? true : false;
		  var pos   = $(\"#pos :selected\").val();
		  var layout= $(\"#layout :selected\").val();
		  var height= $(\"#height\").val();
		  var width = $(\"#width\").val();
		  var css   = $(\"#css\").val();
		  var verb  = $(\"#verb\").val();
		  var face  = ($(\"#face\").is(\":checked\")) ? true : false;
		  var color = $(\"#color :selected\").val();
		  var ht    = $(\"#ht :selected\").val();
		  var locale= $(\"#fblikes_locale :selected\").val();
          var font  = $(\"#fblikes_font :selected\").val();

		  var SDK  = '<div id=\"fb-root\"></div>';
			  SDK += '<script>';
			  SDK += 'window.fbAsyncInit = function() {';
			  SDK += 'FB.init({appId: '+appid+', status: true, cookie: true, xfbml: true}); };';
			  SDK += '(function() {';
			  SDK += 'var e = document.createElement(\"script\"); e.async = true;';
			  SDK += 'e.src = document.location.protocol +';
          if (locale == \"default\") {
			  SDK += '\"//connect.facebook.net/en_US/all.js\";';
          } else {
			  SDK += '\"//connect.facebook.net/'+ locale +'/all.js\";';
          }
			  SDK += 'document.getElementById(\"fb-root\").appendChild(e); }()); <\/script>';
		  
		  var iver = '<iframe src=\"http://www.facebook.com/plugins/like.php?';
			  iver+= 'href=http%3A%2F%2Fblog.ahmedgeek.com';
			  iver+= '&amp;layout='+layout+'&amp;font='+escape(font)+'&amp;show_faces='+face+'';
          if (locale == \"default\") {
			  iver+= '&amp;width=450&amp;action='+verb+'&amp;colorscheme='+color+'\"';
          } else {
			  iver+= '&amp;width=450&amp;action='+verb+'&amp;locale='+locale+'&amp;colorscheme='+color+'\"';
          }
			  iver+= 'scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\"';
			  iver+= 'style=\"border:none; overflow:hidden; width:450px; height:px\"></iframe>';
			  
		  var xver = '<fb:like href=\"http://blog.ahmedgeek.com\"';
			  xver+= 'layout=\"'+layout+'\" show_faces=\"'+face+'\" width=\"450\"';
			  xver+= 'action=\"'+verb+'\" colorscheme=\"'+color+'\" font=\"'+font+'\"></fb:like>';
			  
	  
			  $(\"#live\").html(iver);
			  
	  
	  
	  $(\"#form\").change(function(){
		  
		  var appid = $(\"#appid\").val();
		  var xfbml =  ($(\"#xfbml\").is(':checked')) ? true : false;
		  var iframe= ($(\"#iframe\").is(':checked')) ? true : false;
		  var pos   = $(\"#pos :selected\").val();
		  var layout= $(\"#layout :selected\").val();
		  var height= $(\"#height\").val();
		  var width = $(\"#width\").val();
		  var css   = $(\"#css\").val();
		  var verb  = $(\"#verb\").val();
		  var face  = ($(\"#face\").is(\":checked\")) ? true : false;
		  var color = $(\"#color :selected\").val();
		  var ht    = $(\"#ht :selected\").val();		  
		  var locale= $(\"#fblikes_locale :selected\").val();
          var font  = $(\"#fblikes_font :selected\").val();

		  var SDK  = '<div id=\"fb-root\"></div>';
			  SDK += '<script>';
			  SDK += 'window.fbAsyncInit = function() {';
			  SDK += 'FB.init({appId: '+appid+', status: true, cookie: true, xfbml: true}); };';
			  SDK += '(function() {';
			  SDK += 'var e = document.createElement(\"script\"); e.async = true;';
			  SDK += 'e.src = document.location.protocol +';
          if (locale == \"default\") {
			  SDK += '\"//connect.facebook.net/en_US/all.js\";';
          } else {
			  SDK += '\"//connect.facebook.net/'+ locale +'/all.js\";';
          }
			  SDK += 'document.getElementById(\"fb-root\").appendChild(e); }()); <\/script>';
		  
		  var iver = '<iframe src=\"http://www.facebook.com/plugins/like.php?';
			  iver+= 'href=http%3A%2F%2Fblog.ahmedgeek.com';
			  iver+= '&amp;layout='+layout+'&amp;font='+escape(font)+'&amp;show_faces='+face+'';
          if (locale == \"default\") {
			  iver+= '&amp;width=450&amp;action='+verb+'&amp;colorscheme='+color+'\"';
          } else {
			  iver+= '&amp;width=450&amp;action='+verb+'&amp;locale='+locale+'&amp;colorscheme='+color+'\"';
          }
			  iver+= 'scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\"';
			  iver+= 'style=\"border:none; overflow:hidden; width:450px; height:px\"></iframe>';
			  
		  var xver = '<fb:like href=\"http://blog.ahmedgeek.com\"';
			  xver+= 'layout=\"'+layout+'\" show_faces=\"'+face+'\" width=\"450\"';
			  xver+= 'action=\"'+verb+'\" colorscheme=\"'+color+'\" font=\"'+font+'\"></fb:like>';
			  
	  
			  $(\"#live\").html(iver);
			  
			  
		  
		  });
	  
	  });
  </script>"; 
	
	 $Layout = '
	          <div class="wrap">
			  
			    
              <form action = "" method = "POST" id="form">
	          <img s class="icon32" style="height:15px; width:auto;" src="'.plugins_url('icon.png',__FILE__).'" title="Facebook Like Button" alt="Icon"> <h2>Facebook Like Button</h2>
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
              <option value = "evil" '. $evil .'>Evil</option>
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
	
	';

	
    
    echo $Live.$Layout;

}


?>