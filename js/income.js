/**
 * Created with JetBrains PhpStorm.
 * User: adam
 * Date: 11/24/13
 * Time: 4:25 PM
 * To change this template use File | Settings | File Templates.
 */

/* -------------------------
COLLAPSIBLE INTRODUCTION COMMENTS
---------------------------- */

$('#intro').hover(function(){
    $('intro').css("border", "20px solid red ");
});

$('#intro').click(function(){
    $('#intro').slideToggle();
    $('h6').slideToggle();
    $('.bio').hide();

});

$('h6').click(function() {
    $('h6').slideToggle();
    $('#intro').slideToggle();
});

/* -------------------------
 sumContents() is a function for summing all contents of a given class name
 ---------------------------- */

var sumContents = function($className) {

    //Find the items that have the associated class=
    var items = document.getElementsByClassName($className);
    var count = items.length;
    var i, sum = 0;
    for(i = 0; i<count; i++){
        sum += parseFloat(accounting.unformat(items[i].value));
    }

    var $fnCall = "#"+ $className + "_sum";
    //Keep the Revenue figure if no numbers entered
    if(isNaN(sum)){
        $($fnCall).html($className);
    }
    //Replace the #revenue html with the sum of the figures
    else {
        $($fnCall).html(accounting.formatMoney(sum));
    }
};

/* -------------------------
 profitCalc() is a function for re-calculating the profits and margins based on
 available income statement information
 ---------------------------- */

var profitCalc = function() {
    var rev = accounting.unformat($('#revenue_sum').html());
    var cos = accounting.unformat($('#cos_sum').html());
    var op_ex = accounting.unformat($('#opex_sum').html());
    var other_ex = accounting.unformat($('#otherex_sum').html());

    //If the values aren't NaN's, then we can begin calculating the profits and margins

    $("#gross_profit").html("Gross Profit");
    $("#gross_margin").html("Gross Margin");
    $("#op_profit").html("Operating Profit");
    $("#op_margin").html("Operating Margin");
    $("#net_profit").html("Net Profit");
    $("#net_margin").html("Net Margin");


    if(rev != 0){
        if(cos != 0){
            var p = rev - cos;
            var m = Math.round(p/rev*100*10)/10;
            $("#gross_profit").html(accounting.formatMoney(p));
            $("#gross_margin").html(m+ " %");

            if(op_ex != 0){
                var o = p - op_ex;
                var om = Math.round(o/rev * 100*10)/10;
                $("#op_profit").html(accounting.formatMoney(o));
                $("#op_margin").html(om+ " %");

                //Since Other Expenses are not actually necessary:
                $("#net_profit").html(accounting.formatMoney(o));
                $("#net_margin").html(om+ " %");

                if(other_ex != 0){

                    var ot = o - other_ex;
                    var otm = Math.round(ot/rev*100*10)/10;
                    $("#net_profit").html(accounting.formatMoney(ot));
                    $("#net_margin").html(otm+ " %");
                }
            }
        }
    }

};

/* ---------------------
 Listener to find when an input value is changed
 It will call the profitCalc and sumContent functions
 -------------------- */

$('input').change(function(){

    //Reformat the entry as currency using an outside accounting JS plugin
    var $moneyPlaceholder = $(this).val();
    $(this).val(accounting.formatMoney($moneyPlaceholder));

    sumContents($(this).attr("class"));
    profitCalc();
});

/* -----------------------
    This function gives functionality to the "[+]" icons on the right-hand columns.
    [+]'s are given the "expandable_right" class
 ----------------------- */

$('.expandable_right').click(function(){

    //Determine the id of the main div (i.e. find id of parent of parent of parent)
    var myClass = $(this).parent().parent().parent().attr("id");

    //Generate the Placeholder value given the myClass value
    switch(myClass) {
        case "revenue":
            var placeholder = "Revenue";
            break;
        case "cos":
            var placeholder = "Cost of Goods";
            break;
        case "opex":
            var placeholder = "Op Ex";
            break;
        case "otherex":
            var placeholder = "Other Expenses";
        default:
            break;
    }

    //Create the new rows to be inserted
    //row_left is for the left-hand column
    //row_right is for the right-hand column

    var $row_left =
        "<span class = 'editable_field'>Component - click to rename<input class = 'hidden'></span><br>";
    var $row_right =
        "<span><input placeholder='" + placeholder + "' class = '" + myClass + "'></span><br>";


    //Insert the new row before the expandable section
    $($row_right).insertBefore("#"+myClass+" .expandable_right");
    $($row_left).insertBefore("#"+myClass+"  .expandable_left");

    //Re-initiate the listener functionality for when the new inputs are modified
    $('input').change(function(){

        //Reformat the entry as currency using an outside accounting JS plugin
        var $moneyPlaceholder = $(this).val();
        $(this).val(accounting.formatMoney($moneyPlaceholder));

        sumContents($(this).attr("class"));
        profitCalc();
    });

    //Re-initiate the clickability of editable field
    $(".editable_field").on("click", switchToInput);

});

