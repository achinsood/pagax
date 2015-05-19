<?php
class form_values
{
	function __construct($values)
	{
		global $form_values;
		$form_values = is_array($form_values)?$form_values + $values:$values;
	}
}

class form
{
	function __construct($parameters)
	{
		$this->form_name = $parameters["name"];
	}

	function input($parameters)
	{
		global $form_result, $form_values;
		if(array_key_exists("label", $parameters))
		{
			echo "<div class='page_row'>
			<div class='normal_row field_label'>".$parameters["label"]."</div>
			<div class='table_row'>";
		}
		else
		{
			echo "<div class='normal_row'>";
		}
			$classes = array(2 => "one_half_fixed", "one_third_fixed", "one_fourth_fixed");
			$colspan = count($parameters["inputs"]);
			foreach($parameters["inputs"] as $key => $input)
			{
				$input["attrs"] = $this->get_attributes($input["attrs"]);
				$input["id"] = array_key_exists("id", $input)?$input["id"]:$input["name"];
				if(array_key_exists("class", $input))
				$class = $input["class"];
				if($colspan > 1)
				{
					if(!$class)
					$class = $classes[$colspan];
					if($colspan == $key + 1)
					$class .= " last";
					echo "<div class='".$class."'>";
				}
				
				if(is_object($form_result))
				$input["value"] = array_key_exists($input["name"], $form_result->row["values"])?$form_result->row["values"][$input["name"]]:"";
				else if(is_array($form_values))
				$input["value"] = array_key_exists($input["name"], $form_values)?$form_values[$input["name"]]:"";
				else
				$input["value"] = "";
				
				$this->$input["type"]($input);
				if($colspan > 1)
				echo "</div>";
			}
		if(array_key_exists("label", $parameters))
		{
			echo "</div>";
		}
		echo "</div>";
	}

	function html($parameters)
	{
		echo $parameters["content"];
	}
	
	function password($parameters)
	{
		echo "<input type='password' name='".$parameters["name"]."' id='".$this->form_name."_".$parameters["id"]."' ".$parameters["attrs"]." placeholder='".$parameters["label"]."'>";
	}
	
	function text($parameters)
	{
		echo "<input type='text' name='".$parameters["name"]."' value='".$parameters["value"]."' id='".$this->form_name."_".$parameters["id"]."' ".$parameters["attrs"]." data-name='".$parameters["label"]."' placeholder='".$parameters["label"]."'>";
	}
	
	function textarea($parameters)
	{
		echo "<textarea name='".$parameters["name"]."' id='".$this->form_name."_".$parameters["id"]."' ".$parameters["attrs"]." data-name='".$parameters["label"]."' placeholder='".$parameters["label"]."'>".$parameters["value"]."</textarea>";
	}
	
	function radio($parameters)
	{
		if($parameters["option_value"] == $parameters["value"]){ $checked = " checked='checked'"; }
		echo "<label><input type='radio' name='".$parameters["name"]."' value='".$parameters["option_value"]."' id='".$this->form_name."_".$parameters["id"]."' ".$parameters["attrs"]." data-name='".$parameters["label"]."' placeholder='".$parameters["label"]."' $checked>";
		echo "<span id='".$this->form_name."_".$parameters["id"]."_label' class='left'>".$parameters["label"]."</span></label>";
	}
	
	function checkbox($parameters)
	{
		if($parameters["option_value"] == $parameters["value"]){ $checked = " checked='checked'"; }
		echo "<label><input type='checkbox' name='".$parameters["name"]."' value='".$parameters["option_value"]."' id='".$this->form_name."_".$parameters["id"]."' ".$parameters["attrs"]." data-name='".$parameters["label"]."' placeholder='".$parameters["label"]."' $checked>";
		echo "<span id='".$this->form_name."_".$parameters["id"]."_label' class='left'>".$parameters["label"]."</span></label>";
	}
	
	function hidden($parameters)
	{
		echo "<input type='hidden' name='".$parameters["name"]."' value='".$parameters["value"]."' id='".$this->form_name."_".$parameters["id"]."' ".$parameters["attrs"]." data-name='".$parameters["label"]."'>";
	}
	
	function submit($parameters)
	{
		echo "<input type='submit' name='".$parameters["name"]."' id='".$this->form_name."_".$parameters["id"]."' ".$parameters["attrs"]." value='".$parameters["label"]."'>";
	}
	
	function select($parameters)
	{
		echo "<select name='".$parameters["name"]."' id='".$this->form_name."_".$parameters["id"]."' ".$parameters["attrs"]." data-name='".$parameters["label"]."'>";
		print_select_options(array("options" => $parameters["options"], "value" => $parameters["value"]));
		echo "</select>";
	}
	
	function get_attributes($attrs)
	{
		$list = "";
		foreach($attrs as $key => $value)
		{
			$list.= " $key = '$value'";
		}
		return $list;
	}
}

