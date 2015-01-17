<?php

// Global variable for table object
$sponsored_student = NULL;

//
// Table class for sponsored_student
//
class csponsored_student {
	var $TableVar = 'sponsored_student';
	var $TableName = 'sponsored_student';
	var $TableType = 'TABLE';
	var $sponsored_student_id;
	var $student_firstname;
	var $student_middlename;
	var $student_lastname;
	var $student_picture;
	var $student_grades;
	var $student_applicant_student_applicant_id;
	var $student_resident_programarea_id;
	var $group_id;
	var $community_community_id;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message

	//
	// Table class constructor
	//
	function csponsored_student() {
		global $Language;

		// sponsored_student_id
		$this->sponsored_student_id = new cField('sponsored_student', 'sponsored_student', 'x_sponsored_student_id', 'sponsored_student_id', '`sponsored_student_id`', 3, -1, FALSE, '`sponsored_student_id`', FALSE);
		$this->sponsored_student_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sponsored_student_id'] =& $this->sponsored_student_id;

		// student_firstname
		$this->student_firstname = new cField('sponsored_student', 'sponsored_student', 'x_student_firstname', 'student_firstname', '`student_firstname`', 200, -1, FALSE, '`student_firstname`', FALSE);
		$this->fields['student_firstname'] =& $this->student_firstname;

		// student_middlename
		$this->student_middlename = new cField('sponsored_student', 'sponsored_student', 'x_student_middlename', 'student_middlename', '`student_middlename`', 200, -1, FALSE, '`student_middlename`', FALSE);
		$this->fields['student_middlename'] =& $this->student_middlename;

		// student_lastname
		$this->student_lastname = new cField('sponsored_student', 'sponsored_student', 'x_student_lastname', 'student_lastname', '`student_lastname`', 200, -1, FALSE, '`student_lastname`', FALSE);
		$this->fields['student_lastname'] =& $this->student_lastname;

		// student_picture
		$this->student_picture = new cField('sponsored_student', 'sponsored_student', 'x_student_picture', 'student_picture', '`student_picture`', 200, -1, TRUE, '`student_picture`', FALSE);
		$this->student_picture->UploadPath = EW_UPLOAD_DEST_PATH;
		$this->student_picture->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['student_picture'] =& $this->student_picture;

		// student_grades
		$this->student_grades = new cField('sponsored_student', 'sponsored_student', 'x_student_grades', 'student_grades', '`student_grades`', 200, -1, FALSE, '`student_grades`', FALSE);
		$this->fields['student_grades'] =& $this->student_grades;

		// student_applicant_student_applicant_id
		$this->student_applicant_student_applicant_id = new cField('sponsored_student', 'sponsored_student', 'x_student_applicant_student_applicant_id', 'student_applicant_student_applicant_id', '`student_applicant_student_applicant_id`', 3, -1, FALSE, '`student_applicant_student_applicant_id`', FALSE);
		$this->student_applicant_student_applicant_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['student_applicant_student_applicant_id'] =& $this->student_applicant_student_applicant_id;

		// student_resident_programarea_id
		$this->student_resident_programarea_id = new cField('sponsored_student', 'sponsored_student', 'x_student_resident_programarea_id', 'student_resident_programarea_id', '`student_resident_programarea_id`', 3, -1, FALSE, '`student_resident_programarea_id`', FALSE);
		$this->student_resident_programarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['student_resident_programarea_id'] =& $this->student_resident_programarea_id;

		// group_id
		$this->group_id = new cField('sponsored_student', 'sponsored_student', 'x_group_id', 'group_id', '`group_id`', 3, -1, FALSE, '`group_id`', FALSE);
		$this->group_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['group_id'] =& $this->group_id;

		// community_community_id
		$this->community_community_id = new cField('sponsored_student', 'sponsored_student', 'x_community_community_id', 'community_community_id', '`community_community_id`', 3, -1, FALSE, '`community_community_id`', FALSE);
		$this->community_community_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['community_community_id'] =& $this->community_community_id;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "sponsored_student_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`sponsored_student`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		if ($this->TableFilter <> "") {
			if ($sWhere <> "") $sWhere = "(" . $sWhere . ") AND (";
			$sWhere .= "(" . $this->TableFilter . ")";
		}
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		global $Security;

