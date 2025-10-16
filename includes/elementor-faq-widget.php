<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_FAQ_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'faq_grid';
    }

    public function get_title() {
        return __('FAQ Grid', 'textdomain');
    }

    public function get_icon() {
        return 'eicon-help-o';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_script_depends() {
        return [];
    }

    public function get_style_depends() {
        return [];
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('FAQ Content', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'faq_title',
            [
                'label' => __('Section Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('FAQ', 'textdomain'),
                'placeholder' => __('Enter section title', 'textdomain'),
            ]
        );

        $this->add_control(
            'faq_subtitle',
            [
                'label' => __('Section Subtitle', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Any queries you might have', 'textdomain'),
                'placeholder' => __('Enter section subtitle', 'textdomain'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'faq_question',
            [
                'label' => __('Question', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Your question here', 'textdomain'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'faq_answer',
            [
                'label' => __('Answer', 'textdomain'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Your detailed answer here', 'textdomain'),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'faq_list',
            [
                'label' => __('FAQ Items (Exactly 5 for white boxes)', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'faq_question' => __('How does the coaching program work?', 'textdomain'),
                        'faq_answer' => __('Our coaching program is designed to help you achieve your goals through personalized guidance and support.', 'textdomain'),
                    ],
                    [
                        'faq_question' => __('How long is the program?', 'textdomain'),
                        'faq_answer' => __('The standard program duration is 12 weeks, customizable to your needs.', 'textdomain'),
                    ],
                    [
                        'faq_question' => __('What is included in the program?', 'textdomain'),
                        'faq_answer' => __('The program includes weekly sessions, resources, and ongoing support.', 'textdomain'),
                    ],
                    [
                        'faq_question' => __('How often are sessions?', 'textdomain'),
                        'faq_answer' => __('Sessions are typically scheduled weekly or bi-weekly based on your preference.', 'textdomain'),
                    ],
                    [
                        'faq_question' => __('Can I get a refund?', 'textdomain'),
                        'faq_answer' => __('Yes, we offer a 30-day money-back guarantee.', 'textdomain'),
                    ],
                ],
                'title_field' => '{{{ faq_question }}}',
                'max_items' => 5,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if (empty($settings['faq_list'])) {
            return;
        }

        // Limit to 5 items for the white boxes
        $faq_items = array_slice($settings['faq_list'], 0, 5);
        
        // Create exactly 9 boxes - 5 with questions, 4 empty
        $all_boxes = [];
        $question_index = 0;
        
        for ($i = 1; $i <= 9; $i++) {
            $is_white_box = in_array($i, [1, 3, 5, 7, 9]); // White box positions
            
            if ($is_white_box && $question_index < count($faq_items)) {
                $all_boxes[] = [
                    'question' => $faq_items[$question_index]['faq_question'],
                    'answer' => $faq_items[$question_index]['faq_answer'],
                    'has_content' => true,
                    'data_index' => $question_index
                ];
                $question_index++;
            } else {
                $all_boxes[] = [
                    'question' => '',
                    'answer' => '',
                    'has_content' => false,
                    'data_index' => -1
                ];
            }
        }
        
        $unique_id = 'faq-' . uniqid();
        ?>
        
        <div class="custom-faq-wrapper" id="<?php echo esc_attr($unique_id); ?>">
            <!-- Inline Critical CSS -->
            <style>
                .custom-faq-wrapper {
                    width: 100%;
                    margin: 0 auto;
                    padding: 40px 0;
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                }
                
                .custom-faq-main-layout {
                    display: flex;
                    gap: 0;
                    align-items: flex-start;
                    border: 2px solid #000;
                    width: 100%;
                    max-width: none;
                }
                
                /* Left Side - Large FAQ Box */
                .custom-faq-info-box {
                    background: #000;
                    color: #fff;
                    width: 40%;
                    min-width: 300px;
                    height: 450px;
                    padding: 40px;
                    box-sizing: border-box;
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-start;
                    flex-shrink: 0;
                }
                
                .custom-faq-info-title {
                    font-size: 4rem;
                    font-weight: 900;
                    color: #fff;
                    margin: 0 0 20px 0;
                    letter-spacing: 0.5rem;
                    text-transform: uppercase;
                    line-height: 1;
                }
                
                .custom-faq-info-subtitle {
                    font-size: 1rem;
                    color: #ccc;
                    margin: 0;
                    font-weight: 300;
                    line-height: 1.4;
                }
                
                /* Right Side - 3x3 Grid */
                .custom-faq-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    grid-template-rows: repeat(3, 150px);
                    gap: 15px;
                    flex-grow: 1;
                    height: 450px;
                    position: relative;
                    overflow: visible;
                    padding: 15px;
                    box-sizing: border-box;
                }
                
                .custom-faq-item {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    padding: 12px;
                    box-sizing: border-box;
                    position: relative;
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                    border: none;
                    font-size: 0.85rem;
                    font-weight: 600;
                    text-align: center;
                    line-height: 1.3;
                    overflow-wrap: break-word;
                    hyphens: auto;
                    min-height: 100px;
                }
                
                /* Remove internal borders for grid */
                .custom-faq-item:not(:nth-child(3n)) {
                    border-right: none;
                }
                
                .custom-faq-item:nth-child(-n+6) {
                    border-bottom: none;
                }
                
                /* White boxes with questions (odd positions) */
                .custom-faq-item:nth-child(1),
                .custom-faq-item:nth-child(3),
                .custom-faq-item:nth-child(5),
                .custom-faq-item:nth-child(7),
                .custom-faq-item:nth-child(9) {
                    background: #ffffff;
                    color: #000;
                    border-radius: 12px;
                    border: none !important;
                }
                
                /* Black boxes - empty (even positions) */
                .custom-faq-item:nth-child(2),
                .custom-faq-item:nth-child(4),
                .custom-faq-item:nth-child(6),
                .custom-faq-item:nth-child(8) {
                    background: #000000;
                    color: #ffffff;
                }
                
                /* Hide text in black boxes */
                .custom-faq-item:nth-child(2),
                .custom-faq-item:nth-child(4),
                .custom-faq-item:nth-child(6),
                .custom-faq-item:nth-child(8) {
                    font-size: 0;
                    cursor: default;
                    pointer-events: none;
                }
                
                .custom-faq-item:hover:not(:nth-child(2)):not(:nth-child(4)):not(:nth-child(6)):not(:nth-child(8)) {
                    opacity: 0.8;
                    transform: scale(0.98);
                }
                
                /* Active/Expanded state - now using clone approach */
                .custom-faq-item.active {
                    opacity: 0.3;
                }
                
                /* Expanded clone overlay */
                .faq-active-clone {
                    background: #fff !important;
                    border: none !important;
                    border-radius: 20px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    padding: 25px;
                    font-size: 1rem;
                    line-height: 1.5;
                    text-align: center;
                    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
                    overflow: auto;
                    cursor: pointer;
                    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                    pointer-events: auto;
                    position: relative;
                }
                
                /* Close button for expanded clone */
                .faq-close-btn {
                    position: absolute;
                    top: 15px;
                    right: 15px;
                    width: 32px;
                    height: 32px;
                    background: #000;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    z-index: 10;
                }
                
                .faq-close-btn:hover {
                    background: #333;
                    transform: rotate(90deg);
                }
                
                .faq-close-btn::before,
                .faq-close-btn::after {
                    content: '';
                    position: absolute;
                    width: 16px;
                    height: 2px;
                    background: #fff;
                }
                
                .faq-close-btn::before {
                    transform: rotate(45deg);
                }
                
                .faq-close-btn::after {
                    transform: rotate(-45deg);
                }
                
                /* Expanded Answer Area - Below the layout */
                .custom-faq-expanded-container {
                    margin-top: 40px;
                    max-height: 0;
                    overflow: hidden;
                    opacity: 0;
                    transform: translateY(-20px);
                    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                }
                
                .custom-faq-expanded-container.show {
                    max-height: 100vh;
                    opacity: 1;
                    transform: translateY(0);
                }
                
                .custom-faq-expanded {
                    background: #f8f8f8;
                    border: 2px solid #000;
                    padding: 30px;
                    box-sizing: border-box;
                    min-height: 100px;
                }
                
                .custom-faq-expanded-question {
                    font-size: 1.5rem;
                    font-weight: 700;
                    margin-bottom: 20px;
                    color: #000;
                    line-height: 1.3;
                }
                
                .custom-faq-expanded-answer {
                    font-size: 1rem;
                    line-height: 1.8;
                    color: #333;
                }
                
                .custom-faq-expanded-answer p {
                    margin-bottom: 15px;
                }
                
                .custom-faq-expanded-answer p:last-child {
                    margin-bottom: 0;
                }
                
                /* Responsive Design */
                @media (max-width: 768px) {
                    .custom-faq-main-layout {
                        flex-direction: column;
                    }
                    
                    .custom-faq-info-box {
                        width: 100%;
                        height: auto;
                        min-height: 200px;
                    }
                    
                    .custom-faq-info-title {
                        font-size: 3rem;
                    }
                    
                    .custom-faq-grid {
                        grid-template-columns: repeat(3, 120px);
                        grid-template-rows: repeat(3, 120px);
                        margin: 0 auto;
                        height: 360px;
                    }
                    
                    .custom-faq-item {
                        font-size: 0.7rem;
                    }
                    
                    .custom-faq-item.active {
                        font-size: 0.85rem;
                    }
                }
                
                @media (max-width: 480px) {
                    .custom-faq-grid {
                        grid-template-columns: repeat(3, 100px);
                        grid-template-rows: repeat(3, 100px);
                        height: 300px;
                    }
                    
                    .custom-faq-item {
                        font-size: 0.65rem;
                        padding: 8px;
                    }
                    
                    .custom-faq-item.active {
                        font-size: 0.75rem;
                    }
                    
                    .custom-faq-info-title {
                        font-size: 2.5rem;
                    }
                    
                    .custom-faq-expanded-question {
                        font-size: 1.2rem;
                    }
                }
            </style>
            
            <div class="custom-faq-main-layout">
                <!-- Left: Large FAQ Info Box -->
                <div class="custom-faq-info-box">
                    <h2 class="custom-faq-info-title"><?php echo esc_html($settings['faq_title']); ?></h2>
                    <p class="custom-faq-info-subtitle"><?php echo esc_html($settings['faq_subtitle']); ?></p>
                </div>
                
                <!-- Right: 3x3 Grid of Questions -->
                <div class="custom-faq-grid">
                    <?php foreach ($all_boxes as $index => $box) : ?>
                        <div class="custom-faq-item" 
                             <?php if ($box['has_content']) : ?>
                                data-index="<?php echo $box['data_index']; ?>" 
                                tabindex="0" 
                                role="button" 
                                aria-expanded="false"
                                aria-controls="faq-expanded-<?php echo esc_attr($unique_id); ?>"
                             <?php endif; ?>>
                            <?php echo esc_html($box['question']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Expanded Answer Area -->
            <div class="custom-faq-expanded-container" id="faq-expanded-<?php echo esc_attr($unique_id); ?>">
                <div class="custom-faq-expanded">
                    <div class="custom-faq-expanded-question"></div>
                    <div class="custom-faq-expanded-answer"></div>
                </div>
            </div>
            
            <!-- FAQ Data -->
            <script type="application/json" class="faq-data-<?php echo esc_attr($unique_id); ?>">
                <?php echo wp_json_encode($faq_items); ?>
            </script>
            
            <!-- Initialize FAQ functionality -->
            <script>
                (function() {
                    function initFAQ() {
                        const wrapper = document.getElementById('<?php echo esc_js($unique_id); ?>');
                        if (!wrapper) return;
                        
                        const faqDataEl = wrapper.querySelector('.faq-data-<?php echo esc_js($unique_id); ?>');
                        if (!faqDataEl) return;
                        
                        const faqItems = JSON.parse(faqDataEl.textContent);
                        
                        // Debug: Check if FAQ data is loaded correctly
                        console.log('FAQ Items loaded:', faqItems);
                        
                        const boxes = wrapper.querySelectorAll('.custom-faq-item[data-index]');
                        const gridContainer = wrapper.querySelector('.custom-faq-grid');
                        const expandedContainer = wrapper.querySelector('.custom-faq-expanded-container');
                        const expandedQuestion = wrapper.querySelector('.custom-faq-expanded-question');
                        const expandedAnswer = wrapper.querySelector('.custom-faq-expanded-answer');
                        
                        if (!expandedContainer || !expandedQuestion || !expandedAnswer || !gridContainer) return;
                        
                        let currentClone = null;
                        
                        boxes.forEach(box => {
                            box.addEventListener('click', function() {
                                const index = parseInt(this.dataset.index);
                                
                                if (isNaN(index) || index < 0 || index >= faqItems.length) return;
                                
                                const faq = faqItems[index];
                                
                                // If clicking the same active box, close everything
                                if (this.classList.contains('active')) {
                                    if (currentClone) {
                                        currentClone.remove();
                                        currentClone = null;
                                    }
                                    boxes.forEach(b => b.classList.remove('active'));
                                    expandedContainer.classList.remove('show');
                                    this.setAttribute('aria-expanded', 'false');
                                    return;
                                }
                                
                                // Remove any previous clone
                                if (currentClone) {
                                    currentClone.remove();
                                }
                                
                                // Remove active from all boxes
                                boxes.forEach(b => {
                                    b.classList.remove('active');
                                    b.setAttribute('aria-expanded', 'false');
                                });
                                
                                // Mark original box as active (faded)
                                this.classList.add('active');
                                this.setAttribute('aria-expanded', 'true');
                                
                                // Create clone for expansion
                                const clone = document.createElement('div');
                                clone.classList.add('faq-active-clone');
                                
                                // Add close button
                                const closeBtn = document.createElement('div');
                                closeBtn.classList.add('faq-close-btn');
                                closeBtn.setAttribute('aria-label', 'Close');
                                
                                // Add question + answer inside the clone
                                clone.innerHTML = `
                                    <div class="faq-clone-question" style="font-weight:700; font-size:1.2rem; margin-bottom:15px;">${faq.faq_question}</div>
                                    <div class="faq-clone-answer" style="font-size:1rem; line-height:1.6; text-align:center;">${faq.faq_answer}</div>
                                `;
                                
                                // Prepend close button to clone
                                clone.insertBefore(closeBtn, clone.firstChild);
                                
                                // Get position relative to grid container with scroll offsets
                                const boxRect = this.getBoundingClientRect();
                                const gridRect = gridContainer.getBoundingClientRect();
                                
                                // Calculate position relative to grid (accounting for scroll)
                                const relativeTop = boxRect.top - gridRect.top + gridContainer.scrollTop;
                                const relativeLeft = boxRect.left - gridRect.left + gridContainer.scrollLeft;
                                
                                // Set initial position and size
                                clone.style.position = 'absolute';
                                clone.style.top = relativeTop + 'px';
                                clone.style.left = relativeLeft + 'px';
                                clone.style.width = boxRect.width + 'px';
                                clone.style.height = boxRect.height + 'px';
                                clone.style.zIndex = '20';
                                
                                // Add click handler to close button
                                closeBtn.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    boxes.forEach(b => b.classList.remove('active'));
                                    expandedContainer.classList.remove('show');
                                    clone.remove();
                                    currentClone = null;
                                });
                                
                                // Also keep the clone click handler for closing anywhere on the box
                                clone.addEventListener('click', function(e) {
                                    // Don't close if clicking the close button (it has its own handler)
                                    if (e.target.classList.contains('faq-close-btn')) return;
                                    
                                    e.stopPropagation();
                                    boxes.forEach(b => b.classList.remove('active'));
                                    expandedContainer.classList.remove('show');
                                    this.remove();
                                    currentClone = null;
                                });
                                
                                // Check for video elements and play them
                                const video = clone.querySelector('video');
                                if (video) {
                                    video.play().catch(err => console.log('Video autoplay prevented:', err));
                                }
                                
                                gridContainer.appendChild(clone);
                                currentClone = clone;
                                
                                // Trigger expansion after a brief moment
                                requestAnimationFrame(() => {
                                    requestAnimationFrame(() => {
                                        // Calculate expanded size (3x3 grid cells - full grid)
                                        const cellWidth = (gridRect.width - 60) / 3; // Account for padding and gaps
                                        const cellHeight = 150;
                                        const gapSize = 15;
                                        
                                        // Make it 3x3 (full grid width and height)
                                        clone.style.width = (cellWidth * 3 + gapSize * 2) + 'px';
                                        clone.style.height = (cellHeight * 3 + gapSize * 2) + 'px';
                                        
                                        // Center it in the grid
                                        clone.style.top = '15px';
                                        clone.style.left = '15px';
                                    });
                                });
                                
                                // Update answer content
                                expandedQuestion.textContent = faq.faq_question;
                                expandedAnswer.innerHTML = faq.faq_answer;
                                
                                // Debug: Check if answer content is being set
                                console.log('Question:', faq.faq_question);
                                console.log('Answer:', faq.faq_answer);
                                console.log('Answer element:', expandedAnswer);
                                
                                // Show expanded container
                                expandedContainer.classList.add('show');
                                
                                // Force visibility check
                                setTimeout(() => {
                                    console.log('Container visible:', expandedContainer.classList.contains('show'));
                                    console.log('Container max-height:', window.getComputedStyle(expandedContainer).maxHeight);
                                }, 100);
                                
                                // Smooth scroll to answer after animation
                                setTimeout(() => {
                                    expandedContainer.scrollIntoView({ 
                                        behavior: 'smooth', 
                                        block: 'nearest' 
                                    });
                                }, 500);
                            });
                            
                            // Keyboard accessibility
                            box.addEventListener('keypress', function(e) {
                                if (e.key === 'Enter' || e.key === ' ') {
                                    e.preventDefault();
                                    this.click();
                                }
                            });
                        });
                    }
                    
                    // Initialize immediately if DOM is ready
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', initFAQ);
                    } else {
                        initFAQ();
                    }
                    
                    // Also initialize on Elementor preview refresh
                    if (typeof jQuery !== 'undefined') {
                        jQuery(window).on('elementor/frontend/init', initFAQ);
                    }
                })();
            </script>
        </div>
        
        <?php
    }

    protected function content_template() {
        ?>
        <# if ( settings.faq_list.length ) { 
            var faqItems = settings.faq_list.slice(0, 5);
            var allBoxes = [];
            var questionIndex = 0;
            
            // Create 9 boxes with proper distribution
            for (var i = 1; i <= 9; i++) {
                var isWhiteBox = [1, 3, 5, 7, 9].includes(i);
                
                if (isWhiteBox && questionIndex < faqItems.length) {
                    allBoxes.push({
                        question: faqItems[questionIndex].faq_question,
                        hasContent: true,
                        dataIndex: questionIndex
                    });
                    questionIndex++;
                } else {
                    allBoxes.push({
                        question: '',
                        hasContent: false,
                        dataIndex: -1
                    });
                }
            }
        #>
            <div class="custom-faq-wrapper">
                <div class="custom-faq-main-layout">
                    <div class="custom-faq-info-box">
                        <h2 class="custom-faq-info-title">{{{ settings.faq_title }}}</h2>
                        <p class="custom-faq-info-subtitle">{{{ settings.faq_subtitle }}}</p>
                    </div>
                    
                    <div class="custom-faq-grid">
                        <# _.each( allBoxes, function( box, index ) { #>
                            <div class="custom-faq-item" 
                                 <# if (box.hasContent) { #>
                                    data-index="{{ box.dataIndex }}"
                                 <# } #>>
                                {{{ box.question }}}
                            </div>
                        <# }); #>
                    </div>
                </div>
                
                <div class="custom-faq-expanded-container">
                    <div class="custom-faq-expanded">
                        <div class="custom-faq-expanded-question"></div>
                        <div class="custom-faq-expanded-answer"></div>
                    </div>
                </div>
            </div>
        <# } #>
        <?php
    }
}

// Register the widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor_FAQ_Widget());