/* ---------------------------
 Functionality that allows editable fields to change between inputs and spans
 -------------------------- */

var switchToInput = function () {

    //The div parent id will contain the necessary class name
    var $myID = $(this).parent().parent().parent().attr("id");

    //Initiate editable functionality
    $updatedClass = $myID + " editable_field";

    //If the "year" class has been accessed, need to maintain that class
    if($(this).hasClass("year")){
        $updatedClass += " year";
    }

    //create variable $input that contains the previous text contents
    var $input = $("<input>", {
        val: $(this).text(),
        class: $updatedClass,
        align: "right"
    });

    $(this).replaceWith($input);

    //Make sure the new input value has been selected
    $input.select();

    //revert back to span when leaving the field
    $input.on("blur", switchToSpan);
};

var switchToSpan = function () {

    $updatedClass = "editable_field";

    //If the "year" class has been accessed, need to maintain that class
    //Also remove any characters that are not numbers
    if($(this).hasClass("year")){
        $(this).val(accounting.unformat($(this).val()));
        $updatedClass += " year";
    }


    //Create variable $span that contains the entered values
    var $span = $("<span>", {
        text: $(this).val(),
        class: $updatedClass
    });

    //$span.addClass("editable_field");
    $(this).replaceWith($span);

    //When clicked again, the span will change to input
    $span.on("click", switchToInput);

}

// Change to input field when clicked
$(".editable_field").on("click", switchToInput);

/* -------------------------
    lockValues() is used to convert to the final printable view
 --------------------------- */
var lockValues = function() {

    //Ensure that the minimum amount of information was filled out.
    //Otherwise, need to halt the "lockValues" process
    var rev = accounting.unformat($('#revenue_sum').html());
    var cos = accounting.unformat($('#cos_sum').html());
    var op_ex = accounting.unformat($('#opex_sum').html());
    var other_ex = accounting.unformat($('#otherex_sum').html());

    if(!(rev != 0 && cos != 0 && op_ex != 0)){
        alert("Please provide revenue, cost of sales, and operating expense figures.");
        return;
    }


    $('h3').prependTo("#income_statement");
    $("#income_statement").css("margin", "10px");

    //Find the year that user has chosen to rename the document
    $('h3').html($('.year').text() + " - Income Statement");

    //Convert all the background colors to white & remove the lines & headings
    $('h6, #intro, #head, #foot, .bio').hide();
    $('.expandable_left, .expandable_right').remove();
    $(".calculated_field").css("text-decoration", "none");
    $(".calculated_field").css("text-align", "right");
    $('.row-fluid').css("background-color", "white");


    //Remove cursor view over the spans
    $('span').css("cursor", "auto");

    //Remove editable features for the final print preview
    $('.editable_field').toggleClass('editable_field');



    //Underline & bold formats for accounting
    //$("#cos, #op_ex, #other_ex").css("border-bottom","1px solid black");
    $("#net_profit, #gross_profit").css("text-decoration","underline");
    $("#revenue_sum, #cos_sum, #opex_sum, #otherex_sum, #net_profit").css("font-weight", "bold");
    $("#revenue_sum, #cos_sum, #opex_sum, #otherex_sum").css("border-bottom", "1px solid black");
    $("#revenue_sum, #cos_sum, #opex_sum, #otherex_sum, #net_profit").css("color", "black");

    //Replace inputs with only the values, by finding "each" input in the #income_table
    $('#income_statement').find('input').each(function() {
        $(this).replaceWith("<span>" + this.value + "</span>");
    });


    $('#income_statement').find('.summation').each(function() {
        $(this).replaceWith("<span class = 'sum_final'>"+ this.innerHTML +"</span>");
    });

    $('#income_statement').find('.revenue, .cos, .opex, .otherex').each(function() {
        $(this).replaceWith("<span class = 'ind_final'>"+ this.innerHTML +"</span>");
    });

    $('.span8').find('span').each(function() {
        //console.log($(this).attr("class"));
        if($(this).hasClass("sum_final")){
            $(this).replaceWith("<span class = 'summation'>" + this.innerHTML + "</span>");
        }
        else {
            $(this).replaceWith("<span class = 'left_indent'>" + this.innerHTML + "</span>");
        }
    });

    //Formatting Updates
    $('.summation').css("float", "left");
    $('.summation').css("text-indent", "25px");
    $('.summation').css("color", "black");
    $('.summation').css("font-weight", "bold");

    //Reformat the components
    //Particularly, want the components to be indented
    //$('span').css("float", "left");
    //$('span').css("text-indent", "25px");



};
