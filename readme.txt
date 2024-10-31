=== Profile Picture ===
Contributors: aruljayarajs
Tags: user profile picture, custom profile picture, user photo, profile picture, profile photo, user avatar, user profile
Requires at least: 3.0
Tested up to: 4.5.2
Stable tag: 1.0
Donate link: 
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Set a profile picture as your wish using media upload.

== Description ==

Users can set his profile picture from admin end and as well as Front End. 

Admin End it would come automatically based on the user role, who has `upload_files` capability, otherwise we need to assign capability to them.

In Front End when we use `<?php do_action('edit_user_profile',$current_user); ?>` on edit profile section, it would be placed on additonal user profile fields.

*Future Updates: Display current user images alone, short code and migrate withsocial media profile pictures.

== Installation ==

1. Upload `profile-picture` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Profile in admin end / Go to profile edit in front end  

Note: If you want to add this feature to default scbscribers and contributors, Enable this action hook `<?php add_action('admin_init', array($this,'allow_uploads_permission') ); ?>` from the `ProfilePicture` class.

== Frequently Asked Questions ==

= Profile Picture upload permissions about users? =

Currently, who has the capability of upload_files they can upload profile pictures.
Editors and Admins can upload and edit files.
Authors can only upload files.
Subscribers and Contributors cannot do either Need to enable `add_action('admin_init', array($this,'allow_uploads_permission') ) in our class file`.

= How to show the profile image in frontend? = 

We can show our customized profile picture in front end whereever you want with registered image sizes. You may use wordpress <strong>get_avatar() function by default, else user our customized one it serves by your wish.</strong>. 
`<?php 
$ppimg = ProfilePicture::pp_picture($id_or_email, $width, $height, $alt);
?>`
<strong>id_or_email</strong> (integer|string|object) (required  ) You may pass user id, email or user object here.

<strong>width</strong> (integer) (optional) Width of the image.

<strong>height</strong> (integer) (optional) Width of the image.

<strong>alt</strong> (string) (optional) alt title of image tag.

<strong>Return Values</strong> It would return profile picture details as array or false on failure.

== Screenshots ==

1. Add profile image field in admin end.

2. After uploading and saving your selected image.

3. Show the same profile image feature in front end.

== Changelog ==

= 1.0 =
Beta Release

== Upgrade Notice == 

= 1.0 =
Beta Release