export class PetHasAppointmentArea {
    _petHasAppointmentArea = null;
    _closeButton = null;

    initialize() {
        this._cacheElements();
        this._addEventListeners();
    }

    _cacheElements() {
        this._petHasAppointmentArea = document.querySelector('.pet-has-appointment-area');
        
        if (this._petHasAppointmentArea) {
            this._closeButton = this._petHasAppointmentArea.querySelector('.close-button');
        }
    }

    _addEventListeners() {
        this._closeButton.addEventListener('click', () => this._closeArea());
    }

    _closeArea() {
        this._petHasAppointmentArea.classList.remove('active');
    }
}