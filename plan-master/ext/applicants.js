/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var districts;

function fatherAlive(){
    if(document.getElementById("rFatherYes").checked){
        return 1;
    }else if(document.getElementById("rFatherNo").checked){
        return 0;
    }else{
        return -1;
    } 
}

function motherAlive(){
    if(document.getElementById("rMotherYes").checked){
        return 1;
    }else if(document.getElementById("rMotherNo").checked){
        return 0;
    }else{
        return -1;
    } 
}

function getGender(){
    if(document.getElementById("rGenderMale").checked){
        return "M";
    }else if(document.getElementById("rGenderFemale").checked){
        return "F";
    }else{
        return -1;
    }
}

function validate(){
    
    var valid=true;
    var e;
    e=validateNames("txtLastname");
    valid=valid && e;
    e=validateNames("txtFirstname");
    valid=valid && e;
    e=validateNames("txtMothername");
    valid=valid && e;
    e=validateNames("txtFathername");
    valid=valid && e;
    e=validatePhones("txtTelephone1");
    valid=valid && e;
    e=validateAgregate();
    valid=valid && e;
    e=validateSelect("selectCommunity",0);
    valid=valid && e;
    e=validateSelect("selectJSS",0);
    valid=valid && e;
    e=vaidateAddress();
    valid=valid && e;
    e=validateOccupation();
    valid=valid && e;
    e=avalidateGender();
    valid=valid && e;
    e=validateBirthDate();
    valid=valid && e;
    return valid;
    
}

function validateBirthDate(){
    var birthdate=document.getElementById("birthdate").value;
    if(!validateDate(birthdate)){
        document.getElementById("birthdate").style.backgroundColor="#FF0000";
        return false;
    }else{
        document.getElementById("birthdate").style.backgroundColor="#FFFFFF";
        return true;
    }
    
}

function validateOccupation(){
    var fAlive=fatherAlive();//$("input[name=rFather]:radio").val();
    var fatherOccupation=document.getElementById("selectFatherOccupation").selectedIndex;
    var valid=true;
    if(fAlive<0){
        valid=false;
    }
    if(fAlive==1 && fatherOccupation==0){
       $("#selectFatherOccupation").css("background-color","#FF0000");
       valid=false;
    }else if(fAlive==0 && fatherOccupation>0){
       $("#selectMotherOccupation").css("background-color","#FF0000");
       alert("Father is not alive but occupation is selected");
       valid=false;
    }else{
       $("#selectFatherOccupation").css("background-color","#FFFFFF");
    }
    
    var mAlive=motherAlive();//$("input[name=rMother]:radio").val();
    if(mAlive<0){
        valid=false;
    }
    var motherOccupation=document.getElementById("selectMotherOccupation").selectedIndex;
    if(mAlive==1 && motherOccupation==0){
       $("#selectMotherOccupation").css("background-color","#FF0000");
       valid=false;
    }else if(mAlive==0 && motherOccupation>0){
       $("#selectMotherOccupation").css("background-color","#FF0000");
       alert("Mother is not alive but occupation is selected");
       valid=false;
    }else{
       $("#selectMotherOccupation").css("background-color","#FFFFFF");
    }
    var guardianOccupation=document.getElementById("selectGuardianOccupation").selectedIndex;
    var g=isNotEmpty($("#txtGuardianName").val());
    if(g==false && guardianOccupation>0){
       $("#txtGuardianName").css("background-color","#FF0000");
       alert("Guridan name is not given but occupation is selected.");
       valid=false;
    }else if(g==true && guardianOccupation==0){
       $("#selectGuardianOccupation").css("background-color","#FF0000");
       valid=false;
    }else{
       $("#selectGuardianOccupation").css("background-color","#FFFFFF"); 
    }
    return valid;    
}

function validateNames(id){
    id="#"+id;
     var v=$(id).val();
     if(!validateName(v)){
         $(id).css("background-color","#FF0000");
         return false;
     }else{
         $(id).css("background-color","#FFFFFF");
         return true;
     }
}

function validatePhones(id){
    id="#"+id;
     var v=$(id).val();
     if(!validatePhone(v)){
         $(id).css("background-color","#FF0000");
         return false;
     }else{
         $(id).css("background-color","#FFFFFF");
         return true;
     }
}

