<?php
/**
* Plugin Name: Insert Post Ads
* Plugin URI: http://www.wpbeginner.com/
* Version: 1.0.6
* Author: WPBeginner
* Author URI: http://www.wpbeginner.com/
* Description: Allows you to insert ads after paragraphs of your post content
* License: GPL2
*/

/*  Copyright 2014 WPBeginner

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
* Insert Post Ads Class
*/
class InsertPostAds {
	/**
	* Constructor
	*/
	public function __construct() {

		// Plugin Details
        $this->plugin               = new stdClass;
        $this->plugin->name         = 'insert-post-ads'; // Plugin Folder
        $this->plugin->displayName  = 'Post Adverts'; // Plugin Name
        $this->plugin->posttype 	= 'insertpostads';
        $this->plugin->version      = '1.0.6';
        $this->plugin->folder       = plugin_dir_path( __FILE__ );
        $this->plugin->url          = plugin_dir_url( __FILE__ );

        // Dashboard Submodule
        if (!class_exists('WPBeginnerDashboardWidget')) {
			require_once($this->plugin->folder.'/_modules/dashboard/dashboard.php');
		}
		$this->dashboard = new WPBeginnerDashboardWidget($this->plugin); 
		
		// Hooks
		add_action('init', array( &$this, 'registerPostTypes'));
        add_action('admin_enqueue_scripts', array(&$this, 'adminScriptsAndCSS'));
        add_action('admin_menu', array(&$this, 'adminPanelsAndMetaBoxes'));
        add_action('plugins_loaded', array(&$this, 'loadLanguageFiles'));
        add_action('save_post', array(&$this, 'save'));
        
        // Filters
		add_filter('enter_title_here', array(&$this, 'changeTitlePlaceholder')); // Change title placeholder
		add_filter('post_updated_messages', array(&$this, 'changeUpdatedMessages')); // Appropriate messages for the post type	
		add_filter('the_content', array(&$this, 'checkAdvertsRequired'));
	}
	
	/**
	* Register Custom Post Type
	*/
	function registerPostTypes() {
		register_post_type($this->plugin->posttype, array(
            'labels' => array(
                'name' => _x('Post Adverts', 'post type general name'),
                'singular_name' => _x('Post Advert', 'post type singular name'),
                'add_new' => _x('Add New', 'insertpostads'),
                'add_new_item' => __('Add New Post Advert'),
                'edit_item' => __('Edit Post Advert'),
                'new_item' => __('New Post Advert'),
                'view_item' => __('View Post Adverts'),
                'search_items' => __('Search Post Adverts'),
                'not_found' =>  __('No post adverts found'),
                'not_found_in_trash' => __('No post adverts found in Trash'), 
                'parent_item_colon' => ''
            ),
            'description' => 'Post Adverts',
            'public' => false,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-migrate',
            'capability_type' => 'post',
            'hierarchical' => false,
            'has_archive' => false,
            'show_in_nav_menus' => false,
            'supports' => array('title'),
        )); 
	}

	/**
    * Register and enqueue any JS and CSS for the WordPress Administration
    */
    function adminScriptsAndCSS() {
    	// JS
    	// wp_enqueue_script($this->plugin->name.'-admin', $this->plugin->url.'js/admin.js', array('jquery'), $this->plugin->version, true);
    	        
    	// CSS
        wp_enqueue_style($this->plugin->name.'-admin', $this->plugin->url.'css/admin.css', array(), $this->plugin->version); 
    }
	
	/**
    * Register the plugin settings panel
    */
    function adminPanelsAndMetaBoxes() {
        add_submenu_page('edit.php?post_type='.$this->plugin->posttype, __('Settings', $this->plugin->name), __('Settings', $this->plugin->name), 'manage_options', $this->plugin->name, array(&$this, 'adminPanel'));
		add_meta_box('ipa_meta', __('Advert Code', $this->plugin->name), array( &$this, 'displayMetaBox'), $this->plugin->posttype, 'normal', 'high');
		$postTypes = get_post_types(array(
			'public' => true,
		), 'objects');
		if ($postTypes) {
			foreach ($postTypes as $postType) {
				// Skip attachments
				if ($postType->name == 'attachment') {
					continue;
				}
				
				// Skip our CPT
				if ($postType->name == $this->plugin->posttype) {
					continue;
				}
				add_meta_box('ipa_meta', __($this->plugin->displayName, $this->plugin->name), array( &$this, 'displayOptionsMetaBox'), $postType->name, 'normal', 'high');
			}
		}
		
    }
    
