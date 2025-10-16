<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Gallery_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'gallery';
    }

    public function get_title() {
        return __( 'Gallery Grid', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Gallery Images', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery_images',
            [
                'label' => __( 'Add Images', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Gallery Style', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __( 'Background Color', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .gallery-widget' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gallery_gap',
            [
                'label' => __( 'Gap', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-widget' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gallery_padding',
            [
                'label' => __( 'Padding', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Image Border Radius', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $gallery_images = $settings['gallery_images'];

        if ( empty( $gallery_images ) ) {
            echo '<p>' . __( 'Please add images to the gallery.', 'text-domain' ) . '</p>';
            return;
        }

        // Limit to 6 images for the grid layout
        $gallery_images = array_slice( $gallery_images, 0, 6 );
        ?>
        <div class="gallery-widget">
            <?php foreach ( $gallery_images as $index => $image ) : ?>
                <div class="gallery-item gallery-item-<?php echo $index + 1; ?>">
                    <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( get_post_meta( $image['id'], '_wp_attachment_image_alt', true ) ); ?>">
                </div>
            <?php endforeach; ?>
        </div>

        <style>
            .gallery-widget {
                display: grid;
                grid-template-columns: repeat(6, 1fr);
                grid-template-rows: repeat(2, 1fr);
                width: 100%;
                min-height: 400px;
            }

            .gallery-item {
                overflow: hidden;
                position: relative;
            }

            .gallery-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform 0.3s ease;
            }

            .gallery-item:hover img {
                transform: scale(1.05);
            }

            /* Grid layout based on the image */
            .gallery-item-1 {
                grid-column: 1 / 4;
                grid-row: 1;
            }

            .gallery-item-2 {
                grid-column: 4 / 5;
                grid-row: 1;
            }

            .gallery-item-3 {
                grid-column: 5 / 7;
                grid-row: 1;
            }

            .gallery-item-4 {
                grid-column: 1 / 2;
                grid-row: 2;
            }

            .gallery-item-5 {
                grid-column: 2 / 3;
                grid-row: 2;
            }

            .gallery-item-6 {
                grid-column: 3 / 7;
                grid-row: 2;
            }

            /* Responsive Design */
            @media (max-width: 1024px) {
                .gallery-widget {
                    grid-template-columns: repeat(4, 1fr);
                    grid-template-rows: repeat(3, 1fr);
                }

                .gallery-item-1 {
                    grid-column: 1 / 3;
                    grid-row: 1;
                }

                .gallery-item-2 {
                    grid-column: 3 / 4;
                    grid-row: 1;
                }

                .gallery-item-3 {
                    grid-column: 4 / 5;
                    grid-row: 1;
                }

                .gallery-item-4 {
                    grid-column: 1 / 2;
                    grid-row: 2;
                }

                .gallery-item-5 {
                    grid-column: 2 / 3;
                    grid-row: 2;
                }

                .gallery-item-6 {
                    grid-column: 3 / 5;
                    grid-row: 2;
                }
            }

            @media (max-width: 768px) {
                .gallery-widget {
                    grid-template-columns: repeat(2, 1fr);
                    grid-template-rows: repeat(3, 1fr);
                    min-height: 600px;
                }

                .gallery-item-1,
                .gallery-item-2,
                .gallery-item-3,
                .gallery-item-4,
                .gallery-item-5,
                .gallery-item-6 {
                    grid-column: auto;
                    grid-row: auto;
                }

                .gallery-item-1 {
                    grid-column: 1 / 3;
                }
            }

            @media (max-width: 480px) {
                .gallery-widget {
                    grid-template-columns: 1fr;
                    grid-template-rows: auto;
                    min-height: auto;
                }

                .gallery-item {
                    min-height: 200px;
                }

                .gallery-item-1,
                .gallery-item-2,
                .gallery-item-3,
                .gallery-item-4,
                .gallery-item-5,
                .gallery-item-6 {
                    grid-column: 1;
                    grid-row: auto;
                }
            }
        </style>
        <?php
    }
}
?>