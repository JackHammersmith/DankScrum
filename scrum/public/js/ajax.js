

function statusChange2(string) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            getElementById("ajaxText").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "/ticket/status", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('data='+string);
}


function statusChange(myString){
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

    $.ajax({
        url: '/ticket/status',
        type: "post",
        data: {'data':myString},
        success: function(data){
            //alert(data);
            $("#ajaxText").html(data);
        }
    });



//    $.ajax({url: "/ticket/status?data="+myString, success: function(result){
//        $("#ajaxText").html(result);
//    }});
}

function refreshBoard(projectId){
    //console.log(project);
    $.ajax({
        url: '/scrum/board/'+projectId,
        type: "get",
        success: function(data){
            //alert(data);
            $("#scrumBoard").html(data);
        }
    });
}
