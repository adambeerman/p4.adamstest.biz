
// Set up the options for ajax

$("#caption").click(function() {
    $("#caption").addClass("hidden");
    $("#caption_form").removeClass("hidden");

});

var options = {
    type: 'POST',
    url: '/tables/edit_caption/',
    beforeSubmit: function() {
        $('#caption').html("updating...");
    },
    success: function(response) {

        // The /tables/add/ function returns the name an id in JSON format.
        var data = response;
        console.log(data);

        $("#caption").html(data);

        //Hide the status div, and clear the contents of the html
        $('#caption').removeClass("blue_text");
        $('#caption_form').addClass("hidden");
        $('#caption').removeClass("hidden");

    }
};

//Ajax-ify the form
$(document).ready(function() {
    // bind 'myForm' and provide a simple callback functionas   \
    $('#caption_update').ajaxForm(options);
});

