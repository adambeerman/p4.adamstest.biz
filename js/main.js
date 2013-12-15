/**
 * Created with JetBrains PhpStorm.
 * User: adam
 * Date: 12/11/13
 * Time: 8:15 PM
 * To change this template use File | Settings | File Templates.
 */

//Create a new table from the tables_index view
$("#name").click(function() {

    //Swap out the new row with the "add new row" button
    $(".hidden").addClass("not_hidden_placeholder").removeClass("hidden");
    $(".not_hidden").addClass("hidden").removeClass("not_hidden");
    $(".not_hidden_placeholder").addClass("not_hidden").removeClass("not_hidden_placeholder");

});

/*$("#submit_name").click(function() {
   $length = $('input').val().length;
    if($length<1) {
        $("#new_table_error").html("Please enter a valid table name");
    }
    else {

    }
});*/