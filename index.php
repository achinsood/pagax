<?php
session_start();
define("root", $_SERVER["DOCUMENT_ROOT"]."/");
include_once(root."includes/functions.php");

if((isset($_POST["force_ajax"]) && $_POST["force_ajax"] == true) || (isset($_REQUEST["request"]) && $_REQUEST["request"] == "ajax"))
{
	$_REQUEST["request"] = "ajax";
	$_POST["request"] = "ajax";
	
	if(!isset($_POST["force_ajax"]))
	$return_output = true;
	
	$_REQUEST["force_ajax"] = true;
	$_POST["force_ajax"] = true;
	include_once(root."ajax.php");
}
else
{
	$_REQUEST["page_location"] = host.uri;
	$_REQUEST["request"] = "page";
	$return_output = true;
	include_once(root."ajax.php");
	ob_start();
	include_once(root."includes/header.php");
	echo $html_output;
	include_once(root."includes/footer.php");
	echo sanitize_output(ob_get_clean());
}
?>
