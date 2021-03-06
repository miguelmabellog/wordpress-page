<?php add_action( 'customize_register', 'weblizar_gl_customizer' );

function weblizar_gl_customizer( $wp_customize ) {
	wp_enqueue_style('customizr', WL_TEMPLATE_DIR_URI .'/css/customizr.css');
	wp_enqueue_style('FA', WL_TEMPLATE_DIR_URI .'/css/font-awesome-4.7.0/css/font-awesome.min.css');
	$ImageUrl1 = esc_url(get_template_directory_uri() ."/images/1.png");
	$ImageUrl2 = esc_url(get_template_directory_uri() ."/images/2.png");
	$ImageUrl3 = esc_url(get_template_directory_uri() ."/images/3.png");
	$port['1'] = esc_url(get_template_directory_uri() ."/images/portfolio1.png");
	$port['2'] = esc_url(get_template_directory_uri() ."/images/portfolio2.png");
	$port['3'] = esc_url(get_template_directory_uri() ."/images/portfolio3.png");
	$port['4'] = esc_url(get_template_directory_uri() ."/images/portfolio4.png"); 
	
	
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.logo h1',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.logo p',
	) );
	
	/* Genral section */
	$wp_customize->add_panel( 'enigma_theme_option', array(
    'title' => __( 'Theme Options','enigma' ),
    'priority' => 1, // Mixed with top-level-section hierarchy.
) );
//changelog//	
	$wp_customize->add_section('changelog_sec',	array('title' =>  __( 'Changelog','enigma' ),
			'panel'=>'enigma_theme_option',
            'priority' => 1,
    ));
	$wp_customize->add_setting( 'changelog', array(
			'default'    		=> null,
			'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( new enigma_changelog_Control( $wp_customize, 'changelog', array(
			'label'    => __( 'Enigma', 'enigma' ),
			'section'  => 'changelog_sec',
			'settings' => 'changelog',
			'priority' => 1,
	)));
