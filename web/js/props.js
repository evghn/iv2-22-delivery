$(() => {
    let itemsCount = $('#form-item').find('.item-props').length - 1;


    const block = index => `<div class="border p-3 my-3 item-props" data-index="${index}">
            <div class="d-flex justify-content-end">
                <div class="btn-group " role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-danger btn-remove">-</button>                   
                    <button type="button" class="btn btn-success btn-pluse">+</button>
                </div>                
            </div>
            <div class="flex">
                <div class="mb-3 field-itemprop-${index}-title required">
                    <label class="form-label" for="itemprop-${index}-title">Title</label>
                    <input type="text" id="itemprop-${index}-title" class="form-control" name="ItemProp[${index}][title]" maxlength="255" aria-required="true">

<div class="invalid-feedback"></div>
</div>                <div class="mb-3 field-itemprop-${index}-value required">
<label class="form-label" for="itemprop-${index}-value">Value</label>
<input type="text" id="itemprop-${index}-value" class="form-control" name="ItemProp[${index}][value]" aria-required="true">

<div class="invalid-feedback"></div>
</div>                <div class="mb-3 field-itemprop-${index}-id">

<input type="hidden" id="itemprop-${index}-id" class="form-control" name="ItemProp[${index}][id]">

<div class="invalid-feedback"></div>
</div>
            </div>

        </div>`

    $('#block-props').on('click', '.btn-pluse', () => {
        itemsCount++;        
        $('#block-props .item-props:last').after(block(itemsCount))

        const  title = `itemprop-${itemsCount}-title`;
        $('#form-item').yiiActiveForm('add',
            {"id":title,"name":`[${itemsCount}]title`,"container":`.field-${title}`,"input":`#${title}`,"error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Необходимо заполнить «Title»."});yii.validation.string(value, messages, {"message":"Значение «Title» должно быть строкой.","max":255,"tooLong":"Значение «Title» должно содержать максимум 255 символов.","skipOnEmpty":1});}}
        )

        const  itemprop = `itemprop-${itemsCount}-value`;
        $('#form-item').yiiActiveForm(
            'add',
            {"id":itemprop,"name":`[${itemsCount}]value`,"container":`.field-${itemprop}`,"input":`#${itemprop}`,"error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Необходимо заполнить «Value»."});yii.validation.number(value, messages, {"pattern":/^[+-]?\d+$/,"message":"Значение «Value» должно быть целым числом.","skipOnEmpty":1});}}
        )
    })

    $('#block-props').on('click', '.btn-remove', function() {

        if  ($('#block-props .item-props').length > 1) {
            const parent = $(this).parents('.item-props')        
            const index = parent.data('index');    
    
            $('#form-item').yiiActiveForm('remove', `itemprop-${index}-title`);
            $('#form-item').yiiActiveForm('remove', `itemprop-${index}-value`);
            parent.remove();
        }
    })
})