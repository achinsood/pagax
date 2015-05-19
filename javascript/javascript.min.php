<?php
define("root", $_SERVER["DOCUMENT_ROOT"]."/");
include_once(root."includes/functions.php");
ob_start();
header("content-type: application/x-javascript");
?>
<script>
var stoppedTyping, page_vars = {};

var principles = {
		values : [0, 1000000, 1500000, 2000000, 2500000, 3000000, 3500000, 4000000, 4500000, 5000000, 6000000, 7000000, 8000000, 9000000, 10000000, 20000000, 30000000, 40000000, 50000000, 100000000, 150000000, 200000000, 250000000, 300000000, 350000000, 400000000, 450000000, 500000000, 600000000, 700000000, 800000000, 900000000, 1000000000],
		texts : [0, 1000000, 1500000, 2000000, 2500000, 3000000, 3500000, 4000000, 4500000, 5000000, 6000000, 7000000, 8000000, 9000000, 10000000, 20000000, 30000000, 40000000, 50000000, 100000000, 150000000, 200000000, 250000000, 300000000, 350000000, 400000000, 450000000, 500000000, 600000000, 700000000, 800000000, 900000000, 1000000000]
	};
var interests = {
		values : [0, 5, 5.25, 5.5, 5.75, 6, 6.25, 6.5, 6.75, 7, 8.25, 8.5, 8.75, 9, 9.25, 9.5, 9.75, 10, 10.25, 10.5, 10.75, 11, 11.25, 11.5, 11.75, 12, 12.25, 12.5, 12.75, 13, 13.25, 13.5, 13.75, 14, 14.25, 14.5, 14.75, 15, 15.25, 15.5, 15.75, 16, 16.25, 16.5, 16.75, 17, 17.25, 17.5, 17.75, 18, 18.25, 18.5, 18.75, 19, 19.25, 19.5, 19.75, 20],
		texts : [0, 5, 5.25, 5.5, 5.75, 6, 6.25, 6.5, 6.75, 7, 8.25, 8.5, 8.75, 9, 9.25, 9.5, 9.75, 10, 10.25, 10.5, 10.75, 11, 11.25, 11.5, 11.75, 12, 12.25, 12.5, 12.75, 13, 13.25, 13.5, 13.75, 14, 14.25, 14.5, 14.75, 15, 15.25, 15.5, 15.75, 16, 16.25, 16.5, 16.75, 17, 17.25, 17.5, 17.75, 18, 18.25, 18.5, 18.75, 19, 19.25, 19.5, 19.75, 20]
	};

var terms = {
		values : [0, 6, 12, 18, 24, 30, 36, 42, 48, 54, 60, 66, 72, 78, 84, 90, 96, 102, 108, 114, 120, 126, 132, 138, 144, 150, 156, 162, 168, 174, 180, 186, 192, 198, 204, 210, 216, 222, 228, 234, 240, 246, 252, 258, 264, 270, 276, 282, 288, 294, 300, 306, 312, 318, 324, 330, 336, 342, 348, 354, 360],
		texts : [0, 6, 12, 18, 24, 30, 36, 42, 48, 54, 60, 66, 72, 78, 84, 90, 96, 102, 108, 114, 120, 126, 132, 138, 144, 150, 156, 162, 168, 174, 180, 186, 192, 198, 204, 210, 216, 222, 228, 234, 240, 246, 252, 258, 264, 270, 276, 282, 288, 294, 300, 306, 312, 318, 324, 330, 336, 342, 348, 354, 360]
	};

