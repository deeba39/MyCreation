<?php

// Global variable for table object
$view_sponsored_student_grade = NULL;

//
// Table class for view_sponsored_student_grade
//
class cview_sponsored_student_grade {
	var $TableVar = 'view_sponsored_student_grade';
	var $TableName = 'view_sponsored_student_grade';
	var $TableType = 'CUSTOMVIEW';
	var $student_resident_programarea_id;
	var $school_attendance_id;
	var $sponsored_student_id;
	var $student_firstname;
	var $student_lastname;
	var $schools_school_id;
	var $school_name;
	var $grade_year_id;
	var $promoted;
	var $year;
	var $class;
	var $programme;
	var $english;
	var $math;
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
	function cview_sponsored_student_grade() {
		global $Language;

		// student_resident_programarea_id
		$this->student_resident_programarea_id = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_student_resident_programarea_id', 'student_resident_programarea_id', 's.student_resident_programarea_id', 3, -1, FALSE, 's.student_resident_programarea_id', FALSE);
		$this->student_resident_programarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['student_resident_programarea_id'] =& $this->student_resident_programarea_id;

		// school_attendance_id
		$this->school_attendance_id = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_school_attendance_id', 'school_attendance_id', 'school_attendance.school_attendance_id', 3, -1, FALSE, 'school_attendance.school_attendance_id', FALSE);
		$this->school_attendance_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['school_attendance_id'] =& $this->school_attendance_id;

		// sponsored_student_id
		$this->sponsored_student_id = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_sponsored_student_id', 'sponsored_student_id', 's.sponsored_student_id', 3, -1, FALSE, 's.sponsored_student_id', FALSE);
		$this->sponsored_student_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sponsored_student_id'] =& $this->sponsored_student_id;

		// student_firstname
		$this->student_firstname = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_student_firstname', 'student_firstname', 's.student_firstname', 200, -1, FALSE, 's.student_firstname', FALSE);
		$this->fields['student_firstname'] =& $this->student_firstname;

		// student_lastname
		$this->student_lastname = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_student_lastname', 'student_lastname', 's.student_lastname', 200, -1, FALSE, 's.student_lastname', FALSE);
		$this->fields['student_lastname'] =& $this->student_lastname;

		// schools_school_id
		$this->schools_school_id = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_schools_school_id', 'schools_school_id', 'school_attendance.schools_school_id', 3, -1, FALSE, 'school_attendance.schools_school_id', FALSE);
		$this->schools_school_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['schools_school_id'] =& $this->schools_school_id;

		// school_name
		$this->school_name = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_school_name', 'school_name', 'schools.school_name', 200, -1, FALSE, 'schools.school_name', FALSE);
		$this->fields['school_name'] =& $this->school_name;

		// grade_year_id
		$this->grade_year_id = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_grade_year_id', 'grade_year_id', 'g.grade_year_id', 3, -1, FALSE, 'g.grade_year_id', FALSE);
		$this->grade_year_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['grade_year_id'] =& $this->grade_year_id;

		// promoted
		$this->promoted = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_promoted', 'promoted', 'g.promoted', 16, -1, FALSE, 'g.promoted', FALSE);
		$this->promoted->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['promoted'] =& $this->promoted;

		// year
		$this->year = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_year', 'year', 'g.year', 3, -1, FALSE, 'g.year', FALSE);
		$this->year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['year'] =& $this->year;

		// class
		$this->class = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_class', 'class', 'g.class', 200, -1, FALSE, 'g.class', FALSE);
		$this->fields['class'] =& $this->class;

		// programme
		$this->programme = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_programme', 'programme', 'g.programme', 200, -1, FALSE, 'g.programme', FALSE);
		$this->fields['programme'] =& $this->programme;

		// english
		$this->english = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_english', 'english', 'g.english', 200, -1, FALSE, 'g.english', FALSE);
		$this->fields['english'] =& $this->english;

		// math
		$this->math = new cField('view_sponsored_student_grade', 'view_sponsored_student_grade', 'x_math', 'math', 'g.math', 200, -1, FALSE, 'g.math', FALSE);
		$this->fields['math'] =& $this->math;
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
		return "view_sponsored_student_grade_Highlight";
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
		return "sponsored_student s Left Join school_attendance On s.sponsored_student_id = school_attendance.sponsored_student_sponsored_student_id Left Join grade_year g On g.school_attendance_school_attendance_id = school_attendance.school_attendance_id Left Join schools On schools.school_id = school_attendance.schools_school_id";
	}

