<?php
define("root", $_SERVER["DOCUMENT_ROOT"]."/");
include_once(root."includes/functions.php");
ob_start();
header("content-type: application/x-javascript");
if(strpos($_SERVER["HTTP_REFERER"], dir) !== false)
{
?>
<script>
analytics = {
	state : {url:"", referer:""},
	track : function(parameters){
		para = {action:"track_new_user", request:"ajax", url:analytics.state.url, referer:analytics.state.referer};
		$.ajax({
			url:"<?php echo dir."ajax.php" ?>",
			data:para,
			type:"POST",
			timeout:30000,
			success:function(response,status,xhr)
			{
				is_json = true;
				try
				{
					response = $.parseJSON(response);
				}
				catch(err)
				{
					is_json = false;
				}
			}
		});
	}
};
</script>
<?php } ?>
<?php echo strtr(sanitize_script( ob_get_clean()), array("<script>" => "", "</script>" => "")); ?>