function validateAgregate(){
    id="#txtGrade";
    var rgNum=new RegExp("[0-9]");
    var rgNotNum=new RegExp("[^0-9]");
    var v=$(id).val();
     if(!rgNum.test(v) || rgNotNum.test(v)){
         $(id).css("background-color","#FF0000");
         return false;
     }else{
         $(id).css("background-color","#FFFFFF");
         return true;
     }
}

function vaidateAddress(){
    var id="#taAddress";
    var v=$(id).val();
    if(isNotEmpty(v)){
        $(id).css("background-color","#FFFFFF");
        return true;
    }else{
        $(id).css("background-color","#FF0000");
        return false; 
    }
}

function isNotEmpty(str){
    var re=new RegExp("[A-Z][a-z]");
    return re.test(str);
}

function validateSelect(id,defaultValue){
    id="#"+id;
    var v=$(id).val();
    if(v==defaultValue){
        $(id).css("background-color","#FF0000");
        return false;
    }else{
        $(id).css("background-color","#FFFFFF");
        return true;
    } 
}

function avalidateGender(){
    if(getGender()<0){
        document.getElementById("rGenderMale").style.backgroundColor="#FF0000";
        document.getElementById("rGenderFemale").style.backgroundColor="#FF0000";
        return false;
    }else{
        document.getElementById("rGenderMale").style.backgroundColor="#FFFFFF";
        document.getElementById("rGenderFemale").style.backgroundColor="#FFFFFF";
        return true;
    }
}

function getFormData(){
   
    var communityId=$("#selectCommunity").val();
    
    var fn=$("#txtFirstname").val();
    var ln=$("#txtLastname").val();
    var mn=$("#txtMiddlename").val();
    mn=isNotEmpty(mn)?mn:0;
    var gender=getGender();
    var birthdate=document.getElementById("birthdate").value;
  
    var fatherName=$("#txtFathername").val();
    var fatherOccupation=$("#selectFatherOccupation").val();
    var fatherAlive=$("input[name=rFather]:radio").val();
    
    var motherName=$("#txtMothername").val();
    var motherAlive=$("input[name=rMother]:radio").val();
    var motherOccupation=$("#selectMotherOccupation").val();
    
    var guardianName=$("#txtGuardianName").val();
    guardianName=isNotEmpty(guardianName)?guardianName:"NA";
    var guardianRelation=$("#selectGuardianRelation").val();
    var guardianOccupation=$("#selectGuardianOccupation").val();
    
    var telephone1=$("#txtTelephone1").val();
    var telephone2=$("#txtTelephone2").val();
    var address=$("#taAddress").val();
    
    var jss=$("#selectJSS").val();   
    var grade=$("#txtGrade").val();
    
    var ref=$("#txtRefereeName").val();
    ref=isNotEmpty(ref)?ref:"NA";
    var school=$("#selectSchool").val();
    var sponsoredChild=$("#txtSponsored").val();
    sponsoredChild=isNotEmpty(sponsoredChild)?sponsoredChild:"NA";
    
    var prudentialStaff=isPrudential();
    var prudentialStaffRelation=$("#selectPrudentialStaffRelation").val();
    
    var data="fn="+fn
            +"&ln="+ln
            +"&mn="+mn
            +"&gender="+gender
            +"&bd="+birthdate
            +"&cid="+communityId
            +"&pmn="+motherName
            +"&pma="+motherAlive
            +"&pmoid="+motherOccupation
            +"&pfn="+fatherName
            +"&pfa="+fatherAlive
            +"&pfoid="+fatherOccupation
            +"&pgn="+guardianName
            +"&pga="+guardianRelation
            +"&pgoid="+guardianOccupation
            +"&ad="+address
            +"&t1="+telephone1
            +"&t2="+telephone2
            +"&jss_id="+jss
            +"&gd="+grade
            +"&rf="+ref
            +"&sid="+school
            +"&sno="+sponsoredChild
            +"&pb="+prudentialStaff
            +"&pbr="+prudentialStaffRelation;
        
        return data;
}

function addToTable(){
    
}

function districtChanged(){
    getCommunity();
}

