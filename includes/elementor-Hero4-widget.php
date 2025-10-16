<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Elementor_Hero4_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hero4';
    }

    public function get_title() {
        return __( 'Hero Section 4', 'hello-elementor-child' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function _register_controls() {
        
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'hello-elementor-child' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'hero_title',
            [
                'label' => __( 'Hero Title', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'BUSINESS COACHING', 'hello-elementor-child' ),
                'placeholder' => __( 'Enter your hero title...', 'hello-elementor-child' ),
                'description' => __( 'Main hero text that appears in center', 'hello-elementor-child' ),
            ]
        );

        $this->add_control(
            'images_heading',
            [
                'label' => __( 'Images (5 total)', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // 5 Image controls with position descriptions
        $image_positions = [
            1 => 'Top Left - Small',
            2 => 'Top Right - Large Portrait', 
            3 => 'Bottom Left - Medium Square',
            4 => 'Bottom Right - Small',
            5 => 'Middle Left - Small'
        ];

        for ($i = 1; $i <= 5; $i++) {
            $this->add_control(
                "image_$i",
                [
                    'label' => __( "Image $i", 'hello-elementor-child' ) . " ({$image_positions[$i]})",
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );
        }

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'hello-elementor-child' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __( 'Background Color', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a1a1a',
                'selectors' => [
                    '{{WRAPPER}} .hero4-container' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .img-reveal-mask' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'hello-elementor-child' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f4d03f',
                'selectors' => [
                    '{{WRAPPER}} .hero4-text h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Title Typography', 'hello-elementor-child' ),
                'selector' => '{{WRAPPER}} .hero4-text h2',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Fallback images (5 images now)
        $fallback_images = [
            'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1544717297-fa95b6ee9643?w=400&h=500&fit=crop',
            'https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?w=400&h=400&fit=crop',
            'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=300&fit=crop'
        ];
        ?>
        
        <style>
            /* EMBEDDED STYLES - Hero4 Widget - BIGGER RESPONSIVE IMAGES */
            .hero4-container {
                position: relative;
                min-height: 100vh;
                background: <?php echo $settings['background_color'] ?: '#1a1a1a'; ?>;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                padding: 0;
            }

            .hero4-images {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
            }

            .hero4-img {
                position: absolute;
                overflow: hidden;
                cursor: pointer;
                pointer-events: all;
                will-change: transform;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
                border-radius: 0; /* NO ROUNDED CORNERS */
            }

            .img-reveal-mask {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: <?php echo $settings['background_color'] ?: '#1a1a1a'; ?>;
                z-index: 2;
                transform: translateY(0%);
                transition: transform 1.4s cubic-bezier(0.77, 0, 0.175, 1);
            }

            .hero4-img.revealed .img-reveal-mask {
                transform: translateY(-100%);
            }

            .hero4-img img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                position: relative;
                z-index: 1;
            }

            /* FIXED POSITIONING - NO OVERLAPPING, VARIED SIZES */
            
            /* Top Left - Medium rectangular */
            .hero4-img.img1 {
                top: 8%;
                left: 3%;
                width: min(18vw, 260px);
                height: min(12vw, 170px);
                z-index: 3;
            }

            /* Top Right - Large portrait (biggest image) */
            .hero4-img.img2 {
                top: 6%;
                right: 3%;
                width: min(24vw, 350px);
                height: min(32vw, 460px);
                z-index: 4;
            }

            /* Bottom Left - Large square */
            .hero4-img.img3 {
                bottom: 8%;
                left: 3%;
                width: min(20vw, 290px);
                height: min(20vw, 290px);
                z-index: 2;
            }

            /* Bottom Right - Small rectangular */
            .hero4-img.img4 {
                bottom: 8%;
                right: 3%;
                width: min(16vw, 230px);
                height: min(10vw, 140px);
                z-index: 3;
            }

            /* Middle Left - Small vertical */
            .hero4-img.img5 {
                top: 50%;
                left: 1%;
                width: min(14vw, 200px);
                height: min(16vw, 230px);
                z-index: 2;
                transform: translateY(-50%);
            }

            .hero4-text {
                position: relative;
                z-index: 10;
                text-align: center;
                max-width: 700px;
                padding: 0 2rem;
                opacity: 0;
                filter: blur(8px);
                transform: translateY(20px);
                transition: all 1.6s cubic-bezier(0.4, 0.0, 0.2, 1);
            }

            .hero4-text.revealed {
                opacity: 1;
                filter: blur(0px);
                transform: translateY(0);
            }

            .hero4-text h2 {
                font-size: clamp(3rem, 10vw, 9rem);
                font-weight: 900;
                line-height: 0.85;
                color: <?php echo $settings['text_color'] ?: '#f4d03f'; ?>;
                text-transform: uppercase;
                letter-spacing: -0.04em;
                margin: 0;
                text-shadow: 4px 4px 12px rgba(0, 0, 0, 0.6);
                font-family: 'Inter', 'Arial Black', Arial, sans-serif;
            }

            .hero4-img:hover img {
                transform: scale(1.05);
                transition: transform 0.4s ease;
            }

            .hero4-img:hover {
                z-index: 5;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6);
                transform: translateY(-3px);
                transition: all 0.3s ease;
            }

            @keyframes hero4-float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }

            .hero4-img.revealed {
                animation: hero4-float 10s ease-in-out infinite;
            }

            .hero4-img.img1.revealed { animation-delay: 0s; }
            .hero4-img.img2.revealed { animation-delay: 2s; }
            .hero4-img.img3.revealed { animation-delay: 4s; }
            .hero4-img.img4.revealed { animation-delay: 6s; }
            .hero4-img.img5.revealed { animation-delay: 8s; }

            /* Responsive - Scale down on smaller screens */
            @media (max-width: 1200px) {
                .hero4-img.img1 {
                    width: min(20vw, 240px);
                    height: min(14vw, 160px);
                }
                .hero4-img.img2 {
                    width: min(26vw, 320px);
                    height: min(34vw, 420px);
                }
                .hero4-img.img3 {
                    width: min(22vw, 260px);
                    height: min(22vw, 260px);
                }
                .hero4-img.img4 {
                    width: min(18vw, 210px);
                    height: min(12vw, 130px);
                }
                .hero4-img.img5 {
                    width: min(16vw, 180px);
                    height: min(18vw, 210px);
                }
            }

            @media (max-width: 768px) {
                .hero4-img { display: none !important; }
                .hero4-text h2 { 
                    font-size: clamp(2.5rem, 8vw, 4rem); 
                    line-height: 0.9; 
                }
                .hero4-container { 
                    min-height: 80vh; 
                    padding: 1rem; 
                }
            }

            @media (max-width: 480px) {
                .hero4-text h2 { 
                    font-size: 2.5rem; 
                }
            }
        </style>

        <section class="hero4-container">
            <div class="hero4-images">
                <?php for ($i = 1; $i <= 5; $i++) : 
                    $image_data = $settings["image_$i"];
                    $image_url = !empty($image_data['url']) ? $image_data['url'] : $fallback_images[$i-1];
                    $image_alt = !empty($image_data['alt']) ? $image_data['alt'] : "Hero Image $i";
                ?>
                    <div class="hero4-img img<?php echo $i; ?>" data-delay="<?php echo 200 + ($i * 250); ?>">
                        <div class="img-reveal-mask"></div>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                    </div>
                <?php endfor; ?>
            </div>
            
            <div class="hero4-text" data-delay="150">
                <h2><?php echo wp_kses_post($settings['hero_title']); ?></h2>
            </div>
        </section>

        <script>
            // EMBEDDED JAVASCRIPT - Hero4 Animation
            (function() {
                console.log('Hero4: Script loaded');
                
                function initHero4Animation() {
                    const container = document.querySelector('.hero4-container');
                    if (!container) {
                        console.log('Hero4: Container not found');
                        return;
                    }
                    
                    console.log('Hero4: Container found, starting animation');
                    
                    const images = container.querySelectorAll('.hero4-img');
                    const textElement = container.querySelector('.hero4-text');
                    
                    console.log('Hero4: Found', images.length, 'images');
                    
                    // Start text animation
                    setTimeout(() => {
                        if (textElement) {
                            textElement.classList.add('revealed');
                            console.log('Hero4: Text revealed');
                        }
                    }, 150);
                    
                    // Start image animations with staggered delays
                    images.forEach((img, index) => {
                        const delay = 450 + (index * 250);
                        setTimeout(() => {
                            img.classList.add('revealed');
                            console.log('Hero4: Image', index + 1, 'revealed');
                        }, delay);
                    });
                }
                
                // Initialize immediately if DOM is ready
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initHero4Animation);
                } else {
                    setTimeout(initHero4Animation, 100);
                }
                
                // Re-initialize for Elementor editor
                if (typeof elementor !== 'undefined') {
                    elementor.hooks.addAction('panel/open_editor/widget/hero4', function() {
                        setTimeout(initHero4Animation, 300);
                    });
                }
            })();
        </script>
        <?php
    }
}
?>