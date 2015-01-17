var page = "ext/ajaxawardgrant.php";
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
    } catch (ex) {
        return { "result": 0, "message": ex };
    }
}

function submitPaymentRequest(obj,preq_id){
    if(!confirm("Are sure you want to submit this request")){
        return;
    }
    var u=page+"?cmd=6&payment_request_id="+preq_id;
    
    var r=sendGETRequest(u);
    if(r.result==0){
        alert(r.message);
        return 0;
    }

    obj.innerHTML="submitted";
    obj.onclick="";
    obj.style.textDecoration="";
    obj.style.color="black";
    obj.style.cursor="";

    return true;

    
}