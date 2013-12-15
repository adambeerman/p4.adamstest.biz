/**
 * Created with JetBrains PhpStorm.
 * User: adam
 * Date: 12/12/13
 * Time: 11:59 PM
 * To change this template use File | Settings | File Templates.
 */
/*
$("#name").click(function() {

    //Swap out the new row with the "add new row" button
    $(".hidden").addClass("not_hidden_placeholder").removeClass("hidden");
    $(".not_hidden").addClass("hidden").removeClass("not_hidden");
    $(".not_hidden_placeholder").addClass("not_hidden").removeClass("not_hidden_placeholder");

    console.log("#name function complete");

});
*/

// Set up the options for ajax
var options = {
    type: 'POST',
    url: '/tables/add/',
    beforeSubmit: function() {
        $('#new_table').html("adding table...");
    },
    success: function(response) {
        //$('#results').html(response);

        var data = $.parseJSON(response);

        //parse the data to insert into the user's tables
        var $insert = data['name'] + " - " +
            "<a href = '/tables/view/"+ data['id'] +"'>View</a> | " +
            "<a href = '/tables/edit/"+ data['id'] +"'>Edit</a> | " +
            "<a href = '/tables/delete/"+ data['id'] +"'>Delete</a>";

        $("#user_table_index ul").append('<li>' + $insert + '</li>');

        var $form = "<form>" +
            "<input placeholder='New Table Name' name='name'>" +
            "<input type = 'submit' value='Create'>" +
            "</form>";

        $('#new_table').html($form);
        //$('form').hide();
    }
};

//Ajax-ify the form
$(document).ready(function() {
    // bind 'myForm' and provide a simple callback functionas   \
    $('form').ajaxForm(options);
});