$wp_customize->add_section(
        'general_sec',
        array(
            'title' => __( 'Theme General Options','enigma' ),
            'description' => 'Here you can customize Your theme\'s general Settings',
			'panel'=>'enigma_theme_option',
			'capability'=>'edit_theme_options',
            'priority' => 35,
			
        )
    );
		$wl_theme_options = weblizar_get_options();
	$wp_customize->add_setting(
		'enigma_options[_frontpage]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['_frontpage'],
			'sanitize_callback'=>'enigma_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'enigma_front_page', array(
		'label'        => __( 'Show Front Page', 'enigma' ),
		'type'=>'checkbox',
		'section'    => 'general_sec',
		'settings'   => 'enigma_options[_frontpage]',
	) );
	
	$wp_customize->add_setting(
		'enigma_options[snoweffect]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['snoweffect'],
			'sanitize_callback'=>'enigma_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'snoweffect', array(
		'label'        => __( 'Snow effect on/off , Reload to view effect', 'enigma' ),
		'type'=>'checkbox',
		'section'    => 'general_sec',
		'settings'   => 'enigma_options[snoweffect]',
	) );
	
	$wp_customize->add_setting(
		'enigma_options[title_position]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['title_position'],
			'sanitize_callback'=>'enigma_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'title_position', array(
		'label'        => __( 'Show Site Title in Center', 'enigma' ),
		'type'=>'checkbox',
		'section'    => 'general_sec',
		'settings'   => 'enigma_options[title_position]',
	) );
	
	
	// site title and logo position : left and center //
	$wp_customize->add_setting(
		'enigma_options[title_position]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['title_position'],
			'sanitize_callback'=>'esc_url_raw',
			'capability'        => 'edit_theme_options',
		)
	);
	// site title and logo position : left and center //
	// logo height width //
	$wp_customize->add_setting(
		'enigma_options[logo_height]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['height'],
			'sanitize_callback'=>'enigma_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'logo_height', array(
		'label'        => __( 'Logo Height', 'enigma' ),
		'description' => '',
		'type'=>'text',
		'section'    => 'general_sec',
		'settings'   => 'enigma_options[logo_height]',
	) );
	$wp_customize->add_setting(
		'enigma_options[logo_width]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['width'],
			'sanitize_callback'=>'enigma_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'logo_width', array(
		'label'        => __( 'Logo Width', 'enigma' ),
		'description' => '',
		'type'=>'text',
		'section'    => 'general_sec',
		'settings'   => 'enigma_options[logo_width]',
	) );
	// logo height width //
	
	$wp_customize->add_setting(
	'enigma_options[custom_css]',
		array(
		'default'=>esc_attr($wl_theme_options['custom_css']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
		)
	);
	$wp_customize->add_control( 'custom_css', array(
		'label'        => __( 'Custom CSS', 'enigma' ),
		'type'=>'textarea',
		'section'    => 'general_sec',
		'settings'   => 'enigma_options[custom_css]'
	) );
	/* Slider options */
	$wp_customize->add_section(
        'slider_sec',
        array(
            'title' =>  __( 'Theme Slider Options','enigma' ),
			'panel'=>'enigma_theme_option',
            'description' => 'Here you can add slider images',
			'capability'=>'edit_theme_options',
            'priority' => 35,
			'active_callback' => 'is_front_page',
        )
    );

    //

	$wp_customize->add_setting(
		'enigma_options[slider_image_speed]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slider_image_speed'],
			'sanitize_callback'=>'enigma_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'enigma_slider_speed', array(
		'label'        => __( 'Slider Speed Option', 'enigma' ),
		'description' => 'Value will be in milliseconds',
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slider_image_speed]',
	) );

    //
	
	$wp_customize->add_setting('enigma_options[animate_type_title]',
		array(
			'type'    => 'option',
			'default'=>'',
			'sanitize_callback'=>'enigma_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	
	$wp_customize->add_control(new enigma_animation( $wp_customize,'animate_type_title', array(
		'label'        => __( 'Animation for Slider Title', 'enigma' ),
		'type'=>'select',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[animate_type_title]',
	) ) );
	
	$wp_customize->add_setting('enigma_options[animate_type_desc]',
		array(
			'type'    => 'option',
			'default'=>'',
			'sanitize_callback'=>'enigma_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	
	$wp_customize->add_control(new enigma_animation( $wp_customize, 'animate_type_desc', array(
		'label'        => __( 'Animation for Slider Description', 'enigma' ),
		'type'=>'select',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[animate_type_desc]',
	) ) );
	


	$wp_customize->add_setting(
		'enigma_options[slide_image_1]',
		array(
			'type'    => 'option',
			'default'=>$ImageUrl1,
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
		)
	);
	$wp_customize->add_setting(
		'enigma_options[slide_image_2]',
		array(
			'type'    => 'option',
			'default'=>$ImageUrl2,
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_setting(
		'enigma_options[slide_image_3]',
		array(
			'type'    => 'option',
			'default'=>$ImageUrl3,
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
			
		)
	);
	$wp_customize->add_setting(
		'enigma_options[slide_title_1]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_title_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'enigma_sanitize_text',
			
		)
	);
	$wp_customize->add_setting(
		'enigma_options[slide_title_2]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_title_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'enigma_sanitize_text',
			
		)
	);
	$wp_customize->add_setting(
		'enigma_options[slide_title_3]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_title_3'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'enigma_sanitize_text',
			
		)
	);
	$wp_customize->add_setting(
		'slide_desc_1',
		array(
			'default'=>$wl_theme_options['slide_desc_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'enigma_sanitize_text',
			
		)
	);
	$wp_customize->add_setting(
		'slide_desc_2',
		array(
			'default'=>$wl_theme_options['slide_desc_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'enigma_sanitize_text',
			
		)
	);
	$wp_customize->add_setting(
		'slide_desc_3',
		array(
			'default'=>$wl_theme_options['slide_desc_3'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'enigma_sanitize_text',
			
		)
	);
	$wp_customize->add_setting(
		'enigma_options[slide_btn_text_1]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_text_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'enigma_sanitize_text',
			
		)
	);
	$wp_customize->add_setting(
		'enigma_options[slide_btn_text_2]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_text_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'enigma_sanitize_text',
			
		)
	);
	$wp_customize->add_setting(
		'enigma_options[slide_btn_text_3]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_text_3'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'enigma_sanitize_text',
			
		)
	);
	$wp_customize->add_setting(
		'enigma_options[slide_btn_link_1]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_link_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
			
		)
	);
	$wp_customize->add_setting(
		'enigma_options[slide_btn_link_2]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_link_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
			
		)
	);
	$wp_customize->add_setting(
		'enigma_options[slide_btn_link_3]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_link_3'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
			
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'enigma_slider_image_1', array(
		'label'        => __( 'Slider Image One', 'enigma' ),
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_image_1]'
	) ) );
	$wp_customize->add_control( 'enigma_slide_title_1', array(
		'label'        => __( 'Slider title one', 'enigma' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_title_1]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[slide_title_1]', array(
		'selector' => '.carousel-text .head_1',
	) );
	
	$wp_customize->add_control(new One_Page_Editor($wp_customize, 'slide_desc_1', array(
		'label'        => __( 'Slider description one', 'enigma' ),
		'active_callback' => 'show_on_front',
		'include_admin_print_footer' => true,
		'section'    => 'slider_sec',
		'settings'   => 'slide_desc_1'
	) ));
	
	$wp_customize->selective_refresh->add_partial( 'slide_desc_1', array(
		'selector' => '.desc_1',
	) );
	
	$wp_customize->add_control( 'Slider button one', array(
		'label'        => __( 'Slider Button Text One', 'enigma' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_btn_text_1]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[slide_btn_text_1]', array(
		'selector' => '.rdm_1',
	) );
	
	$wp_customize->add_control( 'enigma_slide_btnlink_1', array(
		'label'        => __( 'Slider Button Link One', 'enigma' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_btn_link_1]'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'enigma_slider_image_2', array(
		'label'        => __( 'Slider Image Two ', 'enigma' ),
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_image_2]'
	) ) );
	
	$wp_customize->add_control( 'enigma_slide_title_2', array(
		'label'        => __( 'Slider Title Two', 'enigma' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_title_2]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[slide_title_2]', array(
		'selector' => '.carousel-text .head_2',
	) );
	
	$wp_customize->add_control(new One_Page_Editor($wp_customize, 'slide_desc_2', array(
		'label'        => __( 'Slider Description Two', 'enigma' ),
		'active_callback' => 'show_on_front',
		'include_admin_print_footer' => true,
		'section'    => 'slider_sec',
		'settings'   => 'slide_desc_2'
	)));
	
	$wp_customize->selective_refresh->add_partial( 'slide_desc_2', array(
		'selector' => '.desc_2',
	) );
	
	$wp_customize->add_control( 'enigma_slide_btn_2', array(
		'label'        => __( 'Slider Button Text Two', 'enigma' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_btn_text_2]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[slide_btn_text_2]', array(
		'selector' => '.rdm_2',
	) );
	
	$wp_customize->add_control( 'enigma_slide_btnlink_2', array(
		'label'        => __( 'Slider Button Link Two', 'enigma' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_btn_link_2]'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'enigma_slider_image_3', array(
		'label'        => __( 'Slider Image Three', 'enigma' ),
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_image_3]'
	) ) );
	$wp_customize->add_control( 'enigma_slide_title_3', array(
		'label'        => __( 'Slider Title Three', 'enigma' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_title_3]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[slide_title_3]', array(
		'selector' => '.carousel-text .head_3',
	) );
	
	$wp_customize->add_control(new One_Page_Editor($wp_customize,'slide_desc_3', array(
		'label'        => __( 'Slider Description Three', 'enigma' ),
		'active_callback' => 'show_on_front',
		'include_admin_print_footer' => true,
		'section'    => 'slider_sec',
		'settings'   => 'slide_desc_3'
	)));
	
	$wp_customize->selective_refresh->add_partial( 'slide_desc_3', array(
		'selector' => '.desc_3',
	) );
	
	$wp_customize->add_control( 'enigma_slide_btn_3', array(
		'label'        => __( 'Slider Button Text Three', 'enigma' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_btn_text_3]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[slide_btn_text_3]', array(
		'selector' => '.rdm_3',
	) );
	
	$wp_customize->add_control( 'enigma_slide_btnlink_3', array(
		'label'        => __( 'Slider Button Link Three', 'enigma' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'enigma_options[slide_btn_link_3]'
	) );
	
	/*search-box*/
	if (get_template_directory() !== get_stylesheet_directory()) {
		$wp_customize->add_section(
        'search_sec',
        array(
            'title' => __( 'Search Box','enigma' ),
            'description' => __( 'Here you can Search Box in header','enigma' ),
			'panel'=>'enigma_theme_option',
			'capability'=>'edit_theme_options',
            'priority' => 35,
		   ) );
		
	$wp_customize->add_setting(
		'enigma_options_search_box',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'sanitize_callback'=>'enigma_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'enigma_search_box', array(
		'label'        => __( 'Enable Search Box in header', 'enigma' ),
		'type'=>'checkbox',
		'section'    => 'search_sec',
		'settings'   => 'enigma_options_search_box',
	) );
	/* search-box */
	
	/* Product options */
	$wp_customize->add_section('product_section',array(
	'title'=>__("Product Options",'enigma'),
	'panel'=>'enigma_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 35,
	));	
	
	$wp_customize->add_setting(
	'enigma_options[product_title]',
		array(
		'default'=>esc_attr($wl_theme_options['product_title']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
		
			)
	);
	$wp_customize->add_control( 'product_title', array(
		'label'        => __( 'Product Title', 'enigma' ),
		'type'=>'text',
		'section'    => 'product_section',
		'settings'   => 'enigma_options[product_title]'
	) ); }
	
	
	
	/* Service Options */
	$wp_customize->add_section('service_section',array(
	'title'=>__("Service Options",'enigma'),
	'panel'=>'enigma_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 35,
	'active_callback' => 'is_front_page',
	));
	$wp_customize->add_setting(
		'enigma_options[services_home]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['services_home'],
			'sanitize_callback'=>'enigma_sanitize_checkbox',
			'capability' => 'edit_theme_options'
		)
	);
	
	
	$wp_customize->add_setting(
	'enigma_options[home_service_heading]',
		array(
		'default'=>esc_attr($wl_theme_options['home_service_heading']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
		
			)
	);
	$wp_customize->add_control( 'home_service_heading', array(
		'label'        => __( 'Home Service Title', 'enigma' ),
		'type'=>'text',
		'section'    => 'service_section',
		'settings'   => 'enigma_options[home_service_heading]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[home_service_heading]', array(
		'selector' => '.enigma_service .enigma_heading_title h3',
	) );
	
	$wp_customize->add_setting(
	'enigma_options[service_1_icons]',
		array(
		'default'=>esc_attr($wl_theme_options['service_1_icons']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
		
			)
	);
	$wp_customize->add_setting(
	'enigma_options[service_2_icons]',
		array(
		'default'=>esc_attr($wl_theme_options['service_2_icons']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
		
		)
	);
	$wp_customize->add_setting(
	'enigma_options[service_3_icons]',
		array(
		'default'=>esc_attr($wl_theme_options['service_3_icons']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
		
		)
	);
	$wp_customize->add_setting(
	'enigma_options[service_1_title]',
		array(
		'default'=>esc_attr($wl_theme_options['service_1_title']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
			)
	);
	$wp_customize->add_setting(
	'enigma_options[service_2_title]',
		array(
		'default'=>esc_attr($wl_theme_options['service_2_title']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text'
		)
	);
	$wp_customize->add_setting(
	'enigma_options[service_3_title]',
		array(
		'default'=>esc_attr($wl_theme_options['service_3_title']),
		'type'=>'option',
		'sanitize_callback'=>'enigma_sanitize_text',
		'capability'=>'edit_theme_options',
		)
	);
	$wp_customize->add_setting(
	'service_1_text',
		array(
		'default'=>esc_attr($wl_theme_options['service_1_text']),
		'sanitize_callback'=>'enigma_sanitize_text',
		'capability'=>'edit_theme_options'
	));
	$wp_customize->add_setting(
	'service_2_text',
		array(
		'default'=>esc_attr($wl_theme_options['service_2_text']),
		'sanitize_callback'=>'enigma_sanitize_text',
		'capability'=>'edit_theme_options',
		)
	);
	$wp_customize->add_setting(
	'service_3_text',
		array(
		'default'=>esc_attr($wl_theme_options['service_3_text']),
		'sanitize_callback'=>'enigma_sanitize_text',
		'capability'=>'edit_theme_options',
		)
	);
	
	$wp_customize->add_setting(
	'enigma_options[service_1_link]',
		array(
		'default'=>esc_attr($wl_theme_options['service_1_link']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'esc_url_raw',
		));
	$wp_customize->add_setting(
	'enigma_options[service_2_link]',
		array(
		'default'=>esc_attr($wl_theme_options['service_2_link']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'esc_url_raw',
		));
	$wp_customize->add_setting(
	'enigma_options[service_3_link]',
		array(
		'default'=>esc_attr($wl_theme_options['service_3_link']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'esc_url_raw',
		));
	
	$wp_customize->add_control( 'enigma_show_service', array(
		'label'        => __( 'Enable Service on Home', 'enigma' ),
		'type'=>'checkbox',
		'section'    => 'service_section',
		'settings'   => 'enigma_options[services_home]'
	) );
	
	$wp_customize->add_control(
    new enigma_Customize_Misc_Control(
        $wp_customize,
        'service_options1-line',
        array(
            'section'  => 'service_section',
            'type'     => 'line'
        )
    ));

	$wp_customize->add_control( 'service_one_title', array(
		'label'        => __( 'Service One Title', 'enigma' ),
		'type'=>'text',
		'section'    => 'service_section',
		'settings'   => 'enigma_options[service_1_title]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[service_1_title]', array(
		'selector' => '.enigma_service_detail .head_1',
	) );
	
		$wp_customize->add_control(new Enigma_Customizer_Icon_Picker_Control($wp_customize,'service_1_icons',
        array(
			'label'        => __( 'Service Icon One', 'enigma' ),
			'type'=>'text',
            'section'  => 'service_section',
			'settings'   => 'enigma_options[service_1_icons]'
        )
    ));
	
	$wp_customize->add_control(new One_Page_Editor($wp_customize, 'service_1_text', array(
		'label'        => __( 'Service One Text', 'enigma' ),
		'section'    => 'service_section',
		'active_callback' => 'show_on_front',
		'include_admin_print_footer' => true,
		'settings'   => 'service_1_text'
	)));
	
	$wp_customize->add_control( 'service_1_link', array(
		'label'        => __( 'Service One Link', 'enigma' ),
		'type'=>'url',
		'section'    => 'service_section',
		'settings'   => 'enigma_options[service_1_link]'
	) );
		$wp_customize->add_control(
    new enigma_Customize_Misc_Control(
        $wp_customize,
        'service_options2-line',
        array(
            'section'  => 'service_section',
            'type'     => 'line'
        )
    ));
	$wp_customize->add_control( 'service_two_title', array(
		'label'        => __( 'Service Two Title', 'enigma' ),
		'type'=>'text',
		'section'    => 'service_section',
		'settings'   => 'enigma_options[service_2_title]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[service_2_title]', array(
		'selector' => '.enigma_service_detail .head_2',
	) ); 
		$wp_customize->add_control(new Enigma_Customizer_Icon_Picker_Control($wp_customize,'service_2_icons',
        array(
			'label'        => __( 'Service Icon Two', 'enigma' ),
			'type'=>'text',
            'section'  => 'service_section',
			'settings'   => 'enigma_options[service_2_icons]'
        )
    ));
	$wp_customize->add_control(new One_Page_Editor($wp_customize,'service_2_text', array(
		'label'        => __( 'Service Two Text', 'enigma' ),
		'section'    => 'service_section',
		'active_callback' => 'show_on_front',
		'include_admin_print_footer' => true,
		'settings'   => 'service_2_text'
	) ));
	
	$wp_customize->add_control( 'service_2_link', array(
		'label'        => __( 'Service Two Link', 'enigma' ),
		'type'=>'url',
		'section'    => 'service_section',
		'settings'   => 'enigma_options[service_2_link]'
	) );
		$wp_customize->add_control(new enigma_Customize_Misc_Control(
        $wp_customize, 'enigma_service_options3-line',
        array(
            'section'  => 'service_section',
            'type'     => 'line'
        )
    ));
	$wp_customize->add_control( 'enigma_service_three_title', array(
		'label'        => __( 'Service Three Title', 'enigma' ),
		'type'=>'text',
		'section'    => 'service_section',
		'settings'   => 'enigma_options[service_3_title]'
	) );
	$wp_customize->selective_refresh->add_partial( 'enigma_options[service_3_title]', array(
		'selector' => '.enigma_service_detail .head_3',
	) );
	$wp_customize->add_control(new Enigma_Customizer_Icon_Picker_Control($wp_customize, 'service_3_icons',
        array(
			'label'        => __( 'Service Icon Three', 'enigma' ),
			'type'=>'text',
            'section'  => 'service_section',
			'settings'   => 'enigma_options[service_3_icons]'
        )
    ));
	$wp_customize->add_control(new One_Page_Editor($wp_customize,'service_3_text', array(
		'label'        => __( 'Service Three Text', 'enigma' ),
		'active_callback' => 'show_on_front',
		'include_admin_print_footer' => true,
		'section'    => 'service_section',
		'settings'   => 'service_3_text'
	)));
	
	$wp_customize->add_control( 'service_3_link', array(
		'label'        => __( 'Service Three Link', 'enigma' ),
		'type'=>'url',
		'section'    => 'service_section',
		'settings'   => 'enigma_options[service_3_link]'
	) );
/* Portfolio Section */
	$wp_customize->add_section(
        'portfolio_section',
        array(
            'title' => __('Portfolio Options','enigma'),
            'description' => __('Here you can add Portfolio title,description and even portfolios','enigma'),
			'panel'=>'enigma_theme_option',
			'capability'=>'edit_theme_options',
            'priority' => 35,
        )
    );
	
	$wp_customize->add_setting(
		'enigma_options[portfolio_home]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['portfolio_home'],
			'sanitize_callback'=>'enigma_sanitize_checkbox',
			'capability' => 'edit_theme_options'
		)
	);
	$wp_customize->add_setting(
		'enigma_options[port_heading]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['port_heading'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'enigma_sanitize_text',
		)
	);

	for($i=1;$i<=4;$i++){ 
		$wp_customize->add_setting(
			'enigma_options[port_'.$i.'_img]',
			array(
				'type'    => 'option',
				'default'=>$port[$i],
				'capability' => 'edit_theme_options',
				'sanitize_callback'=>'esc_url_raw',
			)
		);
		$wp_customize->add_setting(
			'enigma_options[port_'.$i.'_title]',
			array(
				'type'    => 'option',
				'default'=>$wl_theme_options['port_'.$i.'_title'],
				'capability' => 'edit_theme_options',
				'sanitize_callback'=>'enigma_sanitize_text',
			)
		);

		$wp_customize->add_setting(
			'enigma_options[port_'.$i.'_link]',
			array(
				'type'    => 'option',
				'default'=>$wl_theme_options['port_'.$i.'_link'],
				'capability' => 'edit_theme_options',
				'sanitize_callback'=>'esc_url_raw',
			)
		);
	}
	
	$wp_customize->add_control( 'enigma_show_portfolio', array(
		'label'        => __( 'Enable Portfolio on Home', 'enigma' ),
		'type'=>'checkbox',
		'section'    => 'portfolio_section',
		'settings'   => 'enigma_options[portfolio_home]'
	) );
	$wp_customize->add_control( 'enigma_portfolio_title', array(
		'label'        => __( 'Portfolio Heading', 'enigma' ),
		'type'=>'text',
		'section'    => 'portfolio_section',
		'settings'   => 'enigma_options[port_heading]'
	) );

	$wp_customize->selective_refresh->add_partial( 'enigma_options[port_heading]', array(
		'selector' => '.enigma_project_section .enigma_heading_title h3',
	) );
	
	for($i=1;$i<=4;$i++){
	$j = array(' One', ' Two', ' Three', ' Four');
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'enigma_portfolio_img_'.$i, array(
		'label'        => __( 'Portfolio Image', 'enigma' ).$j[$i-1],
		'section'    => 'portfolio_section',
		'settings'   => 'enigma_options[port_'.$i.'_img]'
	) ) );
	$wp_customize->add_control( 'enigma_portfolio_title_'.$i, array(
		'label'        => __( 'Portfolio Title', 'enigma').$j[$i-1],
		'type'=>'text',
		'section'    => 'portfolio_section',
		'settings'   => 'enigma_options[port_'.$i.'_title]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[port_'.$i.'_title]', array(
		'selector' => '.enigma_home_portfolio_caption .port_'.$i,
	) );
	
	$wp_customize->add_control( 'enigma_portfolio_link_'.$i, array(
		'label'        => __( 'Portfolio Link', 'enigma' ).$j[$i-1],
		'type'=>'url',
		'section'    => 'portfolio_section',
		'settings'   => 'enigma_options[port_'.$i.'_link]'
	) );
	}

/* Blog Option */
	$wp_customize->add_section('blog_section',array(
	'title'=>__('Home Blog Options','enigma'),
	'panel'=>'enigma_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 35
	));
	$wp_customize->add_setting(
	'enigma_options[blog_home]',
		array(
		'default'=>esc_attr($wl_theme_options['blog_home']),
		'type'=>'option',
		'sanitize_callback'=>'enigma_sanitize_checkbox',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'blog_home', array(
		'label'        => __( 'Enable Social Media Icons in Header', 'enigma' ),
		'type'=>'checkbox',
		'section'    => 'blog_section',
		'settings'   => 'enigma_options[blog_home]'
	) );
	$wp_customize->add_setting(
		'enigma_options[blog_title]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['blog_title'],
			'sanitize_callback'=>'enigma_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'enigma_latest_post', array(
		'label'        => __( 'Home Blog Title', 'enigma' ),
		'type'=>'text',
		'section'    => 'blog_section',
		'settings'   => 'enigma_options[blog_title]',
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[blog_title]', array(
		'selector' => '.enigma_blog_area .enigma_heading_title h3',
	) );
	
	$wp_customize->add_setting(
		'enigma_options[blog_speed]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['blog_speed'],
			'sanitize_callback'=>'enigma_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'blog_speed', array(
		'label'        => __( 'Slider Speed Option', 'enigma' ),
		'description' => 'Value will be in milliseconds',
		'type'=>'text',
		'section'    => 'blog_section',
		'settings'   => 'enigma_options[blog_speed]',
	) );
	
	$wp_customize->add_setting( 'enigma_options[blog_speed]', array(
            'type'    => 'option',
            'default'=>$wl_theme_options['blog_speed'],
            'sanitize_callback'=>'enigma_sanitize_text',
            'capability'        => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( 'blog_speed', array(
        'label'        => __( 'Blog Speed Option', 'enigma' ),
        'description' => 'Value will be in milliseconds',
        'type'=>'text',
        'section'    => 'blog_section',
        'settings'   => 'enigma_options[blog_speed]',
    ) );


	$wp_customize->add_setting('enigma_options[blog_category]',
		array(
			'type'    => 'option',
			'sanitize_callback'=>'enigma_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);
	
	$wp_customize->add_control(new enigma_category_Control( $wp_customize, 'blog_category', array(
		'label'        => __( 'Blog Category', 'enigma' ),
		'type'=>'select',
		'section'    => 'blog_section',
		'settings'   => 'enigma_options[blog_category]',
	) ) );
	
	
/* Font Family Section */
	$wp_customize->add_section('font_section', array(
	'title' => __('Typography Settings', 'enigma'),
	'panel' => 'enigma_theme_option',
	'capability' => 'edit_theme_options',
	'priority' => 35
	));
	
	$wp_customize->add_setting(
	'enigma_options[main_heading_font]',
	array(
	'default' => esc_attr($wl_theme_options['main_heading_font']),
	'type' => 'option',
	'sanitize_callback'=>'enigma_sanitize_text',
	'capability'=>'edit_theme_options',
    ));
	$wp_customize->add_control(new enigma_Font_Control($wp_customize, 'main_heading_font', array(
	'label' => __('Logo Font Style', 'enigma'),
	'section' => 'font_section',
	'settings' => 'enigma_options[main_heading_font]',
	)));
	
	$wp_customize->add_setting(
	'enigma_options[menu_font]',
	array(
	'default' => esc_attr($wl_theme_options['menu_font']),
	'type' => 'option',
	'sanitize_callback'=>'enigma_sanitize_text',
	'capability'=>'edit_theme_options'
    ));
	$wp_customize->add_control(new enigma_Font_Control($wp_customize, 'menu_font', array(
	'label' => __('Header Menu Font Style', 'enigma'),
	'section' => 'font_section',
	'settings' => 'enigma_options[menu_font]'
	)));
	
	$wp_customize->add_setting(
	'enigma_options[theme_title]',
	array(
	'default' => esc_attr($wl_theme_options['theme_title']),
	'type' => 'option',
	'sanitize_callback'=>'enigma_sanitize_text',
	'capability'=>'edit_theme_options'
    ));
	$wp_customize->add_control(new enigma_Font_Control($wp_customize, 'theme_title', array(
	'label' => __('Theme Title Font Style', 'enigma'),
	'section' => 'font_section',
	'settings' => 'enigma_options[theme_title]'
	)));
	
	$wp_customize->add_setting(
	'enigma_options[desc_font_all]',
	array(
	'default' => esc_attr($wl_theme_options['desc_font_all']),
	'type' => 'option',
	'sanitize_callback'=>'enigma_sanitize_text',
	'capability'=>'edit_theme_options'
    ));
	$wp_customize->add_control(new enigma_Font_Control($wp_customize, 'desc_font_all', array(
	'label' => __('Theme Description Font Style', 'enigma'),
	'section' => 'font_section',
	'settings' => 'enigma_options[desc_font_all]'
	)));
	
/* Social options */
	$wp_customize->add_section('social_section',array(
	'title'=>__("Social Options",'enigma'),
	'panel'=>'enigma_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 35
	));
	$wp_customize->add_setting(
	'enigma_options[header_social_media_in_enabled]',
		array(
		'default'=>esc_attr($wl_theme_options['header_social_media_in_enabled']),
		'type'=>'option',
		'sanitize_callback'=>'enigma_sanitize_checkbox',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'header_social_media_in_enabled', array(
		'label'        => __( 'Enable Social Media Icons in Header', 'enigma' ),
		'type'=>'checkbox',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[header_social_media_in_enabled]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[header_social_media_in_enabled]', array(
		'selector' => '.header_section .social',
	) );
	
	$wp_customize->add_setting(
	'enigma_options[footer_section_social_media_enbled]',
		array(
		'default'=>esc_attr($wl_theme_options['footer_section_social_media_enbled']),
		'type'=>'option',
		'sanitize_callback'=>'enigma_sanitize_checkbox',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'footer_section_social_media_enbled', array(
		'label'        => __( 'Enable Social Media Icons in Footer', 'enigma' ),
		'type'=>'checkbox',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[footer_section_social_media_enbled]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[footer_section_social_media_enbled]', array(
		'selector' => '.enigma_footer_area .social',
	) );
	
	$wp_customize->add_setting(
	'enigma_options[email_id]',
		array(
		'default'=>esc_attr($wl_theme_options['email_id']),
		'type'=>'option',
		'sanitize_callback'=>'sanitize_email',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'email_id', array(
		'label'        =>  __('Email ID', 'enigma' ),
		'type'=>'email',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[email_id]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[email_id]', array(
		'selector' => '.head-contact-info',
	) );
	
	$wp_customize->add_setting(
	'enigma_options[phone_no]',
		array(
		'default'=>esc_attr($wl_theme_options['phone_no']),
		'type'=>'option',
		'sanitize_callback'=>'enigma_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'phone_no', array(
		'label'        =>  __('Phone Number', 'enigma' ),
		'type'=>'text',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[phone_no]'
	) );
	$wp_customize->add_setting(
	'enigma_options[twitter_link]',
		array(
		'default'=>esc_attr($wl_theme_options['twitter_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'twitter_link', array(
		'label'        =>  __('Twitter', 'enigma' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[twitter_link]'
	) );
	$wp_customize->add_setting(
	'enigma_options[fb_link]',
		array(
		'default'=>esc_attr($wl_theme_options['fb_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'fb_link', array(
		'label'        => __( 'Facebook', 'enigma' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[fb_link]'
	) );
	$wp_customize->add_setting(
	'enigma_options[linkedin_link]',
		array(
		'default'=>esc_attr($wl_theme_options['linkedin_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'linkedin_link', array(
		'label'        => __( 'LinkedIn', 'enigma' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[linkedin_link]'
	) );
	
	$wp_customize->add_setting(
	'enigma_options[gplus]',
		array(
		'default'=>esc_attr($wl_theme_options['gplus']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'gplus', array(
		'label'        => __( 'Goole+', 'enigma' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[gplus]'
	) );
	$wp_customize->add_setting(
	'enigma_options[youtube_link]',
		array(
		'default'=>esc_attr($wl_theme_options['youtube_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'youtube_link', array(
		'label'        => __( 'Youtube', 'enigma' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[youtube_link]'
	) );
	$wp_customize->add_setting(
	'enigma_options[instagram]',
		array(
		'default'=>esc_attr($wl_theme_options['instagram']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'instagram', array(
		'label'        => __( 'Instagram', 'enigma' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[instagram]'
	) );
	/*extra icons added 2.7.1*/
	$wp_customize->add_setting(
	'enigma_options[vk_link]',
		array(
		'default'=>esc_attr($wl_theme_options['vk_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'vk_link', array(
		'label'        => __( 'VK', 'enigma' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[vk_link]'
	) );
	$wp_customize->add_setting(
	'enigma_options[qq_link]',
		array(
		'default'=>esc_attr($wl_theme_options['qq_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'qq_link', array(
		'label'        => __( 'QQ', 'enigma' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[qq_link]'
	) );
	$wp_customize->add_setting(
	'enigma_options[whatsapp_link]',
		array(
		'default'=>esc_attr($wl_theme_options['whatsapp_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_attr',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'whatsapp_link', array(
		'label'        => __( 'WhatsApp', 'enigma' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'enigma_options[whatsapp_link]'
	) );
	/* Footer callout */
	$wp_customize->add_section('callout_section',array(
	'title'=>__("Footer Call-Out Options",'enigma'),
	'panel'=>'enigma_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 35
	));
	$wp_customize->add_setting(
	'enigma_options[fc_home]',
		array(
		'default'=>esc_attr($wl_theme_options['fc_home']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
		)
	);
	$wp_customize->add_control( 'fc_home', array(
		'label'        => __( 'Enable Footer callout on HOme', 'enigma' ),
		'type'=>'checkbox',
		'section'    => 'callout_section',
		'settings'   => 'enigma_options[fc_home]'
	) );
	$wp_customize->add_setting(
	'enigma_options[fc_title]',
		array(
		'default'=>esc_attr($wl_theme_options['fc_title']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
		)
	);
	$wp_customize->add_control( 'fc_title', array(
		'label'        => __( 'Footer callout Title', 'enigma' ),
		'type'=>'text',
		'section'    => 'callout_section',
		'settings'   => 'enigma_options[fc_title]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[fc_title]', array(
		'selector' => '.enigma_callout_area p',
	) );
	
	$wp_customize->add_setting(
	'enigma_options[fc_btn_txt]',
		array(
		'default'=>esc_attr($wl_theme_options['fc_btn_txt']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
		)
	);
	$wp_customize->add_control( 'fc_btn_txt', array(
		'label'        => __( 'Footer callout Button Text', 'enigma' ),
		'type'=>'text',
		'section'    => 'callout_section',
		'settings'   => 'enigma_options[fc_btn_txt]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[fc_btn_txt]', array(
		'selector' => '.enigma_callout_area a',
	) );
	
	$wp_customize->add_setting(
	'enigma_options[fc_btn_link]',
		array(
		'default'=>esc_attr($wl_theme_options['fc_btn_link']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
		)
	);
	$wp_customize->add_control( 'fc_btn_link', array(
		'label'        => __( 'Footer callout Button Link', 'enigma' ),
		'type'=>'text',
		'section'    => 'callout_section',
		'settings'   => 'enigma_options[fc_btn_link]'
	) );
	$wp_customize->add_setting(
	'enigma_options[fc_icon]',
		array(
		'default'=>esc_attr($wl_theme_options['fc_icon']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'enigma_sanitize_text',
		)
	);
	$wp_customize->add_control( 'fc_icon', array(
		'label'        => __( 'Footer callout Icon', 'enigma' ),
		'type'=>'text',
		'section'    => 'callout_section',
		'settings'   => 'enigma_options[fc_icon]'
	) );
	
	/* Footer Options */
	$wp_customize->add_section('footer_section',array(
	'title'=>__("Footer Options",'enigma'),
	'panel'=>'enigma_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 35
	));
	$wp_customize->add_setting(
	'enigma_options[footer_customizations]',
		array(
		'default'=>esc_attr($wl_theme_options['footer_customizations']),
		'type'=>'option',
		'sanitize_callback'=>'enigma_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'footer_customizations', array(
		'label'        => __( 'Footer Customization Text', 'enigma' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'enigma_options[footer_customizations]'
	) );
	
	$wp_customize->selective_refresh->add_partial( 'enigma_options[footer_customizations]', array(
		'selector' => '.enigma_footer_copyright_info',
	) );
	
	$wp_customize->add_setting(
	'enigma_options[developed_by_text]',
		array(
		'default'=>esc_attr($wl_theme_options['developed_by_text']),
		'type'=>'option',
		'sanitize_callback'=>'enigma_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'developed_by_text', array(
		'label'        => __( 'Developed By Text', 'enigma' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'enigma_options[developed_by_text]'
	) );
	$wp_customize->add_setting(
	'enigma_options[developed_by_weblizar_text]',
		array(
		'default'=>esc_attr($wl_theme_options['developed_by_weblizar_text']),
		'type'=>'option',
		'sanitize_callback'=>'enigma_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'developed_by_weblizar_text', array(
		'label'        => __( 'Developed By Link Text', 'enigma' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'enigma_options[developed_by_weblizar_text]'
	) );
	$wp_customize->add_setting(
	'enigma_options[developed_by_link]',
		array(
		'default'=>esc_attr($wl_theme_options['developed_by_link']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_control( 'developed_by_link', array(
		'label'        => __( 'Developed By Link', 'enigma' ),
		'type'=>'url',
		'section'    => 'footer_section',
		'settings'   => 'enigma_options[developed_by_link]'
	) );   
	
			$wp_customize->add_section( 'enigma_more' , array(
				'title'      	=> __( 'Upgrade to Enigma Premium 25%OFF', 'enigma' ),
				'priority'   	=> 999,
				'panel'=>'enigma_theme_option',
			) );

			$wp_customize->add_setting( 'enigma_more', array(
				'default'    		=> null,
				'sanitize_callback' => 'sanitize_text_field',
			) );

			$wp_customize->add_control( new More_Enigma_Control( $wp_customize, 'enigma_more', array(
				'label'    => __( 'Enigma Premium', 'enigma' ),
				'section'  => 'enigma_more',
				'settings' => 'enigma_more',
				'priority' => 1,
			) ) ); 

	// excerpt option 
    $wp_customize->add_section('excerpt_option',array(
    'title'=>__("Excerpt Option",'enigma'),
    'panel'=>'enigma_theme_option',
    'capability'=>'edit_theme_options',
    'priority' => 37,
    ));
    
    $wp_customize->add_setting( 'enigma_options[excerpt_blog]', array(
        'default'=>_($wl_theme_options['excerpt_blog']),
        'type'=>'option',
        'sanitize_callback'=>'enigma_sanitize_integer',
        'capability'=>'edit_theme_options'
    ) );
        $wp_customize->add_control( 'excerpt_blog', array(
        'label'        => __( 'Excerpt length blog section', 'enigma' ),
        'type'=>'number',
        'section'    => 'excerpt_option',
		'description' => esc_html__('Excerpt length only for home blog section.', 'enigma'),
		'settings'   => 'enigma_options[excerpt_blog]'
    ) );
	
	// home layout //
	$wp_customize->add_section('Home_Page_Layout',array(
    'title'=>__("Home Page Layout Option",'enigma'),
    'panel'=>'enigma_theme_option',
    'capability'=>'edit_theme_options',
    'priority' => 37,
    ));
	$wp_customize->add_setting('home_reorder',
            array(
				'type'=>'theme_mod',
                'sanitize_callback' => 'sanitize_json_string',
				'capability'        => 'edit_theme_options',
            )
        );
        $wp_customize->add_control(new enigma_Custom_sortable_Control($wp_customize,'home_reorder', array(
			'label'=>__( 'Front Page Layout Option', 'enigma' ),
            'section' => 'Home_Page_Layout',
            'type'    => 'home-sortable',
            'choices' => array(
                'services'      => __('Home Services', 'enigma'),
                'portfolio'     => __('Home Portfolio', 'enigma'),
                'blog'        => __('Home Blog', 'enigma'),
            ),
			'settings'=>'home_reorder',
        ))); 
	// home layout close // 
}
function enigma_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function enigma_sanitize_checkbox( $input ) {
    return $input;
}
function enigma_sanitize_integer( $input ) {
    return (int)($input);
}
/* Custom Control Class */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'enigma_Customize_Misc_Control' ) ) :
class enigma_Customize_Misc_Control extends WP_Customize_Control {
    public $settings = 'blogname';
    public $description = '';
    public function render_content() {
        switch ( $this->type ) {
            default:
           
            case 'heading':
                echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
                break;
 
            case 'line' :
                echo '<hr />';
                break;
			
        }
    }
}
endif;
		
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'More_Enigma_Control' ) ) :
class More_Enigma_Control extends WP_Customize_Control {

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() {
		?>
		<div class="row">
		<div class="col-md-4">
				<div class="stitched">
				
				<?php echo __("Coupon Code : PREXMAS25", "enigma" );?>
				</div>
		</div>
		</div>
		<label style="overflow: hidden; zoom: 1;">
			<div class="col-md-2 col-sm-6 upsell-btn">					
					<a style="margin-bottom:20px;margin-left:20px;" href="http://weblizar.com/themes/enigma-premium/" target="blank" class="btn btn-success btn"><?php _e('Upgrade to Enigma Premium','enigma'); ?> </a>
			</div>
			<div class="col-md-4 col-sm-6">
				<img class="enigma_img_responsive" src="<?php echo WL_TEMPLATE_DIR_URI .'/images/Enig.jpg'?>">
			</div>			
			<div class="col-md-3 col-sm-6">
				<h3 style="margin-top:10px;margin-left: 20px;text-decoration:underline;color:#333;"><?php echo _e( 'Enigma Premium - Features','enigma'); ?></h3>
					<ul style="padding-top:20px">
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Responsive Design','enigma'); ?> </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Enigma Parallax Design Included','enigma'); ?> </li>						
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('More than 13 Templates','enigma'); ?> </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('8 Different Types of Blog Templates','enigma'); ?> </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('6 Types of Portfolio Templates','enigma'); ?></li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('12 types Themes Colors Scheme','enigma'); ?></li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Patterns Background','enigma'); ?>   </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('WPML Compatible','enigma'); ?>   </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Woo-commerce Compatible','enigma'); ?>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Image Background','enigma'); ?>  </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Image Background','enigma'); ?>  </li>	
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Ultimate Portfolio layout with Isotope effect','enigma'); ?> </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Rich Short codes','enigma'); ?> </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Translation Ready','enigma'); ?> </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Coming Soon Mode','enigma'); ?>  </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Extreme Gallery Design Layout','enigma'); ?>  </li>
					
					</ul>
			</div>
			<div class="col-md-2 col-sm-6 upsell-btn">					
					<a style="margin-bottom:20px;margin-left:20px;" href="http://weblizar.com/themes/enigma-premium/" target="blank" class="btn btn-success btn"><?php _e('Upgrade to Enigma Premium','enigma'); ?> </a>
			</div>
			<span class="customize-control-title"><?php _e( 'Enjoying Enigma?', 'enigma' ); ?></span>
			<p>
				<?php
					printf( __( 'If you Like our Products , Please do Rate us on %sWordPress.org%s?  We\'d really appreciate it!', 'enigma' ), '<a target="" href="https://wordpress.org/support/view/theme-reviews/enigma?filter=5">', '</a>' );
				?>
			</p>
		</label>
		<?php
	}
}
endif;

/* class for font-family */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'enigma_Font_Control' ) ) :
class enigma_Font_Control extends WP_Customize_Control 
{  
 public function render_content() 
 {?>
   <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
   <select <?php $this->link(); ?> >
    <option  value="Abril Fatface"<?php if($this->value()== 'Abril Fatface') echo 'selected="selected"';?>><?php _e('Abril Fatface','enigma'); ?></option>
	<option  value="Advent Pro"<?php if($this->value()== 'Advent Pro')  echo 'selected="selected"';?>><?php _e('Advent Pro','enigma'); ?></option>
	<option  value="Aldrich"<?php if($this->value()== 'Aldrich') echo 'selected="selected"';?>><?php _e('Aldrich','enigma'); ?></option>
	<option  value="Alex Brush"<?php if($this->value()== 'Alex Brush') echo 'selected="selected"';?>><?php _e('Alex Brush','enigma'); ?></option>
	<option  value="Allura"<?php if($this->value()== 'Allura') echo 'selected="selected"';?>><?php _e('Allura','enigma'); ?></option>
	<option  value="Amatic SC"<?php if($this->value()== 'Amatic SC') echo 'selected="selected"';?>><?php _e('Amatic SC','enigma'); ?></option>
	<option  value="arial"<?php if($this->value()== 'arial') echo 'selected="selected"';?>><?php _e('Arial','enigma'); ?></option>
	<option  value="Astloch"<?php if($this->value()== 'Astloch') echo 'selected="selected"';?>><?php _e('Astloch','enigma'); ?></option>
	<option  value="arno pro bold italic"<?php if($this->value()== 'arno pro bold italic') echo 'selected="selected"';?>><?php _e('Arno pro bold italic','enigma'); ?></option>
	<option  value="Bad Script"<?php if($this->value()== 'Bad Script') echo 'selected="selected"';?>><?php _e('Bad Script','enigma'); ?></option>
	<option  value="Bilbo"<?php if($this->value()== 'Bilbo') echo 'selected="selected"';?>><?php _e('Bilbo','enigma'); ?></option>
	<option  value="Calligraffitti"<?php if($this->value()== 'Calligraffitti') echo 'selected="selected"';?>><?php _e('Calligraffitti','enigma'); ?></option>
	<option  value="Candal"<?php if($this->value()== 'Candal') echo 'selected="selected"';?>><?php _e('Candal','enigma'); ?></option>
	<option  value="Cedarville Cursive"<?php if($this->value()== 'Cedarville Cursive') echo 'selected="selected"';?>><?php _e('Cedarville Cursive','enigma'); ?></option>
	<option  value="Clicker Script"<?php if($this->value()== 'Clicker Script') echo 'selected="selected"';?>><?php _e('Clicker Script','enigma'); ?></option>
	<option  value="Dancing Script"<?php if($this->value()== 'Dancing Script') echo 'selected="selected"';?>><?php _e('Dancing Script','enigma'); ?></option>
	<option  value="Dawning of a New Day"<?php if($this->value()== 'Dawning of a New Day') echo 'selected="selected"';?>><?php _e('Dawning of a New Day','enigma'); ?></option>
	<option  value="Fredericka the Great"<?php if($this->value()== 'Fredericka the Great') echo 'selected="selected"';?>><?php _e('Fredericka the Great','enigma'); ?></option>
	<option  value="Felipa"<?php if($this->value()== 'Felipa') echo 'selected="selected"';?>><?php _e('Felipa','enigma'); ?></option>
	<option  value="Give You Glory"<?php if($this->value()== 'Give You Glory') echo 'selected="selected"';?>><?php _e('Give You Glory','enigma'); ?></option>
	<option  value="Great vibes"<?php if($this->value()== 'Great vibes') echo 'selected="selected"';?>><?php _e('Great vibes','enigma'); ?></option>
	<option  value="Homemade Apple"<?php if($this->value()== 'Homemade Apple') echo 'selected="selected"';?>><?php _e('Homemade Apple','enigma'); ?></option>
	<option  value="Indie Flower"<?php if($this->value()== 'Indie Flower') echo 'selected="selected"';?>><?php _e('Indie Flower','enigma'); ?></option>
	<option  value="Italianno"<?php if($this->value()== 'Italianno') echo 'selected="selected"';?>><?php _e('Italianno','enigma'); ?></option>
	<option  value="Jim Nightshade"<?php if($this->value()== 'Jim Nightshade') echo 'selected="selected"';?>><?php _e('Jim Nightshade','enigma'); ?></option>
	<option  value="Kaushan Script"<?php if($this->value()== 'Kaushan Script') echo 'selected="selected"';?>><?php _e('Kaushan Script','enigma'); ?></option>
	<option  value="Kristi"<?php if($this->value()== 'Kristi') echo 'selected="selected"';?>><?php _e('Kristi','enigma'); ?></option>
	<option  value="La Belle Aurore"<?php if($this->value()== 'La Belle Aurore') echo 'selected="selected"';?>><?php _e('La Belle Aurore','enigma'); ?></option>
	<option  value="Meddon"<?php if($this->value()== 'Meddon') echo 'selected="selected"';?>><?php _e('Meddon','enigma'); ?></option>
	<option  value="Montez"<?php if($this->value()== 'Montez') echo 'selected="selected"';?>><?php _e('Montez','enigma'); ?></option>
	<option  value="Megrim"<?php if($this->value()== 'Megrim') echo 'selected="selected"';?>><?php _e('Megrim','enigma'); ?></option>
	<option  value="Mr Bedfort"<?php if($this->value()== 'Mr Bedfort') echo 'selected="selected"';?>><?php _e('Mr Bedfort','enigma'); ?></option>
	<option  value="Neucha"<?php if($this->value()== 'Neucha') echo 'selected="selected"';?>><?php _e('Neucha','enigma'); ?></option>
	<option  value="Nothing You Could Do"<?php if($this->value()== 'Nothing You Could Do') echo 'selected="selected"';?>><?php _e('Nothing You Could Do','enigma'); ?></option>
	<option  value="Open Sans"<?php if($this->value()== 'Open Sans') echo 'selected="selected"';?>><?php _e('Open Sans','enigma'); ?></option>
	<option  value="Over the Rainbow"<?php if($this->value()== 'Over the Rainbow') echo 'selected="selected"';?>><?php _e('Over the Rainbow','enigma'); ?></option>
	<option  value="Pinyon Script"<?php if($this->value()== 'Pinyon Script') echo 'selected="selected"';?>><?php _e('Pinyon Script','enigma'); ?></option>
	<option  value="Princess Sofia"<?php if($this->value()== 'Princess Sofia') echo 'selected="selected"';?>><?php _e('Princess Sofia','enigma'); ?></option>
	<option  value="Reenie Beanie"<?php if($this->value()== 'Reenie Beanie') echo 'selected="selected"';?>><?php _e('Reenie Beanie','enigma'); ?></option>
	<option  value="Rochester"<?php if($this->value()== 'Rochester') echo 'selected="selected"';?>><?php _e('Rochester','enigma'); ?></option>
	<option  value="Rock Salt"<?php if($this->value()== 'Rock Salt') echo 'selected="selected"';?>><?php _e('Rock Salt','enigma'); ?></option>
	<option  value="Ruthie"<?php if($this->value()== 'Ruthie') echo 'selected="selected"';?>><?php _e('Ruthie','enigma'); ?></option>
	<option  value="Sacramento"<?php if($this->value()== 'Sacramento') echo 'selected="selected"';?>><?php _e('Sacramento','enigma'); ?></option>
	<option  value="Sans Serif"<?php if($this->value()== 'Sans Serif') echo 'selected="selected"';?>><?php _e('Sans Serif','enigma'); ?></option>
	<option  value="Seaweed Script"<?php if($this->value()== 'Seaweed Script') echo 'selected="selected"';?>><?php _e('Seaweed Script','enigma'); ?></option>
	<option  value="Shadows Into Light"<?php if($this->value()== 'Shadows Into Light') echo 'selected="selected"';?>><?php _e('Shadows Into Light','enigma'); ?></option>
	<option  value="Smythe"<?php if($this->value()== 'Smythe') echo 'selected="selected"';?>><?php _e('Smythe','enigma'); ?></option>
	<option  value="Stalemate"<?php if($this->value()== 'Stalemate') echo 'selected="selected"';?>><?php _e('Stalemate','enigma'); ?></option>
	<option  value="Tahoma"<?php if($this->value()== 'Tahoma') echo 'selected="selected"';?>><?php _e('Tahoma','enigma'); ?></option>
	<option  value="Tangerine"<?php if($this->value()== 'Tangerine') echo 'selected="selected"';?>><?php _e('Tangerine','enigma'); ?></option>
	<option  value="Trade Winds"<?php if($this->value()== 'Trade Winds') echo 'selected="selected"';?>><?php _e('Trade Winds','enigma'); ?></option>
	<option  value="UnifrakturMaguntia"<?php if($this->value()== 'UnifrakturMaguntia') echo 'selected="selected"';?>><?php _e('UnifrakturMaguntia','enigma'); ?></option>
	<option  value="Waiting for the Sunrise"<?php if($this->value()== 'Waiting for the Sunrise') echo 'selected="selected"';?>><?php _e('Waiting for the Sunrise','enigma'); ?></option>
	<option  value="Warnes"<?php if($this->value()== 'Warnes') echo 'selected="selected"';?>><?php _e('Warnes','enigma'); ?></option>
	<option  value="Yesteryear"<?php if($this->value()== 'Yesteryear') echo 'selected="selected"';?>><?php _e('Yesteryear','enigma'); ?></option>
	<option  value="Zeyada"<?php if($this->value()== 'Zeyada') echo 'selected="selected"';?>><?php _e('Zeyada','enigma'); ?></option>
    </select>		
		
  <?php
 }
}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Enigma_Customizer_Icon_Picker_Control' ) ) :
	class Enigma_Customizer_Icon_Picker_Control extends WP_Customize_Control {
		public function enqueue() {
			wp_enqueue_script( 'fontawesome-iconpicker', get_stylesheet_directory_uri() . '/iconpicker-control/assets/js/fontawesome-iconpicker.min.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'iconpicker-control', get_stylesheet_directory_uri() . '/iconpicker-control/assets/js/iconpicker-control.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_style( 'fontawesome-iconpicker', get_stylesheet_directory_uri() . '/iconpicker-control/assets/css/fontawesome-iconpicker.min.css' );
		}
		
		
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<div class="input-group icp-container">
					<input data-placement="bottomRight" class="icp icp-auto" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" type="text">
					<span class="input-group-addon"></span>
				</div>
			</label>
			<?php
		}
	}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'enigma_Custom_sortable_Control' ) ) :
class enigma_Custom_sortable_Control extends WP_Customize_Control
{
    public $type = 'home-sortable';
    /*Enqueue resources for the control*/
    public function enqueue()
    {

        wp_enqueue_style('customizer-repeater-admin-stylesheet', get_template_directory_uri() . '/assets/customizer_js_css/css/enigma-admin-style.css', time());

        wp_enqueue_script('customizer-repeater-script', get_template_directory_uri() . '/assets/customizer_js_css/js/enigma-customizer_repeater.js', array('jquery', 'jquery-ui-draggable'), time(), true);

    }
    public function render_content()
    {
        if (empty($this->choices)) {
            return;
        }
        $values = json_decode($this->value());
        $name         = $this->id;
        ?>

		<span class="customize-control-title">
			<?php echo esc_attr($this->label); ?>
		</span>

		<?php if (!empty($this->description)): ?>
			<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
		<?php endif;?>

		<div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
			<?php 
			if(!empty($values)){ 
				foreach ($values as $value) {?>
					<div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable ui-sortable-handle">
					<div class="customizer-repeater-customize-control-title">
						<?php echo $this->choices[$value]; ?>
					</div>
					<input type="hidden" class="section-id" value="<?php echo $value; ?>">
					</div>	
				<?php }?>
				
			<?php }else{
			foreach ($this->choices as $value => $label): ?>
					<div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable ui-sortable-handle">
					<div class="customizer-repeater-customize-control-title">
						<?php echo $label; ?>
					</div>
					<input type="hidden" class="section-id" value="<?php echo $value; ?>">
					</div>

				<?php endforeach;
			}
        		if (!empty($value)) {?>
					<input type="hidden"
					       id="customizer-repeater-<?php echo $this->id; ?>-colector" <?php esc_url($this->link());?>
					       class="customizer-repeater-colector"
					       value="<?php echo esc_textarea(json_encode($value)); ?>"/>
					<?php
				} else {?>
					<input type="hidden"
					       id="customizer-repeater-<?php echo $this->id; ?>-colector" <?php esc_url($this->link());?>
					       class="customizer-repeater-colector"/>
					<?php
				}?>
		</div>
		<?php
}
}
endif;

function sanitize_json_string($json){
    $sanitized_value = array();
    foreach (json_decode($json,true) as $value) {
        $sanitized_value[] = esc_attr($value);
    }
    return json_encode($sanitized_value);
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'One_Page_Editor' ) ) :
/* Class to create a custom tags control */
class One_Page_Editor extends WP_Customize_Control {	
	private $include_admin_print_footer = false;
	private $teeny = false;
	public $type = 'text-editor';
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['include_admin_print_footer'] ) ) {
			$this->include_admin_print_footer = $args['include_admin_print_footer'];
		}
		if ( ! empty( $args['teeny'] ) ) {
			$this->teeny = $args['teeny'];
		}
	}
	/* Enqueue scripts */
	public function enqueue() {
		wp_enqueue_script( 'one_lite_text_editor', get_template_directory_uri() . '/inc/customizer-page-editor/js/one-lite-text-editor.js', array( 'jquery' ), false, true );
	}
	/* Render the content on the theme customizer page */
	public function render_content() {
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
		<?php
		$settings = array(
			'textarea_name' => $this->id,
			'teeny' => $this->teeny,
		);
		$control_content = $this->value();
		wp_editor( $control_content, $this->id, $settings );

		if ( $this->include_admin_print_footer === true ) {
			do_action( 'admin_print_footer_scripts' );
		}
	}
}
endif;

function show_on_front() {
	if(is_front_page())
	{
		return is_front_page() && 'posts' !== get_option( 'show_on_front' );
	}
	elseif(is_home()) 
	{
		return is_home();
	}
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'enigma_changelog_Control' ) ) :
class enigma_changelog_Control extends WP_Customize_Control {

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() { ?>
		<label style="overflow: hidden; zoom: 1;">
						
			<div class="col-md-3 col-sm-6">
				<h2 style="margin-top:10px;color:#fff;background-color: #3ca3e0;padding: 10px;font-size: 19px;"><?php echo _e( 'Enigma Theme Changelog','enigma'); ?></h2>
				<ul style="padding-top:20px">
				<li class="upsell-enigma"> <div class="versionhd"> Version: 4.1 - <span> Current Version </span></div>
		<ol> <li> Category option added for blog. </li></ol></li>
				<li class="upsell-enigma"> <div class="versionhd"> Version: 4.0 - </div>
		<ol> <li> Review Request Banner dismiss option added. </li></ol></li>
				<li class="upsell-enigma"> <div class="versionhd"> Version: 3.9 - </div>
		<ol> <li> Snow effect option added. </li></ol></li>
				<li class="upsell-enigma"> <div class="versionhd"> Version: 3.8 - </div>
		<ol> <li> Animation feature added in Slider Option. </li><li> Snow effect added. </li></ol></li>
		<li class="upsell-enigma"> <div class="versionhd"> Version: 3.7 - </div>
		<ol> <li> Minor changes in functions.php </li></ol></li>
						<li class="upsell-enigma"> <div class="versionhd"> Version: 3.6 - </div>
		<ol> <li> Quick Edit option added </li></ol></li>				
	<li class="upsell-enigma"> <div class="versionhd"> Version: 3.5 - </div>
		<ol> <li> Editor in Service section added.</li><li> HomePage Section manager  added. </li><li>User Rating Banner.</li></ol> </li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 3.4 - </div>
		<ol> <li> Icon picker feature added in Service Options. </li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 3.3 - </div>
		<ol> <li> New feature add in Blog Option. </li><li> Excerpt Option added. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 3.2 - </div>
		<ol> <li> Minor changes in header. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 3.1 - </div>
		<ol> <li>Minor changes in header.</li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 3.0 - </div>
		<ol> <li> Minor changes. </li></ol></li>				
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.9 - </div>
		<ol> <li> Extra Section for Child-Theme. </li><li> Coupon Code added. </li></ol> </li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.8.6 - </div>
		<ol> <li> Appointment Schedular plugin added in plugin recommendation. </li><li> Logo/Site Title Center feature added. </li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.8.5 - </div>
		<ol> <li> Minor changes in custom header. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 2.8.4 - </div>
		<ol> <li> Gallery bug fixed. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 2.8.3 - </div>
		<ol> <li>Header text color support added.</li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.8.2 - </div>
		<ol> <li> Snow effect removed. </li> <li> Minor issue Fixed..</li></ol></li>				
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.8.1 - </div>
		<ol> <li> Slider interval added.</li></ol> </li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.8 - </div>
		<ol> <li> Custom-header image added. </li><li>FontAwesome library updated version 4.7.0 </li><li>Snow effect added </li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.7.2 - </div>
		<ol> <li>Minor Update in Social Icons [whatsapp link]. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd">Version: 2.7.1 - </div>
		<ol> <li> Minor Fixes. </li><li> Updated Pro Themes and Plugins Page with features. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 2.7 - </div>
		<ol> <li>FA library.</li><li> More social icon added in header and footer. </li></ol></li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 2.6 - </div>
		<ol> <li> Plugin Recommandation. </li><li>Minor Fix.</li><li> Tags updated.</li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 2.5 - </div>
		<ol> <li>Updated Pro Themes and Plugins Page with Upcoming Premium Theme Features.</li><li> Minor Issue Fixed. </li>
		</ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.4.3 - </div>
		<ol> <li> Minor issue fixed. </li> <li> Link updated in Pro themes.</li><li> Twitter spelling corretions.</li></ol></li>				
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.4.2 - </div>
		<ol> <li>woocomerce minor fix. </li> <li> Updated Pro Themes and Plugins Page with features. </li></ol></li>


	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.4.1 - </div>
		<ol> <li> Minor issue fixed. </li></ol></li>				
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.4 - </div>
		<ol> <li> Update Pro Themes and Plugins Page with features. </li><li> Minor Google Font issue fixed. </li></ol> </li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.3 - </div>
		<ol> <li> Google font option added. </li><li> Some other minor issue fixed. </li><li>Remove Theme Option Page. </li><li>Service Link Added in Customizer. </li><li> Service On/Off.</li><li> Footer-Call-Out icon setting added.</li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 2.2 - </div>
		<ol> <li> Mobile Menus Fix. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 2.1 - </div>
		<ol> <li> Parallax Layout in *Premium Theme added.. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 2.0 - </div>
		<ol> <li> Menus Fixes. </li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.9.8 - </div>
		<ol> <li> MENU HOVER ISSUE FIXED. </li></ol></li>				
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.9.7 - </div>
		<ol> <li> Minor bradcrumb Fix. </li><li> Screen-reader Class Added. </li></ol> </li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.9.6 - </div>
		<ol> <li> Minor home page Issue Fixed. </li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.9.5 - </div>
		<ol> <li> Some Customizr Issue Fixed. </li><li> Minor Plugin Conflict-ion Solved. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 1.9.4 - </div>
		<ol> <li> Minor Issue Fixed. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 1.9.3 - </div>
		<ol> <li>Theme option panel are customize ready.</li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.9.2 - </div>
		<ol> <li> Footer Call-Out Issue Fixed. </li> <li> Search Box Issue Fixed.</li></ol></li>				
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.9.1 - </div>
		<ol> <li> WPML Competible.</li></ol> </li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.9 - </div>
		<ol> <li> Russian mo file. </li><li>Slider - Text -Button viewable in Mob. </li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.8.9 - </div>
		<ol> <li>Mobile Slider Text Fixed. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd">Version: 1.8.8 - </div>
		<ol> <li> Minor Translation added. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 1.8.6 - </div>
		<ol> <li>Minor Fixes in Header and Footer</li></ol></li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 1.8.5 - </div>
		<ol> <li> Checked() implimented. </li><li>Home-Blog Show / Hide settings added in Theme-Options.</li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 1.8.4 - </div>
		<ol> <li>Menu Ipad/Mobile Issue Fixed.</li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.8.3 - </div>
		<ol> <li> RTL Support. </li> <li> Breadcrumb Fix.</li><li> HTML W3C Validated.</li></ol></li>				
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.8.2 - </div>
		<ol> <li>Custom Static Front-Page on Page. </li> </ol></li>

	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.8 - </div>
		<ol> <li> Custom Static Front-Page. </li></ol></li>				
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.7.2 - </div>
		<ol> <li> Unminified JS. </li></ol> </li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.7.1 - </div>
		<ol> <li> Title Repetition Removed. </li><li> Unused JS file removed. </li><li> Page with Left Sidebar added. </li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.7 - </div>
		<ol> <li> Editor added in Theme-Options. </li><li>Discount Coupon Removed.</li><li> FA link updated.</li><li> Portfolio Link Title fixed.</li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 1.6.1 - </div>
		<ol> <li> Minor Translated String. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 1.6 - </div>
		<ol> <li> Snow Effects in Theme-Options. </li><li> Two More SOcial Icons.</li><li> iPad Drop-Down Fixed.</li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.5.1 - </div>
		<ol> <li> Minor FIX in blog file. </li><li>Log image to add css for mobile view</li></ol></li>				
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.5 - </div>
		<ol> <li> Minor FIX. </li></ol> </li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.4.3 - </div>
		<ol> <li> DATE Format Issue Fixed. </li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.4.2 - </div>
		<ol> <li> All Issue Raised By Reviewer Fixed. </li><li> iPAD menu Issue Fixed. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 1.4 - </div>
		<ol> <li> Child theme ready. </li><li> Social media link modify with #. ( Advise by gpriday )</li><li>Menu Implementation for mobiles.</li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd"> Version: 1.3 - </div>
		<ol> <li>Top Menu Implementation.</li><li> Woo-commerce Ready.</li><li> Full-Width Page.</li><li>Telephone Icon Issue Fixed. </li><li> Search URL issue Fixed.</li><li> Admin side Image Added.</li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.2 - </div>
		<ol> <li> Sane Default Concept added. </li></ol></li>				
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.1 - </div>
		<ol> <li> comment_function Issue fixed.</li><li>White Space Issue Fixed. </li><li>Portfolio Check box Enable. </li></ol> </li>
	<li class="upsell-enigma"> <div class="versionhd"> Version: 1.0 - </div>
		<ol> <li> Rest all issue fixed. </li></ol></li>
	<li class="upsell-enigma"> <div class="versionhd"> Version 0.99 - </div>
		<ol> <li> Issue raised after first review removed here. </li></ol> </li>
	<li class="upsell-enigma">  <div class="versionhd">Version 0.9.5 released </div></li>
			</ul>
			</div>
			<div class="col-md-2 col-sm-6 upsell-btn">					
					<a style="margin-bottom:20px;margin-left:20px;" href="<?php echo esc_url(get_template_directory_uri()) ?>/readme.txt" target="blank" class="btn btn-success btn"><?php _e('Changelog','enigma'); ?> </a>
			</div>
		</label>
		<?php
	}
}
endif;


if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'enigma_animation' ) ) :
class enigma_animation extends WP_Customize_Control {

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() { ?>
	 <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	<?php 
	$animation = array('fadeIn' ,'fadeInUp','fadeInDown','fadeInLeft','fadeInRight' ,'bounceIn','bounceInUp','bounceInDown', 'bounceInLeft','bounceInRight','rotateIn','rotateInUpLeft','rotateInDownLeft','rotateInUpRight','rotateInDownRight',);?>
				
			<select name="animate_slider" class="webriti_inpute" <?php $this->link(); ?>>
				<?php foreach( $animation as $animate) { ?>
					<option value="<?php echo $animate; ?>" <?php echo selected($animate_slider, $animate ); ?>><?php echo $animate; ?></option>
				<?php } ?>
			</select>
	<?php
	}
}
endif;

/* class for categories */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'enigma_category_Control' ) ) :
class enigma_category_Control extends WP_Customize_Control 
{   public function render_content(){ ?>
		<span class="customize-control-title"><?php echo $this->label; ?></span>
		<?php  $enigma_category = get_categories(); ?>
		<select <?php $this->link(); ?> >
			<?php foreach($enigma_category as $category){ ?>
				<option value= "<?php echo $category->term_id; ?>" <?php if($this->value()=='') echo 'selected="selected"';?> ><?php echo $category->cat_name; ?></option>
			<?php } ?>
		</select> <?php
	}  /* public function ends */
}/*   class ends */
endif; 
?>