$(() => {
    let itemIndex = 0;
    const toastItem  = (text, index) => 
        `<div class="toast alert  bg-warning text-dark border-0 top-5 end-0 bg-opacity-75 fs-5" role="status" aria-live="alert" aria-atomic="true" data-bs-autohide="true" data-index='${index}' data-bs-delay='6000' >
            <div class="d-flex">
                <div class="toast-body">
                    ${text}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Закрыть"></button>
            </div>
        </div>`;


    const toastAdd = text => {
        const count = $('.toast-container').find('.tast').length + 1;
        const toast = $(toastItem(text), count)
        $('.toast-container').append(toast) 
        $(toast).toast('show');
        setTimeout(() => toast.fadeOut(1000), 5000);
    
    }

    $('#admin-order-pjax').on('click', '.btn-toast', function(e) {
        e.preventDefault();

        toastAdd(`Текущее время ${new Date()}`);   


    })   
})