<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Stacked_Cards_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'stacked_cards_coaching';
    }

    public function get_title() {
        return __( 'Stacked Cards - Coaching', 'textdomain' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_script_depends() {
        return ['stacked-cards-script'];
    }

    protected function register_controls() {
        
        $this->start_controls_section(
            'header_section',
            [
                'label' => __( 'Header', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_header',
            [
                'label' => __( 'Show Header', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => __( 'Title', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Transform Your Business',
            ]
        );

        $this->add_control(
            'section_subtitle',
            [
                'label' => __( 'Subtitle', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Scroll to explore our approach',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'cards_section',
            [
                'label' => __( 'Cards', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'card_number',
            [
                'label' => __( 'Card Number', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '01',
            ]
        );

        $repeater->add_control(
            'card_title',
            [
                'label' => __( 'Title', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Card Title',
            ]
        );

        $repeater->add_control(
            'card_description',
            [
                'label' => __( 'Description', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Card description',
            ]
        );

        $repeater->add_control(
            'card_content',
            [
                'label' => __( 'Content', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'card_image',
            [
                'label' => __( 'Image', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'background_color',
            [
                'label' => __( 'Background Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#667eea',
            ]
        );

        $this->add_control(
            'cards',
            [
                'label' => __( 'Cards', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'card_number' => '01',
                        'card_title' => 'Strategy & Planning',
                        'card_description' => 'We help you define your vision and create actionable roadmaps.',
                        'background_color' => '#667eea',
                    ],
                    [
                        'card_number' => '02',
                        'card_title' => 'Design Excellence',
                        'card_description' => 'Beautiful interfaces that users love to interact with.',
                        'background_color' => '#f093fb',
                    ],
                    [
                        'card_number' => '03',
                        'card_title' => 'Development',
                        'card_description' => 'Clean, performant code that scales with your business.',
                        'background_color' => '#4facfe',
                    ],
                    [
                        'card_number' => '04',
                        'card_title' => 'Launch & Growth',
                        'card_description' => 'Continuous improvement and optimization for success.',
                        'background_color' => '#43e97b',
                    ],
                ],
                'title_field' => '{{{ card_number }}} - {{{ card_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings_section',
            [
                'label' => __( 'Settings', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'card_spacing',
            [
                'label' => __( 'Stack Spacing (px)', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'size' => 40,
                ],
            ]
        );

        $this->add_control(
            'scale_reduction',
            [
                'label' => __( 'Scale Reduction (%)', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 2,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 4,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $card_count = count($settings['cards']);
        ?>
        
        <div class="gaspar-stack-outer">
            
            <?php if ( $settings['show_header'] === 'yes' ): ?>
            <div class="gaspar-header">
                <h2><?php echo esc_html($settings['section_title']); ?></h2>
                <p><?php echo esc_html($settings['section_subtitle']); ?></p>
            </div>
            <?php endif; ?>

            <div class="gaspar-stack-section gaspar-stack-<?php echo esc_attr($widget_id); ?>" 
                 data-widget-id="<?php echo esc_attr($widget_id); ?>"
                 data-spacing="<?php echo esc_attr($settings['card_spacing']['size']); ?>"
                 data-scale-reduction="<?php echo esc_attr($settings['scale_reduction']['size']); ?>"
                 data-card-count="<?php echo esc_attr($card_count); ?>">
                
                <div class="gaspar-sticky-wrapper">
                    <?php foreach ( $settings['cards'] as $index => $card ): ?>
                        <div class="gaspar-card" data-card-index="<?php echo $index; ?>" style="background: <?php echo esc_attr($card['background_color']); ?>">
                            <div class="gaspar-card-content">
                                <div class="gaspar-card-left">
                                    <span class="gaspar-card-number"><?php echo esc_html($card['card_number']); ?></span>
                                    <h3 class="gaspar-card-title"><?php echo esc_html($card['card_title']); ?></h3>
                                    <p class="gaspar-card-description"><?php echo esc_html($card['card_description']); ?></p>
                                    <?php if ( !empty($card['card_content']) ): ?>
                                        <div class="gaspar-card-text"><?php echo wp_kses_post($card['card_content']); ?></div>
                                    <?php endif; ?>
                                </div>
                                <?php if ( !empty($card['card_image']['url']) ): ?>
                                <div class="gaspar-card-right">
                                    <img src="<?php echo esc_url($card['card_image']['url']); ?>" alt="<?php echo esc_attr($card['card_title']); ?>">
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <style>
        .gaspar-stack-outer {
            background: #0a0a0f;
        }

        .gaspar-header {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .gaspar-header h2 {
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .gaspar-header p {
            font-size: clamp(1.1rem, 2.5vw, 1.5rem);
            opacity: 0.9;
            max-width: 600px;
        }

        .gaspar-stack-<?php echo esc_attr($widget_id); ?> {
            position: relative;
            height: <?php echo $card_count * 100; ?>vh;
        }

        .gaspar-sticky-wrapper {
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .gaspar-card {
            position: absolute;
            width: 90%;
            max-width: 1100px;
            height: 75vh;
            max-height: 650px;
            border-radius: 32px;
            padding: 60px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.5);
            opacity: 0;
            transform: translateY(60px) scale(1);
            will-change: transform, opacity;
        }

        .gaspar-card-content {
            display: grid;
            grid-template-columns: 1.3fr 1fr;
            gap: 60px;
            height: 100%;
            align-items: center;
        }

        .gaspar-card-left {
            display: flex;
            flex-direction: column;
        }

        .gaspar-card-number {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 20px;
            border-radius: 24px;
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            margin-bottom: 24px;
            backdrop-filter: blur(10px);
            align-self: flex-start;
        }

        .gaspar-card-title {
            font-size: clamp(2rem, 4.5vw, 3.2rem);
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            line-height: 1.15;
        }

        .gaspar-card-description {
            font-size: clamp(1.05rem, 2vw, 1.3rem);
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .gaspar-card-text {
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.7;
            font-size: 1.05rem;
        }

        .gaspar-card-right {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gaspar-card-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        }

        @media (max-width: 968px) {
            .gaspar-card {
                width: 95%;
                height: 85vh;
                padding: 40px 30px;
            }
            
            .gaspar-card-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .gaspar-card-right {
                height: 280px;
            }
        }
        </style>

        <?php
    }
}
