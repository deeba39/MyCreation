<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "usersinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$users_list = new cusers_list();
$Page =& $users_list;

// Page init
$users_list->Page_Init();

// Page main
$users_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($users->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var users_list = new ew_Page("users_list");

// page properties
users_list.PageID = "list"; // page ID
users_list.FormID = "fuserslist"; // form ID
var EW_PAGE_ID = users_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
users_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
users_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
users_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<?php if ($users->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$users_list->lTotalRecs = $users->SelectRecordCount();
	} else {
		if ($rs = $users_list->LoadRecordset())
			$users_list->lTotalRecs = $rs->RecordCount();
	}
	$users_list->lStartRec = 1;
	if ($users_list->lDisplayRecs <= 0 || ($users->Export <> "" && $users->ExportAll)) // Display all records
		$users_list->lDisplayRecs = $users_list->lTotalRecs;
	if (!($users->Export <> "" && $users->ExportAll))
		$users_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $users_list->LoadRecordset($users_list->lStartRec-1, $users_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $users->TableCaption() ?>
<?php if ($users->Export == "" && $users->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $users_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $users_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $users_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($users->Export == "" && $users->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(users_list);" style="text-decoration: none;"><img id="users_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="users_list_SearchPanel">
<form name="fuserslistsrch" id="fuserslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="users">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $users_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="userssrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$users_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fuserslist" id="fuserslist" class="ewForm" action="" method="post">
<div id="gmp_users" class="ewGridMiddlePanel">
<?php if ($users_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $users->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$users_list->RenderListOptions();

// Render list options (header, left)
$users_list->ListOptions->Render("header", "left");
?>
<?php if ($users->zuserid->Visible) { // userid ?>
	<?php if ($users->SortUrl($users->zuserid) == "") { ?>
		<td><?php echo $users->zuserid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $users->SortUrl($users->zuserid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $users->zuserid->FldCaption() ?></td><td style="width: 10px;"><?php if ($users->zuserid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($users->zuserid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($users->username->Visible) { // username ?>
	<?php if ($users->SortUrl($users->username) == "") { ?>
		<td><?php echo $users->username->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $users->SortUrl($users->username) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $users->username->FldCaption() ?></td><td style="width: 10px;"><?php if ($users->username->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($users->username->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($users->password->Visible) { // password ?>
	<?php if ($users->SortUrl($users->password) == "") { ?>
		<td><?php echo $users->password->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $users->SortUrl($users->password) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $users->password->FldCaption() ?></td><td style="width: 10px;"><?php if ($users->password->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($users->password->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($users->userlevelid->Visible) { // userlevelid ?>
	<?php if ($users->SortUrl($users->userlevelid) == "") { ?>
		<td><?php echo $users->userlevelid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $users->SortUrl($users->userlevelid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $users->userlevelid->FldCaption() ?></td><td style="width: 10px;"><?php if ($users->userlevelid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($users->userlevelid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($users->groupid->Visible) { // groupid ?>
	<?php if ($users->SortUrl($users->groupid) == "") { ?>
		<td><?php echo $users->groupid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $users->SortUrl($users->groupid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $users->groupid->FldCaption() ?></td><td style="width: 10px;"><?php if ($users->groupid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($users->groupid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($users->parentid->Visible) { // parentid ?>
	<?php if ($users->SortUrl($users->parentid) == "") { ?>
		<td><?php echo $users->parentid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $users->SortUrl($users->parentid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $users->parentid->FldCaption() ?></td><td style="width: 10px;"><?php if ($users->parentid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($users->parentid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($users->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
	<?php if ($users->SortUrl($users->programarea_programarea_id) == "") { ?>
		<td><?php echo $users->programarea_programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $users->SortUrl($users->programarea_programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $users->programarea_programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($users->programarea_programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($users->programarea_programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$users_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($users->ExportAll && $users->Export <> "") {
	$users_list->lStopRec = $users_list->lTotalRecs;
} else {
	$users_list->lStopRec = $users_list->lStartRec + $users_list->lDisplayRecs - 1; // Set the last record to display
}
$users_list->lRecCount = $users_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $users_list->lStartRec > 1)
		$rs->Move($users_list->lStartRec - 1);
}

// Initialize aggregate
$users->RowType = EW_ROWTYPE_AGGREGATEINIT;
$users_list->RenderRow();
$users_list->lRowCnt = 0;
while (($users->CurrentAction == "gridadd" || !$rs->EOF) &&
	$users_list->lRecCount < $users_list->lStopRec) {
	$users_list->lRecCount++;
	if (intval($users_list->lRecCount) >= intval($users_list->lStartRec)) {
		$users_list->lRowCnt++;

	// Init row class and style
	$users->CssClass = "";
	$users->CssStyle = "";
	$users->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($users->CurrentAction == "gridadd") {
		$users_list->LoadDefaultValues(); // Load default values
	} else {
		$users_list->LoadRowValues($rs); // Load row values
	}
	$users->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$users_list->RenderRow();

	// Render list options
	$users_list->RenderListOptions();
?>
	<tr<?php echo $users->RowAttributes() ?>>
<?php

// Render list options (body, left)
$users_list->ListOptions->Render("body", "left");
?>
	<?php if ($users->zuserid->Visible) { // userid ?>
		<td<?php echo $users->zuserid->CellAttributes() ?>>
<div<?php echo $users->zuserid->ViewAttributes() ?>><?php echo $users->zuserid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($users->username->Visible) { // username ?>
		<td<?php echo $users->username->CellAttributes() ?>>
<div<?php echo $users->username->ViewAttributes() ?>><?php echo $users->username->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($users->password->Visible) { // password ?>
		<td<?php echo $users->password->CellAttributes() ?>>
<div<?php echo $users->password->ViewAttributes() ?>><?php echo $users->password->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($users->userlevelid->Visible) { // userlevelid ?>
		<td<?php echo $users->userlevelid->CellAttributes() ?>>
<div<?php echo $users->userlevelid->ViewAttributes() ?>><?php echo $users->userlevelid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($users->groupid->Visible) { // groupid ?>
		<td<?php echo $users->groupid->CellAttributes() ?>>
<div<?php echo $users->groupid->ViewAttributes() ?>><?php echo $users->groupid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($users->parentid->Visible) { // parentid ?>
		<td<?php echo $users->parentid->CellAttributes() ?>>
<div<?php echo $users->parentid->ViewAttributes() ?>><?php echo $users->parentid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($users->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
		<td<?php echo $users->programarea_programarea_id->CellAttributes() ?>>
<div<?php echo $users->programarea_programarea_id->ViewAttributes() ?>><?php echo $users->programarea_programarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$users_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($users->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($users->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($users->CurrentAction <> "gridadd" && $users->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($users_list->Pager)) $users_list->Pager = new cPrevNextPager($users_list->lStartRec, $users_list->lDisplayRecs, $users_list->lTotalRecs) ?>
<?php if ($users_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($users_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($users_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $users_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($users_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($users_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $users_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $users_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $users_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $users_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($users_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($users_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $users_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($users->Export == "" && $users->CurrentAction == "") { ?>
<?php } ?>
<?php if ($users->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$users_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cusers_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'users';

	// Page object name
	var $PageObjName = 'users_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $users;
		if ($users->UseTokenInUrl) $PageUrl .= "t=" . $users->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $users;
		if ($users->UseTokenInUrl) {
			if ($objForm)
				return ($users->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($users->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusers_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (users)
		$GLOBALS["users"] = new cusers();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["users"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "usersdelete.php";
		$this->MultiUpdateUrl = "usersupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'users', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $users;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate();
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$users->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$users->Export = $_POST["exporttype"];
		} else {
			$users->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $users->Export; // Get export parameter, used in header
		$gsExportFile = $users->TableVar; // Get export file, used in header
		if ($users->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($users->Export == "csv") {
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 20;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $users;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$users->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($users->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $users->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$users->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$users->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$users->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $users->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$users->setSessionWhere($sFilter);
		$users->CurrentFilter = "";

		// Export data only
		if (in_array($users->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($users->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $users;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $users->zuserid, FALSE); // userid
		$this->BuildSearchSql($sWhere, $users->username, FALSE); // username
		$this->BuildSearchSql($sWhere, $users->password, FALSE); // password
		$this->BuildSearchSql($sWhere, $users->userlevelid, FALSE); // userlevelid
		$this->BuildSearchSql($sWhere, $users->groupid, FALSE); // groupid
		$this->BuildSearchSql($sWhere, $users->parentid, FALSE); // parentid
		$this->BuildSearchSql($sWhere, $users->programarea_programarea_id, FALSE); // programarea_programarea_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($users->zuserid); // userid
			$this->SetSearchParm($users->username); // username
			$this->SetSearchParm($users->password); // password
			$this->SetSearchParm($users->userlevelid); // userlevelid
			$this->SetSearchParm($users->groupid); // groupid
			$this->SetSearchParm($users->parentid); // parentid
			$this->SetSearchParm($users->programarea_programarea_id); // programarea_programarea_id
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $users;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$users->setAdvancedSearch("x_$FldParm", $FldVal);
		$users->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$users->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$users->setAdvancedSearch("y_$FldParm", $FldVal2);
		$users->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $users;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $users->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $users->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $users->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $users->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $users->GetAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $users;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$users->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $users;
		$users->setAdvancedSearch("x_zuserid", "");
		$users->setAdvancedSearch("x_username", "");
		$users->setAdvancedSearch("x_password", "");
		$users->setAdvancedSearch("x_userlevelid", "");
		$users->setAdvancedSearch("x_groupid", "");
		$users->setAdvancedSearch("x_parentid", "");
		$users->setAdvancedSearch("x_programarea_programarea_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $users;
		$bRestore = TRUE;
		if (@$_GET["x_zuserid"] <> "") $bRestore = FALSE;
		if (@$_GET["x_username"] <> "") $bRestore = FALSE;
		if (@$_GET["x_password"] <> "") $bRestore = FALSE;
		if (@$_GET["x_userlevelid"] <> "") $bRestore = FALSE;
		if (@$_GET["x_groupid"] <> "") $bRestore = FALSE;
		if (@$_GET["x_parentid"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programarea_programarea_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($users->zuserid);
			$this->GetSearchParm($users->username);
			$this->GetSearchParm($users->password);
			$this->GetSearchParm($users->userlevelid);
			$this->GetSearchParm($users->groupid);
			$this->GetSearchParm($users->parentid);
			$this->GetSearchParm($users->programarea_programarea_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $users;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$users->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$users->CurrentOrderType = @$_GET["ordertype"];
			$users->UpdateSort($users->zuserid); // userid
			$users->UpdateSort($users->username); // username
			$users->UpdateSort($users->password); // password
			$users->UpdateSort($users->userlevelid); // userlevelid
			$users->UpdateSort($users->groupid); // groupid
			$users->UpdateSort($users->parentid); // parentid
			$users->UpdateSort($users->programarea_programarea_id); // programarea_programarea_id
			$users->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $users;
		$sOrderBy = $users->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($users->SqlOrderBy() <> "") {
				$sOrderBy = $users->SqlOrderBy();
				$users->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $users;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$users->setSessionOrderBy($sOrderBy);
				$users->zuserid->setSort("");
				$users->username->setSort("");
				$users->password->setSort("");
				$users->userlevelid->setSort("");
				$users->groupid->setSort("");
				$users->parentid->setSort("");
				$users->programarea_programarea_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$users->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $users;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($users->Export <> "" ||
			$users->CurrentAction == "gridadd" ||
			$users->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $users;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $this->ShowOptionLink() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $this->ShowOptionLink() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $this->ShowOptionLink() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $users;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $users;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$users->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$users->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $users->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$users->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$users->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$users->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $users;

		// Load search values
		// userid

		$users->zuserid->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_zuserid"]);
		$users->zuserid->AdvancedSearch->SearchOperator = @$_GET["z_zuserid"];

		// username
		$users->username->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_username"]);
		$users->username->AdvancedSearch->SearchOperator = @$_GET["z_username"];

		// password
		$users->password->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_password"]);
		$users->password->AdvancedSearch->SearchOperator = @$_GET["z_password"];

		// userlevelid
		$users->userlevelid->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_userlevelid"]);
		$users->userlevelid->AdvancedSearch->SearchOperator = @$_GET["z_userlevelid"];

		// groupid
		$users->groupid->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_groupid"]);
		$users->groupid->AdvancedSearch->SearchOperator = @$_GET["z_groupid"];

		// parentid
		$users->parentid->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_parentid"]);
		$users->parentid->AdvancedSearch->SearchOperator = @$_GET["z_parentid"];

		// programarea_programarea_id
		$users->programarea_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programarea_programarea_id"]);
		$users->programarea_programarea_id->AdvancedSearch->SearchOperator = @$_GET["z_programarea_programarea_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $users;

		// Call Recordset Selecting event
		$users->Recordset_Selecting($users->CurrentFilter);

		// Load List page SQL
		$sSql = $users->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$users->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $users;
		$sFilter = $users->KeyFilter();

		// Call Row Selecting event
		$users->Row_Selecting($sFilter);

		// Load SQL based on filter
		$users->CurrentFilter = $sFilter;
		$sSql = $users->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$users->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $users;
		$users->zuserid->setDbValue($rs->fields('userid'));
		$users->username->setDbValue($rs->fields('username'));
		$users->password->setDbValue($rs->fields('password'));
		$users->userlevelid->setDbValue($rs->fields('userlevelid'));
		$users->groupid->setDbValue($rs->fields('groupid'));
		$users->parentid->setDbValue($rs->fields('parentid'));
		$users->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $users;

		// Initialize URLs
		$this->ViewUrl = $users->ViewUrl();
		$this->EditUrl = $users->EditUrl();
		$this->InlineEditUrl = $users->InlineEditUrl();
		$this->CopyUrl = $users->CopyUrl();
		$this->InlineCopyUrl = $users->InlineCopyUrl();
		$this->DeleteUrl = $users->DeleteUrl();

		// Call Row_Rendering event
		$users->Row_Rendering();

		// Common render codes for all row types
		// userid

		$users->zuserid->CellCssStyle = ""; $users->zuserid->CellCssClass = "";
		$users->zuserid->CellAttrs = array(); $users->zuserid->ViewAttrs = array(); $users->zuserid->EditAttrs = array();

		// username
		$users->username->CellCssStyle = ""; $users->username->CellCssClass = "";
		$users->username->CellAttrs = array(); $users->username->ViewAttrs = array(); $users->username->EditAttrs = array();

		// password
		$users->password->CellCssStyle = ""; $users->password->CellCssClass = "";
		$users->password->CellAttrs = array(); $users->password->ViewAttrs = array(); $users->password->EditAttrs = array();

		// userlevelid
		$users->userlevelid->CellCssStyle = ""; $users->userlevelid->CellCssClass = "";
		$users->userlevelid->CellAttrs = array(); $users->userlevelid->ViewAttrs = array(); $users->userlevelid->EditAttrs = array();

		// groupid
		$users->groupid->CellCssStyle = ""; $users->groupid->CellCssClass = "";
		$users->groupid->CellAttrs = array(); $users->groupid->ViewAttrs = array(); $users->groupid->EditAttrs = array();

		// parentid
		$users->parentid->CellCssStyle = ""; $users->parentid->CellCssClass = "";
		$users->parentid->CellAttrs = array(); $users->parentid->ViewAttrs = array(); $users->parentid->EditAttrs = array();

		// programarea_programarea_id
		$users->programarea_programarea_id->CellCssStyle = ""; $users->programarea_programarea_id->CellCssClass = "";
		$users->programarea_programarea_id->CellAttrs = array(); $users->programarea_programarea_id->ViewAttrs = array(); $users->programarea_programarea_id->EditAttrs = array();
		if ($users->RowType == EW_ROWTYPE_VIEW) { // View row

			// userid
			$users->zuserid->ViewValue = $users->zuserid->CurrentValue;
			$users->zuserid->CssStyle = "";
			$users->zuserid->CssClass = "";
			$users->zuserid->ViewCustomAttributes = "";

			// username
			$users->username->ViewValue = $users->username->CurrentValue;
			$users->username->CssStyle = "";
			$users->username->CssClass = "";
			$users->username->ViewCustomAttributes = "";

			// password
			$users->password->ViewValue = "********";
			$users->password->CssStyle = "";
			$users->password->CssClass = "";
			$users->password->ViewCustomAttributes = "";

			// userlevelid
			if ($Security->CanAdmin()) { // System admin
			if (strval($users->userlevelid->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($users->userlevelid->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$users->userlevelid->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$users->userlevelid->ViewValue = $users->userlevelid->CurrentValue;
				}
			} else {
				$users->userlevelid->ViewValue = NULL;
			}
			} else {
				$users->userlevelid->ViewValue = "********";
			}
			$users->userlevelid->CssStyle = "";
			$users->userlevelid->CssClass = "";
			$users->userlevelid->ViewCustomAttributes = "";

			// groupid
			if (strval($users->groupid->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($users->groupid->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$users->groupid->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$users->groupid->ViewValue = $users->groupid->CurrentValue;
				}
			} else {
				$users->groupid->ViewValue = NULL;
			}
			$users->groupid->CssStyle = "";
			$users->groupid->CssClass = "";
			$users->groupid->ViewCustomAttributes = "";

			// parentid
			if (strval($users->parentid->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($users->parentid->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$users->parentid->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$users->parentid->ViewValue = $users->parentid->CurrentValue;
				}
			} else {
				$users->parentid->ViewValue = NULL;
			}
			$users->parentid->CssStyle = "";
			$users->parentid->CssClass = "";
			$users->parentid->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($users->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($users->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$users->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$users->programarea_programarea_id->ViewValue = $users->programarea_programarea_id->CurrentValue;
				}
			} else {
				$users->programarea_programarea_id->ViewValue = NULL;
			}
			$users->programarea_programarea_id->CssStyle = "";
			$users->programarea_programarea_id->CssClass = "";
			$users->programarea_programarea_id->ViewCustomAttributes = "";

			// userid
			$users->zuserid->HrefValue = "";
			$users->zuserid->TooltipValue = "";

			// username
			$users->username->HrefValue = "";
			$users->username->TooltipValue = "";

			// password
			$users->password->HrefValue = "";
			$users->password->TooltipValue = "";

			// userlevelid
			$users->userlevelid->HrefValue = "";
			$users->userlevelid->TooltipValue = "";

			// groupid
			$users->groupid->HrefValue = "";
			$users->groupid->TooltipValue = "";

			// parentid
			$users->parentid->HrefValue = "";
			$users->parentid->TooltipValue = "";

			// programarea_programarea_id
			$users->programarea_programarea_id->HrefValue = "";
			$users->programarea_programarea_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($users->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$users->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $users;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $users;
		$users->zuserid->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_zuserid");
		$users->username->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_username");
		$users->password->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_password");
		$users->userlevelid->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_userlevelid");
		$users->groupid->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_groupid");
		$users->parentid->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_parentid");
		$users->programarea_programarea_id->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_programarea_programarea_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $users;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $users->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($users->ExportAll) {
			$this->lDisplayRecs = $this->lTotalRecs;
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->lStartRec-1, $this->lDisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($users->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($users, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($users->zuserid);
				$ExportDoc->ExportCaption($users->username);
				$ExportDoc->ExportCaption($users->password);
				$ExportDoc->ExportCaption($users->userlevelid);
				$ExportDoc->ExportCaption($users->groupid);
				$ExportDoc->ExportCaption($users->parentid);
				$ExportDoc->ExportCaption($users->programarea_programarea_id);
				$ExportDoc->EndExportRow();
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			if (!$bSelectLimit && $this->lStartRec > 1)
				$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row
				$users->CssClass = "";
				$users->CssStyle = "";
				$users->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($users->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('zuserid', $users->zuserid->ExportValue($users->Export, $users->ExportOriginalValue));
					$XmlDoc->AddField('username', $users->username->ExportValue($users->Export, $users->ExportOriginalValue));
					$XmlDoc->AddField('password', $users->password->ExportValue($users->Export, $users->ExportOriginalValue));
					$XmlDoc->AddField('userlevelid', $users->userlevelid->ExportValue($users->Export, $users->ExportOriginalValue));
					$XmlDoc->AddField('groupid', $users->groupid->ExportValue($users->Export, $users->ExportOriginalValue));
					$XmlDoc->AddField('parentid', $users->parentid->ExportValue($users->Export, $users->ExportOriginalValue));
					$XmlDoc->AddField('programarea_programarea_id', $users->programarea_programarea_id->ExportValue($users->Export, $users->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($users->zuserid);
					$ExportDoc->ExportField($users->username);
					$ExportDoc->ExportField($users->password);
					$ExportDoc->ExportField($users->userlevelid);
					$ExportDoc->ExportField($users->groupid);
					$ExportDoc->ExportField($users->parentid);
					$ExportDoc->ExportField($users->programarea_programarea_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($users->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($users->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($users->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($users->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($users->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $users;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($users->userlevelid->CurrentValue);
			}
		}
		return TRUE;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