function getCommunity(){
    var objDistrict=document.getElementById("selectFilterDistrict");
    if(objDistrict==null){
        return;
    }


    var theUrl="ext/ajax.php?cmd=2&district_id="+objDistrict.value;
    var obj=synchAjax(theUrl);
    if(obj.result==0){
        return;
    }
    obj.communites.sort();
    var objCommunity=document.getElementById("selectCommunity");
    if(objCommunity==null){
        return;
    }
    clearSelect(objCommunity);
    var objNewOption;
    for(i=0;i<obj.communites.length;i++){
        objNewOption=document.createElement("OPTION");
        objNewOption.value=obj.communites[i].communityID;
        objNewOption.text=obj.communites[i].community;
        objCommunity.options.add(objNewOption);

    }

}

function onProgramAreaChanged(){
   var obj=document.getElementById("programarea_id");
   var pid=0;
    if(obj.value!=0 && obj.value!=""){
        pid=obj.value;
    }
   
   
   getDistrict(pid);
}

function getDistrict(pid){
   
    var objDistrict=document.getElementById("selectFilterDistrict");
    if(objDistrict==null){
        return;
    }
    clearSelect(objDistrict);
    var objNewOption;
    for(i=0;i<districts.length;i++){
        if(pid!=0){
            if(districts[i].programarea_id==pid){
                objNewOption=document.createElement("OPTION");
                objNewOption.value=districts[i].districtID;
                objNewOption.text=districts[i].district;
                objDistrict.options.add(objNewOption);
            }
        }else{
            objNewOption=document.createElement("OPTION");
            objNewOption.value=districts[i].districtID;
            objNewOption.text=districts[i].district;
            objDistrict.options.add(objNewOption);
        }


    }

}

function clearSelect(obj){
    while(obj.options.length>0){
        obj.options.remove(0);
    }
    var objNewOption=document.createElement("OPTION");
    objNewOption.value="0";
    objNewOption.text="--select--";
    obj.options.add(objNewOption);
}

function onProgramareaChange(){
   var objDistrict=document.getElementById("selectFilterDistrict");
   getDistrict(objDistrict);
}

function prudentialStaffChecked(){
    if(document.getElementById("cbPrudentialStaff").checked){
        document.getElementById("selectPrudentialStaffRelation").disabled=false;
    }else{
        document.getElementById("selectPrudentialStaffRelation").disabled=true;
        document.getElementById("selectPrudentialStaffRelation").value="NA";
    }
}

function isPrudential(){
    if(document.getElementById("cbPrudentialStaff").checked){
        return 1;
    }else{
        return 0;
    }
}

function completeAddingSSSchool(){
    var objSelect=document.getElementById("x_student_admitted_school_id");
    var objSchoolName=document.getElementById("txtSSSchoolName");
    var objSchoolProgramArea=document.getElementById("selectSSSProgramArea");

    if( objSchoolProgramArea==null || objSchoolName==null ){
        return;
    }
            var objSchoolAddress=document.getElementById("txtSSSAddress");

            var objSchoolTown=document.getElementById("txtSSSTown");



    var u=page+"?cmd=3&school_name="+objSchoolName.value+"&school_address="+objSchoolAddress.value+
            "&school_town="+objSchoolTown.value+
            "&school_programarea_id="+objSchoolProgramArea.value;

    var ru=sendGETRequest(u);

    if(ru.result==0){
        spanStatus.innerText="error:" + ru.message;
        return 0;
    }

    var o=document.createElement("OPTION");
    o.value=ru.school_id;
    o.text=objSchoolName.value;
    objSelect.add(o);
    objSelect.value=ru.school_id;
    objSelect.focus();
    hideAddSSSchool();
}

function clear(){
    $("#txtFirstname").val("");
    $("#txtLastname").val("");
    $("#txtMiddlename").val("");
   
    document.getElementById("birthdate").value="";
    document.getElementById("rGenderMale").checked=false;
    document.getElementById("rGenderFemale").checked=false;
    
    $("#txtFathername").val("");
    $("#selectFatherOccupation").val("0");
    document.getElementById("rFatherYes").checked=false;
    document.getElementById("rFatherNo").checked=false;
    
    $("#txtMothername").val("");
    $("#selectMotherOccupation").val("0");
    document.getElementById("rMotherYes").checked=false;
    document.getElementById("rMotherNo").checked=false;
    
    $("#txtGuardianName").val("");
    $("#selectGuardianRelation").val("NA");
    
    $("#txtTelephone1").val("");
    $("#txtTelephone2").val("");
    $("#taAddress").val("");
    
    $("#selectJSS").val("");   
    $("#txtGrade").val("");
    
    $("#txtRefereeName").val("");
    $("#selectSchool").val("0");
    $("#txtSponsored").val("");
    
    prudentialStaff=$("#cbPrudentialStaff").prop("checked",false);
    $("#selectPrudentialStaffRelation").val("NA");
    $("#selectCommunity").val("0");
}

