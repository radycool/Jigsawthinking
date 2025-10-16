<?php
if (!defined('ABSPATH')) exit;

class Elementor_Timeline_Reveal_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'timeline_reveal';
    }

    public function get_title() {
        return __('Timeline Reveal Section', 'hello-elementor-child');
    }

    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {
        
        // Header Section
        $this->start_controls_section(
            'header_section',
            [
                'label' => __('Header', 'hello-elementor-child'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => __('Main Title', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Raashid\'s Story (in His Words)', 'hello-elementor-child'),
            ]
        );

        $this->end_controls_section();

        // Line Animation Section
        $this->start_controls_section(
            'line_animation_section',
            [
                'label' => __('Line Animation', 'hello-elementor-child'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'use_lottie_line',
            [
                'label' => __('Use Lottie Animation', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'hello-elementor-child'),
                'label_off' => __('No', 'hello-elementor-child'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'lottie_json_url',
            [
                'label' => __('Lottie JSON URL', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Lottie JSON file URL', 'hello-elementor-child'),
                'condition' => [
                    'use_lottie_line' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Timeline Items Section
        $this->start_controls_section(
            'timeline_items_section',
            [
                'label' => __('Timeline Items', 'hello-elementor-child'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_image',
            [
                'label' => __('Image', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'image_size',
            [
                'label' => __('Image Size', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'landscape',
                'options' => [
                    'square' => __('Square', 'hello-elementor-child'),
                    'landscape' => __('Landscape', 'hello-elementor-child'),
                    'portrait' => __('Portrait', 'hello-elementor-child'),
                ],
            ]
        );

        $repeater->add_control(
            'item_position',
            [
                'label' => __('Item Position', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => __('Left', 'hello-elementor-child'),
                    'right' => __('Right', 'hello-elementor-child'),
                ],
            ]
        );

        $repeater->add_control(
            'text_alignment',
            [
                'label' => __('Text Alignment', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'hello-elementor-child'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'hello-elementor-child'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'hello-elementor-child'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' => __('Icon', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'item_title',
            [
                'label' => __('Title', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Exploration', 'hello-elementor-child'),
            ]
        );

        $repeater->add_control(
            'item_content',
            [
                'label' => __('Content', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Your content goes here describing this timeline step.', 'hello-elementor-child'),
            ]
        );

        $repeater->add_control(
            'icon_color',
            [
                'label' => __('Icon Background Color', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e91e63',
            ]
        );

        $this->add_control(
            'timeline_items',
            [
                'label' => __('Timeline Items', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => __('Exploration', 'hello-elementor-child'),
                        'item_content' => __('First I knew that I wanted to understand and believe, not to take anything for granted, then search for the meaning of it all.', 'hello-elementor-child'),
                        'icon_color' => '#e91e63',
                        'image_size' => 'landscape',
                        'item_position' => 'left',
                        'text_alignment' => 'left',
                    ],
                    [
                        'item_title' => __('Education', 'hello-elementor-child'),
                        'item_content' => __('What changed my life was my journey around education. First in Australia, then to Asia, and finally to Europe.', 'hello-elementor-child'),
                        'icon_color' => '#00bcd4',
                        'image_size' => 'portrait',
                        'item_position' => 'right',
                        'text_alignment' => 'left',
                    ],
                    [
                        'item_title' => __('Business', 'hello-elementor-child'),
                        'item_content' => __('I love business and I have been lucky to work for brilliant entrepreneurs and learn from them.', 'hello-elementor-child'),
                        'icon_color' => '#e91e63',
                        'image_size' => 'landscape',
                        'item_position' => 'left',
                        'text_alignment' => 'left',
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'hello-elementor-child'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f8f9fa',
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label' => __('Timeline Line Color', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e91e63',
            ]
        );

        $this->add_control(
            'text_box_bg',
            [
                'label' => __('Text Box Background', 'hello-elementor-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a1a1a',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $line_color = $settings['line_color'] ?: '#e91e63';
        $bg_color = $settings['background_color'] ?: '#f8f9fa';
        $text_bg = $settings['text_box_bg'] ?: '#1a1a1a';
        $use_lottie = $settings['use_lottie_line'] === 'yes';
        $lottie_url = $settings['lottie_json_url'] ?: '';
        ?>
        
        <style>
            #timeline-<?php echo $widget_id; ?> {
                background: linear-gradient(135deg, <?php echo $bg_color; ?> 0%, #ffffff 100%);
                width: 100vw;
                position: relative;
                left: 50%;
                right: 50%;
                margin-left: -50vw;
                margin-right: -50vw;
                padding: 100px 0;
                min-height: 100vh;
                overflow: hidden;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-content {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 40px;
                position: relative;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-header {
                text-align: center;
                margin-bottom: 120px;
                opacity: 1;
                position: relative;
                z-index: 3;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-header h2 {
                font-size: clamp(2rem, 4vw, 2.8rem);
                font-weight: 700;
                background: linear-gradient(135deg, #333 0%, #666 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                margin: 0;
                letter-spacing: -0.5px;
                line-height: 1.2;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-line {
                position: absolute;
                top: 180px;
                left: 0;
                width: 100%;
                height: calc(100% - 180px);
                z-index: 1;
                pointer-events: none;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-line svg,
            #timeline-<?php echo $widget_id; ?> #lottie-line-<?php echo $widget_id; ?> {
                width: 100%;
                height: 100%;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-line path {
                fill: none;
                stroke: <?php echo $line_color; ?>;
                stroke-width: 4;
                stroke-linecap: round;
                stroke-linejoin: round;
                filter: drop-shadow(0 2px 8px rgba(233, 30, 99, 0.2));
            }

            @media (max-width: 1024px) {
                #timeline-<?php echo $widget_id; ?> .timeline-line path {
                    stroke-width: 3;
                }
            }

            @media (max-width: 768px) {
                #timeline-<?php echo $widget_id; ?> .timeline-line path {
                    stroke-width: 2;
                }
            }

            #timeline-<?php echo $widget_id; ?> .timeline-items {
                position: relative;
                z-index: 2;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-item {
                position: relative;
                margin-bottom: 180px;
                display: flex;
                align-items: flex-end;
                gap: 0;
                opacity: 1;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-item.position-left {
                justify-content: flex-start;
                margin-left: 8%;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-item.position-right {
                justify-content: flex-end;
                margin-right: 8%;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-image {
                position: relative;
                flex-shrink: 0;
                background: #f0f2f5;
                overflow: hidden;
                border-radius: 0;
                box-shadow: 0 8px 32px rgba(0,0,0,0.12);
                z-index: 3;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-image::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: <?php echo $bg_color; ?>;
                z-index: 2;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-item.position-left .timeline-image::before {
                transform-origin: left;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-item.position-right .timeline-image::before {
                transform-origin: right;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-image.size-landscape {
                width: 400px;
                height: 280px;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-image.size-portrait {
                width: 300px;
                height: 400px;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-image.size-square {
                width: 350px;
                height: 350px;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                position: relative;
                z-index: 1;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-text-box {
                background: <?php echo $text_bg; ?>;
                color: #fff;
                padding: 20px 28px;
                max-width: 380px;
                min-width: 320px;
                height: auto;
                max-height: 110px;
                border-radius: 0;
                box-shadow: 0 8px 32px rgba(0,0,0,0.15);
                position: relative;
                z-index: 4;
                align-self: flex-end;
                margin-bottom: 0;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-item.position-right .timeline-text-box {
                order: -1;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-text-box h3 {
                font-size: 1.1rem;
                font-weight: 600;
                margin: 0 0 8px 0;
                color: #fff;
                letter-spacing: 0.2px;
                line-height: 1.3;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-text-box p {
                font-size: 0.85rem;
                line-height: 1.5;
                margin: 0;
                color: #e0e0e0;
                font-weight: 400;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-text-box.align-center {
                text-align: center;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-text-box.align-right {
                text-align: right;
            }

            #timeline-<?php echo $widget_id; ?> .timeline-icon {
                position: absolute;
                width: 64px;
                height: 64px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                color: white;
                z-index: 10;
                box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            }

            /* Items 1, 3, 5... (odd) - Icon on top corner of image */
            #timeline-<?php echo $widget_id; ?> .timeline-item:nth-child(odd) .timeline-icon {
                top: -32px;
                left: 20px;
            }

            /* Items 2, 4, 6... (even) - Icon in space between items (above current item) */
            #timeline-<?php echo $widget_id; ?> .timeline-item:nth-child(even) .timeline-icon {
                top: -120px;
                left: 50%;
                transform: translateX(-50%);
            }

            @media (max-width: 1024px) {
                #timeline-<?php echo $widget_id; ?> .timeline-content {
                    padding: 0 30px;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-item {
                    gap: 0;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-item.position-left,
                #timeline-<?php echo $widget_id; ?> .timeline-item.position-right {
                    margin-left: 4% !important;
                    margin-right: 4% !important;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-icon {
                    width: 56px;
                    height: 56px;
                    font-size: 18px;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-image.size-landscape {
                    width: 350px;
                    height: 240px;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-text-box {
                    max-width: 320px;
                    min-width: 280px;
                }
            }

            @media (max-width: 768px) {
                #timeline-<?php echo $widget_id; ?> {
                    padding: 60px 0;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-content {
                    padding: 0 20px;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-header {
                    margin-bottom: 60px;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-item,
                #timeline-<?php echo $widget_id; ?> .timeline-item.position-left,
                #timeline-<?php echo $widget_id; ?> .timeline-item.position-right {
                    flex-direction: column !important;
                    align-items: center !important;
                    gap: 20px !important;
                    margin: 0 auto 100px auto !important;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-text-box {
                    order: 0 !important;
                    max-width: 90vw !important;
                    min-width: auto !important;
                    max-height: none !important;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-image {
                    width: min(85vw, 320px) !important;
                    height: 200px !important;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-icon {
                    position: relative !important;
                    top: auto !important;
                    left: auto !important;
                    right: auto !important;
                    transform: none !important;
                    margin: 10px auto;
                }

                #timeline-<?php echo $widget_id; ?> .timeline-line {
                    display: none;
                }
            }
        </style>

        <section id="timeline-<?php echo $widget_id; ?>" class="timeline-reveal-container">
            <div class="timeline-content">
                <div class="timeline-line">
                    <?php if ($use_lottie && !empty($lottie_url)) : ?>
                        <div id="lottie-line-<?php echo $widget_id; ?>"></div>
                    <?php else : ?>
                        <svg viewBox="0 0 1016 2920" preserveAspectRatio="xMidYMid meet">
                            <path d="M23.4992 0.5C-27.5008 272.167 -20.5008 809.2 415.499 784C851.499 758.8 854.833 469.833 802 328.5C683.667 166.167 389.8 63.9 161 953.5C-125 2065.5 712 1229 902.5 1398.5C1093 1568 1003 1737.5 902.5 2055C802 2372.5 139.501 1906.5 81.5 2309C23.4992 2711.5 505.5 2791 902.5 2918" fill="none"/>
                        </svg>
                    <?php endif; ?>
                </div>

                <div class="timeline-header">
                    <h2><?php echo esc_html($settings['main_title']); ?></h2>
                </div>

                <div class="timeline-items">
                    <?php foreach ($settings['timeline_items'] as $index => $item) : 
                        $image_url = !empty($item['item_image']['url']) ? $item['item_image']['url'] : \Elementor\Utils::get_placeholder_image_src();
                        $icon_color = $item['icon_color'] ?: '#e91e63';
                        $image_size = $item['image_size'] ?: 'landscape';
                        $item_position = $item['item_position'] ?: 'left';
                        $text_alignment = $item['text_alignment'] ?: 'left';
                    ?>
                        <div class="timeline-item position-<?php echo esc_attr($item_position); ?>" data-timeline-item>
                            
                            <div class="timeline-image size-<?php echo esc_attr($image_size); ?>">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($item['item_title']); ?>">
                            </div>
                            
                            <div class="timeline-text-box align-<?php echo esc_attr($text_alignment); ?>">
                                <h3><?php echo esc_html($item['item_title']); ?></h3>
                                <p><?php echo esc_html($item['item_content']); ?></p>
                            </div>
                            
                            <div class="timeline-icon" style="background: <?php echo esc_attr($icon_color); ?>;">
                                <?php \Elementor\Icons_Manager::render_icon($item['item_icon'], ['aria-hidden' => 'true']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- GSAP & ScrollTrigger -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
        <?php if ($use_lottie && !empty($lottie_url)) : ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
        <?php endif; ?>

        <script>
            (function() {
                const widgetId = '<?php echo $widget_id; ?>';
                const container = document.getElementById('timeline-' + widgetId);
                
                if (!container || container.dataset.gsapInitialized) return;
                container.dataset.gsapInitialized = 'true';
                
                // Wait for GSAP to load
                function initGSAPTimeline() {
                    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
                        setTimeout(initGSAPTimeline, 100);
                        return;
                    }

                    gsap.registerPlugin(ScrollTrigger);

                    const timelineItems = container.querySelectorAll('[data-timeline-item]');
                    const useLottie = <?php echo $use_lottie ? 'true' : 'false'; ?>;
                    const lottieUrl = '<?php echo esc_js($lottie_url); ?>';

                    // LOTTIE LINE ANIMATION
                    if (useLottie && lottieUrl && typeof lottie !== 'undefined') {
                        const lottieContainer = document.getElementById('lottie-line-' + widgetId);
                        if (lottieContainer) {
                            const anim = lottie.loadAnimation({
                                container: lottieContainer,
                                renderer: 'svg',
                                loop: false,
                                autoplay: false,
                                path: lottieUrl
                            });

                            ScrollTrigger.create({
                                trigger: container,
                                start: 'top top',
                                end: 'bottom bottom',
                                scrub: 1,
                                onUpdate: self => {
                                    const progress = self.progress;
                                    anim.goToAndStop(progress * anim.totalFrames, true);
                                }
                            });
                        }
                    } 
                    // SVG LINE ANIMATION
                    else {
                        const timelinePath = container.querySelector('.timeline-line path');
                        if (timelinePath) {
                            // Apply dynamic color from Elementor control
                            timelinePath.setAttribute('stroke', '<?php echo esc_js($line_color); ?>');
                            
                            const pathLength = timelinePath.getTotalLength();
                            timelinePath.style.strokeDasharray = pathLength;
                            timelinePath.style.strokeDashoffset = pathLength;

                            gsap.to(timelinePath, {
                                strokeDashoffset: 0,
                                ease: 'none',
                                scrollTrigger: {
                                    trigger: container,
                                    start: 'top top',
                                    end: 'bottom bottom',
                                    scrub: 1
                                }
                            });
                        }
                    }

                    // ANIMATE EACH TIMELINE ITEM
                    timelineItems.forEach((item, index) => {
                        const imgOverlay = item.querySelector('.timeline-image::before') || item.querySelector('.timeline-image');
                        const textBox = item.querySelector('.timeline-text-box');
                        const icon = item.querySelector('.timeline-icon');
                        const isLeft = item.classList.contains('position-left');

                        const tl = gsap.timeline({
                            scrollTrigger: {
                                trigger: item,
                                start: 'top 80%',
                                end: 'top 40%',
                                scrub: 1,
                            }
                        });

                        // Image wipe reveal
                        tl.fromTo(item.querySelector('.timeline-image::before'),
                            { scaleX: 1 },
                            { 
                                scaleX: 0, 
                                transformOrigin: isLeft ? 'left' : 'right',
                                duration: 0.6,
                                ease: 'power2.inOut'
                            }
                        );

                        // Text slide from same side
                        tl.fromTo(textBox,
                            { x: isLeft ? -100 : 100, opacity: 0 },
                            { x: 0, opacity: 1, duration: 0.6, ease: 'power2.out' },
                            '<0.2'
                        );

                        // Icon scale in
                        tl.fromTo(icon,
                            { scale: 0, opacity: 0 },
                            { scale: 1, opacity: 1, duration: 0.5, ease: 'back.out(1.7)' },
                            '<0.3'
                        );
                    });

                    // Refresh ScrollTrigger after layout changes
                    ScrollTrigger.refresh();
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initGSAPTimeline);
                } else {
                    initGSAPTimeline();
                }
            })();
        </script>
        <?php
    }
}
?>