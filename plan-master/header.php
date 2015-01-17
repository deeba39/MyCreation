<?php

// Compatibility with PHP Report Maker
if (!isset($Language)) {
	include_once "ewcfg7.php";
	include_once "ewshared7.php";
	$Language = new cLanguage();
}
?>

<html>
<head>
	<title><?php echo $Language->ProjectPhrase("BodyTitle") ?></title>
<?php if (@$gsExport == "") { ?>
<link rel="stylesheet" type="text/css" href="SpryMenuBarHorizontal.css" >
<style>

/* Spry Menu Bar */

/* Set the active Menu Bar with this class, currently setting z-index to accomodate IE rendering bug: http://therealcrisp.xs4all.nl/meuk/IE-zindexbug.html */
ul.MenuBarActive {
	z-index: 10000;
}

/* Menu items are a light gray block with padding and no text decoration */
ul.MenuBarHorizontal a {
	background-color: #F1F1F1;
	color: #000;
}

/* Menu items that have mouse over or focus have a blue background and white text */
ul.MenuBarHorizontal a:hover, ul.MenuBarHorizontal a:focus {
	background-color: #33C;
	color: #FFF;
}

/* Menu items that are open with submenus are set to MenuBarItemHover with a blue background and white text */
ul.MenuBarHorizontal a.MenuBarItemHover, ul.MenuBarHorizontal a.MenuBarItemSubmenuHover, ul.MenuBarHorizontal a.MenuBarSubmenuVisible {
	background-color: #33C;
	color: #FFF;
}
ul.MenuBarHorizontal a.MenuBarItemSubmenu {
	background-image: url(images/SpryMenuBarDown.gif);
}
ul.MenuBarHorizontal ul {
	z-index: 10020;
}
ul.MenuBarHorizontal ul a.MenuBarItemSubmenu {
	background-image: url(images/SpryMenuBarRight.gif);
}
ul.MenuBarHorizontal a.MenuBarItemSubmenuHover {
	background-image: url(images/SpryMenuBarDownHover.gif);
}
ul.MenuBarHorizontal ul a.MenuBarItemSubmenuHover {
	background-image: url(images/SpryMenuBarRightHover.gif);
}

/* HACK FOR IE: to make sure the sub menus show above form controls, we underlay each submenu with an iframe */
ul.MenuBarHorizontal iframe {
	z-index: 10010;
}
#RootMenu li {
	width: auto;
	white-space: nowrap;
	z-index: 10000; /* for FF */
}
#RootMenu ul {
	width: auto;
}
#RootMenu ul li {
	float: none;
	background-color: transparent;
}
#RootMenu a.MenuBarItemSubmenu {
	background-position: 100% 50%;
}
.ewMenuRow {
	width: 100%;
	float: left;
	background-color: #F1F1F1;
}
</style>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0/build/autocomplete/assets/skins/sam/autocomplete.css">
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo EW_PROJECT_STYLESHEET_FILENAME ?>">
<?php } ?>
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo ew_ConvertFullUrl("favicon.ico") ?>"><link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo ew_ConvertFullUrl("favicon.ico") ?>">
<meta name="generator" content="PHPMaker v7.1.0.0">
</head>
<body class="yui-skin-sam">
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0/build/utilities/utilities.js"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0/build/autocomplete/autocomplete-min.js"></script>
<script type="text/javascript" src="js/SpryMenuBar.js"></script>
<script type="text/javascript">
<!--
var EW_LANGUAGE_ID = "<?php echo $gsLanguage ?>";
var EW_DATE_SEPARATOR = "/"; 
if (EW_DATE_SEPARATOR == "") EW_DATE_SEPARATOR = "/"; // Default date separator
var EW_UPLOAD_ALLOWED_FILE_EXT = "gif,jpg,jpeg,bmp,png,doc,xls,pdf,zip"; // Allowed upload file extension
var EW_FIELD_SEP = ", "; // Default field separator

// Ajax settings
var EW_RECORD_DELIMITER = "\r";
var EW_FIELD_DELIMITER = "|";
var EW_LOOKUP_FILE_NAME = "ewlookup7.php"; // lookup file name

// Common JavaScript messages
var EW_ADDOPT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("AddBtn"))) ?>";
var EW_EMAIL_EXPORT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("SendEmailBtn"))) ?>";
var EW_BUTTON_CANCEL_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("CancelBtn"))) ?>";

//-->
</script>
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<script type="text/javascript" src="js/ewp7.js"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript" src="js/userfn7.js"></script>
<script type="text/javascript">
<!--
<?php echo $Language->ToJSON() ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js");
//-->

</script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<div class="ewLayout">
	<!-- header (begin) --><!-- *** Note: Only licensed users are allowed to change the logo *** -->
  <div class="ewHeaderRow"><a href="1landingpage.php"><img src="images/100px-logo_plan.jpg" alt="" border="0"></a></div>
	<!-- header (end) -->
<div class="ewMenuRow">
<?php include "ewmenu.php" ?>
</div>
	<!-- content (begin) -->
  <table cellspacing="0" class="ewContentTable">
		<tr>
	    <td class="ewContentColumn">
			<!-- right column (begin) -->
				<p class="phpmaker"><b><?php echo $Language->ProjectPhrase("BodyTitle") ?></b></p>
<?php } ?>
