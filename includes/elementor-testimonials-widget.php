<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Testimonials_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'testimonials_section';
    }

    public function get_title() {
        return __('Testimonials Section', 'textdomain');
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['testimonials', 'reviews', 'quotes'];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => __('Section Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Testimonials', 'textdomain'),
                'placeholder' => __('Type your title here', 'textdomain'),
            ]
        );

        $this->add_control(
            'testimonials_limit',
            [
                'label' => __('Number of Testimonials', 'textdomain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 5,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __('Columns', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '5',
                'options' => [
                    '1' => __('1 Column', 'textdomain'),
                    '2' => __('2 Columns', 'textdomain'),
                    '3' => __('3 Columns', 'textdomain'),
                    '4' => __('4 Columns', 'textdomain'),
                    '5' => __('5 Columns', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'show_company',
            [
                'label' => __('Show Company', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'textdomain'),
                'label_off' => __('Hide', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'enable_hover',
            [
                'label' => __('Enable Hover Effects', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'textdomain'),
                'label_off' => __('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Typography Section
        $this->start_controls_section(
            'typography_section',
            [
                'label' => __('Typography', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => __('Name Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .testimonial-name',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'label' => __('Designation Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .testimonial-designation',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_text_typography',
                'label' => __('Testimonial Text Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .testimonial-quote',
            ]
        );

        $this->add_control(
            'text_alignment',
            [
                'label' => __('Text Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-preview' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .testimonial-quote' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .testimonial-author' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .testimonials-section' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .testimonials-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_alignment',
            [
                'label' => __('Title Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .testimonials-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .testimonials-title',
            ]
        );

        $this->add_responsive_control(
            'section_padding',
            [
                'label' => __('Section Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '60',
                    'right' => '20',
                    'bottom' => '60',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_gap',
            [
                'label' => __('Cards Gap', 'textdomain'),
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
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-container' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_height',
            [
                'label' => __('Card Height', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 250,
                        'max' => 600,
                        'step' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 400,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-card' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'container_width',
            [
                'label' => __('Container Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'full',
                'options' => [
                    'boxed' => __('Boxed', 'textdomain'),
                    'full' => __('Full Width', 'textdomain'),
                ],
            ]
        );

        $this->add_responsive_control(
            'container_max_width',
            [
                'label' => __('Max Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 800,
                        'max' => 2000,
                        'step' => 50,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'condition' => [
                    'container_width' => 'boxed',
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-section' => 'max-width: {{SIZE}}{{UNIT}}; margin: 0 auto;',
                ],
            ]
        );

        $this->end_controls_section();

        // Card Style Section
        $this->start_controls_section(
            'card_style_section',
            [
                'label' => __('Card Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label' => __('Border Radius', 'textdomain'),
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
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-card' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_hover_shadow',
                'label' => __('Hover Shadow', 'textdomain'),
                'selector' => '{{WRAPPER}} .testimonial-card:hover',
                'fields_options' => [
                    'box_shadow_type' => [
                        'default' => 'yes',
                    ],
                    'box_shadow' => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical' => 10,
                            'blur' => 30,
                            'spread' => 0,
                            'color' => 'rgba(0, 212, 170, 0.3)',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'preview_bg_color',
            [
                'label' => __('Preview Card Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f5f5f5',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-preview' => 'background: linear-gradient(135deg, {{VALUE}} 0%, {{VALUE}}dd 100%) !important;',
                ],
            ]
        );

        $this->add_control(
            'preview_text_color',
            [
                'label' => __('Preview Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-preview' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .testimonial-name' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .testimonial-designation' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .testimonial-company' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Container class based on width setting
        $container_class = isset($settings['container_width']) && $settings['container_width'] === 'full' ? 'testimonials-full-width' : 'testimonials-boxed';
        
        // Get testimonials
        $testimonials = new WP_Query(array(
            'post_type' => 'testimonial',
            'posts_per_page' => $settings['testimonials_limit'],
            'post_status' => 'publish'
        ));
        
        echo '<div class="testimonials-section ' . esc_attr($container_class) . '">';
        
        if ($testimonials->have_posts()) {
            $columns = isset($settings['columns']) ? $settings['columns'] : '5';
            echo '<div class="testimonials-container" data-columns="' . esc_attr($columns) . '" style="display: flex; gap: 20px; align-items: stretch; flex-wrap: nowrap; transition: all 0.3s ease;">';
            
            while ($testimonials->have_posts()) {
                $testimonials->the_post();
                
                $name = get_post_meta(get_the_ID(), '_testimonial_name', true);
                $designation = get_post_meta(get_the_ID(), '_testimonial_designation', true);
                $company = get_post_meta(get_the_ID(), '_testimonial_company', true);
                $video_url = get_post_meta(get_the_ID(), '_testimonial_video_url', true);
                $bg_color = get_post_meta(get_the_ID(), '_testimonial_bg_color', true) ?: '#00d4aa';
                $text_color = get_post_meta(get_the_ID(), '_testimonial_text_color', true) ?: '#ffffff';
                $type = get_post_meta(get_the_ID(), '_testimonial_type', true) ?: 'text';
                
                // Skip if no name provided
                if (empty($name)) {
                    continue;
                }
                
                $card_height = !empty($settings['card_height']['size']) ? $settings['card_height']['size'] . 'px' : '500px';
                
                echo '<div class="testimonial-card" data-type="' . esc_attr($type) . '" style="position: relative; min-height: ' . $card_height . '; border-radius: 12px; overflow: hidden; cursor: pointer; transition: all 0.3s ease; flex: 1; min-width: 200px;">';
                
                // Preview state (normal view)
                echo '<div class="testimonial-preview" style="padding: 30px 20px; height: 100%; display: flex; align-items: center; justify-content: center; position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 2; transition: opacity 0.3s ease;">';
                echo '<div class="testimonial-info">';
                echo '<h3 class="testimonial-name" style="font-size: 1.3rem; margin: 0 0 10px 0; font-weight: 600;">' . esc_html($name) . '</h3>';
                if (!empty($designation)) {
                    echo '<p class="testimonial-designation" style="margin: 0 0 6px 0; font-size: 1rem; opacity: 0.8; font-weight: 500;">' . esc_html($designation) . '</p>';
                }
                if (!empty($company) && (!isset($settings['show_company']) || $settings['show_company'] === 'yes')) {
                    echo '<p class="testimonial-company" style="margin: 0; font-size: 0.9rem;">' . esc_html($company) . '</p>';
                }
                echo '</div>';
                echo '</div>';
                
                // Content state (hover view)
                echo '<div class="testimonial-content" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0; transition: opacity 0.4s ease; z-index: 1;">';
                
                if ($type === 'video' && !empty($video_url)) {
                    echo '<div class="testimonial-video" style="width: 100%; height: 100%; overflow: hidden; border-radius: 12px;">';
                    
                    if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video_url, $match);
                        if (isset($match[1])) {
                            $unique_id = 'yt-' . get_the_ID();
                            // Note: autoplay added via JavaScript on hover
                            echo '<iframe id="' . $unique_id . '" class="video-iframe youtube-iframe" data-video-id="' . $match[1] . '" src="https://www.youtube.com/embed/' . $match[1] . '?enablejsapi=1&mute=1&controls=1&rel=0&fs=1&modestbranding=1" style="width: 100%; height: 100%; border: none;" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                        }
                    } elseif (strpos($video_url, 'vimeo.com') !== false) {
                        preg_match('/vimeo\.com\/(\d+)/', $video_url, $match);
                        if (isset($match[1])) {
                            $unique_id = 'vimeo-' . get_the_ID();
                            echo '<iframe id="' . $unique_id . '" class="video-iframe vimeo-iframe" data-video-id="' . $match[1] . '" src="https://player.vimeo.com/video/' . $match[1] . '?autoplay=1&muted=1&controls=1&title=0&byline=0&portrait=0" style="width: 100%; height: 100%; border: none;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
                        }
                    } else {
                        echo '<video class="video-element" src="' . esc_url($video_url) . '" style="width: 100%; height: 100%; object-fit: cover;" controls playsinline preload="metadata" muted></video>';
                    }
                    
                    // Add mute/unmute toggle button for videos
                    if ($type === 'video') {
                        echo '<button class="video-mute-toggle" style="position: absolute; top: 15px; right: 15px; z-index: 10; background: rgba(0,212,170,0.8); border: none; border-radius: 50%; width: 45px; height: 45px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; opacity: 0; transition: opacity 0.3s ease, background 0.2s ease, transform 0.2s ease;" title="Toggle Mute">
                            <span class="mute-icon" style="display: none;">🔇</span>
                            <span class="unmute-icon" style="display: block;">🔊</span>
                        </button>';
                    }
                    
                    echo '</div>';
                } else {
                    $content = get_the_content();
                    if (!empty($content)) {
                        echo '<div class="testimonial-text" style="width: 100%; height: 100%; padding: 30px 25px; display: flex; flex-direction: column; justify-content: space-between; border-radius: 12px; background-color: ' . esc_attr($bg_color) . '; color: ' . esc_attr($text_color) . '; position: relative; overflow-y: auto; overflow-x: hidden;">';
                        echo '<div style="content: \'\"\'; font-size: 4rem; opacity: 0.3; position: absolute; top: 15px; left: 20px; line-height: 1;">"</div>';
                        echo '<div class="testimonial-quote" style="flex: 1; display: flex; align-items: center; font-size: 1rem; line-height: 1.6; margin-top: 25px; word-break: break-word;">';
                        echo '<div>' . wp_kses_post($content) . '</div>';
                        echo '</div>';
                        echo '<div class="testimonial-author" style="margin-top: 25px; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.2);">';
                        echo '<strong style="display: block; font-size: 1.1rem; margin-bottom: 6px;">' . esc_html($name) . '</strong>';
                        echo '<span style="font-size: 0.9rem; opacity: 0.9;">' . esc_html($designation);
                        if (!empty($company) && (!isset($settings['show_company']) || $settings['show_company'] === 'yes')) {
                            echo ', ' . esc_html($company);
                        }
                        echo '</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                
                echo '</div>';
                echo '</div>';
            }
            
            echo '</div>';
        } else {
            echo '<div class="no-testimonials" style="text-align: center; color: #666; padding: 40px; border: 2px dashed #ddd; border-radius: 8px;"><h3>No testimonials found</h3><p>Please add testimonials with proper names from <strong>WordPress Admin > Testimonials</strong></p></div>';
        }
        
        echo '</div>';
        
        wp_reset_postdata();
        
        // Add enhanced hover JavaScript inline
        if (!isset($settings['enable_hover']) || $settings['enable_hover'] === 'yes') {
            echo '<script>
            // Load YouTube API
            if (typeof(YT) == "undefined" || typeof(YT.Player) == "undefined") {
                var tag = document.createElement("script");
                tag.src = "https://www.youtube.com/iframe_api";
                var firstScriptTag = document.getElementsByTagName("script")[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            }
            
            // Load Vimeo API
            if (typeof(Vimeo) == "undefined") {
                var vimeoScript = document.createElement("script");
                vimeoScript.src = "https://player.vimeo.com/api/player.js";
                vimeoScript.onload = function() {
                    // Initialize Vimeo players once API is loaded
                    $(".vimeo-iframe").each(function() {
                        var player = new Vimeo.Player(this);
                        vimeoPlayers[this.id] = player;
                        player.setVolume(0);
                        // Bind mute toggle after player is ready
                        player.ready().then(function() {
                            bindMuteToggle($(player.element).closest(".testimonial-card"));
                        });
                    });
                };
                document.head.appendChild(vimeoScript);
            } else {
                // API already loaded
                $(".vimeo-iframe").each(function() {
                    var player = new Vimeo.Player(this);
                    vimeoPlayers[this.id] = player;
                    player.setVolume(0);
                    // Bind mute toggle after player is ready
                    player.ready().then(function() {
                        bindMuteToggle($(player.element).closest(".testimonial-card"));
                    });
                });
            }
            
            jQuery(document).ready(function($) {
                var ytPlayers = {};
                var vimeoPlayers = {};
                var isHovering = false;
                var isMuteToggling = false;
                var muteToggleBound = {};
                
                // Initialize YouTube players when API is ready
                window.onYouTubeIframeAPIReady = function() {
                    // Small delay to ensure DOM is fully ready
                    setTimeout(function() {
                        $(".youtube-iframe").each(function() {
                            var iframe = this;
                            var videoId = $(this).data("video-id");
                            ytPlayers[iframe.id] = new YT.Player(iframe.id, {
                                videoId: videoId,
                                events: {
                                    "onReady": function(event) {
                                        // Start muted to comply with browser autoplay policies
                                        event.target.mute();
                                        // Bind mute toggle after player is ready
                                        bindMuteToggle($(iframe).closest(".testimonial-card"));
                                    }
                                }
                            });
                        });
                    }, 100);
                };
                
                // Check if YouTube API already loaded
                if (typeof YT !== "undefined" && typeof YT.Player !== "undefined") {
                    window.onYouTubeIframeAPIReady();
                }
                
                // Initialize Vimeo players (handled in script load callback above)
                
                // Function to bind mute toggle to a specific card (called when player is ready)
                function bindMuteToggle(card) {
                    var cardId = card.attr("class") + card.index();
                    if (muteToggleBound[cardId]) return; // Already bound
                    muteToggleBound[cardId] = true;
                    
                    var muteButton = card.find(".video-mute-toggle");
                    if (!muteButton.length) return;
                    
                    // Remove any existing handlers to prevent duplicates
                    muteButton.off("click.muteToggle");
                    
                    muteButton.on("click.muteToggle", function(e) {
                        e.stopPropagation();
                        e.preventDefault();
                        
                        if (isMuteToggling) return;
                        isMuteToggling = true;
                        
                        var button = $(this);
                        var videoElement = card.find("video.video-element");
                        var youtubeIframe = card.find(".youtube-iframe");
                        var vimeoIframe = card.find(".vimeo-iframe");
                        var muteIcon = button.find(".mute-icon");
                        var unmuteIcon = button.find(".unmute-icon");
                        
                        if (videoElement.length) {
                            // Toggle mute for self-hosted video
                            if (videoElement[0].muted) {
                                videoElement[0].muted = false;
                                muteIcon.hide();
                                unmuteIcon.show();
                                button.css("background", "rgba(0,212,170,0.8)");
                            } else {
                                videoElement[0].muted = true;
                                muteIcon.show();
                                unmuteIcon.hide();
                                button.css("background", "rgba(0,0,0,0.7)");
                            }
                            isMuteToggling = false;
                        } else if (youtubeIframe.length) {
                            var ytPlayer = ytPlayers[youtubeIframe.attr("id")];
                            if (ytPlayer && typeof ytPlayer.getPlayerState === "function") {
                                try {
                                    var playerState = ytPlayer.getPlayerState();
                                    if (ytPlayer.isMuted()) {
                                        ytPlayer.unMute();
                                        muteIcon.hide();
                                        unmuteIcon.show();
                                        button.css("background", "rgba(0,212,170,0.8)");
                                    } else {
                                        ytPlayer.mute();
                                        muteIcon.show();
                                        unmuteIcon.hide();
                                        button.css("background", "rgba(0,0,0,0.7)");
                                    }
                                } catch(err) {
                                    console.log("YouTube player control error:", err);
                                }
                            } else {
                                console.log("YouTube player not ready yet");
                            }
                            setTimeout(function() { isMuteToggling = false; }, 300);
                        } else if (vimeoIframe.length) {
                            var vimeoPlayer = vimeoPlayers[vimeoIframe.attr("id")];
                            if (vimeoPlayer && typeof vimeoPlayer.getVolume === "function") {
                                vimeoPlayer.getVolume().then(function(volume) {
                                    if (volume === 0) {
                                        vimeoPlayer.setVolume(1);
                                        muteIcon.hide();
                                        unmuteIcon.show();
                                        button.css("background", "rgba(0,212,170,0.8)");
                                    } else {
                                        vimeoPlayer.setVolume(0);
                                        muteIcon.show();
                                        unmuteIcon.hide();
                                        button.css("background", "rgba(0,0,0,0.7)");
                                    }
                                    setTimeout(function() { isMuteToggling = false; }, 300);
                                }).catch(function(err) {
                                    console.log("Vimeo volume control error:", err);
                                    isMuteToggling = false;
                                });
                            } else {
                                console.log("Vimeo player not ready yet");
                                isMuteToggling = false;
                            }
                        } else {
                            isMuteToggling = false;
                        }
                    });
                }
                
                // Bind mute toggle for self-hosted videos immediately
                $(".testimonial-card").each(function() {
                    var card = $(this);
                    if (card.find("video.video-element").length) {
                        bindMuteToggle(card);
                    }
                });
                
                $(".testimonial-card").hover(
                    function() {
                        if (isMuteToggling) return; // Don\'t trigger hover during mute toggle
                        
                        var card = $(this);
                        isHovering = true;
                        
                        // Expand hovered card to 2x width with smooth animation
                        card.css({
                            "flex": "2",
                            "transform": "scale(1.02)",
                            "transition": "all 0.4s cubic-bezier(0.4, 0, 0.2, 1)"
                        });
                        
                        // Show content, hide preview
                        card.find(".testimonial-preview").css("opacity", "0");
                        card.find(".testimonial-content").css("opacity", "1");
                        
                        // Show mute toggle button
                        card.find(".video-mute-toggle").css("opacity", "1");
                        
                        // Wait a bit for the expand animation before playing video
                        setTimeout(function() {
                            if (!isHovering) return; // User already left
                            
                            // Handle video autoplay
                            var videoElement = card.find("video.video-element");
                            var youtubeIframe = card.find(".youtube-iframe");
                            var vimeoIframe = card.find(".vimeo-iframe");
                            
                            if (videoElement.length) {
                                // Self-hosted video - play with sound
                                videoElement[0].muted = false;
                                var playPromise = videoElement[0].play();
                                if (playPromise !== undefined) {
                                    playPromise.catch(function(err) {
                                        console.log("Video autoplay prevented, trying muted:", err);
                                        // Fallback: try muted if browser blocks sound
                                        videoElement[0].muted = true;
                                        videoElement[0].play().catch(function(err2) {
                                            console.log("Video autoplay completely blocked:", err2);
                                        });
                                    });
                                }
                            } else if (youtubeIframe.length) {
                                var ytPlayer = ytPlayers[youtubeIframe.attr("id")];
                                if (ytPlayer && typeof ytPlayer.playVideo === "function") {
                                    ytPlayer.playVideo();
                                    // Unmute after starting (browser may block, but we try)
                                    ytPlayer.unMute();
                                }
                            } else if (vimeoIframe.length) {
                                var vimeoPlayer = vimeoPlayers[vimeoIframe.attr("id")];
                                if (vimeoPlayer && typeof vimeoPlayer.play === "function") {
                                    vimeoPlayer.play().then(function() {
                                        // Set full volume after play starts
                                        vimeoPlayer.setVolume(1);
                                    }).catch(function(err) {
                                        console.log("Vimeo autoplay prevented:", err);
                                    });
                                }
                            }
                        }, 200); // Small delay for smoother UX
                        
                        // Compress other cards with smooth animation
                        card.siblings(".testimonial-card").css({
                            "flex": "0.8",
                            "transform": "scale(0.98)",
                            "transition": "all 0.4s cubic-bezier(0.4, 0, 0.2, 1)"
                        });
                    },
                    function() {
                        var card = $(this);
                        isHovering = false;
                        
                        // Reset all cards to normal size with smooth animation
                        $(".testimonial-card").css({
                            "flex": "1",
                            "transform": "scale(1)",
                            "transition": "all 0.4s cubic-bezier(0.4, 0, 0.2, 1)"
                        });
                        
                        // Show preview, hide content
                        card.find(".testimonial-preview").css("opacity", "1");
                        card.find(".testimonial-content").css("opacity", "0");
                        
                        // Hide mute toggle button
                        card.find(".video-mute-toggle").css("opacity", "0");
                        
                        // Handle video pause/reset
                        var videoElement = card.find("video.video-element");
                        var youtubeIframe = card.find(".youtube-iframe");
                        var vimeoIframe = card.find(".vimeo-iframe");
                        
                        if (videoElement.length) {
                            videoElement[0].pause();
                            videoElement[0].currentTime = 0;
                            videoElement[0].muted = false; // Keep unmuted for next hover
                        } else if (youtubeIframe.length) {
                            var ytPlayer = ytPlayers[youtubeIframe.attr("id")];
                            if (ytPlayer && typeof ytPlayer.stopVideo === "function") {
                                ytPlayer.stopVideo();
                                ytPlayer.mute(); // Reset to muted for initial state
                            }
                        } else if (vimeoIframe.length) {
                            var vimeoPlayer = vimeoPlayers[vimeoIframe.attr("id")];
                            if (vimeoPlayer && typeof vimeoPlayer.pause === "function") {
                                vimeoPlayer.pause();
                                vimeoPlayer.setCurrentTime(0);
                                // Keep volume for next hover (will be set in play)
                            }
                        }
                    }
                );
                
                // Add hover effect to mute button
                $(".video-mute-toggle").hover(
                    function() {
                        if (!isMuteToggling) {
                            $(this).css("transform", "scale(1.1)");
                        }
                    },
                    function() {
                        if (!isMuteToggling) {
                            $(this).css("transform", "scale(1)");
                        }
                    }
                );
            });
            </script>';
        }
    }
}