$(() => {
    $('#admin-order-pjax, #order-view_block-btn').on('click', '.btn-cancel-modal', function(e) {
        e.preventDefault();
        $('#form-cancel-modal2').attr('action', $(this).attr('href'));
        $('#form-cancel-modal2').find('#order-comment_admin').val('');
        $('#cancel-modal2').modal('show')
    })


    $('#cancel-modal2').on('click', '.btn-modal-close', function(e) {
        e.preventDefault();
        $('#cancel-modal2').modal('hide')
        // $('#form-cancel-modal2').find('#order-comment_admin').val('');
    })


    $('#form-cancel-pjax2').on('pjax:end', () => {
        // if ($('#form-cancel-pjax2').attr('data-first-load') == 1) {
        //     $('#form-cancel-pjax2').attr('data-first-load', 0)
        //     return;
        // }

        $('#cancel-modal2').modal('hide');
        if ($('#admin-order-pjax').length) {
            $.pjax.reload('#admin-order-pjax')
        }

        if ($('#order-view-pjax').length) {
            $.pjax.reload('#order-view-pjax')
        }
    })


    // if ($('#form-cancel-pjax2').attr('data-first-load') == 1) {
    //     // $('#form-cancel-pjax2').attr('data-first-load', 2);
    //     $.pjax.reload('#form-cancel-pjax2', {
    //         url: '/admin-panel/order/cancel-modal2',
    //         push: false,
    //         replace: false,
    //         timeout: 5000,
    //     })
    // }
})