    /**
    * Output the Administration Panel
    * Save POSTed data from the Administration Panel into a WordPress option
    */
    function adminPanel() {
    	// Save Settings
        if (isset($_POST['submit'])) {
        	if (isset($_POST[$this->plugin->name])) {
        		delete_option($this->plugin->name);
        		update_option($this->plugin->name, $_POST[$this->plugin->name]);
				$this->message = __('Post Advert Settings Saved.', $this->plugin->name);
			}
        }
        
        // Get latest settings
        $this->settings = get_option($this->plugin->name);
        
		// Load Settings Form
        include_once(WP_PLUGIN_DIR.'/'.$this->plugin->name.'/views/settings.php');  
    }
    
    /**
	* Loads plugin textdomain
	*/
	function loadLanguageFiles() {
		load_plugin_textdomain($this->plugin->name, false, $this->plugin->name.'/languages/');
	}
	
	/**
	* Displays the meta box on the Custom Post Type
	*
	* @param object $post Post
	*/
	function displayMetaBox($post) {
		// Get meta
		$adCode = get_post_meta($post->ID, '_ad_code', true);
		$adPosition = get_post_meta($post->ID, '_ad_position', true);
		$paragraphNumber = get_post_meta($post->ID, '_paragraph_number', true);
		
		// Nonce field
		wp_nonce_field($this->plugin->name, $this->plugin->name.'_nonce');
		?>
		<p>
			<textarea name="ad_code" id="ad_code" style="width: 100%; height: 100px; font-family: Courier; font-size: 12px;"><?php echo $adCode; ?></textarea>
		</p>
		<p>
			<label for="ad_position"><?php _e('Display the advert:', $this->plugin->name); ?></label>
			<select name="ad_position" size="1">
				<option value="top"<?php echo (($adPosition == 'top') ? ' selected' : ''); ?>><?php _e('Before Content', $this->plugin->name); ?></option>
				<option value=""<?php echo (($adPosition == '') ? ' selected' : ''); ?>><?php _e('After Paragraph Number', $this->plugin->name); ?></option>
				<option value="bottom"<?php echo (($adPosition == 'bottom') ? ' selected' : ''); ?>><?php _e('After Content', $this->plugin->name); ?></option>
			</select>
			<input type="number" name="paragraph_number" value="<?php echo $paragraphNumber; ?>" min="1" max="999" step="1" id="paragraph_number" />
		</p>
		<?php
	}
	
	/**
	* Displays the meta box on Pages, Posts and CPTs
	*
	* @param object $post Post
	*/
	function displayOptionsMetaBox($post) {
		// Get meta
		$disable = get_post_meta($post->ID, '_ipa_disable_ads', true);
		
		// Nonce field
		wp_nonce_field($this->plugin->name, $this->plugin->name.'_nonce');
		?>
		<p>
			<label for="ipa_disable_ads"><?php _e('Disable Adverts', $this->plugin->name); ?></label>
			<input type="checkbox" name="ipa_disable_ads" id="ipa_disable_ads" value="1"<?php echo ($disable ? ' checked' : ''); ?> />
		</p>
		<p class="description">
			<?php _e('Check this option if you wish to disable all Post Ads from displaying on this content.', $this->plugin->name); ?>
		</p>
		<?php
	}
	
	/**
	* Saves the meta box field data
	*
	* @param int $post_id Post ID
	*/
	function save($post_id) {
		// Check if our nonce is set.
		if (!isset($_POST[$this->plugin->name.'_nonce'])) {
			return $post_id;	
		}
		
		// Verify that the nonce is valid.
		if (!wp_verify_nonce($_POST[$this->plugin->name.'_nonce'], $this->plugin->name)) {
			return $post_id;
		}
		
		// Check the logged in user has permission to edit this post
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
	    
		// OK to save meta data
		if (isset($_POST['ipa_disable_ads'])) {
			update_post_meta($post_id, '_ipa_disable_ads', $_POST['ipa_disable_ads']);	
		} else {
			delete_post_meta($post_id, '_ipa_disable_ads');
		}
		
		if (isset($_POST['ad_code'])) {
			update_post_meta($post_id, '_ad_code', $_POST['ad_code']);
		}
		if (isset($_POST['ad_position'])) {
			update_post_meta($post_id, '_ad_position', $_POST['ad_position']);
		}
		if (isset($_POST['paragraph_number'])) {
			update_post_meta($post_id, '_paragraph_number', $_POST['paragraph_number']);
		}
	}
	