var plugins = {
	/* Basic structure of objects
		Basic structure start
	*/
	plugin_name : {
		varname : "varvalue",
		funcname : function(e)
		{
			var obj = this;
			/* code of function*/
		},
		onready : function()
		{
			var obj = this;
			/* code to be run on $(document).ready();*/
		}
	},
	/*	Basic structure end */
	forms : {
		get_values : function(id)
		{
			var elem = ["input:text:not([disabled])", "input:hidden:not([disabled])", "input:password:not([disabled])", "input:radio:checked:not([disabled])", "select:not([disabled])", "textarea:not([disabled])"];
			container = $('#' + id);
			var arr = {};
			for(var j = 0; j < elem.length; j++)
			{
				var inputs = container.find(elem[j]);
				$(inputs).each(function(){
					var element_name = $(this).attr("name")?$(this).attr("name"):$(this).attr("id");			
					element_name = element_name.replace("[]", "");
					if($(this).attr("type") && $(this).attr("type") == "checkbox" && !$(this).prop("checked")){ }
					else
					{
						if($.isArray($(this).val()))
						{
							arr[element_name] = "";
							$.each($(this).val(), function(key, value){
								arr[element_name] += arr[element_name]?","+value:value;
							});
						}
						else
						{
							arr[element_name] = $(this).val();
						}
					}
				});
			}
			return arr;
		},
		empty_fields : function(id)
		{
			var elem = ["input:text", "input:hidden", "input:password", "input:checked", "select", "textarea"];
			container = $('#' + id);
			for(var j = 0; j < elem.length; j++)
			{
				var inputs = container.find(elem[j]);
				for (var i = 0; i < inputs.length; ++i)
				{
					inputs[i].value = "";
				}
			}
		}
	},
	/* jQuery Slider start*/
	slider : {
		slider : "",
		slide_children : "",
		next_child : "",
		child_no : "",
		slides : "",
		slide_no : "",
		slideit : function()
		{
			var obj = this;
			var width = $(".slide_element").outerWidth(),
			slide_width = 0;
			if($(".slide_element").find(".slide_element_child").length)
			{
				var slide_child = $(".slide_element").find(".slide_element_child");
				slide_width = slide_child.outerWidth()+parseFloat(slide_child.css("margin-left").replace("px", ""))+parseFloat(slide_child.css("margin-right").replace("px", ""));
			}
			shift = obj.next_child?((width*(obj.slide_no+1))+(slide_width*obj.child_no)):(width*(obj.slide_no+1));
			$(".slide_main").animate({'right':shift+"px"}, "slow");
			for(var b = 1; b <= obj.slides; b++)
			{
			if(b == obj.slide_no){ $("#slide_button"+b).css({"background":"#999", "border":"1px solid #dedede"}); }
			else{ $("#slide_button"+b).css({"background":"#f0f0f0", "border":"1px solid #999"}); }
			}

			if((obj.slide_no == obj.slides - 2 && obj.next_child && obj.child_no == -1) || (obj.slide_no == obj.slides - 3 && obj.child_no > 0 && obj.child_no == $(".slide_element:nth-child("+(obj.slide_no+2)+")").find(".slide_element_child").length))
			{
			$("#slide_button1").css({"background":"#999", "border":"1px solid #dedede"});
			$(".slide_main").animate({'right' : (width)+"px"}, 1);
			}
			else if(obj.slide_no == -1)
			{
			$("#slide_button"+obj.slides).css({"background":"#999", "border":"1px solid #dedede"});
			$(".slide_main").animate({'right' : (width + (slide_width * obj.slides))+"px"}, 1);
			}
		},
		start_interval : function()
		{
			var obj = this;
			obj.slider = setInterval(function(){
				obj.slideit();
				current_slide_children = $(".slide_element:nth-child("+(obj.slide_no+2)+")").find(".slide_element_child");
				if(obj.slide_children.length && ((obj.slide_children.length == current_slide_children.length && obj.child_no+1 < obj.slide_children.length) || (obj.slide_children.length > current_slide_children.length && obj.child_no < current_slide_children.length)))
				{
					obj.next_child = true; obj.child_no++;
					/*if(child_no == $(".slide_element:nth-child("+(obj.slide_no+2)+")").find(".slide_element_child").length)*/
				}
				else
				{
					if(obj.slide_children.length)
					{
						obj.child_no = 0; obj.slide_no++;
						obj.next_child = false;
						if(obj.slide_no == obj.slides-2)
						{
							obj.child_no = 1;
							obj.slide_no = 0;
							obj.next_child = true;
						}
					}
					else if(!obj.slide_children.length)
					{
						obj.child_no = -1; obj.slide_no++;
						obj.next_child = false;
						if(obj.slide_no == obj.slides-2)
						{
							obj.next_child = true;
						}
						if(obj.slide_no == obj.slides-1)
						{
							obj.slide_no = 1;
							obj.next_child = false;
						}
					}
				}
			}, 4000);
		},
		slide_start : function(slides)
		{
			var obj = this;
			obj.slides = parseInt(slides);
			$(".slide_main").css({width:(100*obj.slides)+"%"});
			$(".slide_element").css({width:(100/obj.slides)+"%"});
			obj.slide_children = $(".slide_element:nth-child(2)").find(".slide_element_child"),
			obj.child_no = obj.slide_children.length?1:-1,
			obj.next_child = obj.slide_children.length?true:false,
			obj.slide_no = obj.slide_children.length?0:1;
			obj.start_interval();

			$(".slide_button").click(function(){
			clearInterval(obj.slider);
			obj.slideit();
			obj.slide_no++; if(obj.slide_no == obj.slides){obj.slide_no = 2;}
			obj.start_interval();
			});


			$("#slide_left_arrow").click(function(){
			clearInterval(obj.slider);
			obj.slide_no = obj.slide_no-2; if(obj.slide_no == -1){obj.slide_no = obj.slides;}
			obj.slideit();
			obj.slide_no++; if(obj.slide_no == obj.slides){obj.slide_no = 0;}
			obj.start_interval();

			});

			$("#slide_right_arrow").click(function(){
			clearInterval(obj.slider);
			if(obj.slide_no == obj.slides){obj.slide_no = 2;}
			obj.slideit();
			obj.slide_no++; if(obj.slide_no == obj.slides){obj.slide_no = 2;}
			obj.start_interval();
			});
		},
		onready : function()
		{
			var obj = this;
			clearInterval(obj.slider);
			var slides = $(".slide_main").find(".slide_element").length,
			slide_child = $(".slide_main").find(".slide_element:first-child").find(".slide_element_child"),
			slide_last_child = $(".slide_main").find(".slide_element:last-child").find(".slide_element_child");
			var append_slide_content = "<div class='slide_element last_element'>"+$(".slide_main").find(".slide_element:first-child").html()+"</div>";
			var prepend_slide_content = "<div class='slide_element first_element'>"+$(".slide_main").find(".slide_element:last-child").html()+"</div>";
			var last_element_length = $(".slide_main").find(".last_element").length;
			if(!last_element_length)
			{
				$(".slide_main").append(append_slide_content);
			}
			if(!$(".slide_main").find(".first_element").length)
			{
				$(".slide_main").prepend(prepend_slide_content);
			}
			obj.slide_start(slides);
			if(slide_child.length && !last_element_length)
			{
				$(".slide_main").find(".slide_element.last_element").prev().css({"marginRight":-(($(".slide_main").find(".slide_element").outerWidth()-$(".slide_main").find(".slide_element_child").css("margin-right").replace("px", ""))*((slide_child.length-slide_last_child.length)/slide_child.length))+"px"});
			}
		}
	},
	/* jQuery Slider end*/

	/* sidebar_navigation start*/
	sidebar_navigation : {
		varname : "varvalue",
		hide : function()
		{
			var obj = this;
			if($(".content").css("right") != "0px")
			{
			$(".content").css({position:"absolute"});
			$('html, body').animate({scrollTop:-$(".content").position().top+"px"}, 1);
			$("#refine_search_container, #left_child_nav").css({position:"fixed"});
			setTimeout(function(){
				$(".content").css({top:"0px"});
				$(".links_widget").animate({marginLeft:"0px"}, 200);
				$(".content, #topbar, #search_filter_box").animate({right:"0px"}, 200);
				$("#left_child_nav").animate({left:"0px"}, 200);
				$("#refine_search_container").animate({left:$("#left_child_nav").outerWidth()}, 200);
				$("#content_overlay").hide();
			}, 1);
			}
		},
		show : function()
		{
			var obj = this;
			$(".content").css({position:"fixed", top:-$(document).scrollTop()});
			$(".links_widget").animate({marginLeft:-$(".links_widget").outerWidth()+"px"}, 200);
			$("#refine_search_container, #left_child_nav").animate({left:-$(".links_widget").outerWidth()+"px"}, 200);
			$(".content, #topbar, #search_filter_box").animate({right:$(".links_widget").outerWidth()+"px"}, 200);
			$("#content_overlay").show();
		},
		toggle: function()
		{
			var obj = this;
			if($(".content").css("right") == "0px")
			{
				obj.show();
			}
			else
			{
				obj.hide();
			}
		},
		onload : function()
		{
			var obj = this;
			$(".toggle-sidebar").click(function(){ obj.toggle(); });

			$(".content, #topbar, #content_overlay").on("click", function(e){
				if($(".toggle-sidebar").has(e.target).length === 0 && !$(".toggle-sidebar").is(e.target))
				{
					obj.hide();
				}
			});
		}
	},
	/*	sidebar_navigation end */

	/* scroller_navigation start*/
	scroller_navigation : {
		onscroll : function()
		{
			if($(".project_nav").length)
			{
			if($(document).scrollTop() >= $(".project_nav").offset().top - $("#topbar").outerHeight())
			{
				$("#topbar").css({top:-($(document).scrollTop() - $(".project_image").outerHeight())});
			}
			else
			{
				$("#topbar").css({top:'0px'});
			}
			if($(document).scrollTop() >= $(".project_image").outerHeight() + $("#topbar").outerHeight())
			{
				$(".project_nav").css({position:'fixed', top:'0px'});
				$("#overview").css({marginTop:$(".project_nav").outerHeight()});
			}
			else
			{
				$(".project_nav").css({position:'relative', top:'0px'});
				$("#overview").css({marginTop:"0px"});
			}

			if($(document).scrollTop() >= $("#overview").offset().top - $("#topbar").outerHeight())
			{
				$(".project_page").each(function(){
				if($(this).offset().top - 100 <= $(document).scrollTop() && $(this).offset().top + $(this).outerHeight() - 100 > $(document).scrollTop())
				{
					$("a.project_link").removeClass("active");
					$("a.project_link[href$='"+$(this).attr("id")+"']").addClass("active");
					return false;
				}
				});
			}
			else
			{
				$("a.project_link").removeClass("active");
			}
			}
		}
	},
	/*	scroller_navigation end */

	/*	emi calculator Start*/
	emi_calculator : {
		varname : "varvalue",
		calculate : function()
		{
			var obj = this;
			var p = parseFloat($("[name='principle']").val());
			var r = parseFloat($("[name='interest']").val());
			var n = parseFloat($("[name='term']").val());
			var i = r / 1200;
			var po = 1 + i;
			var power = Math.pow(po,n);
			var num = p*i*power;
			var den = power - 1;
			var emi = num / den;
			var ti = emi * n - p;
			var tp = emi * n;
			$('#emi').html(Math.round(emi * 100 )/100);
			$('#ti').html(Math.round(ti * 100 )/100);
			$('#tp').html(Math.round(tp * 100 )/100);
		},
		onready : function()
		{
			var obj = this;
			$("[name='principle'], [name='interest'], [name='term']").change(function(){
				obj.calculate();
			});
		}
	},
	/*	emi calculator end*/

	/*	range slider to select from the given range
		Range Slider Start
	*/
	range_slider : {
		mousedown : false,
		focussed_element : false,
		mouse_position : 0,
		focus_side : "",
		mouse_side : false,
		length : 0,
		left : 0,
		right : 0,
		full_width : 0,
		reference : {
			principle : principles.values,
			interest : interests.values,
			term : terms.values
		},
		texts : {
			principle : principles.texts,
			interest : interests.texts,
			term : terms.texts
		},
		current_position : function()
		{
			var obj = this;
			obj.full_width = obj.focussed_element.width();
			obj.length = obj.reference[obj.focussed_element.data("type")].length - 1;
			obj.left = Math.round(obj.length*obj.focussed_element.find(".left-block").width()/obj.full_width);
			obj.right = Math.round(obj.length*obj.focussed_element.find(".right-block").width()/obj.full_width);
		},
		set_value : function(parameters)
		{
			var obj = this;
			if(parameters.side == "left")
			{
				$("#"+parameters.focussed_element.attr("id")+"_min_text").html(obj.texts[parameters.focussed_element.data("type")][obj.mouse_position]);
				$("#"+parameters.focussed_element.attr("id")+"_min").val(obj.reference[parameters.focussed_element.data("type")][obj.mouse_position]);
			}
			if(parameters.side == "right")
			{
				$("#"+parameters.focussed_element.attr("id")+"_max_text").html(obj.texts[parameters.focussed_element.data("type")][obj.length - obj.mouse_position]);
				$("#"+parameters.focussed_element.attr("id")+"_max").val(obj.reference[parameters.focussed_element.data("type")][obj.length - obj.mouse_position]);
			}
		},
		slide : function(parameters)
		{
			var obj = this;
			if(!parameters.hasOwnProperty("position"))
			{
				obj.current_position();
				obj.mouse_position = Math.round(obj.length*(parameters.e.pageX-obj.focussed_element.offset().left)/obj.full_width);
			}
			else
			{
				obj.mouse_position = parameters.position;
			}
			if((!obj.focussed_element.find(".right-block").length && obj.mouse_position <= obj.length) || (obj.focussed_element.find(".right-block").length && obj.mouse_position - obj.left < obj.length - obj.right - obj.mouse_position))
			{
				if(!obj.mouse_side)
				{
					obj.mouse_side = "left";
				}
				if(obj.mouse_side != "right")
				{
					obj.focus_side = "left";
					obj.focussed_element.find(".left-block").css({width:100*obj.mouse_position/obj.length+"%"});
					obj.set_value({focussed_element:obj.focussed_element, side:"left"});
					$("#"+obj.focussed_element.attr("id")+"_min").trigger("change");
					if($("#emi_calculator").length)
					{
						plugins.emi_calculator.calculate();
					}
				}
			}
			else if(obj.focussed_element.find(".right-block").length && obj.mouse_position - obj.left != obj.length - obj.right - obj.mouse_position)
			{
				if(!obj.mouse_side)
				{
					obj.mouse_side = "right";
				}
				if(obj.mouse_side != "left")
				{
					obj.mouse_position = obj.length-obj.mouse_position;
					obj.focus_side = "right";
					obj.focussed_element.find(".right-block").css({width:100*obj.mouse_position/obj.length+"%"});
					obj.set_value({focussed_element:obj.focussed_element, side:"right"});
					$("#"+obj.focussed_element.attr("id")+"_max").trigger("change");
					if($("#emi_calculator").length)
					{
						plugins.emi_calculator.calculate();
					}
				}
			}
		},
		onready : function()
		{
			var obj = this;
			$(".range-slider-block").mousedown(function(e){
				e.preventDefault();
				obj.mousedown = true;
				obj.focussed_element = $(this);
				obj.slide({e:e});
				$(window).mousemove(function(e)
				{
					if(obj.mousedown)
					{
						obj.slide({e:e});
					}
				});
			});
			$(window).mouseup(function() {
				obj.mousedown = false;
				obj.mouse_side = false;
				$(window).unbind("mousemove");
			});
			$(".range-slider-block").each(function(){
				obj.focussed_element = $(this);
				obj.current_position();
				var left_block = $(this).find(".left-block");
				if(left_block.data("value"))
				{
					obj.focus_side = "left";
					obj.slide({position:obj.reference[$(this).data("type")].indexOf(left_block.data("value"))});
				}
				var right_block = $(this).find(".right-block");
				if(right_block.data("value"))
				{
					obj.focus_side = "right";
					obj.slide({position:obj.reference[$(this).data("type")].indexOf(right_block.data("value"))});
				}
				obj.set_value({focussed_element:obj.focussed_element, side:"left"});
				obj.set_value({focussed_element:obj.focussed_element, side:"right"});
				obj.mouse_side = false;
				obj.focussed_element = false;
				obj.focus_side = "";
			});
			if($("#emi_calculator").length)
			{
				plugins.emi_calculator.calculate();
			}
		},
		onmousedown : function(e)
		{
			var obj = this;
			if(!$(".range-slider-block").is(e.target) && $(".range-slider-block").has(e.target).length === 0)
			{
				obj.focussed_element = false;
				obj.focus_side = "";
			}
		},
		onkeydown : function(evt)
		{
			var obj = this;
			evt = (evt) ? evt : document.event;
			var charcode = (evt.which) ? evt.which : evt.keyCode;
			if(obj.focussed_element)
			{
				if(charcode == 39)
				{
					obj.current_position();
					obj.slide({e:evt, position:(obj.focus_side == "left")?obj.left+1:obj.length-obj.right+1});
					obj.mouse_side = false;
					evt.preventDefault();
				}
				if(charcode == 37)
				{
					obj.current_position();
					obj.slide({e:evt, position:(obj.focus_side == "left")?obj.left-1:obj.length-obj.right-1});
					obj.mouse_side = false;
					evt.preventDefault();
				}
			}
		}
	},
	/*
		Range Slider end
	*/
	
	expand_box : {
		varname : "varvalue",
		active : "",
		generate_options : function(parameters)
		{
			var obj = this;
			var content = "";
			$.each(parameters.options, function(key){
				var selected = "";
				if(parameters.selected_value == "" && key == 0){ selected=" selected"; }
				if(parameters.selected_value == this.value){ selected=" selected";}
				if(!parameters.blank_option && key == 0){ return true; }
				content += "<div class='normal_row expand_drop_selector "+parameters.class_name+"_selector"+selected+"' id='"+parameters.class_name+"_"+this.value+"' data-type='"+parameters.class_name+"' data-value='"+this.value+"'>";
				if($("#"+parameters.class_name).data("multiple") && this.value != '')
				{
					var checked = "";
					if($.isArray(parameters.selected_value) && ($.inArray(this.value, parameters.selected_value) >= 0 || $.inArray(this.text, parameters.selected_value) >= 0))
					{
						checked = " checked='checked'";
					}
					content += "<input type='checkbox' id='"+parameters.class_name+"_"+this.value+"_check' name='"+parameters.class_name+"' data-value='"+this.text+"' value='"+this.value+"'" + checked + "/>";
				}
				content += "<span>"+this.text+"</span>";
				content += "</div>";
			});
			$("#"+parameters.class_name+"_content").html(content);
			var onready = (parameters.hasOwnProperty("onready") && parameters.onready == true)?true:false;
			if($.isArray(parameters.selected_value))
			{
				obj.selected_text({drop_down:$("#"+parameters.class_name+"_content"), value:parameters.selected_value[0], onready:onready});
			}
			else
			{
				obj.selected_text({drop_down:$("#"+parameters.class_name+"_content"), value:parameters.selected_value, onready:onready});
			}
		},
		select_option : function(parameters)
		{
			var obj = this, text = "",
			value = new Array(),
			element = parameters.drop_down.find("[data-value='"+parameters.value+"']");
			$("."+element.data("type")+"_selector").removeClass("selected");
			if($("#"+element.data("type")).data("multiple"))
			{
				if(!element.find("input[type='checkbox']").prop("checked"))
				{
					element.find("input[type='checkbox']").prop("checked", true);
				}
				else
				{
					element.find("input[type='checkbox']").prop("checked", false);
				}
			}
			obj.selected_text(parameters);
		},
		selected_text : function(parameters)
		{
			var obj = this, text = "",
			value = new Array();
			element = parameters.drop_down.find("[data-value='"+parameters.value+"']");
			if($("#"+element.data("type")).data("multiple"))
			{
				count = 0;
				$("."+element.data("type")+"_selector").find("input:checked").each(function(){
					text+=text?", "+$(this).data("value"):$(this).data("value");
					value.push($(this).val());
					count++;
				});
				var name = ($("#"+$("#"+element.data("type")).data("select")).data("name") != undefined)?$("#"+$("#"+element.data("type")).data("select")).data("name"):$("#"+$("#"+element.data("type")).data("select")).attr("name");
				$("#"+element.data("type")).attr("title", text);
				text = text?
							(count > 1)?
								count+" "+name+" selected"
							:text
						:$("#"+$("#"+element.data("type")).data("select")).data("heading");
				$("#"+$("#"+element.data("type")).data("select")).val(value);
				if(!parameters.onready){ $("#"+$("#"+element.data("type")).data("select")).trigger("change"); }
			}
			else
			{
				text = element.find("span").html();
				$("#"+$("#"+element.data("type")).data("select")).val(element.data("value"));
				if(!parameters.onready){ $("#"+$("#"+element.data("type")).data("select")).trigger("change"); }
				element.addClass("selected");
			}
			if($("#"+element.data("type")).attr("type") == "text")
			{
				$("#"+element.data("type")).data("value", element.data("value")).data("over", element.data("value")).val(text);
			}
			else
			{
				$("#"+element.data("type")).data("value", element.data("value")).data("over", element.data("value")).html(text);
			}
		},
		expand : function(parameters)
		{
			var obj = this;
			var speed = 100;
			$(parameters.element).each(function(){
			$(".expand_box_content").not($(this).parents(".expand_box_content")).not("#"+$(this).attr("id")+"_content").not(".content_box").slideUp(speed);
			$(".expand_box_headings").not(":parent.expand_box_content").not("#"+$(this).attr("id")).not(".content_heading").removeClass("active");
			if(!$(this).hasClass("disabled") && (getstyle($(this).attr("id")+"_content", "display") == "none" || (parameters.hasOwnProperty("show") && parameters.show)))
			{
				$(this).addClass("active");
				var box = $(this);
				$("#"+box.attr("id")+"_content").slideDown(speed, function(){
					var bottom = $(window).height() - ($("#"+box.attr("id")+"_content").outerHeight() + $("#"+box.attr("id")+"_content").offset().top - $(window).scrollTop());
					if(bottom <= 20)
					{
						if(!box.data("parent"))
						{
							var top = box.offset().top - $("#topbar").outerHeight();
							$('html, body').animate({scrollTop:top - 20}, 300);
						}
						else
						{
							var top = box.offset().top - $("#"+box.data("parent")).offset().top + $("#"+box.data("parent")).scrollTop();
							$("#"+box.data("parent")).animate({scrollTop:top - 20}, 300);
						}
					}
				});
				if($(this).hasClass("drop_down"))
				{
					var option_count = $("#"+$(this).attr("id")+"_content").find(".expand_drop_selector").length,
					option_height = $("#"+$(this).attr("id")+"_content").find(".expand_drop_selector").outerHeight(),
					drop_height = (option_count <= 8)?(option_height*option_count):(option_height*8);
					drop_height += 12;
					$("#"+$(this).attr("id")+"_content").css({height:drop_height, maxHeight:drop_height});
					obj.active = $(this).attr("id");
				}
			}
			else
			{
				obj.close($(this));
			}
			});
		},
		close : function(element)
		{
			var obj = this;
			$(element).each(function(){
			if(getstyle($(this).attr("id")+"_content", "display") == "block")
			{
				$("#"+$(this).attr("id")+"_content").slideUp(100);
				$(this).removeClass("active");
				if($(this).hasClass("drop_down"))
				{
					$("."+$(this).attr("id")+"_selector").removeClass("selected");
					$("#"+$(this).attr("id")+"_"+$(this).data("value")).addClass("selected");
					$("#"+$(this).data("select")).trigger("focusout");
					if($("#"+$(this).data("select")).hasClass("alert_field"))
					{
						$(this).addClass("alert_field");
					}
					else
					{
						$(this).removeClass("alert_field");
					}
					obj.active = "";
				}
			}
			});
		},
		create : function(category)
		{
			var obj = this;
			var multiple = $("#"+category).attr("multiple")?" data-multiple='"+$("#"+category).attr("multiple")+"'":"";
			if(!$("#expand_drop_"+category).length)
			{
				var value = $("#"+category).val(), attrs = "",
				display_value = $("#"+category).data("heading")?$("#"+category).data("heading"):$("#"+category+" > option:first-child").html();
				attrs += $("#"+category).data("parent")?" data-parent='"+$("#"+category).data("parent")+"' ":attrs;
				content = "<a href='javascript:void(0)'>";
				if($("#"+category).data("text"))
				{
					var blank_option = false;
					content += "<input type='text' name='"+category+"_text' class='expand_box_headings drop_down custom_drop_down' "+multiple+" placeholder='"+display_value+"' data-select='"+category+"' id='expand_drop_"+category+"' data-over='"+value+"' data-value='"+value+"' autocomplete='off'" + attrs + "/>";
					content += "<img src='http://gharsearch.com/ajax-loader-small.gif' class='custom_drop_down_loading' />";
				}
				else
				{
					var blank_option = true;
					content += "<div class='expand_box_headings drop_down' data-select='"+category+"' id='expand_drop_"+category+"' "+multiple+" data-over='"+value+"' data-value='"+value+"'" + attrs + ">"+display_value+"</div>";
					if(multiple)
					{
						content += "<input type='hidden' name='"+category+"_text' id='expand_drop_"+category+"_text' />";
					}
				}
				content += "<div class='drop_down_row'><div class='hidden scrollbox basic_drop_down expand_box_content expand_drop_content normal_row' data-type='expand_drop_"+category+"' id='expand_drop_"+category+"_content'>";
				content +="</div></div></a>";
				$("#"+category).parent().prepend(content);
				obj.generate_options({class_name:"expand_drop_"+category, options:$("#"+category+" > option"), selected_value:value, blank_option:blank_option, onready:true});
				$("#"+category).hide();
			}
		},
		onready : function()
		{
			var obj = this;
			$("select").each(function(key){
				var category = $(this).attr("id");
				obj.create(category);
			});
			$(".expand_box_headings").unbind("click").click(function(){
				obj.expand({element:$(this)});
			});
			$(".expand_drop_selector").unbind("click").click(function(){
				obj.select_option({drop_down:$("#"+$(this).data("type")+"_content"), value:$(this).data("value")});
				if(!$("#"+$(this).data("type")).data("multiple"))
				{
					obj.expand({element:$("#"+$(this).data("type"))});
				}
			});
			$(".expand_drop_selector").mouseover(function(){
				$(".expand_drop_selector").removeClass("selected");
				$(this).addClass("selected");
				if($("#"+$(this).data("type")).data("multiple"))
				{
					$("#"+$(this).data("type")).data("over", $(this).data("value"));
				}
				else
				{
					$("#"+$(this).data("type")).data("over", $(this).data("value"));
				}
			});
			$(".custom_drop_down").unbind("keyup").keyup(function(evt){
			var category = $(this).data("select"),
			value = $(this).val();
			evt = (evt) ? evt : document.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if(charCode != 13)
			{
				if (stoppedTyping){ clearTimeout(stoppedTyping); }
				/* set a new timer to execute 1 second from last keypress */
				if (value.length > 1 && (charCode > 40 ||charCode < 37))
				{
					$(this).parent().find(".custom_drop_down_loading").show();
					stoppedTyping = setTimeout(function(){
						actions = {city:"get_matching_cities"};
						plugins.new_request.ajax_request({
							url:'<?php echo dir; ?>ajax.php',
							parameters:{request:"ajax", action:actions[category], match_city:value, fetch_name:category},
							beforeSend:"",
							error:"",
							success:""
						}, function(response,status,xhr){
							populate_options({option_list:response.data[category],  blank_option:false, drop_down:category});
							obj.expand({element:$("#expand_drop_"+category), show:true});
							$("#expand_drop_"+category).parent().find(".custom_drop_down_loading").hide();
						});
					}, 500);
				}
			}
			});
			$("form").submit(function(){
					if($("#"+$(this).data("select")).hasClass("alert_field"))
					{
						$(this).addClass("alert_field");
					}
					else
					{
						$(this).removeClass("alert_field");
					}
			});
		},
		onkeydown : function(evt)
		{
			var obj = this;
			evt = (evt) ? evt : document.event;
			var charcode = (evt.which) ? evt.which : evt.keyCode;
			if(obj.active)
			{
				if(charcode == 40)
				{
					var next = $("#"+obj.active+"_"+$("#"+obj.active).data("over")).next();
					if(next.length)
					{
						obj.select_option({drop_down:$("#"+next.data("type")+"_content"), value:next.data("value")});
						if(next.position().top >= $("#"+obj.active+"_content").outerHeight() - 22)
						{
							$("#"+obj.active+"_content").scrollTop($("#"+obj.active+"_content").scrollTop() + next.outerHeight());
						}
					}
					evt.preventDefault();
				}
				if(charcode == 38)
				{
					var previous = $("#"+obj.active+"_"+$("#"+obj.active).data("over")).prev();
					if(previous.length)
					{
						obj.select_option({drop_down:$("#"+previous.data("type")+"_content"), value:previous.data("value")});
						if(previous.position().top < 0)
						{
							$("#"+obj.active+"_content").scrollTop($("#"+obj.active+"_content").scrollTop() - previous.outerHeight());
						}
					}
					evt.preventDefault();
				}
				if(charcode == 13 || charcode == 9)
				{
					var current = $("#"+obj.active+"_"+$("#"+obj.active).data("over"));
					obj.select_option({drop_down:$("#"+current.data("type")+"_content"), value:current.data("value")});
					obj.expand({element:$("#"+obj.active)});
					if(charcode == 13)
					{
						evt.preventDefault();
					}
				}
			}
		},
		onclick : function(e)
		{
			var obj = this;
			if($(".expand_box_headings").length && !$(".expand_box_headings").is(e.target) && $(".expand_box_headings").has(e.target).length === 0 &&  !$(".expand_box_content").is(e.target) && $(".expand_box_content").has(e.target).length === 0)
			{
				obj.close($(".expand_box_headings").not(".content_heading"));
			}
		}
	},
	popups : {
		hide : function (popup)
		{
			var obj = this;
			if(!popup.hasOwnProperty("e") || (popup.hasOwnProperty("e") && $("#"+popup.id).find(".ajax_wrapper").has(popup.e.target).length === 0 && $("#"+popup.id).find(".ajax_wrapper").has(popup.e.target).length === 0))
			{
				$('#' + popup.id+"_overlay").hide();
				$('#' + popup.id+"_back").hide();
				$('#' + popup.id).hide();
				if(popup.hasOwnProperty("load_compulsary") && popup.load_compulsary)
				{
					$('#'+popup.id).css({width: '100px'});
					$('#'+popup.id).html("<img style='float:left; margin:34px;' src='<?php echo dir; ?>ajax-loader1.gif'>");
				}
				if(popup.hasOwnProperty("new_state") && popup.new_state)
				{
					history.go(-1);
				}
			}
		},
		show : function(id)
		{
			var obj = this;
			$('#' + id+"_overlay").show();
			$('#' + id+"_back").show();
			$('#' + id).show();
		},
		create : function(popup)
		{
			var obj = this;
			if($('#popups').find('#' + popup.name).length && !popup.load_compulsary)
			{
				obj.show(popup.name);
				return false;
			}
			else
			{
				if($('#popups').find('#' + popup.name).length && popup.load_compulsary)
				{
					obj.hide({id:popup.name, load_compulsary:true});
					obj.show(popup.name);
					return true;
				}
				else
				{
					var view = popup.force_view?" data-force_view="+true:"";
					view += popup.load_compulsary?" data-load_compulsary="+true:"";
					view += popup.new_state?" data-new_state="+true:"";
					var inner = "<div class='popup_back' id='" + popup.name + "_overlay'></div>";
					inner += "<div class='popup_container hide_popup' id='" + popup.name + "_back'>";
					inner += "<div class='popup_shadow' id='" + popup.name + "' "+view+">";
					inner += "<img style='float:left; margin:34px;' src='<?php echo dir; ?>ajax-loader1.gif'></div></div>";
					$("#popups").html($("#popups").html() + inner);
					obj.show(popup.name);
					return true;
				}
			}
		},
		load : function (parameters, callback_function)
		{
			var obj = this;
			plugins.new_request.ajax_request({
				url:'<?php echo dir; ?>ajax.php',
				parameters:parameters,
				beforeSend:"Loading..",
				error:"",
				success:""
			}, function(response,status,xhr){
				if(response.is_json && response.hasOwnProperty("data"))
				{
					var zindex = 555;
					$(".ajax_wrapper").each(function(){
						if($(this).parents(".popup_shadow").attr("data-new_state") == "true" && getstyle($(this).parents(".popup_shadow").attr("id"), "display") == "block")
						{
							zindex = parseInt(getstyle($(this).parents(".popup_container").attr("id"), "z-index")) + 2;
						}
					});
					if(response.data.hasOwnProperty("redirect"))
					{
						var page = {};
						previous = history.state;
						page.id = previous.id+1;
						page.url = response.data.redirect;
						page.title = response.data.title;
						page.anchor = {target:"content_container"};
						plugins.pagax.load_content({url:response.data.redirect, link:response.data.redirect, callback_parameters:{page:page, previous:previous, title:response.data.title}, anchor:page.anchor, post_parameters:{force_ajax:true}}, "navigation_callback");
						return false;
					}
					var title = response.data.hasOwnProperty("title")?response.data.title:history.state.title;
					parameters.content = response.data.content;
					obj.create({name:parameters.anchor.target, load_compulsary:true, new_state:true});
					plugins.pagax.set_page_content(parameters);
					$('#' + parameters.anchor.target+"_overlay").css({zIndex:zindex});
					$('#' + parameters.anchor.target+"_back").css({zIndex:zindex+2});
					obj.adjust_margins(parameters.anchor.target);
					if(callback_function != "")
					{
						if(typeof callback_function == 'function')
						{
							func = callback_function;
						}
						else
						{
							var func = window[callback_function];
						}
						if(func !== 'undefined' && $.isFunction(func))
						{
							callback_parameters = parameters.hasOwnProperty('callback_parameters')?parameters.callback_parameters:{};
							callback_parameters.title = title;
							func(callback_parameters);
						}
					}
				}
			});
		},

		adjust_margins : function(popup)
		{
			var obj = this;
			var wide = (popup.indexOf("property_details") >= 0)?"95%":$('#'+popup+'_wrapper').outerWidth();
			$('#'+popup).animate({width: wide}, 1);
			setTimeout(function(){ $('#'+popup+'_wrapper').show() }, 2 );
		},
		onkeydown : function(evt)
		{
			var obj = this;
			if(evt.keyCode == 27)
			{
				$(".popup_shadow").each(function(){
					if($(this).attr("data-force_view") != true && $(this).attr("data-force_view") != "true")
					{
						if(($(this).attr("data-new_state") == true || $(this).attr("data-new_state") == "true") && getstyle($(this).attr("id"), "display") != "none")
						{
							obj.hide({id:$(this).attr("id"), e:evt, new_state:true, load_compulsary:true});
						}
						else if($(this).attr("data-load_compulsary") == true || $(this).attr("data-load_compulsary") == "true")
						{
							obj.hide({id:$(this).attr("id"), load_compulsary:true});
						}
						else
						{
							obj.hide({id:$(this).attr("id")});
						}
					}
				});
			}
		},
		onready : function(e)
		{
			var obj = this;
			$(".hide_popup").unbind("click").click(function(e){
				var popup = $(this).parents(".popup_shadow").length?$(this).parents(".popup_shadow"):$(this).find(".popup_shadow");
				if(popup.data("force_view") != true && (popup.find(".ajax_wrapper").has(e.target).length === 0 || e.target.getAttribute("type") == "submit"))
				{
					if(popup.data("load_compulsary") == true)
					{
						if(popup.data("new_state") == true)
						{
							obj.hide({id:popup.attr("id"), e:e, new_state:true, load_compulsary:true});
						}
						else
						{
							obj.hide({id:popup.attr("id"), e:e, load_compulsary:true});
						}
					}
					else
					{
						obj.hide({id:popup.attr("id")});
					}
				}
			});
		}
	},
	validations : {
		form : function(parameters)
		{
			var obj = this;
			var elem = ["input:text", "input:password", "input:hidden", "input:checked", "select", "textarea"];
			container = $('#' + parameters.id);
			var flag = 0;
			for(var j = 0; j < elem.length; j++)
			{
				var inputs = container.find(elem[j]);
				for (var i = 0; i < inputs.length; ++i)
				{
					if(obj.conditions({element:inputs[i], skip_ajax_requests: parameters.hasOwnProperty("skip_ajax_requests")?parameters.skip_ajax_requests:false}))
					{
						flag++;
					}
				}
			}
			if(flag){return false;}
			return true;
		},

		conditions : function(parameters)
		{
			var obj = this;
			var element = parameters.element,
			element_id = element.getAttribute('id');
			element_name = element.hasAttribute('name')?element.getAttribute('name'):element_id;
			if(element.hasAttribute("data-name")){ var element_label = ucwords(element.getAttribute('data-name').replace("_", " ")); }
			else{ element_label = ucwords(element_name.replace("_", " ")); }
			var required = element.getAttribute('data-required'),
			required = (required == true || required == "true")?true:false,
			notzero = element.getAttribute('data-notzero'),
			notzero = (notzero == true || notzero == "true")?true:false,
			email = element.getAttribute('data-email'),
			email = (email == true || email == "true")?true:false,
			number = element.getAttribute('data-number'),
			number = (number == true || number == "true")?true:false,
			decimal = element.getAttribute('data-decimal'),
			decimal = (decimal == true || decimal == "true")?true:false,
			minlength = parseInt(element.getAttribute('data-minlength')),
			maxlength = parseInt(element.getAttribute('data-maxlength')),
			password = element.getAttribute('data-password'),
			password = (password == true || password == "true")?true:false,
			match = element.getAttribute('data-match'),
			match_existing = element.getAttribute('data-match_existing'),
			unique = element.getAttribute('data-unique');
			if(required)
			{
				var condition = (element.value == "" || (notzero && element.value == 0) || element.value == element.getAttribute('data-original'));
				var return_val = "";
				if(obj.alert(condition, element_id, 'required', element_label+' is required.'))
				{
					return_val = true;
				}
				if(password)
				{
					var condition = !(element.value.length >= 8 && element.value.length <= 16);
					var meter = "<div class=\"left margintop5 marginleft20\" id=\"password_strength_meter\"><span class=\"left\">Strength</span><div class=\"pw_checker_border\">";
					meter += "<div class=\"pw_checker_meter\">";
					meter += "<div class=\"pw_checker_incorrect\" id=\"pw_checker_incorrect\"></div>";
					meter += "<div class=\"pw_checker_correct\" id=\"pw_checker_correct\"></div>";
					meter += "</div>";
					meter += "</div>";
					meter += "<div class=\"pw_checker_value pw_red\" id=\"password_strength_value\">Weak</div></div>";
					if(!$("#" + element_id).closest(".table_row").find("#password_strength_meter").length)
					{
						$("#" + element_id).closest(".table_row").append(meter);
						$("#password_strength_meter").hide();
					}
					if(condition)
					{
						$("#password_strength_meter").show();
						$("#pw_checker_incorrect").show();
						$("#pw_checker_correct").hide();
						$("#password_strength_value").html("Weak");
						$('#'+ element_id).addClass('alert_field');
						return_val = true;
					}
					else
					{
						$("#password_strength_meter").show();
						$("#pw_checker_incorrect").hide();
						$("#pw_checker_correct").show();
						$("#password_strength_value").html("Strong");		
						$('#'+ element_id).removeClass('alert_field');
					}
				}
				if(return_val){ return return_val; }
			}
			if(email)
			{
				var test_email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				var condition = (!test_email.test(element.value));
				if(obj.alert(condition, element_id, 'email', 'Please enter a valid email.'))
				{
					return true;
				}
			}
			if(number)
			{
				var condition = (isNaN(element.value) || parseInt(Number(element.value)) != element.value || isNaN(parseInt(element.value, 10)));
				if(obj.alert(condition, element_id, 'number', 'Only digits allowed in ' + element_label))
				{
					return true;
				}
			}
			if(decimal)
			{
				var condition = (isNaN(element.value));
				if(obj.alert(condition, element_id, 'number', 'Only numbers allowed in ' + element_label))
				{
					return true;
				}
			}
			if(minlength)
			{
				var condition = (element.value.length < minlength);
				if(obj.alert(condition, element_id, 'minlength', 'Minimum ' + minlength + ' characters required in ' + element_label))
				{
					return true;
				}
			}
			if(maxlength)
			{
				var condition = (element.value.length > maxlength);
				if(obj.alert(condition, element_id, 'maxlength', 'Maximum ' + maxlength + ' characters allowed in ' + element_label))
				{
					return true;
				}
			}
			
			if(match)
			{
				var match_target = $("[name='"+match+"']");
				var match_name = match_target.attr('name')?match_target.attr('name'):match_target.attr('id');
				var condition = (element.value != match_target.val());
				if(obj.alert(condition, element_id, 'match', element_label+ ' must match ' + match_name.replace("_", " ")))
				{
					return true;
				}
			}

			if(match_existing && !parameters.skip_ajax_requests)
			{
				var ret = "";
				parameters = {request:"ajax", action:match_existing};
				parameters[element_name] = element.value;
				plugins.new_request.ajax_request({
					url:'<?php echo dir; ?>ajax.php',
					parameters:parameters,
					beforeSend:"Loading..",
					error:"",
					success:""
				}, function(response,status,xhr){
						if(obj.alert((response.data.match==false), element_id, 'match_existing', 'Incorect '+element_label))
						{
							return true;
						}
				});
				if(ret == true){ return true; }
			}

			if(unique && !parameters.skip_ajax_requests)
			{
				var ret = "";
				parameters = {request:"ajax", action:unique};
				parameters[element_name] = element.value;
				plugins.new_request.ajax_request({
					url:'<?php echo dir; ?>ajax.php',
					parameters:parameters,
					beforeSend:"Loading..",
					error:"",
					success:""
				}, function(response,status,xhr){
						if(obj.alert((response.data.unique==false), element_id, 'unique', element_label+' already exists.'))
						{
							return true;
						}
				});
				if(ret == true){ return true; }
			}	

		},

		alert : function(condition, element_id, validate, message)
		{
			if(condition)
			{
				if(!$('#' + validate+'_alert_' + element_id).length)
				{
					$('#'+ element_id).after("<span class='form_alert alert_"+element_id+"' id='"+validate+"_alert_"+element_id+"'>"+message+"</span>");
				}
				$('#' + validate+'_alert_' + element_id).show();
				$('#'+ element_id).addClass('alert_field');
				return true;
			}
			else
			{
				$('#'+element_id).removeClass('alert_field');
				$('#' + validate+'_alert_'+element_id).hide();
				return false;
			}
		}
	},
	new_request : {
		last_request:{url:window.location.href, parameters:{location:window.location.href}, beforeSend:"", error:"", success:""},
		request_count : 0,
		ajax_request : function(feed, callback)
		{
			var obj = this;
			if(!feed.hasOwnProperty("callback_parameters")){ feed.callback_parameters = {}; }
			var beforeSend = feed.hasOwnProperty("beforeSend")?feed.beforeSend:"",
			error = feed.hasOwnProperty("error")?feed.error:"Error on Page",
			success = feed.hasOwnProperty("success")?feed.success:"",
			request = $.ajax({
				url:feed.url,
				data:feed.parameters,
				type:"POST",
				timeout:30000,
				beforeSend:function()
				{
					if(beforeSend)
					{
						$("#content_loading_message").html(beforeSend);
						$("#content_success_box").hide();
						$("#content_loading_box").show();
						$("#content_loader").show();
					}
					obj.last_request = {url:feed.url, parameters:feed.parameters, beforeSend:beforeSend, error:error, success:success};
					if(callback != "")
					{
						obj.callback_function = callback;
					}
				},
				success:function(response,status,xhr)
				{
					/*alert(response);*/
					feed.callback_parameters.is_json = true;
					try
					{
						response = $.parseJSON(response);
					}
					catch(err)
					{
						feed.callback_parameters.is_json = false;
					}
					feed.callback_parameters.data = response.data;
					if(typeof obj.callback_function == 'function')
					{
						func = obj.callback_function;
					}
					else
					{
						var func = window[obj.callback_function];
					}
					obj.callback_function = "";
					if(func !== 'undefined' && $.isFunction(func))
					{
						func(feed.callback_parameters);
					}
					if(success && (response == null || (!response.hasOwnProperty("error") || (response.hasOwnProperty("error") && !response.error))))
					{
						if(feed.callback_parameters.is_json && response.data.hasOwnProperty("onload"))
						{
							eval(response.data.onload);
						}
						$("#content_loading_box").hide();
						$("#content_success_message").html(success);
						$("#content_success_box").show();
						setTimeout(function(){ $("#content_success_box").fadeOut(function(){ $("#content_loader").hide(); }); }, 1000);
					}
					else if(error && (response == null || response.hasOwnProperty("error") && response.error))
					{
						if(feed.callback_parameters.is_json && response.data.hasOwnProperty("onload"))
						{
							eval(response.data.onload);
						}
						$("#content_loading_message").html(error);
					}
					else
					{
						$("#content_success_box").hide();
						$("#content_loader").hide();
					}
					obj.last_request = {url:window.location.href, parameters:{location:window.location.href}, beforeSend:"", error:"", success:""};
				},
				complete:function()
				{
					$("#dashboard_request_try_again").click(function(){ obj.ajax_request(obj.last_request, '') });
				},
				error:function(xhr,status,error)
				{
					if(status == "error")
					{
						$("#content_loading_message").html("Error!&nbsp;No internet connection.<a class=\"link\" id=\"dashboard_request_try_again\" style=\"float:none; margin-top:0;\">Try Again</a>");
					} 
					if(status == "timeout")
					{
						$("#content_loading_message").html("Error!&nbsp;Connection Timed out.<a class=\"link\" id=\"dashboard_request_try_again\" style=\"float:none; margin-top:0;\">Try Again</a>");
						if(obj.request_count < 3)
						{
							var countTime = 5;
							$("#content_loading_message").html("Error!&nbsp;Connection Timed out.&nbsp;Trying Again in "+countTime+" sec.");
							var setTime = setInterval(function(){
								countTime--;
								$("#content_loading_message").html("Error!&nbsp;Connection Timed out.&nbsp;Trying Again in "+countTime+" sec.");
								if(!countTime)
								{
									clearInterval(setTime);
								}
							}, 1000);
							setTimeout(function(){ obj.request_count++; obj.ajax_request(feed, ''); }, 5500);
						}
					}
				}
			});
		},

		submit_form : function(parameters, callback_function)
		{
			var obj = this;
			if(!parameters.hasOwnProperty("form_parameters"))
			{
				if(plugins.validations.form({id:parameters.id, skip_ajax_requests:true}) == false)
				{
					return false;
				}
				if((window.ActiveXObject || "ActiveXObject" in window))
				{
					return true;
				}
				var beforeSend = parameters.hasOwnProperty("beforeSend")?parameters.beforeSend:"",
				error = parameters.hasOwnProperty("error")?parameters.error:"",
				success = parameters.hasOwnProperty("success")?parameters.success:"",
				container = $('#' + parameters.id),
				url = "<?php echo dir; ?>ajax.php",
				para = {action:parameters.action, request:"ajax"};
				para = $.extend({}, para, plugins.forms.get_values(parameters.id));
				para["get_parameters"] = parseQueryString(location.search);
				parameters.form_parameters = {
					id:parameters.id,
					url:url,
					parameters:para,
					beforeSend:beforeSend,
					error:error,
					success:success,
				};
			}
			obj.ajax_request(parameters.form_parameters, function(response){
				if(response != "")
				{
					if(callback_function != "")
					{
						if(typeof callback_function == 'function')
						{
							func = callback_function;
						}
						else
						{
							var func = window[callback_function];
						}
						if(func !== 'undefined' && $.isFunction(func))
						{
							callback_parameters = parameters.hasOwnProperty('callback_parameters')?parameters.callback_parameters:{};
							callback_parameters.data = response.data;
							callback_parameters.title = response.data.title;
							callback_parameters.form_parameters = true;
							func(callback_parameters);
						}
					}
				}
			});
			return false;
		}
	},
	pagax : {
		load_content : function(parameters, callback_function)
		{
			var obj = this;
			if(parameters.anchor.target.indexOf("_popup") >= 0)
			{
				var state_parameters = {request:"page", page_location:parameters.link, action:parameters.anchor.data.action, data:parameters.anchor.data, anchor:parameters.anchor};
				if(parameters.hasOwnProperty('callback_parameters'))
				{
					state_parameters.callback_parameters = parameters.callback_parameters;
				}
				plugins.popups.load(state_parameters, callback_function)
			}
			else
			{
				var ajax_parameters = {
					url: parameters.hasOwnProperty("url")?parameters.url:'<?php echo dir; ?>ajax.php',
					parameters:{request:"page", page_location:parameters.link, requesting_url:window.location.href},
					beforeSend:"Loading..",
					error:"",
					success:""
				};
				if(parameters.hasOwnProperty("post_parameters"))
				{
					ajax_parameters.parameters = $.extend({}, ajax_parameters.parameters, parameters.post_parameters);
				}
				plugins.new_request.ajax_request(ajax_parameters, function(response,status,xhr){
					if(response.data == "")
					{
						window.location = parameters.link;
					}
					else
					{
						if(response.data.hasOwnProperty("redirect"))
						{
							var page = {};
							previous = history.state;
							page.id = previous.id+1;
							page.url = response.data.redirect;
							page.title = response.data.title;
							page.anchor = {target:"content_container"};
							obj.load_content({url:response.data.redirect, link:response.data.redirect, callback_parameters:{page:page, previous:previous, title:response.data.title}, anchor:page.anchor, post_parameters:{force_ajax:true}}, "navigation_callback");
							return false;
						}
						var title = response.data.hasOwnProperty("title")?response.data.title:history.state.title;
						parameters.content = response.data.content;
						obj.set_page_content(parameters);
					}
					if(callback_function != "")
					{
						if(typeof callback_function == 'function')
						{
							func = callback_function;
						}
						else
						{
							var func = window[callback_function];
						}
						if(func !== 'undefined' && $.isFunction(func))
						{
							callback_parameters = parameters.hasOwnProperty('callback_parameters')?parameters.callback_parameters:{};
							callback_parameters.title = title;
							func(callback_parameters);
						}
					}
				});
			}
		},

		set_page_content : function(parameters)
		{
			var obj = this;
			$("#"+parameters.anchor.target).html(parameters.content);
			$('html, body').animate({scrollTop: 0}, 1);
			
			$(".links_widget").find(".selected_menu_tab, .menu_tab").addClass("menu_tab").removeClass("selected_menu_tab").find(".selected_link, .link").addClass("link").removeClass("selected_link");
			$(".links_widget").find(".menu_tab").find(".selected_menu_drop_downs").addClass("menu_drop_downs").removeClass("selected_menu_drop_downs");
			$(".links_widget").find(".menu_tab").find(".menu_drop_downs").find(".selected_link, .link").addClass("link").removeClass("selected_link");
			
			if($("#"+parameters.anchor.id).length)
			{
				var menu_link = $("#"+parameters.anchor.id);
			}
			else
			{
				var menu_link = $(".links_widget").find(".link[href='"+parameters.link+"']");
				if(menu_link.length)
				{
					menu_link = $("#"+menu_link.attr("id"));
				}
			}
			if(menu_link.length)
			{
				menu_link.addClass("selected_link").removeClass("link");
				menu_link.parents(".menu_drop_downs").addClass("selected_menu_drop_downs").removeClass("menu_drop_downs").show();
				$("#"+menu_link.parents(".selected_menu_drop_downs").data("menu_item")+"_link").addClass("selected_link").removeClass("link")
				.parents(".menu_tab").addClass("selected_menu_tab").removeClass("menu_tab");
			}
			$(".page_loader").hide();
			/*setTimeout(function(){*/ plugins.sidebar_navigation.hide(); /*}, 200);*/
			adjust_page();
			if(parameters.anchor.target != "content_container")
			{
				$("#"+parameters.anchor.target).offsetParent().animate({scrollTop:$("#"+parameters.anchor.target).offset().top - $("#"+parameters.anchor.target).offsetParent().offset().top + $("#"+parameters.anchor.target).offsetParent().scrollTop()}, 300);
			}
		},
		onpopstate : function(event)
		{
			var obj = this;
			if(event.state)
			{
				if(event.state.hasOwnProperty('next') && event.state.next.anchor.target.indexOf("_popup") >= 0)
				{
					plugins.popups.hide({id:event.state.next.anchor.target, e:event, load_compulsary:true});
					window.history.replaceState(event.state,event.state.title, event.state.url);
					analytics.state = {url:event.state.url, referer:""};
					analytics.track();
					document.title = event.state.title;
				}
				else
				{
					obj.load_content({url:event.state.url, link:event.state.url, anchor:event.state.anchor, post_parameters:{force_ajax:true}}, function(parameters){
						window.history.replaceState(event.state,parameters.title, event.state.url);
						analytics.state = {url:event.state.url, referer:""};
						analytics.track();
						document.title = parameters.title;
					});
				}
			}
		},
		onready : function(event)
		{
			var obj = this;
			if(!(window.ActiveXObject || "ActiveXObject" in window))
			{
				var url = window.location.href == "<?php echo dir; ?>"?window.location.href+"index":window.location.href;
				var state_parameters = {
					id:0,
					url:url,
					title:document.title,
					anchor:{target:"content_container", id:$(".menu_tab").find("a[href='"+url+"']").attr('id')}
				};
				if(history.state)
				{
					if(history.state.hasOwnProperty('next'))
					{
						state_parameters.next = history.state.next;
					}
					if(history.state.hasOwnProperty("form_parameters"))
					{
						state_parameters.form_parameters = history.state.form_parameters;
					}
				}
				window.history.replaceState(state_parameters, document.title, url);
			}
			$("a").unbind("click").click(function(){
			var anchor = $(this);
			var location = anchor.attr('href');
			if(anchor.data("no_reload"))
			{
				if(location && anchor.data("target"))
				{
					if(location == window.location.href)
					{
						setTimeout(function(){ plugins.sidebar_navigation.hide(); }, 200);
						adjust_page();
					}
					else
					{
						var page = {};
						previous = history.state;
						page.id = previous.id+1;
						page.url = location;
						page.title = document.title;
						page.anchor = {target:anchor.data('target'), id:anchor.attr('id'), data:anchor.data()};
						if(!(window.ActiveXObject || "ActiveXObject" in window))
						{
							var parameters = {link:location, anchor:page.anchor, callback_parameters:{page:page, previous:previous}};
							if(anchor.data("url") == true){ parameters.url = location; parameters.post_parameters = {force_ajax:true}; }
							if(anchor.find(".expand_box_headings:first-child").length)
							{
								var expand_box = anchor.find(".expand_box_headings:first-child");
								if(!expand_box.hasClass("active") || $("#"+expand_box.attr("id")+"_content").html() != "")
								{
									return false;
								}
							}
							obj.load_content(parameters, "navigation_callback");
						}
					}
				}
				if(!(window.ActiveXObject || "ActiveXObject" in window)){ return false; }
			}
			});
		}
	},
	
	image_cropper : {
		move : false,
		drag_type : "",
		image_height : 0,
		image_width : 0,
		half_width : 0,
		cropper_margin_left : 0,
		cropper_initial : {},
		mouse_initial : {},
		onready : function(e)
		{
			var obj = this;
			$(document).mouseup(function(){
				obj.drag_type = "";
			});
			$("#crop_w_resize, #crop_nw_resize, #crop_n_resize").mousedown(function(e){
				obj.drag_type = $(this).attr("data-type");
				obj.cropper_initial = {
				position : { right : parseFloat($("#crop_image_border").css("marginRight")), top : parseFloat($("#crop_image_border").css("marginTop")) },
				height : ($("#crop_w_resize").height() + 10),
				width : ($("#crop_n_resize").width()+10)};
				obj.mouse_initial = {
				   left : e.pageX,
				   top : e.pageY
				};
			});
			$("#crop_image_border").mousedown(function(e){
				if(!obj.drag_type)
				{
					obj.drag_type = $(this).attr("data-type");
					obj.cropper_initial = {
						position : { right : parseFloat($("#crop_image_border").css("marginRight")), top : parseFloat($("#crop_image_border").css("marginTop")) },
						height : ($("#crop_w_resize").height() + 10),
						width : ($("#crop_n_resize").width()+10)
						};
					obj.mouse_initial = {
						left : e.pageX,
						top : e.pageY
					};
				}
			});
			$(document).mousemove(function(e){
				if(obj.drag_type == "w_resize" || obj.drag_type == "n_resize" || obj.drag_type == "nw_resize" || obj.drag_type == "image_border")
				{
					e.preventDefault();
					var parentOffset = $("#crop_image_container").parent().offset(),
					mouse_current = {
						left : e.pageX,
						top : e.pageY
						};
					
					obj.image_height = $("#crop_image_container").height();
					obj.image_width = $("#crop_image_container").width();
					obj.half_width = obj.image_width/2;
					var cropper_width = obj.cropper_initial.width,
					cropper_height = obj.cropper_initial.height,
					mouse_move = {
						left : (mouse_current.left - obj.mouse_initial.left),
						top : (mouse_current.top - obj.mouse_initial.top)
						};
					if(obj.drag_type == "w_resize" || obj.drag_type == "nw_resize")
					{
						var cropper_margin_right = obj.cropper_initial.position.right - mouse_move.left;
						cropper_width += mouse_move.left;
						if(!(cropper_margin_right >= -obj.half_width))
						{
							var full_width = obj.cropper_initial.position.right + obj.cropper_initial.width + obj.half_width;
							cropper_width = full_width;
							cropper_margin_right = -obj.half_width;
						}
						if(cropper_width <= 10)
						{
							cropper_margin_right = obj.cropper_initial.position.right + obj.cropper_initial.width - 10;
							cropper_width = 10;
						}
						
						var animation = {marginRight: cropper_margin_right+ 'px'},
						set_resize_width = {width: (cropper_width - 10)+ 'px'},
						set_cropper_width = {width: cropper_width+ 'px'};
					}
					if(obj.drag_type == "n_resize" || obj.drag_type == "nw_resize")
					{
						var margin_top = (obj.image_height/2) + obj.cropper_initial.position.top;
						cropper_height += mouse_move.top - 10;
						if(!(cropper_height + margin_top + 10 <= obj.image_height))
						{
							cropper_height = obj.image_height - margin_top - 10;
						}
						var set_resize_height = {height: cropper_height + 'px'};
					}
					if(obj.drag_type == "image_border")
					{
						var cropper_margin_right = (obj.cropper_initial.position.right - mouse_move.left),
						cropper_margin_top = (obj.cropper_initial.position.top + mouse_move.top),
						animation = {};
						if(!(cropper_margin_right >= -obj.half_width))
						{
							cropper_margin_right = -obj.image_width/2;
						}
						if(!(cropper_margin_right <= (obj.half_width - cropper_width)))
						{
							cropper_margin_right = obj.half_width - cropper_width;
						}
						animation["marginRight"] = cropper_margin_right+ 'px';
						if(!(cropper_margin_top >= -(obj.image_height/2)))
						{
							cropper_margin_top = -obj.image_height/2;
						}
						if(!(cropper_margin_top <= ((obj.image_height/2) - cropper_height)))
						{
							cropper_margin_top = (obj.image_height/2) - cropper_height;
						}
						animation["marginTop"] = cropper_margin_top + 'px';
					}
					if(set_resize_width)
					{
						$("#crop_n_resize").animate(set_resize_width, 0);
						$("#crop_image_border").animate(set_cropper_width, 0);
					}
					if(set_resize_height)
					{
						$("#crop_w_resize").animate(set_resize_height, 0);
					}
					if(animation)
					{
						$("#crop_image_border").animate(animation, 0);
					}
						cropper_margin_right = parseFloat($("#crop_image_border").css("marginRight"));
						cropper_margin_top = parseFloat($("#crop_image_border").css("marginTop"));
						cropper_width = $("#crop_image_border").width();
						cropper_height = $("#crop_image_border").height();

						var cropped_height = (obj.image_height/cropper_height) * $("#reflect_cropped_image").parents(".cropped_image_container").outerHeight();
						$("#reflect_cropped_image").css({height:cropped_height+'px'});
						var cropped_width = (obj.image_width/cropper_width) * $("#reflect_cropped_image").parents(".cropped_image_container").outerWidth();;
						$("#reflect_cropped_image").css({width:cropped_width+'px'});
						var cropped_margin_left = -((obj.half_width - cropper_margin_right - cropper_width)/obj.image_width) * cropped_width;
						$("#reflect_cropped_image").css({marginLeft:cropped_margin_left+'px'});
						var cropped_margin_top = -(((obj.image_height/2) + cropper_margin_top)/obj.image_height) * cropped_height;
						$("#reflect_cropped_image").css({marginTop:cropped_margin_top+'px'});
				}
			});
		}
	}
};

