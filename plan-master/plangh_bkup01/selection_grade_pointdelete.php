<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "selection_grade_pointinfo.php" ?>
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
$selection_grade_point_delete = new cselection_grade_point_delete();
$Page =& $selection_grade_point_delete;

// Page init
$selection_grade_point_delete->Page_Init();

// Page main
$selection_grade_point_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var selection_grade_point_delete = new ew_Page("selection_grade_point_delete");

// page properties
selection_grade_point_delete.PageID = "delete"; // page ID
selection_grade_point_delete.FormID = "fselection_grade_pointdelete"; // form ID
var EW_PAGE_ID = selection_grade_point_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
selection_grade_point_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
selection_grade_point_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
selection_grade_point_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $selection_grade_point_delete->LoadRecordset())
	$selection_grade_point_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($selection_grade_point_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$selection_grade_point_delete->Page_Terminate("selection_grade_pointlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $selection_grade_point->TableCaption() ?><br><br>
<a href="<?php echo $selection_grade_point->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$selection_grade_point_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="selection_grade_point">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($selection_grade_point_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $selection_grade_point->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $selection_grade_point->selection_grade_points_id->FldCaption() ?></td>
		<td valign="top"><?php echo $selection_grade_point->grade_point->FldCaption() ?></td>
		<td valign="top"><?php echo $selection_grade_point->min_grade->FldCaption() ?></td>
		<td valign="top"><?php echo $selection_grade_point->max_grade->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$selection_grade_point_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$selection_grade_point_delete->lRecCnt++;

	// Set row properties
	$selection_grade_point->CssClass = "";
	$selection_grade_point->CssStyle = "";
	$selection_grade_point->RowAttrs = array();
	$selection_grade_point->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$selection_grade_point_delete->LoadRowValues($rs);

	// Render row
	$selection_grade_point_delete->RenderRow();
?>
	<tr<?php echo $selection_grade_point->RowAttributes() ?>>
		<td<?php echo $selection_grade_point->selection_grade_points_id->CellAttributes() ?>>
<div<?php echo $selection_grade_point->selection_grade_points_id->ViewAttributes() ?>><?php echo $selection_grade_point->selection_grade_points_id->ListViewValue() ?></div></td>
		<td<?php echo $selection_grade_point->grade_point->CellAttributes() ?>>
<div<?php echo $selection_grade_point->grade_point->ViewAttributes() ?>><?php echo $selection_grade_point->grade_point->ListViewValue() ?></div></td>
		<td<?php echo $selection_grade_point->min_grade->CellAttributes() ?>>
<div<?php echo $selection_grade_point->min_grade->ViewAttributes() ?>><?php echo $selection_grade_point->min_grade->ListViewValue() ?></div></td>
		<td<?php echo $selection_grade_point->max_grade->CellAttributes() ?>>
<div<?php echo $selection_grade_point->max_grade->ViewAttributes() ?>><?php echo $selection_grade_point->max_grade->ListViewValue() ?></div></td>
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
$selection_grade_point_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cselection_grade_point_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'selection_grade_point';

	// Page object name
	var $PageObjName = 'selection_grade_point_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $selection_grade_point;
		if ($selection_grade_point->UseTokenInUrl) $PageUrl .= "t=" . $selection_grade_point->TableVar . "&"; // Add page token
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
		global $objForm, $selection_grade_point;
		if ($selection_grade_point->UseTokenInUrl) {
			if ($objForm)
				return ($selection_grade_point->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($selection_grade_point->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cselection_grade_point_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (selection_grade_point)
		$GLOBALS["selection_grade_point"] = new cselection_grade_point();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'selection_grade_point', TRUE);

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
		global $selection_grade_point;

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
			$this->Page_Terminate("selection_grade_pointlist.php");
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
		global $Language, $selection_grade_point;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["selection_grade_points_id"] <> "") {
			$selection_grade_point->selection_grade_points_id->setQueryStringValue($_GET["selection_grade_points_id"]);
			if (!is_numeric($selection_grade_point->selection_grade_points_id->QueryStringValue))
				$this->Page_Terminate("selection_grade_pointlist.php"); // Prevent SQL injection, exit
			$sKey .= $selection_grade_point->selection_grade_points_id->QueryStringValue;
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
			$this->Page_Terminate("selection_grade_pointlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("selection_grade_pointlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`selection_grade_points_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in selection_grade_point class, selection_grade_pointinfo.php

		$selection_grade_point->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$selection_grade_point->CurrentAction = $_POST["a_delete"];
		} else {
			$selection_grade_point->CurrentAction = "I"; // Display record
		}
		switch ($selection_grade_point->CurrentAction) {
			case "D": // Delete
				$selection_grade_point->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($selection_grade_point->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $selection_grade_point;
		$DeleteRows = TRUE;
		$sWrkFilter = $selection_grade_point->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in selection_grade_point class, selection_grade_pointinfo.php

		$selection_grade_point->CurrentFilter = $sWrkFilter;
		$sSql = $selection_grade_point->SQL();
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
				$DeleteRows = $selection_grade_point->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['selection_grade_points_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($selection_grade_point->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($selection_grade_point->CancelMessage <> "") {
				$this->setMessage($selection_grade_point->CancelMessage);
				$selection_grade_point->CancelMessage = "";
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
				$selection_grade_point->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $selection_grade_point;

		// Call Recordset Selecting event
		$selection_grade_point->Recordset_Selecting($selection_grade_point->CurrentFilter);

		// Load List page SQL
		$sSql = $selection_grade_point->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$selection_grade_point->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $selection_grade_point;
		$sFilter = $selection_grade_point->KeyFilter();

		// Call Row Selecting event
		$selection_grade_point->Row_Selecting($sFilter);

		// Load SQL based on filter
		$selection_grade_point->CurrentFilter = $sFilter;
		$sSql = $selection_grade_point->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$selection_grade_point->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $selection_grade_point;
		$selection_grade_point->selection_grade_points_id->setDbValue($rs->fields('selection_grade_points_id'));
		$selection_grade_point->grade_point->setDbValue($rs->fields('grade_point'));
		$selection_grade_point->min_grade->setDbValue($rs->fields('min_grade'));
		$selection_grade_point->max_grade->setDbValue($rs->fields('max_grade'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $selection_grade_point;

		// Initialize URLs
		// Call Row_Rendering event

		$selection_grade_point->Row_Rendering();

		// Common render codes for all row types
		// selection_grade_points_id

		$selection_grade_point->selection_grade_points_id->CellCssStyle = ""; $selection_grade_point->selection_grade_points_id->CellCssClass = "";
		$selection_grade_point->selection_grade_points_id->CellAttrs = array(); $selection_grade_point->selection_grade_points_id->ViewAttrs = array(); $selection_grade_point->selection_grade_points_id->EditAttrs = array();

		// grade_point
		$selection_grade_point->grade_point->CellCssStyle = ""; $selection_grade_point->grade_point->CellCssClass = "";
		$selection_grade_point->grade_point->CellAttrs = array(); $selection_grade_point->grade_point->ViewAttrs = array(); $selection_grade_point->grade_point->EditAttrs = array();

		// min_grade
		$selection_grade_point->min_grade->CellCssStyle = ""; $selection_grade_point->min_grade->CellCssClass = "";
		$selection_grade_point->min_grade->CellAttrs = array(); $selection_grade_point->min_grade->ViewAttrs = array(); $selection_grade_point->min_grade->EditAttrs = array();

		// max_grade
		$selection_grade_point->max_grade->CellCssStyle = ""; $selection_grade_point->max_grade->CellCssClass = "";
		$selection_grade_point->max_grade->CellAttrs = array(); $selection_grade_point->max_grade->ViewAttrs = array(); $selection_grade_point->max_grade->EditAttrs = array();
		if ($selection_grade_point->RowType == EW_ROWTYPE_VIEW) { // View row

			// selection_grade_points_id
			$selection_grade_point->selection_grade_points_id->ViewValue = $selection_grade_point->selection_grade_points_id->CurrentValue;
			$selection_grade_point->selection_grade_points_id->CssStyle = "";
			$selection_grade_point->selection_grade_points_id->CssClass = "";
			$selection_grade_point->selection_grade_points_id->ViewCustomAttributes = "";

			// grade_point
			$selection_grade_point->grade_point->ViewValue = $selection_grade_point->grade_point->CurrentValue;
			$selection_grade_point->grade_point->CssStyle = "";
			$selection_grade_point->grade_point->CssClass = "";
			$selection_grade_point->grade_point->ViewCustomAttributes = "";

			// min_grade
			$selection_grade_point->min_grade->ViewValue = $selection_grade_point->min_grade->CurrentValue;
			$selection_grade_point->min_grade->CssStyle = "";
			$selection_grade_point->min_grade->CssClass = "";
			$selection_grade_point->min_grade->ViewCustomAttributes = "";

			// max_grade
			$selection_grade_point->max_grade->ViewValue = $selection_grade_point->max_grade->CurrentValue;
			$selection_grade_point->max_grade->CssStyle = "";
			$selection_grade_point->max_grade->CssClass = "";
			$selection_grade_point->max_grade->ViewCustomAttributes = "";

			// selection_grade_points_id
			$selection_grade_point->selection_grade_points_id->HrefValue = "";
			$selection_grade_point->selection_grade_points_id->TooltipValue = "";

			// grade_point
			$selection_grade_point->grade_point->HrefValue = "";
			$selection_grade_point->grade_point->TooltipValue = "";

			// min_grade
			$selection_grade_point->min_grade->HrefValue = "";
			$selection_grade_point->min_grade->TooltipValue = "";

			// max_grade
			$selection_grade_point->max_grade->HrefValue = "";
			$selection_grade_point->max_grade->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($selection_grade_point->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$selection_grade_point->Row_Rendered();
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