	/**
	* Changes the 'Enter title here' placeholder on the Ad Custom Post Type
	*
	* @param string $title Title
	* @return string Title
	*/
	function changeTitlePlaceholder($title) {
		global $post;
		if ($post->post_type == $this->plugin->posttype) {
			$title = __('Advert Title', $this->plugin->name);
		}

		return $title;
	}
	
	/**
	* Updates the saved, deleted, updated messages when saving an Ad Custom Post Type
	*
	* @param array $messages Messages
	* @return array Messages
	*/
	function changeUpdatedMessages($messages) {
		$messages[$this->plugin->posttype] = array(
			1 =>  	__('Advert updated.', $this->plugin->name),
		    2 => 	__('Advert updated.', $this->plugin->name),
		    3 => 	__('Advert deleted.', $this->plugin->name),
		    4 => 	__('Advert updated.', $this->plugin->name),
			6 => 	__('Advert published.', $this->plugin->name),
		);

		return $messages;
	}
	
	/**
	* Checks if the current screen on the frontend needs advert(s) adding to it
	*/
	function checkAdvertsRequired($content) {
		global $post;
		
		// Settings
		$this->settings = get_option($this->plugin->name);
		if (!is_array($this->settings)) {
			return $content;
		}
		if (count($this->settings) == 0) {
			return $content;
		}
		
		// Check if we are on a singular post type that's enabled
		foreach ($this->settings as $postType=>$enabled) {
			if (is_singular($postType)) {
				// Check the post hasn't disabled adverts
				$disable = get_post_meta($post->ID, '_ipa_disable_ads', true);
				if (!$disable) {
					return $this->insertAds($content);
				}
			}
		}
		
		return $content;
	}
	
	/**
	* Inserts advert(s) into content
	*
	* @param string $content Content
	* @return string Content
	*/
	function insertAds($content) {
		$ads = new WP_Query(array(
			'post_type' => $this->plugin->posttype,
			'post_status' => 'publish',
			'posts_per_page' => -1,
		));	
		if ($ads->have_posts()) {
			while ($ads->have_posts()) {
				$ads->the_post();
				
				$adID = get_the_ID();
				$adCode = get_post_meta($adID, '_ad_code', true);
				$adPosition = get_post_meta($adID, '_ad_position', true);
				$paragraphNumber = get_post_meta($adID, '_paragraph_number', true);
				
				switch ($adPosition) {
					case 'top':
						$content = $adCode.$content;
						break;
					case 'bottom':
						$content = $content.$adCode;
						break;
					default:
						$content = $this->insertAdAfterParagraph($adCode, $paragraphNumber , $content);
						break;
				}
			}
		}
		
		wp_reset_postdata();
		return $content;
	}
	
	/**
	* Insert something after a specific paragraph in some content.
	*
	* @param  string $insertion    Likely HTML markup, ad script code etc.
	* @param  int    $paragraph_id After which paragraph should the insertion be added. Starts at 1.
	* @param  string $content      Likely HTML markup.
	*
	* @return string               Likely HTML markup.
	*/
	function insertAdAfterParagraph( $insertion, $paragraph_id, $content ) {
		$closing_p = '</p>';
		$paragraphs = explode( $closing_p, $content );
		foreach ($paragraphs as $index => $paragraph) {
			// Only add closing tag to non-empty paragraphs
			if ( trim( $paragraph ) ) {
				// Adding closing markup now, rather than at implode, means insertion
				// is outside of the paragraph markup, and not just inside of it.
				$paragraphs[$index] .= $closing_p;
			}

			// + 1 allows for considering the first paragraph as #1, not #0.
			if ( $paragraph_id == $index + 1 ) {
				$paragraphs[$index] .= '<div class="'.$this->plugin->name.'"'.(isset($this->settings['css']) ? '' : ' style="clear:both;float:left;width:100%;margin:0 0 20px 0;"').'>'. $insertion .'</div>';
			}
		}
		return implode( '', $paragraphs );
	}
}
		
$insertPostAds = new InsertPostAds();
?>