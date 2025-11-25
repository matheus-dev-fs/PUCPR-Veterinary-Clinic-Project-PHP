export class AppointmentNewForm {
    static CSS_CLASSES = {
        ERROR_VISIBLE: 'show-error',
        ERROR_REQUIRED: '.error-msg.required',
        ERROR_INVALID: '.error-msg.invalid'
    };
    _formElement = null;
    _inputsArea = null;
    _submitButton = null;

    initialize() {
        this._cacheElements();
        this._addEventListeners();
        this._setBasicValidation();
    }

    _cacheElements() {
        this._formElement = document.querySelector('#appointment-new-form');

        if (!this._formElement) {
            return;
        }

        this._inputsArea = {
            pets: this._formElement.querySelector('.input-area.pets'),
            service: this._formElement.querySelector('.input-area.service'),
            infos: this._formElement.querySelector('.input-area.infos'),
            date: this._formElement.querySelector('.input-area.date'),
        };
        this._submitButton = this._formElement.querySelector('button[type="submit"]');
    }

    _addEventListeners() {
        this._inputsArea.pets.addEventListener('input', (e) => this._validatePets(e.target));
        this._inputsArea.service.addEventListener('input', (e) => this._validateService(e.target));
        this._inputsArea.date.addEventListener('input', (e) => this._validateDate(e.target));
        this._formElement.addEventListener('submit', (e) => this._handleFormSubmit(e));
    }

    _setBasicValidation() {
        const dateElement = this._inputsArea.date.querySelector('input[type="date"]');
        if (dateElement) {
            const today = this._getTodayDate();
            dateElement.setAttribute('min', today);
        }
    }

    _validatePets(inputElement) {
        return !this._validateEmptyInput(inputElement, this._inputsArea.pets);
    }

    _validateService(inputElement) {
        return !this._validateEmptyInput(inputElement, this._inputsArea.service);
    }

    _validateDate(inputElement) {
        const isEmpty = this._validateEmptyInput(inputElement, this._inputsArea.date);
        const invalidErrorElement = this._inputsArea.date.querySelector(AppointmentNewForm.CSS_CLASSES.ERROR_INVALID);
        
        if (isEmpty) {
            this._toggleErrorMessage(invalidErrorElement, false);
            return false;
        }

        const isValidDate = this._isDateValid(inputElement.value);
        this._toggleErrorMessage(invalidErrorElement, !isValidDate);
        return isValidDate;
    }

    _validateEmptyInput(inputElement, inputArea) {
        const isEmpty = this._isInputEmpty(inputElement.value);
        const requiredErrorElement = inputArea.querySelector(AppointmentNewForm.CSS_CLASSES.ERROR_REQUIRED);
        
        this._toggleErrorMessage(requiredErrorElement, isEmpty);
        return isEmpty;
    }

    _handleFormSubmit(event) {
        event.preventDefault();

        const isFormValid = this._validateAllFields();

        if (isFormValid) {
            this._submitForm();
        }
    }

    _validateAllFields() {
        const validationResults = {
            pets: this._validatePets(this._getInputElement(this._inputsArea.pets)),
            service: this._validateService(this._getInputElement(this._inputsArea.service)),
            date: this._validateDate(this._getInputElement(this._inputsArea.date)),
        };

        return Object.values(validationResults).every(isValid => isValid === true);
    }

    _getInputElement(inputArea) {
        return inputArea.querySelector('input, select, textarea') || 
               inputArea.querySelector('input[type="radio"]:checked');
    }

    _submitForm() {
        this._formElement.submit();
    }

    _toggleErrorMessage(errorElement, shouldShow) {
        if (!errorElement) return;
        
        errorElement.classList.toggle(AppointmentNewForm.CSS_CLASSES.ERROR_VISIBLE, shouldShow);
    }

    _isInputEmpty(value) {
        return !value || !value.trim().length;
    }

    _isDateValid(dateValue) {
        if (!dateValue) return false;
        
        const selectedDate = new Date(dateValue + 'T00:00:00');
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        return selectedDate >= today;
    }

    _getTodayDate() {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        
        return `${year}-${month}-${day}`;
    }
}