function populate_options(parameters)
{
	var options = "<option value=''>"+$("#"+parameters.drop_down).data("heading")+"</option>";
	$.each(parameters.option_list, function(key, val){
		options += "<option value='"+key+"'>"+val+"</option>";
	});
	$("#"+parameters.drop_down).html(options);

	/*calling the function "plugins.expand_box.generate_options" of the expand box plugin to populate the same options in custom drop down*/
	var blank_option = (parameters.hasOwnProperty("blank_option") && parameters.blank_option == true)?true:false;
	plugins.expand_box.generate_options({class_name:"expand_drop_"+parameters.drop_down, options:$("#"+parameters.drop_down+" > option"), selected_value:"", blank_option:blank_option});
	if(parameters.hasOwnProperty("selected_option"))
	{
		plugins.expand_box.select_option({drop_down:$("#"+"expand_drop_"+parameters.drop_down+"_content"), value:parameters.selected_option});
	}
}

function ready_and_ajax_complete()
{
	if($("[data-editor='true']").length)
	{
		$("[data-editor='true']").each(function(){	
			var instance = $(this).attr("id"),
			instance_name = $(this).attr("name");

			var editor = CKEDITOR.instances[instance];
			if(!editor || !$("#cke_"+instance).length)
			{
				CKEDITOR.replace( instance_name );
				var editor = CKEDITOR.instances[instance];
				editor.on("change", function(){
					$("#"+instance).val(editor.getData());
				});
				editor.on("key", function(){
					$("#"+instance).val(editor.getData());
				});
			}
		});
	}

	$("input:text, input:password, input:hidden, select, textarea").unbind("focusout").focusout( function(){
		var field = $(this),
		id = $(this).attr("id");
		plugins.validations.conditions({element:document.getElementById(id)});
		var original = field.attr('data-original'),
		val = field.val();
		if(val == ""){ field.val(original); }
	});

	$("input:text").keydown(function(e){
		var field = $(this),
		id = $(this).attr("id"),
		number = field.attr('data-number'),
		number = (number == true || number == "true")?true:false,
		decimal = field.attr('data-decimal'),
		decimal = (decimal == true || decimal == "true")?true:false;
		if(number || decimal)
		{
			return check_input(e, id, number?"number":"decimal");
		}
	});

	$("input:text, textarea").unbind("focusin").focusin(function() {
		var field = $(this);
		var original = field.attr('data-original'),
		val = field.val();
		if(val == original){ field.val(''); }
	});
	var input_change;
	$("select, input").unbind("change").change(function() {
		var form = $(this).parents("form");
		if(form.data("onchange") == "submit")
		{
			if (input_change){ clearTimeout(input_change); }
			var last_change = $(this).attr("id");
			$("#last_change").val(last_change);
			input_change = setTimeout(function(){
				form.submit();
				return false;
			}, 200);
		}
	});

	$("form").unbind("submit").submit(function(){
		return plugins.validations.form({id:$(this).attr('id')});
	});
	
	$("[data-required='true']").each(function(){
		var element = $(this).closest( ".page_row" ).find(".field_label");
		if(!element.find("span").length)
		{
			element.append("<span> *</span>");
		}
	});

	$(".parent_input").unbind("change").change(function(){
		var name = $(this).attr("name"),
		form_name = $(this).parents("form").attr("name"),
		type = $(this).attr("type"),
		id = $(this).attr("id"),
		id = "";
		$(".parent_input[name='"+name+"']").each(function(){
			var id = ($(this).attr("disabled") != "disabled")?$(this).attr("id"):id;
		});
		id = $(".parent_input[name='"+name+"']:not(disabled)").attr("id"),
		value = $("#"+id).val();
		if(page_vars.hasOwnProperty("relationships"))
		{
			if(type == "text" || type == "hidden")
			{
				var show = page_vars.relationships[name][0];
				var condition = (value && value != 0)?true:false;
			}
			else if(type == "checkbox" || type == "radio")
			{
				id = $(".parent_input[name='"+name+"']:checked").attr("id");
				condition = ($(".parent_input[name='"+name+"']:checked").attr("disabled") != "disabled");
				value = $("#"+id).val();
				var show = page_vars.relationships[name][value];
			}
			else
			{
				var show = page_vars.relationships[name][value];
				var condition = true;
			}
			if(id != undefined && id != "")
			{
				$("."+name+"_child").attr("disabled", true).attr("data-required", false).hide().closest( ".page_row" ).hide().find(".field_label").find("span").remove();
				$("."+name+"_child").each(function(){
					if($("#expand_drop_"+$(this).attr("id")).length)
					{
						$("#expand_drop_"+$(this).attr("id")).addClass("disabled").hide();
					}
				});
				if(condition)
				{
					$.each(show, function(key, val){
						key = form_name+"_"+key;
						$("#" + key).attr("disabled", false).attr("data-required", val).closest(".page_row").show();
						if($("#expand_drop_"+key).length)
						{
							$("#expand_drop_"+key).removeClass("disabled").show();
						}
						else
						{
							$("#" + key).show();
						}
						if(val && !$("#" + key).closest( ".page_row" ).find(".field_label").find("span").length)
						{
							$("#" + key).closest( ".page_row" ).find(".field_label").append("<span> *</span>");
						}
					});
				}
			}
			$.each($("."+name+"_child"), function(){
			if($(this).hasClass("parent_input"))
			{
				$(this).trigger("change");
			}
			});
		}
	});
	
	$(".jquery_tabs").click(function(){
	$(".jquery_tabs").removeClass("active_jquery_tab");
	$(this).addClass("active_jquery_tab");
	$(".jquery_tabs_content").removeClass("shown").hide();
	$("#"+$(this).attr('data-type')).show();
	});

	$(".tabs").unbind("click").click(function(){
	if($(this).hasClass("active_tab"))
	{
	close_all_tabs();
	}
	else
	{
		close_all_tabs();
		$(this).addClass("active_tab");
		$("#"+$(this).attr('data-type')).show();
	}
	});

	$("#refine_search_title").click(function(){
		$(".refine_search_inner").slideToggle();
	});

	$("select[multiple]").change(function(){
		var string_val = "", id = $(this).attr("id");
		$.each($(this).val(), function(key, value){
			string_val += string_val?","+value:value;
		});
		$("#expand_drop_"+id+"_text").val(string_val);
	});

	$(".project_link, #project_title, #start_project").unbind("click").click(function(){
	$('html, body').animate({scrollTop: $($(this).attr("href")).offset().top - $(".project_nav").outerHeight()}, 300);

	if(getstyle("toggle-nav", "display") == "block")
	{
		$("#toggle_nav_container").hide();
	}
	return false;
	});

	$('.popup_shadow').bind('mousewheel DOMMouseScroll', function(e) {
		var scrollTo = null;

		if (e.type == 'mousewheel') {
			scrollTo = (e.originalEvent.wheelDelta * -1);
		}
		else if (e.type == 'DOMMouseScroll') {
			scrollTo = 40 * e.originalEvent.detail;
		}

		if (scrollTo) {
			e.preventDefault();
			$(this).scrollTop(scrollTo + $(this).scrollTop());
		}
	});

	$(".toggle-nav").unbind("click").click(function(){
		$("#toggle_nav_container").slideToggle();
	});

	$("select[data-state='true'], select[data-city='true']").unbind("change").change(function(){
		var obj = $(this),
		type = (obj.data("state") == true)?"state":"city",
		request = (obj.data("state") == true)?"cities":"localities",
		drop_down = (obj.data("state") == true)?obj.data("city"):obj.data("locality"),
		parameters = {request:"ajax", action:"get_"+request};
		parameters[type] = obj.val();
		if(obj.val() != "" && obj.val() != 0)
		{
			plugins.new_request.ajax_request({
			url:'<?php echo dir; ?>ajax.php',
			parameters:parameters,
			beforeSend:"Loading...",
			error:"",
			success:""
			}, function(response,status,xhr){
				populate_options({option_list:response.data[request], blank_option:true, drop_down:drop_down, selected_option:''});
				if(type == "state" && $("#"+obj.data("city")).data("locality"))
				{
					populate_options({option_list:{}, blank_option:true, drop_down:$("#"+obj.data("city")).data("locality"), selected_option:''});
				}
			});
		}
		else
		{
			populate_options({option_list:{}, blank_option:true, drop_down:drop_down, selected_option:''});
			if(type == "state" && $("#"+obj.data("city")).data("locality"))
			{
				populate_options({option_list:{}, blank_option:true, drop_down:$("#"+obj.data("city")).data("locality"), selected_option:''});
			}
		}
	});

	$(".menu_link").unbind("click").click(function(){
		$(".menu_drop_downs").not("[data-menu_item='"+$(this).data("menu_item")+"']").slideUp(200);
		$("#" + $(this).attr('data-menu_item')+"_drop_down").not(".selected_menu_drop_downs").slideToggle(200);
	});
	$(document).unbind("click").click(function(e){
		if($("#refine_search_box").has(e.target).length == 0 && !$("#refine_search_box").is(e.target))
		{
			$("#refine_search_more").slideUp();
		}
		else
		{
			$("#refine_search_more").slideDown();
		}
		if($(".tabs").has(e.target).length === 0 && $(".tabs_content").has(e.target).length === 0 && !$(".tabs").is(e.target) && !$(".tabs_content").is(e.target))
		{
			close_all_tabs();
		}
		if($(".toggle-nav").length !== 0 && $(".toggle-nav").has(e.target).length === 0 && !$(".toggle-nav").is(e.target) && getstyle("toggle-nav", "display") == "block")
		{
			$("#toggle_nav_container").hide();
		}
		if(!$(".menu_link").is(e.target) && $(".menu_link").has(e.target).length === 0 && !$(".menu_drop_downs").is(e.target) && $(".menu_drop_downs").has(e.target).length === 0)
		{
			$(".menu_drop_downs").hide();
		}
		$.each(plugins, function(key, func){
			if($.isFunction(func.onclick))
			{
				func.onclick(e);
			}
		});
	});
	$(document).unbind("mousedown").mousedown(function(e){
		$.each(plugins, function(key, func){
			if($.isFunction(func.onmousedown))
			{
				func.onmousedown(e);
			}
		});
	});

	$(document).unbind("keydown").keydown(function(evt){
		$.each(plugins, function(key, func){
			if($.isFunction(func.onkeydown))
			{
				func.onkeydown(evt);
			}
		});
	});

	$.each(plugins, function(key, func){
		if($.isFunction(func.onready))
		{
			func.onready();
		}
	});
	$(window).scroll(function(){
		$.each(plugins, function(key, func){
			if($.isFunction(func.onscroll))
			{
				func.onscroll();
			}
		});
		lazy_loading();
	});

	$("#login_form, #search_form, #change_password_form").unbind("submit").submit(function(){
		var id = $(this).attr("id"),
		success = {login_form:"Login Successful", search_form:"", change_password_form:"Password changed Successfully!!"},
		error = {login_form:"Incorrect login id/password", search_form:"Please rectify the errors", change_password_form:"Please rectify the errors"},
		callback_parameters = {};
		return submit_form({id:id, success:success, error:error, callback_parameters:callback_parameters});
	});
	lazy_loading();
	adjust_page();
	
	
	
	$(".ratings").find("span").mouseover(function(){
		var current = $(this).parents(".ratings"),
		rating = $(this).index()+1;
		$("#"+current.attr("id")+" span:lt("+rating+")").addClass("rated");
		$("#"+current.data("type")+"_rating").html(rating);
		$("[name='"+current.data("type")+"']").val(rating);
	});
	$(".ratings").find("span").mouseout(function(){
		var current = $(this).parents(".ratings");
		$("#"+current.attr("id")+" span").removeClass("rated");
		$("#"+current.data("type")+"_rating").html(0);
		$("[name='"+current.data("type")+"']").val(0);
	});
	
	if($("#refine_search_more").length != 0)
	{
		var show_refine_search;
		$("#refine_search_box").mouseout(function(){
			show_refine_search = setTimeout(function(){ $("#refine_search_more").slideUp(); }, 2000);
		});
		$("#refine_search_box").mouseover(function(){
			if(show_refine_search){ clearTimeout(show_refine_search); }
		});
	}
}
/*ready_and_ajax_complete end*/

