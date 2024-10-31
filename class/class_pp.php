<?php
if(class_exists('ProfilePicture')){ return; }
class ProfilePicture{	
	
	public function __construct() {	
		global $wpdb, $post;										
		add_action('admin_enqueue_scripts', array($this,'add_media_upload_scripts'));
		add_action('wp_enqueue_scripts', array($this,'add_media_upload_scripts'));
		//add_action('admin_init', array($this,'allow_uploads_permission') );				

		# Register shortcodes	
		add_filter( 'the_content', 'do_shortcode');	
		add_filter( 'get_avatar', array($this, 'pp_avatar'), 1, 5 );				
		$this->setup_actions();											
	}
	
	public function add_media_upload_scripts() {    
		// Load media script
		wp_enqueue_script('media-upload');
		// Load thickbox
		wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');
		// Load our custom Style		 	
		wp_register_style('ppstyle', PP_PLUGIN_ASSETS_URL."/css/pp.css");	
		wp_enqueue_style('ppstyle');
		wp_register_script('ppscript', PP_PLUGIN_ASSETS_URL."/js/pp.js");
		wp_enqueue_script('ppscript');
		wp_localize_script('ppscript', 'ppvars', array( 'adminurl' => get_admin_url() ) );
	}
	
	public function setup_actions(){
		# For Showing Additional Fields
		add_action( 'show_user_profile', array($this, 'pp_additional_fields') );
		add_action( 'edit_user_profile', array($this, 'pp_additional_fields') );
		# For Saving/Updating Additional Fields
		add_action( 'personal_options_update', array($this, 'pp_custom_profile_fields') );
		add_action( 'edit_user_profile_update', array($this, 'pp_custom_profile_fields') );					
	}
	
	// To Allow permission to Following members
	public function allow_uploads_permission() {
		// To Enable subscribers to upload files
		if ( current_user_can('subscriber') && !current_user_can('upload_files') ){
			$subscriber = get_role('subscriber');
			$subscriber->add_cap('upload_files');			
		}
		// To Enable Contributors to upload files
		if ( current_user_can('contributor') && !current_user_can('upload_files') ){
			$contributor = get_role('contributor');
			$contributor->add_cap('upload_files');					
		}
	}
	
	// To save the profile picture custom fields. 
	public function pp_custom_profile_fields( $user_id ) { 
		// Check if the user has edit permission
		if ( !current_user_can( 'edit_user', $user_id ) )
			return FALSE;				
		update_user_meta( $user_id, 'pp_url', $_POST['pp_url'] );
	}
	
	// For Profile Picture custom fields
	public function pp_additional_fields($user){				
		include_once(PP_PLUGIN_HTML_DIR."/profile_fields.php");
	}
	
	// Overwrite Default avator
	public function pp_avatar( $avatar, $id_or_email, $size, $default, $alt ) {  
		$user = false;
		
		if ( is_numeric( $id_or_email ) ) {
	
			$id = (int) $id_or_email;
			$user = get_user_by( 'id' , $id );
	
		} elseif ( is_object( $id_or_email ) ) {
	
			if ( ! empty( $id_or_email->user_id ) ) {
				$id = (int) $id_or_email->user_id;
				$user = get_user_by( 'id' , $id );
			}
	
		} else {			
			$user = get_user_by( 'email', $id_or_email );   
		}
		
		if ( $user && is_object( $user ) ) {
			$upload_dir = wp_upload_dir(); 
			$pp_url = get_user_meta($user->ID, 'pp_url', true);
			$custom_avatar = $upload_dir['baseurl'].$pp_url;
	
			if (isset($pp_url) && !empty($pp_url)) {
				$avatar = "<img alt='{$alt}' src='{$custom_avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
			}
	
		}
	
		return $avatar;
	}
	
	// Get the Profile Picture details
	public function pp_picture($id_or_email, $width='', $height='', $alt=''){ 
		$user = $avatar = false;
		
		if ( is_numeric( $id_or_email ) ) {
	
			$id = (int) $id_or_email;
			$user = get_user_by( 'id' , $id );
	
		} elseif ( is_object( $id_or_email ) ) {
	
			if ( ! empty( $id_or_email->user_id ) ) {
				$id = (int) $id_or_email->user_id;
				$user = get_user_by( 'id' , $id );
			}
	
		} else {			
			$user = get_user_by( 'email', $id_or_email );   
		}
		
		if ( $user && is_object( $user ) ) {
			$upload_dir = wp_upload_dir(); 
			$pp_url = get_user_meta($user->ID, 'pp_url', true);			
				
			if (isset($pp_url) && !empty($pp_url)) { 
				if( !empty( $width ) && !empty( $height ) ){
					$imgclass = ' avatar-'.$width.'x'.$height;
				}				
				$avatar['url'] = $upload_dir['baseurl'].$pp_url;
				$avatar['img'] = "<img alt='{$alt}' src='{$avatar['url']}' class='avatar photo{$imgclass}' height='{$height}' width='{$width}' />";								
			}else{
				if( !empty( $width ) ){
					$width = 150;	
				}					
				if( ProfilePicture::is_version( '4.2' ) ){  // If WP version greater than 4.2
					$args = get_avatar_data( $curauth->ID, $args=null );   					 				
					$avatar['url'] = $args['url'];				
				}else{  // If WP version less than 4.2
					preg_match("/src='(.*?)'/i", get_avatar( $curauth->ID, $width ), $matches); 					
					$avatar['url'] = $matches[1];
				}
				$avatar['img'] = get_avatar($user->ID);								
			}
			$avatar['author_name'] = get_the_author();
			$avatar['author_url'] = get_author_posts_url( $user->ID );
	
		}		
		return $avatar;
	}
	
	# Check Version Support
	public function is_version( $version ) {
		global $wp_version;		
		if ( version_compare( $wp_version, $version, '>=' ) ) {
			return true;
		}
		return false;
	}


}

?>