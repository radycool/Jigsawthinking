<?php
if (!defined('ABSPATH')) {
    exit;
}

class Elementor_Hero2_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hero2_widget';
    }

    public function get_title() {
        return esc_html__('Hero Section 2', 'textdomain');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['basic'];
    }

    public function get_keywords() {
        return ['hero', 'banner', 'section'];
    }

    // FIXED: Proper CSS enqueue method
    public function get_style_depends() {
        return ['hero2-widget-styles'];
    }

    protected function register_controls() {
        
        // Content Tab
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
                'label' => esc_html__('Main Heading', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('WE DON\'T JUST COACH YOUR BUSINESS.', 'textdomain'),
                'placeholder' => esc_html__('Enter your main heading', 'textdomain'),
            ]
        );

        $this->add_control(
            'subheading_text',
            [
                'label' => esc_html__('Subheading', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('WE COACH YOU — THE FOUNDER BUILDING IT.', 'textdomain'),
                'placeholder' => esc_html__('Enter your subheading', 'textdomain'),
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => esc_html__('Description (Optional)', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Enter description text', 'textdomain'),
            ]
        );

        $this->end_controls_section();

        // FIXED: Media Section
        $this->start_controls_section(
            'media_section',
            [
                'label' => esc_html__('Background Media', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'media_type',
            [
                'label' => esc_html__('Media Type', 'textdomain'),
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
                'label' => esc_html__('Choose Background Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'media_type' => 'image',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero2-background-image' => 'background-image: url("{{URL}}");',
                ],
            ]
        );

        $this->add_control(
            'background_video',
            [
                'label' => esc_html__('Choose Background Video', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_types' => ['video'],
                'condition' => [
                    'media_type' => 'video',
                ],
            ]
        );

        $this->end_controls_section();

        // FIXED: Layout Section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout Settings', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'content_position',
            [
                'label' => esc_html__('Content Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'center-center',
                'options' => [
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
                'toggle' => true,
            ]
        );

        $this->add_responsive_control(
            'min_height',
            [
                'label' => esc_html__('Section Height', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 400,
                        'max' => 1200,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 50,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'vh',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero2-container' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // FIXED: Style Controls
        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => esc_html__('Main Heading Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .hero2-heading',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Heading Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero2-heading' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_text_shadow',
                'selector' => '{{WRAPPER}} .hero2-heading',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'subheading_style_section',
            [
                'label' => esc_html__('Subheading Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subheading_typography',
                'selector' => '{{WRAPPER}} .hero2-subheading',
            ]
        );

        $this->add_control(
            'subheading_color',
            [
                'label' => esc_html__('Subheading Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero2-subheading' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'subheading_text_shadow',
                'selector' => '{{WRAPPER}} .hero2-subheading',
            ]
        );

        $this->end_controls_section();

        // FIXED: Overlay Controls
        $this->start_controls_section(
            'overlay_section',
            [
                'label' => esc_html__('Background Overlay', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'overlay_background',
                'label' => esc_html__('Overlay', 'textdomain'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hero2-overlay',
            ]
        );

        $this->end_controls_section();
    }

    // FIXED: Render method
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        echo '<div class="hero2-container">';
        
        // FIXED: Background handling
        if ($settings['media_type'] === 'image' && !empty($settings['background_image']['url'])) {
            echo '<div class="hero2-background-image" style="background-image: url(' . esc_url($settings['background_image']['url']) . ');"></div>';
        } elseif ($settings['media_type'] === 'video' && !empty($settings['background_video']['url'])) {
            echo '<div class="hero2-background-video">';
            echo '<video autoplay muted loop playsinline>';
            echo '<source src="' . esc_url($settings['background_video']['url']) . '" type="video/mp4">';
            echo '</video>';
            echo '</div>';
        }

        // Overlay
        echo '<div class="hero2-overlay"></div>';

        // FIXED: Content wrapper with proper classes
        $position_class = $settings['content_position'];
        $alignment_class = $settings['text_alignment'];
        
        echo '<div class="hero2-content-wrapper content-position-' . esc_attr($position_class) . '">';
        echo '<div class="hero2-content text-' . esc_attr($alignment_class) . '">';
        
        // FIXED: Content output
        if (!empty($settings['heading_text'])) {
            echo '<h1 class="hero2-heading">' . esc_html($settings['heading_text']) . '</h1>';
        }
        
        if (!empty($settings['subheading_text'])) {
            echo '<h2 class="hero2-subheading">' . esc_html($settings['subheading_text']) . '</h2>';
        }
        
        if (!empty($settings['description_text'])) {
            echo '<div class="hero2-description">' . esc_html($settings['description_text']) . '</div>';
        }
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}