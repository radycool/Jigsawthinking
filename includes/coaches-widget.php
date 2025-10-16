<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Coaches_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'coaches_widget';
    }

    public function get_title() {
        return __('Coaches Section', 'text-domain');
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'coaches_section',
            [
                'label' => __('Coaches', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'coach_name',
            [
                'label' => __('Coach Name', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Coach Name', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'coach_title',
            [
                'label' => __('Coach Title', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Business Coach', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'coach_tier',
            [
                'label' => __('Coach Tier', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Growth Coach Tier', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'ideal_for',
            [
                'label' => __('Ideal For', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Solo founders or early-stage entrepreneurs', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'coach_description',
            [
                'label' => __('Coach Description', 'text-domain'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Coach description goes here...', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'coaching_style',
            [
                'label' => __('Coaching Style', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Supportive but focused. More frameworks, less fluff.', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'who_coached',
            [
                'label' => __('Who Coached', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Creative entrepreneurs, coaches, CXOs-turned-founders', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'focus_areas',
            [
                'label' => __('Focus Areas', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Sustainable business growth\nGoal clarity and personal alignment\nPurpose-driven decision making\nWork-life fulfillment', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'testimonial',
            [
                'label' => __('Testimonial', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Great coach!', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'testimonial_author',
            [
                'label' => __('Testimonial Author', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Client Name', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'cta_text',
            [
                'label' => __('CTA Text', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Book Your Free Call', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'cover_image',
            [
                'label' => __('Cover Image', 'text-domain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'video_url',
            [
                'label' => __('Video URL', 'text-domain'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-video-url.mp4', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'card_1_bg_color',
            [
                'label' => __('Card 1 Background Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'card_2_bg_color',
            [
                'label' => __('Card 2 Background Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'card_3_bg_color',
            [
                'label' => __('Card 3 Background Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'card_4_bg_color',
            [
                'label' => __('Card 4 Background Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
            ]
        );

        $this->add_control(
            'coaches_list',
            [
                'label' => __('Coaches List', 'text-domain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'coach_name' => __('Radhika Dhawan', 'text-domain'),
                        'coach_title' => __('Mindset & Business Coach', 'text-domain'),
                    ],
                    [
                        'coach_name' => __('Malay Damania', 'text-domain'),
                        'coach_title' => __('Business Coach for MSMEs', 'text-domain'),
                    ],
                    [
                        'coach_name' => __('Raashid Navlakhi', 'text-domain'),
                        'coach_title' => __('Founder & Principal Coach', 'text-domain'),
                    ],
                ],
                'title_field' => '{{{ coach_name }}}',
            ]
        );

        $this->end_controls_section();

        // Style Controls Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'grey_card_bg',
            [
                'label' => __('Grey Card Background', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e5e5e5',
                'selectors' => [
                    '{{WRAPPER}} .block.grey' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'white_card_bg',
            [
                'label' => __('White Card Background', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .block.white' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'coach_name_typography',
                'label' => __('Coach Name Typography', 'text-domain'),
                'selector' => '{{WRAPPER}} .coach-name',
            ]
        );

        $this->add_control(
            'coach_name_color',
            [
                'label' => __('Coach Name Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a1a1a',
                'selectors' => [
                    '{{WRAPPER}} .coach-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'coach_title_typography',
                'label' => __('Coach Title Typography', 'text-domain'),
                'selector' => '{{WRAPPER}} .coach-title',
            ]
        );

        $this->add_control(
            'coach_title_color',
            [
                'label' => __('Coach Title Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666',
                'selectors' => [
                    '{{WRAPPER}} .coach-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'body_text_typography',
                'label' => __('Body Text Typography', 'text-domain'),
                'selector' => '{{WRAPPER}} .description, {{WRAPPER}} .coaching-style, {{WRAPPER}} .who-coached, {{WRAPPER}} .ideal-for, {{WRAPPER}} .focus-areas, {{WRAPPER}} .testimonial',
            ]
        );

        $this->add_control(
            'body_text_color',
            [
                'label' => __('Body Text Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .description, {{WRAPPER}} .coaching-style, {{WRAPPER}} .who-coached, {{WRAPPER}} .ideal-for, {{WRAPPER}} .focus-areas, {{WRAPPER}} .testimonial' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_color',
            [
                'label' => __('CTA Text Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0066cc',
                'selectors' => [
                    '{{WRAPPER}} .cta' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_border_color',
            [
                'label' => __('Card Border Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .block' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_border_width',
            [
                'label' => __('Card Border Width', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .block' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if (empty($settings['coaches_list'])) {
            return;
        }
        ?>

        <div class="coaches-section">
            <div class="coaches-container">
            <?php foreach ($settings['coaches_list'] as $index => $coach): ?>
                
                <?php if ($index == 0): // Radhika - 2x2 Grey blocks ?>
                    <div class="coach-grid layout-1">
                        <!-- Card 1: Media -->
                        <div class="block card-1 grey media-card" style="<?php echo !empty($coach['card_1_bg_color']) ? 'background-color: ' . esc_attr($coach['card_1_bg_color']) . ' !important;' : ''; ?>">
                            <?php if (!empty($coach['cover_image']['url'])): ?>
                                <div class="media-content">
                                    <img src="<?php echo esc_url($coach['cover_image']['url']); ?>" alt="<?php echo esc_attr($coach['coach_name']); ?>" class="cover-image">
                                    <?php if (!empty($coach['video_url']['url'])): ?>
                                        <video class="coach-video" muted loop playsinline preload="metadata">
                                            <source src="<?php echo esc_url($coach['video_url']['url']); ?>" type="video/mp4">
                                        </video>
                                        <div class="video-controls">
                                            <button class="mute-toggle" aria-label="Toggle sound">🔇</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="pink-circle"></div>
                            <?php endif; ?>
                        </div>

                        <!-- Card 2: Coach Info -->
                        <div class="block card-2 grey" style="<?php echo !empty($coach['card_2_bg_color']) ? 'background-color: ' . esc_attr($coach['card_2_bg_color']) . ' !important;' : ''; ?>">
                            <div class="tier-dot green"></div>
                            <h3 class="coach-name"><?php echo esc_html($coach['coach_name']); ?></h3>
                            <p class="coach-title"><?php echo esc_html($coach['coach_title']); ?> (<?php echo esc_html($coach['coach_tier']); ?>)</p>
                            <div class="ideal-for">
                                🟢 <strong>Ideal for:</strong> <?php echo esc_html($coach['ideal_for']); ?>
                            </div>
                        </div>

                        <!-- Card 3: Description & Style -->
                        <div class="block card-3 grey" style="<?php echo !empty($coach['card_3_bg_color']) ? 'background-color: ' . esc_attr($coach['card_3_bg_color']) . ' !important;' : ''; ?>">
                            <div class="description"><?php echo wp_kses_post($coach['coach_description']); ?></div>
                            <div class="coaching-style"><strong>Coaching Style:</strong> <?php echo esc_html($coach['coaching_style']); ?></div>
                            <div class="who-coached"><strong>Who she's coached:</strong> <?php echo esc_html($coach['who_coached']); ?></div>
                        </div>

                        <!-- Card 4: Focus Areas & Testimonial -->
                        <div class="block card-4 grey" style="<?php echo !empty($coach['card_4_bg_color']) ? 'background-color: ' . esc_attr($coach['card_4_bg_color']) . ' !important;' : ''; ?>">
                            <div class="focus-areas">
                                <strong>Focus Areas:</strong>
                                <?php 
                                $areas = explode("\n", $coach['focus_areas']);
                                foreach($areas as $area): if(trim($area)): ?>
                                    <div>• <?php echo esc_html(trim($area)); ?></div>
                                <?php endif; endforeach; ?>
                            </div>
                            <div class="testimonial">
                                <em>"<?php echo esc_html($coach['testimonial']); ?>"</em>
                                <div>— <?php echo esc_html($coach['testimonial_author']); ?></div>
                            </div>
                            <div class="cta">[Looking for a Growth Coach? → <?php echo esc_html($coach['cta_text']); ?>]</div>
                        </div>
                    </div>

                <?php elseif ($index == 1): // Malay - 1x4 White blocks ?>
                    <div class="coach-grid layout-2">
                        <!-- Card 1: Coach Info -->
                        <div class="block card-1 white" style="<?php echo !empty($coach['card_1_bg_color']) ? 'background-color: ' . esc_attr($coach['card_1_bg_color']) . ' !important;' : ''; ?>">
                            <div class="tier-dot orange"></div>
                            <h3 class="coach-name"><?php echo esc_html($coach['coach_name']); ?></h3>
                            <p class="coach-title"><?php echo esc_html($coach['coach_title']); ?> (<?php echo esc_html($coach['coach_tier']); ?>)</p>
                            <div class="ideal-for">
                                🟠 <strong>Ideal for:</strong> <?php echo esc_html($coach['ideal_for']); ?>
                            </div>
                        </div>

                        <!-- Card 2: Media -->
                        <div class="block card-2 white media-card" style="<?php echo !empty($coach['card_2_bg_color']) ? 'background-color: ' . esc_attr($coach['card_2_bg_color']) . ' !important;' : ''; ?>">
                            <?php if (!empty($coach['cover_image']['url'])): ?>
                                <div class="media-content">
                                    <img src="<?php echo esc_url($coach['cover_image']['url']); ?>" alt="<?php echo esc_attr($coach['coach_name']); ?>" class="cover-image">
                                    <?php if (!empty($coach['video_url']['url'])): ?>
                                        <video class="coach-video" muted loop playsinline preload="metadata">
                                            <source src="<?php echo esc_url($coach['video_url']['url']); ?>" type="video/mp4">
                                        </video>
                                        <div class="video-controls">
                                            <button class="mute-toggle" aria-label="Toggle sound">🔇</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="pink-circle"></div>
                            <?php endif; ?>
                        </div>

                        <!-- Card 3: Description & Style -->
                        <div class="block card-3 white" style="<?php echo !empty($coach['card_3_bg_color']) ? 'background-color: ' . esc_attr($coach['card_3_bg_color']) . ' !important;' : ''; ?>">
                            <div class="description"><?php echo wp_kses_post($coach['coach_description']); ?></div>
                            <div class="coaching-style"><strong>Coaching Style:</strong> <?php echo esc_html($coach['coaching_style']); ?></div>
                            <div class="who-coached"><strong>Who he's coached:</strong> <?php echo esc_html($coach['who_coached']); ?></div>
                        </div>

                        <!-- Card 4: Focus Areas & Testimonial -->
                        <div class="block card-4 white" style="<?php echo !empty($coach['card_4_bg_color']) ? 'background-color: ' . esc_attr($coach['card_4_bg_color']) . ' !important;' : ''; ?>">
                            <div class="focus-areas">
                                <strong>Focus Areas:</strong>
                                <?php 
                                $areas = explode("\n", $coach['focus_areas']);
                                foreach($areas as $area): if(trim($area)): ?>
                                    <div>• <?php echo esc_html(trim($area)); ?></div>
                                <?php endif; endforeach; ?>
                            </div>
                            <div class="testimonial">
                                <em>"<?php echo esc_html($coach['testimonial']); ?>"</em>
                                <div>— <?php echo esc_html($coach['testimonial_author']); ?></div>
                            </div>
                            <div class="cta">[Want to Scale Smoothly? → <?php echo esc_html($coach['cta_text']); ?>]</div>
                        </div>
                    </div>

                <?php elseif ($index == 2): // Raashid - 2x2 Grey blocks ?>
                    <div class="coach-grid layout-3">
                        <!-- Card 1: Description -->
                        <div class="block card-1 grey" style="<?php echo !empty($coach['card_1_bg_color']) ? 'background-color: ' . esc_attr($coach['card_1_bg_color']) . ' !important;' : ''; ?>">
                            <div class="description"><?php echo wp_kses_post($coach['coach_description']); ?></div>
                            <div class="coaching-style"><strong>Coaching Style:</strong> <?php echo esc_html($coach['coaching_style']); ?></div>
                        </div>

                        <!-- Card 2: Focus Areas -->
                        <div class="block card-2 grey" style="<?php echo !empty($coach['card_2_bg_color']) ? 'background-color: ' . esc_attr($coach['card_2_bg_color']) . ' !important;' : ''; ?>">
                            <div class="who-coached"><strong>Who he's coached:</strong> <?php echo esc_html($coach['who_coached']); ?></div>
                            <div class="focus-areas">
                                <strong>Focus Areas:</strong>
                                <?php 
                                $areas = explode("\n", $coach['focus_areas']);
                                foreach($areas as $area): if(trim($area)): ?>
                                    <div>• <?php echo esc_html(trim($area)); ?></div>
                                <?php endif; endforeach; ?>
                            </div>
                        </div>

                        <!-- Card 3: Coach Info & Testimonial -->
                        <div class="block card-3 grey" style="<?php echo !empty($coach['card_3_bg_color']) ? 'background-color: ' . esc_attr($coach['card_3_bg_color']) . ' !important;' : ''; ?>">
                            <div class="tier-dot red"></div>
                            <h3 class="coach-name"><?php echo esc_html($coach['coach_name']); ?></h3>
                            <p class="coach-title"><?php echo esc_html($coach['coach_title']); ?> (<?php echo esc_html($coach['coach_tier']); ?>)</p>
                            <div class="ideal-for">
                                🔴 <strong>Ideal for:</strong> <?php echo esc_html($coach['ideal_for']); ?>
                            </div>
                            <div class="testimonial">
                                <em>"<?php echo esc_html($coach['testimonial']); ?>"</em>
                                <div>— <?php echo esc_html($coach['testimonial_author']); ?></div>
                            </div>
                            <div class="cta">[Looking for Strategic Coaching? → <?php echo esc_html($coach['cta_text']); ?>]</div>
                        </div>

                        <!-- Card 4: Media -->
                        <div class="block card-4 grey media-card" style="<?php echo !empty($coach['card_4_bg_color']) ? 'background-color: ' . esc_attr($coach['card_4_bg_color']) . ' !important;' : ''; ?>">
                            <?php if (!empty($coach['cover_image']['url'])): ?>
                                <div class="media-content">
                                    <img src="<?php echo esc_url($coach['cover_image']['url']); ?>" alt="<?php echo esc_attr($coach['coach_name']); ?>" class="cover-image">
                                    <?php if (!empty($coach['video_url']['url'])): ?>
                                        <video class="coach-video" muted loop playsinline preload="metadata">
                                            <source src="<?php echo esc_url($coach['video_url']['url']); ?>" type="video/mp4">
                                        </video>
                                        <div class="video-controls">
                                            <button class="mute-toggle" aria-label="Toggle sound">🔇</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="pink-circle"></div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>
            </div>
        </div>

        <style>
        .coaches-section {
            padding: 60px 20px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            min-height: 1500px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .coaches-container {
            position: relative;
            width: 1000px;
            height: 1425px;
        }

        .coach-grid {
            position: absolute;
            gap: 0;
        }

        /* Layout 1 - Radhika: 2x2 grey blocks (top-left) */
        .layout-1 {
            display: grid;
            grid-template-columns: 250px 250px;
            grid-template-rows: 300px 300px;
            top: 0;
            left: 0;
        }

        /* Layout 2 - Malay: 1x4 horizontal white blocks (below Radhika, left-aligned) */
        .layout-2 {
            display: grid;
            grid-template-columns: 250px 250px 250px 250px;
            grid-template-rows: 300px;
            top: 625px;  
            left: 0;     
        }

        /* Layout 3 - Raashid: 2x2 grey blocks (below Malay, right-aligned) */
        .layout-3 {
            display: grid;
            grid-template-columns: 250px 250px;
            grid-template-rows: 300px 300px;
            top: 950px;  
            left: 500px; 
        }

        .block {
            border: 1px solid #000;
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .block:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .block.grey {
            background: #e5e5e5;
        }

        .block.white {
            background: #ffffff;
        }

        /* Media cards styling */
        .media-card {
            padding: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .pink-circle {
            width: 100px;
            height: 100px;
            background: #ff1493;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.3);
        }

        .media-content {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .cover-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: opacity 0.3s ease;
        }

        .coach-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .video-controls {
            position: absolute;
            bottom: 10px;
            right: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 10;
        }

        .mute-toggle {
            background: rgba(0,0,0,0.7);
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            color: white;
            cursor: pointer;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tier-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .tier-dot.green { background: #10B981; }
        .tier-dot.orange { background: #F59E0B; }
        .tier-dot.red { background: #EF4444; }

        .coach-name {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 8px 0;
            line-height: 1.2;
            color: #1a1a1a;
        }

        .coach-title {
            font-size: 14px;
            color: #666;
            margin: 0 0 12px 0;
            line-height: 1.3;
        }

        .ideal-for {
            font-size: 14px;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .description {
            font-size: 14px;
            line-height: 1.4;
            margin-bottom: 8px;
            color: #333;
        }

        .coaching-style, .who-coached {
            font-size: 14px;
            line-height: 1.3;
            margin-bottom: 8px;
            color: #444;
        }

        .focus-areas {
            font-size: 14px;
            line-height: 1.3;
            margin-bottom: 8px;
        }

        .focus-areas strong {
            display: block;
            margin-bottom: 4px;
            color: #333;
        }

        .testimonial {
            font-size: 14px;
            line-height: 1.3;
            margin-bottom: 8px;
            font-style: italic;
            color: #555;
        }

        .cta {
            font-size: 12px;
            color: #0066cc;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .coaches-section {
                padding: 20px 10px;
                min-height: auto;
            }
            
            .coaches-container {
                position: static;
                width: 100%;
                height: auto;
            }
            
            .coach-grid {
                position: static !important;
                margin: 0 auto 40px auto;
                max-width: 100%;
            }
            
            .layout-1 {
                grid-template-columns: 184px 184px;
                grid-template-rows: 230px 230px;
            }
            
            .layout-2 {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: 184px 184px;
            }
            
            .layout-3 {
                grid-template-columns: 184px 184px;
                grid-template-rows: 184px 184px;
            }
            
            .block {
                padding: 14px;
            }

            .coach-name {
                font-size: 16px;
            }

            .coach-title {
                font-size: 12px;
            }

            .description, .coaching-style, .who-coached, .ideal-for {
                font-size: 10px;
            }

            .focus-areas, .testimonial {
                font-size: 9px;
            }

            .cta {
                font-size: 8px;
            }

            .pink-circle {
                width: 58px;
                height: 58px;
            }
        }
        </style>

        <script>
        (function() {
            'use strict';
            
            console.log('=== Coaches Video Script Loading ===');
            
            function initializeVideos() {
                const mediaCards = document.querySelectorAll(".coaches-section .media-card");
                console.log('Total media cards found:', mediaCards.length);

                if (mediaCards.length === 0) {
                    console.warn('No media cards found! Check if HTML is rendered correctly.');
                    return;
                }

                mediaCards.forEach(function(card, index) {
                    const video = card.querySelector(".coach-video");
                    const coverImage = card.querySelector(".cover-image");
                    const muteBtn = card.querySelector(".mute-toggle");
                    const videoControls = card.querySelector(".video-controls");
                    const mediaContent = card.querySelector(".media-content");

                    console.log('Card ' + index + ':', {
                        hasVideo: !!video,
                        hasCover: !!coverImage,
                        hasButton: !!muteBtn,
                        hasControls: !!videoControls
                    });

                    if (!video) {
                        console.log('Card ' + index + ' has no video element');
                        return;
                    }

                    // Set video attributes
                    video.muted = true;
                    video.loop = true;
                    video.setAttribute('playsinline', '');
                    video.setAttribute('webkit-playsinline', '');
                    
                    console.log('Video ' + index + ' initialized. Source:', video.querySelector('source')?.src);

                    // Hover enter - show video
                    card.addEventListener("mouseenter", function() {
                        console.log('>>> MOUSEENTER on card', index);
                        
                        // Update visual states
                        if (video) {
                            video.style.opacity = "1";
                            video.style.pointerEvents = "auto";
                        }
                        if (coverImage) {
                            coverImage.style.opacity = "0";
                        }
                        if (videoControls) {
                            videoControls.style.opacity = "1";
                        }

                        // Attempt to play
                        var playPromise = video.play();
                        
                        if (playPromise !== undefined) {
                            playPromise
                                .then(function() {
                                    console.log('✓ Video ' + index + ' playing successfully');
                                })
                                .catch(function(error) {
                                    console.error('✗ Video ' + index + ' play failed:', error.name, error.message);
                                });
                        }
                    });

                    // Hover leave - hide video
                    card.addEventListener("mouseleave", function() {
                        console.log('<<< MOUSELEAVE on card', index);
                        
                        // Update visual states
                        if (video) {
                            video.style.opacity = "0";
                            video.style.pointerEvents = "none";
                            video.pause();
                            video.currentTime = 0;
                        }
                        if (coverImage) {
                            coverImage.style.opacity = "1";
                        }
                        if (videoControls) {
                            videoControls.style.opacity = "0";
                        }
                        
                        console.log('Video ' + index + ' paused and reset');
                    });

                    // Mute toggle
                    if (muteBtn) {
                        muteBtn.addEventListener("click", function(e) {
                            e.stopPropagation();
                            e.preventDefault();
                            
                            video.muted = !video.muted;
                            muteBtn.textContent = video.muted ? "🔇" : "🔊";
                            
                            console.log('Video ' + index + ' muted state:', video.muted);
                        });
                    }

                    // Test if video can load
                    video.addEventListener('loadedmetadata', function() {
                        console.log('Video ' + index + ' metadata loaded. Duration:', video.duration);
                    });

                    video.addEventListener('error', function(e) {
                        console.error('Video ' + index + ' error:', e);
                    });
                });
            }

            // Initialize when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initializeVideos);
            } else {
                // DOM already loaded
                initializeVideos();
            }
            
            // Fallback: try again after a short delay
            setTimeout(function() {
                if (document.querySelectorAll(".coaches-section .media-card").length > 0) {
                    console.log('Fallback initialization running...');
                    initializeVideos();
                }
            }, 1000);
        })();
        </script>

        <?php
    }
}