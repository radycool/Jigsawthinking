<?php
class Elementor_Blog_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'blogs_widget';
    }

    public function get_title() {
        return __('Blogs Grid Widget', 'textdomain');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['blog', 'posts', 'grid', 'categories', 'filter'];
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
                'default' => __("The founder's", 'textdomain'),
                'placeholder' => __('Type section title here', 'textdomain'),
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => __('Section Description', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('We offer personalised online business coaching in India for founders who want clarity, systems, and a business that supports their life — not consumes it.', 'textdomain'),
                'placeholder' => __('Type section description here', 'textdomain'),
            ]
        );

        $this->add_control(
            'show_categories',
            [
                'label' => __('Show Category Pills', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'textdomain'),
                'label_off' => __('Hide', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'section_top_spacing',
            [
                'label' => __('Section Top Spacing', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blogs-widget' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_bottom_spacing',
            [
                'label' => __('Section Bottom Spacing', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blogs-widget' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cards_gap',
            [
                'label' => __('Gap Between Cards', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 2,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 32,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blogs-grid' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Blog Posts Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'blog_image',
            [
                'label' => __('Blog Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'blog_category',
            [
                'label' => __('Category', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'mindset',
                'options' => [
                    'mindset' => __('Mindset & Founder Psychology', 'textdomain'),
                    'offer-design' => __('Offer Design & Pricing', 'textdomain'),
                    'sales-clients' => __('Sales & Clients', 'textdomain'),
                    'systems-tools' => __('Systems & Tools', 'textdomain'),
                    'case-studies' => __('Case Studies & Founder Stories', 'textdomain'),
                    'coaching-101' => __('Business Coaching 101', 'textdomain'),
                ],
            ]
        );

        $repeater->add_control(
            'blog_title',
            [
                'label' => __('Blog Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('FOUNDER', 'textdomain'),
                'placeholder' => __('Type blog title here', 'textdomain'),
            ]
        );

        $repeater->add_control(
            'blog_description',
            [
                'label' => __('Blog Description', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Not consumes it.', 'textdomain'),
                'placeholder' => __('Type blog description here', 'textdomain'),
            ]
        );

        $repeater->add_control(
            'blog_link',
            [
                'label' => __('Blog Link', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'textdomain'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'blogs_list',
            [
                'label' => __('Blog Posts', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'blog_title' => __('FOUNDER', 'textdomain'),
                        'blog_description' => __('Not consumes it.', 'textdomain'),
                        'blog_category' => 'mindset',
                    ],
                    [
                        'blog_title' => __('FOUNDER', 'textdomain'),
                        'blog_description' => __('Not consumes it.', 'textdomain'),
                        'blog_category' => 'offer-design',
                    ],
                    [
                        'blog_title' => __('FOUNDER', 'textdomain'),
                        'blog_description' => __('Not consumes it.', 'textdomain'),
                        'blog_category' => 'sales-clients',
                    ],
                    [
                        'blog_title' => __('FOUNDER', 'textdomain'),
                        'blog_description' => __('Not consumes it.', 'textdomain'),
                        'blog_category' => 'systems-tools',
                    ],
                    [
                        'blog_title' => __('FOUNDER', 'textdomain'),
                        'blog_description' => __('Not consumes it.', 'textdomain'),
                        'blog_category' => 'case-studies',
                    ],
                    [
                        'blog_title' => __('FOUNDER', 'textdomain'),
                        'blog_description' => __('Not consumes it.', 'textdomain'),
                        'blog_category' => 'coaching-101',
                    ],
                ],
                'title_field' => '{{{ blog_title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section - Header
        $this->start_controls_section(
            'header_style_section',
            [
                'label' => __('Header Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'header_text_align',
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .blog-header' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .section-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a1a1a',
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Description Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .section-description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Description Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#6b7280',
                'selectors' => [
                    '{{WRAPPER}} .section-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Blog Cards
        $this->start_controls_section(
            'cards_style_section',
            [
                'label' => __('Blog Cards Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_title_typography',
                'label' => __('Card Title Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .blog-title',
            ]
        );

        $this->add_control(
            'card_title_color',
            [
                'label' => __('Card Title Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a1a1a',
                'selectors' => [
                    '{{WRAPPER}} .blog-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_description_typography',
                'label' => __('Card Description Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .blog-description',
            ]
        );

        $this->add_control(
            'card_description_color',
            [
                'label' => __('Card Description Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#6b7280',
                'selectors' => [
                    '{{WRAPPER}} .blog-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        /* Card Background Style Controls */
        $this->add_control(
            'card_bg_color',
            [
                'label' => __('Card Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .blog-card' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'card_padding',
            [
                'label' => __('Card Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .blog-card',
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label' => __('Card Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Category Pills
        $this->start_controls_section(
            'category_style_section',
            [
                'label' => __('Category Pills Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'category_bg_color',
            [
                'label' => __('Category Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f3f4f6',
                'selectors' => [
                    '{{WRAPPER}} .category-pill' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'category_text_color',
            [
                'label' => __('Category Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#374151',
                'selectors' => [
                    '{{WRAPPER}} .category-pill' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => __('Category Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .category-pill',
            ]
        );

        $this->end_controls_section();
    }

    private function get_category_names() {
        return [
            'mindset' => 'Mindset & Founder Psychology',
            'offer-design' => 'Offer Design & Pricing',
            'sales-clients' => 'Sales & Clients',
            'systems-tools' => 'Systems & Tools',
            'case-studies' => 'Case Studies & Founder Stories',
            'coaching-101' => 'Business Coaching 101',
        ];
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $category_names = $this->get_category_names();

        ?>
        <div class="blogs-widget">
            <div class="blog-header">
                <h2 class="section-title"><?php echo esc_html($settings['section_title']); ?></h2>
                <p class="section-description"><?php echo esc_html($settings['section_description']); ?></p>
            </div>

            <div class="blogs-grid">
                <?php if ($settings['blogs_list']): ?>
                    <?php foreach ($settings['blogs_list'] as $index => $blog): ?>
                        <?php 
                        $link_key = 'blog_link_' . $index;
                        $this->add_link_attributes($link_key, $blog['blog_link']);
                        ?>
                        <div class="blog-card" data-category="<?php echo esc_attr($blog['blog_category']); ?>">
                            <a <?php echo $this->get_render_attribute_string($link_key); ?> class="blog-card-link">
                                <?php if (!empty($blog['blog_image']['url'])): ?>
                                    <div class="blog-image">
                                        <img src="<?php echo esc_url($blog['blog_image']['url']); ?>" 
                                             alt="<?php echo esc_attr($blog['blog_title']); ?>"
                                             loading="lazy">
                                    </div>
                                <?php endif; ?>
                                <div class="blog-content">
                                    <div class="blog-header">
                                        <h3 class="blog-title"><?php echo esc_html($blog['blog_title']); ?></h3>
                                        <?php if ($settings['show_categories'] === 'yes'): ?>
                                            <div class="category-pill">
                                                <span><?php echo esc_html($category_names[$blog['blog_category']]); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <p class="blog-description"><?php echo esc_html($blog['blog_description']); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <style>
        .elementor-widget-blogs_widget .blogs-widget {
            width: 100%;
            padding: 60px 0;
        }

        .elementor-widget-blogs_widget .blog-header {
            margin-bottom: 48px;
        }

        .elementor-widget-blogs_widget .section-title {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1.2;
            color: #1a1a1a;
            margin: 0 0 16px 0;
            letter-spacing: -0.02em;
        }

        .elementor-widget-blogs_widget .section-description {
            font-size: 1.1rem;
            color: #6b7280;
            line-height: 1.6;
            margin: 16px 0 0 0;
            max-width: 100%;
        }

        .elementor-widget-blogs_widget .blogs-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
        }

        .elementor-widget-blogs_widget .blog-card {
            background: transparent;
            border-radius: 0;
            overflow: visible;
            transition: transform 0.3s ease;
        }

        .elementor-widget-blogs_widget .blog-card:hover {
            transform: translateY(-4px);
        }

        .elementor-widget-blogs_widget .blog-card-link {
            display: block;
            text-decoration: none;
            color: inherit;
        }

        .elementor-widget-blogs_widget .blog-image {
            width: 100%;
            height: 240px;
            overflow: hidden;
            background: #f3f4f6;
            border-radius: 0;
        }

        .elementor-widget-blogs_widget .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .elementor-widget-blogs_widget .blog-card:hover .blog-image img {
            transform: scale(1.05);
        }

        .elementor-widget-blogs_widget .blog-content {
            padding: 20px 0 0 0;
        }

        .elementor-widget-blogs_widget .blog-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .elementor-widget-blogs_widget .category-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            background-color: #f3f4f6;
            color: #374151;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-radius: 20px;
            margin: 0;
            flex-shrink: 0;
        }

        .elementor-widget-blogs_widget .blog-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            line-height: 1.3;
            flex: 1;
            padding-right: 16px;
        }

        .elementor-widget-blogs_widget .blog-description {
            font-size: 0.95rem;
            color: #6b7280;
            line-height: 1.5;
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .elementor-widget-blogs_widget .blogs-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
            }
            
            .elementor-widget-blogs_widget .section-title {
                font-size: 2.25rem;
            }
            
            .elementor-widget-blogs_widget .blog-image {
                height: 180px;
            }
            
            .elementor-widget-blogs_widget .blog-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .elementor-widget-blogs_widget .blog-title {
                padding-right: 0;
            }
        }

        @media (max-width: 480px) {
            .elementor-widget-blogs_widget .blogs-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }
            
            .elementor-widget-blogs_widget .section-title {
                font-size: 2rem;
            }
            
            .elementor-widget-blogs_widget .blog-image {
                height: 200px;
            }
            
            .elementor-widget-blogs_widget .blogs-widget {
                padding: 40px 0;
            }
        }
        </style>

        <script>
        jQuery(document).ready(function($) {
            // Animation on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const cards = entry.target.querySelectorAll('.blog-card');
                        cards.forEach((card, index) => {
                            setTimeout(() => {
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0)';
                            }, index * 100);
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            // Initialize cards with animation state
            const widgets = document.querySelectorAll('.elementor-widget-blogs_widget .blogs-widget');
            widgets.forEach(widget => {
                const cards = widget.querySelectorAll('.blog-card');
                cards.forEach(card => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';
                    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                });
                observer.observe(widget);
            });
        });
        </script>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        const categoryNames = {
            'mindset': 'Mindset & Founder Psychology',
            'offer-design': 'Offer Design & Pricing',
            'sales-clients': 'Sales & Clients',
            'systems-tools': 'Systems & Tools',
            'case-studies': 'Case Studies & Founder Stories',
            'coaching-101': 'Business Coaching 101'
        };
        #>
        <div class="blogs-widget">
            <div class="blog-header">
                <h2 class="section-title">{{{ settings.section_title }}}</h2>
                <p class="section-description">{{{ settings.section_description }}}</p>
            </div>

            <div class="blogs-grid">
                <# if (settings.blogs_list.length) { #>
                    <# _.each(settings.blogs_list, function(blog, index) { #>
                        <div class="blog-card" data-category="{{{ blog.blog_category }}}">
                            <a href="{{{ blog.blog_link.url }}}" class="blog-card-link">
                                <# if (blog.blog_image.url) { #>
                                    <div class="blog-image">
                                        <img src="{{{ blog.blog_image.url }}}" alt="{{{ blog.blog_title }}}" loading="lazy">
                                    </div>
                                <# } #>
                                <div class="blog-content">
                                    <div class="blog-header">
                                        <h3 class="blog-title">{{{ blog.blog_title }}}</h3>
                                        <# if (settings.show_categories === 'yes') { #>
                                            <div class="category-pill">
                                                <span>{{{ categoryNames[blog.blog_category] || 'TAG' }}}</span>
                                            </div>
                                        <# } #>
                                    </div>
                                    <p class="blog-description">{{{ blog.blog_description }}}</p>
                                </div>
                            </a>
                        </div>
                    <# }); #>
                <# } #>
            </div>
        </div>
        <?php
    }
}
?>