function parseQueryString(queryString)
{
	if(queryString)
	{
		var params = {}, queries, temp, i, l;
		queryString = queryString.split("?");
		queries = queryString[1].split("&");
		for ( i = 0, l = queries.length; i < l; i++ ) 
		{
			temp = queries[i].split('=');
			params[temp[0]] = temp[1];
		}
    return params;
	}
};

function submit_form(parameters)
{
	submit_parameters = {
		id : parameters.id,
		action : $("#"+parameters.id).find("[name='action']:checked").length?$("#"+parameters.id).find("[name='action']:checked").val():$("#"+parameters.id).data("action"),
		beforeSend : "Loading...",
		success : parameters.success[parameters.id],
		error : parameters.error[parameters.id]
	};
	if(parameters.callback_parameters.hasOwnProperty(parameters.id) && $.isPlainObject(parameters.callback_parameters[parameters.id]) && !$.isEmptyObject(parameters.callback_parameters[parameters.id]))
	{
		submit_parameters.callback_parameters = parameters.callback_parameters[parameters.id];
	}
	return plugins.new_request.submit_form(submit_parameters, parameters.id+"_callback");
}

function change_password_form_callback(parameters)
{
	return other_callback(parameters)
}

function login_form_callback(parameters)
{
	location.reload();
}