		// Add User ID filter
		if (!$this->AllowAnonymousUser() && $Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$sFilter = $this->AddUserIDFilter($sFilter);
		}
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "(" . $sFilter . ") AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `sponsored_student` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `sponsored_student` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `sponsored_student` WHERE ";
		$SQL .= ew_QuotedName('sponsored_student_id') . '=' . ew_QuotedValue($rs['sponsored_student_id'], $this->sponsored_student_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`sponsored_student_id` = @sponsored_student_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->sponsored_student_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@sponsored_student_id@", ew_AdjustSql($this->sponsored_student_id->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "sponsored_studentlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "sponsored_studentlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("sponsored_studentview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "sponsored_studentadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("sponsored_studentedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("sponsored_studentadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("sponsored_studentdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->sponsored_student_id->CurrentValue)) {
			$sUrl .= "sponsored_student_id=" . urlencode($this->sponsored_student_id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=sponsored_student" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$this->student_firstname->setDbValue($rs->fields('student_firstname'));
		$this->student_middlename->setDbValue($rs->fields('student_middlename'));
		$this->student_lastname->setDbValue($rs->fields('student_lastname'));
		$this->student_picture->Upload->DbValue = $rs->fields('student_picture');
		$this->student_grades->setDbValue($rs->fields('student_grades'));
		$this->student_applicant_student_applicant_id->setDbValue($rs->fields('student_applicant_student_applicant_id'));
		$this->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$this->group_id->setDbValue($rs->fields('group_id'));
		$this->community_community_id->setDbValue($rs->fields('community_community_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// sponsored_student_id

		$this->sponsored_student_id->CellCssStyle = "white-space: nowrap;"; $this->sponsored_student_id->CellCssClass = "";
		$this->sponsored_student_id->CellAttrs = array(); $this->sponsored_student_id->ViewAttrs = array(); $this->sponsored_student_id->EditAttrs = array();

		// student_firstname
		$this->student_firstname->CellCssStyle = "white-space: nowrap;"; $this->student_firstname->CellCssClass = "";
		$this->student_firstname->CellAttrs = array(); $this->student_firstname->ViewAttrs = array(); $this->student_firstname->EditAttrs = array();

		// student_middlename
		$this->student_middlename->CellCssStyle = "white-space: nowrap;"; $this->student_middlename->CellCssClass = "";
		$this->student_middlename->CellAttrs = array(); $this->student_middlename->ViewAttrs = array(); $this->student_middlename->EditAttrs = array();

		// student_lastname
		$this->student_lastname->CellCssStyle = "white-space: nowrap;"; $this->student_lastname->CellCssClass = "";
		$this->student_lastname->CellAttrs = array(); $this->student_lastname->ViewAttrs = array(); $this->student_lastname->EditAttrs = array();

		// student_applicant_student_applicant_id
		$this->student_applicant_student_applicant_id->CellCssStyle = "white-space: nowrap;"; $this->student_applicant_student_applicant_id->CellCssClass = "";
		$this->student_applicant_student_applicant_id->CellAttrs = array(); $this->student_applicant_student_applicant_id->ViewAttrs = array(); $this->student_applicant_student_applicant_id->EditAttrs = array();

		// student_resident_programarea_id
		$this->student_resident_programarea_id->CellCssStyle = "white-space: nowrap;"; $this->student_resident_programarea_id->CellCssClass = "";
		$this->student_resident_programarea_id->CellAttrs = array(); $this->student_resident_programarea_id->ViewAttrs = array(); $this->student_resident_programarea_id->EditAttrs = array();

		// sponsored_student_id
		$this->sponsored_student_id->ViewValue = $this->sponsored_student_id->CurrentValue;
		$this->sponsored_student_id->CssStyle = "";
		$this->sponsored_student_id->CssClass = "";
		$this->sponsored_student_id->ViewCustomAttributes = "";

		// student_firstname
		$this->student_firstname->ViewValue = $this->student_firstname->CurrentValue;
		$this->student_firstname->CssStyle = "";
		$this->student_firstname->CssClass = "";
		$this->student_firstname->ViewCustomAttributes = "";

		// student_middlename
		$this->student_middlename->ViewValue = $this->student_middlename->CurrentValue;
		$this->student_middlename->CssStyle = "";
		$this->student_middlename->CssClass = "";
		$this->student_middlename->ViewCustomAttributes = "";

		// student_lastname
		$this->student_lastname->ViewValue = $this->student_lastname->CurrentValue;
		$this->student_lastname->CssStyle = "";
		$this->student_lastname->CssClass = "";
		$this->student_lastname->ViewCustomAttributes = "";

		// student_applicant_student_applicant_id
		$this->student_applicant_student_applicant_id->ViewValue = $this->student_applicant_student_applicant_id->CurrentValue;
		if (strval($this->student_applicant_student_applicant_id->CurrentValue) <> "") {
			$sFilterWrk = "`student_applicant_id` = " . ew_AdjustSql($this->student_applicant_student_applicant_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `student_applicant`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->student_applicant_student_applicant_id->ViewValue = $rswrk->fields('student_lastname');
				$this->student_applicant_student_applicant_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
				$rswrk->Close();
			} else {
				$this->student_applicant_student_applicant_id->ViewValue = $this->student_applicant_student_applicant_id->CurrentValue;
			}
		} else {
			$this->student_applicant_student_applicant_id->ViewValue = NULL;
		}
		$this->student_applicant_student_applicant_id->CssStyle = "";
		$this->student_applicant_student_applicant_id->CssClass = "";
		$this->student_applicant_student_applicant_id->ViewCustomAttributes = "";

		// student_resident_programarea_id
		if (strval($this->student_resident_programarea_id->CurrentValue) <> "") {
			$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($this->student_resident_programarea_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
				$rswrk->Close();
			} else {
				$this->student_resident_programarea_id->ViewValue = $this->student_resident_programarea_id->CurrentValue;
			}
		} else {
			$this->student_resident_programarea_id->ViewValue = NULL;
		}
		$this->student_resident_programarea_id->CssStyle = "";
		$this->student_resident_programarea_id->CssClass = "";
		$this->student_resident_programarea_id->ViewCustomAttributes = "";

		// sponsored_student_id
		$this->sponsored_student_id->HrefValue = "";
		$this->sponsored_student_id->TooltipValue = "";

		// student_firstname
		$this->student_firstname->HrefValue = "";
		$this->student_firstname->TooltipValue = "";

		// student_middlename
		$this->student_middlename->HrefValue = "";
		$this->student_middlename->TooltipValue = "";

		// student_lastname
		$this->student_lastname->HrefValue = "";
		$this->student_lastname->TooltipValue = "";

		// student_applicant_student_applicant_id
		$this->student_applicant_student_applicant_id->HrefValue = "";
		$this->student_applicant_student_applicant_id->TooltipValue = "";

		// student_resident_programarea_id
		$this->student_resident_programarea_id->HrefValue = "";
		$this->student_resident_programarea_id->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Add User ID filter
	function AddUserIDFilter($sFilter) {
		global $Security;
		$sFilterWrk = $Security->UserIDList();
		if (!$Security->IsAdmin() && $sFilterWrk <> "") {
			$sFilterWrk = '`group_id` IN (' . $sFilterWrk . ')';
			if ($sFilter <> "")
				$sFilterWrk = "(" . $sFilter . ") AND (" . $sFilterWrk . ")";
		} else {
			$sFilterWrk = $sFilter;
		}
		return $sFilterWrk;
	}

	// User ID subquery
	function GetUserIDSubquery(&$fld, &$masterfld) {
		global $conn;
		$sWrk = "";
		$sSql = "SELECT " . $masterfld->FldExpression . " FROM `sponsored_student` WHERE " . $this->AddUserIDFilter("");

		// List all values
		if ($rs = $conn->Execute($sSql)) {
			while (!$rs->EOF) {
				if ($sWrk <> "") $sWrk .= ",";
				$sWrk .= ew_QuotedValue($rs->fields[0], $masterfld->FldDataType);
				$rs->MoveNext();
			}
			$rs->Close();
		}
		if ($sWrk <> "") {
			$sWrk = $fld->FldExpression . " IN (" . $sWrk . ")";
		}
		return $sWrk;
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

		// Row Inserting event
function Row_Inserting(&$rs) {
    // Enter your code here
    // To cancel, set return value to FALSE
    return FALSE;         
}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict(&$rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
