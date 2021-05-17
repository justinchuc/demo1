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
  
 var lID=document.getElementById("locationSelect").value;

    $.ajax({
      method: "POST",
      url: "../model/search.php",
      data: {
        "action": "search",
        "tHandler" : tID,
        "location": lID
      },
    }).done(function (data) {
      
      let results = JSON.parse(data);
     // console.log('The data is', results);
      if (results.success == true) {
    //     var jobList = [{
    //         "text": "Help",
    //         "type": "No way",
    //     },
    //     {
    //         "text": "city",
    //         "type": "green",
    //     }
    // ];

        let cardContainer;

        let createTaskCard = (results) => {
        
            let card = document.createElement('div');
            card.className = 'card shadow cursor-pointer';
        
            let cardBody = document.createElement('div');
            cardBody.className = 'card-body';
        
            let text = document.createElement('h5');
            text.innerText = results.text;
            text.className = 'card-title';
        
            let type= document.createElement('div');
            type.innerText = results.type;
            type.className = 'card-color';
        
        
            cardBody.appendChild(text);
            cardBody.appendChild(type);
            card.appendChild(cardBody);
            cardContainer.appendChild(card);
        
        }
        
        let initListOfTasks = () => {
            if (cardContainer) {
                document.getElementById('card-container').replaceWith(cardContainer);
                return;
            }
        
            cardContainer = document.getElementById('card-container');
            jobList.forEach((task) => {
                createTaskCard(task);
            });
        };
        initListOfTasks();
        
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
      console.log("Complete.");
    });
  }