	function SqlSelect() { // Select
		return "SELECT s.sponsored_student_id, s.student_firstname, s.student_lastname, school_attendance.school_attendance_id, school_attendance.schools_school_id, schools.school_name, g.class, g.year, g.promoted, g.programme, g.grade_year_id, s.student_resident_programarea_id, g.english, g.math FROM " . $this->SqlFrom();
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
		return "INSERT INTO sponsored_student s Left Join school_attendance On s.sponsored_student_id = school_attendance.sponsored_student_sponsored_student_id Left Join grade_year g On g.school_attendance_school_attendance_id = school_attendance.school_attendance_id Left Join schools On schools.school_id = school_attendance.schools_school_id ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE sponsored_student s Left Join school_attendance On s.sponsored_student_id = school_attendance.sponsored_student_sponsored_student_id Left Join grade_year g On g.school_attendance_school_attendance_id = school_attendance.school_attendance_id Left Join schools On schools.school_id = school_attendance.schools_school_id SET ";
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
		$SQL = "DELETE FROM sponsored_student s Left Join school_attendance On s.sponsored_student_id = school_attendance.sponsored_student_sponsored_student_id Left Join grade_year g On g.school_attendance_school_attendance_id = school_attendance.school_attendance_id Left Join schools On schools.school_id = school_attendance.schools_school_id WHERE ";
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
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
			return "view_sponsored_student_gradelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "view_sponsored_student_gradelist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("view_sponsored_student_gradeview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "view_sponsored_student_gradeadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("view_sponsored_student_gradeedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("view_sponsored_student_gradeadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("view_sponsored_student_gradedelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=view_sponsored_student_grade" : "";
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
		$this->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$this->school_attendance_id->setDbValue($rs->fields('school_attendance_id'));
		$this->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$this->student_firstname->setDbValue($rs->fields('student_firstname'));
		$this->student_lastname->setDbValue($rs->fields('student_lastname'));
		$this->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$this->school_name->setDbValue($rs->fields('school_name'));
		$this->grade_year_id->setDbValue($rs->fields('grade_year_id'));
		$this->promoted->setDbValue($rs->fields('promoted'));
		$this->year->setDbValue($rs->fields('year'));
		$this->class->setDbValue($rs->fields('class'));
		$this->programme->setDbValue($rs->fields('programme'));
		$this->english->setDbValue($rs->fields('english'));
		$this->math->setDbValue($rs->fields('math'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// student_resident_programarea_id

		$this->student_resident_programarea_id->CellCssStyle = ""; $this->student_resident_programarea_id->CellCssClass = "";
		$this->student_resident_programarea_id->CellAttrs = array(); $this->student_resident_programarea_id->ViewAttrs = array(); $this->student_resident_programarea_id->EditAttrs = array();

		// sponsored_student_id
		$this->sponsored_student_id->CellCssStyle = ""; $this->sponsored_student_id->CellCssClass = "";
		$this->sponsored_student_id->CellAttrs = array(); $this->sponsored_student_id->ViewAttrs = array(); $this->sponsored_student_id->EditAttrs = array();

		// student_firstname
		$this->student_firstname->CellCssStyle = ""; $this->student_firstname->CellCssClass = "";
		$this->student_firstname->CellAttrs = array(); $this->student_firstname->ViewAttrs = array(); $this->student_firstname->EditAttrs = array();

		// student_lastname
		$this->student_lastname->CellCssStyle = ""; $this->student_lastname->CellCssClass = "";
		$this->student_lastname->CellAttrs = array(); $this->student_lastname->ViewAttrs = array(); $this->student_lastname->EditAttrs = array();

		// school_name
		$this->school_name->CellCssStyle = ""; $this->school_name->CellCssClass = "";
		$this->school_name->CellAttrs = array(); $this->school_name->ViewAttrs = array(); $this->school_name->EditAttrs = array();

		// year
		$this->year->CellCssStyle = ""; $this->year->CellCssClass = "";
		$this->year->CellAttrs = array(); $this->year->ViewAttrs = array(); $this->year->EditAttrs = array();

		// class
		$this->class->CellCssStyle = ""; $this->class->CellCssClass = "";
		$this->class->CellAttrs = array(); $this->class->ViewAttrs = array(); $this->class->EditAttrs = array();

		// programme
		$this->programme->CellCssStyle = ""; $this->programme->CellCssClass = "";
		$this->programme->CellAttrs = array(); $this->programme->ViewAttrs = array(); $this->programme->EditAttrs = array();

		// english
		$this->english->CellCssStyle = ""; $this->english->CellCssClass = "";
		$this->english->CellAttrs = array(); $this->english->ViewAttrs = array(); $this->english->EditAttrs = array();

		// math
		$this->math->CellCssStyle = ""; $this->math->CellCssClass = "";
		$this->math->CellAttrs = array(); $this->math->ViewAttrs = array(); $this->math->EditAttrs = array();

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
		$this->sponsored_student_id->ViewValue = $this->sponsored_student_id->CurrentValue;
		$this->sponsored_student_id->CssStyle = "";
		$this->sponsored_student_id->CssClass = "";
		$this->sponsored_student_id->ViewCustomAttributes = "";

		// student_firstname
		$this->student_firstname->ViewValue = $this->student_firstname->CurrentValue;
		$this->student_firstname->CssStyle = "";
		$this->student_firstname->CssClass = "";
		$this->student_firstname->ViewCustomAttributes = "";

		// student_lastname
		$this->student_lastname->ViewValue = $this->student_lastname->CurrentValue;
		$this->student_lastname->CssStyle = "";
		$this->student_lastname->CssClass = "";
		$this->student_lastname->ViewCustomAttributes = "";

		// school_name
		$this->school_name->ViewValue = $this->school_name->CurrentValue;
		$this->school_name->CssStyle = "";
		$this->school_name->CssClass = "";
		$this->school_name->ViewCustomAttributes = "";

		// year
		$this->year->ViewValue = $this->year->CurrentValue;
		$this->year->CssStyle = "";
		$this->year->CssClass = "";
		$this->year->ViewCustomAttributes = "";

		// class
		$this->class->ViewValue = $this->class->CurrentValue;
		$this->class->CssStyle = "";
		$this->class->CssClass = "";
		$this->class->ViewCustomAttributes = "";

		// programme
		if (strval($this->programme->CurrentValue) <> "") {
			switch ($this->programme->CurrentValue) {
				case "BA":
					$this->programme->ViewValue = "Business";
					break;
				case "ART":
					$this->programme->ViewValue = "Arts";
					break;
				case "SCI":
					$this->programme->ViewValue = "Science";
					break;
				default:
					$this->programme->ViewValue = $this->programme->CurrentValue;
			}
		} else {
			$this->programme->ViewValue = NULL;
		}
		$this->programme->CssStyle = "";
		$this->programme->CssClass = "";
		$this->programme->ViewCustomAttributes = "";

		// english
		$this->english->ViewValue = $this->english->CurrentValue;
		$this->english->CssStyle = "";
		$this->english->CssClass = "";
		$this->english->ViewCustomAttributes = "";

		// math
		$this->math->ViewValue = $this->math->CurrentValue;
		$this->math->CssStyle = "";
		$this->math->CssClass = "";
		$this->math->ViewCustomAttributes = "";

		// student_resident_programarea_id
		$this->student_resident_programarea_id->HrefValue = "";
		$this->student_resident_programarea_id->TooltipValue = "";

		// sponsored_student_id
		$this->sponsored_student_id->HrefValue = "";
		$this->sponsored_student_id->TooltipValue = "";

		// student_firstname
		$this->student_firstname->HrefValue = "";
		$this->student_firstname->TooltipValue = "";

		// student_lastname
		$this->student_lastname->HrefValue = "";
		$this->student_lastname->TooltipValue = "";

		// school_name
		$this->school_name->HrefValue = "";
		$this->school_name->TooltipValue = "";

		// year
		$this->year->HrefValue = "";
		$this->year->TooltipValue = "";

		// class
		$this->class->HrefValue = "";
		$this->class->TooltipValue = "";

		// programme
		$this->programme->HrefValue = "";
		$this->programme->TooltipValue = "";

		// english
		$this->english->HrefValue = "";
		$this->english->TooltipValue = "";

		// math
		$this->math->HrefValue = "";
		$this->math->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
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
                global $grade_year;
                $filter="isnull(g.`year`) or g.`year`=$grade_year";
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
     global $programarea_id;
        if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){    //user can select the programarea
                    if(!isset($_REQUEST['programarea_id'])){
                        $programarea_id=0;                       //if user has not selected
                    }else{
                        $programarea_id=$_REQUEST['programarea_id'];              //user has selcted
                    }

                }else{
                   $programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];           //user cannot select a programarea
                }
                $filter="s.student_resident_programarea_id=$programarea_id";
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

		return TRUE;
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
