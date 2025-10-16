document.addEventListener('DOMContentLoaded', function() {
    
    // Smart Sticky Header with Custom Scroll Behavior
    class SmartStickyHeader {
        constructor() {
            this.header = document.querySelector('.custom-header.sticky-header');
            if (!this.header) return;
            
            this.lastScrollY = window.scrollY;
            this.ticking = false;
            this.scrollThreshold = 20; // Hide after 20px scroll up
            this.isVisible = true;
            
            this.init();
        }
        
        init() {
            // Initial state - header always visible at start
            this.header.classList.add('header-visible');
            
            // Bind scroll event with throttling
            window.addEventListener('scroll', () => {
                if (!this.ticking) {
                    requestAnimationFrame(() => {
                        this.handleScroll();
                        this.ticking = false;
                    });
                    this.ticking = true;
                }
            });
            
            // Handle resize
            window.addEventListener('resize', this.handleResize.bind(this));
        }
        
        handleScroll() {
            const currentScrollY = window.scrollY;
            const scrollDirection = currentScrollY > this.lastScrollY ? 'down' : 'up';
            
            // Show header when scrolling down (any section)
            if (scrollDirection === 'down') {
                this.showHeader();
            } 
            // Hide header when scrolling up and past threshold
            else if (scrollDirection === 'up' && currentScrollY > this.scrollThreshold) {
                this.hideHeader();
            }
            // Show header when at top (within threshold)
            else if (currentScrollY <= this.scrollThreshold) {
                this.showHeader();
            }
            
            this.lastScrollY = currentScrollY;
        }
        
        showHeader() {
            if (!this.isVisible) {
                this.header.classList.remove('header-hidden');
                this.header.classList.add('header-visible');
                this.header.style.transform = 'translateY(0)';
                this.isVisible = true;
            }
        }
        
        hideHeader() {
            if (this.isVisible) {
                this.header.classList.add('header-hidden');
                this.header.classList.remove('header-visible');
                this.header.style.transform = 'translateY(-100%)';
                this.isVisible = false;
            }
        }
        
        handleResize() {
            // Reset scroll position tracking on resize
            this.lastScrollY = window.scrollY;
        }
    }
    
    // Adaptive Colors
    class AdaptiveHeaderColors {
        constructor() {
            this.header = document.querySelector('.custom-header.adaptive-colors');
            if (!this.header) return;
            
            this.observer = null;
            this.currentTheme = 'light';
            
            this.init();
        }
        
        init() {
            // Create intersection observer to watch sections
            this.setupIntersectionObserver();
            
            // Initial check
            this.checkCurrentSection();
            
            // Handle scroll for more precise detection
            window.addEventListener('scroll', this.throttle(this.checkCurrentSection.bind(this), 100));
        }
        
        setupIntersectionObserver() {
            const options = {
                root: null,
                rootMargin: '-50% 0px -50% 0px', // Only trigger when section is in the middle of viewport
                threshold: 0
            };
            
            this.observer = new IntersectionObserver(this.handleIntersection.bind(this), options);
            
            // Observe all sections that might have different backgrounds
            const sections = document.querySelectorAll('section, .elementor-section, .wp-block-group, main');
            sections.forEach(section => {
                this.observer.observe(section);
            });
        }
        
        handleIntersection(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.analyzeSection(entry.target);
                }
            });
        }
        
        checkCurrentSection() {
            // Get the section that's currently at the header level
            const headerHeight = this.header.offsetHeight;
            const elementAtHeaderLevel = document.elementFromPoint(
                window.innerWidth / 2,
                headerHeight + 50
            );
            
            if (elementAtHeaderLevel) {
                const section = elementAtHeaderLevel.closest('section, .elementor-section, .wp-block-group, main, body');
                if (section) {
                    this.analyzeSection(section);
                }
            }
        }
        
        analyzeSection(section) {
            // Get computed styles
            const styles = window.getComputedStyle(section);
            const bgColor = styles.backgroundColor;
            const bgImage = styles.backgroundImage;
            
            let shouldUseDarkTheme = false;
            
            // Check for dark class names
            if (section.classList.contains('dark') || 
                section.classList.contains('dark-theme') ||
                section.classList.contains('bg-dark') ||
                section.classList.contains('dark-section')) {
                shouldUseDarkTheme = true;
            }
            
            // Check background color brightness
            if (bgColor && bgColor !== 'rgba(0, 0, 0, 0)' && bgColor !== 'transparent') {
                const brightness = this.getColorBrightness(bgColor);
                if (brightness < 128) {
                    shouldUseDarkTheme = true;
                }
            }
            
            // Check for background images with dark overlays
            if (bgImage && bgImage !== 'none') {
                // Look for overlay elements or dark gradient overlays
                const overlay = section.querySelector('.elementor-background-overlay, .overlay, .dark-overlay');
                if (overlay) {
                    const overlayStyles = window.getComputedStyle(overlay);
                    const overlayBg = overlayStyles.backgroundColor;
                    if (overlayBg) {
                        const overlayBrightness = this.getColorBrightness(overlayBg);
                        if (overlayBrightness < 128) {
                            shouldUseDarkTheme = true;
                        }
                    }
                }
            }
            
            // Apply theme
            this.setTheme(shouldUseDarkTheme ? 'dark' : 'light');
        }
        
        getColorBrightness(color) {
            // Convert color to RGB values
            let r, g, b;
            
            if (color.startsWith('rgb')) {
                const matches = color.match(/\d+/g);
                if (matches && matches.length >= 3) {
                    [r, g, b] = matches.map(Number);
                }
            } else if (color.startsWith('#')) {
                const hex = color.replace('#', '');
                r = parseInt(hex.substr(0, 2), 16);
                g = parseInt(hex.substr(2, 2), 16);
                b = parseInt(hex.substr(4, 2), 16);
            } else {
                return 128; // Default to medium brightness for unknown formats
            }
            
            // Calculate perceived brightness using the luminance formula
            return (r * 299 + g * 587 + b * 114) / 1000;
        }
        
        setTheme(theme) {
            if (this.currentTheme !== theme) {
                this.header.classList.remove('dark-theme', 'light-theme');
                this.header.classList.add(`${theme}-theme`);
                this.currentTheme = theme;
            }
        }
        
        throttle(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            }
        }
    }
    
    // Mobile Menu Toggle
    class MobileMenuToggle {
        constructor() {
            this.toggleBtn = document.querySelector('.mobile-menu-toggle');
            this.navMenu = document.querySelector('.nav-menu');
            
            if (!this.toggleBtn || !this.navMenu) return;
            
            this.isOpen = false;
            this.init();
        }
        
        init() {
            this.toggleBtn.addEventListener('click', this.toggleMenu.bind(this));
            
            // Close menu when clicking on nav links
            const navLinks = this.navMenu.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (this.isOpen) {
                        this.closeMenu();
                    }
                });
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', (e) => {
                if (this.isOpen && !e.target.closest('.header-navigation')) {
                    this.closeMenu();
                }
            });
            
            // Close menu on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isOpen) {
                    this.closeMenu();
                }
            });
            
            // Handle resize - close mobile menu if switching to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth > 768 && this.isOpen) {
                    this.closeMenu();
                }
            });
        }
        
        toggleMenu() {
            if (this.isOpen) {
                this.closeMenu();
            } else {
                this.openMenu();
            }
        }
        
        openMenu() {
            this.toggleBtn.classList.add('active');
            this.navMenu.classList.add('active');
            this.isOpen = true;
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
            
            // Focus management for accessibility
            const firstLink = this.navMenu.querySelector('.nav-link');
            if (firstLink) {
                setTimeout(() => firstLink.focus(), 300);
            }
        }
        
        closeMenu() {
            this.toggleBtn.classList.remove('active');
            this.navMenu.classList.remove('active');
            this.isOpen = false;
            
            // Restore body scroll
            document.body.style.overflow = '';
            
            // Return focus to toggle button
            this.toggleBtn.focus();
        }
    }
    
    // Smooth Scroll for Anchor Links
    class SmoothScroll {
        constructor() {
            this.init();
        }
        
        init() {
            // Handle anchor links
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', this.handleAnchorClick.bind(this));
            });
        }
        
        handleAnchorClick(e) {
            const href = e.currentTarget.getAttribute('href');
            
            // Skip if it's just '#'
            if (href === '#') return;
            
            const targetId = href.substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                e.preventDefault();
                
                // Calculate offset for fixed header
                const header = document.querySelector('.custom-header');
                const headerHeight = header ? header.offsetHeight : 0;
                const targetPosition = targetElement.offsetTop - headerHeight - 20;
                
                // Smooth scroll to target
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Update URL without jumping
                history.pushState(null, null, href);
            }
        }
    }
    
    // Performance optimization - Intersection Observer for animations
    class HeaderAnimations {
        constructor() {
            this.header = document.querySelector('.custom-header');
            if (!this.header) return;
            
            this.init();
        }
        
        init() {
            // Add entrance animation class after a short delay
            setTimeout(() => {
                this.header.classList.add('loaded');
            }, 100);
            
            // Add parallax effect to header on scroll (subtle)
            let ticking = false;
            window.addEventListener('scroll', () => {
                if (!ticking) {
                    requestAnimationFrame(() => {
                        this.updateHeaderParallax();
                        ticking = false;
                    });
                    ticking = true;
                }
            });
        }
        
        updateHeaderParallax() {
            const scrolled = window.scrollY;
            const header = this.header;
            
            // Very subtle parallax effect
            if (scrolled < 500) {
                const parallaxValue = scrolled * 0.1;
                header.style.transform = `translateY(${parallaxValue}px)`;
            }
        }
    }
    
    // Header Utilities and Debug Functions
    class HeaderUtils {
        static getCurrentSection() {
            const header = document.querySelector('.custom-header');
            if (!header) return null;
            
            const headerHeight = header.offsetHeight;
            const elementAtHeaderLevel = document.elementFromPoint(
                window.innerWidth / 2,
                headerHeight + 50
            );
            
            if (elementAtHeaderLevel) {
                return elementAtHeaderLevel.closest('section, .elementor-section, .wp-block-group, main, body');
            }
            return null;
        }
        
        static getHeaderState() {
            const header = document.querySelector('.custom-header');
            if (!header) return {};
            
            return {
                isVisible: !header.classList.contains('header-hidden'),
                isDarkTheme: header.classList.contains('dark-theme'),
                isSticky: header.classList.contains('sticky-header'),
                isAdaptive: header.classList.contains('adaptive-colors'),
                currentSection: this.getCurrentSection()?.tagName || 'unknown'
            };
        }
    }
    
    // Initialize all components
    function initHeader() {
        // Check if we're in Elementor editor mode
        const isElementorEditor = document.body.classList.contains('elementor-editor-active') ||
                                  window.location.search.includes('elementor-preview');
        
        if (!isElementorEditor) {
            new SmartStickyHeader();
            new AdaptiveHeaderColors();
            new MobileMenuToggle();
            new SmoothScroll();
            new HeaderAnimations();
            
            // Log initialization for debugging
            console.log('Custom Header: All components initialized');
        } else {
            // Simplified initialization for editor mode
            new MobileMenuToggle();
            console.log('Custom Header: Editor mode - limited initialization');
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHeader);
    } else {
        initHeader();
    }
    
    // Re-initialize when Elementor frontend loads
    window.addEventListener('elementor/frontend/init', function() {
        setTimeout(initHeader, 100);
        console.log('Custom Header: Re-initialized for Elementor frontend');
    });
    
    // Handle page transitions (for SPA-like behavior)
    let headerInstances = {};
    
    function reinitializeHeader() {
        // Clean up existing instances
        Object.keys(headerInstances).forEach(key => {
            if (headerInstances[key] && headerInstances[key].destroy) {
                headerInstances[key].destroy();
            }
        });
        
        // Reinitialize
        initHeader();
    }
    
    // Listen for AJAX page loads (common in modern WordPress themes)
    document.addEventListener('pjax:complete', reinitializeHeader);
    document.addEventListener('turbo:load', reinitializeHeader);
    
    // Global utility functions for debugging and external control
    window.customHeader = {
        utils: HeaderUtils,
        
        getCurrentTheme: function() {
            const header = document.querySelector('.custom-header');
            return header?.classList.contains('dark-theme') ? 'dark' : 'light';
        },
        
        forceTheme: function(theme) {
            const header = document.querySelector('.custom-header');
            if (header) {
                header.classList.remove('dark-theme', 'light-theme');
                header.classList.add(`${theme}-theme`);
                console.log(`Custom Header: Theme forced to ${theme}`);
            }
        },
        
        resetTheme: function() {
            const adaptiveInstance = new AdaptiveHeaderColors();
            adaptiveInstance.checkCurrentSection();
            console.log('Custom Header: Theme reset to adaptive');
        },
        
        toggleSticky: function() {
            const header = document.querySelector('.custom-header');
            if (header) {
                header.classList.toggle('sticky-header');
                console.log('Custom Header: Sticky toggled');
            }
        },
        
        getState: function() {
            return HeaderUtils.getHeaderState();
        },
        
        reinit: reinitializeHeader,
        
        version: '1.0.0'
    };
    
    // Performance monitoring (remove in production)
    if (window.performance && console.time) {
        console.time('Header Initialization');
        setTimeout(() => {
            console.timeEnd('Header Initialization');
            console.log('Custom Header: Initialization complete', window.customHeader.getState());
        }, 1000);
    }
    
});