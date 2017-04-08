<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* TinyMCE Inclusion Class
*
* @package        CodeIgniter
* @subpackage    Libraries
* @category    WYSIWUG
* @author        WackyWebs.net - Tom Glover
* @link        http://codeigniter.com/user_guide/libraries/zip.html
*/

class Tinymce {
/*
* Create Head Code - this converts $mode value to TinyMCE editors
* $Mode is the mode TinyMCE runs in - Please view TinyMCE manual for more detail
* $Theme is this style of running, eg advance or basic, defult advance
* $ToolLoc is the vertical location of the toolbar, Defult = 'top'
* $ToolAligh is the Horizontal Location of the toolbar, DeFult = 'left'
* $Resizeabe - Can the Client resize it on there web page.
* use in controllers like so:
* $data ['head'] = $this->tinymce->createhead('Ele','theme','toolbar loc','toolbar align','resizable')
*/
function Createhead($mode=array())
	{
	
		(!isset($mode['Ele']) ? $mode['Ele'] = 'textarea' : '');
		(!isset($mode['Theme']) ? $mode['Theme'] = 'advanced' : '' );
		(!isset($mode['ToolLoc']) ? $mode['ToolLoc'] = 'top' : '' );
		(!isset($mode['ToolAlign']) ? $mode['ToolAlign'] = 'left' : '' );
		(!isset($mode['Resizable']) ? $mode['Resizable'] = 'false' : '' );
		(!isset($mode['tool']) ? $mode['tool'] = null : '' );
		(!isset($mode['status_bar']) ? $mode['status_bar'] = null : '' );

		$asset_path = base_url().'assets';
		
		switch ($mode['tool']) {
			case "full":
				$options = "
					theme_advanced_buttons1 : \"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect\",
					theme_advanced_buttons2 : \"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor\",
					theme_advanced_buttons3 : \"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen\",
					theme_advanced_buttons4 : \"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft\",
					theme_advanced_toolbar_location : \"".$mode['ToolLoc']."\",
					theme_advanced_toolbar_align : \"".$mode['ToolAlign']."\",
					theme_advanced_statusbar_location : \"".$mode['status_bar']."\",
					theme_advanced_resizing : ".$mode['Resizable'].",
				";
			break;
			
			case "medium":
				$options = "
					theme_advanced_buttons1 : \"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,|,cut,copy,paste,pastetext,pasteword\",
					theme_advanced_buttons2 : \"search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,forecolor,backcolor,|,sub,sup,|,charmap,emotions,iespell,media,advhr\",
					theme_advanced_buttons3 : \"print,|,ltr,rtl,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,insertdate,inserttime,preview,|,visualchars,nonbreaking,template,pagebreak,restoredraft,|,fullscreen\",
					theme_advanced_toolbar_location : \"".$mode['ToolLoc']."\",
					theme_advanced_toolbar_align : \"".$mode['ToolAlign']."\",
					theme_advanced_statusbar_location : \"".$mode['status_bar']."\",
					theme_advanced_resizing : ".$mode['Resizable'].",
				";
			break;
			
			case "small":
				$options = "
					theme_advanced_buttons1 : \"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,|,cut,copy,paste,pastetext,pasteword\",
					theme_advanced_buttons2 : \"forecolor,backcolor,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview\",
					theme_advanced_buttons3 : \"search,replace,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,visualchars,nonbreaking,template,pagebreak,restoredraft,|,fullscreen\",
					theme_advanced_toolbar_location : \"".$mode['ToolLoc']."\",
					theme_advanced_toolbar_align : \"".$mode['ToolAlign']."\",
					theme_advanced_statusbar_location : \"".$mode['status_bar']."\",
					theme_advanced_resizing : ".$mode['Resizable'].",
				";
			break;
			
			case "mini":
				$options = "
					theme_advanced_buttons1 : \"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontsizeselect,bullist,numlist,|,undo,redo\",
					theme_advanced_buttons2 : \"link,unlink,image,code,|,forecolor,backcolor,|,emotions,iespell,advhr,|,pagebreak\",
					theme_advanced_buttons3 : \"\",
					theme_advanced_toolbar_location : \"".$mode['ToolLoc']."\",
					theme_advanced_toolbar_align : \"".$mode['ToolAlign']."\",
					theme_advanced_statusbar_location : \"".$mode['status_bar']."\",
					theme_advanced_resizing : ".$mode['Resizable'].",
				";
			break;
			
			default:
				$options = "
					theme_advanced_buttons1 : \"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontsizeselect,bullist,numlist,|,undo,redo,code\",
					theme_advanced_buttons2 : \"\",
					theme_advanced_toolbar_location : \"".$mode['ToolLoc']."\",
					theme_advanced_toolbar_align : \"".$mode['ToolAlign']."\",
					theme_advanced_statusbar_location : \"".$mode['status_bar']."\",
					theme_advanced_resizing : ".$mode['Resizable'].",
				";
			break;
		}
		
$output  = js_asset('tinymce/jquery.tinymce.js');
$output .= js_asset('tinymce/plugins/tinybrowser/tb_tinymce.js.php');

$output .= '
		<script type="text/javascript">
			function init_tinymce()
			{
				$("'.$mode['Ele'].'").tinymce({
				
				script_url : "'.$asset_path.'/js/tinymce/tiny_mce.js",
				
				// General options
				theme : "'.$mode['Theme'].'",
				skins : "default",
				plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
				
			   
				file_browser_callback : "tinyBrowser",
			   
				// Theme options
				'.$options.'

				// Example content CSS (should be your site CSS)
				content_css : "assets/js/tinymce/themes/advanced/skins/default/content.css",

				// Drop lists for link/image/media/template dialogs
				template_external_list_url : "lists/template_list.js",
				external_link_list_url : "lists/link_list.js",
				external_image_list_url : "lists/image_list.js",
				media_external_list_url : "lists/media_list.js",

				// Style formats
				style_formats : [
					{title : \'Bold text\', inline : \'b\'},
					{title : \'Red text\', inline : \'span\', styles : {color : \'#ff0000\'}},
					{title : \'Red header\', block : \'h1\', styles : {color : \'#ff0000\'}},
					{title : \'Example 1\', inline : \'span\', classes : \'example1\'},
					{title : \'Example 2\', inline : \'span\', classes : \'example2\'},
					{title : \'Table styles\'},
					{title : \'Table row 1\', selector : \'tr\', classes : \'tablerow1\'}
				],

				// Replace values for the template plugin
				template_replace_values : {
					username : "Some User",
					staffid : "991234"
				}
				});
			}
		</script>';
		
		return $output;

	}

}

?>