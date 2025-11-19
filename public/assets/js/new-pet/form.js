export class NewPetForm {
    static VALIDATION_RULES = {
        NAME_MIN_LENGTH: 3
    };

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
    }

    _cacheElements() {
        this._formElement = document.querySelector('#new-pet-form');
        this._inputsArea = {
            petName: this._formElement.querySelector('.input-area.pet-name'),
            type: this._formElement.querySelector('.input-area.type'),
        };
        this._submitButton = this._formElement.querySelector('button[type="submit"]');
    }

    _addEventListeners() {
        this._inputsArea.petName.addEventListener('input', (e) => this._validatePetName(e.target));
        this._inputsArea.type.addEventListener('input', (e) => this._validateType(e.target));
        this._formElement.addEventListener('submit', (e) => this._handleFormSubmit(e));
    }

    _validatePetName(inputElement) {
        return this._validateNameField(inputElement, this._inputsArea.petName);
    }

    _validateType(inputElement) {
        return !this._validateEmptyInput(inputElement, this._inputsArea.type);
    }

    _validateNameField(inputElement, inputArea) {
        const isEmpty = this._validateEmptyInput(inputElement, inputArea);
        const invalidErrorElement = inputArea.querySelector(NewPetForm.CSS_CLASSES.ERROR_INVALID);
        
        if (isEmpty) {
            this._toggleErrorMessage(invalidErrorElement, false);
            return false;
        }

        const hasMinLength = this._hasMinLength(inputElement.value, NewPetForm.VALIDATION_RULES.NAME_MIN_LENGTH);
        this._toggleErrorMessage(invalidErrorElement, !hasMinLength);
        return hasMinLength;
    }

    _validateEmptyInput(inputElement, inputArea) {
        const isEmpty = this._isInputEmpty(inputElement.value);
        const requiredErrorElement = inputArea.querySelector(NewPetForm.CSS_CLASSES.ERROR_REQUIRED);
        
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
            petName: this._validatePetName(this._getInputElement(this._inputsArea.petName)),
            type: this._validateType(this._getInputElement(this._inputsArea.type)),
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
        
        errorElement.classList.toggle(NewPetForm.CSS_CLASSES.ERROR_VISIBLE, shouldShow);
    }

    _isInputEmpty(value) {
        return !value || !value.trim().length;
    }    
    
    _hasMinLength(value, minLength) {
        return value.trim().length >= minLength;
    }
}