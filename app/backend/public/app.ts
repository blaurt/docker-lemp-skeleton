class Validator {
    /**
     *
     * @param event
     * @param formElement
     * @param dataMessageAttribute
     */
    constructor(event, formElement: string, dataMessageAttribute: string) {
        this.event = event;
        this._setFormElement(formElement);
        this._setDataMessageAttribute(dataMessageAttribute);
    }

    /**
     *
     * @param elementName
     * @private
     */
    _setFormElement(elementName) {
        if ($(elementName).length === 0) {
            this.event.preventDefault();
            throw `Form ${elementName} doesn't exist`;
        }

        this._formElement = elementName;
    }

    /**
     *
     * @param attributeName
     * @private
     */
    _setDataMessageAttribute(attributeName) {
        this._dataMessageAttribute = attributeName;
    }

    clearMessages() {
        $('input').removeClass('add-form__input--error');
        $(`[${this._dataMessageAttribute}]`).text('');
        $(`[${this._dataMessageAttribute}]`).css('display', 'none');
    }

    /**
     *
     * @param input
     * @param code
     * @param message
     */

    isRequired(input, code, message) {
        let value = $(`${this._formElement} [name=${input}]`).val();
        if (value.length === 0) {
            this.event.preventDefault();
            $(`${this._formElement} [name=${input}]`).addClass('add-form__input--error');
            $(`[${this._dataMessageAttribute}=${code}]`).text(message);
            $(`[${this._dataMessageAttribute}=${code}]`).css('display', 'block');

        }
    }
}

$(window).ready(function () {
    $(".add-form").submit(function (event) {
        const validator = new Validator(event, ".add-form", "data-flash-message");
        validator.clearMessages();
        validator.isRequired("sku", "sku_is_required", "Sku is required!");
        validator.isRequired("name", "name_is_required", "Name is required!");
        validator.isRequired("price", "price_is_required", "Price is required!");
        if ($('#type').find(":selected").text() === 'Book') {
            validator.isRequired("weight", "weight_is_required", "Weight is required!");
        } else if ($('#type').find(":selected").text() === 'Dvd') {
            validator.isRequired("size", "size_is_required", "Size is required!");
        } else if ($('#type').find(":selected").text() === 'Furniture') {
            validator.isRequired("height", "height_is_required", "Height is required!");
            validator.isRequired("length", "length_is_required", "Length is required!");
            validator.isRequired("width", "width_is_required", "Width is required!");
        }
    });
});