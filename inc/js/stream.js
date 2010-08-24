// Live Stream Live Preview Script

$(document).ready(function(){
	
	var app_id    = $('#app_id').val();
	var width     = $('#width').val();
	var height    = $('#height').val();
	var wid_title = $('#wid_title').val()
	
	if(app_id == '')
	{
		html = "<span><font color = 'red'>Add APP ID to activate the live preview</font></span>";
		
		}else{
	
	var html  = '<iframe src="http://www.facebook.com/plugins/livefeed.php?';
	    html += 'app_id='+app_id+'&amp;width='+width+'&amp;height='+height+'&amp;"';
		html += 'scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'+width+'px; height:'+height+'px;"';
		html += 'allowTransparency="true"></iframe>';
     }
	 
	$('#live').html(html);
	
	$('#form').change(function(){
		
	var app_id    = $('#app_id').val();
	var width     = $('#width').val();
	var height    = $('#height').val();
	var wid_title = $('#wid_title').val()
	
	if(app_id == '')
	{
		html = "<span><font color = 'red'>Add APP ID to activate the live preview</font></span>";
		
		}else{
	
	var html  = '<iframe src="http://www.facebook.com/plugins/livefeed.php?';
	    html += 'app_id='+app_id+'&amp;width='+width+'&amp;height='+height+'&amp;"';
		html += 'scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'+width+'px; height:'+height+'px;"';
		html += 'allowTransparency="true"></iframe>';
     }
	
	
		
	$('#live').html(html);
		
		});
	
	});