<?php
	/*
	Plugin Name: phone2app
	Plugin URI: http://phone2app.com/
	Description: Formulario de contacto y click to call para Wordpress. Gestiona tus nuevos contactos desde el móvil con las aplicaciones para Android y Iphone de phone2app y olvídate del panel de Wordpress. Para emprezar: 1) Haz click en activar, 2) Regístrate con tus datos, 3) Descarga la aplicación móvil y configura las opciones, 4) Crea tu primer formulario y ponlo en la web.
	Version: 1.0
	Settings: http://aportamedia.com/
	Author: Aportamedia
	Author URI: http://aportamedia.com/
	*/
	defined('ABSPATH') or die('No script kiddies please!');
	define('PLUGIN_URL', plugin_dir_url(__FILE__));

	// function to create the DB / Options / Defaults
	function phone2app_install() {
		global $wpdb;
		$table_name = $wpdb->prefix . "phone2app_form";
	    $table_nameU =$wpdb->prefix . "phone2app_user";
	    $sql =  "
			DROP TABLE IF EXISTS $table_nameU, $table_name;
			CREATE TABLE $table_nameU(username varchar(200), password varchar(200), PRIMARY KEY ( `username` )) COLLATE = utf8_general_ci;
			CREATE TABLE $table_name( id varchar(11) NOT NULL, link varchar(250), PRIMARY KEY ( `id` ) ) COLLATE = utf8_general_ci;";
/*
		$sql =  "
			CREATE TABLE ".$wpdb->prefix.'phone2app_user'."(username varchar(200), password varchar(200), PRIMARY KEY ( `username` )) COLLATE = utf8_general_ci;
			CREATE TABLE ".$wpdb->prefix.'phone2app_form'."( id varchar(11) NOT NULL, link varchar(250)) COLLATE = utf8_general_ci;
		";
		$wpdb->query($sql);*/
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

	}
	// run the install scripts upon plugin activation
	register_activation_hook(__FILE__, 'phone2app_install');

	add_action('admin_menu', 'phone2app_setup');
	function phone2app_setup(){
	        add_menu_page('phone2app', 'phone2app', 'manage_options', 'p2a', 'display_phone2app_admin', PLUGIN_URL.'/img/icon.png', 6);
	}

	function load_phone2app_wp_admin_style() {
		if (get_current_screen()->id != 'toplevel_page_p2a') {
	        return;
	    }

		wp_register_style('font-awesome', PLUGIN_URL.'/css/font-awesome.min.css', false, '1.0.0' );
		wp_enqueue_style('font-awesome');
		wp_register_style('phone2app_login', PLUGIN_URL.'/css/login.css', false, '1.0.0' );
        wp_enqueue_style('phone2app_login');
		wp_register_style('phone2app_panel', PLUGIN_URL.'/css/panel.css', false, '1.0.0' );
        wp_enqueue_style('phone2app_panel');
		wp_register_style('phone2app_responsive', PLUGIN_URL.'/css/responsive.css', false, '1.0.0' );
		wp_enqueue_style('phone2app_responsive');
		wp_register_style('phone2app_switch', PLUGIN_URL.'/css/uiswitch.css', false, '1.0.0' );
        wp_enqueue_style('phone2app_switch');

		wp_enqueue_script('jquery');
		wp_enqueue_script('angular_js', PLUGIN_URL.'/js/vendor/angular.js');
		wp_enqueue_script('parse_js', PLUGIN_URL.'/js/vendor/parse-1.6.7.min.js');
		wp_enqueue_script('crypto_js', PLUGIN_URL.'/js/vendor/aes.js');
		wp_enqueue_script('phone2app_admin_js', PLUGIN_URL.'/js/app.js');

		$params = array(
		  'path' => PLUGIN_URL
		);
		wp_localize_script( 'phone2app_admin_js', 'WordPressParams', $params );

	}
	add_action('admin_enqueue_scripts', 'load_phone2app_wp_admin_style' );

	function display_phone2app_admin(){
		//echo '<link rel="stylesheet" href="' . PLUGIN_URL . '/css/phone2app-admin.css" />';
		echo file_get_contents(PLUGIN_URL."/admin/admin-page.html");
	}

	function phone2app_init(){

		echo "<script>
			if (!$) $ = jQuery;
			if (!$) console.error('phone2app requires jQuery.');
			$.get('".PLUGIN_URL."phone2appFormService.php',function(r){
				console.log(r);
				script = document.createElement('script');
			    script.onload = function(){
			        // remote script has loaded
			    };
			    script.src = JSON.parse(r).link;
			    document.getElementsByTagName('head')[0].appendChild(script);
			});


		</script>";
        //echo "<h1>Hello World!</h1>";
	}
	add_action('wp_head', 'phone2app_init');
