<?php
/**
 * timeline2-widget.php
 * Save as: includes/timeline2-widget.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Timeline2_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'timeline2_widget';
    }

    public function get_title() {
        return esc_html__( 'Timeline 2', 'textdomain' );
    }

    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return [ 'timeline', 'steps', 'process', 'timeline2' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Timeline Items', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'timeline_items',
            [
                'label' => esc_html__( 'Timeline Items', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'textdomain' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Timeline Step', 'textdomain' ),
                        'placeholder' => esc_html__( 'Enter step title', 'textdomain' ),
                    ],
                    [
                        'name' => 'description',
                        'label' => esc_html__( 'Description', 'textdomain' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__( 'Timeline step description goes here.', 'textdomain' ),
                        'placeholder' => esc_html__( 'Enter step description', 'textdomain' ),
                    ],
                ],
                'default' => [
                    [
                        'title' => esc_html__( 'Step 1', 'textdomain' ),
                        'description' => esc_html__( 'First step in the process.', 'textdomain' ),
                    ],
                    [
                        'title' => esc_html__( 'Step 2', 'textdomain' ),
                        'description' => esc_html__( 'Second step in the process.', 'textdomain' ),
                    ],
                    [
                        'title' => esc_html__( 'Step 3', 'textdomain' ),
                        'description' => esc_html__( 'Final step in the process.', 'textdomain' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
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
            'line_color',
            [
                'label' => esc_html__( 'Line Color', 'textdomain' ),
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

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <style>
            .timeline2-container {
                position: relative;
                max-width: 800px;
                margin: 0 auto;
            }
            
            .timeline2-item {
                display: flex;
                margin-bottom: 3rem;
                position: relative;
            }
            
            .timeline2-dot {
                width: 20px;
                height: 20px;
                background-color: <?php echo esc_attr( $settings['line_color'] ); ?>;
                border-radius: 50%;
                margin-right: 2rem;
                margin-top: 0.5rem;
                flex-shrink: 0;
                position: relative;
                z-index: 2;
            }
            
            .timeline2-item:not(:last-child) .timeline2-dot::after {
                content: '';
                position: absolute;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                width: 2px;
                height: 3rem;
                background-color: <?php echo esc_attr( $settings['line_color'] ); ?>;
                opacity: 0.3;
            }
            
            .timeline2-content {
                flex: 1;
                color: <?php echo esc_attr( $settings['text_color'] ); ?>;
            }
            
            .timeline2-title {
                font-size: 1.5rem;
                font-weight: bold;
                margin-bottom: 0.5rem;
                color: <?php echo esc_attr( $settings['line_color'] ); ?>;
            }
            
            .timeline2-description {
                font-size: 1rem;
                line-height: 1.6;
                margin: 0;
            }
            
            @media (max-width: 768px) {
                .timeline2-item {
                    margin-bottom: 2rem;
                }
                
                .timeline2-dot {
                    margin-right: 1rem;
                }
                
                .timeline2-title {
                    font-size: 1.2rem;
                }
            }
        </style>

        <div class="timeline2-container">
            <?php foreach ( $settings['timeline_items'] as $index => $item ) : ?>
                <div class="timeline2-item">
                    <div class="timeline2-dot"></div>
                    <div class="timeline2-content">
                        <h3 class="timeline2-title"><?php echo esc_html( $item['title'] ); ?></h3>
                        <p class="timeline2-description"><?php echo esc_html( $item['description'] ); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const timelineItems = document.querySelectorAll('.timeline2-item');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                }, { threshold: 0.1 });
                
                timelineItems.forEach((item, index) => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(30px)';
                    item.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                    observer.observe(item);
                });
            });
        </script>
        
        <?php
    }
}

?>
