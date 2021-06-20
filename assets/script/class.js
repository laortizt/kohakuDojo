$(document).ready(function () {
    function updateCost() {
        var option = $('#select-event option:selected');

        if (!option) {
            option = $('#select-event option').first();
        }

        var cost = option.data('cost');

        if (cost || cost == 0) {
            $('#eventsPrice').val('$' + cost);
        }
    }

    $('#select-event').change(function(e) {
        updateCost();
    });

    updateCost();
});
 