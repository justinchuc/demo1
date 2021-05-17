$(function () {
    
  $(".locationSelect").select2({
    placeholder: "Type Task Location",
    minimumInputLength: 1,
    dropdownAutoWidth: true,
    width: '100%',
    ajax: {
        url: "model/locationList.php",
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
