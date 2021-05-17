$(function () {

    $(".locationSelect").select2({
        placeholder: "Type Task Location",
        minimumInputLength: 1,
        dropdownAutoWidth: true,
        width: '100%',
        ajax: {
            url: "../model/locationList.php",
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
function search(tID) {

    var lID = document.getElementById("locationSelect").value;

    $.ajax({
        method: "POST",
        url: "../model/search.php",
        data: {
            "action": "search",
            "tHandler": tID,
            "location": lID
        },
    }).done(function (data) {

        let results = JSON.parse(data);
        console.log('The data is', results);
        let cardContainer;

        let createTaskCard = (results) => {

            let card = document.createElement('div');
            card.className = 'card shadow cursor-pointer ml-3';
            card.style = "width: 18rem;"

            let cardBody = document.createElement('div');
            cardBody.className = 'card-body';

            let text = document.createElement('h5');
            text.innerText = results.text;
            text.className = 'card-title';

            let desc = document.createElement('div');
            desc.innerText = results.desc;
            desc.className = 'card-text';
            //<div class='dropdown'><button class='btn dropdown-toggle text-center green' type='button' id='dropdownMenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> </button><div class='dropdown-menu' aria-labelledby='dropdownMenu'><button class='dropdown-item' data-id='<?php echo $row['tID']; ?>' >View Details</button><div class='dropdown-divider'></div><button class='dropdown-item' onclick='apply(<?php echo $taskID ?>,<?php echo $tID ?>)' >Apply</button><button class='dropdown-item' type='button'>Another Action</button> </div></div>
            let ename = document.createElement('div');
            ename.innerText = "Posted by " + results.ename;
            ename.className = 'card-footer';

            var btn = document.createElement("button");   // Create a <button> element
            btn.innerHTML = "Apply"; 
           btn.addEventListener("click", function(){apply(results.id, results.thID);});                  // Insert text
            ename.appendChild(btn);


            cardBody.appendChild(text);
            cardBody.appendChild(desc);
            cardBody.appendChild(ename);
            card.appendChild(cardBody);
            cardContainer.appendChild(card);

        }

        let initListOfTasks = () => {
            if (cardContainer) {
                document.getElementById('card-container').replaceWith(cardContainer);
                return;
            }

            cardContainer = document.getElementById('card-container');
            results.forEach((task) => {
                createTaskCard(task);
            });
        };
        initListOfTasks();
        if (results.success == true) {



        } else {
            $("#message_failure").html("<strong>Failure</strong>  " + results.message);
            $("#message_failure").show();
            setTimeout(function () {
                $("#message_failure").hide();
            }, 4000);
        }
    }).fail(function () {
        console.log("failure.");
        alert("Sorry. Server unavailable. ");
    }).always(function () {
        //console.log("Complete.");
    });
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