<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "communityinfo.php" ?>
<?php include "districtsinfo.php" ?>
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
$community_delete = new ccommunity_delete();
$Page =& $community_delete;

// Page init
$community_delete->Page_Init();

// Page main
$community_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var community_delete = new ew_Page("community_delete");

// page properties
community_delete.PageID = "delete"; // page ID
community_delete.FormID = "fcommunitydelete"; // form ID
var EW_PAGE_ID = community_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
community_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
community_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
community_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
if ($rs = $community_delete->LoadRecordset())
	$community_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($community_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$community_delete->Page_Terminate("communitylist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $community->TableCaption() ?><br><br>
<a href="<?php echo $community->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$community_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="community">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($community_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $community->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $community->community_1->FldCaption() ?></td>
		<td valign="top"><?php echo $community->programarea_programarea_id->FldCaption() ?></td>
		<td valign="top"><?php echo $community->community_category_community_category_id->FldCaption() ?></td>
		<td valign="top"><?php echo $community->community_districts_DistrictID->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$community_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$community_delete->lRecCnt++;

	// Set row properties
	$community->CssClass = "";
	$community->CssStyle = "";
	$community->RowAttrs = array();
	$community->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$community_delete->LoadRowValues($rs);

	// Render row
	$community_delete->RenderRow();
?>
	<tr<?php echo $community->RowAttributes() ?>>
		<td<?php echo $community->community_1->CellAttributes() ?>>
<div<?php echo $community->community_1->ViewAttributes() ?>><?php echo $community->community_1->ListViewValue() ?></div></td>
		<td<?php echo $community->programarea_programarea_id->CellAttributes() ?>>
<div<?php echo $community->programarea_programarea_id->ViewAttributes() ?>><?php echo $community->programarea_programarea_id->ListViewValue() ?></div></td>
		<td<?php echo $community->community_category_community_category_id->CellAttributes() ?>>
<div<?php echo $community->community_category_community_category_id->ViewAttributes() ?>><?php echo $community->community_category_community_category_id->ListViewValue() ?></div></td>
		<td<?php echo $community->community_districts_DistrictID->CellAttributes() ?>>
<div<?php echo $community->community_districts_DistrictID->ViewAttributes() ?>><?php echo $community->community_districts_DistrictID->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$community_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccommunity_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'community';

	// Page object name
	var $PageObjName = 'community_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $community;
		if ($community->UseTokenInUrl) $PageUrl .= "t=" . $community->TableVar . "&"; // Add page token
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
		global $objForm, $community;
		if ($community->UseTokenInUrl) {
			if ($objForm)
				return ($community->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($community->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccommunity_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (community)
		$GLOBALS["community"] = new ccommunity();

		// Table object (districts)
		$GLOBALS['districts'] = new cdistricts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'community', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $community;

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
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("communitylist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $community;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["community_id"] <> "") {
			$community->community_id->setQueryStringValue($_GET["community_id"]);
			if (!is_numeric($community->community_id->QueryStringValue))
				$this->Page_Terminate("communitylist.php"); // Prevent SQL injection, exit
			$sKey .= $community->community_id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("communitylist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("communitylist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`community_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in community class, communityinfo.php

		$community->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$community->CurrentAction = $_POST["a_delete"];
		} else {
			$community->CurrentAction = "I"; // Display record
		}
		switch ($community->CurrentAction) {
			case "D": // Delete
				$community->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($community->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $community;
		$DeleteRows = TRUE;
		$sWrkFilter = $community->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in community class, communityinfo.php

		$community->CurrentFilter = $sWrkFilter;
		$sSql = $community->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $community->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['community_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($community->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($community->CancelMessage <> "") {
				$this->setMessage($community->CancelMessage);
				$community->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$community->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $community;

		// Call Recordset Selecting event
		$community->Recordset_Selecting($community->CurrentFilter);

		// Load List page SQL
		$sSql = $community->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$community->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $community;
		$sFilter = $community->KeyFilter();

		// Call Row Selecting event
		$community->Row_Selecting($sFilter);

		// Load SQL based on filter
		$community->CurrentFilter = $sFilter;
		$sSql = $community->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$community->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $community;
		$community->community_id->setDbValue($rs->fields('community_id'));
		$community->community_1->setDbValue($rs->fields('community'));
		$community->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
		$community->community_category_community_category_id->setDbValue($rs->fields('community_category_community_category_id'));
		$community->community_districts_DistrictID->setDbValue($rs->fields('community_districts_DistrictID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $community;

		// Initialize URLs
		// Call Row_Rendering event

		$community->Row_Rendering();

		// Common render codes for all row types
		// community

		$community->community_1->CellCssStyle = ""; $community->community_1->CellCssClass = "";
		$community->community_1->CellAttrs = array(); $community->community_1->ViewAttrs = array(); $community->community_1->EditAttrs = array();

		// programarea_programarea_id
		$community->programarea_programarea_id->CellCssStyle = ""; $community->programarea_programarea_id->CellCssClass = "";
		$community->programarea_programarea_id->CellAttrs = array(); $community->programarea_programarea_id->ViewAttrs = array(); $community->programarea_programarea_id->EditAttrs = array();

		// community_category_community_category_id
		$community->community_category_community_category_id->CellCssStyle = ""; $community->community_category_community_category_id->CellCssClass = "";
		$community->community_category_community_category_id->CellAttrs = array(); $community->community_category_community_category_id->ViewAttrs = array(); $community->community_category_community_category_id->EditAttrs = array();

		// community_districts_DistrictID
		$community->community_districts_DistrictID->CellCssStyle = ""; $community->community_districts_DistrictID->CellCssClass = "";
		$community->community_districts_DistrictID->CellAttrs = array(); $community->community_districts_DistrictID->ViewAttrs = array(); $community->community_districts_DistrictID->EditAttrs = array();
		if ($community->RowType == EW_ROWTYPE_VIEW) { // View row

			// community_id
			$community->community_id->ViewValue = $community->community_id->CurrentValue;
			$community->community_id->CssStyle = "";
			$community->community_id->CssClass = "";
			$community->community_id->ViewCustomAttributes = "";

			// community
			$community->community_1->ViewValue = $community->community_1->CurrentValue;
			$community->community_1->CssStyle = "";
			$community->community_1->CssClass = "";
			$community->community_1->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($community->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($community->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$community->programarea_programarea_id->ViewValue = $community->programarea_programarea_id->CurrentValue;
				}
			} else {
				$community->programarea_programarea_id->ViewValue = NULL;
			}
			$community->programarea_programarea_id->CssStyle = "";
			$community->programarea_programarea_id->CssClass = "";
			$community->programarea_programarea_id->ViewCustomAttributes = "";

			// community_category_community_category_id
			if (strval($community->community_category_community_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_category_id` = " . ew_AdjustSql($community->community_category_community_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community_category_name` FROM `community_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->community_category_community_category_id->ViewValue = $rswrk->fields('community_category_name');
					$rswrk->Close();
				} else {
					$community->community_category_community_category_id->ViewValue = $community->community_category_community_category_id->CurrentValue;
				}
			} else {
				$community->community_category_community_category_id->ViewValue = NULL;
			}
			$community->community_category_community_category_id->CssStyle = "";
			$community->community_category_community_category_id->CssClass = "";
			$community->community_category_community_category_id->ViewCustomAttributes = "";

			// community_districts_DistrictID
			if (strval($community->community_districts_DistrictID->CurrentValue) <> "") {
				$sFilterWrk = "`DistrictID` = " . ew_AdjustSql($community->community_districts_DistrictID->CurrentValue) . "";
			$sSqlWrk = "SELECT `District` FROM `districts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->community_districts_DistrictID->ViewValue = $rswrk->fields('District');
					$rswrk->Close();
				} else {
					$community->community_districts_DistrictID->ViewValue = $community->community_districts_DistrictID->CurrentValue;
				}
			} else {
				$community->community_districts_DistrictID->ViewValue = NULL;
			}
			$community->community_districts_DistrictID->CssStyle = "";
			$community->community_districts_DistrictID->CssClass = "";
			$community->community_districts_DistrictID->ViewCustomAttributes = "";

			// community
			$community->community_1->HrefValue = "";
			$community->community_1->TooltipValue = "";

			// programarea_programarea_id
			$community->programarea_programarea_id->HrefValue = "";
			$community->programarea_programarea_id->TooltipValue = "";

			// community_category_community_category_id
			$community->community_category_community_category_id->HrefValue = "";
			$community->community_category_community_category_id->TooltipValue = "";

			// community_districts_DistrictID
			$community->community_districts_DistrictID->HrefValue = "";
			$community->community_districts_DistrictID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($community->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$community->Row_Rendered();
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
}
?>
