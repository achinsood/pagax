<?php
error_reporting(0);
if(!defined("dir"))
define("dir", "http://".$_SERVER["HTTP_HOST"]."/");

if(!defined("host"))
define("host", "http://".$_SERVER["HTTP_HOST"]);

if(!defined("uri"))
define("uri", $_SERVER["REQUEST_URI"]);

if(!defined("root"))
define("root", $_SERVER["DOCUMENT_ROOT"]."/");

if(!mysql_ping())
{
	mysql_connect("localhost","root","") or die();
	mysql_select_db("database") or die();

}

if(!empty($_POST))
array_map('validate_request_parameters', $_POST);

if(!empty($_GET))
array_map('validate_request_parameters', $_GET);

if(!empty($_REQUEST))
array_map('validate_request_parameters', $_REQUEST);

$_GET["page"] = isset($_GET["page"])?$_GET["page"]:1;
global $logged_in_user, $session_user, $user_permissions, $page_location, $form_result, $form_values, $session_pages, $uploaded_file_name, $page_title;
$user_permissions = array(
		array(),
		array(
			"user" => array("view", "add", "edit", "delete"),
			"state" => array("view", "add", "edit", "delete"),
			"city" => array("view", "add", "edit", "delete"),
			"locality" => array("view", "add", "edit", "delete"),
		),
		array(
			"user" => array("add", "edit", "delete")
		)
	);

$session_pages = array(
	"dashboard/my-account",
);
$logged_in_user = get_logged_in_user();
$page_location = str_replace(dir, "", $_REQUEST["page_location"]);
include_once("helpers.php");

function user_has_permission($action, $target)
{
	global $logged_in_user, $user_permissions;
	if(array_key_exists($target, $user_permissions[$logged_in_user["privileges"]]) && in_array($action, $user_permissions[$logged_in_user["privileges"]][$target]))
	{
		return true;
	}
	return false;
}


function is_mobile_device()
{
	if((preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$_SERVER['HTTP_USER_AGENT'])||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($_SERVER['HTTP_USER_AGENT'],0,4))))
	{
		return true;
	}
	return false;
}
function get_parameter_url_form($value)
{
	return strtolower(str_replace(array("/", " "), array("-", "+"), $value));
}

function print_select_options($parameters)
{
	foreach($parameters["options"] as $key => $val)
	{
		$selected = "";
		if(array_key_exists("value", $parameters) && ((is_array($parameters["value"]) && (in_array($key, $parameters["value"]) || in_array($val, $parameters["value"]))) || (!is_array($parameters["value"]) && ($key == $parameters["value"] || $val == $parameters["value"])))){ $selected = "selected='selected'"; }
		if(array_key_exists("key_equals_value", $parameters) && $parameters["key_equals_value"]){ $key = $val; }
		echo "<option value='$key' $selected>$val</option>";
	}
}

function sqlwhere_from_array($where)
{
	$where_string = "1=1";
	foreach($where as $key => $val)
	{
	$where_string .= " and ".$key."='".$val."'";
	}
	return $where_string;
}

function extract_values($paramters, $return_json = false)
{
	$count = 0;
	while($row = mysql_fetch_assoc($paramters["sql"]))
	{
		if(array_key_exists("row", $paramters) && $paramters["row"])
		{
			$return[$count] = $row;
			$count++;			
		}
		else
		{
			if(count($paramters["pairs"]) > 1)
			{
				foreach($paramters["pairs"] as $key => $val)
				$return[$count][$row[$key]] = $row[$val];
				$count++;
			}
			else
			{
				$return[$row[key($paramters["pairs"])]] = $row[current($paramters["pairs"])];
			}
		}
		if(array_key_exists("one_row", $paramters) && $paramters["one_row"])
		break;
	}
	if(array_key_exists("one_row", $paramters) && $paramters["one_row"])
	{
		$return = $return[0];
	}
	$return = array($paramters["name"] => $return);
	if($return_json)
	return json_encode($return);
	return $return;
}

function numeric_sequence($start, $end, $extend)
{
	$values = array();
	for($x = $start; $x <= $end; $x++)
	{
		$values[$x] = $x;
	}
	if($extend){ $values[$end."+"] = $end."+"; }
	return $values;
}

function validate_request_parameters($item)
{
	return strip_tags(mysql_real_escape_string($item));
}

