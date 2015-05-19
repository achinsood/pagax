<?php
function sanitize_css($buffer)
{
	$search = array(
		'/\}[^\S]+/s',  // strip whitespaces after }
		'/,[^\S]+/s',  // strip whitespaces after ,
		'/:[^\S]+/s',  // strip whitespaces after :
		'/;[^\S]+/s',  // strip whitespaces after ;
		'/[^\S ]+\{/s',  // strip whitespaces before {, except space
		'/(\s)+/s',       // shorten multiple whitespace sequences
/*		'/\/*(.|\s)*\//' // remove html comments*/
	);

	$replace = array(
		'}',
		',',
		':',
		';',
		'{',
		'\\1',
/*		''
*/	);
	return preg_replace($search, $replace, $buffer);
}
ob_start();
header("Content-Type: text/css");
header("X-Content-Type-Options: nosniff");
?>
h1{float:left; width:100%; text-align:left; margin:10px 0px 0px 0px; padding:0px 0px 10px 0px; border-bottom:1px solid #dedede;-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}

h2,h3,h4,h5,h6{float:left; width:100%; text-align:left; margin:10px 0px 0px 0px; padding:0px; color:#555;-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}

p{float:left; width:100%; margin:10px 0px 0px 0px; padding:0px; text-align:justify; line-height:1.8em;}
ul{float:left; width:100%; margin:10px 0px 0px 0px; padding:0px 0px 0px 30px; text-align:left;-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
a{color: inherit; text-decoration:none;}
.center_table{display:inline-block; margin:auto; max-width: 90%;}
.table{text-align:left;}
.left{float:left;}
.right{float:right;}
.left_table{float:left; text-align:left;}
.table_row{float:left; width:100%; margin-top:10px; text-align:left;}
.middle_row{float:left; width:100%; margin-top:15px; text-align:left;}
.input_row{float:left; width:100%; padding-top:5px; text-align:left;}
.normal_row{float:left; width:100%; text-align:left;}
.floating_row{float:none !important; display:inline-block !important; display; max-width:100%;}
.page_row{float:left; width:100%; margin-top:20px; text-align:center;}
.drop_down_row{float:left; width:100%; height:0; text-align:left;}
.basic_drop_down:not(.content_box){float:left; position:relative; padding:10px; top:0; left:0; z-index:10; background:#fff; border:1px solid #dedede;-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; box-shadow: -4px 4px 8px #555;  -moz-box-shadow: -4px 8px 8px #555; -webkit-box-shadow: -4px 8px 8px #555;-ms-filter:progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=600, Color='#555'); filter:progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=600, Color='#555'); zoom:1;}
.links{float:left; color:#0066CC; text-decoration:none; cursor:pointer; margin-left:10px;}
.links:hover{text-decoration:underline;}

.margintop5{margin-top:5px !important;} .margintop10{margin-top:10px !important;} .margintop15{margin-top:15px !important;} .margintop20{margin-top:20px !important;}
.marginbottom5{margin-bottom:5px !important;} .marginbottom10{margin-bottom:10px !important;} .marginbottom15{margin-bottom:15px !important;} .marginbottom20{margin-bottom:20px !important;}
.marginleft5{margin-left:5px !important;} .marginleft10{margin-left:10px !important;} .marginleft15{margin-left:15px !important;} .marginleft20{margin-left:20px !important;}
.marginright5{margin-right:5px !important;} .marginright10{margin-right:10px !important;} .marginright15{margin-right:15px !important;} .marginright20{margin-right:20px !important;}
.margin5{margin:5px !important;} .margin10{margin:10px !important;} .margin15{margin:15px !important;} .margin20{margin:20px !important;}
.padding5{padding:5px !important;} .padding10{padding:10px !important;} .padding15{padding:15px !important;} .padding20{padding:20px !important;}
.paddingleft5{padding-left:5px !important;} .paddingleft10{padding-left:10px !important;} .paddingleft15{padding-left:15px !important;} .paddingleft20{padding-left:20px !important;}
.paddingright5{padding-right:5px !important;} .paddingright10{padding-right:10px !important;} .paddingright15{padding-right:15px !important;} .paddingright20{padding-right:20px !important;}
.paddingtop5{padding-top:5px !important;} .paddingtop10{padding-top:10px !important;} .paddingtop15{padding-top:15px !important;} .paddingtop20{padding-top:20px !important;}
.paddingbottom5{padding-bottom:5px !important;} .paddingbottom10{padding-bottom:10px !important;} .paddingbottom15{padding-bottom:15px !important;} .paddingbottom20{padding-bottom:20px !important;}

.one_half, .one_half_fixed, .one_third, .one_third_fixed,  .two_third, .two_third_fixed,
.one_fourth, .one_fourth_fixed,  .three_fourth, .three_fourth_fixed,
.one_fifth, .one_fifth_fixed,  .two_fifth, .two_fifth_fixed,  .three_fifth, .three_fifth_fixed, .four_fifth, .four_fifth_fixed,
.one_sixth, .one_sixth_fixed, .five_sixth, .five_sixth_fixed,
.one_eighth, .one_eighth_fixed, .seven_eighth, .seven_eighth_fixed,
.one_tenth, .one_tenth_fixed, .nine_tenth, .nine_tenth_fixed{float:left; position:relative; margin-right:1.9%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}

.one_half, .one_half_fixed{width:49%;}
.one_third, .one_third_fixed{width:32.03%;} .two_third, .two_third_fixed{width:65.5%;}
.one_fourth, .one_fourth_fixed{width:23.53%;} .three_fourth, .three_fourth_fixed{width:74%;}
.one_fifth, .one_fifth_fixed{width:18.4%;} .two_fifth, .two_fifth_fixed{width:38.8%;} .three_fifth, .three_fifth_fixed{width:59%;} .four_fifth, .four_fifth_fixed{width:79%;}
.one_sixth, .one_sixth_fixed{width:15.08%;} .five_sixth, .five_sixth_fixed{width:82.8%;}
.one_eighth, .one_eighth_fixed{width:10.8%;}
.one_tenth, .one_tenth_fixed{width:9%;}
.seven_eighth, .seven_eighth_fixed{width:87.3%;}
.nine_tenth, .nine_tenth_fixed{width:89%;}
.last{float:right !important; margin-right:0 !important;}
.last-margin{float:right !important; margin-left:1.9% !important;}
.nomargin{margin:0 !important;}

.table_column1{float:left; width:25%; text-align:right; padding-top:10px;}
.table_column2{float:left; width:10%; text-align:center; padding-top:10px;}
.table_column3{float:left; width:60%; text-align:left;}
img{float:left; border:0px;}

select, input[type="text"], input[type="password"], textarea{float:left; width:100%; padding:8px; border:1px solid #dedede; background:white; color:#666; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.expand_box_headings{float:left; width:100%; padding:9px 10px 8px 10px; border:1px solid #dedede; background:white; color:#666; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
input[type="radio"], input[type="checkbox"]{float:left; padding:5px 0px 5px 0px; margin:0 5px 0 0; border:1px solid #dedede; background:white;}
input[type="submit"]{float:left; padding:8px 20px 8px 20px; text-align:center; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; font-size:12px;}
.fancy_submit_button{float: left; padding:10px 20px 10px 20px; color: white; font-weight: bold; background: #4d90fe; border: 1px solid #3079ed; cursor: pointer;}
.fancy_submit_button.red{background: #cc5547; border:1px solid #a02f21;}
.fancy_submit_button.yellow{background: #FDDD38; border:1px solid #e0bc27;}
.fancy_submit_button:hover{background:#3079ed; border:1px solid #4d90fe;}
.fancy_submit_button.red:hover{background:#a02f21; border:1px solid #CC062F;}
.fancy_submit_button.yellow:hover{background:#fdd922; border:1px solid #e0bc27;}
span.form_alert{float:left; display:none; color:red; padding-top:5px;}
form span.input_text{float:left;}
.radio_text{float:left; margin-right:20px;}
.expand_box_headings{cursor:pointer; text-align:left; position:relative; padding-left:20px;}
.alert_field{border: 1px solid #dd4b39 !important;}
.field_label{color:#666 !important;}
.field_label span{color:#dd4b39 !important;}

.pw_checker_border{width:120px; height:12px; float:left; margin-left:10px; border:1px solid #CCC;}
.pw_checker_meter{width:110px; float:left; margin-left:5px; margin-top:3px; background:#F0F0F0;}
.pw_checker_incorrect{float:left; width:40px; border:3px solid #C03;}
.pw_checker_correct{float:left; width:105px; border:3px solid green;}
.pw_checker_value{float:left; margin-left:5px; font-weight:bold;}
.pw_red{color:#C03;}
.pw_green{color:green;}

/*#expand_drop_property_for{background: #0074A2; color: #f0f0f0; border: 1px solid #0074A2;}*/
.content_heading{font-weight:bold; color:#666; background:#f5f5f5;}
.content_heading.active{border-bottom:none;}
.content_box .content_heading{font-weight:bold; color:#666; background:#ffffff;}
.content_box.expand_box_content{position:relative; border-top:none; background:#ffffff;}
.expand_box_headings.disabled{color:#999 !important;}
/*.expand_box_headings:before{content:"+"; height: 0; width: 0; left: 88%; position: absolute; pointer-events: none; color:#4d90fe;}
.expand_box_headings.active:before{content:"-";}

.expand_box_headings{float:left; padding:10px 10px 10px 20px; background:#dedede; margin-top:20px; cursor:pointer; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
/*.expand_box_headings:before{content:"+"; height: 0; width: 0; right: 20px; position: absolute; pointer-events: none; color:#4d90fe;}
.expand_box_headings.active:before{content:"-";}
*/
.expand_box_headings.active:not(.content_heading){ box-shadow: -4px 4px 8px #555;  -moz-box-shadow: -4px 8px 8px #555; -webkit-box-shadow: -4px 8px 8px #555;-ms-filter:progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=600, Color='#555'); filter:progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=600, Color='#555'); zoom:1;}
.expand_box_headings.drop_down{padding-left:10px; white-space: nowrap;}
.expand_box_headings:not(.disabled):before{content:""; right: 15px; top:50%; border: solid transparent;border-color: transparent; height: 0; width: 0; pointer-events: none; border-top-color: #ccc; border-width: 5px; margin-top:-3px;}
.expand_box_headings:not(.disabled):not(.content_box):before{position: absolute;}

.expand_box_content .expand_box_content{z-index:20;}
.expand_drop_content {padding:5px !important;}
.expand_box_content:not(.content_box).normal_row .normal_row{padding:5px; cursor:pointer; color:#666; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.expand_box_content:not(.content_box).normal_row .normal_row.selected, .expand_box_content:not(.content_box).normal_row .normal_row:hover{background:/*#0074A2*/#0066CC; color:#f0f0f0;}
.expand_box_content:not(.content_box).normal_row .normal_row.checked{background:#f0f0f0; color:#666;}
.custom_drop_down_loading{float: right; position: absolute; top: 50%; right: 10px; margin-top: -8px; display:none;}
.content_box{float:left; width:100%; border:1px solid #dedede; background:#f9f9f9; padding:20px;-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.content_box:not(.expand_box_content):hover{background:#f6f6f6;}

#expand_box_price_content, #expand_box_area_content{width:150%;}

.logo{margin:0;}
.logo h2{font-size:22px; font-weight:bold; margin:0px; border:none; padding:0px;}

body{max-width:100%; overflow-x:hidden; overflow-y:auto; background:#222; text-align:center; font-size:12px; font-family:arial; margin:0px; color:#333;}
body::-webkit-scrollbar {width:0.7%;}
div::-webkit-scrollbar {width:1%;}
.hidden_scrollbar::-webkit-scrollbar {display:none;}
.hidden {display:none;}
::-webkit-scrollbar-track{background:#f0f0f0; border:1px solid #dedede;}
::-webkit-scrollbar-thumb {background-color: #ccc; border-radius:5px; -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);}

.links_widget{position:fixed; left:100%; top:0; z-index:1000; width:250px; height:100%; overflow-x: hidden; overflow-y: auto; background:#222; color:#f0f0f0;}
.links_widget .menu_tab{float:left; width:100%; font-size:15px; font-weight:normal; border-top:1px solid #444;}
.links_widget .selected_menu_tab{float:left; width:100%; font-size:15px;}
.links_widget .menu_link{float:left;}
.links_widget .link{float:left; width:100%; text-decoration:none; color:#f0f0f0; cursor:pointer;}
.links_widget  .selected_menu_tab .selected_link, .links_widget  .menu_tab .selected_link, .links_widget .link:hover{float:left; width:100%; text-decoration:none; cursor:pointer; background:#333;color:/*#0074A2*/#0066CC;}
.links_widget .selected{background:#333;}
.links_widget .link_text{float:left; border-left:3px solid #222; width:98%; padding:15px 0 15px 5%; text-align:left;}
.links_widget .link .link_text:hover, .selected_link .link_text{float:left; width:98%; padding:15px 0 15px 5%; text-align:left; border-left:3px solid /*#0074A2*/#0066CC; color:/*#0074A2*/#0066CC;}
.links_widget .menu_drop_downs{float:left; width:100%; display:none;}
.links_widget .selected_menu_drop_downs{float:left; width:100%;}
.links_widget .selected_menu_drop_downs .menu_tab .link, .links_widget .menu_drop_downs .menu_tab .link{float:left; width:90%; padding-left:10%; background:#1b1b1b; text-decoration:none; color:#BBB;}
.links_widget .selected_menu_drop_downs .menu_tab .link:hover{background:#1b1b1b; color:/*#0074A2*/#0066CC;}
.links_widget .selected_menu_drop_downs .menu_tab .selected_link,  .links_widget .menu_drop_downs .menu_tab .selected_link{float:left; width:90%; padding-left:10%; background:#1b1b1b; color:white; cursor:pointer;}
.links_widget .selected_menu_drop_downs .menu_tab .link_text, .links_widget .menu_drop_downs .link .link_text{float:left; border:none; text-align:left; cursor:pointer;}
.links_widget .selected_menu_drop_downs .menu_tab .link .link_text:hover, .links_widget .selected_menu_drop_downs .menu_tab  .selected_link .link_text, .links_widget .menu_drop_downs .link .link_text:hover{color:/*#0074A2*/#0066CC;}


.content{float:left; position:absolute; right:0px; top:0px; width:100%;/* height:100%;*/ z-index:2; background:#ffffff;}
.content_inner{width:1100px; max-width:95%; margin:0 auto;}
.page_content{float:left; width:100%; height:auto; background:#eeeeee;}
.content_container{float:left; width:100%; margin:20px 0px 20px 0px;}
.content_container.white_container{padding:20px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.fancy_content_container{float:left; width:100%; margin:20px 0px 20px 0px; border-radius:10px; box-shadow: 0px 0px 20px #999;  -moz-box-shadow: 0px 0px 20px #999; -webkit-box-shadow: 0px 0px 20px #999;-ms-filter:progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=600, Color='#555'); filter:progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=600, Color='#555'); zoom:1;}
.content_loading_box{width:auto; border:1px solid #f0c36d; background:#f9edbe; font-size:13px; font-weight:bold; box-shadow: -1px 4px 10px #555; -moz-box-shadow: -1px 4px 10px #555; -webkit-box-shadow: -1px 4px 10px #555; filter: progid:DXImageTransform.Microsoft.Shadow(Strength=1, Direction=0, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=2, Direction=90, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color='#555'); zoom:1; display:none;}
.content_success_box{width:auto; border:1px solid #8AC007; background:#8AC007; color:white; font-size:13px; font-weight:bold; box-shadow: -1px 4px 10px #555; -moz-box-shadow: -1px 4px 10px #555; -webkit-box-shadow: -1px 4px 10px #555; filter: progid:DXImageTransform.Microsoft.Shadow(Strength=1, Direction=0, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=2, Direction=90, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color='#555'); zoom:1; display:none;}
.content_loading_box .link{float:left; margin:5px 0 0 10px; cursor:pointer; color:#0369AB; font-weight:bold; text-decoration:none;}
.content_loading_box .link:hover{text-decoration:underline;}

.table_column{float:left; width:200px; border-right:1px solid #dedede; text-align:left; padding:0px 10px 0px 10px; margin:10px 0px 0px 10px;}

.popup_back{ width:100%; height:100%; opacity:0.5; filter: alpha(opacity = 50); zoom:1; background:#222; position:fixed; top:0px; left:0px; z-index:200; display:none;}
.popup_shadow_style{background:white; display:none; position:fixed; z-index:555; border-radius:5px; box-shadow: -4px 4px 8px #555;  -moz-box-shadow: -4px 8px 8px #555; -webkit-box-shadow: -4px 8px 8px #555;-ms-filter:progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=600, Color='#555'); filter:progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=600, Color='#555'); zoom:1;}
.popup_container{position:fixed; top:0; left:0; z-index:1000; width:100%; height:100%;}
/*.popup_shadow{float:left; position:fixed; top:50%; left:50%; background:white; display:none; z-index:555; border-radius:5px; box-shadow: -4px 4px 8px #555;  -moz-box-shadow: -4px 8px 8px #555; -webkit-box-shadow: -4px 8px 8px #555; filter: progid:DXImageTransform.Microsoft.Shadow(Strength=1, Direction=0, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=2, Direction=90, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color='#555'); zoom:1;}
*/.popup_shadow{position:relative; width:100px; max-width:95%; max-height:85%; overflow-y:auto; overflow-x:hidden; height:auto; top:50%; left:50%; -webkit-transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%); background:white; display:none; z-index:555; border-radius:5px; box-shadow: -4px 4px 8px #555;  -moz-box-shadow: -4px 8px 8px #555; -webkit-box-shadow: -4px 8px 8px #555; filter: progid:DXImageTransform.Microsoft.Shadow(Strength=1, Direction=0, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=2, Direction=90, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color='#999'), progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color='#555'); zoom:1;}

.popup_title_div{float:left; width:100%; border-top-left-radius:5px; border-top-right-radius:5px; background:#0671B7; color:white;}
.popup_title{float:left; margin:8px 0px 8px 20px; width:auto !important;}
.popup_content{float:left; width:90%; margin-left:5%; margin-top:20px; margin-bottom:20px; text-align:justify;}
.popup_close{float:right; margin:8px 8px 8px 0px; width:19px; height:17px; cursor:pointer;}
.calculator_table{float:left; width:220px; border:1px solid #dedede; margin:10px 20px 20px 20px; padding:20px;}
.calculator_table_column{float:left; width:36px; height:25px; margin-left:10px;}
.calculator_left{margin-left:0px;}
.calculator_button{float:left; width:36px; height:25px;}
.page_loader{float:left; position:fixed; top:50%; left:50%; margin-left:-25px; margin-top:-25px; display:none;}
.ajax_loader{float:left; position:absolute; top:50%; left:50%; margin-left:-25px; margin-top:-25px;}
.ajax_wrapper{float:left; display:none;}
.page_container{width:100%; margin:auto; }
.page_container .page_row:first-child{ padding:0 20px 20px 20px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.single_event{display:inline-block; vertical-align:top; width:270px; max-width:90%; border:1px solid #dedede; background:#f3f3f3; border-radius:5px; margin:5px; box-shadow: 0px 0px 20px #dddddd;  -moz-box-shadow: 0px 0px 20px #dddddd; -webkit-box-shadow: 0px 0px 20px #dddddd;-ms-filter:progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=600, Color='#dddddd'); filter:progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=600, Color='#dddddd'); zoom:1;}
.single_event:hover{ box-shadow: 0px 0px 20px #ccc;  -moz-box-shadow: 0px 0px 20px #ccc; -webkit-box-shadow: 0px 0px 20px #ccc;}

.nav-opener{float:right; width:25px; cursor:pointer;}
.nav-opener div{float:right; width:100%; height:5px; margin-bottom:3px; border-radius:1px; background:/*#0074A2*/#0066CC;}

.jquery_tabs_container{background: #505050; background:-webkit-gradient(linear,left top,left bottom,from(#505050),to(#424242)); background:-moz-linear-gradient(top,#505050,#424242); background: linear-gradient(to bottom,#505050,#424242); background-image: -ms-linear-gradient(top,#505050,#424242);}
.jquery_tabs{float:left; padding:6px 20px 5px 20px; cursor:pointer; border-left:1px solid #333; border-right:1px solid #666; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.jquery_left_tab{float:left; color: transparent; width:0; padding:17px 0 16px 0; border-right:1px solid #666; margin-left:20px; }
.jquery_right_tab{float:left; color: transparent; width:0; padding:17px 0 16px 0; border-left:1px solid #333;}
.jquery_tabs h3{color:#f0f0f0; margin: 10px 0 10px 0 !important;}
.active_jquery_tab{position:relative; z-index:2; border:1px solid #f0f0f0; background:white; border-bottom:1px solid #ccc; }
.active_jquery_tab:before, .active_jquery_tab:after{content:""; top: 100%; border: solid transparent;border-color: transparent; height: 0; width: 0;left: 50%; position: absolute; pointer-events: none;}
.active_jquery_tab:before{border-top-color: #ccc; border-width: 11px; margin-left: -11px;}
.active_jquery_tab:after{border-top-color: #fff; border-width: 10px; margin-left: -10px;}
.active_jquery_tab h3{ color:#505050 !important;}
.jquery_tabs_content_container{float:left; width:94%; padding:3%;}
.jquery_tabs_content{float:left; width:100%; display:none;}

.footer{float:left; width:100%; background:#333; padding:20px 0 20px 0;}
.footer_column{float:left; width:25%; text-align:left; margin:20px 0 20px 0;}
.footer_column .heading{float:left; font-weight:bold; font-size:15px; color:#f0f0f0; margin:0 0 20px 0;}
.footer_column .links{margin:0px; color:#f0f0f0;}
.copyrights{float:left; width:100%; padding:10px 0 10px 0; background:#000; color:#f0f0f0; text-align:center;}
.copyrights .links{float:none; display:inline-block; margin:0px; color:#f0f0f0;}

.scrollbox{width:100%; max-height:150px; overflow:auto;} 
.refine_checkbox_text{float:left; width:125px; text-align:left;}

.refine_search_container{float:left; position:fixed; left:0px; top:0px; width:220px; background:#f9f9f9; overflow-y:auto; overflow-x:hidden; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.refine_search_inner{float:left; width:100%; padding:20px; background:#f9f9f9; overflow-y:auto; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.refine_search_container h2{cursor:pointer; margin:0px; background:/*#0074A2*/#0066CC; color:white; padding:10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.refine_search_inner:before{content:""; top: -8px; border: solid transparent;border-color: transparent; height: 0; width: 0;left: 0%; position: relative; pointer-events: none;}
.refine_search_inner:before{border-top-color: /*#0074A2*/#0066CC; border-width: 12px;}

#map_canvas{float:left; width:100%; height:90vh;}

.structure_row{float:left; width:100%; margin:40px 0 40px 0; position:relative;}
.major_container{background:/*#0066CC;*/#0066CC; color:#fff;}
.major_container .structure_row h1, .major_container .structure_row h2, .major_container .structure_row h3, .major_container .structure_row h4, .major_container .structure_row h5, .major_container .structure_row h6{color:#fff !important;}
.white_container{background:#ffffff; color:#444;}
.light_container{background:#f5f5f5; color:#999;}
.light_container .structure_row h1, .light_container .structure_row h2, .light_container .structure_row h3, .light_container .structure_row h4, .light_container .structure_row h5, .light_container .structure_row h6{color:#999 !important;}
.structure_row h1,h2,h3,h4,h5,h6{color:#0066CC; font-size:14px;}
.white_container h1,h2,h3,h4,h5,h6{color:#666;}

.project_amenities{text-align:left;}
.project_amenities .block{padding:10px 0 10px 0; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}

.project_specifications .one_half{border:1px solid #dedede; text-align:left;}
.project_specifications .block{padding:10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.project_specifications h5{float:left; width: 100%; text-align:center; margin:0; padding:10px 0 10px 0; background:#999; color:#f0f0f0;}

/*.breadcrumbs .left{position:relative;}
.breadcrumbs .left .links{ margin:-1px -1px 0 1px; padding:10px 5px 10px 30px;}
.breadcrumbs .left:first-child{ margin:-1px -1px 0 20px;}
.breadcrumbs .left:first-child .links{ margin:-1px -1px 0 0; padding:10px 5px 10px 10px;}
.breadcrumbs .left:not(:last-child) .links:hover{background:#0074A2; color:#f0f0f0;}
.breadcrumbs .left:not(:last-child):before, .breadcrumbs .left:not(:last-child):after{content:""; z-index:5; border: solid transparent; border-color: transparent; height: 0; width: 0;left: 100%; position: absolute; pointer-events: none;}
.breadcrumbs .left:not(:last-child):before{border-left-color: #dedede; top: -1px; border-width: 17px; margin-left: 1px;}
.breadcrumbs .left:not(:last-child):after{border-left-color: #f5f5f5; top: 0px; border-width: 16px; margin-left: 0px;}
.breadcrumbs .left:not(:last-child):hover:after{border-left-color: #0074A2;}
*/

.breadcrumbs .left{padding:5px 0 5px 0;}
.breadcrumbs .left:not(:last-child):after{content:">"; margin-left:10px;}

.range-slider-block{float:left; width:100%; position:relative; z-index:1; cursor:pointer; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.range-slider-block .focus-block{border-radius:5px; border:1px solid #dedede; background:/*#0074A2*/#0066CC !important; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.range-slider-block .full-block{float:left; width:100%; position:absolute; border-radius:5px; top:0; left:0; height:10px; background:#ffffff; border:1px solid #dedede; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.range-slider-block .left-block{float:left; width:0; position:absolute; border-radius:5px; top:0; left:0; z-index:2; height:10px; background:#ffffff; border:1px solid #dedede; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.range-slider-block .left-block span{float:right; width:15px; height:15px; border-radius:5px; border:1px solid #dedede; -webkit-transform: translate(50%, -25%); -ms-transform: translate(50%, -25%); transform: translate(50%, -25%); background:#ffffff;}
.range-slider-block .right-block{float:right; width:0; position:absolute; border-radius:5px; top:0; right:0; z-index:2; height:10px; background:#ffffff; border:1px solid #dedede; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.range-slider-block .right-block span{float:left; width:15px; height:15px; border-radius:5px; margin-right:7px; border:1px solid #dedede; -webkit-transform: translate(-50%, -25%); -ms-transform: translate(-50%, -25%); transform: translate(-50%, -25%); background:#ffffff;}

.slide{float:left; position:relative; width:100%; overflow:hidden;}
.slide_main{float:left; width:500%; height:100%; position:relative; top:0; right:100%; z-index:0;}
.slide_button{float:left; width:8px; height:8px; cursor:pointer; border-radius:16px; border:1px solid #999; background:#f0f0f0; margin-left:10px;}
.slide_element{float: left; height: 100%;}
.slide_image{float:left; width:100%; height:100%;}
.slide_arrow_container{float:left; width:100%; height:100%; position:absolute; z-index:1;}
.slide_arrow{width:48px; height:48px; opacity:0.6; cursor:pointer; display:none;}
.slide_arrow:hover{ background-position:0px 0px; opacity:0.8; }
.left_arrow{float:left; left:0%; margin:18.5% 0px 0px 10px; background:url(http://gharsearch.com/images/slider-nav-left.png); background-position:0px -72px;}
.right_arrow{float:right; right:0%; margin:18.5% 10px 0px 0px; background:url(http://gharsearch.com/images/slider-nav-right.png); background-position:0px -72px; }

.table_row.all_row:nth-child(odd){background: #f0f0f0; padding:10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.table_row.all_row:nth-child(even){background: #ffffff; padding:10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.page_row.all_row{background: #666; color:#f0f0f0; padding:5px 10px 5px 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.all_row .link_row{visibility:hidden;}
.all_row:hover .link_row{visibility:visible;}

ul.pagination{float:left; width:100%; text-align:center; margin-top:20px;}
ul.pagination li{display:inline; margin:5px;}
ul.pagination li a span{display:inline; padding:5px; background:#dedede; border:1px solid #dedede;}
ul.pagination li.selected{display:inline; padding:5px; margin:5px; background:#f0f0f0; border:1px solid #dedede;}

a.left_links, div.left_links{float:left; width:100%; color:#0066CC; border-top:1px solid #f0f0f0; padding:10px 0 10px 0;}
a.left_links:hover{text-decoration:underline; background:#F2F2F2;}
span.left_links{float:left; margin-left:10px; font-size:12px;}

.ratings{float:left; cursor:pointer;}
.ratings span{float:left; width: 20px; height: 20px; background: url(../images/sprite.png); background-position:20px 0px; }
.ratings span.rated{background-position:0px 0px; }

.property_box{float:left; width:100%; padding:20px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.property_box .property_buttons{visibility:hidden;}
.property_box_container:hover .property_buttons{visibility:visible;}
.property_box:hover{background:#f9f9f9;}
.property_box_footer{border-top:1px solid #e9e9e9; background:#f3f3f3; color:#777; font-weight:bold;}

.property_box .property_img{float:left; position:relative; width:100%; border-radius:5px;}
.property_box .property_img:before{content: ""; display: block; margin-top: 75%;}
.property_box .property_img img{float:left; width:100%; height:100%; border-radius:inherit; position:absolute; top: 0; left: 0; bottom: 0; right: 0;}
.property_box_footer span:not(:first-child){float:left; padding:15px 10px 15px 10px; border-left:1px solid #e9e9e9;}
.property_box_footer span:first-child{float:left; padding:15px 10px 15px 20px;}

@media only screen and (max-width : 480px) {
/* Smartphones (portrait and landscape) */
.center_table{width: 90%;}
.popup_shadow{width: 90%;}
.ajax_wrapper{width: 100%;}
.single_event{width:90%;}
#search_filter_box .item{display:block;}
#search_filter_box .filter_content_box{ top:0; left:0; height:100%; overflow-y:auto; overflow-x:hidden; display:none; padding:20px 0 0 0;}
.one_half, .one_third, .two_third, .one_fourth, .three_fourth, .one_fifth, .two_fifth, .three_fifth, .four_fifth, .one_sixth, .five_sixth, .one_eighth, .seven_eighth, .one_tenth, .nine_tenth{float:left; width:100%; margin-right:0%; margin-top:20px !important;}
.project_nav .nav-opener{display:block;}
.project_nav .nav_container{position:absolute; top:0; background:white; z-index:10; width:95%; max-width:95%; top:100%; display:none;}
.project_nav ul{width:100%; border:1px solid #dedede;}
.project_nav ul li{ width:100%;}
.project_nav ul li a{width:100%; border-bottom:1px solid #dedede; font-size:15px; font-weight:bold; text-decoration:none; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.project_nav .project_name{width:60%; max-width:60%;}
#topbar .quick_links{display:none;}
.jquery_tabs{margin-left:5%; border:none; border-top:1px solid #333; border-bottom:1px solid #666; width:90%;}
.jquery_left_tab, .jquery_right_tab{margin-left:5%; border:none; width:90%; padding:5px 0 5px 0;}
.jquery_left_tab{border-bottom:1px solid #666;}
.jquery_right_tab{border-top:1px solid #333;}
.featured_block{display:none;}
.search_form_center{float:left; width:100%; margin:auto;}
.search_form_container{margin:0px;}
#expand_box_price_content, #expand_box_area_content{width:100%;}
.property_buttons{visibility:visible !important;}
.property_box_footer span:not(:first-child){width:100%; padding:15px 10px 15px 20px; border:none; border-top:1px solid #e9e9e9; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.property_box_footer span:first-child{width:100%; padding:15px 10px 15px 20px; border:none; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
}

@media only screen and (max-width: 767px) {
    /* phones */
.center_table{width: 90%;}
.popup_shadow{width: 90%;}
.ajax_wrapper{width: 100%;}
.links_widget{width:60%;}
.links_widget .menu_tab{font-size:15px; font-weight:normal;}
.page_container{width:100%;}
#search_filter_box .item{display:block;}
#search_filter_box .filter_content_box{top:0; left:0; height:100%; overflow-y:auto; overflow-x:hidden; display:none; padding:20px 0 0 0;}
.property_details .image_container{width:100%; margin:0;}
.property_details .details{width:100%; margin:0;}
.one_half, .one_third, .two_third, .one_fourth, .three_fourth, .one_fifth, .two_fifth, .three_fifth, .four_fifth, .one_sixth, .five_sixth, .one_eighth, .seven_eighth, .one_tenth, .nine_tenth{float:left; width:100%; margin-right:0%; margin-top:20px !important;}
.project_nav .nav-opener{display:block;}
.project_nav .nav_container{position:absolute; top:0; background:white; z-index:10; width:95%; max-width:95%; top:100%; display:none;}
.project_nav ul{width:100%; border:1px solid #dedede;}
.project_nav ul li{ width:100%;}
.project_nav ul li a{width:100%; border-bottom:1px solid #dedede; font-size:15px; font-weight:bold; text-decoration:none; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.project_nav .project_name{width:60%; max-width:60%;}
#topbar .quick_links{display:none;}
.jquery_tabs{margin-left:5%; border:none; border-top:1px solid #333; border-bottom:1px solid #666; width:90%;}
.jquery_left_tab, .jquery_right_tab{margin-left:5%; border:none; width:90%; padding:5px 0 5px 0;}
.jquery_left_tab{border-bottom:1px solid #666;}
.jquery_right_tab{border-top:1px solid #333;}
.featured_block{display:none;}
.search_form_center{float:left; width:100%; margin:auto;}
.search_form_container{margin:0px;}
#expand_box_price_content, #expand_box_area_content{width:100%;}
.property_buttons{visibility:visible !important;}
.property_box_footer span:not(:first-child){width:100%; padding:15px 10px 15px 20px; border:none; border-top:1px solid #e9e9e9; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.property_box_footer span:first-child{width:100%; padding:15px 10px 15px 20px; border:none; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
}

@media only screen and (max-width: 767px) and (orientation: portrait) {
    /* portrait phones */
.center_table{width: 90%;}
.popup_shadow{width: 90%;}
.ajax_wrapper{width: 100%;}
.links_widget{width:70%;}
.links_widget .menu_tab{font-size:15px; font-weight:normal;}
.page_container{width:100%;}
#search_filter_box .item{display:block;}
#search_filter_box .filter_content_box{top:0; left:0; height:100%; overflow-y:auto; overflow-x:hidden; display:none; padding:20px 0 0 0;}
.property_details .image_container{width:100%; margin:0;}
.property_details .details{width:100%; margin:0;}
.one_half, .one_third, .two_third, .one_fourth, .three_fourth, .one_fifth, .two_fifth, .three_fifth, .four_fifth, .one_sixth, .five_sixth, .one_eighth, .seven_eighth, .one_tenth, .nine_tenth{float:left; width:100%; margin-right:0%; margin-top:20px !important;}
.project_nav .nav-opener{display:block;}
.project_nav .nav_container{position:absolute; top:0; background:white; z-index:10; width:95%; max-width:95%; top:100%; display:none;}
.project_nav ul{width:100%; border:1px solid #dedede;}
.project_nav ul li{ width:100%;}
.project_nav ul li a{width:100%; border-bottom:1px solid #dedede; font-size:15px; font-weight:bold; text-decoration:none; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.project_nav .project_name{width:60%; max-width:60%;}
#topbar .quick_links{display:none;}
.jquery_tabs{margin-left:5%; border:none; border-top:1px solid #333; border-bottom:1px solid #666; width:90%;}
.jquery_left_tab, .jquery_right_tab{margin-left:5%; border:none; width:90%; padding:5px 0 5px 0;}
.jquery_left_tab{border-bottom:1px solid #666;}
.jquery_right_tab{border-top:1px solid #333;}
.featured_block{display:none;}
.search_form_center{float:left; width:100%; margin:auto;}
.search_form_container{margin:0px;}
#expand_box_price_content, #expand_box_area_content{width:100%;}
.property_buttons{visibility:visible !important;}
.property_box_footer span:not(:first-child){width:100%; padding:15px 10px 15px 20px; border:none; border-top:1px solid #e9e9e9; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.property_box_footer span:first-child{width:100%; padding:15px 10px 15px 20px; border:none; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
}

@media only screen and (min-width: 768px) and (max-width: 999px) {
    /* tablets and desktop small */
.links_widget{width:250px; min-width:15%;}
.links_widget .menu_tab{font-size:15px; font-weight:normal;}
.page_container{width:100%; max-width:1700px;}
.project_nav .nav-opener{display:block;}
.project_nav .nav_container{position:absolute; top:0; background:white; z-index:10; width:95%; max-width:95%; top:100%; display:none;}
.project_nav ul{width:100%; border:1px solid #dedede;}
.project_nav ul li{ width:100%;}
.project_nav ul li a{width:100%; border-bottom:1px solid #dedede; font-size:15px; font-weight:bold; text-decoration:none; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
.project_nav .project_name{width:60%; max-width:60%;}
}
@media only screen and (min-width: 1000px) {
    /* desktop */
.links_widget{width:250px; min-width:20%;}
.links_widget .menu_tab{font-size:15px; font-weight:normal;}
.page_container{width:100%; max-width:1700px;}
}
<?php echo sanitize_css( ob_get_clean()); ?>
