/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function formatDateFromMysql(str_mysql_date){
    try{
        var t=new Date(Date.parse(str_mysql_date));
        if(isNaN(t.getFullYear())){
            return "<span class='default_error'>invalid</span>";
        }
        var str="";
        if(t.getDate()<10){
            str="0"+t.getDate();
        }else{
            str=str+t.getDate();
        } 
        
        if(t.getMonth()<9){
            str=str+"/0"+(t.getMonth()+1);
        }else{
            str=str+"/"+(t.getMonth()+1);
        }

        var str=str+"/"+t.getFullYear();
       
        

        return str;
    }catch(e){
        return "<span class='default_error'>invalid</span>";
    }
}

function getDateFromMysql(str_mysql_date){
    try{
        var t=new Date(Date.parse(str_mysql_date));
        if(isNaN(t.getFullYear())){
            return "";
        }
        var str="";
        if(t.getDate()<10){
            str="0"+t.getDate();
        }else{
            str=str+t.getDate();
        } 
        
        if(t.getMonth()<9){
            str=str+"/0"+(t.getMonth()+1);
        }else{
            str=str+"/"+(t.getMonth()+1);
        }

        var str=str+"/"+t.getFullYear();
       
        

        return str;
    }catch(e){
        return "";
    }
}

function getDatabaseDate(str_date){
    try{
        var strs=str_date.split("/");
        var strDate=strs[2]+"-"+strs[1]+"-"+strs[0];
        return strDAte;
    }catch(e){
        return "";
    }
}

function setDateInput(obj,str_mysql_date,defaultDate){
    
    /*if(defaultDate==null){
        defaultDate=new Date();
    }
    try{
        var t=new Date(Date.parse(str_mysql_date));
        if(isNaN(t.getFullYear())){
            t=defaultDate;
        }
    }catch(e){
        t=defaultDate;
        
    }
 
    var str=""+t.getFullYear();
    if(t.getMonth()<9){
        str=str+"-0"+(t.getMonth()+1);
    }else{
        str=str+"-"+(t.getMonth()+1);
    }

    if(t.getDate()<10){
        str=str+"-0"+t.getDate();
    }else{
        str=str+"-"+t.getDate();
    }
    obj.value=str;*/
    try{
        var t=new Date(Date.parse(str_mysql_date));
        
        var str=""+t.getFullYear();
        if(t.getMonth()<9){
            str=str+"-0"+(t.getMonth()+1);
        }else{
            str=str+"-"+(t.getMonth()+1);
        }

        if(t.getDate()<10){
            str=str+"-0"+t.getDate();
        }else{
            str=str+"-"+t.getDate();
        }
        obj.value=str;
    }catch(e){
        
    }
}

 function synchAjax(u){
    try{
        var obj=$.ajax(
                {url:u,
                 async:false
                 }
        );
        return $.parseJSON(obj.responseText);
    }catch(e){
        return {result:0,message:"error while sending request server"};
    }
}

function clearTable(obj,n){
    while(obj.rows.length>n){
        obj.deleteRow(obj.rows.length-1);
    }

}

function removeChar(str,ch){
    var rg=new RegExp(ch);
    while(rg.test(str)){
        str=str.replace(rg,'');
    }
    return str;

}

function validateName(name){
    var rg=new RegExp("[A-Za-z]");
    var rgNum=new RegExp("[0-9]");
    var rgW=/[^a-zA-Z ]/;  //find characters out side of a-Z A-Z and space
    if(!rg.test(name)){
        return false;
    }
    if(rgNum.test(name) || rgW.test(name)){
        return false;
    }
    
    return true;
}

function validateGender(str){
    var r=new RegExp("M|F");
    if(r.test(str)){
        return true;
    }else{
        return false;
    }
    
}

function validateDate(d){
    var ra=new RegExp("[0-9]{4}-[0-9]{2}-[0-9]{2}");
    var rb=new RegExp("[0-9]{2}\/[0-9]{2}\/[0-9]{4}");
    if(ra.test(d) || rb.test(d)){
        return true;
    }else{
        return false;
    }
}

function validatePhone(str){
    var rg=new RegExp("[A-Za-z]");
    var rgPhone=new RegExp("0[0-9]{9}");
    var rgW=new RegExp("\W");
    if(!rgPhone.test(str)){
        return false;
    }
    if(rg.test(str) || rgW.test(str)){
        return false;
    }
    
    return true;
}

function clearSelect(obj,firstOption){
    while(obj.options.length>0){
        obj.options.remove(0);
    }
    if(firstOption){
        var objNewOption=document.createElement("OPTION");
        objNewOption.value="0";
        objNewOption.text="--select--";
        obj.options.add(objNewOption);
    }
}
function showStatus(msg){
    $("#divStatus").html(msg);
    $("#divStatus").prop("className","default_status");
}

function showError(msg){
    $("#divStatus").html(msg);
    $("#divStatus").prop("className","default_error");
}

 function sendGETRequest(theUrl) {

    var request = new XMLHttpRequest();
    try {

        request.open("GET", theUrl, false);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send();

        if (request.status != 200) {
            return { "result": 0, "message": request.statusText };
        }
        //alert(request.responseText);

        return eval('('+request.responseText+ ')');
        //return { "result": 0, "message": "OK" };
    } catch (ex) {
        return { "result": 0, "message": ex };
    }
}
function sendPOSTRequest(theUrl, data) {
    //alert("here");
    request = new XMLHttpRequest();
    try {

        request.open("POST", theUrl, false);
        data = encodeURI(data);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //request.setRequestHeader("Content-length", data.length);
        //request.setRequestHeader("Connection", "close");
        request.send(data);

        if (request.status != 200) {
            return { "result": 0, "error": request.statusText };
        }



        return eval('('+request.responseText+ ')');
    } catch (ex) {
        return { "result": 0, "error": ex };
    }
}


