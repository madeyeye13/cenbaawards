import './bootstrap';

// Dark mode theme management
const theme = {
    dark: localStorage.getItem('adminTheme') === 'dark',
    
    init() {
        this.applyTheme();
    },
    
    applyTheme() {
        if (this.dark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    },
    
    toggle() {
        this.dark = !this.dark;
        localStorage.setItem('adminTheme', this.dark ? 'dark' : 'light');
        this.applyTheme();
    }
};

// Initialize theme immediately
theme.init();

// Set up Alpine store
function setupAlpineStore() {
    if (typeof Alpine !== 'undefined' && typeof Alpine.store === 'function') {
        try {
            Alpine.store('theme', theme);
        } catch (e) {
            console.warn('Alpine store setup failed:', e);
        }
    }
}

// Try immediately
setupAlpineStore();

// Also try when Alpine initializes
document.addEventListener('alpine:init', setupAlpineStore);

