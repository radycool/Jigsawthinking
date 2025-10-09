<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Oneslide_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'oneslide_widget';
    }

    public function get_title() {
        return esc_html__( 'One Slide Business Message', 'textdomain' );
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return [ 'oneslide', 'business', 'message', 'motivation', 'slide' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'first_line',
            [
                'label' => esc_html__( 'First Line', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'YOU DIDN\'T START YOUR BUSINESS TO BE', 'textdomain' ),
                'placeholder' => esc_html__( 'Type your first line here', 'textdomain' ),
            ]
        );

        $this->add_control(
            'highlight_word_1',
            [
                'label' => esc_html__( 'First Highlighted Word', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'OVERWHELMED', 'textdomain' ),
                'placeholder' => esc_html__( 'Highlighted word', 'textdomain' ),
            ]
        );

        $this->add_control(
            'second_line',
            [
                'label' => esc_html__( 'Second Line', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'ALL THE TIME.', 'textdomain' ),
                'placeholder' => esc_html__( 'Type your second line here', 'textdomain' ),
            ]
        );

        $this->add_control(
            'third_line',
            [
                'label' => esc_html__( 'Third Line', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'YOU WANTED TO BUILD SOMETHING', 'textdomain' ),
                'placeholder' => esc_html__( 'Type your third line here', 'textdomain' ),
            ]
        );

        $this->add_control(
            'highlight_words_2',
            [
                'label' => esc_html__( 'Second Set Highlighted Words', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'MEANINGFUL. FLEXIBLE. FULFILLING.', 'textdomain' ),
                'placeholder' => esc_html__( 'Highlighted words', 'textdomain' ),
            ]
        );

        $this->add_control(
            'fourth_line_start',
            [
                'label' => esc_html__( 'Fourth Line Start', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'BUT NOW, YOU\'RE', 'textdomain' ),
                'placeholder' => esc_html__( 'Type your fourth line start here', 'textdomain' ),
            ]
        );

        $this->add_control(
            'highlight_word_3',
            [
                'label' => esc_html__( 'Third Highlighted Word', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'DOING EVERYTHING', 'textdomain' ),
                'placeholder' => esc_html__( 'Highlighted word', 'textdomain' ),
            ]
        );

        $this->add_control(
            'fifth_line',
            [
                'label' => esc_html__( 'Fifth Line', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'MAKING', 'textdomain' ),
                'placeholder' => esc_html__( 'Type your fifth line here', 'textdomain' ),
            ]
        );

        $this->add_control(
            'highlight_word_4',
            [
                'label' => esc_html__( 'Fourth Highlighted Word', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'EVERY DECISION', 'textdomain' ),
                'placeholder' => esc_html__( 'Highlighted word', 'textdomain' ),
            ]
        );

        $this->add_control(
            'sixth_line',
            [
                'label' => esc_html__( 'Sixth Line', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'AND TRYING TO GROW WHILE', 'textdomain' ),
                'placeholder' => esc_html__( 'Type your sixth line here', 'textdomain' ),
            ]
        );

        $this->add_control(
            'highlight_word_5',
            [
                'label' => esc_html__( 'Fifth Highlighted Word', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'STAYING AFLOAT', 'textdomain' ),
                'placeholder' => esc_html__( 'Highlighted word', 'textdomain' ),
            ]
        );

        $this->add_control(
            'left_image',
            [
                'label' => esc_html__( 'Left Side Image', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Style', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
            ]
        );

        $this->add_control(
            'highlight_color',
            [
                'label' => esc_html__( 'Highlight Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e91e63',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
            .oneslide-container {
                background-color: <?php echo esc_attr( $settings['background_color'] ); ?>;
                display: flex;
                position: relative;
                overflow: hidden;
            }

            .oneslide-image {
                flex: 0 0 50%;
                position: relative;
                overflow: hidden;
            }

            .oneslide-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .oneslide-content {
                flex: 1;
                padding: 4rem 3rem;
                display: flex;
                align-items: center;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 1.4;
                color: <?php echo esc_attr( $settings['text_color'] ); ?>;
                letter-spacing: 0.3px;
                text-transform: uppercase;
            }

            .oneslide-text-wrapper {
                max-width: 500px;
            }

            .oneslide-content .highlight {
                color: <?php echo esc_attr( $settings['highlight_color'] ); ?>;
                font-weight: 700;
            }

            .oneslide-content p {
                margin: 0 0 1.2rem 0;
                opacity: 0;
                transform: translateY(30px);
                animation: slideUp 0.8s ease forwards;
            }

            .oneslide-content p:nth-child(1) { animation-delay: 0.2s; }
            .oneslide-content p:nth-child(2) { animation-delay: 0.4s; }
            .oneslide-content p:nth-child(3) { animation-delay: 0.6s; }
            .oneslide-content p:last-child {
                margin-bottom: 0;
            }

            @keyframes slideUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .oneslide-container::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, transparent 0%, rgba(233, 30, 99, 0.1) 50%, transparent 100%);
                pointer-events: none;
            }

            @media (max-width: 768px) {
                .oneslide-container {
                    flex-direction: column;
                }

                .oneslide-image {
                    flex: none;
                }

                .oneslide-content {
                    padding: 2rem 1.5rem;
                    font-size: 1rem;
                    text-align: center;
                }

                .oneslide-text-wrapper {
                    max-width: none;
                }

                .oneslide-content p {
                    margin: 0 0 0.6rem 0;
                }
            }

            @media (max-width: 480px) {
                .oneslide-content {
                    font-size: 1.4rem;
                    line-height: 1.4;
                }
            }
        </style>

        <div class="oneslide-container">
            <?php if ( ! empty( $settings['left_image']['url'] ) ) : ?>
                <div class="oneslide-image">
                    <img src="<?php echo esc_url( $settings['left_image']['url'] ); ?>" alt="Business Image">
                </div>
            <?php endif; ?>
            
            <div class="oneslide-content">
                <div class="oneslide-text-wrapper">
                    <p><?php echo esc_html( $settings['first_line'] ); ?> <span class="highlight"><?php echo esc_html( $settings['highlight_word_1'] ); ?></span> <?php echo esc_html( $settings['second_line'] ); ?></p>
                    
                    <p><?php echo esc_html( $settings['third_line'] ); ?> <span class="highlight"><?php echo esc_html( $settings['highlight_words_2'] ); ?></span></p>
                    
                    <p><?php echo esc_html( $settings['fourth_line_start'] ); ?> <span class="highlight"><?php echo esc_html( $settings['highlight_word_3'] ); ?></span>,</p>
                    
                    <p><?php echo esc_html( $settings['fifth_line'] ); ?> <span class="highlight"><?php echo esc_html( $settings['highlight_word_4'] ); ?></span>, <?php echo esc_html( $settings['sixth_line'] ); ?> <span class="highlight"><?php echo esc_html( $settings['highlight_word_5'] ); ?></span>.</p>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const container = document.querySelector('.oneslide-container');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate');
                        }
                    });
                }, { threshold: 0.3 });
                
                if (container) {
                    observer.observe(container);
                }
            });
        </script>
        <?php
    }
}
