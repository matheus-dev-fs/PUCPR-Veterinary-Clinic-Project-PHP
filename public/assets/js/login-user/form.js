export class LoginUserForm {
    static CSS_CLASSES = {
        ERROR_VISIBLE: 'show-error',
        ERROR_REQUIRED: '.error-message.required',
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
        this._formElement = document.querySelector('#login-user-form');
        this._inputsGroup = {
            login: this._formElement.querySelector('.input-group.login'),
            password: this._formElement.querySelector('.input-group.password'),
        };
        this._submitButton = this._formElement.querySelector('button[type="submit"]');
    }

    _addEventListeners() {
        this._inputsGroup.login.addEventListener('input', (e) => this._validateField(e.target));
        this._inputsGroup.password.addEventListener('input', (e) => this._validateField(e.target));

        this._formElement.addEventListener('submit', (e) => this._handleFormSubmit(e));
    }

    _validateField(inputElement) {
        const isEmpty = this._validateEmptyInput(inputElement, this._inputsGroup[inputElement.name]);
        const requiredErrorElement = this._inputsGroup[inputElement.name].querySelector(LoginUserForm.CSS_CLASSES.ERROR_REQUIRED);
        
        this._toggleErrorMessage(requiredErrorElement, isEmpty);
        return !isEmpty;
    }

    _validateEmptyInput(inputElement, inputArea) {
        const isEmpty = this._isInputEmpty(inputElement.value);
        const requiredErrorElement = inputArea.querySelector(LoginUserForm.CSS_CLASSES.ERROR_REQUIRED);
        
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
            login: this._validateField(this._getInputElement(this._inputsGroup.login)),
            password: this._validateField(this._getInputElement(this._inputsGroup.password)),
        };

        return Object.values(validationResults).every(isValid => isValid === true);
    }

    _getInputElement(inputArea) {
        return inputArea.querySelector('input, select, textarea');
    }

    _submitForm() {
        this._formElement.submit();
    }

    _toggleErrorMessage(errorElement, shouldShow) {
        if (!errorElement) return;
        
        errorElement.classList.toggle(LoginUserForm.CSS_CLASSES.ERROR_VISIBLE, shouldShow);
    }

    _isInputEmpty(value) {
        return !value || !value.trim().length;
    }
}