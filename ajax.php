<?php
if(!defined("root"))
{
	session_start();
	define("root", $_SERVER["DOCUMENT_ROOT"]."/");
	include_once(root."includes/functions.php");
}
$action = $_REQUEST["action"];
//print_r($_POST);
$alternatives = array(
	"page" => array(
		"index.php" => "index",
	),
	"ajax" => array(
	)
);

$all_functions = array(
	"page" => array(
		"",
		"index",
		"index.php",
		"about-us",
	),
	"ajax" => array(
		"",
	)
);
if($_REQUEST["request"] == "page")
{
	if(!$action)
	{
		$action = $page_location;
	}
	
	if($action == ""){ $action = "index"; }
	if($action && array_key_exists($action, $alternatives["page"]))
	{
		$action = $alternatives["page"][$action];
	}

	if($action == "logout")
	{
		session_destroy();
		if(isset($_GET["redirect"]))
		header("location:".dir."login?redirect=".urlencode($_GET["redirect"]));
		else if($_SERVER["HTTP_REFERER"])
		header("location:".dir."login?redirect=".urlencode($_SERVER["HTTP_REFERER"]));
		else
		header("location:".dir."login");
	}

	if($action && in_array($action, $all_functions["page"]))
	{
		ob_start();
		include_once("pages/".$action.".php");
		$html_output = ob_get_clean();
		if(!$return_output)
		{
			$return_array = array("status" => true, "data" => array("title" => $page_title, "content" => sanitize_output($html_output)));
			if(isset($_SESSION["login_id"]) && $action == "login")
			{
				$return_array["data"]["redirect"] = dir."dashboard/my-account";
			}
			if(!is_array($logged_in_user) && in_array($action, $session_pages))
			{
				$return_array["data"]["redirect"] = dir."login";
			}
			echo json_encode($return_array);
		}
	}
}

if($_POST["request"] == "ajax")
{
	//echo $action;
	if($action && array_key_exists($action, $alternatives["ajax"]))
	{
		$action = $alternatives["ajax"][$action];
	}
	if(isset($_POST["force_ajax"]) && $_POST["force_ajax"] == true && !in_array($action, $all_functions["ajax"]) && in_array($action, $all_functions["page"]))
	{
		if($action && array_key_exists($action, $alternatives["page"]))
		{
			$action = $alternatives["page"][$action];
		}
		ob_start();
		include_once("pages/".$action.".php");
		$return = array("status" => true, "data" => array("title" => $page_title));
		$return["data"]["content"] = sanitize_output(ob_get_clean());
		if(!$return_output)
		{
			echo json_encode($return);
		}
		else
		{
			echo $return["data"]["content"];
		}
	}
	else if($action && in_array($action, $all_functions["ajax"]))
	{
		ob_start();
		$ajax_request = new ajax_request;
		$ajax_request->$action();
		echo sanitize_output(ob_get_clean());
	}	

}

class ajax_request
{
}
?>
