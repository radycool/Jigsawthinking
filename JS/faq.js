document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize FAQ functionality when DOM is ready
    function initFAQ() {
        const faqContainers = document.querySelectorAll('.custom-faq-wrapper');
        
        faqContainers.forEach(container => {
            setupFAQInteractivity(container);
        });
    }
    
    function setupFAQInteractivity(container) {
        const faqItems = container.querySelectorAll('.custom-faq-item');
        const expandedContainer = container.querySelector('.custom-faq-expanded-container');
        const expandedQuestion = container.querySelector('.custom-faq-expanded-question');
        const expandedAnswer = container.querySelector('.custom-faq-expanded-answer');
        const faqDataElement = container.querySelector('.faq-data');
        
        if (!faqDataElement) {
            console.warn('FAQ data not found');
            return;
        }
        
        let faqData = [];
        try {
            faqData = JSON.parse(faqDataElement.textContent);
        } catch (e) {
            console.error('Error parsing FAQ data:', e);
            return;
        }
        
        let currentActiveIndex = -1;
        
        // Add click event to each FAQ item (only white boxes)
        faqItems.forEach((item, index) => {
            // Only add events to white boxes (those with data-index attribute)
            if (item.hasAttribute('data-index')) {
                const dataIndex = parseInt(item.getAttribute('data-index'));
                
                item.addEventListener('click', function() {
                    handleFAQClick(dataIndex);
                });
                
                // Add keyboard navigation
                item.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        handleFAQClick(dataIndex);
                    }
                });
                
                // Make items focusable
                item.setAttribute('role', 'button');
                item.setAttribute('aria-expanded', 'false');
            }
        });
        
        function handleFAQClick(index) {
            // If clicking the same item, toggle it
            if (currentActiveIndex === index) {
                closeFAQ();
                return;
            }
            
            // Remove active class from all items
            faqItems.forEach(item => {
                item.classList.remove('active');
                item.setAttribute('aria-expanded', 'false');
            });
            
            // Add active class to clicked item
            faqItems[index].classList.add('active');
            faqItems[index].setAttribute('aria-expanded', 'true');
            
            // Update expanded content
            const faqItem = faqData[index];
            if (faqItem) {
                updateExpandedContent(faqItem.faq_question, faqItem.faq_answer);
            }
            
            currentActiveIndex = index;
        }
        
        function closeFAQ() {
            // Remove active class from all items
            faqItems.forEach(item => {
                item.classList.remove('active');
                item.setAttribute('aria-expanded', 'false');
            });
            
            // Hide expanded container
            expandedContainer.classList.remove('show');
            currentActiveIndex = -1;
        }
        
        function updateExpandedContent(question, answer) {
            // Update content
            expandedQuestion.innerHTML = question;
            expandedAnswer.innerHTML = answer;
            
            // Show expanded container
            setTimeout(() => {
                expandedContainer.classList.add('show');
                
                // Scroll to expanded content smoothly
                expandedContainer.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 50);
        }
        
        // Add click outside to close functionality
        document.addEventListener('click', function(e) {
            if (!container.contains(e.target)) {
                closeFAQ();
            }
        });
        
        // Add escape key to close
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && currentActiveIndex !== -1) {
                closeFAQ();
            }
        });
    }
    
    // Initialize on load
    initFAQ();
    
    // Reinitialize when Elementor editor updates
    if (typeof elementor !== 'undefined') {
        elementor.hooks.addAction('panel/open_editor/widget/faq_grid', function() {
            setTimeout(initFAQ, 500);
        });
    }
    
    // Reinitialize for dynamic content loading
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                const addedNodes = Array.from(mutation.addedNodes);
                addedNodes.forEach(node => {
                    if (node.nodeType === 1 && node.querySelector && node.querySelector('.custom-faq-wrapper')) {
                        initFAQ();
                    }
                });
            }
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});

// Utility function to handle FAQ interactions programmatically
window.FAQController = {
    openFAQ: function(containerSelector, index) {
        const container = document.querySelector(containerSelector);
        if (!container) return;
        
        const faqItem = container.querySelector(`.custom-faq-item[data-index="${index}"]`);
        if (faqItem) {
            faqItem.click();
        }
    },
    
    closeFAQ: function(containerSelector) {
        const container = document.querySelector(containerSelector);
        if (!container) return;
        
        const activeItem = container.querySelector('.custom-faq-item.active');
        if (activeItem) {
            activeItem.click();
        }
    },
    
    getAllFAQs: function(containerSelector) {
        const container = document.querySelector(containerSelector);
        if (!container) return [];
        
        const faqDataElement = container.querySelector('.faq-data');
        if (!faqDataElement) return [];
        
        try {
            return JSON.parse(faqDataElement.textContent);
        } catch (e) {
            console.error('Error parsing FAQ data:', e);
            return [];
        }
    }
};