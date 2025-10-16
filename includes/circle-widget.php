<?php
/**
 * Elementor Nested Semicircles Widget (Updated Clean Version)
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Circle_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'nested_semicircles';
    }

    public function get_title() {
        return __('Nested Semicircles', 'text-domain');
    }

    public function get_icon() {
        return 'eicon-animation';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'inner_text',
            [
                'label' => __('Inner Semicircle Text', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('WE DESIGN SYSTEMS AROUND YOUR LIFE — NOT OVER IT', 'text-domain'),
                'placeholder' => __('Enter inner text', 'text-domain'),
            ]
        );

        $this->add_control(
            'middle_text',
            [
                'label' => __('Middle Semicircle Text', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('WE COACH THE FOUNDER, NOT JUST THE BUSINESS', 'text-domain'),
                'placeholder' => __('Enter middle text', 'text-domain'),
            ]
        );

        $this->add_control(
            'outer_text',
            [
                'label' => __('Outer Semicircle Text', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('WE FOCUS ON DECISIONS THAT ACTUALLY MOVE THE NEEDLE', 'text-domain'),
                'placeholder' => __('Enter outer text', 'text-domain'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => __('Primary Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00D4AA',
            ]
        );

        $this->add_control(
            'secondary_color',
            [
                'label' => __('Secondary Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#B8F2E6',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'inner_typography',
                'label' => __('Inner Text Typography', 'text-domain'),
                'selector' => '{{WRAPPER}} .inner-text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'outer_typography',
                'label' => __('Outer & Middle Text Typography', 'text-domain'),
                'selector' => '{{WRAPPER}} .middle-text, {{WRAPPER}} .outer-text',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="nested-semicircles-container"
            style="--primary-color: <?php echo esc_attr($settings['primary_color']); ?>;
                   --secondary-color: <?php echo esc_attr($settings['secondary_color']); ?>;
                   --text-color: <?php echo esc_attr($settings['text_color']); ?>;">

            <!-- Outer Semicircle -->
            <div class="semicircle outer-semicircle">
                <div class="semicircle-text outer-text"><?php echo esc_html($settings['outer_text']); ?></div>
            </div>

            <!-- Middle Semicircle -->
            <div class="semicircle middle-semicircle">
                <div class="semicircle-text middle-text"><?php echo esc_html($settings['middle_text']); ?></div>
            </div>

            <!-- Inner Semicircle -->
            <div class="semicircle inner-semicircle">
                <div class="semicircle-text inner-text"><?php echo wp_kses_post($settings['inner_text']); ?></div>
            </div>

        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        var innerText = settings.inner_text || 'WE DESIGN SYSTEMS AROUND YOUR LIFE — NOT OVER IT';
        var middleText = settings.middle_text || 'WE COACH THE FOUNDER, NOT JUST THE BUSINESS';
        var outerText = settings.outer_text || 'WE FOCUS ON DECISIONS THAT ACTUALLY MOVE THE NEEDLE';
        #>
        <div class="nested-semicircles-container"
            style="--primary-color: {{ settings.primary_color }};
                   --secondary-color: {{ settings.secondary_color }};
                   --text-color: {{ settings.text_color }};">

            <div class="semicircle outer-semicircle">
                <div class="semicircle-text outer-text">{{{ outerText }}}</div>
            </div>
            <div class="semicircle middle-semicircle">
                <div class="semicircle-text middle-text">{{{ middleText }}}</div>
            </div>
            <div class="semicircle inner-semicircle">
                <div class="semicircle-text inner-text">{{{ innerText }}}</div>
            </div>
        </div>
        <?php
    }
}
