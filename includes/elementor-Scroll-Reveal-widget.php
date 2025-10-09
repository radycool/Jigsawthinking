<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Elementor_Scroll_Reveal_Widget extends \Elementor\Widget_Base {

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
                'default' => __( 'Happy Founder. Healthy Business.', 'hello-elementor-child' ),
            ]
        );

        $this->add_control(
            'main_subtitle',
            [
                'label' => __( 'Main Subtitle', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Coaching that supports both the business and the person building it.', 'hello-elementor-child' ),
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
            'block_title',
            [
                'label' => __( 'Block Title', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Happy Founder. Healthy Business.', 'hello-elementor-child' ),
            ]
        );

        $repeater->add_control(
            'block_content',
            [
                'label' => __( 'Block Content', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Because when you\'re calm and clear, your decisions are better. When your systems are strong, your business can grow — without draining you.', 'hello-elementor-child' ),
            ]
        );

        $repeater->add_control(
            'image_size',
            [
                'label' => __( 'Image Size', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'medium-landscape',
                'options' => [
                    'small-landscape' => __( 'Small Landscape', 'hello-elementor-child' ),
                    'medium-landscape' => __( 'Medium Landscape', 'hello-elementor-child' ),
                    'large-landscape' => __( 'Large Landscape', 'hello-elementor-child' ),
                    'small-portrait' => __( 'Small Portrait', 'hello-elementor-child' ),
                    'medium-portrait' => __( 'Medium Portrait', 'hello-elementor-child' ),
                    'large-portrait' => __( 'Large Portrait', 'hello-elementor-child' ),
                    'small-square' => __( 'Small Square', 'hello-elementor-child' ),
                    'medium-square' => __( 'Medium Square', 'hello-elementor-child' ),
                    'large-square' => __( 'Large Square', 'hello-elementor-child' ),
                ],
            ]
        );

        $repeater->add_control(
            'image_position',
            [
                'label' => __( 'Image Position', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'left' => __( 'Left', 'hello-elementor-child' ),
                    'center' => __( 'Center', 'hello-elementor-child' ),
                    'right' => __( 'Right', 'hello-elementor-child' ),
                ],
            ]
        );

        $repeater->add_control(
            'text_position',
            [
                'label' => __( 'Text Position', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'below',
                'options' => [
                    'above' => __( 'Above Image', 'hello-elementor-child' ),
                    'below' => __( 'Below Image', 'hello-elementor-child' ),
                    'left' => __( 'Left of Image', 'hello-elementor-child' ),
                    'right' => __( 'Right of Image', 'hello-elementor-child' ),
                    'overlay' => __( 'Overlay on Image', 'hello-elementor-child' ),
                ],
            ]
        );

        $repeater->add_control(
            'text_alignment',
            [
                'label' => __( 'Text Alignment', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => __( 'Left', 'hello-elementor-child' ),
                    'center' => __( 'Center', 'hello-elementor-child' ),
                    'right' => __( 'Right', 'hello-elementor-child' ),
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
                        'block_title' => __( 'Happy Founder. Healthy Business.', 'hello-elementor-child' ),
                        'block_content' => __( 'You didn\'t start your business to chase your tail every day. You started it for freedom, focus, and fulfillment. We coach from one powerful belief.', 'hello-elementor-child' ),
                        'image_size' => 'large-portrait',
                        'image_position' => 'center',
                        'text_position' => 'below',
                        'text_alignment' => 'center',
                    ],
                    [
                        'block_title' => __( 'Happy Founder. Healthy Business.', 'hello-elementor-child' ),
                        'block_content' => __( 'Because when you\'re calm and clear, your decisions are better. When your systems are strong, your business can grow — without draining you.', 'hello-elementor-child' ),
                        'image_size' => 'medium-square',
                        'image_position' => 'right',
                        'text_position' => 'left',
                        'text_alignment' => 'left',
                    ],
                    [
                        'block_title' => __( 'Clarity Becomes Action', 'hello-elementor-child' ),
                        'block_content' => __( 'This is where clarity becomes a calendar, not just a quote. Our job is to help you build it.', 'hello-elementor-child' ),
                        'image_size' => 'small-landscape',
                        'image_position' => 'left',
                        'text_position' => 'overlay',
                        'text_alignment' => 'center',
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
                'default' => '#0a0a0a',
                'selectors' => [
                    '{{WRAPPER}} .scroll-reveal-container' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .img-reveal-mask' => 'background-color: {{VALUE}}',
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

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <style>
            /* FLEXIBLE SCROLL REVEAL WIDGET STYLES */
            .scroll-reveal-container {
                background: <?php echo $settings['background_color'] ?: '#0a0a0a'; ?>;
                color: <?php echo $settings['text_color'] ?: '#ffffff'; ?>;
                min-height: 100vh;
                padding: 80px 0;
                overflow-x: hidden;
            }

            .scroll-reveal-header {
                text-align: center;
                max-width: 800px;
                margin: 0 auto 120px auto;
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
                font-size: clamp(2.5rem, 5vw, 4rem);
                font-weight: 700;
                margin-bottom: 1.5rem;
                line-height: 1.2;
            }

            .scroll-reveal-header p {
                font-size: clamp(1.1rem, 2vw, 1.4rem);
                opacity: 0.9;
                line-height: 1.6;
            }

            /* FLEXIBLE CONTENT BLOCKS */
            .scroll-content-block {
                max-width: 1400px;
                margin: 0 auto 120px auto;
                padding: 40px 2rem;
                position: relative;
            }

            /* TEXT BESIDE IMAGE LAYOUTS (LEFT/RIGHT) */
            .scroll-content-block.text-beside {
                display: flex;
                align-items: flex-start;
                gap: 60px;
            }

            .scroll-content-block.text-left {
                flex-direction: row;
            }

            .scroll-content-block.text-right {
                flex-direction: row-reverse;
            }

            /* TEXT ABOVE/BELOW IMAGE LAYOUTS */
            .scroll-content-block.text-above,
            .scroll-content-block.text-below {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .scroll-content-block.text-above .scroll-block-text {
                order: 1;
            }

            .scroll-content-block.text-above .scroll-block-image {
                order: 2;
            }

            .scroll-content-block.text-below .scroll-block-image {
                order: 1;
            }

            .scroll-content-block.text-below .scroll-block-text {
                order: 2;
            }

            /* OVERLAY LAYOUT */
            .scroll-content-block.text-overlay {
                display: flex;
                justify-content: center;
            }

            /* IMAGE POSITIONING */
            .scroll-block-image {
                position: relative;
                opacity: 0;
                transform: translateY(50px);
                transition: all 1.2s cubic-bezier(0.4, 0.0, 0.2, 1);
                overflow: hidden;
                flex-shrink: 0;
            }

            .scroll-block-image.revealed {
                opacity: 1;
                transform: translateY(0);
            }

            /* IMAGE SIZE VARIANTS - LANDSCAPE */
            .scroll-block-image.size-small-landscape {
                width: min(40vw, 320px);
                height: min(25vw, 200px);
            }

            .scroll-block-image.size-medium-landscape {
                width: min(60vw, 480px);
                height: min(35vw, 300px);
            }

            .scroll-block-image.size-large-landscape {
                width: min(80vw, 640px);
                height: min(50vw, 400px);
            }

            /* IMAGE SIZE VARIANTS - PORTRAIT */
            .scroll-block-image.size-small-portrait {
                width: min(25vw, 240px);
                height: min(40vw, 360px);
            }

            .scroll-block-image.size-medium-portrait {
                width: min(35vw, 320px);
                height: min(55vw, 480px);
            }

            .scroll-block-image.size-large-portrait {
                width: min(45vw, 400px);
                height: min(70vw, 600px);
            }

            /* IMAGE SIZE VARIANTS - SQUARE */
            .scroll-block-image.size-small-square {
                width: min(30vw, 280px);
                height: min(30vw, 280px);
            }

            .scroll-block-image.size-medium-square {
                width: min(45vw, 400px);
                height: min(45vw, 400px);
            }

            .scroll-block-image.size-large-square {
                width: min(60vw, 520px);
                height: min(60vw, 520px);
            }

            /* IMAGE HORIZONTAL POSITIONING */
            .scroll-content-block.img-left {
                justify-content: flex-start;
            }

            .scroll-content-block.img-center {
                justify-content: center;
            }

            .scroll-content-block.img-right {
                justify-content: flex-end;
            }

            /* Wipe reveal mask */
            .img-reveal-mask {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: <?php echo $settings['background_color'] ?: '#0a0a0a'; ?>;
                z-index: 2;
                transform: translateY(0%);
                transition: transform 1.4s cubic-bezier(0.77, 0, 0.175, 1);
            }

            .scroll-block-image.revealed .img-reveal-mask {
                transform: translateY(-100%);
            }

            .scroll-block-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            /* TEXT STYLING */
            .scroll-block-text {
                opacity: 0;
                transform: translateY(30px);
                transition: all 1.2s cubic-bezier(0.4, 0.0, 0.2, 1) 0.3s;
                position: relative;
                flex: 1;
                min-width: 0;
            }

            .scroll-block-text.revealed {
                opacity: 1;
                transform: translateY(0);
            }

            /* TEXT ALIGNMENT */
            .scroll-block-text.align-left {
                text-align: left;
            }

            .scroll-block-text.align-center {
                text-align: center;
            }

            .scroll-block-text.align-right {
                text-align: right;
            }

            /* OVERLAY TEXT STYLING */
            .scroll-block-text.overlay {
                position: absolute;
                bottom: 20px;
                left: 20px;
                right: 20px;
                background: rgba(0, 0, 0, 0.8);
                padding: 30px;
                backdrop-filter: blur(10px);
                z-index: 3;
                flex: none;
            }

            .scroll-block-text h3 {
                font-size: clamp(1.8rem, 3vw, 2.8rem);
                font-weight: 600;
                margin-bottom: 1.5rem;
                line-height: 1.2;
            }

            .scroll-block-text p {
                font-size: clamp(1rem, 1.5vw, 1.3rem);
                line-height: 1.7;
                opacity: 0.9;
            }

            /* SPACING FOR TEXT BESIDE LAYOUTS */
            .scroll-content-block.text-beside .scroll-block-text {
                max-width: 500px;
            }

            .scroll-content-block.text-above .scroll-block-text,
            .scroll-content-block.text-below .scroll-block-text {
                max-width: 600px;
                margin: 30px 0;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .scroll-content-block.text-beside {
                    flex-direction: column;
                    gap: 30px;
                    text-align: center;
                }

                .scroll-content-block.text-left,
                .scroll-content-block.text-right {
                    align-items: center;
                }

                .scroll-content-block.text-beside .scroll-block-image {
                    order: 1;
                }

                .scroll-content-block.text-beside .scroll-block-text {
                    order: 2;
                    max-width: 100%;
                }

                .scroll-block-image.size-small-landscape,
                .scroll-block-image.size-medium-landscape,
                .scroll-block-image.size-large-landscape {
                    width: 90vw;
                    height: 60vw;
                    max-width: 400px;
                    max-height: 280px;
                }

                .scroll-block-image.size-small-portrait,
                .scroll-block-image.size-medium-portrait,
                .scroll-block-image.size-large-portrait {
                    width: 70vw;
                    height: 90vw;
                    max-width: 320px;
                    max-height: 440px;
                }

                .scroll-block-image.size-small-square,
                .scroll-block-image.size-medium-square,
                .scroll-block-image.size-large-square {
                    width: 80vw;
                    height: 80vw;
                    max-width: 350px;
                    max-height: 350px;
                }

                .scroll-block-text.overlay {
                    position: static;
                    background: transparent;
                    padding: 20px 0;
                    backdrop-filter: none;
                }

                .scroll-content-block {
                    padding: 40px 1rem;
                    margin-bottom: 80px;
                }
            }
        </style>

        <section class="scroll-reveal-container">
            <!-- Header Section -->
            <div class="scroll-reveal-header" data-scroll-reveal>
                <h2><?php echo esc_html($settings['main_title']); ?></h2>
                <p><?php echo esc_html($settings['main_subtitle']); ?></p>
            </div>

            <!-- Content Blocks -->
            <?php foreach ($settings['content_blocks'] as $index => $block) : 
                $image_size = $block['image_size'] ?: 'medium-landscape';
                $image_position = $block['image_position'] ?: 'center';
                $text_position = $block['text_position'] ?: 'below';
                $text_alignment = $block['text_alignment'] ?: 'left';
                $image_url = !empty($block['block_image']['url']) ? $block['block_image']['url'] : \Elementor\Utils::get_placeholder_image_src();
                
                // Build CSS classes
                $block_classes = [];
                
                if ($text_position === 'left' || $text_position === 'right') {
                    $block_classes[] = 'text-beside';
                    $block_classes[] = 'text-' . $text_position;
                } elseif ($text_position === 'above' || $text_position === 'below') {
                    $block_classes[] = 'text-' . $text_position;
                } elseif ($text_position === 'overlay') {
                    $block_classes[] = 'text-overlay';
                }
                
                $block_classes[] = 'img-' . $image_position;
                
                $block_class_str = implode(' ', $block_classes);
            ?>
                <div class="scroll-content-block <?php echo esc_attr($block_class_str); ?>">
                    <div class="scroll-block-image size-<?php echo esc_attr($image_size); ?>" data-scroll-reveal>
                        <div class="img-reveal-mask"></div>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($block['block_title']); ?>">
                        
                        <?php if ($text_position === 'overlay') : ?>
                            <div class="scroll-block-text overlay align-<?php echo esc_attr($text_alignment); ?>" data-scroll-reveal>
                                <h3><?php echo esc_html($block['block_title']); ?></h3>
                                <p><?php echo esc_html($block['block_content']); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($text_position !== 'overlay') : ?>
                        <div class="scroll-block-text align-<?php echo esc_attr($text_alignment); ?>" data-scroll-reveal>
                            <h3><?php echo esc_html($block['block_title']); ?></h3>
                            <p><?php echo esc_html($block['block_content']); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </section>

        <script>
            // SCROLL REVEAL ANIMATION
            (function() {
                console.log('Scroll Reveal: Script loaded');
                
                function initScrollReveal() {
                    const revealElements = document.querySelectorAll('[data-scroll-reveal]');
                    
                    if (!revealElements.length) {
                        console.log('Scroll Reveal: No elements found');
                        return;
                    }
                    
                    console.log('Scroll Reveal: Found', revealElements.length, 'elements');
                    
                    const observerOptions = {
                        threshold: 0.15,
                        rootMargin: '0px 0px -80px 0px'
                    };

                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('revealed');
                                console.log('Scroll Reveal: Element revealed');
                            }
                        });
                    }, observerOptions);

                    revealElements.forEach(element => {
                        observer.observe(element);
                    });
                    
                    console.log('Scroll Reveal: Observer initialized');
                }
                
                // Initialize
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initScrollReveal);
                } else {
                    setTimeout(initScrollReveal, 100);
                }
                
                // Re-initialize for Elementor editor
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