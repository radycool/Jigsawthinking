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
        return ['faq-script'];
    }

    public function get_style_depends() {
        return ['faq-style'];
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
                        'faq_question' => __('How long is the program?', 'textdomain'),
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
        ?>
        
        <div class="custom-faq-wrapper">
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
                    gap: 0;
                    flex-grow: 1;
                    height: 450px;
                }
                
                .custom-faq-item {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    padding: 15px;
                    box-sizing: border-box;
                    position: relative;
                    transition: all 0.3s ease;
                    border: none;
                    font-size: 0.85rem;
                    font-weight: 600;
                    text-align: center;
                    line-height: 1.2;
                    word-break: break-word;
                }
                
                /* Internal borders for grid */
                .custom-faq-item:not(:nth-child(3n)) {
                    border-right: 2px solid #000;
                }
                
                .custom-faq-item:nth-child(-n+6) {
                    border-bottom: 2px solid #000;
                }
                
                /* White boxes with questions (odd positions) */
                .custom-faq-item:nth-child(1),
                .custom-faq-item:nth-child(3),
                .custom-faq-item:nth-child(5),
                .custom-faq-item:nth-child(7),
                .custom-faq-item:nth-child(9) {
                    background: #ffffff;
                    color: #000;
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
                
                .custom-faq-item:hover {
                    opacity: 0.8;
                    transform: scale(0.95);
                }
                
                /* Only allow hover on white boxes */
                .custom-faq-item:nth-child(2):hover,
                .custom-faq-item:nth-child(4):hover,
                .custom-faq-item:nth-child(6):hover,
                .custom-faq-item:nth-child(8):hover {
                    opacity: 1;
                    transform: none;
                }
                
                .custom-faq-item.active {
                    transform: scale(0.9);
                    box-shadow: inset 0 0 0 4px #ff6b6b;
                }
                
                /* Expanded Answer Area - Below the layout */
                .custom-faq-expanded-container {
                    margin-top: 40px;
                    opacity: 0;
                    transform: translateY(20px);
                    transition: all 0.4s ease;
                }
                
                .custom-faq-expanded-container.show {
                    opacity: 1;
                    transform: translateY(0);
                }
                
                .custom-faq-expanded {
                    background: #f8f8f8;
                    border: 2px solid #000;
                    padding: 30px;
                    box-sizing: border-box;
                }
                
                .custom-faq-expanded-question {
                    font-size: 1.2rem;
                    font-weight: 600;
                    margin-bottom: 15px;
                    color: #000;
                }
                
                .custom-faq-expanded-answer {
                    font-size: 1rem;
                    line-height: 1.6;
                    color: #333;
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
                    }
                    
                    .custom-faq-item {
                        width: 120px;
                        height: 120px;
                        font-size: 0.7rem;
                    }
                }
                
                @media (max-width: 480px) {
                    .custom-faq-grid {
                        grid-template-columns: repeat(3, 100px);
                        grid-template-rows: repeat(3, 100px);
                    }
                    
                    .custom-faq-item {
                        width: 100px;
                        height: 100px;
                        font-size: 0.65rem;
                        padding: 8px;
                    }
                    
                    .custom-faq-info-title {
                        font-size: 2.5rem;
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
                             <?php endif; ?>>
                            <?php echo esc_html($box['question']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Expanded Answer Area -->
            <div class="custom-faq-expanded-container">
                <div class="custom-faq-expanded">
                    <div class="custom-faq-expanded-question"></div>
                    <div class="custom-faq-expanded-answer"></div>
                </div>
            </div>
            
            <!-- FAQ Data -->
            <script type="application/json" class="faq-data">
                <?php echo json_encode($faq_items); ?>
            </script>
            
            <!-- Initialize FAQ functionality -->
            <script>
                (function() {
                    function initThisFAQ() {
                        const container = document.querySelector('.custom-faq-wrapper:last-of-type');
                        if (!container) return;
                        
                        console.log('Initializing FAQ widget...');
                        
                        const faqItems = container.querySelectorAll('.custom-faq-item[data-index]');
                        const expandedContainer = container.querySelector('.custom-faq-expanded-container');
                        const expandedQuestion = container.querySelector('.custom-faq-expanded-question');
                        const expandedAnswer = container.querySelector('.custom-faq-expanded-answer');
                        const faqDataElement = container.querySelector('.faq-data');
                        
                        if (!faqDataElement || !expandedContainer) {
                            console.log('Missing FAQ elements');
                            return;
                        }
                        
                        let faqData = [];
                        try {
                            faqData = JSON.parse(faqDataElement.textContent);
                        } catch (e) {
                            console.error('Error parsing FAQ data:', e);
                            return;
                        }
                        
                        console.log('FAQ data:', faqData);
                        console.log('Clickable items:', faqItems.length);
                        
                        faqItems.forEach((item) => {
                            const dataIndex = parseInt(item.getAttribute('data-index'));
                            
                            // Remove existing listeners
                            item.removeEventListener('click', item.faqClickHandler);
                            
                            // Add new click handler
                            item.faqClickHandler = function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                
                                console.log('FAQ clicked:', dataIndex);
                                
                                // Remove active from all
                                faqItems.forEach(i => i.classList.remove('active'));
                                
                                // Add active to clicked
                                item.classList.add('active');
                                
                                // Show answer
                                const faqItem = faqData[dataIndex];
                                if (faqItem) {
                                    expandedQuestion.innerHTML = faqItem.faq_question;
                                    expandedAnswer.innerHTML = faqItem.faq_answer;
                                    expandedContainer.classList.add('show');
                                    
                                    // Scroll to answer
                                    setTimeout(() => {
                                        expandedContainer.scrollIntoView({
                                            behavior: 'smooth',
                                            block: 'start'
                                        });
                                    }, 100);
                                }
                            };
                            
                            item.addEventListener('click', item.faqClickHandler);
                            item.style.cursor = 'pointer';
                        });
                    }
                    
                    // Try to initialize immediately
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', initThisFAQ);
                    } else {
                        initThisFAQ();
                    }
                    
                    // Also try after a delay for Elementor
                    setTimeout(initThisFAQ, 500);
                    setTimeout(initThisFAQ, 1000);
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