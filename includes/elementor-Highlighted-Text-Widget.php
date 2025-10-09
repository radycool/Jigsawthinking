<?php
/**
 * Highlighted Text Widget with Scroll Animation
 * File: elementor-Highlighted-Text-Widget.php
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Highlighted_Text_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'highlighted_text_widget';
    }

    public function get_title() {
        return esc_html__('Highlighted Text Animation', 'textdomain');
    }

    public function get_icon() {
        return 'eicon-text-area';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['text', 'highlight', 'animation', 'scroll'];
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
            'section_heading',
            [
                'label' => esc_html__('Section Heading (Optional)', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('WHO WE COACH', 'textdomain'),
                'placeholder' => esc_html__('Enter section heading', 'textdomain'),
            ]
        );

        $this->add_control(
            'paragraph_text',
            [
                'label' => esc_html__('Paragraph Text', 'textdomain'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Lorem [highlight]ipsum[/highlight] dolor sit amet, consectetur adipiscing elit, [highlight]sed[/highlight] do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud [highlight]exercitation[/highlight] ullamco laboris nisi ut aliquip ex ea [highlight]commodo[/highlight] consequat.',
                'description' => esc_html__('Use [highlight]text[/highlight] to create highlighted sections', 'textdomain'),
            ]
        );

        $this->end_controls_section();

        // Animation Settings
        $this->start_controls_section(
            'animation_section',
            [
                'label' => esc_html__('Animation Settings', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_scroll_animation',
            [
                'label' => esc_html__('Enable Scroll Animation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'animation_delay',
            [
                'label' => esc_html__('Animation Delay Between Highlights (ms)', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['ms'],
                'range' => [
                    'ms' => [
                        'min' => 100,
                        'max' => 2000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'ms',
                    'size' => 500,
                ],
                'condition' => [
                    'enable_scroll_animation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'animation_duration',
            [
                'label' => esc_html__('Single Highlight Animation Duration (ms)', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['ms'],
                'range' => [
                    'ms' => [
                        'min' => 200,
                        'max' => 1500,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'ms',
                    'size' => 600,
                ],
                'condition' => [
                    'enable_scroll_animation' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - General
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('General Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_background',
            [
                'label' => esc_html__('Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .highlighted-text-section' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '60',
                    'right' => '20',
                    'bottom' => '60',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .highlighted-text-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'text_align',
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
                'selectors' => [
                    '{{WRAPPER}} .highlighted-text-section' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Typography Section
        $this->start_controls_section(
            'typography_section',
            [
                'label' => esc_html__('Typography', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => esc_html__('Heading Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .section-heading',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Heading Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00ff88',
                'selectors' => [
                    '{{WRAPPER}} .section-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'paragraph_typography',
                'label' => esc_html__('Paragraph Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .paragraph-text',
            ]
        );

        $this->add_control(
            'paragraph_color',
            [
                'label' => esc_html__('Paragraph Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .paragraph-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Highlight Style Section
        $this->start_controls_section(
            'highlight_style_section',
            [
                'label' => esc_html__('Highlight Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'highlight_type',
            [
                'label' => esc_html__('Highlight Type', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'background',
                'options' => [
                    'background' => esc_html__('Background Highlight', 'textdomain'),
                    'outline' => esc_html__('Outline/Border', 'textdomain'),
                    'underline' => esc_html__('Underline', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'highlight_background',
            [
                'label' => esc_html__('Highlight Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .text-highlight' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'highlight_type' => 'background',
                ],
            ]
        );

        $this->add_control(
            'highlight_text_color',
            [
                'label' => esc_html__('Highlight Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .text-highlight' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'highlight_padding',
            [
                'label' => esc_html__('Highlight Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'default' => [
                    'top' => '6',
                    'right' => '12',
                    'bottom' => '6',
                    'left' => '12',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .text-highlight' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'highlight_border_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .text-highlight' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'highlight_shadow_color',
            [
                'label' => esc_html__('3D Shadow Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} .text-highlight' => 'box-shadow: 0 4px 0 {{VALUE}}, 0 6px 15px rgba(0, 0, 0, 0.2);',
                ],
                'condition' => [
                    'highlight_type' => 'background',
                ],
            ]
        );

        $this->add_control(
            'highlight_white_layer',
            [
                'label' => esc_html__('White Background Layer', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .text-highlight::after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'highlight_type' => 'background',
                ],
            ]
        );

        $this->add_responsive_control(
            'highlight_font_size',
            [
                'label' => esc_html__('Highlight Font Size', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'em',
                    'size' => 0.9,
                ],
                'selectors' => [
                    '{{WRAPPER}} .text-highlight' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'highlight_border_color',
            [
                'label' => esc_html__('Border Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .text-highlight' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'highlight_type' => 'outline',
                ],
            ]
        );

        $this->add_responsive_control(
            'highlight_border_width',
            [
                'label' => esc_html__('Border Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .text-highlight' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
                ],
                'condition' => [
                    'highlight_type' => 'outline',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Process the text to replace [highlight] tags
        $processed_text = $this->process_highlight_tags($settings['paragraph_text']);
        
        ?>
        <div class="highlighted-text-section" data-animation="<?php echo esc_attr($settings['enable_scroll_animation']); ?>" data-delay="<?php echo esc_attr($settings['animation_delay']['size']); ?>" data-duration="<?php echo esc_attr($settings['animation_duration']['size']); ?>">
            <div class="content-wrapper">
                <?php if (!empty($settings['section_heading'])) : ?>
                    <div class="section-heading"><?php echo esc_html($settings['section_heading']); ?></div>
                <?php endif; ?>
                
                <div class="paragraph-text"><?php echo wp_kses_post($processed_text); ?></div>
            </div>
        </div>
        
        <style>
        .highlighted-text-section {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .highlighted-text-section .content-wrapper {
            max-width: 900px;
            width: 100%;
        }
        
        .highlighted-text-section .section-heading {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }
        
        .highlighted-text-section .paragraph-text {
            font-size: 2rem;
            line-height: 1.5;
            font-weight: 400;
        }
        
        .highlighted-text-section .text-highlight {
            display: inline-block;
            position: relative;
            transition: all 0.3s ease;
            opacity: 0;
            transform: scale(0.8);
            margin: 2px 4px;
            white-space: nowrap;
            font-weight: 600;
            vertical-align: baseline;
        }
        
        .highlighted-text-section .text-highlight::before {
            content: '';
            position: absolute;
            top: 4px;
            left: 4px;
            right: 4px;
            bottom: 4px;
            border-radius: inherit;
            z-index: -1;
            transition: all 0.2s ease;
        }
        
        .highlighted-text-section .text-highlight::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: inherit;
            z-index: -2;
            transition: all 0.2s ease;
        }
        
        .highlighted-text-section .text-highlight.animate-in {
            opacity: 1;
            transform: scale(1);
        }
        
        .highlighted-text-section .text-highlight.outline-style {
            background: transparent;
        }
        
        .highlighted-text-section .text-highlight.underline-style {
            background: transparent;
            border-bottom: 3px solid;
            border-radius: 0;
            padding-bottom: 2px;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .highlighted-text-section .paragraph-text {
                font-size: 1.5rem;
            }
            
            .highlighted-text-section .section-heading {
                font-size: 12px;
                margin-bottom: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .highlighted-text-section .paragraph-text {
                font-size: 1.2rem;
            }
        }
        </style>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const section = document.querySelector('.highlighted-text-section[data-animation="yes"]');
            if (!section) return;
            
            const highlights = section.querySelectorAll('.text-highlight');
            const delay = parseInt(section.dataset.delay) || 500;
            const duration = parseInt(section.dataset.duration) || 600;
            
            // Set up intersection observer
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && entry.intersectionRatio > 0.5) {
                        animateHighlights();
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5,
                rootMargin: '-10% 0px -10% 0px'
            });
            
            observer.observe(section);
            
            function animateHighlights() {
                highlights.forEach((highlight, index) => {
                    setTimeout(() => {
                        highlight.style.transition = `all ${duration}ms ease`;
                        highlight.classList.add('animate-in');
                    }, index * delay);
                });
            }
        });
        </script>
        <?php
    }
    
    private function process_highlight_tags($text) {
        // Replace [highlight]text[/highlight] with span elements
        return preg_replace_callback(
            '/\[highlight\](.*?)\[\/highlight\]/s',
            function($matches) {
                return '<span class="text-highlight">' . $matches[1] . '</span>';
            },
            $text
        );
    }
}
?>