function search_form_callback(parameters)
{
	parameters.sidebar_link = "sidebar_properties";
	return sidebar_link_callback(parameters)
}

function sidebar_link_callback(parameters)
{
	var page = {}, anchor = $("#" + parameters.sidebar_link);
	previous = history.state;
	page.id = previous.id+1;
	page.url = parameters.data.url;
	page.title = document.title;
	page.form_parameters = parameters.form_parameters;
	page.anchor = {target:"content_container", id:anchor.attr('id'), data:anchor.data()};
	plugins.pagax.set_page_content({link:parameters.data.url, anchor:page.anchor, content: parameters.data.content});
	return navigation_callback({page: page, previous: previous, title:parameters.data.title});
}

function other_callback()
{
	var page = {};
	previous = history.state;
	page.id = previous.id+1;
	page.url = parameters.data.url;
	page.title = document.title;
	page.form_parameters = parameters.form_parameters;
	page.anchor = {target:"content_container"};
	plugins.pagax.set_page_content({link:parameters.data.url, anchor:page.anchor, content: parameters.data.content});
	return navigation_callback({page: page, previous: previous, title:parameters.data.title});
}

function navigation_callback(parameters)
{
	parameters.page.title = parameters.title;
	parameters.previous['next'] = parameters.page;
	window.history.replaceState(parameters.previous,parameters.previous.title,parameters.previous.url);
	window.history.pushState(parameters.page,parameters.page.title,parameters.page.url);
	analytics.state = {url:parameters.page.url, referer:parameters.previous.url};
	analytics.track();
	document.title = parameters.title;
}

