<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_3Cards_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return '3cards_widget';
    }

    public function get_title() {
        return __('3 Cards Widget', 'textdomain');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['cards', '3cards', 'animation', 'slide'];
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
            'text_content',
            [
                'label' => __('Left Text Content', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __("The founder's building it.", 'textdomain'),
                'placeholder' => __('Type your text here', 'textdomain'),
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label' => __('Layout Style', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text_left_cards_right',
                'options' => [
                    'text_left_cards_right' => __('Title Left - Cards Right', 'textdomain'),
                    'cards_left_text_right' => __('Cards Left - Title Right', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'image_aspect_ratio',
            [
                'label' => __('Image Aspect Ratio', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'landscape',
                'options' => [
                    'landscape' => __('Landscape (280x200)', 'textdomain'),
                    'square' => __('Square (280x280)', 'textdomain'),
                    'portrait' => __('Portrait (280x350)', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'text_position',
            [
                'label' => __('Text Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'top' => __('Top', 'textdomain'),
                    'center' => __('Center', 'textdomain'),
                    'bottom' => __('Bottom', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'card_text_alignment',
            [
                'label' => __('Card Text Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'left' => __('Left', 'textdomain'),
                    'center' => __('Center', 'textdomain'),
                    'right' => __('Right', 'textdomain'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .card-text' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .card-title' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .card-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Cards Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'card_title',
            [
                'label' => __('Card Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Card Title', 'textdomain'),
                'placeholder' => __('Type card title here', 'textdomain'),
            ]
        );

        $repeater->add_control(
            'card_description',
            [
                'label' => __('Card Description', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Card description goes here', 'textdomain'),
                'placeholder' => __('Type card description here', 'textdomain'),
            ]
        );

        $repeater->add_control(
            'card_image',
            [
                'label' => __('Card Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'cards_list',
            [
                'label' => __('Cards', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'card_title' => __('Innovation', 'textdomain'),
                        'card_description' => __('Cutting-edge solutions for modern challenges', 'textdomain'),
                    ],
                    [
                        'card_title' => __('Growth', 'textdomain'),
                        'card_description' => __('Scaling your business to new heights', 'textdomain'),
                    ],
                    [
                        'card_title' => __('Success', 'textdomain'),
                        'card_description' => __('Achieving your goals with precision', 'textdomain'),
                    ],
                ],
                'title_field' => '{{{ card_title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section - Text
        $this->start_controls_section(
            'text_style_section',
            [
                'label' => __('Text Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .widget-title',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a1a1a',
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Cards Text
        $this->start_controls_section(
            'cards_text_style_section',
            [
                'label' => __('Cards Text Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_title_typography',
                'label' => __('Title Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .card-title',
            ]
        );

        $this->add_control(
            'card_title_color',
            [
                'label' => __('Title Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a1a1a',
                'selectors' => [
                    '{{WRAPPER}} .card-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_description_typography',
                'label' => __('Description Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .card-description',
            ]
        );

        $this->add_control(
            'card_description_color',
            [
                'label' => __('Description Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#6b7280',
                'selectors' => [
                    '{{WRAPPER}} .card-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Cards
        $this->start_controls_section(
            'cards_style_section',
            [
                'label' => __('Cards Images Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_background',
            [
                'label' => __('Image Container Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .card-image' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __('Image Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .card-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .card-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .card-image',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .card-image',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="three-cards-widget layout-<?php echo esc_attr($settings['layout_style']); ?>">
            <div class="widget-container">
                
                <?php if ($settings['layout_style'] === 'text_left_cards_right'): ?>
                    <!-- Title Left - Cards Right Layout -->
                    <div class="text-section text-position-<?php echo esc_attr($settings['text_position']); ?>">
                        <h2 class="widget-title"><?php echo esc_html($settings['text_content']); ?></h2>
                    </div>
                    
                    <div class="cards-section image-ratio-<?php echo esc_attr($settings['image_aspect_ratio']); ?>">
                        <?php if ($settings['cards_list']): ?>
                            <?php foreach ($settings['cards_list'] as $index => $card): ?>
                                <div class="card card-<?php echo $index + 1; ?>" data-delay="<?php echo $index * 200; ?>">
                                    <div class="card-content">
                                        <?php if (!empty($card['card_image']['url'])): ?>
                                            <div class="card-image">
                                                <img src="<?php echo esc_url($card['card_image']['url']); ?>" 
                                                     alt="<?php echo esc_attr($card['card_title']); ?>"
                                                     loading="lazy">
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-text">
                                            <h3 class="card-title"><?php echo esc_html($card['card_title']); ?></h3>
                                            <p class="card-description"><?php echo esc_html($card['card_description']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                <?php else: ?>
                    <!-- Cards Left - Title Right Layout -->
                    <div class="cards-section image-ratio-<?php echo esc_attr($settings['image_aspect_ratio']); ?>">
                        <?php if ($settings['cards_list']): ?>
                            <?php foreach ($settings['cards_list'] as $index => $card): ?>
                                <div class="card card-<?php echo $index + 1; ?>" data-delay="<?php echo $index * 200; ?>">
                                    <div class="card-content">
                                        <?php if (!empty($card['card_image']['url'])): ?>
                                            <div class="card-image">
                                                <img src="<?php echo esc_url($card['card_image']['url']); ?>" 
                                                     alt="<?php echo esc_attr($card['card_title']); ?>"
                                                     loading="lazy">
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-text">
                                            <h3 class="card-title"><?php echo esc_html($card['card_title']); ?></h3>
                                            <p class="card-description"><?php echo esc_html($card['card_description']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <div class="text-section text-position-<?php echo esc_attr($settings['text_position']); ?>">
                        <h2 class="widget-title"><?php echo esc_html($settings['text_content']); ?></h2>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>

        <style>
        .elementor-widget-3cards_widget .three-cards-widget {
            width: 100%;
            padding: 60px 0;
            overflow: hidden;
        }

        .elementor-widget-3cards_widget .widget-container {
            max-width: 100%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 60px;
            align-items: center;
            min-height: 500px;
            padding: 0 20px;
        }

        /* Text Section Styles */
        .elementor-widget-3cards_widget .text-section {
            display: flex;
            height: 100%;
        }

        .elementor-widget-3cards_widget .text-section.text-position-top {
            align-items: flex-start;
        }

        .elementor-widget-3cards_widget .text-section.text-position-center {
            align-items: center;
        }

        .elementor-widget-3cards_widget .text-section.text-position-bottom {
            align-items: flex-end;
        }

        .elementor-widget-3cards_widget .widget-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            color: #1a1a1a;
            margin: 0;
            letter-spacing: -0.02em;
        }

        /* Cards Section Styles */
        .elementor-widget-3cards_widget .cards-section {
            position: relative;
            display: flex;
            flex-direction: row;
            gap: 24px;
            height: 100%;
            justify-content: center;
            align-items: center;
        }

        .elementor-widget-3cards_widget .card {
            background: transparent;
            border-radius: 0;
            padding: 0;
            box-shadow: none;
            transform: translateX(100px);
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .elementor-widget-3cards_widget .card.animate-in {
            transform: translateX(0);
            opacity: 1;
        }

        .elementor-widget-3cards_widget .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            text-align: center;
            width: 100%;
        }

        .elementor-widget-3cards_widget .card-image {
            width: 280px;
            height: 200px;
            overflow: hidden;
            background: transparent;
            border-radius: 0;
            margin-bottom: 16px;
        }

        /* Image Aspect Ratio Variations */
        .elementor-widget-3cards_widget .image-ratio-square .card-image {
            height: 280px;
        }

        .elementor-widget-3cards_widget .image-ratio-portrait .card-image {
            height: 350px;
        }

        /* Layout Variations */
        .elementor-widget-3cards_widget.layout-cards_left_text_right .widget-container {
            grid-template-columns: 2fr 1fr;
        }

        .elementor-widget-3cards_widget.layout-cards_left_text_right .card {
            transform: translateX(-100px);
        }

        .elementor-widget-3cards_widget.layout-cards_left_text_right .card.animate-in {
            transform: translateX(0);
        }

        .elementor-widget-3cards_widget.layout-cards_left_text_right .card:hover {
            transform: translateX(0) translateY(-8px);
        }

        .elementor-widget-3cards_widget .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .elementor-widget-3cards_widget .card-text {
            width: 100%;
            max-width: 280px;
        }

        .elementor-widget-3cards_widget .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0 0 8px 0;
        }

        .elementor-widget-3cards_widget .card-description {
            font-size: 1rem;
            color: #6b7280;
            line-height: 1.5;
            margin: 0;
        }

        /* Hover Effects */
        .elementor-widget-3cards_widget .card:hover {
            transform: translateX(0) translateY(-8px);
        }

        .elementor-widget-3cards_widget .card:hover .card-image img {
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .elementor-widget-3cards_widget .widget-container {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }
            
            .elementor-widget-3cards_widget .widget-title {
                font-size: 2.5rem;
            }
            
            .elementor-widget-3cards_widget .cards-section {
                flex-direction: column;
            }
            
            .elementor-widget-3cards_widget .card-content {
                align-items: center;
                text-align: center;
            }
            
            .elementor-widget-3cards_widget .card-image {
                width: 250px;
                height: 180px;
            }
            
            .elementor-widget-3cards_widget .image-ratio-square .card-image {
                height: 250px;
            }

            .elementor-widget-3cards_widget .image-ratio-portrait .card-image {
                height: 310px;
            }
        }

        @media (max-width: 480px) {
            .elementor-widget-3cards_widget .three-cards-widget {
                padding: 40px 0;
            }
            
            .elementor-widget-3cards_widget .widget-title {
                font-size: 2rem;
            }
            
            .elementor-widget-3cards_widget .card-image {
                width: 200px;
                height: 150px;
            }
            
            .elementor-widget-3cards_widget .image-ratio-square .card-image {
                height: 200px;
            }

            .elementor-widget-3cards_widget .image-ratio-portrait .card-image {
                height: 250px;
            }
            
            .elementor-widget-3cards_widget .card-text {
                max-width: 200px;
            }
            
            .elementor-widget-3cards_widget .widget-container {
                padding: 0 16px;
            }
        }
        </style>

        <script>
        jQuery(document).ready(function($) {
            // Intersection Observer for animation trigger
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const widget = entry.target;
                        const cards = widget.querySelectorAll('.card');
                        
                        cards.forEach((card, index) => {
                            const delay = parseInt(card.dataset.delay);
                            setTimeout(() => {
                                card.classList.add('animate-in');
                            }, delay);
                        });
                        
                        observer.unobserve(widget);
                    }
                });
            }, observerOptions);
            
            // Observe the widget
            const widgets = document.querySelectorAll('.elementor-widget-3cards_widget .three-cards-widget');
            widgets.forEach(widget => {
                observer.observe(widget);
            });
        });
        </script>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        view.addRenderAttribute('widget_title', 'class', 'widget-title');
        #>
        <div class="three-cards-widget layout-{{{ settings.layout_style }}}">
            <div class="widget-container">
                
                <# if (settings.layout_style === 'text_left_cards_right') { #>
                    <!-- Text Left - Cards Right Layout -->
                    <div class="text-section text-position-{{{ settings.text_position }}}">
                        <h2 {{{ view.getRenderAttributeString('widget_title') }}}>{{{ settings.text_content }}}</h2>
                    </div>
                    
                    <div class="cards-section image-ratio-{{{ settings.image_aspect_ratio }}}">
                        <# if (settings.cards_list.length) { #>
                            <# _.each(settings.cards_list, function(card, index) { #>
                                <div class="card card-{{{ index + 1 }}}" data-delay="{{{ index * 200 }}}">
                                    <div class="card-content">
                                        <# if (card.card_image.url) { #>
                                            <div class="card-image">
                                                <img src="{{{ card.card_image.url }}}" alt="{{{ card.card_title }}}" loading="lazy">
                                            </div>
                                        <# } #>
                                        <div class="card-text">
                                            <h3 class="card-title">{{{ card.card_title }}}</h3>
                                            <p class="card-description">{{{ card.card_description }}}</p>
                                        </div>
                                    </div>
                                </div>
                            <# }); #>
                        <# } #>
                    </div>
                    
                <# } else { #>
                    <!-- Cards Left - Text Right Layout -->
                    <div class="cards-section image-ratio-{{{ settings.image_aspect_ratio }}}">
                        <# if (settings.cards_list.length) { #>
                            <# _.each(settings.cards_list, function(card, index) { #>
                                <div class="card card-{{{ index + 1 }}}" data-delay="{{{ index * 200 }}}">
                                    <div class="card-content">
                                        <# if (card.card_image.url) { #>
                                            <div class="card-image">
                                                <img src="{{{ card.card_image.url }}}" alt="{{{ card.card_title }}}" loading="lazy">
                                            </div>
                                        <# } #>
                                        <div class="card-text">
                                            <h3 class="card-title">{{{ card.card_title }}}</h3>
                                            <p class="card-description">{{{ card.card_description }}}</p>
                                        </div>
                                    </div>
                                </div>
                            <# }); #>
                        <# } #>
                    </div>
                    
                    <div class="text-section text-position-{{{ settings.text_position }}}">
                        <h2 {{{ view.getRenderAttributeString('widget_title') }}}>{{{ settings.text_content }}}</h2>
                    </div>
                <# } #>
                
            </div>
        </div>
        <?php
    }
}
?>