var sortParam=0;
function getApplicants(){
    var pid=$("#programarea_id").prop("value");
    var year=$("#app_year").prop("value");
    var search=$("#txtSearch").val();
    var st=$("#selectApplicantStatus").val();
   
    if(search.length<=0){
        search=0;
    }
    u="ext/ajaxapplicants.php?cmd=2&programarea_id="+pid+"&year="+year+"&search_text="+search+"&st="+st+"&od="+sortParam+"&page="+page;
    
    objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    recCount=objResult.count;
    applicants=objResult.applicants;
    showApplicants();
    searchType=0;
}

function exportApplicants(){
    var pid=$("#programarea_id").prop("value");
    var year=$("#app_year").prop("value");
    var search=$("#txtSearch").val();
    var st=$("#selectApplicantStatus").val();
   
    if(search.length<=0){
        search=0;
    }
    var u="ext/exportapplicants.php?cmd=2&programarea_id="+pid+"&year="+year+"&search_text="+search+"&st="+st+"&od="+sortParam+"&page="+page;
    document.location=u; 
}

function showApplicants(){
    clearTable(tableApplicnats,1);
    if(applicants==null){
        return;
    }
    for(i=0;i<applicants.length;i++){

       var r=tableApplicnats.insertRow(-1);
       if(i%2==0){
           r.className="default_report_line1";
       }else{
           r.className="default_report_line2";
       }
       var c=r.insertCell(0);
       c.innerHTML="<input type='checkbox' id='"+applicants[i].student_applicant_id+"' name='"+applicants[i].student_applicant_id+"' value='"+applicants[i].student_applicant_id+"'>";
       var c=r.insertCell(1);
       c.innerHTML=applicants[i].programarea_name;
       c=r.insertCell(2);
       c.innerHTML=applicants[i].app_submission_year;
       c=r.insertCell(3)
       c.innerHTML=applicants[i].community;
       c=r.insertCell(4);
       c.innerHTML="<b>" +applicants[i].student_lastname +"</b>, " +applicants[i].student_firstname;
       c=r.insertCell(5);
       if(validateGender(applicants[i].student_gender)){
            c.innerHTML=objResult.applicants[i].student_gender;
       }else{
           c.innerHTML="<span class='default_error'>invalid</span>";
       }
       c=r.insertCell(6);
       c.innerHTML=formatDateFromMysql(applicants[i].student_dob);
       c=r.insertCell(7);
       c.innerHTML=applicants[i].student_telephone_1 +", " +applicants[i].student_telephone_2;
       c=r.insertCell(8);
       c.innerHTML=applicants[i].school_name;
       c=r.insertCell(9);
       c.innerHTML=statusName(applicants[i].app_status);
       c=r.insertCell(10);
       c.innerHTML=applicants[i].app_points;
       c=r.insertCell(11);
       c.innerHTML=applicants[i].grant_name;
       c=r.insertCell(12);
       str='<span class="hotspot" onclick="openRecord(this,'+i+','+applicants[i].student_applicant_id+')">detail</span>';
       
       c.innerHTML=str;  
       
    }  
    showStatus(""+ recCount+ " records found");
  
}

function statusName(n){
    if(n==0){
        return "New App";
    }else if(n==1){
        return "Awarded";
    }else if(n==2){
        return "Confirmed";
    }else{
        return "Unknown";
    }

}

function setSort(n){
    if(n==0){
        sortParam=0;
    }else if(n==1){  //application point
        if(sortParam==1){   //flip it
            sortParam=2;
        }else{
            sortParam=1;
        }
    }
    
    getApplicants();
}

