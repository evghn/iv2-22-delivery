$(() => {
   
    const toastItem  = (text, bg_color, index) => 
        `<div class="toast alert  ${bg_color} text-dark border-0 top-5 end-0 bg-opacity-75 fs-5" role="status" aria-live="alert" aria-atomic="true" data-bs-autohide="true" data-index='${index}' data-bs-delay='6000' >
            <div class="d-flex">
                <div class="toast-body">
                    ${text}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Закрыть"></button>
            </div>
        </div>`;


    const toastAdd = (text, bg_color) => {
        const count = $('.toast-container').find('.tast').length + 1;
        const toast = $(toastItem(text, bg_color, count))
        $('.toast-container').append(toast) 
        $(toast).toast('show');
        setTimeout(() => {
            toast.fadeOut(1000);
            setTimeout(() => toast.remove(), 2000);
        }, 5000);
    
    }

    $('#admin-order-pjax, #order-view-pjax').on('pjax:end', function() {
        const data_container = $('.toast-container');
        if (data_container.data('text').length) {
            toastAdd(data_container.data('text'), data_container.data('bg-color') );   
        }        
    })   

    $('#admin-order-pjax').on('click', '.btn-toast', function(e) {
        e.preventDefault();
        // const entity = $(this);
        // console.log(entity)
        toastAdd(`Текущее время ${new Date()}`, 'bg-warning');   


    })   



})