export class RegisterUserForm {
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
        ERROR_REQUIRED: '.error-message.required',
        ERROR_INVALID: '.error-message.invalid',
        ERROR_MISMATCH: '.error-message.mismatch'
    };

    _formElement = null;
    _inputsGroup = null;
    _submitButton = null;

    initialize() {
        this._cacheElements();
        this._addEventListeners();
    }

    _cacheElements() {
        this._formElement = document.querySelector('#register-user-form');
        this._inputsGroup = {
            name: this._formElement.querySelector('.input-group.name'),
            email: this._formElement.querySelector('.input-group.email'),
            emailConfirmation: this._formElement.querySelector('.input-group.email-confirmation'),
            password: this._formElement.querySelector('.input-group.password'),
            passwordConfirmation: this._formElement.querySelector('.input-group.password-confirmation'),
            phone: this._formElement.querySelector('.input-group.contact'),
        };
        this._submitButton = this._formElement.querySelector('button[type="submit"]');
    }

    _addEventListeners() {
        this._inputsGroup.name.addEventListener('input', (e) => this._validateUserName(e.target));
        this._inputsGroup.email.addEventListener('input', (e) => this._validateEmail(e.target));
        this._inputsGroup.emailConfirmation.addEventListener('input', (e) => this._validateEmailConfirmation(e.target));
        this._inputsGroup.password.addEventListener('input', (e) => this._validatePassword(e.target));
        this._inputsGroup.passwordConfirmation.addEventListener('input', (e) => this._validatePasswordConfirmation(e.target));
        this._inputsGroup.phone.addEventListener('input', (e) => this._validatePhone(e.target));
        this._formElement.addEventListener('submit', (e) => this._handleFormSubmit(e));
    }

    _validateUserName(inputElement) {
        return this._validateNameField(inputElement, this._inputsGroup.name);
    }

    _validateEmail(inputElement) {
        const isEmpty = this._validateEmptyInput(inputElement, this._inputsGroup.email);
        const invalidErrorElement = this._inputsGroup.email.querySelector(RegisterUserForm.CSS_CLASSES.ERROR_INVALID);
        
        if (isEmpty) {
            this._toggleErrorMessage(invalidErrorElement, false);
            return false;
        }

        const isValid = this._isEmailValid(inputElement.value);
        this._toggleErrorMessage(invalidErrorElement, !isValid);
        return isValid;
    }

    _validateEmailConfirmation(inputElement) {
        const originalEmailInput = this._getInputElement(this._inputsGroup.email);
        return this._validateBothFieldsMatch(inputElement, originalEmailInput, this._inputsGroup.emailConfirmation);
    }

    _validatePassword(inputElement) {
        const isEmpty = this._validateEmptyInput(inputElement, this._inputsGroup.password);
        const invalidErrorElement = this._inputsGroup.password.querySelector(RegisterUserForm.CSS_CLASSES.ERROR_INVALID);
        
        if (isEmpty) {
            this._toggleErrorMessage(invalidErrorElement, false);
            return false;
        }

        const isPasswordValid = this._isValidPassword(inputElement.value);
        this._toggleErrorMessage(invalidErrorElement, !isPasswordValid && !isEmpty);
        return isPasswordValid;
    }

    _validatePasswordConfirmation(inputElement) {
        const originalPasswordInput = this._getInputElement(this._inputsGroup.password);
        return this._validateBothFieldsMatch(inputElement, originalPasswordInput, this._inputsGroup.passwordConfirmation);
    }

    _validatePhone(inputElement) {
        inputElement.value = this._formatPhoneNumber(inputElement.value);
        
        const digitsOnly = inputElement.value.replace(/\D/g, '');
        const isPhoneComplete = digitsOnly.length === 10 || digitsOnly.length === 11;
        const isPhoneEmpty = digitsOnly.length === 0;
        
        const requiredErrorElement = this._inputsGroup.phone.querySelector(RegisterUserForm.CSS_CLASSES.ERROR_REQUIRED);
        const invalidErrorElement = this._inputsGroup.phone.querySelector(RegisterUserForm.CSS_CLASSES.ERROR_INVALID);

        this._toggleErrorMessage(requiredErrorElement, isPhoneEmpty);
        this._toggleErrorMessage(invalidErrorElement, !isPhoneComplete && !isPhoneEmpty);

        return isPhoneComplete;
    }

    _validateBothFieldsMatch(inputElement, originalInputElement, inputArea) {
        const isEmpty = this._validateEmptyInput(inputElement, inputArea);
        const mismatchErrorElement = inputArea.querySelector(RegisterUserForm.CSS_CLASSES.ERROR_MISMATCH);

        if (isEmpty) {
            this._toggleErrorMessage(mismatchErrorElement, false);
            return false;
        }

        const isMismatch = inputElement.value !== originalInputElement.value;
        this._toggleErrorMessage(mismatchErrorElement, isMismatch && !isEmpty);
        
        return !isMismatch;
    }

    _validatePetName(inputElement) {
        return this._validateNameField(inputElement, this._inputsGroup.petName);
    }

    _validateService(inputElement) {
        return !this._validateEmptyInput(inputElement, this._inputsGroup.service);
    }

    _validateDate(inputElement) {
        const isEmpty = this._validateEmptyInput(inputElement, this._inputsGroup.date);
        const invalidErrorElement = this._inputsGroup.date.querySelector(RegisterUserForm.CSS_CLASSES.ERROR_INVALID);
        
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
        const invalidErrorElement = inputArea.querySelector(RegisterUserForm.CSS_CLASSES.ERROR_INVALID);
        
        if (isEmpty) {
            this._toggleErrorMessage(invalidErrorElement, false);
            return false;
        }

        const hasMinLength = this._hasMinLength(inputElement.value, RegisterUserForm.VALIDATION_RULES.NAME_MIN_LENGTH);
        this._toggleErrorMessage(invalidErrorElement, !hasMinLength);
        return hasMinLength;
    }

    _validateEmptyInput(inputElement, inputArea) {
        const isEmpty = this._isInputEmpty(inputElement.value);
        const requiredErrorElement = inputArea.querySelector(RegisterUserForm.CSS_CLASSES.ERROR_REQUIRED);
        
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
            name: this._validateUserName(this._getInputElement(this._inputsGroup.name)),
            email: this._validateEmail(this._getInputElement(this._inputsGroup.email)),
            emailConfirmation: this._validateEmailConfirmation(this._getInputElement(this._inputsGroup.emailConfirmation)),
            password: this._validatePassword(this._getInputElement(this._inputsGroup.password)),
            passwordConfirmation: this._validatePasswordConfirmation(this._getInputElement(this._inputsGroup.passwordConfirmation)),
            phone: this._validatePhone(this._getInputElement(this._inputsGroup.phone)),
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
        
        errorElement.classList.toggle(RegisterUserForm.CSS_CLASSES.ERROR_VISIBLE, shouldShow);
    }

    _isInputEmpty(value) {
        return !value || !value.trim().length;
    }

    _isEmailValid(email) {
        return RegisterUserForm.VALIDATION_RULES.EMAIL_REGEX.test(email);
    }

    _formatPhoneNumber(value) {
        const { REMOVE_NON_DIGITS, ADD_AREA_CODE } = 
            RegisterUserForm.VALIDATION_RULES.PHONE_MASK_REGEX;

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

    _isValidPassword(password) {
        const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return pattern.test(password);
    }
}