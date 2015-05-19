<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content='width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes' name='viewport' />
<title><?php echo $page_title; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo dir; ?>css/basic.min.css">
<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwy5XhqjYz4u426P-BLH08_2xGO0nPMOU&libraries=geometry,places"></script>
<script type="text/javascript" language="javascript" src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo dir; ?>javascript/analytics.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo dir; ?>javascript/javascript.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo dir; ?>javascript/respond.js"></script>
</head>
<body>
<div style="float:left; width:100%; overflow-x:hidden;">
<div class="links_widget">
<a class="link" href="<?php echo dir."index"; ?>" data-target="content_container" data-no_reload=true><span class="link_text">My App</span></a>
<div class="menu_tab"><a id="sidebar_home" class="<?php if(host.uri == dir || host.uri == dir."index"){ echo "selected_link"; } else{ echo "link"; } ?>" href="<?php echo dir."index"; ?>" data-target="content_container" data-no_reload=true><span class="link_text">Home</span></a></div>

<div class="menu_tab"><a id="sidebar_about" class="<?php if(strpos(host.uri, dir."about-us") !== false){ echo "selected_link"; } else{ echo "link"; } ?>" href="<?php echo dir."about-us"; ?>" data-target="content_container" data-no_reload=true><span class="link_text">About Us</span></a></div>
</div>
<div id="popups"><div class='popup_shadow' style='width:100px; height:100px; margin-left:-50px; margin-top:-50px;'></div></div>

<div id="topbar" style="float:left; position:fixed; top:0px; right:0px; z-index:5; width:100%; padding:15px 0 15px 0; background:#ffffff; border-bottom:1px solid #dedede;">

<div class="content_inner">
<div class="toggle-sidebar nav-opener">
<div></div><div></div><div></div>
</div>

<div class="left">
<a class="logo links" href="<?php echo dir."index"; ?>" data-no_reload="true" data-target="content_container">
	<h2>My App</h2>
</a>
</div>
</div>
</div>
<div id="content_overlay" class="popup_back" style="z-index:900;"></div>

<div id="content_loader" style="float:left; position:fixed; left:5%; top:10%; width:90%; text-align:center; z-index:1000; display:none;">
<div style="margin: 0 0; position: relative; top: 0px; display: inline-block;">
<div class="content_loading_box" id="content_loading_box">
<div id="content_loading_message" style="margin:5px 20px 5px 20px;">Loading...</div>
</div>
<div class="content_success_box" id="content_success_box">
<div id="content_success_message" style="margin:5px 20px 5px 20px;">Success</div>
</div>
</div>
</div>

<div class="content">
<div class="page_content">
<div id="content_container">
