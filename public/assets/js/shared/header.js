export class Menu {
    constructor() {
        this._mobileMenuButton = document.querySelector('.mobile-menu');
        this._rightArea = document.querySelector('.right--area');
    }

    initialize() {
        if (!this._mobileMenuButton || !this._rightArea) return;
        this._mobileMenuButton.addEventListener('click', () => this._toggleMenu());
    }

    _toggleMenu() {
        this._rightArea.classList.toggle('desactive');
    }
}