<?php

if (!class_exists('Spintax_Public')) {
	class Spintax_Public
	{

		private $plugin_name;
		private $version;

		public function __construct($plugin_name, $version)
		{
			$this->plugin_name = $plugin_name;
			$this->version = $version;
		}

		public function enqueue_styles()
		{
			// Styles are no longer needed
		}

		public function enqueue_scripts()
		{
			// Scripts are no longer needed
		}

		private function is_builder_context()
		{
			global $post;

			if (isset($_GET['bricks']) && $_GET['bricks'] === 'builder') {
				return true;
			}

			if (function_exists('Elementor\Plugin') && \Elementor\Plugin::$instance->preview->is_preview_mode() && \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID)) {
				return true;
			}
			if (function_exists('Elementor\Plugin') && \Elementor\Plugin::$instance->preview->is_edit_mode() && \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID)) {
				return true;
			}

			if (is_admin() && function_exists('get_current_screen')) {
				$screen = get_current_screen();
				if ($screen && $screen->is_block_editor) {
					return true;
				}
			}

			return false;
		}

		public function start_output_buffering()
		{
			// Skip admin pages
			if (is_admin())
				return;

			// Skip AJAX requests (admin-ajax.php)
			if (defined('DOING_AJAX') && DOING_AJAX)
				return;
			if (function_exists('wp_doing_ajax') && wp_doing_ajax())
				return;

			// Skip REST API requests (/wp-json/)
			if (defined('REST_REQUEST') && REST_REQUEST)
				return;

			// Skip WP Cron
			if (defined('DOING_CRON') && DOING_CRON)
				return;

			// Skip XML-RPC
			if (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST)
				return;

			// Skip WP CLI
			if (defined('WP_CLI') && WP_CLI)
				return;

			// Skip WordPress Customizer preview
			if (is_customize_preview())
				return;

			// Skip Bricks Builder contexts
			if (isset($_GET['bricks']) && $_GET['bricks'] === 'builder')
				return;
			if (function_exists('bricks_is_ajax_call') && bricks_is_ajax_call())
				return;
			if (defined('BRICKS_DB_PAGE_HEADER') || defined('BRICKS_DB_PAGE_FOOTER')) {
				if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'bricks') !== false)
					return;
			}

			// Skip Elementor contexts
			if (isset($_GET['elementor-preview']) || isset($_GET['action']) && $_GET['action'] === 'elementor')
				return;
			if (class_exists('\\Elementor\\Plugin')) {
				$elementor = \Elementor\Plugin::$instance;
				if ($elementor && isset($elementor->preview) && $elementor->preview->is_preview_mode())
					return;
				if ($elementor && isset($elementor->editor) && $elementor->editor->is_edit_mode())
					return;
			}

			ob_start(array($this, 'process_spintax'));
		}

		public function process_spintax($buffer)
		{
			// Only process HTML responses — skip JSON, XML, etc.
			$trimmed = ltrim($buffer);
			if (
				empty($trimmed) ||
				$trimmed[0] === '{' ||
				$trimmed[0] === '[' ||
				substr($trimmed, 0, 5) === '<?xml'
			) {
				return $buffer;
			}

			// Process {word1|word2} — requires at least one pipe to avoid matching JSON/CSS/JS
			$buffer = preg_replace_callback('/\{([^{}|]+(?:\|[^{}|]+)+)\}/', function ($matches) {
				$words = explode('|', $matches[1]);
				return $words[array_rand($words)];
			}, $buffer);

			// Process ~word1|word2~ — requires at least one pipe
			$buffer = preg_replace_callback('/~([^~|]+(?:\|[^~|]+)+)~/', function ($matches) {
				$words = explode('|', $matches[1]);
				return $words[array_rand($words)];
			}, $buffer);

			return $buffer;
		}
	}

} // end class_exists guard
