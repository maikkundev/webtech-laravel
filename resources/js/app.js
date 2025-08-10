class ThemeManager {
    constructor() {
        this.init();
    }

    init() {
        // Get stored theme from cookie or default to light
        const storedTheme = this.getStoredTheme() || "light";
        this.setTheme(storedTheme);
        this.bindEvents();
    }

    getStoredTheme() {
        // Check cookie for theme preference
        const name = "bs-theme=";
        const decodedCookie = decodeURIComponent(document.cookie);
        const ca = decodedCookie.split(";");

        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === " ") {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return null;
    }

    getCurrentTheme() {
        return document.documentElement.getAttribute("data-bs-theme");
    }

    isDarkMode() {
        return this.getCurrentTheme() === "dark";
    }

    isLightMode() {
        return this.getCurrentTheme() === "light";
    }

    setTheme(theme) {
        document.documentElement.setAttribute("data-bs-theme", theme);
        this.storeTheme(theme);
        this.updateThemeIcon(theme);
    }

    storeTheme(theme) {
        // Store in cookie for 30 days
        const expiryDate = new Date();
        expiryDate.setTime(expiryDate.getTime() + 30 * 24 * 60 * 60 * 1000);
        document.cookie = `bs-theme=${theme};expires=${expiryDate.toUTCString()};path=/`;
    }

    toggleTheme() {
        const currentTheme = this.getCurrentTheme();
        const newTheme = currentTheme === "light" ? "dark" : "light";
        this.setTheme(newTheme);
    }

    updateThemeIcon(theme) {
        const themeIcon = document.getElementById("theme-icon");
        if (themeIcon) {
            if (theme === "dark") {
                themeIcon.className = "bi bi-sun-fill";
            } else {
                themeIcon.className = "bi bi-moon-fill";
            }
        }
    }

    bindEvents() {
        const themeToggle = document.getElementById("theme-toggle");
        if (themeToggle) {
            themeToggle.addEventListener("click", () => this.toggleTheme());
        }
    }
}

// Initialize theme manager when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
    window.themeManager = new ThemeManager();
});

// Utility functions to check theme globally
function isDarkMode() {
    return window.themeManager ? window.themeManager.isDarkMode() : false;
}

function isLightMode() {
    return window.themeManager ? window.themeManager.isLightMode() : true;
}

function getCurrentTheme() {
    return window.themeManager
        ? window.themeManager.getCurrentTheme()
        : "light";
}
