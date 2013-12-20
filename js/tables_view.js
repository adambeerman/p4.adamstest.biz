/**
 * Created with JetBrains PhpStorm.
 * User: adam
 * Date: 12/20/13
 * Time: 9:34 AM
 * To change this template use File | Settings | File Templates.
 */



$(document).ready(function(){
    $(".accounting").each(function(){
        $(this).html(accounting.formatMoney(this.innerHTML));
    });
});
