<?php
/**
 * Custom Elementor Heading Widget
 * File: elementor-Custom-Heading-Widget.php
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Custom_Elementor_Heading_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'custom_heading_widget';
    }

    public function get_title() {
        return esc_html__('Custom Heading Section', 'textdomain');
    }

    public function get_icon() {
        return 'eicon-heading';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['heading', 'title', 'text', 'button'];
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
            'main_heading',
            [
                'label' => esc_html__('Main Heading', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Here When You', 'textdomain'),
                'placeholder' => esc_html__('Type your main heading here', 'textdomain'),
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label' => esc_html__('Sub Heading', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Need Us Most Important.', 'textdomain'),
                'placeholder' => esc_html__('Type your sub heading here', 'textdomain'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Nubien comes with dedicated support to help you launch and maintain your site without friction.', 'textdomain'),
                'placeholder' => esc_html__('Type your description here', 'textdomain'),
            ]
        );

        $this->end_controls_section();

        // Buttons Section
        $this->start_controls_section(
            'buttons_section',
            [
                'label' => esc_html__('Buttons', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_buttons',
            [
                'label' => esc_html__('Show Buttons', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'textdomain'),
                'label_off' => esc_html__('Hide', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'textdomain'),
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__('Link', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'textdomain'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $repeater->add_control(
            'button_style',
            [
                'label' => esc_html__('Button Style', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    'primary' => esc_html__('Primary (Green)', 'textdomain'),
                    'secondary' => esc_html__('Secondary (Purple)', 'textdomain'),
                    'outline' => esc_html__('Outline', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'buttons',
            [
                'label' => esc_html__('Buttons', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'button_text' => esc_html__('View About Reboot', 'textdomain'),
                        'button_style' => 'secondary',
                    ],
                    [
                        'button_text' => esc_html__('BOOK NOW', 'textdomain'),
                        'button_style' => 'primary',
                    ],
                ],
                'title_field' => '{{{ button_text }}}',
                'condition' => [
                    'show_buttons' => 'yes',
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
                'default' => '#0f0f23',
                'selectors' => [
                    '{{WRAPPER}} .custom-heading-section' => 'background-color: {{VALUE}}',
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
                    'top' => '40',
                    'right' => '20',
                    'bottom' => '40',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-heading-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_min_height',
            [
                'label' => esc_html__('Minimum Height', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-heading-section' => 'min-height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .custom-heading-section' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Typography Styles
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
                'name' => 'main_heading_typography',
                'label' => esc_html__('Main Heading', 'textdomain'),
                'selector' => '{{WRAPPER}} .main-heading',
            ]
        );

        $this->add_control(
            'main_heading_color',
            [
                'label' => esc_html__('Main Heading Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .main-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'label' => esc_html__('Sub Heading', 'textdomain'),
                'selector' => '{{WRAPPER}} .sub-heading',
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label' => esc_html__('Sub Heading Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#8b8b8b',
                'selectors' => [
                    '{{WRAPPER}} .sub-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description', 'textdomain'),
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Button Styles
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__('Button Styles', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_buttons' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_spacing',
            [
                'label' => esc_html__('Button Spacing', 'textdomain'),
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
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-button:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin_top',
            [
                'label' => esc_html__('Buttons Top Margin', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .buttons-container' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Primary Button Colors
        $this->add_control(
            'primary_button_heading',
            [
                'label' => esc_html__('Primary Button Colors', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'primary_button_bg',
            [
                'label' => esc_html__('Primary Button Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00ff88',
                'selectors' => [
                    '{{WRAPPER}} .custom-button.button-primary' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .custom-button.button-primary::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'primary_button_shadow',
            [
                'label' => esc_html__('Primary Button Shadow', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00cc6a',
                'selectors' => [
                    '{{WRAPPER}} .custom-button.button-primary' => 'box-shadow: 0 6px 0 {{VALUE}}, 0 8px 20px rgba(0, 0, 0, 0.3);',
                    '{{WRAPPER}} .custom-button.button-primary:hover' => 'box-shadow: 0 4px 0 {{VALUE}}, 0 6px 15px rgba(0, 0, 0, 0.25);',
                    '{{WRAPPER}} .custom-button.button-primary:active' => 'box-shadow: 0 2px 0 {{VALUE}}, 0 4px 10px rgba(0, 0, 0, 0.2);',
                ],
            ]
        );

        $this->add_control(
            'primary_button_text_color',
            [
                'label' => esc_html__('Primary Button Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .custom-button.button-primary' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Secondary Button Colors
        $this->add_control(
            'secondary_button_heading',
            [
                'label' => esc_html__('Secondary Button Colors', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'secondary_button_bg',
            [
                'label' => esc_html__('Secondary Button Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#6366f1',
                'selectors' => [
                    '{{WRAPPER}} .custom-button.button-secondary' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .custom-button.button-secondary::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'secondary_button_shadow',
            [
                'label' => esc_html__('Secondary Button Shadow', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#4338ca',
                'selectors' => [
                    '{{WRAPPER}} .custom-button.button-secondary' => 'box-shadow: 0 6px 0 {{VALUE}}, 0 8px 20px rgba(0, 0, 0, 0.3);',
                    '{{WRAPPER}} .custom-button.button-secondary:hover' => 'box-shadow: 0 4px 0 {{VALUE}}, 0 6px 15px rgba(0, 0, 0, 0.25);',
                    '{{WRAPPER}} .custom-button.button-secondary:active' => 'box-shadow: 0 2px 0 {{VALUE}}, 0 4px 10px rgba(0, 0, 0, 0.2);',
                ],
            ]
        );

        $this->add_control(
            'secondary_button_text_color',
            [
                'label' => esc_html__('Secondary Button Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .custom-button.button-secondary' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        ?>
        <div class="custom-heading-section">
            <div class="content-wrapper">
                <?php if (!empty($settings['main_heading'])) : ?>
                    <h1 class="main-heading"><?php echo esc_html($settings['main_heading']); ?></h1>
                <?php endif; ?>
                
                <?php if (!empty($settings['sub_heading'])) : ?>
                    <h2 class="sub-heading"><?php echo esc_html($settings['sub_heading']); ?></h2>
                <?php endif; ?>
                
                <?php if (!empty($settings['description'])) : ?>
                    <p class="description"><?php echo esc_html($settings['description']); ?></p>
                <?php endif; ?>
                
                <?php if ('yes' === $settings['show_buttons'] && !empty($settings['buttons'])) : ?>
                    <div class="buttons-container">
                        <?php foreach ($settings['buttons'] as $index => $item) : 
                            $button_key = $this->get_repeater_setting_key('button_link', 'buttons', $index);
                            $this->add_link_attributes($button_key, $item['button_link']);
                            
                            $button_class = 'custom-button button-' . $item['button_style'];
                        ?>
                            <a <?php echo $this->get_render_attribute_string($button_key); ?> class="<?php echo esc_attr($button_class); ?>">
                                <?php echo esc_html($item['button_text']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <style>
        .custom-heading-section {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .custom-heading-section .content-wrapper {
            max-width: 800px;
            width: 100%;
        }
        
        .custom-heading-section .main-heading {
            font-size: 3.5rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            line-height: 1.2;
        }
        
        .custom-heading-section .sub-heading {
            font-size: 3.5rem;
            font-weight: 300;
            margin: 0 0 20px 0;
            line-height: 1.2;
        }
        
        .custom-heading-section .description {
            font-size: 1.1rem;
            line-height: 1.6;
            margin: 0 0 30px 0;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .custom-heading-section .buttons-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        
        .custom-heading-section .custom-button {
            position: relative;
            display: inline-block;
            padding: 18px 35px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.2s ease;
            cursor: pointer;
            margin-bottom: 10px;
            border: none;
            outline: none;
        }
        
        .custom-heading-section .custom-button::before {
            content: '';
            position: absolute;
            top: 6px;
            left: 6px;
            right: 6px;
            bottom: 6px;
            border-radius: 10px;
            z-index: -1;
            transition: all 0.2s ease;
        }
        
        .custom-heading-section .custom-button::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 15px;
            z-index: -2;
            transition: all 0.2s ease;
        }
        
        /* Primary Button (Green) */
        .custom-heading-section .custom-button.button-primary {
            background: #00ff88;
            color: #000000;
            box-shadow: 0 6px 0 #00cc6a, 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        .custom-heading-section .custom-button.button-primary::before {
            background: #00ff88;
        }
        
        .custom-heading-section .custom-button.button-primary::after {
            background: #ffffff;
        }
        
        .custom-heading-section .custom-button.button-primary:hover {
            transform: translateY(2px);
            box-shadow: 0 4px 0 #00cc6a, 0 6px 15px rgba(0, 0, 0, 0.25);
        }
        
        .custom-heading-section .custom-button.button-primary:active {
            transform: translateY(4px);
            box-shadow: 0 2px 0 #00cc6a, 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        /* Secondary Button (Purple) */
        .custom-heading-section .custom-button.button-secondary {
            background: #6366f1;
            color: #ffffff;
            box-shadow: 0 6px 0 #4338ca, 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        .custom-heading-section .custom-button.button-secondary::before {
            background: #6366f1;
        }
        
        .custom-heading-section .custom-button.button-secondary::after {
            background: #ffffff;
        }
        
        .custom-heading-section .custom-button.button-secondary:hover {
            transform: translateY(2px);
            box-shadow: 0 4px 0 #4338ca, 0 6px 15px rgba(0, 0, 0, 0.25);
        }
        
        .custom-heading-section .custom-button.button-secondary:active {
            transform: translateY(4px);
            box-shadow: 0 2px 0 #4338ca, 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        /* Outline Button */
        .custom-heading-section .custom-button.button-outline {
            background: transparent;
            color: #ffffff;
            border: 3px solid #ffffff;
            box-shadow: 0 6px 0 rgba(255, 255, 255, 0.3), 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        .custom-heading-section .custom-button.button-outline::before {
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }
        
        .custom-heading-section .custom-button.button-outline::after {
            background: transparent;
        }
        
        .custom-heading-section .custom-button.button-outline:hover {
            background: #ffffff;
            color: #000000;
            transform: translateY(2px);
            box-shadow: 0 4px 0 rgba(255, 255, 255, 0.5), 0 6px 15px rgba(0, 0, 0, 0.25);
        }
        
        .custom-heading-section .custom-button.button-outline:active {
            transform: translateY(4px);
            box-shadow: 0 2px 0 rgba(255, 255, 255, 0.5), 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .custom-heading-section .main-heading,
            .custom-heading-section .sub-heading {
                font-size: 2.5rem;
            }
            
            .custom-heading-section .description {
                font-size: 1rem;
            }
            
            .custom-heading-section .buttons-container {
                flex-direction: column;
                align-items: center;
            }
            
            .custom-heading-section .custom-button {
                margin-right: 0 !important;
                margin-bottom: 15px;
                min-width: 200px;
                text-align: center;
            }
        }
        
        @media (max-width: 480px) {
            .custom-heading-section .main-heading,
            .custom-heading-section .sub-heading {
                font-size: 2rem;
            }
            
            .custom-heading-section .custom-button {
                padding: 12px 25px;
                font-size: 13px;
            }
        }
        </style>
        <?php
    }
}
?>