//This is the Javascript for editing the entries in the Income Table

//Goal is to perform an AJAX transfer after each entry is updated


/* -------------------------
 updateDB() should be called after each input is modified
 ---------------------------- */

var updateDB = function() {

    //What is the table id?
    //What is the entry id?
    //What is the value of the entry or entry_Name




    return;
};

/* -------------------------
 sumContents() is a function for summing all contents of a given class name
 ---------------------------- */

var sumContents = function($name) {


    //Find the items that have the associated class=

    //Need to find the items that have the appropriate field name

    //THIS DOESN"T WORK HERE
    $request = "'#"+$name+" input'";
    console.log($request);
    var items = $($request);

    var count = items.length;
    console.log(count);
    var i, sum = 0;
    for(i = 0; i<count; i++){
        console.log(items[i].value);
        sum += parseFloat(accounting.unformat(items[i].value));
    }
    /*
     var $fnCall = "#"+ $className + "_sum";
     //Keep the Revenue figure if no numbers entered
     if(isNaN(sum)){
     $($fnCall).html($className);
     }
     //Replace the #revenue html with the sum of the figures
     else {
     $($fnCall).html(accounting.formatMoney(sum));
     }*/
};

$("#caption").click(function() {
    $("#caption").hide();
    $("#caption_form").show();

});

var options = {
    type: 'POST',
    url: '/tables/edit_caption/',
    beforeSubmit: function() {
        $('#caption').html("updating...");
    },
    success: function(response) {

        // The /tables/add/ function returns the name an id in JSON format.
        var data = $.parseJSON(response);

        $("#caption").html(data['caption']);

        //Hide the status div, and clear the contents of the html
        $('#caption').removeClass("blue_text");
        $('#caption_form').hide();
        $('#caption').show();
        $('#last_modified').html('Last modified: ' + data['modified']);

    }
};

//Ajax-ify the form
$(document).ready(function() {
    // bind 'myForm' and provide a simple callback functionas   \
    $('#caption_update').ajaxForm(options);
});

//Functaionlity for clicking on the "[+]" sign
$('.expand').click(function(){

    //Determine the id of the main div (i.e. find id of parent of parent of parent)
    var myClass = $(this).parent().attr("id");

    //Determine index of the latest entry

    var myIndex = $(this).index();

    //Generate the Placeholder values for the section that is expanding a row
    switch(myClass) {
        case "revenue":
            var placeholderLeft = "Revenue Component Name";
            var placeholderRight = "Revenue";
            break;
        case "cos":
            var placeholderLeft = "Cost of Sales Component Name";
            var placeholderRight = "Cost of Sales";
            break;
        case "opex":
            var placeholderLeft = "Op Ex Component Name";
            var placeholderRight = "Operating Expense";
            break;
        case "otherex":
            var placeholderLeft = "Other Expense Component Name";
            var placeholderRight = "Other Expense";
            break;
        default:
            break;
    }


    $newEntry = '<div class = "entry">' +
                    '<span class = "entry_name pull-left">' +
                        '<input placeholder="' + placeholderLeft+'" name = "'+ myClass+'Name['+myIndex + ']">'+
                    '</span>' +
                    '<span class = "pull-right">'+
                        '<input placeholder="'+placeholderRight+'" class = "accounting" name = "'+myClass+'['+myIndex+']">' +
                    '</span>' +
                '</div>';


    // Insert the new entry before the expandable div
    $($newEntry).insertBefore(this);

    //Initiate the accounting format function to the new cells
    $('.accounting').change(function(){
        //Reformat the entry as currency using an outside accounting JS plugin
        var $moneyPlaceholder = $(this).val();
        $(this).val(accounting.formatMoney($moneyPlaceholder));
        sumContents($(this).parent().parent().parent().attr("id"));
    });
});

// When an "accounting" class has been changed, update the values to accounting format,
// And then sum the contents to the "total", and run the profit calculations if applicable
$('.accounting').change(function(){

    //Reformat the entry as currency using an outside accounting JS plugin
    var $moneyPlaceholder = $(this).val();
    $(this).val(accounting.formatMoney($moneyPlaceholder));

    //Find the id of this form, to appropriately sum the contents
    sumContents($(this).parent().parent().parent().attr("id"));
    //profitCalc();
});