function check_input(evt, id, type) 
{
	evt = (evt) ? evt : document.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (!(charCode >= 112 && charCode <= 123 && charCode != 27) && ((charCode > 31 && charCode < 41) || (charCode > 57 && charCode < 96) || (type == "number" && charCode > 105) || (type == "decimal" && !(charCode == 110 || charCode == 190) && charCode > 105)))
	{
		return false;
	}
	return true;
}

function ucwords(word) { return word.replace(/\b[a-z]/g, function(letter){ return letter.toUpperCase(); } ); }

function adjust_page()
{
	var margintop = $("#topbar").outerHeight();
	if($(".project_image").length)
	{
		$(".project_image").css({height:$(window).height() - margintop});
	}
	if($("#search_filter_box").length)
	{
		$("#search_filter_box").css({marginTop:margintop + "px"});
		if(getstyle("filter_results", "display") == "none")
		{
			margintop += $("#refine_search_box").outerHeight() - ((getstyle("filter_results", "display") == "block" || getstyle("refine_search_more", "display") == "block")?$("#refine_search_more").outerHeight():0);
		}
		else
		{
			margintop += $("#filter_results").outerHeight();
		}
/*		if($(".filter_content_box").length)
		{
			$(".filter_content_box").css({marginTop:$("#search_filter_box").outerHeight() - 1 + "px"});			
		}
*/		if($("#property_list").length)
		{
			$("#property_list").css({marginTop:$("#search_filter_box").outerHeight() + "px"});
		}
	}
	if($("#refine_search_container").length)
	{
		$("#refine_search_container").css({marginTop:margintop + "px", maxHeight:$(window).height() - margintop, left:$("#left_child_nav").outerWidth()});
	}
	if($("#left_child_nav").length)
	{
		$("#left_child_nav").css({marginTop:margintop + "px", height:$(window).height() - margintop - 40});
	}
	$(".page_content").css({marginTop:margintop + "px", minHeight:$(window).height() - margintop + "px"});
	
	if($(".toggle-nav").length !== 0 && getstyle("toggle-nav", "display") == "none")
	{
		$("#toggle_nav_container").show();
	}
	else
	{
		$("#toggle_nav_container").hide();
	}
	if($(".page_container").length)
	{
		var row = $(".page_container"),
		row_width = row.width() - 40,
		row_top = row.offset().top,
		row_left = row.offset().left,
		event_width = $(".single_event").outerWidth()+ 20,
		colspan = Math.floor(row_width/event_width),
		max_height = 0,
		x = 0,y = 0, left = 10, top = 20, total = $(".single_event").length, col_positions = new Array();
		$("#events_container").css({width:event_width*colspan});
		if(colspan > 1)
		{
			$(".single_event").removeAttr( "style" );
			$("#events_container").removeClass("page_row").css({position:"relative", margin:"auto"});
			$(".single_event").each(function(){
				if(x+1 <= colspan)
				{
					$(this).removeAttr( "style" );
					$(this).css({position:"absolute", left:left, top:top});
					col_positions[x] = {height:top + $(this).outerHeight() + 20, left:left};
					left += $(this).outerWidth() + 20;
					if(col_positions[x].height > max_height){ max_height = col_positions[x].height;}
				}
				else
				{
					$(this).removeAttr( "data-left" );
					$(this).removeAttr( "data-height" );
					$(this).css({position:"absolute", left:col_positions[y].left, top:col_positions[y].height});
					col_positions[y].height += $(this).outerHeight() + 20;
					if(col_positions[y].height > max_height){ max_height = col_positions[y].height;}
				}
				if(y+1 == colspan)
				{
					col_positions.sort(function(a,b) { return parseFloat(a.height) - parseFloat(b.height) } );
					y = -1;
				}
				y++;
				x++;
			});
			row.css({height:max_height});
		}
		else
		{
			$(".single_event").removeAttr( "style" ).css({marginTop:"20px"});
			$(".page_container").find(".single_event:first-child").css({marginTop:"0px"});
			$("#events_container").removeAttr( "style" ).attr("class", "page_row");
			row.css({height:"auto"});
		}
	}
}