class form_list
{
	function __construct($form = null, $parameters = null)
	{
		if($form)
		{
			ob_start();
			$this->$form($parameters);
			$this->form = ob_get_clean();
			return $this->form;
		}
	}
	function registration_form($parameters)
	{
		$all_states = get_state_values();
		$form = new form(array("name" => "registration_form"));
		$form->input(array("label" => "Name", "inputs" => array(array("type" => "text", "name" => "name", "label" => "Name", "attrs" => array("data-required" => "true")))));
		$form->input(array("label" => "Email id", "inputs" => array(array("type" => "text", "name" => "login_id", "label" => "Login id", "attrs" => array("data-required" => "true", "data-email" => "true")))));
		$form->input(array("label" => "Password", "inputs" => array(array("type" => "password", "name" => "password", "label" => "Password", "attrs" => array("data-required" => "true", "data-password" => "true")))));
		$form->input(array("label" => "Confirm Password", "inputs" => array(array("type" => "password", "name" => "confirm_password", "label" => "Confirm Password", "attrs" => array("data-required" => "true", "data-match" => "password")))));
		$form->input(array("label" => "Contact No", "inputs" => array(array("type" => "text", "name" => "contact_no", "label" => "Contact No", "attrs" => array("data-required" => "true", "data-number" => "true", "data-unique" => "contact_no_is_unique")))));
		$form->input(array("label" => "State", "inputs" => array(array("type" => "select", "name" => "state", "label" => "State", "attrs" => array("data-city" => "registration_form_city", "data-state" => "true", "data-required" => "true", "data-notzero" => "true", "data-heading" => "--Select State--"), "options" => array("--Select State--")+$all_states["states"]))));
		$form->input(array("label" => "City", "inputs" => array(array("type" => "select", "name" => "city", "label" => "City", "attrs" => array("data-city" => "true", "data-locality" => "registration_form_locality", "data-required" => "true", "data-notzero" => "true", "data-heading" => "--Select City--"), "options" => array("--Select City--")))));
		$form->input(array("label" => "Locality", "inputs" => array(array("type" => "select", "name" => "locality", "label" => "Locality", "attrs" => array("data-required" => "true", "data-notzero" => "true", "data-heading" => "--Select Locality--"), "options" => array("--Select Locality--")))));
		$form->input(array("inputs" => array(array("type" => "submit", "name" => "submit_registration", "label" => "Register Now", "attrs" => array("class" => "fancy_submit_button")))));
	}

	function login_form($parameters)
	{
		$form = new form(array("name" => "login_form"));
		$form->input(array("label" => "Login Id", "inputs" => array(array("type" => "text", "name" => "login_id", "label" => "Login id", "attrs" => array("data-required" => true, "data-email" => true)))));
		$form->input(array("label" => "Password", "inputs" => array(array("type" => "password", "name" => "password", "label" => "Password", "attrs" => array("data-required" => true)))));
		$form->input(array("label" => "", "inputs" => array(
			array("type" => "submit", "name" => "submit_login", "class" => "one_third_fixed", "label" => "Login", "attrs" => array("class" => "fancy_submit_button normal_row")),
			array("type" => "html", "class" => "two_third_fixed", "content" => "<a class='links margintop10' href='".dir."forgot-password' data-target='forgot_password_popup' data-action='forgot_password_popup' data-no_reload='true'>Forgot your Password?</a>"))));
	}
	
	function forgot_password_form($parameters)
	{
		$form = new form(array("name" => "forgot_password_form"));
		$form->input(array("label" => "Email Id", "inputs" => array(array("type" => "text", "name" => "email_id", "label" => "Email id", "attrs" => array("data-required" => true, "data-email" => true)))));
		$form->input(array("label" => "", "inputs" => array(array("type" => "submit", "name" => "submit_forgot_password", "label" => "Login", "attrs" => array("class" => "fancy_submit_button one_third_fixed")))));
	}
	
	function change_password_form($parameters)
	{
		$form = new form(array("name" => "change_password_form"));
		$form->input(array("label" => "Old Password", "inputs" => array(array("type" => "password", "name" => "old_password", "label" => "Old Password", "attrs" => array("data-required" => "true", "data-match_existing" => "check_old_password")))));
		$form->input(array("label" => "New Password", "inputs" => array(array("type" => "password", "name" => "password", "label" => "New Password", "attrs" => array("data-required" => "true", "data-password" => "true")))));
		$form->input(array("label" => "Confirm Password", "inputs" => array(array("type" => "password", "name" => "confirm_password", "label" => "Confirm Password", "attrs" => array("data-required" => "true", "data-match" => "password")))));
		$form->input(array("label" => "", "inputs" => array(array("type" => "submit", "name" => "submit_registration", "label" => "Change Password", "attrs" => array("class" => "fancy_submit_button")))));
	}	
}
?>