function awardGrant(){
    gid=$("#grant").val();
    
    if(gid==0){
        showStatus("select a fund");
        return;
    }
    var str="ids=";
    var count=0;
    $("[type='checkbox']").each(function(i){
        if($(this).prop('checked')){
            str=str+$(this).val() + ",";
            count++;
        }
    });
    if(count>0){
        str=str.substr(0,str.length-1);
        var u="ext/ajaxapplicants.php?cmd=6&gid="+gid+"&"+str;
        var objResult=synchAjax(u);
        if(objResult.result==0){
            showStatus(objResult.message);
            return;
        }
        var successCount=0;
        var failCount=0;
        for(i=0;i<objResult.astatus.length;i++){
            if(objResult.astatus[i].status==1 ){
                var selector="[type='checkbox'][value='"+ objResult.astatus[i].id +"'";
                $(selector).prop("checked",false);
                var obj=$(selector).parent().parent().get(0);   //table cell row
                obj.cells[9].innerHTML=statusName(1);
                var optionIndex=$("#grant").get(0).selectedIndex;
                obj.cells[11].innerHTML=$("#grant").get(0).options[optionIndex].text;
                successCount++;
           
            }else{
               failCount++;
            }
        }
           
        var message="out of the elected records "+successCount + " are awarded";
        if(failCount>0){
            message=message+", but "+ failCount+ " could not be awarded.";
            showError(message);
        }else{
            showStatus(message);
        }
    }else{
        showError("select applicants to award");
    }
    
}

function cancelGrant(){
    
    var str="ids=";
    var count=0;
    $("[type='checkbox']").each(function(i){
        if($(this).prop('checked')){
            str=str+$(this).val() + ",";
            count++;
        }
    });
    if(count>0){
        str=str.substr(0,str.length-1);
        var u="ext/ajaxapplicants.php?cmd=7&"+str;
        var objResult=synchAjax(u);
        if(objResult.result==0){
            showStatus(objResult.message);
            return;
        }
        var successCount=0;
        var failCount=0;
        for(i=0;i<objResult.astatus.length;i++){
            if(objResult.astatus[i].status==1 ){
                var selector="[type='checkbox'][value='"+ objResult.astatus[i].id +"'";
                $(selector).prop("checked",false);
                var obj=$(selector).parent().parent().get(0);   //table cell row
                obj.cells[9].innerHTML=statusName(0);
                obj.cells[11].innerHTML="NO AWARD";
                successCount++;
           
            }else{
               failCount++;
            }
        }
           
        var message="out of the selected records "+successCount + " are cancelled";
        if(failCount>0){
            message=message+", but "+ failCount+ " could not be canceled.";
            showError(message);
        }else{
            showStatus(message);
        }
    }else{
        showError("select applicants to cancel");
    } 
}

function updateRow(){
    if(applicants==null){
        return;
    }
    
    if(currentTableRow==null){
        return;
    }
    index=currentIndex;
    currentTableRow.cells[1].innerHTML=applicants[index].programarea_name;
    currentTableRow.cells[2].innerHTML=applicants[index].app_submission_year;
    currentTableRow.cells[3].innerHTML=applicants[index].community;
    currentTableRow.cells[4].innerHTML="<b>" +applicants[index].student_lastname +"</b>, " +applicants[index].student_firstname;
    if(validateGender(applicants[index].student_gender)){
        currentTableRow.cells[5].innerHTML=objResult.applicants[index].student_gender;
    }else{
        currentTableRow.cells[5].innerHTML="<span class='default_error'>invalid</span>";
    }

    currentTableRow.cells[6].innerHTML=formatDateFromMysql(applicants[index].student_dob);
    currentTableRow.cells[7].innerHTML=applicants[index].student_telephone_1 +", " +applicants[index].student_telephone_2;
    currentTableRow.cells[8].innerHTML=applicants[index].school_name;
    currentTableRow.cells[9].innerHTML=statusName(applicants[index].app_status);
    currentTableRow.cells[10].innerHTML=applicants[index].app_points;
    currentTableRow.cells[11].innerHTML=applicants[index].grant_name;
    currentTableRow.cells[12].innerHTML='<span class="hotspot" onclick="openRecord(this,'+i+','+applicants[index].student_applicant_id+')">detail</span>';
}

