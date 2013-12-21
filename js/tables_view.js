/**
 * Created with JetBrains PhpStorm.
 * User: adam
 * Date: 12/20/13
 * Time: 9:34 AM
 * To change this template use File | Settings | File Templates.
 */


//This function is called from the tables_view when it is loaded
// This will only be called once.
var updateEntries = function() {

    // Run the summations for each category
    // Can't access the values from an array
    // But can go through and find all the variables that match criteria

    sum = [0,0,0,0];

    $('.accounting').each(function() {
        switch($(this).parent().parent().attr("id")) {
            case "revenue": sum[0] += parseFloat(this.innerHTML);
                break;
            case "cos": sum[1] += parseFloat(this.innerHTML);
                break;
            case "opex": sum[2] += parseFloat(this.innerHTML);
                break;
            case "otherex": sum[3] += parseFloat(this.innerHTML);
                break;
            default:
                break;
        }
    });

    // Inject the results received from process.php into the results div
    $('#revenue_sum span:last-child').html("<strong>"+accounting.formatMoney(sum[0])+"</strong>");
    $('#cos_sum span:last-child').html("<strong>"+accounting.formatMoney(sum[1])+"</strong>");
    $('#opex_sum span:last-child').html("<strong>"+accounting.formatMoney(sum[2])+"</strong>");
    $('#otherex_sum span:last-child').html("<strong>"+accounting.formatMoney(sum[3])+"</strong>");


};

//Neatly format the accounting entries on page load

$(document).ready(function(){
    updateEntries();
    $(".accounting").each(function(){
        $(this).html(accounting.formatMoney(this.innerHTML));

    });
});
