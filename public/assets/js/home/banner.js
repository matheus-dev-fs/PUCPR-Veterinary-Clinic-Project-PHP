export class Banner {
    _bannerContent;
    _bannerArea; 
    _slides = []; 
    _dots = [];
    _currentIndex = -1;
    _sliderInterval;
    _sliderTime;

    constructor(bannerContent, sliderTime = 5000) {
        this._bannerContent = Array.isArray(bannerContent) ? bannerContent : [];
        this._sliderTime = sliderTime;
    }

    initialize() {
        this._bannerArea = document.querySelector('.banner-area');
        if (!this._bannerArea || !this._bannerContent.length) {
            return;
        }
        
        this._renderStructure();
        this._cacheElements();
        this._addDotListeners();

        this.changeSlide(0, { resetInterval: false });
        this._startAutoRotate();
    }

    _renderStructure() {
        this._bannerArea.innerHTML = ''; 

        this._bannerContent.forEach(content => {
            const slide = this._createSlide(content);
            this._bannerArea.appendChild(slide);
        });

        const sliderArea = this._createSliderArea();
        this._bannerArea.appendChild(sliderArea);
    }

    _createSlide(content) {
        const slide = document.createElement('div');
        slide.classList.add('banner-slide');
        slide.style.backgroundImage = `url(${content.url || ''})`;

        const overlay = document.createElement('div');
        overlay.classList.add('banner-overlay');
        
        const container = document.createElement('div');
        container.classList.add('container');

        const bannerContent = document.createElement('div');
        bannerContent.classList.add('banner-content');

        const title = document.createElement('h1');
        title.textContent = content.title || '';
        
        const description = document.createElement('p');
        description.textContent = content.description || '';

        bannerContent.appendChild(title);
        bannerContent.appendChild(description);
        container.appendChild(bannerContent);
        slide.appendChild(overlay);
        slide.appendChild(container);

        return slide;
    }

    _createSliderArea() {
        const sliderArea = document.createElement('div');
        sliderArea.classList.add('slider-area');
        
        const slider = document.createElement('div');
        slider.classList.add('slider');

        this._bannerContent.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            dot.dataset.index = index;
            slider.appendChild(dot);
        });

        sliderArea.appendChild(slider);
        return sliderArea;
    }

    _cacheElements() {
        this._slides = this._bannerArea.querySelectorAll('.banner-slide');
        this._dots = this._bannerArea.querySelectorAll('.dot');
    }

    _addDotListeners() {
        this._dots.forEach(dot => {
            dot.addEventListener('click', () => {
                this.changeSlide(Number(dot.dataset.index), { resetInterval: true });
            });
        });
    }

    _startAutoRotate() {
        this._clearInterval();
        this._sliderInterval = setInterval(() => {
            this._advanceSlide();
        }, this._sliderTime);
    }

    _clearInterval() {
        if (this._sliderInterval) {
            clearInterval(this._sliderInterval);
            this._sliderInterval = null;
        }
    }

    _advanceSlide() {
        const nextIndex = (this._currentIndex + 1) % this._bannerContent.length;
        this.changeSlide(nextIndex, { resetInterval: false });
    }

    _resetAutoRotate() {
        this._clearInterval();
        this._startAutoRotate();
    }

    changeSlide(index, { resetInterval = true } = {}) {
        if (!Number.isInteger(index) || index < 0 || index >= this._bannerContent.length) { 
            return; 
        }

        if (this._currentIndex === index && !resetInterval) {
            return;
        }

        this._currentIndex = index;

        this._slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });

        this._dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });

        if (resetInterval) {
            this._resetAutoRotate();
        }
    }
}