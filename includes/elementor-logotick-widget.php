<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Elementor_Logotick_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'logotick';
    }

    public function get_title() {
        return __( 'Logo Ticker', 'hello-elementor-child' );
    }

    public function get_icon() {
        return 'eicon-slider-album';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_script_depends() {
        return [ 'logotick-script' ];
    }

    public function get_style_depends() {
        return [ 'logotick-style' ];
    }

    protected function register_controls() {
        // ✅ Logos
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Logos', 'hello-elementor-child' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'logos',
            [
                'label'   => __( 'Logos', 'hello-elementor-child' ),
                'type'    => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $this->end_controls_section();

        // ✅ Animation controls
        $this->start_controls_section(
            'animation_section',
            [
                'label' => __( 'Animation', 'hello-elementor-child' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'direction',
            [
                'label'   => __( 'Direction', 'hello-elementor-child' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'  => __( 'Left to Right', 'hello-elementor-child' ),
                    'right' => __( 'Right to Left', 'hello-elementor-child' ),
                ],
            ]
        );

        $this->add_control(
            'speed',
            [
                'label'      => __( 'Animation Speed', 'hello-elementor-child' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default'    => [
                    'size' => 30,
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'        => __( 'Pause on Hover', 'hello-elementor-child' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'hello-elementor-child' ),
                'label_off'    => __( 'No', 'hello-elementor-child' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();

        // ✅ Style controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'hello-elementor-child' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label'      => __( 'Ticker Height', 'hello-elementor-child' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 40,
                        'max' => 300,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .logo-ticker' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .logo-ticker-item img' => 'max-height: calc({{SIZE}}{{UNIT}} - 20px);',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_spacing',
            [
                'label'      => __( 'Logo Spacing', 'hello-elementor-child' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .logo-ticker-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'background',
                'label'    => __( 'Background', 'hello-elementor-child' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .logo-ticker',
            ]
        );

        $this->add_control(
            'fade_edges',
            [
                'label'        => __( 'Fade Edges', 'hello-elementor-child' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'hello-elementor-child' ),
                'label_off'    => __( 'No', 'hello-elementor-child' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'vertical_alignment',
            [
                'label'   => __( 'Vertical Alignment', 'hello-elementor-child' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'flex-start' => __( 'Top', 'hello-elementor-child' ),
                    'center'     => __( 'Middle', 'hello-elementor-child' ),
                    'flex-end'   => __( 'Bottom', 'hello-elementor-child' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .logo-ticker' => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .logo-ticker-track' => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .logo-ticker-item' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if ( empty( $settings['logos'] ) ) return;

        $direction = $settings['direction'] === 'right' ? 'right' : 'left';
        $speed = $settings['speed']['size'] ?? 30;
        $pause_on_hover = $settings['pause_on_hover'] === 'yes' ? 'true' : 'false';
        $fade_edges = $settings['fade_edges'] === 'yes';
        
        $widget_id = 'logo-ticker-' . $this->get_id();
        ?>
        <div class="logo-ticker-container <?php echo $fade_edges ? 'has-fade' : ''; ?>" 
             id="<?php echo esc_attr($widget_id); ?>"
             data-direction="<?php echo esc_attr($direction); ?>"
             data-speed="<?php echo esc_attr($speed); ?>"
             data-pause-hover="<?php echo esc_attr($pause_on_hover); ?>">
            
            <div class="logo-ticker">
                <div class="logo-ticker-track">
                    <?php 
                    // Duplicate logos for seamless loop
                    for ($i = 0; $i < 2; $i++) :
                        foreach ( $settings['logos'] as $logo ) : ?>
                            <div class="logo-ticker-item">
                                <img src="<?php echo esc_url( $logo['url'] ); ?>" 
                                     alt="<?php echo esc_attr( $logo['alt'] ?? 'Logo' ); ?>"
                                     loading="lazy">
                            </div>
                        <?php endforeach;
                    endfor; ?>
                </div>
            </div>
            
            <?php if ($fade_edges) : ?>
                <div class="logo-ticker-fade fade-left"></div>
                <div class="logo-ticker-fade fade-right"></div>
            <?php endif; ?>
        </div>

        <style>
        /* Logo Ticker Styles */
        .logo-ticker-container {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .logo-ticker {
            height: 80px;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            display: flex;
            align-items: center;
        }

        .logo-ticker-track {
            display: inline-flex;
            align-items: center;
            animation: scroll-left 20s linear infinite;
            will-change: transform;
        }

        .logo-ticker-item {
            flex-shrink: 0;
            margin-right: 40px;
            display: flex;
            align-items: center;
            height: 100%;
        }

        .logo-ticker-item img {
            max-height: 60px;
            max-width: 120px;
            width: auto;
            height: auto;
            object-fit: contain;
            filter: grayscale(100%) opacity(0.7);
            transition: all 0.3s ease;
        }

        .logo-ticker-item:hover img {
            filter: grayscale(0%) opacity(1);
            transform: scale(1.05);
        }

        /* Fade edges */
        .logo-ticker-container.has-fade::before,
        .logo-ticker-container.has-fade::after {
            content: '';
            position: absolute;
            top: 0;
            height: 100%;
            width: 50px;
            z-index: 2;
            pointer-events: none;
        }

        .logo-ticker-container.has-fade::before {
            left: 0;
            background: linear-gradient(to right, rgba(255,255,255,1), rgba(255,255,255,0));
        }

        .logo-ticker-container.has-fade::after {
            right: 0;
            background: linear-gradient(to left, rgba(255,255,255,1), rgba(255,255,255,0));
        }

        /* Animation keyframes */
        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes scroll-right {
            0% {
                transform: translateX(-50%);
            }
            100% {
                transform: translateX(0);
            }
        }

        /* Direction classes */
        .logo-ticker-container[data-direction="right"] .logo-ticker-track {
            animation-name: scroll-right;
        }

        /* Pause on hover */
        .logo-ticker-container[data-pause-hover="true"]:hover .logo-ticker-track {
            animation-play-state: paused;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .logo-ticker-item {
                margin-right: 30px;
            }
            
            .logo-ticker-item img {
                max-height: 40px;
                max-width: 100px;
            }
        }
        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ticker = document.getElementById('<?php echo esc_js($widget_id); ?>');
            if (!ticker) return;

            const track = ticker.querySelector('.logo-ticker-track');
            const speed = parseInt(ticker.dataset.speed) || 30;
            
            // Calculate animation duration based on speed
            const duration = Math.max(10, 50 - speed);
            track.style.animationDuration = duration + 's';

            // Handle resize to recalculate if needed
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    // Force animation restart on resize
                    track.style.animation = 'none';
                    track.offsetHeight; // Trigger reflow
                    track.style.animation = null;
                }, 250);
            });
        });
        </script>
        <?php
    }
}

// Register styles and scripts
add_action('wp_enqueue_scripts', function() {
    wp_register_style('logotick-style', false);
    wp_register_script('logotick-script', false, [], '1.0.0', true);
});