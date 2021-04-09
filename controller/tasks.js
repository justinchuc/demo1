$(function () {
    $("#createtask_failure").hide();
    $("#createtask_success").hide();
   
  });

  function createT() {

    var name = document.getElementById("createtname").value;
    var desc = document.getElementById("createtdesc").value;
    var type = document.getElementById("createttype").value;
    var begin = document.getElementById("createdatebegin").value;
    var end = document.getElementById("createdateend").value;
    var min = document.getElementById("createminprice").value;
    var max = document.getElementById("createmaxprice").value;
    var location = document.getElementById("createtlocation").value;
    var eID = document.getElementById("eID").value;
    
   // alert(name + desc + type + begin + end +  min + max + location + eID);
    if (confirm("Are you sure you want to save?")) {
      $.ajax({
        method: "POST",
        url: "../../model/tasks.php",
        data: {
          "action": "newtask",
          "name": name,
          "desc": desc,
          "type": type,
          "begin": begin,
          "end": end,
          "min": min,
          "max": max,
          "location": location,
          "eID": eID
  
        },
      }).done(function (data) {
        var results = JSON.parse(data);
        if (results.state = "success") {
          $("#createtask_success").html("<strong>Success</strong>  " + results.message);
          $("#createtask_success").show();
          setTimeout(function () {
            location.reload();
          }, 4000);
        } else {
          $("#createtask_failure").html("<strong>Failure</strong>  " + results.message);
          $("#createtask_failure").show();
          setTimeout(function () {
            location.reload();
          }, 4000);
        }
      });
    }
  }