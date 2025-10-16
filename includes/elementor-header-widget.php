<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Ensure Elementor is loaded
if (!class_exists('\Elementor\Widget_Base')) {
    return;
}

class Custom_Header_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'custom_header';
    }

    public function get_title() {
        return __('Custom Header', 'textdomain');
    }

    public function get_icon() {
        return 'eicon-header';
    }

    public function get_categories() {
        return ['basic'];
    }

    public function get_keywords() {
        return ['header', 'navigation', 'menu', 'nav', 'sticky'];
    }

    protected function register_controls() {
        
        // Logo Section
        $this->start_controls_section(
            'logo_section',
            [
                'label' => __('Logo', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'logo_type',
            [
                'label' => __('Logo Type', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'image' => __('Image', 'textdomain'),
                    'text' => __('Text', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'logo_image',
            [
                'label' => __('Logo Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'logo_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'logo_text',
            [
                'label' => __('Logo Text', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'jigsawthinking',
                'condition' => [
                    'logo_type' => 'text',
                ],
                'placeholder' => __('Enter your logo text', 'textdomain'),
            ]
        );

        $this->add_control(
            'logo_link',
            [
                'label' => __('Logo Link', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => home_url('/'),
                ],
                'placeholder' => __('https://your-domain.com', 'textdomain'),
            ]
        );

        $this->end_controls_section();

        // Navigation Section
        $this->start_controls_section(
            'navigation_section',
            [
                'label' => __('Navigation', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'menu_text',
            [
                'label' => __('Menu Text', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Menu Item', 'textdomain'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_link',
            [
                'label' => __('Link', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __('https://your-domain.com', 'textdomain'),
            ]
        );

        $this->add_control(
            'menu_items',
            [
                'label' => __('Menu Items', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'menu_text' => 'HOMEPAGE',
                        'menu_link' => ['url' => home_url('/')],
                    ],
                    [
                        'menu_text' => 'ABOUT US',
                        'menu_link' => ['url' => '#about'],
                    ],
                    [
                        'menu_text' => 'COACHES',
                        'menu_link' => ['url' => '#coaches'],
                    ],
                    [
                        'menu_text' => 'BUSINESS COACHING',
                        'menu_link' => ['url' => '#coaching'],
                    ],
                    [
                        'menu_text' => 'BLOGS',
                        'menu_link' => ['url' => '#blogs'],
                    ],
                ],
                'title_field' => '{{{ menu_text }}}',
            ]
        );

        $this->end_controls_section();

        // Header Behavior Section
        $this->start_controls_section(
            'behavior_section',
            [
                'label' => __('Header Behavior', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sticky_header',
            [
                'label' => __('Sticky Header', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'textdomain'),
                'label_off' => __('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Header will hide on scroll down and appear on scroll up', 'textdomain'),
            ]
        );

        $this->add_control(
            'scroll_threshold',
            [
                'label' => __('Scroll Threshold (px)', 'textdomain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 20,
                'min' => 0,
                'max' => 200,
                'step' => 5,
                'description' => __('Header always visible below this scroll amount', 'textdomain'),
                'condition' => [
                    'sticky_header' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adaptive_colors',
            [
                'label' => __('Adaptive Colors', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'textdomain'),
                'label_off' => __('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Automatically change header colors based on background sections', 'textdomain'),
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Header Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'header_padding',
            [
                'label' => __('Header Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '0',
                    'right' => '40',
                    'bottom' => '0',
                    'left' => '40',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'logo_size',
            [
                'label' => __('Logo Size', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 80,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-logo img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .header-logo .logo-text' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'nav_font_size',
            [
                'label' => __('Navigation Font Size', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 12,
                        'max' => 24,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 14,
                ],
                'selectors' => [
                    '{{WRAPPER}} .nav-link' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'nav_spacing',
            [
                'label' => __('Navigation Item Spacing', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 60,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .nav-menu' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Color Section
        $this->start_controls_section(
            'color_section',
            [
                'label' => __('Colors', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'light_bg_color',
            [
                'label' => __('Light Theme Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(255, 255, 255, 0.95)',
                'description' => __('Background when over light sections', 'textdomain'),
            ]
        );

        $this->add_control(
            'dark_bg_color',
            [
                'label' => __('Dark Theme Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.95)',
                'description' => __('Background when over dark sections', 'textdomain'),
            ]
        );

        $this->add_control(
            'light_text_color',
            [
                'label' => __('Light Theme Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );

        $this->add_control(
            'dark_text_color',
            [
                'label' => __('Dark Theme Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if (empty($settings['menu_items'])) {
            return;
        }

        // Build classes
        $header_classes = ['custom-header'];
        if ($settings['sticky_header'] === 'yes') {
            $header_classes[] = 'sticky-header';
        }
        if ($settings['adaptive_colors'] === 'yes') {
            $header_classes[] = 'adaptive-colors';
        }
        
        $header_class_string = implode(' ', $header_classes);
        $scroll_threshold = isset($settings['scroll_threshold']) ? $settings['scroll_threshold'] : 20;
        
        // Add inline CSS - removed conflicting animation
        echo '<style>
        /* Header Styles with Fixed Top Spacing */
        .custom-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 9999 !important;
            background: transparent !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            border-bottom: none !important;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            transform: translateY(0) !important;
            height: auto !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .header-container {
            max-width: 100% !important;
            margin: 0 !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: flex-start !important;
            height: auto !important;
            padding: 0 40px !important;
            box-sizing: border-box !important;
            position: relative !important;
            gap: 30px !important;
        }
        
        .header-logo {
            flex-shrink: 0 !important;
            background: #000 !important;
            padding: 18px 20px !important;
            border-radius: 0 0 8px 8px !important;
            border: none !important;
            transform: translateY(0) !important;
            width: auto !important;
            margin-top: 0 !important;
            transition: all 0.3s ease !important;
        }
        
        .header-logo a {
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.3s ease !important;
        }
        
        .header-logo a:hover {
            transform: scale(1.05) !important;
        }
        
        .header-logo img {
            height: 40px !important;
            width: auto !important;
            display: block !important;
        }
        
        .header-logo .logo-text {
            font-size: 40px !important;
            font-weight: 700 !important;
            color: #fff !important;
            letter-spacing: -0.02em !important;
            transition: color 0.3s ease !important;
        }
        
        .header-navigation {
            flex-shrink: 0 !important;
            display: flex !important;
            justify-content: flex-end !important;
            align-items: center !important;
            background: #000 !important;
            padding: 18px 30px !important;
            border-radius: 0 0 8px 8px !important;
            margin-left: 0 !important;
            border: none !important;
            transform: translateY(0) !important;
            width: auto !important;
            margin-top: 0 !important;
            transition: all 0.3s ease !important;
        }
        
        .nav-menu {
            list-style: none !important;
            margin: 0 !important;
            padding: 0 !important;
            display: flex !important;
            align-items: center !important;
            gap: 30px !important;
            justify-content: flex-end !important;
        }
        
        .nav-item {
            margin: 0 !important;
        }
        
        .nav-link {
            text-decoration: none !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            color: #fff !important;
            letter-spacing: 0.5px !important;
            text-transform: uppercase !important;
            padding: 10px 0 !important;
            border-radius: 0 !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            border-bottom: 2px solid transparent !important;
            white-space: nowrap !important;
            outline: none !important;
            border: none !important;
            box-shadow: none !important;
        }
        
        .nav-link:hover {
            background: transparent !important;
            transform: none !important;
            border-bottom: 2px solid #fff !important;
            outline: none !important;
            box-shadow: none !important;
        }
        
        .nav-link:focus {
            outline: none !important;
            border-bottom: 2px solid #fff !important;
            box-shadow: none !important;
        }
        
        .nav-link:active {
            outline: none !important;
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }
        
        .mobile-menu-toggle {
            display: none !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            width: 24px !important;
            height: 18px !important;
            cursor: pointer !important;
            margin-left: 20px !important;
        }
        
        .mobile-menu-toggle span {
            display: block !important;
            height: 2px !important;
            width: 100% !important;
            background-color: #fff !important;
            border-radius: 1px !important;
            transition: all 0.3s ease !important;
        }
        
        .mobile-menu-toggle.active span:nth-child(1) {
            transform: translateY(8px) rotate(45deg) !important;
        }
        
        .mobile-menu-toggle.active span:nth-child(2) {
            opacity: 0 !important;
        }
        
        .mobile-menu-toggle.active span:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg) !important;
        }
        
        /* Dark theme */
        .custom-header.dark-theme {
            background: rgba(0, 0, 0, 0.95) !important;
            color: #fff !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        
        .custom-header.dark-theme .nav-link,
        .custom-header.dark-theme .logo-text {
            color: #fff !important;
        }
        
        .custom-header.dark-theme .mobile-menu-toggle span {
            background-color: #fff !important;
        }
        
        .custom-header.dark-theme .nav-link:hover {
            background: rgba(255, 255, 255, 0.1) !important;
        }
        
        /* Header hide/show animations */
        .custom-header.header-hidden {
            transform: translateY(-100%) !important;
        }
        
        .custom-header.header-visible {
            transform: translateY(0) !important;
        }
        
        /* Responsive styles */
        @media (max-width: 1200px) {
            .header-container {
                padding: 0 30px !important;
                gap: 25px !important;
            }
            
            .header-navigation {
                padding: 20px 25px 18px 25px !important;
            }
            
            .nav-menu {
                gap: 25px !important;
            }
            
            .nav-link {
                font-size: 13px !important;
            }
        }
        
        @media (max-width: 1024px) {
            .header-container {
                padding: 0 25px !important;
                gap: 20px !important;
            }
            
            .header-navigation {
                padding: 20px 20px 18px 20px !important;
            }
            
            .nav-menu {
                gap: 20px !important;
            }
            
            .nav-link {
                font-size: 12px !important;
                padding: 6px 0 !important;
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                padding: 0 20px !important;
                gap: 15px !important;
            }
            
            .header-navigation {
                padding: 20px 15px 18px 15px !important;
            }
            
            .mobile-menu-toggle {
                display: flex !important;
            }
            
            .nav-menu {
                position: fixed !important;
                top: 80px !important;
                left: 0 !important;
                right: 0 !important;
                background: #000 !important;
                backdrop-filter: inherit !important;
                -webkit-backdrop-filter: inherit !important;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1) !important;
                flex-direction: column !important;
                gap: 0 !important;
                padding: 20px 0 !important;
                transform: translateY(-100%) !important;
                opacity: 0 !important;
                visibility: hidden !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                max-height: calc(100vh - 80px) !important;
                overflow-y: auto !important;
            }
            
            .custom-header.dark-theme .nav-menu {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            }
            
            .nav-menu.active {
                transform: translateY(0) !important;
                opacity: 1 !important;
                visibility: visible !important;
            }
            
            .nav-item {
                width: 100% !important;
            }
            
            .nav-link {
                display: block !important;
                width: 100% !important;
                text-align: center !important;
                padding: 15px 20px !important;
                border-radius: 0 !important;
                font-size: 14px !important;
            }
            
            .nav-link:hover {
                background: rgba(255, 255, 255, 0.1) !important;
                transform: none !important;
                border-bottom: none !important;
            }
        }
        
        @media (max-width: 480px) {
            .header-container {
                padding: 0 15px !important;
            }
            
            .header-logo img {
                height: 32px !important;
            }
            
            .header-logo .logo-text {
                font-size: 24px !important;
            }
            
            .mobile-menu-toggle {
                width: 20px !important;
                height: 15px !important;
            }
        }
        
        /* Body padding to prevent content hiding behind header */
        body:not(.elementor-editor-active) {
            padding-top: 0 !important;
        }
        
        /* Admin bar adjustments */
        .admin-bar .custom-header {
            top: 32px !important;
        }
        
        @media screen and (max-width: 782px) {
            .admin-bar .custom-header {
                top: 46px !important;
            }
        }
        
        /* Force no margin/padding on body and html */
        html, body {
            margin: 0 !important;
            padding: 0 !important;
        }
        
        /* Ensure no spacing from any parent elements */
        .elementor-location-header {
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .elementor-section {
            margin: 0 !important;
        }
        </style>';
        ?>
        
        <header class="<?php echo esc_attr($header_class_string); ?>" 
                data-adaptive="<?php echo esc_attr($settings['adaptive_colors']); ?>"
                data-scroll-threshold="<?php echo esc_attr($scroll_threshold); ?>">
            <div class="header-container">
                <!-- Logo Section -->
                <div class="header-logo">
                    <?php if (!empty($settings['logo_link']['url'])) : ?>
                        <a href="<?php echo esc_url($settings['logo_link']['url']); ?>" 
                           <?php echo $settings['logo_link']['is_external'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                    <?php endif; ?>
                    
                    <?php if ($settings['logo_type'] === 'image' && !empty($settings['logo_image']['url'])) : ?>
                        <img src="<?php echo esc_url($settings['logo_image']['url']); ?>" 
                             alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                    <?php elseif ($settings['logo_type'] === 'text') : ?>
                        <span class="logo-text"><?php echo esc_html($settings['logo_text']); ?></span>
                    <?php endif; ?>
                    
                    <?php if (!empty($settings['logo_link']['url'])) : ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Navigation Section -->
                <nav class="header-navigation">
                    <ul class="nav-menu">
                        <?php foreach ($settings['menu_items'] as $item) : ?>
                            <li class="nav-item">
                                <a href="<?php echo esc_url($item['menu_link']['url']); ?>" 
                                   class="nav-link"
                                   <?php echo $item['menu_link']['is_external'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                    <?php echo esc_html($item['menu_text']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <!-- Mobile Menu Toggle -->
                    <div class="mobile-menu-toggle" 
                         aria-label="Toggle navigation menu" 
                         role="button" 
                         tabindex="0">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </nav>
            </div>
        </header>
        
        <!-- Integrated JavaScript -->
        <script>
        (function($){
            $(document).ready(function(){
                var lastScroll = 0;
                var $header = $('.custom-header');
                var scrollThreshold = parseInt($header.data('scroll-threshold')) || 20;
                
                $(window).on('scroll', function(){
                    var currentScroll = $(this).scrollTop();
                    
                    if (currentScroll < scrollThreshold) {
                        // Always show header at the top
                        $header.removeClass('header-hidden').addClass('header-visible');
                        lastScroll = currentScroll;
                        return;
                    }
                    
                    if (currentScroll > lastScroll) {
                        // Scrolling down → hide header
                        $header.removeClass('header-visible').addClass('header-hidden');
                    } else {
                        // Scrolling up → show header
                        $header.removeClass('header-hidden').addClass('header-visible');
                    }
                    
                    lastScroll = currentScroll;
                });
                
                // Mobile menu toggle
                $('.mobile-menu-toggle').on('click', function(){
                    $(this).toggleClass('active');
                    $('.nav-menu').toggleClass('active');
                });
                
                console.log('Custom header scroll functionality loaded');
            });
        })(jQuery);
        </script>
        
        <?php
    }

    protected function content_template() {
        ?>
        <#
        var headerClasses = ['custom-header'];
        if (settings.sticky_header === 'yes') {
            headerClasses.push('sticky-header');
        }
        if (settings.adaptive_colors === 'yes') {
            headerClasses.push('adaptive-colors');
        }
        
        var logoLink = settings.logo_link.url || home_url('/');
        var scrollThreshold = settings.scroll_threshold || 20;
        #>
        
        <header class="{{{ headerClasses.join(' ') }}}" 
                data-adaptive="{{{ settings.adaptive_colors }}}"
                data-scroll-threshold="{{{ scrollThreshold }}}">
            <div class="header-container">
                <!-- Logo Section -->
                <div class="header-logo">
                    <a href="{{{ logoLink }}}">
                        <# if (settings.logo_type === 'image' && settings.logo_image.url) { #>
                            <img src="{{{ settings.logo_image.url }}}" alt="Logo" />
                        <# } else if (settings.logo_type === 'text') { #>
                            <span class="logo-text">{{{ settings.logo_text }}}</span>
                        <# } #>
                    </a>
                </div>

                <!-- Navigation Section -->
                <nav class="header-navigation">
                    <ul class="nav-menu">
                        <# _.each(settings.menu_items, function(item) { #>
                            <li class="nav-item">
                                <a href="{{{ item.menu_link.url }}}" class="nav-link">
                                    {{{ item.menu_text }}}
                                </a>
                            </li>
                        <# }); #>
                    </ul>
                    
                    <!-- Mobile Menu Toggle -->
                    <div class="mobile-menu-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </nav>
            </div>
        </header>
        <?php
    }
}

// Register the widget
function register_custom_header_widget() {
    if (class_exists('\Elementor\Plugin')) {
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Custom_Header_Widget());
    }
}

add_action('elementor/widgets/widgets_registered', 'register_custom_header_widget');

// For newer Elementor versions
if (method_exists('\Elementor\Plugin', 'instance')) {
    add_action('elementor/widgets/register', function($widgets_manager) {
        if (class_exists('Custom_Header_Widget')) {
            $widgets_manager->register(new \Custom_Header_Widget());
        }
    });
}