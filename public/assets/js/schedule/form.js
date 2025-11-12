export class ScheduleForm {
    static VALIDATION_RULES = {
        NAME_MIN_LENGTH: 3,
        EMAIL_REGEX: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        PHONE_MASK_REGEX: {
            REMOVE_NON_DIGITS: /\D/g,
            ADD_AREA_CODE: /^(\d{2})(\d)/g,
            ADD_SEPARATOR: /(\d{5})(\d)/,
            LIMIT_DIGITS: /(-\d{4})\d+?$/
        }
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
        this._setBasicValidation();
    }

    _cacheElements() {
        this._formElement = document.querySelector('#schedule-form');
        this._inputsArea = {
            name: this._formElement.querySelector('.input-area.name'),
            email: this._formElement.querySelector('.input-area.email'),
            phone: this._formElement.querySelector('.input-area.phone'),
            petName: this._formElement.querySelector('.input-area.pet-name'),
            service: this._formElement.querySelector('.input-area.service'),
            date: this._formElement.querySelector('.input-area.date'),
        };
        this._submitButton = this._formElement.querySelector('button[type="submit"]');
    }

    _addEventListeners() {
        this._inputsArea.name.addEventListener('input', (e) => this._validateTutorName(e.target));
        this._inputsArea.email.addEventListener('input', (e) => this._validateEmail(e.target));
        this._inputsArea.phone.addEventListener('input', (e) => this._validatePhone(e.target));
        this._inputsArea.petName.addEventListener('input', (e) => this._validatePetName(e.target));
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

    _validateTutorName(inputElement) {
        return this._validateNameField(inputElement, this._inputsArea.name);
    }

    _validateEmail(inputElement) {
        const isEmpty = this._validateEmptyInput(inputElement, this._inputsArea.email);
        const invalidErrorElement = this._inputsArea.email.querySelector(ScheduleForm.CSS_CLASSES.ERROR_INVALID);
        
        if (isEmpty) {
            this._toggleErrorMessage(invalidErrorElement, false);
            return false;
        }

        const isValid = this._isEmailValid(inputElement.value);
        this._toggleErrorMessage(invalidErrorElement, !isValid);
        return isValid;
    }

    _validatePhone(inputElement) {
        inputElement.value = this._formatPhoneNumber(inputElement.value);
        
        const digitsOnly = inputElement.value.replace(/\D/g, '');
        const isPhoneComplete = digitsOnly.length === 10 || digitsOnly.length === 11;
        const isPhoneEmpty = digitsOnly.length === 0;
        
        const requiredErrorElement = this._inputsArea.phone.querySelector(ScheduleForm.CSS_CLASSES.ERROR_REQUIRED);
        const invalidErrorElement = this._inputsArea.phone.querySelector(ScheduleForm.CSS_CLASSES.ERROR_INVALID);

        this._toggleErrorMessage(requiredErrorElement, isPhoneEmpty);
        this._toggleErrorMessage(invalidErrorElement, !isPhoneComplete && !isPhoneEmpty);

        return isPhoneComplete;
    }

    _validatePetName(inputElement) {
        return this._validateNameField(inputElement, this._inputsArea.petName);
    }

    _validateService(inputElement) {
        return !this._validateEmptyInput(inputElement, this._inputsArea.service);
    }

    _validateDate(inputElement) {
        const isEmpty = this._validateEmptyInput(inputElement, this._inputsArea.date);
        const invalidErrorElement = this._inputsArea.date.querySelector(ScheduleForm.CSS_CLASSES.ERROR_INVALID);
        
        if (isEmpty) {
            this._toggleErrorMessage(invalidErrorElement, false);
            return false;
        }

        const isValidDate = this._isDateValid(inputElement.value);
        this._toggleErrorMessage(invalidErrorElement, !isValidDate);
        return isValidDate;
    }

    _validateNameField(inputElement, inputArea) {
        const isEmpty = this._validateEmptyInput(inputElement, inputArea);
        const invalidErrorElement = inputArea.querySelector(ScheduleForm.CSS_CLASSES.ERROR_INVALID);
        
        if (isEmpty) {
            this._toggleErrorMessage(invalidErrorElement, false);
            return false;
        }

        const hasMinLength = this._hasMinLength(inputElement.value, ScheduleForm.VALIDATION_RULES.NAME_MIN_LENGTH);
        this._toggleErrorMessage(invalidErrorElement, !hasMinLength);
        return hasMinLength;
    }

    _validateEmptyInput(inputElement, inputArea) {
        const isEmpty = this._isInputEmpty(inputElement.value);
        const requiredErrorElement = inputArea.querySelector(ScheduleForm.CSS_CLASSES.ERROR_REQUIRED);
        
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
            name: this._validateTutorName(this._getInputElement(this._inputsArea.name)),
            email: this._validateEmail(this._getInputElement(this._inputsArea.email)),
            phone: this._validatePhone(this._getInputElement(this._inputsArea.phone)),
            petName: this._validatePetName(this._getInputElement(this._inputsArea.petName)),
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
        
        errorElement.classList.toggle(ScheduleForm.CSS_CLASSES.ERROR_VISIBLE, shouldShow);
    }

    _isInputEmpty(value) {
        return !value || !value.trim().length;
    }

    _isEmailValid(email) {
        return ScheduleForm.VALIDATION_RULES.EMAIL_REGEX.test(email);
    }

    _formatPhoneNumber(value) {
        const { REMOVE_NON_DIGITS, ADD_AREA_CODE } = 
            ScheduleForm.VALIDATION_RULES.PHONE_MASK_REGEX;

        const digitsOnly = value.replace(REMOVE_NON_DIGITS, '');
        
        if (digitsOnly.length <= 2) {
            return digitsOnly;
        }
        
        if (digitsOnly.length <= 6) {
            return digitsOnly.replace(ADD_AREA_CODE, '($1) $2');
        }
        
        if (digitsOnly.length <= 10) {
            return digitsOnly
                .replace(ADD_AREA_CODE, '($1) $2')
                .replace(/(\d{4})(\d{1,4})/, '$1-$2');
        }
        
        return digitsOnly
            .replace(ADD_AREA_CODE, '($1) $2')
            .replace(/(\d{5})(\d{4})/, '$1-$2')
            .substring(0, 15);
    }

    _hasMinLength(value, minLength) {
        return value.trim().length >= minLength;
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