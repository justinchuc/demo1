$(function () {
    $("#createtask_failure").hide();
    $("#createtask_success").hide();

    $('#openTasksTable').DataTable();
    
    $(".typeSelect").select2({
      placeholder: "Type Task Type",
      minimumInputLength: 1,
      dropdownAutoWidth: true,
      width: '100%',
      ajax: {
          url: "../../model/typeList.php",
          dataType: "json",
          type: "GET",
          delay: 250,
          data: function (params) {
              return {
                  q: params.term,
              };
          },
          processResults: function (data) {
              return {
                  results: data
              };

          },
          cache: false
      }

  });
  $(".locationSelect").select2({
    placeholder: "Type Task Location",
    minimumInputLength: 1,
    dropdownAutoWidth: true,
    width: '100%',
    ajax: {
        url: "../../model/locationList.php",
        dataType: "json",
        type: "GET",
        delay: 250,
        data: function (params) {
            return {
                r: params.term,
            };
        },
        processResults: function (data) {
            return {
                results: data
            };

        },
        cache: false
    }

});
   
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

  function apply(taskID,tID) {
    if (confirm("Are you sure you want to Apply for this task?")) {
      $.ajax({
        method: "POST",
        url: "../model/applyTask.php",
        data: {
          "action": "apply",
          "taskID": taskID,
          "tID": tID

        },
      }).done(function (data) {
        var results = JSON.parse(data);
        if (results.state = "success") {
          $("#createtask_success").html("<strong>Success</strong>  " + results.message);
          $("#createtask_success").show();
          setTimeout(function () {
            location.reload();
          }, 2000);
        } else {
          $("#createtask_failure").html("<strong>Failure</strong>  " + results.message);
          $("#createtask_failure").show();
          setTimeout(function () {
            location.reload();
          }, 3000);
        }
      });
    }
  }