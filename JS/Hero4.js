/**
 * HERO4 WIDGET - EXACT WIPE UP REVEAL ANIMATION
 * =============================================
 */

class Hero4Animation {
    constructor() {
        this.isInitialized = false;
        this.animationInProgress = false;
        this.revealElements = [];
        this.images = [];
        
        this.init();
    }

    init() {
        if (this.isInitialized) return;
        
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupAnimation());
        } else {
            // Small delay to ensure styles are loaded
            setTimeout(() => this.setupAnimation(), 100);
        }
        
        this.isInitialized = true;
    }

    setupAnimation() {
        // Cache DOM elements
        this.images = document.querySelectorAll('.hero4-img');
        this.textElement = document.querySelector('.hero4-text');
        this.container = document.querySelector('.hero4-container');

        if (!this.container) {
            console.log('Hero4 container not found');
            return;
        }

        console.log('Hero4: Found', this.images.length, 'images and text element:', !!this.textElement);

        // Start the wipe reveal sequence immediately
        this.startWipeRevealSequence();
        
        // Setup event listeners
        this.setupEventListeners();
        
        // Preload images
        this.preloadImages();
    }

    startWipeRevealSequence() {
        this.animationInProgress = true;
        
        console.log('Hero4: Starting wipe reveal sequence');
        
        // Reveal text first (almost immediately)
        if (this.textElement) {
            setTimeout(() => {
                this.textElement.classList.add('revealed');
                console.log('Hero4: Text revealed');
            }, 300);
        }
        
        // Reveal images with staggered timing
        this.images.forEach((img, index) => {
            const delays = [600, 900, 1200, 1500]; // Staggered delays
            const delay = delays[index] || 600 + (index * 300);
            
            setTimeout(() => {
                img.classList.add('revealed');
                console.log(`Hero4: Image ${index + 1} revealed`);
                
                // Add subtle floating after reveal
                setTimeout(() => {
                    this.addSubtleFloating(img);
                }, 500);
                
            }, delay);
        });

        // Animation complete
        setTimeout(() => {
            this.animationInProgress = false;
            console.log('Hero4: Animation sequence complete');
        }, 2500);
    }

    addSubtleFloating(element) {
        // Floating animation is handled by CSS
        element.classList.add('floating');
    }

    setupEventListeners() {
        // Subtle mouse parallax effect
        let mouseMoveTimeout;
        document.addEventListener('mousemove', (e) => {
            if (this.animationInProgress) return;
            
            clearTimeout(mouseMoveTimeout);
            mouseMoveTimeout = setTimeout(() => {
                this.handleMouseMove(e);
            }, 16); // ~60fps throttling
        });
        
        // Window resize handler
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                this.handleResize();
            }, 250);
        });
        
        // Image hover effects
        this.images.forEach((img, index) => {
            img.addEventListener('mouseenter', () => {
                img.style.zIndex = '5';
                img.style.transform = 'translateY(-3px)';
            });
            
            img.addEventListener('mouseleave', () => {
                img.style.zIndex = '';
                img.style.transform = '';
            });
        });

        // Keyboard shortcuts for debugging
        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey && e.key.toLowerCase() === 'r') {
                e.preventDefault();
                this.resetAnimation();
            }
        });

        // Intersection observer for scroll-based re-animation
        this.setupScrollObserver();
    }

    handleMouseMove(e) {
        const revealedImages = document.querySelectorAll('.hero4-img.revealed');
        const mouseX = (e.clientX / window.innerWidth) - 0.5;
        const mouseY = (e.clientY / window.innerHeight) - 0.5;
        
        revealedImages.forEach((img, index) => {
            const intensity = 4 + (index * 1); // Very subtle movement
            const moveX = mouseX * intensity;
            const moveY = mouseY * intensity;
            
            // Apply transform while preserving existing transforms
            const currentTransform = img.style.transform || '';
            const baseTransform = currentTransform.replace(/translate\([^)]*\)/g, '');
            img.style.transform = `${baseTransform} translate(${moveX}px, ${moveY}px)`;
        });
    }

    handleResize() {
        // Reset transforms on resize
        this.images.forEach(img => {
            const transform = img.style.transform;
            if (transform) {
                img.style.transform = transform.replace(/translate\([^)]*\)/g, '');
            }
        });
    }

    setupScrollObserver() {
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px 0px -100px 0px'
        };

        this.scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-viewport');
                } else {
                    entry.target.classList.remove('in-viewport');
                }
            });
        }, observerOptions);

        if (this.container) {
            this.scrollObserver.observe(this.container);
        }
    }

    preloadImages() {
        const imageUrls = [];
        this.images.forEach(imgContainer => {
            const img = imgContainer.querySelector('img');
            if (img && img.src) {
                imageUrls.push(img.src);
            }
        });

        // Preload images for smoother animation
        imageUrls.forEach(url => {
            const img = new Image();
            img.src = url;
        });

        console.log('Hero4: Preloaded', imageUrls.length, 'images');
    }

    resetAnimation() {
        console.log('Hero4: Resetting animation');
        
        // Remove revealed classes
        this.images.forEach(img => {
            img.classList.remove('revealed', 'floating');
        });
        
        if (this.textElement) {
            this.textElement.classList.remove('revealed');
        }

        // Restart animation
        setTimeout(() => {
            this.startWipeRevealSequence();
        }, 200);
    }

    // Cleanup method
    destroy() {
        document.removeEventListener('mousemove', this.handleMouseMove);
        window.removeEventListener('resize', this.handleResize);
        document.removeEventListener('keydown', this.handleKeydown);

        if (this.scrollObserver) {
            this.scrollObserver.disconnect();
        }

        this.isInitialized = false;
        console.log('Hero4: Animation destroyed');
    }
}

// Transform cleanup utility
function startTransformCleanup() {
    setInterval(() => {
        const images = document.querySelectorAll('.hero4-img');
        images.forEach(img => {
            const transform = img.style.transform;
            if (transform && transform.includes('translate')) {
                // Clean up accumulated transforms but keep base transforms
                const cleanTransform = transform.replace(/translate\([^)]*\)/g, '');
                if (cleanTransform.trim() === '') {
                    img.style.transform = '';
                } else {
                    img.style.transform = cleanTransform;
                }
            }
        });
    }, 200);
}

// Initialize Hero4 Animation
(function() {
    let hero4Instance = null;

    function initHero4() {
        // Check if Hero4 elements exist
        const hero4Container = document.querySelector('.hero4-container');
        if (hero4Container) {
            console.log('Hero4: Initializing animation');
            
            // Respect reduced motion preferences
            if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                hero4Instance = new Hero4Animation();
                startTransformCleanup();
            } else {
                console.log('Hero4: Reduced motion detected, skipping animations');
            }
        } else {
            console.log('Hero4: Container not found, skipping initialization');
        }
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHero4);
    } else {
        initHero4();
    }

    // Re-initialize for Elementor editor
    if (typeof elementor !== 'undefined') {
        elementor.hooks.addAction('panel/open_editor/widget/hero4', function() {
            console.log('Hero4: Elementor editor opened, reinitializing');
            setTimeout(() => {
                if (hero4Instance) {
                    hero4Instance.destroy();
                }
                initHero4();
            }, 500);
        });
    }

    // Cleanup on page unload
    window.addEventListener('beforeunload', () => {
        if (hero4Instance) {
            hero4Instance.destroy();
        }
    });

})();

// Export for debugging
if (typeof window !== 'undefined') {
    window.Hero4Animation = Hero4Animation;
}