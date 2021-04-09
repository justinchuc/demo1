$(function () {
    $("#createtask_failure").hide();
    $("#createtask_success").hide();
   
  });

  function createTask() {

    var name = document.getElementById("createtname").value;
    var desc = document.getElementById("createtdesc").value;
    var min = document.getElementById("createminprice").value;
    var max = document.getElementById("createmaxprice").value;
    var location = document.getElementById("createtlocation").value;
  
    if (confirm("Are you sure you want to save?")) {
      $.ajax({
        method: "POST",
        url: "../../model/tasks.php",
        data: {
          "action": "newpat",
          "name": name,
          "desc": desc,
          "min": min,
          "max": max,
          "location": location
  
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