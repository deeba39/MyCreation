<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "grade_yearinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "school_attendanceinfo.php" ?>
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
$grade_year_delete = new cgrade_year_delete();
$Page =& $grade_year_delete;

// Page init
$grade_year_delete->Page_Init();

// Page main
$grade_year_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var grade_year_delete = new ew_Page("grade_year_delete");

// page properties
grade_year_delete.PageID = "delete"; // page ID
grade_year_delete.FormID = "fgrade_yeardelete"; // form ID
var EW_PAGE_ID = grade_year_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grade_year_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grade_year_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grade_year_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $grade_year_delete->LoadRecordset())
	$grade_year_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($grade_year_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$grade_year_delete->Page_Terminate("grade_yearlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grade_year->TableCaption() ?><br><br>
<a href="<?php echo $grade_year->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grade_year_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="grade_year">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($grade_year_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $grade_year->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $grade_year->class->FldCaption() ?></td>
		<td valign="top"><?php echo $grade_year->year->FldCaption() ?></td>
		<td valign="top"><?php echo $grade_year->promoted->FldCaption() ?></td>
		<td valign="top"><?php echo $grade_year->programme->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$grade_year_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$grade_year_delete->lRecCnt++;

	// Set row properties
	$grade_year->CssClass = "";
	$grade_year->CssStyle = "";
	$grade_year->RowAttrs = array();
	$grade_year->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$grade_year_delete->LoadRowValues($rs);

	// Render row
	$grade_year_delete->RenderRow();
?>
	<tr<?php echo $grade_year->RowAttributes() ?>>
		<td<?php echo $grade_year->class->CellAttributes() ?>>
<div<?php echo $grade_year->class->ViewAttributes() ?>><?php echo $grade_year->class->ListViewValue() ?></div></td>
		<td<?php echo $grade_year->year->CellAttributes() ?>>
<div<?php echo $grade_year->year->ViewAttributes() ?>><?php echo $grade_year->year->ListViewValue() ?></div></td>
		<td<?php echo $grade_year->promoted->CellAttributes() ?>>
<div<?php echo $grade_year->promoted->ViewAttributes() ?>><?php echo $grade_year->promoted->ListViewValue() ?></div></td>
		<td<?php echo $grade_year->programme->CellAttributes() ?>>
<div<?php echo $grade_year->programme->ViewAttributes() ?>><?php echo $grade_year->programme->ListViewValue() ?></div></td>
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
$grade_year_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrade_year_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'grade_year';

	// Page object name
	var $PageObjName = 'grade_year_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grade_year;
		if ($grade_year->UseTokenInUrl) $PageUrl .= "t=" . $grade_year->TableVar . "&"; // Add page token
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
		global $objForm, $grade_year;
		if ($grade_year->UseTokenInUrl) {
			if ($objForm)
				return ($grade_year->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grade_year->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrade_year_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grade_year)
		$GLOBALS["grade_year"] = new cgrade_year();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (school_attendance)
		$GLOBALS['school_attendance'] = new cschool_attendance();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grade_year', TRUE);

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
		global $grade_year;

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
			$this->Page_Terminate("grade_yearlist.php");
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
		global $Language, $grade_year;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["grade_year_id"] <> "") {
			$grade_year->grade_year_id->setQueryStringValue($_GET["grade_year_id"]);
			if (!is_numeric($grade_year->grade_year_id->QueryStringValue))
				$this->Page_Terminate("grade_yearlist.php"); // Prevent SQL injection, exit
			$sKey .= $grade_year->grade_year_id->QueryStringValue;
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
			$this->Page_Terminate("grade_yearlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("grade_yearlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`grade_year_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in grade_year class, grade_yearinfo.php

		$grade_year->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$grade_year->CurrentAction = $_POST["a_delete"];
		} else {
			$grade_year->CurrentAction = "I"; // Display record
		}
		switch ($grade_year->CurrentAction) {
			case "D": // Delete
				$grade_year->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($grade_year->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $grade_year;
		$DeleteRows = TRUE;
		$sWrkFilter = $grade_year->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in grade_year class, grade_yearinfo.php

		$grade_year->CurrentFilter = $sWrkFilter;
		$sSql = $grade_year->SQL();
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
				$DeleteRows = $grade_year->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['grade_year_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($grade_year->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($grade_year->CancelMessage <> "") {
				$this->setMessage($grade_year->CancelMessage);
				$grade_year->CancelMessage = "";
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
				$grade_year->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $grade_year;

		// Call Recordset Selecting event
		$grade_year->Recordset_Selecting($grade_year->CurrentFilter);

		// Load List page SQL
		$sSql = $grade_year->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$grade_year->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grade_year;
		$sFilter = $grade_year->KeyFilter();

		// Call Row Selecting event
		$grade_year->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grade_year->CurrentFilter = $sFilter;
		$sSql = $grade_year->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$grade_year->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $grade_year;
		$grade_year->grade_year_id->setDbValue($rs->fields('grade_year_id'));
		$grade_year->class->setDbValue($rs->fields('class'));
		$grade_year->year->setDbValue($rs->fields('year'));
		$grade_year->promoted->setDbValue($rs->fields('promoted'));
		$grade_year->programme->setDbValue($rs->fields('programme'));
		$grade_year->school_attendance_school_attendance_id->setDbValue($rs->fields('school_attendance_school_attendance_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grade_year;

		// Initialize URLs
		// Call Row_Rendering event

		$grade_year->Row_Rendering();

		// Common render codes for all row types
		// class

		$grade_year->class->CellCssStyle = ""; $grade_year->class->CellCssClass = "";
		$grade_year->class->CellAttrs = array(); $grade_year->class->ViewAttrs = array(); $grade_year->class->EditAttrs = array();

		// year
		$grade_year->year->CellCssStyle = ""; $grade_year->year->CellCssClass = "";
		$grade_year->year->CellAttrs = array(); $grade_year->year->ViewAttrs = array(); $grade_year->year->EditAttrs = array();

		// promoted
		$grade_year->promoted->CellCssStyle = ""; $grade_year->promoted->CellCssClass = "";
		$grade_year->promoted->CellAttrs = array(); $grade_year->promoted->ViewAttrs = array(); $grade_year->promoted->EditAttrs = array();

		// programme
		$grade_year->programme->CellCssStyle = ""; $grade_year->programme->CellCssClass = "";
		$grade_year->programme->CellAttrs = array(); $grade_year->programme->ViewAttrs = array(); $grade_year->programme->EditAttrs = array();
		if ($grade_year->RowType == EW_ROWTYPE_VIEW) { // View row

			// grade_year_id
			$grade_year->grade_year_id->ViewValue = $grade_year->grade_year_id->CurrentValue;
			$grade_year->grade_year_id->CssStyle = "";
			$grade_year->grade_year_id->CssClass = "";
			$grade_year->grade_year_id->ViewCustomAttributes = "";

			// class
			$grade_year->class->ViewValue = $grade_year->class->CurrentValue;
			$grade_year->class->CssStyle = "";
			$grade_year->class->CssClass = "";
			$grade_year->class->ViewCustomAttributes = "";

			// year
			$grade_year->year->ViewValue = $grade_year->year->CurrentValue;
			$grade_year->year->CssStyle = "";
			$grade_year->year->CssClass = "";
			$grade_year->year->ViewCustomAttributes = "";

			// promoted
			if (strval($grade_year->promoted->CurrentValue) <> "") {
				switch ($grade_year->promoted->CurrentValue) {
					case "1":
						$grade_year->promoted->ViewValue = "Yes";
						break;
					case "0":
						$grade_year->promoted->ViewValue = "No";
						break;
					default:
						$grade_year->promoted->ViewValue = $grade_year->promoted->CurrentValue;
				}
			} else {
				$grade_year->promoted->ViewValue = NULL;
			}
			$grade_year->promoted->CssStyle = "";
			$grade_year->promoted->CssClass = "";
			$grade_year->promoted->ViewCustomAttributes = "";

			// programme
			$grade_year->programme->ViewValue = $grade_year->programme->CurrentValue;
			$grade_year->programme->CssStyle = "";
			$grade_year->programme->CssClass = "";
			$grade_year->programme->ViewCustomAttributes = "";

			// school_attendance_school_attendance_id
			$grade_year->school_attendance_school_attendance_id->ViewValue = $grade_year->school_attendance_school_attendance_id->CurrentValue;
			$grade_year->school_attendance_school_attendance_id->CssStyle = "";
			$grade_year->school_attendance_school_attendance_id->CssClass = "";
			$grade_year->school_attendance_school_attendance_id->ViewCustomAttributes = "";

			// class
			$grade_year->class->HrefValue = "";
			$grade_year->class->TooltipValue = "";

			// year
			$grade_year->year->HrefValue = "";
			$grade_year->year->TooltipValue = "";

			// promoted
			$grade_year->promoted->HrefValue = "";
			$grade_year->promoted->TooltipValue = "";

			// programme
			$grade_year->programme->HrefValue = "";
			$grade_year->programme->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($grade_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grade_year->Row_Rendered();
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