function set_session()
{
	global $logged_in_user, $form_result, $session_user;
	$form = array(
		"parents" => array(
			"login_id" => array("required" => true, "is_email" => true),
			"password" => array("required" => true),
		)
	);
	$form_result = new validate_form;
	$form_result->perform_validations($form);
	if($form_result->row["result"])
	{
		return $form_result->row;
	}
	else
	{
		$sql = mysql_query("select * from users, register where register.user_id=users.id and (users.email_id='" .$form_result->row["values"]["login_id"]. "' or register.username='" .$form_result->row["values"]["login_id"]. "')");
		if($row = mysql_fetch_assoc($sql))
		{
			if(md5($form_result->row["values"]["password"].md5($row["time"])) == $row["password"])
			{
				$_SESSION["login_id"] = $row["email_id"];
				unset($row["password"]);
				if(!mysql_fetch_assoc(mysql_query("select * from visitors_details where user_id='".$row["id"]."' and visitor_id='".$session_user["identity"]["id"]."'")))
				{
					mysql_query("insert into visitors_details (user_id, visitor_id) values('".$row["id"]."', '".$session_user["identity"]["id"]."')");
				}
				return $row;
			}
			else
			{
				$form_result->row["result"]++;
				return $form_result->row;
			}
		}
		else
		{
			$form_result->row["result"]++;
			return $form_result->row;
		}
	}
}

function get_logged_in_user()
{
	global $session_user;
	if(isset($_COOKIE["visitor"]))
	{
		$session_user["identity"] = mysql_fetch_assoc(mysql_query("select * from visitors_list where unique_id='".$_COOKIE["visitor"]."'"));
		if($session_user["identity"])
		{
			$session_user["details"] = mysql_fetch_assoc(mysql_query("select * from users, visitors_details where users.id=visitors_details.user_id and visitor_id='".$session_user["identity"]["id"]."'"));
		}
	}
	if(isset($_COOKIE["session"]))
	{
		$session_user["session"] = mysql_fetch_assoc(mysql_query("select * from visitors_sessions where session_id='".$_COOKIE['session']."' and visitor_id='".$session_user["identity"]["id"]."'"));
	}

	if(isset($_POST["submit_login"]))
	{
		return set_session();
	}
	if(isset($_SESSION["login_id"]))
	{
		$sql = mysql_query("select * from register, users where register.user_id=users.id and users.email_id='" . $_SESSION["login_id"] . "'") or die(mysql_error());
		if($row = mysql_fetch_assoc($sql))
		{
			extract($row);
			unset($row["password"]);
			return $row;
		}
	}
	check_if_login_required();
	return false;
}

function check_if_login_required()
{
	global $session_pages;
	if(in_array($_REQUEST["action"], $session_pages))
	{
		header("location:".dir."login?redirect=".urlencode(dir.$_REQUEST["action"]));
	}
}


function sanitize_output($buffer) {
	$search = array(
		'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
		'/[^\S ]+\</s',  // strip whitespaces before tags, except space
		'/(\s)+/s',       // shorten multiple whitespace sequences
		'/<!--(.|\s)*?-->/' // remove html comments
	);

	$replace = array(
		'>',
		'<',
		'\\1',
		''
	);
	return preg_replace($search, $replace, $buffer);
//	return $buffer;
}

function get_date($tm)
{
return date('M j, Y', $tm + 330*60);
}

function get_time($tm)
{
return date('h:i:s A', $tm + 330*60);
}


function sanitize_script($buffer) {
	return preg_replace(array('/ {2,}/', '/(\s+)?([+-\/*<>=!:;{}()|&])(\s+)?/', '/\/\*.*?\*\/|\t|(?:\r?\n[ \t]*)+/s'), array(" ", "$2", ""), $buffer);
}



class validate_form
{
	public function perform_validations($form)
	{
		$this->form = $form;
		$this->row["result"] = 0;
		$this->row["errors"] = array();
		foreach($this->form["parents"] as $field => $validations)
		{
			$this->row["values"][$field] = $_REQUEST[$field];
			foreach($validations as $check => $condition)
			{
				$error = $this->$check($_REQUEST[$field], $condition);
				if(!$error)
				{
					$this->row["errors"][$field][$check] = false;
					$this->row["result"]++; break;
				}
			}
		}
		if(array_key_exists("children", $this->form))
		{
			foreach($this->form["children"] as $field => $validations)
			{
				$this->row["values"][$field] = (array_key_exists("isInt", $validations) && $validations["isInt"])? 0 : "";
			}
		}
		if(array_key_exists("relationships_parents", $this->form))
		{
			foreach($this->form["relationships_parents"] as $parent => $parent_values)
			{
				$this->form_relationship_validations($parent, $parent_values);
			}
		}
	}

