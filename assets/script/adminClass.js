$(document).ready(function () {
    function updateCost() {
        var cost = $('#select-event option:selected').data('cost');

        if (cost || cost == 0) {
            $('#eventsPrice').val('$' + cost);
        }
    }

    $('#select-event').change(function(e) {
        updateCost();
    });

    updateCost();
});
 