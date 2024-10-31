<?php
$upload_dir = wp_upload_dir(); 
$pp_url = get_user_meta($user->ID, 'pp_url', true);
$buttontxt =  (!empty($pp_url)? "Change Profile Picture" : "Add Profile Picture");
$imgstyle =  (!empty($pp_url)? "display:block;" : "display:none;");
?>
<h3>Profile Picture</h3>
<table class="form-table" border="0">
    <tbody>
        <tr class="user-picture-wrap">
            <th><label for="picutre">Set Your Profile Picture</label></th>
            <td>
                <div class="pp-container">
                    <div class="pp-picture" style="<?php echo $imgstyle; ?>">
                        <img class="pp_url" src="<?php echo $upload_dir['baseurl'].$pp_url; ?>" alt="Profile Picture" width="150" />
                        <a class="pp_delete" href="javascript:void(0);">
                            <img src="<?php echo PP_PLUGIN_ASSETS_URL; ?>/images/trash.png" alt="Remove" title="Remove" width="24" />
                        </a>                            
                    </div>
                </div>               
                <input id="pp_button" type="button" class="button" value="<?php echo $buttontxt; ?>" />
                <input id="pp_url" type="hidden" name="pp_url" value="<?php echo $pp_url; ?>" />
            </td>
        </tr>        
    </tbody>
</table>