var theFormIsLoaded=false;
function loadRecordForUpdate(){

    if(applicants==null){
        cancel();   //close the display window
        return;
    }

    if(currentStudentId==0){
        cancel();   //close the display window
        return;
    }
    var index=currentIndex;
    
    showStatus("viewing record...");
    
    $("#txtLastname").prop("value",applicants[index].student_lastname);
    $("#txtFirstname").prop("value",applicants[index].student_firstname);
    $("#txtMiddlename").prop("value",applicants[index].student_middlename);
    if(applicants[index].student_gender=="M"){
        $("#rGenderMale").prop("checked",true);
    }else{
         $("#rGenderFemale").prop("checked",true);
    }
    
    $("#birthdate" ).datepicker("setDate", getDateFromMysql(applicants[index].student_dob));
    $("#txtMothername").prop("value",applicants[index].app_mother_name);
    $("#selectMotherOccupation").prop("value",applicants[index].app_mother_occupation);
    if(applicants[index].app_mother_isalive==1){
        $("#rMotherYes").prop("checked",true);
         $("#rMotherNo").prop("checked",false);
    }else{
        $("#rMotherNo").prop("checked",true);
         $("#rMotherYes").prop("checked",false);
    }
    
    $("#txtFathername").prop("value",applicants[index].app_father_name);
    $("#selectFatherOccupation").prop("value",applicants[index].app_father_occupation);
    if(applicants[index].app_father_isalive==1){
        $("#rFatherYes").prop("checked",true);
        $("#rFatherNo").prop("checked",false);
    }else{
        $("#rFatherNo").prop("checked",true);
        $("#rFatherYes").prop("checked",false);
    }
    $("txtGuardianName").prop("value",applicants[index].app_guardian_name);
    $("selectGuardianRelation").prop("value",applicants[index].app_guardian_relation);
    $("selectGuardianOccupation").prop("value",applicants[index].app_guardian_occupation);
    $("#taAddress").prop("value",applicants[index].student_address);
    $("#txtTelephone1").prop("value",applicants[index].student_telephone_1);
    $("#txtTelephone2").prop("value",applicants[index].student_telephone_2);
    
    $("#uprogramarea_id").prop("value",applicants[index].programarea_id);
    getDistrict(applicants[index].programarea_id);
    $("#selectFilterDistrict").prop("value",applicants[index].DistrictID);
    getCommunity(applicants[index].DistrictID);
    $("#selectCommunity").prop("value",applicants[index].community_community_id);
    $("#txtGrade").prop("value",applicants[index].student_grades);
    $("#txtRefereeName").prop("value",applicants[index].app_referees);
    $("#txtSponsored").prop("value",applicants[index].sponsored_child_no);
    $("#selectJSS").prop("value",applicants[index].app_junior_secondary_id);
    $("#selectSchool").prop("value",applicants[index].student_admitted_school_id);
    
    if(applicants[index].prudential_relation=="none"){
        $("#cbPrudentialStaff").prop("checked",false);
        $("#selectPrudentialStaffRelation").prop("value","NA");
        $("#selectPrudentialStaffRelation").prop("disabled",true);
    }else{
        $("#cbPrudentialStaff").prop("checked",true);
        $("#selectPrudentialStaffRelation").prop("value",applicants[index].prudential_relation);
        $("#selectPrudentialStaffRelation").prop("disabled",false);
    }
    
    theFormIsLoaded=true;
    $( "#formApplicant :input" ).prop("disabled",true);
    

}

function editApplicant(){
     if(applicants[currentIndex].app_status>0){
        var s=statusName(applicants[currentIndex].app_status);
        showError("You cannot edit an applicaiton with "+s+" status.");
        return;
    }
    showStatus("viewing record...");  
    
    if(!theFormIsLoaded){   //the form is open and ready for editing
        return;
    }
    //enable all elements except prduetnail bank realtion
    $( "#formApplicant :input" ).prop("disabled",false); 
    if($("#cbPrudentialStaff").prop("checked")==false){
        $("#selectPrudentialStaffRelation").prop("value","NA");
        $("#selectPrudentialStaffRelation").prop("disabled",true);
    }
    
}

function saveNewApplicant(){
    showStatus("adding applicant...");
    if(!validate()){
        showError("please check all required fields");
        return false;
    };
    var data=getFormData();
    var pid=$("#programarea_id").val();
    data+="&programarea_id="+pid;
    var u="ext/ajaxapplicants.php?cmd=1";
    var objResult=sendPOSTRequest(u,data);
    if(objResult.result==0){
        showError(objResult.message);
    }else{
        showStatus(objResult.message);
    }
    clear();
    
}

