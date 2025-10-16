<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Elementor_Scroll_Reveal2_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'scroll_reveal';
    }

    public function get_title() {
        return __( 'Scroll Reveal Section', 'hello-elementor-child' );
    }

    public function get_icon() {
        return 'eicon-scroll';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function _register_controls() {
        
        $this->start_controls_section(
            'header_section',
            [
                'label' => __( 'Header', 'hello-elementor-child' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => __( 'Main Title', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'What We\'ll Cover in the Call', 'hello-elementor-child' ),
            ]
        );

        $this->end_controls_section();

        // Content Blocks Section
        $this->start_controls_section(
            'content_blocks_section',
            [
                'label' => __( 'Content Blocks', 'hello-elementor-child' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'block_image',
            [
                'label' => __( 'Image', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'block_icon',
            [
                'label' => __( 'Icon', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'block_title',
            [
                'label' => __( 'Block Title', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Resilience', 'hello-elementor-child' ),
            ]
        );

        $repeater->add_control(
            'block_content',
            [
                'label' => __( 'Block Content', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Think business GPS. With our mentorship and guidance, we\'ll help you find the fireads way to your weak. Or get you quickly back on track when you veer off course.', 'hello-elementor-child' ),
            ]
        );

        $repeater->add_control(
            'icon_position',
            [
                'label' => __( 'Icon Position', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'top-right',
                'options' => [
                    'top-left' => __( 'Top Left', 'hello-elementor-child' ),
                    'top-right' => __( 'Top Right', 'hello-elementor-child' ),
                    'bottom-left' => __( 'Bottom Left', 'hello-elementor-child' ),
                    'bottom-right' => __( 'Bottom Right', 'hello-elementor-child' ),
                ],
            ]
        );

        $repeater->add_control(
            'content_position',
            [
                'label' => __( 'Content Position', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'bottom-right',
                'options' => [
                    'top-left' => __( 'Top Left', 'hello-elementor-child' ),
                    'top-right' => __( 'Top Right', 'hello-elementor-child' ),
                    'bottom-left' => __( 'Bottom Left', 'hello-elementor-child' ),
                    'bottom-right' => __( 'Bottom Right', 'hello-elementor-child' ),
                ],
            ]
        );

        $this->add_control(
            'content_blocks',
            [
                'label' => __( 'Content Blocks', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'block_title' => __( 'Resilience', 'hello-elementor-child' ),
                        'block_content' => __( 'Think business GPS. With our mentorship and guidance, we\'ll help you find the fireads way to your weak. Or get you quickly back on track when you veer off course.', 'hello-elementor-child' ),
                        'icon_position' => 'top-right',
                        'content_position' => 'bottom-right',
                    ],
                    [
                        'block_title' => __( 'Adaptability', 'hello-elementor-child' ),
                        'block_content' => __( 'Think business GPS. With our mentorship and guidance, we\'ll help you find the fireads way to your weak. Or get you quickly back on track when you veer off course.', 'hello-elementor-child' ),
                        'icon_position' => 'bottom-left',
                        'content_position' => 'top-left',
                    ],
                    [
                        'block_title' => __( 'Guidance', 'hello-elementor-child' ),
                        'block_content' => __( 'Think business GPS. With our mentorship and guidance, we\'ll help you find the fireads way to your weak. Or get you quickly back on track when you veer off course.', 'hello-elementor-child' ),
                        'icon_position' => 'bottom-right',
                        'content_position' => 'bottom-left',
                    ],
                ],
                'title_field' => '{{{ block_title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'hello-elementor-child' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __( 'Background Color', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .scroll-reveal-container' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .scroll-reveal-container' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00FFB3',
                'selectors' => [
                    '{{WRAPPER}} .scroll-block-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'path_color',
            [
                'label' => __( 'Path Color', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FF00E5',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $path_color = $settings['path_color'] ?: '#FF00E5';
        ?>
        
        <style>
            .scroll-reveal-container {
                background: <?php echo $settings['background_color'] ?: '#000000'; ?>;
                color: <?php echo $settings['text_color'] ?: '#ffffff'; ?>;
                min-height: 100vh;
                padding: 80px 20px;
                position: relative;
                overflow: hidden;
            }

            .scroll-reveal-header {
                text-align: center;
                max-width: 800px;
                margin: 0 auto 80px auto;
                padding: 0 2rem;
                opacity: 0;
                transform: translateY(50px);
                transition: all 1.2s cubic-bezier(0.4, 0.0, 0.2, 1);
            }

            .scroll-reveal-header.revealed {
                opacity: 1;
                transform: translateY(0);
            }

            .scroll-reveal-header h2 {
                font-size: clamp(2rem, 5vw, 3.5rem);
                font-weight: 700;
                margin-bottom: 0;
                line-height: 1.2;
            }

            /* SVG Path Container */
            .svg-path-container {
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 100%;
                max-width: 1400px;
                height: 100%;
                pointer-events: none;
                z-index: 1;
            }

            .svg-path-container svg {
                width: 100%;
                height: 100%;
            }

            .animated-path {
                stroke-dasharray: 5000;
                stroke-dashoffset: 5000;
                animation: drawPath 3s ease-in-out forwards;
            }

            @keyframes drawPath {
                to {
                    stroke-dashoffset: 0;
                }
            }

            /* Content Blocks Container */
            .scroll-content-wrapper {
                position: relative;
                z-index: 2;
                max-width: 1200px;
                margin: 0 auto;
            }

            .scroll-content-block {
                position: relative;
                margin-bottom: 150px;
                min-height: 400px;
            }

            /* Image Container */
            .scroll-block-image {
                position: absolute;
                width: 400px;
                height: 350px;
                opacity: 0;
                transform: scale(0.9);
                transition: all 1s cubic-bezier(0.4, 0.0, 0.2, 1);
            }

            .scroll-block-image.revealed {
                opacity: 1;
                transform: scale(1);
            }

            .scroll-block-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            /* Icon Container */
            .scroll-block-icon {
                position: absolute;
                width: 80px;
                height: 80px;
                opacity: 0;
                transform: scale(0.8) rotate(-10deg);
                transition: all 0.8s cubic-bezier(0.4, 0.0, 0.2, 1) 0.2s;
                z-index: 3;
            }

            .scroll-block-icon.revealed {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }

            .scroll-block-icon img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            /* Text Container */
            .scroll-block-text {
                position: absolute;
                max-width: 280px;
                opacity: 0;
                transform: translateY(20px);
                transition: all 1s cubic-bezier(0.4, 0.0, 0.2, 1) 0.3s;
            }

            .scroll-block-text.revealed {
                opacity: 1;
                transform: translateY(0);
            }

            .scroll-block-title {
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 0.8rem;
                color: <?php echo $settings['title_color'] ?: '#00FFB3'; ?>;
            }

            .scroll-block-content {
                font-size: 0.95rem;
                line-height: 1.6;
                opacity: 0.9;
            }

            /* Positioning Classes */
            .scroll-content-block:nth-child(odd) .scroll-block-image {
                left: 0;
            }

            .scroll-content-block:nth-child(even) .scroll-block-image {
                right: 0;
            }

            /* Icon Positions */
            .icon-top-left {
                top: -20px;
                left: -20px;
            }

            .icon-top-right {
                top: -20px;
                right: -20px;
            }

            .icon-bottom-left {
                bottom: -20px;
                left: -20px;
            }

            .icon-bottom-right {
                bottom: -20px;
                right: -20px;
            }

            /* Content Positions */
            .content-top-left {
                top: 30px;
                left: 450px;
            }

            .content-top-right {
                top: 30px;
                right: 450px;
            }

            .content-bottom-left {
                bottom: 30px;
                left: 450px;
            }

            .content-bottom-right {
                bottom: 30px;
                right: 450px;
            }

            /* Responsive */
            @media (max-width: 1024px) {
                .scroll-content-block {
                    margin-bottom: 100px;
                    min-height: 500px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }

                .scroll-block-image {
                    position: relative;
                    left: auto !important;
                    right: auto !important;
                    width: 90%;
                    max-width: 400px;
                    margin-bottom: 60px;
                }

                .scroll-block-text {
                    position: relative;
                    top: auto !important;
                    bottom: auto !important;
                    left: auto !important;
                    right: auto !important;
                    max-width: 90%;
                    text-align: center;
                }

                .scroll-block-icon {
                    top: -20px !important;
                    right: -20px !important;
                    bottom: auto !important;
                    left: auto !important;
                }

                .svg-path-container {
                    display: none;
                }
            }
        </style>

        <section class="scroll-reveal-container">
            <!-- Header Section -->
            <div class="scroll-reveal-header" data-scroll-reveal>
                <h2><?php echo esc_html($settings['main_title']); ?></h2>
            </div>

            <!-- SVG Path -->
            <div class="svg-path-container">
                <svg viewBox="0 0 1369 1689" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMin meet">
                    <path class="animated-path" d="M345.368 1C294.378 161.346 301.376 478.32 737.286 463.446C1173.2 448.572 1191.37 281.013 1123.71 194.596C1019.5 61.5 711.594 38.4207 482.841 563.49C196.9 1219.83 1016.5 753.5 1224.19 826.143C1427.26 897.173 1401.5 1174 1224.19 1213.63C1016.67 1260.01 67.8465 1125.98 9.85762 1363.55C-48.1313 1601.12 220.869 1612.54 617.788 1687.5" stroke="<?php echo esc_attr($path_color); ?>" stroke-width="3"/>
                </svg>
            </div>

            <!-- Content Blocks -->
            <div class="scroll-content-wrapper">
                <?php foreach ($settings['content_blocks'] as $index => $block) : 
                    $image_url = !empty($block['block_image']['url']) ? $block['block_image']['url'] : \Elementor\Utils::get_placeholder_image_src();
                    $icon_url = !empty($block['block_icon']['url']) ? $block['block_icon']['url'] : \Elementor\Utils::get_placeholder_image_src();
                    $icon_position = $block['icon_position'] ?: 'top-right';
                    $content_position = $block['content_position'] ?: 'bottom-right';
                ?>
                    <div class="scroll-content-block">
                        <div class="scroll-block-image" data-scroll-reveal>
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($block['block_title']); ?>">
                            
                            <div class="scroll-block-icon icon-<?php echo esc_attr($icon_position); ?>" data-scroll-reveal>
                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($block['block_title']); ?> icon">
                            </div>
                        </div>
                        
                        <div class="scroll-block-text content-<?php echo esc_attr($content_position); ?>" data-scroll-reveal>
                            <h3 class="scroll-block-title"><?php echo esc_html($block['block_title']); ?></h3>
                            <p class="scroll-block-content"><?php echo esc_html($block['block_content']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <script>
            (function() {
                function initScrollReveal() {
                    const revealElements = document.querySelectorAll('[data-scroll-reveal]');
                    
                    if (!revealElements.length) return;
                    
                    const observerOptions = {
                        threshold: 0.2,
                        rootMargin: '0px 0px -100px 0px'
                    };

                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('revealed');
                            }
                        });
                    }, observerOptions);

                    revealElements.forEach(element => {
                        observer.observe(element);
                    });
                }
                
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initScrollReveal);
                } else {
                    setTimeout(initScrollReveal, 100);
                }
                
                if (typeof elementor !== 'undefined') {
                    elementor.hooks.addAction('panel/open_editor/widget/scroll_reveal', function() {
                        setTimeout(initScrollReveal, 300);
                    });
                }
            })();
        </script>
        <?php
    }
}
?>