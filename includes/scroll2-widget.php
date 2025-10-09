<?php
/**
 * scroll2-widget.php
 * Save as: includes/scroll2-widget.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Scroll2_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'scroll2_widget';
    }

    public function get_title() {
        return esc_html__( 'Scroll 2', 'textdomain' );
    }

    public function get_icon() {
        return 'eicon-scroll';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return [ 'scroll', 'carousel', 'slider', 'horizontal', 'scroll2' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Scroll Items', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'scroll_items',
            [
                'label' => esc_html__( 'Scroll Items', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'image',
                        'label' => esc_html__( 'Choose Image', 'textdomain' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'textdomain' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Scroll Item', 'textdomain' ),
                        'placeholder' => esc_html__( 'Enter item title', 'textdomain' ),
                    ],
                    [
                        'name' => 'description',
                        'label' => esc_html__( 'Description', 'textdomain' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__( 'Scroll item description goes here.', 'textdomain' ),
                        'placeholder' => esc_html__( 'Enter item description', 'textdomain' ),
                    ],
                ],
                'default' => [
                    [
                        'title' => esc_html__( 'Item 1', 'textdomain' ),
                        'description' => esc_html__( 'First scroll item description.', 'textdomain' ),
                    ],
                    [
                        'title' => esc_html__( 'Item 2', 'textdomain' ),
                        'description' => esc_html__( 'Second scroll item description.', 'textdomain' ),
                    ],
                    [
                        'title' => esc_html__( 'Item 3', 'textdomain' ),
                        'description' => esc_html__( 'Third scroll item description.', 'textdomain' ),
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
            'card_background',
            [
                'label' => esc_html__( 'Card Background', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__( 'Border Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e0e0e0',
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
            .scroll2-container {
                display: flex;
                gap: 2rem;
                overflow-x: auto;
                padding: 1rem 0;
                scroll-behavior: smooth;
            }
            
            .scroll2-container::-webkit-scrollbar {
                height: 8px;
            }
            
            .scroll2-container::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 4px;
            }
            
            .scroll2-container::-webkit-scrollbar-thumb {
                background: <?php echo esc_attr( $settings['border_color'] ); ?>;
                border-radius: 4px;
            }
            
            .scroll2-item {
                min-width: 300px;
                flex-shrink: 0;
                background-color: <?php echo esc_attr( $settings['card_background'] ); ?>;
                border: 1px solid <?php echo esc_attr( $settings['border_color'] ); ?>;
                border-radius: 12px;
                padding: 1.5rem;
                color: <?php echo esc_attr( $settings['text_color'] ); ?>;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            
            .scroll2-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            }
            
            .scroll2-image {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-radius: 8px;
                margin-bottom: 1rem;
            }
            
            .scroll2-title {
                font-size: 1.25rem;
                font-weight: bold;
                margin-bottom: 0.5rem;
                color: <?php echo esc_attr( $settings['text_color'] ); ?>;
            }
            
            .scroll2-description {
                font-size: 0.95rem;
                line-height: 1.6;
                margin: 0;
                opacity: 0.8;
            }
            
            @media (max-width: 768px) {
                .scroll2-container {
                    gap: 1rem;
                }
                
                .scroll2-item {
                    min-width: 250px;
                    padding: 1rem;
                }
                
                .scroll2-image {
                    height: 150px;
                }
            }
        </style>

        <div class="scroll2-container">
            <?php foreach ( $settings['scroll_items'] as $index => $item ) : ?>
                <div class="scroll2-item">
                    <?php if ( ! empty( $item['image']['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="scroll2-image">
                    <?php endif; ?>
                    <h3 class="scroll2-title"><?php echo esc_html( $item['title'] ); ?></h3>
                    <p class="scroll2-description"><?php echo esc_html( $item['description'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const scrollContainer = document.querySelector('.scroll2-container');
                const scrollItems = document.querySelectorAll('.scroll2-item');
                
                // Add smooth scroll animation on load
                scrollItems.forEach((item, index) => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateX(50px)';
                    item.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                    
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateX(0)';
                    }, index * 100);
                });
            });
        </script>
        
        <?php
    }
}

?>
