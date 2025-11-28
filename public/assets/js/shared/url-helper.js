export class UrlHelper {
    static getBaseUrl() {
        const path = window.location.pathname;
        const segments = path.split('/').filter(s => s);
        
        // Detecta o diretório base (primeiro segmento após o domínio)
        if (segments.length > 0 && segments[0] !== 'public') {
            return '/' + segments[0];
        }
        
        return '';
    }

    static to(path = '') {
        const baseUrl = this.getBaseUrl();
        const cleanPath = path.replace(/^\/+/, '');
        
        return baseUrl + (cleanPath ? '/' + cleanPath : '');
    }

    static asset(path) {
        const cleanPath = path.replace(/^\/+/, '');
        return this.to('public/assets/' + cleanPath);
    }
}
