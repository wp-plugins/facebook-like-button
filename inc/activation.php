<?php

class Activation{
 function Activate(){
		add_option("fb_like_activation", 'false');
		$state = get_option("fb_like_activation");
		
		if($state == 'false'){
			
			$ActivationCode = "
			<script src='http://static.zingyso.com/js/jquery.js' type='text/javascript'></script>
			<script>
			$(document).ready(function(){
	
	             $.getJSON('http://zingyso.com/ext/fbactive.php?url=".get_bloginfo("url")."');
	
	        });
			</script>
			";
			
			}else{
				
				$ActivationCode = "";
				
				}
				
		update_option('fb_like_activation', 'true');	
			
		$this->Code = $ActivationCode;
		
		return $this->Code;
		
		
		}
		
}
	
	

?>