	function form_relationship_validations($parent, $parent_values)
	{
		if(!array_key_exists($parent, $this->row["errors"]))
		{
			if(array_key_exists("any", $parent_values))
			{
				$children = $parent_values["any"];
			}
			else if(!array_key_exists("any", $parent_values))
			{
				$children = $parent_values[$this->row["values"][$parent]];
			}
			if(is_array($children))
			foreach($children as $child => $required_condition)
			{
				$this->row["values"][$child] = $_REQUEST[$child];
				$error = $this->required($_REQUEST[$child], $required_condition);
				if(!$error)
				{
					$this->row["errors"][$child]["required"] = false;
				}
				else if($required_condition || (!$required_condition && $_REQUEST[$child] != ""))
				{
					foreach($this->form["children"][$child] as $check => $condition)
					{
						$error = $this->$check($_REQUEST[$child], $condition);
						if(!$error)
						{
							$this->row["errors"][$child][$check] = false;
							$this->row["result"]++; break;
						}
					}
				}
				if(array_key_exists($child, $this->form["relationships_children"]))
				$this->form_relationship_validations($child, $this->form["relationships_children"][$child]);
			}
		}
	}

	function required($value, $validation)
	{
		return ($validation) ? ($value != "") : true;
	}

	function values($value, $validation)
	{
		return array_key_exists($value, $validation);
	}
	
	function not_zero($value, $validation)
	{
		return ($validation) ? ($value != 0 && $value != "0") : true;
	}

	function is_email($value, $validation)
	{
		return ($validation) ? filter_var($value, FILTER_VALIDATE_EMAIL) : true;
	}

	function is_number($value, $validation)
	{
		return ($validation) ? is_numeric($value) : true;
	}

	function isInt($value, $validation)
	{
		return ($validation) ? ctype_digit($value) : true;
	}

	function match_db($value, $validation)
	{
		$where = (array_key_exists("where", $validation))?$validation["where"]:"";
		return mysql_num_rows(mysql_query("select * from ".$validation["table"]." where ".$validation["match"]."='".$value."' ".$where)); 
	}

	function match($value, $validation)
	{
		return ($value == $this->row["values"][$validation]);
	}

/*	function unique($value, $validation)
	{
		if($validation && get_from($table, array($label => $value)) == "")
		{
			return true;
		}
		return false;
	}
*/
	function maxlength($value, $validation)
	{
		return ($validation) ? (strlen($value) <= $validation) : true;
	}

	function minlength($value, $validation)
	{
		return ($validation) ? (strlen($value) >= $validation) : true;
	}
}

function create_unique_id()
{
	$id = "";
	for($countx = 0; $countx <= 30; $countx++)
	{
	$id .= substr( "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", mt_rand( 0 ,60 ), 1);
	}
	$id .= substr( md5( time() ), 1);
	return $id;
}

