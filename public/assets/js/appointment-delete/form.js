export class DeleteAppointmentForm {
    _modalElement = null;
    _formElement = null;
    _deleteButtons = null;
    _cancelButton = null;
    _appointmentIdInput = null;

    initialize() {
        this._cacheElements();
        this._addEventListeners();
    }

    _cacheElements() {
        this._modalElement = document.querySelector('.delete-appointment-area');
        this._formElement = document.querySelector('.delete-appointment-form');
        this._deleteButtons = document.querySelectorAll('.appointment-actions .delete-button');
        this._cancelButton = this._formElement.querySelector('.cancel-button');
        this._appointmentIdInput = this._formElement.querySelector('input[name="appointment-id"]');
    }

    _addEventListeners() {
        if (this._deleteButtons) {
            this._deleteButtons.forEach(button => {
                button.addEventListener('click', (e) => this._openModalWithId(e));
            });
        }

        this._cancelButton.addEventListener('click', () => this._closeModal());
    }

    _openModalWithId(event) {
        const element = event.currentTarget;
        const appointmentId = element.getAttribute('data-id');
        this._appointmentIdInput.value = appointmentId;
        this._modalElement.classList.remove('desactive');
    }

    _closeModal() {
        this._modalElement.classList.add('desactive');
    }
}