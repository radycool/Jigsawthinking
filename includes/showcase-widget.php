<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Showcase_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'showcase_widget';
    }

    public function get_title() {
        return __( 'Showcase Widget', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return ['showcase', 'quiz', 'popup', 'embed', 'coaching'];
    }

    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => __('Heading', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Let\'s talk. No pitch. Just perspective.', 'textdomain'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Book a 20-minute clarity call with a coach best fit for you. We\'ll walk through your business, your goals, and your biggest bottleneck — and map your next best step.', 'textdomain'),
            ]
        );

        $this->add_control(
            'showcase_image',
            [
                'label' => __('Showcase Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Take Quiz', 'textdomain'),
            ]
        );

        $this->add_control(
            'quiz_url',
            [
                'label' => __('Quiz URL', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-quiz-url.com', 'textdomain'),
                'default' => [
                    'url' => 'https://jigsawthinking499.outgrow.us/founderfreedomquiz',
                    'is_external' => true,
                ],
                'description' => __('The quiz will open in a popup modal', 'textdomain'),
            ]
        );

        $this->add_control(
            'popup_width',
            [
                'label' => __('Popup Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 1200,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 80,
                ],
            ]
        );

        $this->add_control(
            'popup_height',
            [
                'label' => __('Popup Height', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 400,
                        'max' => 1000,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 60,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'vh',
                    'size' => 70,
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .showcase-section' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .showcase-section' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Button Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#007cff',
                'selectors' => [
                    '{{WRAPPER}} .quiz-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Button Hover Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0056b3',
                'selectors' => [
                    '{{WRAPPER}} .quiz-button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $quiz_url = !empty($settings['quiz_url']['url']) ? $settings['quiz_url']['url'] : '';
        $image_url = !empty($settings['showcase_image']['url']) ? $settings['showcase_image']['url'] : \Elementor\Utils::get_placeholder_image_src();
        
        $popup_width = $settings['popup_width']['size'] . $settings['popup_width']['unit'];
        $popup_height = $settings['popup_height']['size'] . $settings['popup_height']['unit'];
        ?>
        <div class="showcase-section">
            <div class="showcase-container">
                <div class="showcase-content">
                    <div class="showcase-text">
                        <?php if (!empty($settings['heading'])): ?>
                            <h1 class="showcase-heading"><?php echo esc_html($settings['heading']); ?></h1>
                        <?php endif; ?>
                        
                        <?php if (!empty($settings['description'])): ?>
                            <p class="showcase-description"><?php echo esc_html($settings['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="showcase-visual">
                        <div class="showcase-image-container">
                            <img src="<?php echo esc_url($image_url); ?>" alt="Showcase" class="showcase-image">
                            
                            <?php if (!empty($quiz_url)): ?>
                                <button class="quiz-button" data-quiz-url="<?php echo esc_url($quiz_url); ?>">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 5V19L19 12L8 5Z" fill="currentColor"/>
                                    </svg>
                                    <?php echo esc_html($settings['button_text']); ?>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz Modal -->
        <div class="quiz-modal" id="quizModal">
            <div class="quiz-modal-content" style="width: <?php echo esc_attr($popup_width); ?>; height: <?php echo esc_attr($popup_height); ?>;">
                <span class="quiz-close">&times;</span>
                <div class="quiz-loading" id="quizLoading">
                    <div class="loading-spinner"></div>
                    <p>Loading your quiz...</p>
                </div>
                <iframe class="quiz-iframe" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="display: none;"></iframe>
            </div>
        </div>

        <style>
        .showcase-section {
            background-color: #000000;
            color: #ffffff;
            padding: 100px 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 60vh;
            display: flex;
            align-items: center;
        }

        .showcase-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
        }

        .showcase-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .showcase-text {
            margin-bottom: 50px;
        }

        .showcase-heading {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 30px;
            letter-spacing: -0.02em;
        }

        .showcase-description {
            font-size: 1.2rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0;
            max-width: 500px;
        }

        .showcase-visual {
            position: relative;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .showcase-image-container {
            position: relative;
            width: 100%;
            max-width: 400px;
            aspect-ratio: 16/10;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .showcase-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.1;
        }

        .quiz-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #007cff;
            color: white;
            border: none;
            padding: 16px 32px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 8px 24px rgba(0, 124, 255, 0.4);
            z-index: 2;
        }

        .quiz-button:hover {
            background-color: #0056b3;
            transform: translate(-50%, -50%) scale(1.05);
            box-shadow: 0 12px 32px rgba(0, 124, 255, 0.6);
        }

        .quiz-button svg {
            transition: transform 0.3s ease;
        }

        .quiz-button:hover svg {
            transform: scale(1.1);
        }

        /* Modal Styles */
        .quiz-modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }

        .quiz-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quiz-modal-content {
            background-color: #ffffff;
            border-radius: 12px;
            position: relative;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.3s ease;
            overflow: hidden;
            max-width: 90vw;
            max-height: 85vh;
            margin: 20px;
        }

        .quiz-close {
            position: absolute;
            top: 15px;
            right: 20px;
            color: #666;
            font-size: 32px;
            font-weight: bold;
            cursor: pointer;
            z-index: 10001;
            background: rgba(255, 255, 255, 0.9);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .quiz-close:hover {
            background: rgba(255, 255, 255, 1);
            color: #333;
            transform: scale(1.1);
        }

        .quiz-iframe {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 12px;
        }

        .quiz-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #666;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007cff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to { 
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .showcase-section {
                padding: 60px 0;
            }
            
            .showcase-content {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }
            
            .showcase-heading {
                font-size: 2.5rem;
            }
            
            .showcase-description {
                font-size: 1.1rem;
            }
            
            .quiz-button {
                padding: 14px 28px;
                font-size: 16px;
            }
            
            .quiz-modal-content {
                width: 95% !important;
                height: 80% !important;
                margin: 20px;
                max-width: none;
                max-height: none;
            }
        }

        @media (max-width: 480px) {
            .showcase-container {
                padding: 0 15px;
            }
            
            .showcase-heading {
                font-size: 2rem;
            }
            
            .quiz-button {
                padding: 12px 24px;
                font-size: 15px;
            }
        }
        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quizButton = document.querySelector('.quiz-button');
            const quizModal = document.getElementById('quizModal');
            const quizClose = document.querySelector('.quiz-close');
            const quizIframe = document.querySelector('.quiz-iframe');
            const quizLoading = document.getElementById('quizLoading');

            if (quizButton && quizModal) {
                // Open modal
                quizButton.addEventListener('click', function() {
                    const quizUrl = this.getAttribute('data-quiz-url');
                    if (quizUrl) {
                        // Show modal with loading
                        quizModal.classList.add('active');
                        document.body.style.overflow = 'hidden';
                        quizLoading.style.display = 'block';
                        quizIframe.style.display = 'none';
                        
                        // Load iframe
                        quizIframe.src = quizUrl;
                    }
                });

                // Hide loading when iframe loads
                quizIframe.addEventListener('load', function() {
                    quizLoading.style.display = 'none';
                    quizIframe.style.display = 'block';
                });

                // Handle loading errors
                quizIframe.addEventListener('error', function() {
                    quizLoading.innerHTML = '<p style="color: #ff4444;">Failed to load quiz. Please try again.</p>';
                });

                // Close modal
                function closeModal() {
                    quizModal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                    // Clear iframe to stop any ongoing quiz
                    setTimeout(() => {
                        quizIframe.src = '';
                        quizLoading.style.display = 'block';
                        quizIframe.style.display = 'none';
                    }, 300);
                }

                if (quizClose) {
                    quizClose.addEventListener('click', closeModal);
                }

                // Close when clicking outside
                quizModal.addEventListener('click', function(e) {
                    if (e.target === quizModal) {
                        closeModal();
                    }
                });

                // Close with Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && quizModal.classList.contains('active')) {
                        closeModal();
                    }
                });
            }
        });
        </script>
        <?php
    }
}

// Register the widget
function register_elementor_showcase_widget($widgets_manager) {
    $widgets_manager->register(new Elementor_Showcase_Widget());
}
add_action('elementor/widgets/register', 'register_elementor_showcase_widget');