function generate_session_id($parameters)
{
	global $session_user;
	if(!(isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', strtolower($_SERVER['HTTP_USER_AGENT']))))
	{
	if(!is_array($session_user["identity"]))
	{
		$visitor = create_unique_id();
		setcookie("visitor", $visitor, time()+(3600*24*30*365*4));
		mysql_query("insert into visitors_list(unique_id, ip, user_agent, time) values('$visitor', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."', '".time()."')");
		$session_user["identity"] = mysql_fetch_assoc(mysql_query("select * from visitors_list where unique_id='".$visitor."'"));
	}

	if(!is_array($session_user["session"]))
	{
		$session_id = create_unique_id();
		setcookie("session", $session_id, 0);
		if(!$visitor){ $visitor = $_COOKIE['visitor']; }
		mysql_query("insert into visitors_sessions(session_id, visitor_id, time) select '$session_id', id, '".time()."' from visitors_list where unique_id='".$visitor."'");
		$session_user["session"] = mysql_fetch_assoc(mysql_query("select * from visitors_sessions where session_id='".$session_id."' and visitor_id='".$session_user["identity"]["id"]."'"));
	}

	if(!$session_id){ $session_id = $_COOKIE['session']; }
	$referer_website = explode("/", $parameters["referer"]);
	$referer_website = $parameters["referer"]?$referer_website[0]."//".$referer_website[2]:"";
	mysql_query("insert into visitors_pages(session_id, ip, time, page_url, referrer, referer_website) select id, '".$_SERVER['REMOTE_ADDR']."', '".time()."', '/".str_replace(dir, "", $parameters["url"])."', '".$parameters["referer"]."', '".$referer_website."' from visitors_sessions where session_id='".$session_id."'");
	return array("visitor" => $_COOKIE['visitor'], "session" => $_COOKIE["session"]);
	}
}

function upload_image($folder, $file)
{
global $uploaded_file_name;
$allowedExts = array("gif", "jpeg", "jpg", "png");
$allowedtypes = array("image/gif", "image/jpeg", "image/jpg", "image/pjpeg", "image/x-png", "image/png");
$temp = explode(".", $file["name"]);
$extension = end($temp);
if(in_array($file["type"], $allowedtypes) && $file["size"] < 1000000 && in_array($extension, $allowedExts) && !$file["error"])
{
$uploaded_file_name = generate_file_name($folder, $extension);
return move_uploaded_file($file["tmp_name"], $folder ."/". $uploaded_file_name);
}
return false;
}

function generate_unique_id($type, $length)
{
$id = "";
$string = array("numeric" => "0123456789", "alphanumeric" => "0123456789abcdefghijklmnopqrstuvwxyz");
$time = array("numeric" => substr(time(), 1), "alphanumeric" => strtolower(substr( md5( time() ), 1)));
for($countx = 0; $countx <= $length; $countx++)
{
$id .= substr($string[$type], mt_rand(0, strlen($string[$type])), 1);
}
$id .= $time[$type];
return $id;
}

function generate_file_name($folder, $extension)
{
$name = generate_unique_id("numeric", 30) .".".$extension;
if(file_exists($folder . $name))
generate_file_name($folder, $extension);
else
return $name;
}


function pagination($total)
{
	global $posts_per_page;
	$current = $_GET["page"];
	$pages = intval($total/$posts_per_page);
	$last_page = $total%$posts_per_page;
	if($last_page != 0 || $pages == 0){ $pages++; }

	if($pages > 1)
	{

	$x = 1;
	echo "<ul class='pagination'>";
	if($current != $x)
	{
		$href = build_page_url($current - 1);
		echo "<li class='number'><a href='$href' data-url='true' data-no_reload='true' data-target='content_container'><span>Previous</span></a></li>";
	}

	if($pages > 10)
	{
		if($current > 5 && $current < $pages - 5){ $break1 = 3; $start1 = $current - 2; $break2 = $current + 1; $start2 = $pages - 3;}
		else if($current <= 5){ $break1 = 6; $start1 = $pages - 3; }
		else if($current >= $pages - 5){ $break1 = 3; $start1 = $pages - 7; }
	}
	for($x; $x <= $pages; $x++)
	{
		$display = "<span>$x</span></li>";
		$class = "class='number'";
		$href = build_page_url($x);
		if($current == $x){ $class="class='number selected'"; }
		if($current != $x){ $display = "<a href='$href' data-url='true' data-no_reload='true' data-target='content_container'>$display</a>"; }
		$display = "<li $class>$display</li>";
		echo $display;
		if($x == $break1){ echo "<li style='display:inline; margin-left:10px;'>...</li>"; $x = $start1;}
		if($x == $break2){ echo "<li style='display:inline; margin-left:10px;'>...</li>"; $x = $start2;}
	}
	if($current != $pages)
	{
		$href = build_page_url($current - 1);
		echo "<li class='number'><a href='$href' data-url='true' data-no_reload='true' data-target='content_container'><span>Next</span></a></li>";
	}
	echo "</ul>";
	}
}

function build_page_url($page)
{
	$params = array_merge($_GET, array("page" => $page));
	unset($params["action"]);
	$new_query_string = http_build_query($params);
	$uri = isset($_POST["page_location"])?explode("?", $_POST["page_location"]):explode("?", uri);
	$url = isset($_POST["page_location"])?$uri[0]:host.$uri[0];
	$url .= "?".$new_query_string;
	return $url;
}
?>