function saveUpdate(){
    showStatus("updating applicant...");
    if(!validate()){
        showError("please check all required fields");
        return false;
    };
    
    var data=getFormData();
    var pid=$("#uprogramarea_id").val();
    data+="&programarea_id="+pid+"&id="+currentStudentId;
    var u="ext/ajaxapplicants.php?cmd=3";
    
    var objResult=sendPOSTRequest(u,data);
    
    if(objResult.result==0){
        showError(objResult.message);
    }else{
        showStatus(objResult.message);
        $( "#formApplicant :input" ).prop("disabled",true);
        applicants[currentIndex]=objResult.applicant;
        updateRow();
    }
    
    
}

function checkSponsoredChild(){
    var v=$("#txtSponsored").val();
    var u="ext/ajaxapplicants.php?cmd=4&sno="+v;
    objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        $("#spanValidateSpnsoredChildResult").html(objResult.message);
        $("#spanValidateSpnsoredChildResult").prop("className","default_error");
        return;
    }
    $("#txtSponsored").val();
    $("#spanValidateSpnsoredChildResult").html("Confimred! Fullname: "+objResult.fullname +" Birth Date: "+objResult.birthdate);
    $("#spanValidateSpnsoredChildResult").prop("className","defalut_status");
    
}

function deleteApplicant(){
    if(currentStudentId==0){
        
        return;
    }
    var index=currentIndex;
    if(applicants[index].app_status>0){
        var statusName=statusName(applicants[index].app_status);
        showError("You cannot delete an applicaiton with "+statusName+" status.");
        cancel();      //close the display window
        return;
    }
    var str= applicants[index].student_lastname +", " +applicants[index].student_firstname;
    if(!confirm("Are you sure you want to delete " +str)){
        return false;
    }
    
    u="ext/ajaxapplicants.php?cmd=5&id="+currentStudentId;
     objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    
    showStatus(str + " deleted.");
    cancel(); 
    getApplicants();
    
    
}

function refereshApplicationPoint(){
    
    var str="ids=";
    var count=0;
    $("[type='checkbox']").each(function(i){
        if($(this).prop('checked')){
            str=str+$(this).val() + ",";
            count++;
        }
    });
    if(count>0){
        str=str.substr(0,str.length-1);
        var u="ext/ajaxapplicants.php?cmd=8&"+str;
        var objResult=synchAjax(u);
        if(objResult.result==0){
            showStatus(objResult.message);
            return;
        }
        var successCount=0;
        var failCount=0;
        for(i=0;i<objResult.astatus.length;i++){
            if(objResult.astatus[i].status>0 ){
                var selector="[type='checkbox'][value='"+ objResult.astatus[i].id +"'";
                $(selector).prop("checked",false);
                var obj=$(selector).parent().parent().get(0);   //table cell row
                obj.cells[10].innerHTML=objResult.astatus[i].status;
                successCount++;
           
            }else{
               failCount++;
            }
        }
           
        var message="out of selected records "+successCount + " are refreshed";
        if(failCount>0){
            message=message+", but "+ failCount+ " could not be refershed.";
            showError(message);
        }else{
            showStatus(message);
        }
    }else{
        showError("select applicants to refersh");
    } 
}

function loadDataForConfirmation(){
    selectConfirmSchool(applicants[currentIndex].student_admitted_school_id);
    
}

function selectConfirmSchool(nschool_id){
    var obj=document.getElementById("confirm_admitted_school_id").value=nschool_id;
}

function confirmScholarship(){

    if(currentStudentId==0){
            return;
    }

    if(applicants[currentIndex].app_status!=1){
        showError("The applicants status is not awarded.");
        return;
    }
    showStatus("Confirming ....");

    var s=document.getElementById("confirm_admitted_school_id").value;
    var ssd=document.getElementById("school_start_date").value+"-09-01";
    var sed=document.getElementById("school_end_date").value+"-08-31";
    var sd=document.getElementById("scholarship_start_date").value+"-09-01";
    var ed=document.getElementById("scholarship_end_date").value+"-08-31";
    var ec=document.getElementById("entry_class").value;
    var el=document.getElementById("entry_level").value;
    var pm=document.getElementById("program").value;
    var at=document.getElementById("attendance").value;


    if(s==0){
        showError("please select school");
        return 0;
    }

    if(pm==0){
        showError("please select program");
        return;
    }

    if(at==0){
        showError("please select attendance type(boarding/day)");
        return;
    }

    if(el==0){
        showError("please select entry level");
        return;
    }

    if(ec==0){
        showError("please select entry class");
        return;
    }

    var u="ext/ajaxapplicants.php?cmd=9&student_applicant_id="+currentStudentId+"&school_id="+s+"&school_start_date="+ssd+"&school_end_date="+sed+"&scholarship_start_date="
        +sd+"&scholarship_end_date="+ed+"&entry_level="+el+"&entry_class="+ec+"&program="+pm+"&attendance="+at;

    var ru=synchAjax(u);
    if(ru.result==0){
        showError( ru.message);
        return 0;
    }

    
    showStatus("confirmed");
    applicants[currentIndex].app_status=2;
    currentTableRow.cells[9].innerHTML=statusName(applicants[currentIndex].app_status);
    //reset
    document.getElementById("entry_class").value=1;
    document.getElementById("entry_level").value=1;
    document.getElementById("program").value=0;
    document.getElementById("attendance").value=0;


}