function close_all_tabs()
{
$(".tabs").each(function(){
	if(getstyle($(this).attr("id"), "display") == "block")
	{
		$(this).removeClass("active_tab");
		$("#"+$(this).data("type")).hide();	
	}
});
}

$(document).bind('ready ajaxComplete', function(){
ready_and_ajax_complete();
});

$(document).ready(function(){

	if($(".project_link").length && window.location.hash)
	{
	$(".project_link[href$='"+window.location.hash.substring(1)+"']").trigger("click");
	}

	$( window ).resize(function() {
		if($(".content").css("right") != "0px")
		{
			plugins.sidebar_navigation.show();
		}
		adjust_page();
	});

	$.each(plugins, function(key, func){
		if($.isFunction(func.onload))
		{
			func.onload();
		}
	});
	analytics.state = {url:window.location.href, referer:"<?php echo $_SERVER["HTTP_REFERER"]; ?>"};
	analytics.track();
});

function lazy_loading()
{
var y = $(document).scrollTop();
$.each($(".lazy_load_image"), function() {
 if($(this).offset().top <= y + 1000)
 {
	$(this).html("<img src='"+$(this).attr('data-src')+"' />");
	$(this).removeClass('lazy_load_image');
 }
});
}

function getstyle(el, prop)
{
var el = document.getElementById(el);
if (el.currentStyle)
{
	return el.currentStyle[prop];
}
else if (document.defaultView && document.defaultView.getComputedStyle) 
{
	return document.defaultView.getComputedStyle(el, "")[prop];
}
else
{
	return el.style[prop];
}
}

window.onpopstate = function(event) {
	$.each(plugins, function(key, func){
		if($.isFunction(func.onpopstate))
		{
			func.onpopstate(event);
		}
	});
};
</script>
<?php
echo strtr(sanitize_script( ob_get_clean()), array("<script>" => "", "</script>" => ""));
?>
