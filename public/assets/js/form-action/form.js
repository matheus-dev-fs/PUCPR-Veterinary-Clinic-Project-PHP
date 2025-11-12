export class FormAction {
    static _REQUIRED_PARAMS = ['tutorName', 'email', 'phone', 'petName', 'sex', 'service', 'date'];

    _elements;

    initialize() {
        this._cacheElements();
        this._getParams();
    }

    _cacheElements() {
        this._elements = {
            tutorName: document.querySelector('.info-item.tutorName .value'),
            email: document.querySelector('.info-item.email .value'),
            phone: document.querySelector('.info-item.phone .value'),
            petName: document.querySelector('.info-item.petName .value'),
            sex: document.querySelector('.info-item.sex .value'),
            service: document.querySelector('.info-item.service .value'),
            date: document.querySelector('.info-item.date .value'),
        }
    }

    _getParams() {
        const params = new URLSearchParams(window.location.search);

        for (const field of FormAction._REQUIRED_PARAMS) {
            const value = params.get(field);

            if (!value)  {
                window.location.href = 'schedule.html';
                return;
            }
            
            this._updateField(field, value);
        }
    }

    _updateField(field, value) {
        if (this._elements[field]) {
            this._elements[field].textContent = value;
        }
    }
}