(function() {
    'use strict';
    
    function initStackedCards() {
        var sections = document.querySelectorAll('.gaspar-stack-section');
        
        sections.forEach(function(section) {
            var cards = section.querySelectorAll('.gaspar-card');
            if (cards.length === 0) return;
            
            var cardSpacing = parseFloat(section.dataset.spacing) || 40;
            var scaleReduction = parseFloat(section.dataset.scaleReduction) || 4;
            
            function updateCards() {
                var scrollY = window.pageYOffset;
                var sectionTop = section.offsetTop;
                var sectionHeight = section.offsetHeight;
                var viewportHeight = window.innerHeight;
                var scrollProgress = Math.max(0, Math.min(1, (scrollY - sectionTop) / (sectionHeight - viewportHeight)));
                var cardSegment = 1 / cards.length;
                
                cards.forEach(function(card, index) {
                    var cardStart = index * cardSegment;
                    var cardEnd = (index + 1) * cardSegment;
                    var baseZIndex = cards.length - index;
                    
                    if (scrollProgress < cardStart) {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(60px) scale(1)';
                        card.style.zIndex = baseZIndex;
                    } else if (scrollProgress >= cardStart && scrollProgress < cardEnd) {
                        var cardProgress = (scrollProgress - cardStart) / cardSegment;
                        card.style.zIndex = cards.length;
                        
                        if (cardProgress < 0.5) {
                            var entranceEase = cardProgress / 0.5;
                            card.style.opacity = entranceEase;
                            card.style.transform = 'translateY(' + ((1 - entranceEase) * 60) + 'px) scale(1)';
                        } else {
                            var stackEase = (cardProgress - 0.5) / 0.5;
                            var targetY = -(index * cardSpacing);
                            var targetScale = 1 - (index * (scaleReduction / 100));
                            var currentY = targetY * stackEase;
                            var currentScale = 1 - ((1 - targetScale) * stackEase);
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(' + currentY + 'px) scale(' + currentScale + ')';
                        }
                    } else {
                        var stackY = -(index * cardSpacing);
                        var stackScale = 1 - (index * (scaleReduction / 100));
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(' + stackY + 'px) scale(' + stackScale + ')';
                        card.style.zIndex = baseZIndex;
                    }
                });
            }
            
            var rafId = null;
            window.addEventListener('scroll', function() {
                if (rafId) return;
                rafId = requestAnimationFrame(function() {
                    updateCards();
                    rafId = null;
                });
            }, { passive: true });
            
            window.addEventListener('resize', updateCards);
            updateCards();
        });
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initStackedCards);
    } else {
        initStackedCards();
    }
})();