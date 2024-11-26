$(() => {
    // $('#form-order-pjax').on('change', '#order2-check', function() {
    $('#form-order-pjax').on('change', '#order2-check', function() {
        $("#order2-outpost_id option:first").prop('selected', true);
        if ($(this).prop('checked')) {
            //comment - check
            $("#order2-comment").prop('disabled', false);
            $("#order2-outpost_id").prop('disabled', true);
            $("#order2-outpost_id").removeClass('is-invalid');
            $("#order2-outpost_id").removeClass('is-valid');
            $("#order2-comment").addClass('is-invalid');
        } else {
            //outpost - uncheck
            $("#order2-comment").val('');
            $("#order2-comment").prop('disabled', true);
            $("#order2-outpost_id").prop('disabled', false);
            $("#order2-comment").removeClass('is-invalid');
            $("#order2-comment").removeClass('is-valid');
            $("#order2-outpost_id").addClass('is-invalid');            
        }
    })    
})

