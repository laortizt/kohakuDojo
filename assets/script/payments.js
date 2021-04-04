$(document).ready(function () {
    function updateCost() {
        var cost = $('#procedure-newpay option:selected').data('cost');

        if (cost) {
            $('#price-newpay').val('$' + cost);
        }
    }

    $('#procedure-newpay').change(function(e) {
        updateCost();
    });

    updateCost();
});
 