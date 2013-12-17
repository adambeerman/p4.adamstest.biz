/**
 * Created with JetBrains PhpStorm.
 * User: adam
 * Date: 12/15/13
 * Time: 9:39 PM
 * To change this template use File | Settings | File Templates.
 */

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