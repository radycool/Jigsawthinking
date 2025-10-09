<?php
/**
 * Elementor Hero1 Widget
 * 
 * A comprehensive hero section widget with advanced customization options
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Elementor_Hero1_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hero1-section';
    }

    public function get_title() {
        return esc_html__('Hero Section 1', 'textdomain');
    }

    public function get_icon() {
        return 'eicon-slider-full-screen';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['hero', 'banner', 'section', 'background', 'video'];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label' => esc_html__('Heading', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__("YOU DIDN'T QUIT\nYOUR 9-TO-5\nTO WORK 24/7", 'textdomain'),
                'placeholder' => esc_html__('Enter your heading', 'textdomain'),
            ]
        );

        $this->add_control(
            'subheading_text',
            [
                'label' => esc_html__('Subheading', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => '',
                'placeholder' => esc_html__('Enter your subheading', 'textdomain'),
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => esc_html__('Description', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => '',
                'placeholder' => esc_html__('Enter your description', 'textdomain'),
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label' => esc_html__('Show Button', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'textdomain'),
                'label_off' => esc_html__('Hide', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Learn More', 'textdomain'),
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'textdomain'),
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Background Section
        $this->start_controls_section(
            'background_section',
            [
                'label' => esc_html__('Background', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'background_type',
            [
                'label' => esc_html__('Background Type', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'textdomain'),
                    'video' => esc_html__('Video', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'background_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'background_video',
            [
                'label' => esc_html__('Background Video URL', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter video URL (MP4)', 'textdomain'),
                'condition' => [
                    'background_type' => 'video',
                ],
            ]
        );

        $this->add_control(
            'fallback_image',
            [
                'label' => esc_html__('Video Fallback Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__('Fallback image for when video cannot play', 'textdomain'),
                'condition' => [
                    'background_type' => 'video',
                ],
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Overlay Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.4)',
            ]
        );

        $this->add_control(
            'overlay_opacity',
            [
                'label' => esc_html__('Overlay Opacity', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 40,
                ],
            ]
        );

        $this->end_controls_section();

        // Layout Section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_height',
            [
                'label' => esc_html__('Section Height', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '100vh',
                'options' => [
                    '50vh' => esc_html__('50% Viewport', 'textdomain'),
                    '75vh' => esc_html__('75% Viewport', 'textdomain'),
                    '100vh' => esc_html__('Full Viewport', 'textdomain'),
                    'auto' => esc_html__('Auto Height', 'textdomain'),
                    'custom' => esc_html__('Custom', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'custom_height',
            [
                'label' => esc_html__('Custom Height', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 2000,
                    ],
                    'vh' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 600,
                ],
                'condition' => [
                    'section_height' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'content_position',
            [
                'label' => esc_html__('Content Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'center-center',
                'options' => [
                    'default' => esc_html__('Default (Centered)', 'textdomain'),
                    'top-left' => esc_html__('Top Left', 'textdomain'),
                    'top-center' => esc_html__('Top Center', 'textdomain'),
                    'top-right' => esc_html__('Top Right', 'textdomain'),
                    'center-left' => esc_html__('Center Left', 'textdomain'),
                    'center-center' => esc_html__('Center Center', 'textdomain'),
                    'center-right' => esc_html__('Center Right', 'textdomain'),
                    'bottom-left' => esc_html__('Bottom Left', 'textdomain'),
                    'bottom-center' => esc_html__('Bottom Center', 'textdomain'),
                    'bottom-right' => esc_html__('Bottom Right', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'text_alignment',
            [
                'label' => esc_html__('Text Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
            ]
        );

        $this->end_controls_section();

        // Animation Section
        $this->start_controls_section(
            'animation_section',
            [
                'label' => esc_html__('Animation', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'entrance_animation',
            [
                'label' => esc_html__('Entrance Animation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'fade-in',
                'options' => [
                    'none' => esc_html__('None', 'textdomain'),
                    'fade-in' => esc_html__('Fade In', 'textdomain'),
                    'slide-up' => esc_html__('Slide Up', 'textdomain'),
                    'slide-left' => esc_html__('Slide Left', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'enable_parallax',
            [
                'label' => esc_html__('Enable Parallax', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        // Style Tab - Heading Styles
        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => esc_html__('Heading', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_style',
            [
                'label' => esc_html__('Heading Style', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'bold',
                'options' => [
                    'modern' => esc_html__('Modern', 'textdomain'),
                    'bold' => esc_html__('Bold', 'textdomain'),
                    'elegant' => esc_html__('Elegant', 'textdomain'),
                    'tech' => esc_html__('Tech', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'heading_size',
            [
                'label' => esc_html__('Heading Size', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'large',
                'options' => [
                    'small' => esc_html__('Small', 'textdomain'),
                    'medium' => esc_html__('Medium', 'textdomain'),
                    'large' => esc_html__('Large', 'textdomain'),
                    'extra-large' => esc_html__('Extra Large', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Heading Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero1-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .hero1-heading',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_text_shadow',
                'selector' => '{{WRAPPER}} .hero1-heading',
            ]
        );

        $this->end_controls_section();

        // Style Tab - Subheading Styles
        $this->start_controls_section(
            'subheading_style_section',
            [
                'label' => esc_html__('Subheading', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'subheading_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'subheading_color',
            [
                'label' => esc_html__('Subheading Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero1-subheading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subheading_typography',
                'selector' => '{{WRAPPER}} .hero1-subheading',
            ]
        );

        $this->end_controls_section();

        // Style Tab - Description Styles
        $this->start_controls_section(
            'description_style_section',
            [
                'label' => esc_html__('Description', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'description_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero1-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .hero1-description',
            ]
        );

        $this->end_controls_section();

        // Style Tab - Button Styles
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__('Button', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label' => esc_html__('Button Style', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'solid' => esc_html__('Solid', 'textdomain'),
                    'outline' => esc_html__('Outline', 'textdomain'),
                    'glass' => esc_html__('Glass Effect', 'textdomain'),
                ],
            ]
        );

        $this->start_controls_tabs('button_style_tabs');

        $this->start_controls_tab(
            'button_normal_tab',
            [
                'label' => esc_html__('Normal', 'textdomain'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .hero1-button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background',
            [
                'label' => esc_html__('Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero1-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__('Border Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero1-button' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => esc_html__('Hover', 'textdomain'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__('Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero1-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background',
            [
                'label' => esc_html__('Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero1-button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero1-button:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .hero1-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .hero1-button',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hero1-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hero1-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .hero1-button',
            ]
        );

        $this->end_controls_section();

        // Advanced Section
        $this->start_controls_section(
            'advanced_section',
            [
                'label' => esc_html__('Advanced', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $this->add_control(
            'custom_css_class',
            [
                'label' => esc_html__('CSS Classes', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('my-custom-class', 'textdomain'),
                'description' => esc_html__('Add custom CSS classes separated by spaces.', 'textdomain'),
            ]
        );

        $this->add_control(
            'custom_id',
            [
                'label' => esc_html__('CSS ID', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('my-hero-section', 'textdomain'),
                'description' => esc_html__('Add a custom ID for this section.', 'textdomain'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Generate unique ID
        $widget_id = $settings['custom_id'] ? $settings['custom_id'] : 'hero1-' . $this->get_id();

        // Build CSS classes
        $css_classes = ['hero1-section'];
        
        if (!empty($settings['custom_css_class'])) {
            $css_classes[] = $settings['custom_css_class'];
        }

        // Add height class
        if ($settings['section_height'] !== 'custom') {
            $css_classes[] = 'height-' . str_replace('vh', 'vh', $settings['section_height']);
        }

        // Content classes
        $content_classes = ['hero1-content'];
        $content_classes[] = 'align-' . $settings['text_alignment'];
        
        if ($settings['content_position'] !== 'default') {
            $content_classes[] = 'position-' . $settings['content_position'];
        }

        if ($settings['entrance_animation'] !== 'none') {
            $content_classes[] = 'animate-' . $settings['entrance_animation'];
        }

        // Heading classes
        $heading_classes = ['hero1-heading'];
        $heading_classes[] = 'style-' . $settings['heading_style'];
        $heading_classes[] = 'size-' . $settings['heading_size'];

        // Button classes
        $button_classes = ['hero1-button'];
        $button_classes[] = 'style-' . $settings['button_style'];

        // Data attributes
        $data_attrs = [
            'data-animation="' . $settings['entrance_animation'] . '"',
            'data-overlay-opacity="' . ($settings['overlay_opacity']['size'] / 100) . '"',
            'data-parallax="' . ($settings['enable_parallax'] === 'yes' ? 'true' : 'false') . '"'
        ];

        if (!empty($settings['overlay_color'])) {
            $data_attrs[] = 'data-overlay-color="' . $settings['overlay_color'] . '"';
        }

        // Generate inline styles
        $section_styles = [];
        if ($settings['section_height'] === 'custom') {
            $section_styles[] = 'min-height: ' . $settings['custom_height']['size'] . $settings['custom_height']['unit'];
        }
        $section_style_attr = !empty($section_styles) ? 'style="' . implode('; ', $section_styles) . ';"' : '';

        $overlay_styles = [];
        if (!empty($settings['overlay_color'])) {
            $overlay_styles[] = 'background: ' . $settings['overlay_color'];
        }
        $overlay_styles[] = 'opacity: ' . ($settings['overlay_opacity']['size'] / 100);
        $overlay_style_attr = 'style="' . implode('; ', $overlay_styles) . ';"';
        ?>

        <div id="<?php echo esc_attr($widget_id); ?>" 
             class="<?php echo esc_attr(implode(' ', $css_classes)); ?>"
             <?php echo implode(' ', $data_attrs); ?>
             <?php echo $section_style_attr; ?>>

            <!-- Background Media -->
            <div class="hero1-media-container">
                <?php if ($settings['background_type'] === 'video' && !empty($settings['background_video'])): ?>
                    <video class="hero1-background-video" autoplay muted loop playsinline>
                        <source src="<?php echo esc_url($settings['background_video']); ?>" type="video/mp4">
                    </video>
                    <?php if (!empty($settings['fallback_image']['url'])): ?>
                        <img class="hero1-background-image" 
                             src="<?php echo esc_url($settings['fallback_image']['url']); ?>" 
                             alt="<?php echo esc_attr($settings['heading_text']); ?>" 
                             style="display: none;">
                    <?php endif; ?>
                <?php else: ?>
                    <img class="hero1-background-image" 
                         src="<?php echo esc_url($settings['background_image']['url']); ?>" 
                         alt="<?php echo esc_attr($settings['heading_text']); ?>">
                <?php endif; ?>
            </div>

            <!-- Overlay -->
            <div class="hero1-overlay" <?php echo $overlay_style_attr; ?>>
            </div>

            <!-- Content -->
            <div class="<?php echo esc_attr(implode(' ', $content_classes)); ?>">
                <?php if (!empty($settings['heading_text'])): ?>
                    <h1 class="<?php echo esc_attr(implode(' ', $heading_classes)); ?>">
                        <?php echo wp_kses_post(nl2br($settings['heading_text'])); ?>
                    </h1>
                <?php endif; ?>

                <?php if (!empty($settings['subheading_text'])): ?>
                    <h2 class="hero1-subheading">
                        <?php echo wp_kses_post($settings['subheading_text']); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($settings['description_text'])): ?>
                    <p class="hero1-description">
                        <?php echo wp_kses_post(nl2br($settings['description_text'])); ?>
                    </p>
                <?php endif; ?>

                <?php if ($settings['show_button'] === 'yes' && !empty($settings['button_text'])): ?>
                    <?php
                    $target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                    ?>
                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>" 
                       class="<?php echo esc_attr(implode(' ', $button_classes)); ?>"<?php echo $target . $nofollow; ?>>
                        <?php echo esc_html($settings['button_text']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <style>
        /* Base styles - ensure proper layering */
        #<?php echo esc_attr($widget_id); ?> {
            position: relative !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            min-height: 100vh !important;
            overflow: hidden !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-media-container {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            z-index: 1 !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-background-image,
        #<?php echo esc_attr($widget_id); ?> .hero1-background-video {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-overlay {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            z-index: 2 !important;
        }
        
        /* Default content positioning - only when no specific position is set */
        #<?php echo esc_attr($widget_id); ?> .hero1-content:not(.position-top-left):not(.position-top-center):not(.position-top-right):not(.position-center-left):not(.position-center-center):not(.position-center-right):not(.position-bottom-left):not(.position-bottom-center):not(.position-bottom-right) {
            position: relative !important;
            z-index: 999 !important;
            padding: 40px 5% !important;
            max-width: 50% !important;
            color: white !important;
            text-align: left !important;
        }
        
        /* Specific positioning classes */
        #<?php echo esc_attr($widget_id); ?> .hero1-content.position-top-left {
            position: absolute !important;
            top: 10% !important;
            left: 5% !important;
            transform: none !important;
            z-index: 999 !important;
            max-width: 45% !important;
            padding: 20px !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-content.position-top-center {
            position: absolute !important;
            top: 10% !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            z-index: 999 !important;
            max-width: 80% !important;
            padding: 20px !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-content.position-top-right {
            position: absolute !important;
            top: 10% !important;
            right: 5% !important;
            transform: none !important;
            z-index: 999 !important;
            max-width: 45% !important;
            padding: 20px !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-content.position-center-left {
            position: absolute !important;
            top: 50% !important;
            left: 5% !important;
            transform: translateY(-50%) !important;
            z-index: 999 !important;
            max-width: 45% !important;
            padding: 20px !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-content.position-center-center {
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            z-index: 999 !important;
            max-width: 80% !important;
            padding: 20px !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-content.position-center-right {
            position: absolute !important;
            top: 50% !important;
            right: 5% !important;
            transform: translateY(-50%) !important;
            z-index: 999 !important;
            max-width: 45% !important;
            padding: 20px !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-content.position-bottom-left {
            position: absolute !important;
            bottom: 10% !important;
            left: 5% !important;
            transform: none !important;
            z-index: 999 !important;
            max-width: 45% !important;
            padding: 20px !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-content.position-bottom-center {
            position: absolute !important;
            bottom: 10% !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            z-index: 999 !important;
            max-width: 80% !important;
            padding: 20px !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-content.position-bottom-right {
            position: absolute !important;
            bottom: 10% !important;
            right: 5% !important;
            transform: none !important;
            z-index: 999 !important;
            max-width: 45% !important;
            padding: 20px !important;
        }
        
        /* Text color and shadows for all content */
        #<?php echo esc_attr($widget_id); ?> .hero1-content {
            color: white !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-heading {
            color: white !important;
            font-weight: 900 !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8) !important;
            margin-bottom: 20px !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-subheading {
            color: rgba(255, 255, 255, 0.9) !important;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8) !important;
        }
        
        #<?php echo esc_attr($widget_id); ?> .hero1-description {
            color: rgba(255, 255, 255, 0.85) !important;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8) !important;
        }
        
        /* Adjust main container based on positioning */
        #<?php echo esc_attr($widget_id); ?>:has(.position-center-center),
        #<?php echo esc_attr($widget_id); ?>:has(.position-top-center),
        #<?php echo esc_attr($widget_id); ?>:has(.position-bottom-center) {
            justify-content: center !important;
        }
        
        #<?php echo esc_attr($widget_id); ?>:has(.position-center-right),
        #<?php echo esc_attr($widget_id); ?>:has(.position-top-right),
        #<?php echo esc_attr($widget_id); ?>:has(.position-bottom-right) {
            justify-content: flex-end !important;
        }
        
        /* Mobile responsive */
        @media (max-width: 768px) {
            #<?php echo esc_attr($widget_id); ?> {
                justify-content: center !important;
                align-items: center !important;
            }
            
            #<?php echo esc_attr($widget_id); ?> .hero1-content {
                position: relative !important;
                top: auto !important;
                left: auto !important;
                right: auto !important;
                bottom: auto !important;
                transform: none !important;
                max-width: 90% !important;
                text-align: center !important;
                padding: 20px 5% !important;
            }
        }
        </style>

        <?php
        // Enqueue scripts and styles
        $this->enqueue_hero_assets();
    }

    private function enqueue_hero_assets() {
        // Enqueue CSS
        wp_enqueue_style(
            'hero1-style',
            plugin_dir_url(__FILE__) . '../hero1.css',
            [],
            '1.0.0'
        );

        // Enqueue JavaScript
        wp_enqueue_script(
            'hero1-script',
            plugin_dir_url(__FILE__) . '../hero1.js',
            [],
            '1.0.0',
            true
        );
    }

    protected function content_template() {
        ?>
        <#
        var widget_id = settings.custom_id ? settings.custom_id : 'hero1-' + view.model.id;
        var css_classes = ['hero1-section'];
        
        if (settings.custom_css_class) {
            css_classes.push(settings.custom_css_class);
        }

        if (settings.section_height !== 'custom') {
            css_classes.push('height-' + settings.section_height.replace('vh', 'vh'));
        }

        var content_classes = ['hero1-content'];
        content_classes.push('align-' + settings.text_alignment);
        
        if (settings.content_position !== 'default') {
            content_classes.push('position-' + settings.content_position);
        }

        if (settings.entrance_animation !== 'none') {
            content_classes.push('animate-' + settings.entrance_animation);
        }

        var heading_classes = ['hero1-heading'];
        heading_classes.push('style-' + settings.heading_style);
        heading_classes.push('size-' + settings.heading_size);

        var button_classes = ['hero1-button'];
        button_classes.push('style-' + settings.button_style);

        var customHeight = settings.section_height === 'custom' ? 'min-height: ' + settings.custom_height.size + settings.custom_height.unit + ';' : '';
        #>

        <div id="{{ widget_id }}" 
             class="{{ css_classes.join(' ') }}"
             data-animation="{{ settings.entrance_animation }}"
             data-overlay-opacity="{{ settings.overlay_opacity.size / 100 }}"
             data-overlay-color="{{ settings.overlay_color }}"
             data-parallax="{{ settings.enable_parallax === 'yes' ? 'true' : 'false' }}"
             <# if (customHeight) { #>style="{{ customHeight }}"<# } #>>

            <!-- Background Media -->
            <div class="hero1-media-container">
                <# if (settings.background_type === 'video' && settings.background_video) { #>
                    <video class="hero1-background-video" autoplay muted loop playsinline>
                        <source src="{{ settings.background_video }}" type="video/mp4">
                    </video>
                    <# if (settings.fallback_image.url) { #>
                        <img class="hero1-background-image" 
                             src="{{ settings.fallback_image.url }}" 
                             alt="{{ settings.heading_text }}" 
                             style="display: none;">
                    <# } #>
                <# } else { #>
                    <img class="hero1-background-image" 
                         src="{{ settings.background_image.url }}" 
                         alt="{{ settings.heading_text }}">
                <# } #>
            </div>

            <!-- Overlay -->
            <div class="hero1-overlay" 
                 style="background: {{ settings.overlay_color }}; opacity: {{ settings.overlay_opacity.size / 100 }};"></div>

            <!-- Content -->
            <div class="{{ content_classes.join(' ') }}">
                <# if (settings.heading_text) { #>
                    <h1 class="{{ heading_classes.join(' ') }}">
                        {{{ settings.heading_text.replace(/\n/g, '<br>') }}}
                    </h1>
                <# } #>

                <# if (settings.subheading_text) { #>
                    <h2 class="hero1-subheading">
                        {{{ settings.subheading_text }}}
                    </h2>
                <# } #>

                <# if (settings.description_text) { #>
                    <p class="hero1-description">
                        {{{ settings.description_text.replace(/\n/g, '<br>') }}}
                    </p>
                <# } #>

                <# if (settings.show_button === 'yes' && settings.button_text) { #>
                    <a href="{{ settings.button_link.url }}" 
                       class="{{ button_classes.join(' ') }}"
                       <# if (settings.button_link.is_external) { #>target="_blank"<# } #>
                       <# if (settings.button_link.nofollow) { #>rel="nofollow"<# } #>>
                        {{ settings.button_text }}
                    </a>
                <# } #>
            </div>
        </div>
        <?php
    }
}

// Register the widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor_Hero1_Widget());

?>