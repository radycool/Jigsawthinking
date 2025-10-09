<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Footer_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'footer_widget';
    }

    public function get_title() {
        return __( 'Footer Widget', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-footer';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return ['footer', 'designer hub', 'newsletter', 'social'];
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
            'logo_text',
            [
                'label' => __('Logo Text', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Designer Hub', 'textdomain'),
                'placeholder' => __('Type your logo text here', 'textdomain'),
            ]
        );

        $this->add_control(
            'tagline',
            [
                'label' => __('Tagline', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Learn from top-notch design educators', 'textdomain'),
                'placeholder' => __('Type your tagline here', 'textdomain'),
            ]
        );

        $this->add_control(
            'newsletter_title',
            [
                'label' => __('Newsletter Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Join our mailing list', 'textdomain'),
            ]
        );

        $this->add_control(
            'newsletter_description',
            [
                'label' => __('Newsletter Description', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Get notified about new posts as soon as they are posted', 'textdomain'),
            ]
        );

        $this->add_control(
            'company_name',
            [
                'label' => __('Company Name', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Mandro Design', 'textdomain'),
            ]
        );

        $this->add_control(
            'copyright_year',
            [
                'label' => __('Copyright Year', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('2024', 'textdomain'),
            ]
        );

        $this->end_controls_section();

        // Pages Section
        $this->start_controls_section(
            'pages_section',
            [
                'label' => __('Template Pages', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'pages_title',
            [
                'label' => __('Pages Section Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Template Pages', 'textdomain'),
            ]
        );

        $this->add_control(
            'pages_list',
            [
                'label' => __('Pages', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __("Home\nAbout\nPortfolio\nContact\nFAQ", 'textdomain'),
                'placeholder' => __('Enter each page on a new line', 'textdomain'),
                'description' => __('Enter each page on a new line. Format: Page Name|URL (optional)', 'textdomain'),
            ]
        );

        $this->end_controls_section();

        // Social Section
        $this->start_controls_section(
            'social_section',
            [
                'label' => __('Social Links', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'social_title',
            [
                'label' => __('Social Section Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Social', 'textdomain'),
            ]
        );

        $this->add_control(
            'social_list',
            [
                'label' => __('Social Links', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __("Twitter (X)|https://twitter.com\nInstagram|https://instagram.com\nYoutube|https://youtube.com\nFramer|https://framer.com", 'textdomain'),
                'placeholder' => __('Enter each social link on a new line', 'textdomain'),
                'description' => __('Enter each social link on a new line. Format: Platform Name|URL', 'textdomain'),
            ]
        );

        $this->end_controls_section();

        // Legal Section
        $this->start_controls_section(
            'legal_section',
            [
                'label' => __('Legal Links', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'terms_url',
            [
                'label' => __('Terms & Conditions URL', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-site.com/terms', 'textdomain'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'privacy_url',
            [
                'label' => __('Privacy Policy URL', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-site.com/privacy', 'textdomain'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
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
                'default' => '#1a1a1a',
                'selectors' => [
                    '{{WRAPPER}} .designer-hub-footer' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .designer-hub-footer' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'accent_color',
            [
                'label' => __('Accent Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff4500',
                'selectors' => [
                    '{{WRAPPER}} .footer-logo::before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .subscribe-btn' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .nav-section .explore-link' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .creator-link' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="designer-hub-footer">
            <div class="footer-container">
                <div class="footer-content">
                    <!-- Brand Section -->
                    <div class="footer-brand">
                        <div class="footer-logo"><?php echo esc_html($settings['logo_text']); ?></div>
                        <p class="footer-tagline"><?php echo esc_html($settings['tagline']); ?></p>
                        <button class="follow-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                            Follow
                        </button>
                    </div>

                    <!-- Template Pages Section -->
                    <div class="nav-section">
                        <h4 class="nav-title"><?php echo esc_html($settings['pages_title']); ?></h4>
                        <ul class="nav-links">
                            <?php
                            $pages = explode("\n", $settings['pages_list']);
                            foreach ($pages as $page) {
                                $page = trim($page);
                                if (!empty($page)) {
                                    $page_parts = explode('|', $page);
                                    $page_text = trim($page_parts[0]);
                                    $page_url = isset($page_parts[1]) ? trim($page_parts[1]) : '#';
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url($page_url); ?>">
                                            <?php echo esc_html($page_text); ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Social Section -->
                    <div class="nav-section">
                        <h4 class="nav-title"><?php echo esc_html($settings['social_title']); ?></h4>
                        <ul class="nav-links">
                            <?php
                            $socials = explode("\n", $settings['social_list']);
                            foreach ($socials as $social) {
                                $social = trim($social);
                                if (!empty($social)) {
                                    $social_parts = explode('|', $social);
                                    $social_text = trim($social_parts[0]);
                                    $social_url = isset($social_parts[1]) ? trim($social_parts[1]) : '#';
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url($social_url); ?>" target="_blank" rel="noopener">
                                            <?php echo esc_html($social_text); ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Newsletter Section -->
                    <div class="footer-newsletter">
                        <h3 class="newsletter-title"><?php echo esc_html($settings['newsletter_title']); ?></h3>
                        <p class="newsletter-description"><?php echo esc_html($settings['newsletter_description']); ?></p>
                        <form class="newsletter-form" id="designerHubNewsletter">
                            <div class="form-group">
                                <input type="email" class="email-input" placeholder="Enter Your Email..." required>
                                <button type="submit" class="subscribe-btn">Subscribe Us</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <div class="footer-bottom-content">
                        <p class="copyright">© <?php echo esc_html($settings['copyright_year']); ?> <?php echo esc_html($settings['company_name']); ?></p>
                        
                        <div class="legal-links">
                            <?php if (!empty($settings['terms_url']['url'])) : ?>
                                <a href="<?php echo esc_url($settings['terms_url']['url']); ?>" 
                                   class="legal-link"
                                   <?php echo $settings['terms_url']['is_external'] ? 'target="_blank"' : ''; ?>
                                   <?php echo $settings['terms_url']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                                    Terms & Conditions
                                </a>
                            <?php endif; ?>
                            
                            <?php if (!empty($settings['privacy_url']['url'])) : ?>
                                <a href="<?php echo esc_url($settings['privacy_url']['url']); ?>" 
                                   class="legal-link"
                                   <?php echo $settings['privacy_url']['is_external'] ? 'target="_blank"' : ''; ?>
                                   <?php echo $settings['privacy_url']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                                    Privacy Policy
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="framer-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M4 1h16l-8 7.5z"/>
                                <path d="M4 9h8v6z"/>
                                <path d="M12 9h8L12 22.5z"/>
                            </svg>
                            Made in Framer
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
        .designer-hub-footer {
            background-color: #1a1a1a;
            color: #ffffff;
            padding: 60px 0 20px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1.2fr;
            gap: 60px;
            margin-bottom: 60px;
        }

        .footer-brand {
            max-width: 280px;
        }

        .footer-logo {
            position: relative;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 12px;
            padding-left: 24px;
        }

        .footer-logo::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            background-color: #ff4500;
            border-radius: 2px;
        }

        .footer-tagline {
            color: #999;
            font-size: 14px;
            line-height: 1.4;
            margin-bottom: 24px;
        }

        .follow-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            border: 1px solid #333;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .follow-btn:hover {
            border-color: #555;
            background-color: #222;
        }

        .footer-nav {
            display: flex;
            gap: 60px;
        }

        .nav-section {
            min-width: 140px;
        }

        .nav-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-links li {
            margin-bottom: 12px;
        }

        .nav-links a {
            color: #999;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s ease;
        }

        .nav-links a:hover {
            color: #ffffff;
        }

        .nav-links .explore-link {
            color: #ff4500 !important;
        }

        .footer-newsletter {
            max-width: 300px;
        }

        .newsletter-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #ffffff;
        }

        .newsletter-description {
            color: #999;
            font-size: 14px;
            line-height: 1.4;
            margin-bottom: 24px;
        }

        .newsletter-form {
            position: relative;
        }

        .form-group {
            display: flex;
            background: #2a2a2a;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #333;
            transition: border-color 0.2s ease;
        }

        .form-group:focus-within {
            border-color: #ff4500;
        }

        .email-input {
            flex: 1;
            background: transparent;
            border: none;
            padding: 12px 16px;
            color: #ffffff;
            font-size: 14px;
            outline: none;
        }

        .email-input::placeholder {
            color: #666;
        }

        .subscribe-btn {
            background-color: #ff4500;
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .subscribe-btn:hover {
            background-color: #e63e00;
        }

        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 20px;
        }

        .footer-bottom-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .copyright {
            font-size: 12px;
            color: #999;
            margin: 0;
        }

        .legal-links {
            display: flex;
            gap: 20px;
        }

        .legal-link {
            font-size: 12px;
            color: #999;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .legal-link:hover {
            color: #ffffff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .footer-nav {
                flex-direction: column;
                gap: 30px;
            }

            .footer-bottom-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .footer-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .designer-hub-footer {
                padding: 40px 0 20px;
            }

            .footer-container {
                padding: 0 15px;
            }

            .form-group {
                flex-direction: column;
            }

            .subscribe-btn {
                border-radius: 0 0 6px 6px;
            }
        }
        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const newsletterForm = document.getElementById('designerHubNewsletter');
            
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const emailInput = this.querySelector('.email-input');
                    const subscribeBtn = this.querySelector('.subscribe-btn');
                    const email = emailInput.value.trim();
                    
                    if (!email) {
                        alert('Please enter your email address.');
                        return;
                    }
                    
                    // Email validation
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email)) {
                        alert('Please enter a valid email address.');
                        return;
                    }
                    
                    // Show loading state
                    const originalText = subscribeBtn.textContent;
                    subscribeBtn.textContent = 'Subscribing...';
                    subscribeBtn.disabled = true;
                    
                    // AJAX call to your backend endpoint
                    fetch(ajax_object?.ajax_url || '/wp-admin/admin-ajax.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            action: 'designer_hub_newsletter_subscribe',
                            email: email,
                            nonce: ajax_object?.nonce || ''
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            emailInput.value = '';
                            subscribeBtn.textContent = 'Subscribed!';
                            subscribeBtn.style.backgroundColor = '#28a745';
                            
                            setTimeout(() => {
                                subscribeBtn.textContent = originalText;
                                subscribeBtn.style.backgroundColor = '';
                                subscribeBtn.disabled = false;
                            }, 3000);
                        } else {
                            throw new Error(data.data || 'Subscription failed');
                        }
                    })
                    .catch(error => {
                        console.error('Subscription error:', error);
                        alert('There was an error subscribing. Please try again.');
                        
                        subscribeBtn.textContent = originalText;
                        subscribeBtn.disabled = false;
                    });
                });
            }
        });
        </script>
        <?php
    }
}

// Register the widget
function register_elementor_footer_widget($widgets_manager) {
    $widgets_manager->register(new Elementor_Footer_Widget());
}
add_action('elementor/widgets/register', 'register_elementor_footer_widget');