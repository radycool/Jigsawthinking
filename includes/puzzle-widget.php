<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Puzzle_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'puzzle_widget';
    }

    public function get_title() {
        return esc_html__( 'Puzzle Business Coaching', 'textdomain' );
    }

    public function get_icon() {
        return 'eicon-puzzle';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return [ 'puzzle', 'business', 'coaching', 'custom' ];
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
            'main_text',
            [
                'label' => esc_html__( 'Main Text', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Through structured, 1:1 personal business coaching,', 'textdomain' ),
                'placeholder' => esc_html__( 'Type your main text here', 'textdomain' ),
            ]
        );

        $this->add_control(
            'highlight_text',
            [
                'label' => esc_html__( 'Highlighted Text', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'we help founders like you take back control of your time, your team, your revenue, and your vision', 'textdomain' ),
                'placeholder' => esc_html__( 'Type your highlighted text here', 'textdomain' ),
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => esc_html__( 'Description Text', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'So your business works for you, not because of you. That\'s the difference one of the right business coaches can make.', 'textdomain' ),
                'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
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
            'puzzle_color',
            [
                'label' => esc_html__( 'Puzzle Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e91e63',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
            ]
        );

        $this->add_control(
            'highlight_color',
            [
                'label' => esc_html__( 'Highlight Text Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
            .puzzle-container {
                display: flex;
                align-items: flex-end;
                gap: 2rem;
                padding: 2rem 0;
                max-width: 1200px;
                margin: 0 auto;
            }

            .puzzle-content {
                flex: 1;
                max-width: 400px;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                line-height: 1.6;
            }

            .puzzle-content p {
                margin: 0 0 1.5rem 0;
                font-size: 16px;
                color: <?php echo esc_attr( $settings['text_color'] ); ?>;
            }

            .puzzle-content .highlight {
                font-weight: bold;
                color: <?php echo esc_attr( $settings['highlight_color'] ); ?>;
            }

            .puzzle-visual {
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 300px;
                position: relative;
            }

            .puzzle-piece {
                width: 120px;
                height: 120px;
                position: relative;
                margin: 20px;
                display: inline-block;
            }

            .puzzle-piece svg {
                width: 100%;
                height: 100%;
                fill: none;
                stroke: <?php echo esc_attr( $settings['puzzle_color'] ); ?>;
                stroke-width: 2;
                opacity: 0.8;
                transition: all 0.3s ease;
            }

            .puzzle-piece:hover svg {
                opacity: 1;
                stroke-width: 3;
                transform: scale(1.05);
            }

            .puzzle-svg-container {
                max-width: 600px;
                width: 100%;
            }

            .puzzle-svg {
                width: 100%;
                height: auto;
                max-width: 600px;
            }

            .puzzle-svg path {
                fill: white;
                stroke: <?php echo esc_attr( $settings['puzzle_color'] ); ?>;
                stroke-width: 2;
                transition: all 0.3s ease;
            }

            .puzzle-svg:hover path {
                stroke-width: 3;
                stroke: <?php echo esc_attr( $settings['puzzle_color'] ); ?>;
                filter: drop-shadow(0 4px 8px rgba(203, 12, 159, 0.3));
            }

            @media (max-width: 768px) {
                .puzzle-container {
                    flex-direction: column;
                    text-align: center;
                    gap: 1.5rem;
                }
                
                .puzzle-content {
                    max-width: 100%;
                }
                
                .puzzle-svg-container {
                    max-width: 500px;
                }
            }
        </style>

        <div class="puzzle-container">
            <div class="puzzle-content">
                <p><?php echo esc_html( $settings['main_text'] ); ?></p>
                <p class="highlight"><?php echo esc_html( $settings['highlight_text'] ); ?> —</p>
                <p><?php echo esc_html( $settings['description_text'] ); ?></p>
            </div>
            
            <div class="puzzle-visual">
                <div class="puzzle-svg-container">
                    <svg class="puzzle-svg" viewBox="0 0 974 447" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="path-1-outside-1_476_1266" maskUnits="userSpaceOnUse" x="-0.117188" y="0" width="544" height="446" fill="black">
                            <rect fill="white" x="-0.117188" width="544" height="446"/>
                            <path d="M99.3525 158.053C99.3525 160.998 96.2023 162.91 93.4758 161.796C85.7328 158.632 77.2583 156.888 68.377 156.888C31.7171 156.888 1.99838 186.607 1.99805 223.267C1.99805 259.927 31.7168 289.646 68.377 289.646C77.2586 289.646 85.7328 287.902 93.4758 284.737C96.2022 283.622 99.3525 285.534 99.3525 288.48V440.62C99.3525 442.78 101.103 444.53 103.263 444.53H537.973C540.132 444.53 541.883 442.78 541.883 440.62V5.91016C541.883 3.75065 540.132 2 537.973 2H385.823C382.877 2 380.965 5.1509 382.08 7.87749C385.247 15.6229 386.993 24.1001 386.993 32.9854C386.993 69.6456 357.274 99.3651 320.614 99.3652C283.954 99.3652 254.234 69.6457 254.234 32.9854C254.234 24.1002 255.98 15.6229 259.148 7.87748C260.263 5.15089 258.35 2 255.405 2H103.263C101.103 2 99.3525 3.75063 99.3525 5.91014V158.053Z"/>
                        </mask>
                        <path d="M99.3525 158.053C99.3525 160.998 96.2023 162.91 93.4758 161.796C85.7328 158.632 77.2583 156.888 68.377 156.888C31.7171 156.888 1.99838 186.607 1.99805 223.267C1.99805 259.927 31.7168 289.646 68.377 289.646C77.2586 289.646 85.7328 287.902 93.4758 284.737C96.2022 283.622 99.3525 285.534 99.3525 288.48V440.62C99.3525 442.78 101.103 444.53 103.263 444.53H537.973C540.132 444.53 541.883 442.78 541.883 440.62V5.91016C541.883 3.75065 540.132 2 537.973 2H385.823C382.877 2 380.965 5.1509 382.08 7.87749C385.247 15.6229 386.993 24.1001 386.993 32.9854C386.993 69.6456 357.274 99.3651 320.614 99.3652C283.954 99.3652 254.234 69.6457 254.234 32.9854C254.234 24.1002 255.98 15.6229 259.148 7.87748C260.263 5.15089 258.35 2 255.405 2H103.263C101.103 2 99.3525 3.75063 99.3525 5.91014V158.053Z"/>
                        <mask id="path-3-outside-2_476_1266" maskUnits="userSpaceOnUse" x="440.031" y="-2.38498e-08" width="534" height="447" fill="black">
                            <rect fill="white" x="440.031" y="-2.38498e-08" width="534" height="447"/>
                            <path d="M442.031 223.743C442.031 260.483 471.22 290.266 507.226 290.267C515.895 290.267 524.168 288.539 531.735 285.405C534.469 284.272 537.649 286.185 537.649 289.145L537.649 441.577C537.649 443.737 539.4 445.487 541.56 445.487L968.363 445.487C970.523 445.487 972.273 443.737 972.273 441.577L972.273 5.91016C972.273 3.75065 970.523 2.00001 968.363 2.00001L819.063 2C816.132 2 814.22 5.12168 815.312 7.84183C818.433 15.6142 820.154 24.1229 820.154 33.042C820.154 69.7817 790.965 99.5654 754.96 99.5654C718.955 99.5653 689.767 69.7816 689.767 33.042C689.767 24.1231 691.487 15.6142 694.607 7.84186C695.699 5.12166 693.787 2 690.856 2L541.56 2C539.4 2 537.649 3.75063 537.649 5.91014L537.649 158.342C537.649 161.302 534.469 163.215 531.735 162.082C524.168 158.947 515.895 157.221 507.226 157.221C471.221 157.221 442.032 187.004 442.031 223.743Z"/>
                        </mask>
                        <path d="M442.031 223.743C442.031 260.483 471.22 290.266 507.226 290.267C515.895 290.267 524.168 288.539 531.735 285.405C534.469 284.272 537.649 286.185 537.649 289.145L537.649 441.577C537.649 443.737 539.4 445.487 541.56 445.487L968.363 445.487C970.523 445.487 972.273 443.737 972.273 441.577L972.273 5.91016C972.273 3.75065 970.523 2.00001 968.363 2.00001L819.063 2C816.132 2 814.22 5.12168 815.312 7.84183C818.433 15.6142 820.154 24.1229 820.154 33.042C820.154 69.7817 790.965 99.5654 754.96 99.5654C718.955 99.5653 689.767 69.7816 689.767 33.042C689.767 24.1231 691.487 15.6142 694.607 7.84186C695.699 5.12166 693.787 2 690.856 2L541.56 2C539.4 2 537.649 3.75063 537.649 5.91014L537.649 158.342C537.649 161.302 534.469 163.215 531.735 162.082C524.168 158.947 515.895 157.221 507.226 157.221C471.221 157.221 442.032 187.004 442.031 223.743Z"/>
                    </svg>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const puzzleSvg = document.querySelector('.puzzle-svg');
                
                if (puzzleSvg) {
                    puzzleSvg.style.opacity = '0';
                    puzzleSvg.style.transform = 'translateY(30px)';
                    puzzleSvg.style.transition = 'all 0.8s ease';
                    
                    setTimeout(() => {
                        puzzleSvg.style.opacity = '1';
                        puzzleSvg.style.transform = 'translateY(0)';
                    }, 200);
                }
            });
        </script>

        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
        <?php
    }
}