function addSchool(stype){

    var obj=document.getElementById("hiddenSchoolType");
    if(obj==null){
        return;
    }
    obj.value=stype;    
    obj=document.getElementById("divAddSchool");
    obj.style.top=event.clientY;
    obj.style.left=event.clientX;
    obj.style.visibility="visible";
    document.getElementById("txtSchoolName").focus();
}
   
function completeAddingJSSSchool(){
    var objSelect=document.getElementById("selectJSS");
    var objSchoolName=document.getElementById("txtSchoolName");
    var objSchoolPoint=document.getElementById("selectSchoolCategory");

    if( objSelect==null || objSchoolName==null ){
        return;
    }

    if(objSchoolName.length<=0 || objSchoolPoint.length<=0){
        return;
    }


    var u="ext/ajaxaddschool.php?cmd=2&school_name="+objSchoolName.value+"&school_category="+objSchoolPoint.value;

    var ru=sendGETRequest(u);

    if(ru.result==0){
        spanStatus.innerText="error:" + ru.message;
        return 0;
    }

    var o=document.createElement("OPTION");
    o.value=ru.school_id;
    o.text=objSchoolName.value;
    objSelect.add(o);
    objSelect.value=ru.school_id;
    objSelect.focus();
    hideAddSchool();
}

function completeAddingSSSchool(){
	var objSelect=document.getElementById("selectSchool");
        var objSchoolName=document.getElementById("txtSSSchoolName");
        var objSchoolProgramArea=document.getElementById("selectSSSProgramArea");

        if( objSchoolProgramArea==null || objSchoolName==null ){
            return;
        }
		var objSchoolAddress=document.getElementById("txtSSSAddress");
		
		var objSchoolTown=document.getElementById("txtSSSTown");
       
        
		
        var u="ext/ajaxaddschool.php?cmd=3&school_name="+objSchoolName.value+"&school_address="+objSchoolAddress.value+
		"&school_town="+objSchoolTown.value+
		"&school_programarea_id="+objSchoolProgramArea.value;
        
        var ru=sendGETRequest(u);

        if(ru.result==0){
            spanStatus.innerText="error:" + ru.message;
            return 0;
        }

        var o=document.createElement("OPTION");
        o.value=ru.school_id;
        o.text=objSchoolName.value;
        objSelect.add(o);
        objSelect.value=ru.school_id;
        objSelect.focus();
        hideAddSSSchool();
}

function addSSSchool(){   
    obj=document.getElementById("divAddSSSchool");
    obj.style.top=event.clientY;
    obj.style.left=event.clientX;
    obj.style.visibility="visible";
    document.getElementById("txtSSSchoolName").focus();
}
    
function hideAddSchool(){
    var obj=document.getElementById("divAddSchool");
    obj.style.visibility="hidden";
    document.getElementById("txtSchoolName").value="";
}

function hideAddSSSchool(){
    var obj=document.getElementById("divAddSSSchool");
    obj.style.visibility="hidden";
    document.getElementById("txtSSSchoolName").value="";
}
    
function completeAddingSchool(){
    var obj=document.getElementById("hiddenSchoolType");
    if(obj==null){
        hideAddSchool();
        return;
    }

    var stype=obj.value;

    if(stype==1){
            completeAddingPrimarySchool();
    } else if(stype==2){
            completeAddingJSSSchool()
    } else{
            spanStatus.innerText="error adding, try again";
            hideAddSchool();
    }


}