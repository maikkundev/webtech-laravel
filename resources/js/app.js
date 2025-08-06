import './bootstrap';

// Theme toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const body = document.body;
    
    // Check for saved theme preference or default to light
    const savedTheme = getCookie('theme') || 'light';
    setTheme(savedTheme);
    
    // Theme toggle click handler
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            const currentTheme = body.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            setTheme(newTheme);
            setCookie('theme', newTheme, 365);
        });
    }
    
    function setTheme(theme) {
        body.setAttribute('data-bs-theme', theme);
        
        if (themeIcon) {
            if (theme === 'light') {
                themeIcon.className = 'bi bi-sun-fill';
                body.className = 'bg-light text-dark';
                body.style.backgroundColor = '#FDFDFC';
            } else {
                themeIcon.className = 'bi bi-moon-fill';
                body.className = 'bg-dark text-light';
                body.style.backgroundColor = '#0a0a0a';
            }
        }
    }
    
    // Cookie utilities
    function setCookie(name, value, days) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
    }
    
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    
    // Accordion functionality for static pages
    const accordionButtons = document.querySelectorAll('[data-accordion-toggle]');
    accordionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-accordion-toggle');
            const target = document.getElementById(targetId);
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            // Close all other accordions
            accordionButtons.forEach(otherButton => {
                if (otherButton !== this) {
                    const otherId = otherButton.getAttribute('data-accordion-toggle');
                    const otherTarget = document.getElementById(otherId);
                    otherButton.setAttribute('aria-expanded', 'false');
                    if (otherTarget) {
                        otherTarget.style.display = 'none';
                    }
                }
            });
            
            // Toggle current accordion
            if (isExpanded) {
                this.setAttribute('aria-expanded', 'false');
                target.style.display = 'none';
            } else {
                this.setAttribute('aria-expanded', 'true');
                target.style.display = 'block';
            }
        });
    });
});
