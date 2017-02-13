<?php
/**
 * Edit Posts Administration Screen.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once( './admin.php' );






if ( ! $typenow )
	wp_die( __( 'Invalid post type' ) );

$post_type = $typenow;
$post_type_object = get_post_type_object( $post_type );

if ( ! $post_type_object )
	wp_die( __( 'Invalid post type' ) );

if ( ! current_user_can( $post_type_object->cap->edit_posts ) )
	wp_die( __( 'Cheatin&#8217; uh?' ) );

$wp_list_table = _get_list_table('WP_Posts_List_Table');
$pagenum = $wp_list_table->get_pagenum();

// Back-compat for viewing comments of an entry
foreach ( array( 'p', 'attachment_id', 'page_id' ) as $_redirect ) {
	if ( ! empty( $_REQUEST[ $_redirect ] ) ) {
		wp_redirect( admin_url( 'edit-comments.php?p=' . absint( $_REQUEST[ $_redirect ] ) ) );
		exit;
	}
}
unset( $_redirect );

if ( 'post' != $post_type ) {
	$parent_file = "edit.php?post_type=$post_type";
	$submenu_file = "edit.php?post_type=$post_type";
	$post_new_file = "post-new.php?post_type=$post_type";
} else {
	$parent_file = 'edit.php';
	$submenu_file = 'edit.php';
	$post_new_file = 'post-new.php';
}

$doaction = $wp_list_table->current_action();

if ( $doaction ) {
	check_admin_referer('bulk-posts');

	$sendback = remove_query_arg( array('trashed', 'untrashed', 'deleted', 'ids'), wp_get_referer() );
	if ( ! $sendback )
		$sendback = admin_url( $parent_file );
	$sendback = add_query_arg( 'paged', $pagenum, $sendback );
	if ( strpos($sendback, 'post.php') !== false )
		$sendback = admin_url($post_new_file);

	if ( 'delete_all' == $doaction ) {
		$post_status = preg_replace('/[^a-z0-9_-]+/i', '', $_REQUEST['post_status']);
		if ( get_post_status_object($post_status) ) // Check the post status exists first
			$post_ids = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type=%s AND post_status = %s", $post_type, $post_status ) );
		$doaction = 'delete';
	} elseif ( isset( $_REQUEST['media'] ) ) {
		$post_ids = $_REQUEST['media'];
	} elseif ( isset( $_REQUEST['ids'] ) ) {
		$post_ids = explode( ',', $_REQUEST['ids'] );
	} elseif ( !empty( $_REQUEST['post'] ) ) {
		$post_ids = array_map('intval', $_REQUEST['post']);
	}

	if ( !isset( $post_ids ) ) {
		wp_redirect( $sendback );
		exit;
	}

	switch ( $doaction ) {
		case 'trash':
			$trashed = 0;
			foreach( (array) $post_ids as $post_id ) {
			
		
			mysql_query("DELETE FROM wp_content_details WHERE postid='$post_id'");
			

				$trashed++;
			}
			$sendback = add_query_arg( array('trashed' => $trashed, 'ids' => join(',', $post_ids) ), $sendback );
			break;
		case 'untrash':
			$untrashed = 0;
			foreach( (array) $post_ids as $post_id ) {
				if ( !current_user_can($post_type_object->cap->delete_post, $post_id) )
					wp_die( __('You are not allowed to restore this item from the Trash.') );

				if ( !wp_untrash_post($post_id) )
					wp_die( __('Error in restoring from Trash.') );

				$untrashed++;
			}
			$sendback = add_query_arg('untrashed', $untrashed, $sendback);
			break;
		case 'delete':
			$deleted = 0;
			foreach( (array) $post_ids as $post_id ) {
				$post_del = & get_post($post_id);

				if ( !current_user_can($post_type_object->cap->delete_post, $post_id) )
					wp_die( __('You are not allowed to delete this item.') );

				if ( $post_del->post_type == 'attachment' ) {
					if ( ! wp_delete_attachment($post_id) )
						wp_die( __('Error in deleting...') );
				} else {
					if ( !wp_delete_post($post_id) )
						wp_die( __('Error in deleting...') );
				}
				$deleted++;
			}
			$sendback = add_query_arg('deleted', $deleted, $sendback);
			break;
		case 'edit':
			if ( isset($_REQUEST['bulk_edit']) ) {
				$done = bulk_edit_posts($_REQUEST);

				if ( is_array($done) ) {
					$done['updated'] = count( $done['updated'] );
					$done['skipped'] = count( $done['skipped'] );
					$done['locked'] = count( $done['locked'] );
					$sendback = add_query_arg( $done, $sendback );
				}
			}
			break;
	}

	$sendback = remove_query_arg( array('action', 'action2', 'tags_input', 'post_author', 'comment_status', 'ping_status', '_status',  'post', 'bulk_edit', 'post_view'), $sendback );

	wp_redirect($sendback);
	exit();
} elseif ( ! empty($_REQUEST['_wp_http_referer']) ) {
	 wp_redirect( remove_query_arg( array('_wp_http_referer', '_wpnonce'), stripslashes($_SERVER['REQUEST_URI']) ) );
	 exit;
}

$wp_list_table->prepare_items();

wp_enqueue_script('inline-edit-post');

$title = $post_type_object->labels->name;

if ( 'post' == $post_type ) {
	get_current_screen()->add_help_tab( array(
	'id'		=> 'overview',
	'title'		=> __('Overview'),
	'content'	=>
		'<p>' . __('This screen provides access to all of your posts. You can customize the display of this screen to suit your workflow.') . '</p>'
	) );
	get_current_screen()->add_help_tab( array(
	'id'		=> 'screen-content',
	'title'		=> __('Screen Content'),
	'content'	=>
		'<p>' . __('You can customize the display of this screen&#8217;s contents in a number of ways:') . '</p>' .
		'<ul>' .
			'<li>' . __('You can hide/display columns based on your needs and decide how many posts to list per screen using the Screen Options tab.') . '</li>' .
			'<li>' . __('You can filter the list of posts by post status using the text links in the upper left to show All, Published, Draft, or Trashed posts. The default view is to show all posts.') . '</li>' .
			'<li>' . __('You can view posts in a simple title list or with an excerpt. Choose the view you prefer by clicking on the icons at the top of the list on the right.') . '</li>' .
			'<li>' . __('You can refine the list to show only posts in a specific category or from a specific month by using the dropdown menus above the posts list. Click the Filter button after making your selection. You also can refine the list by clicking on the post author, category or tag in the posts list.') . '</li>' .
		'</ul>'
	) );
	get_current_screen()->add_help_tab( array(
	'id'		=> 'action-links',
	'title'		=> __('Available Actions'),
	'content'	=>
		'<p>' . __('Hovering over a row in the posts list will display action links that allow you to manage your post. You can perform the following actions:') . '</p>' .
		'<ul>' .
			'<li>' . __('<strong>Edit</strong> takes you to the editing screen for that post. You can also reach that screen by clicking on the post title.') . '</li>' .
			'<li>' . __('<strong>Quick Edit</strong> provides inline access to the metadata of your post, allowing you to update post details without leaving this screen.') . '</li>' .
			'<li>' . __('<strong>Trash</strong> removes your post from this list and places it in the trash, from which you can permanently delete it.') . '</li>' .
			'<li>' . __('<strong>Preview</strong> will show you what your draft post will look like if you publish it. View will take you to your live site to view the post. Which link is available depends on your post&#8217;s status.') . '</li>' .
		'</ul>'
	) );
	get_current_screen()->add_help_tab( array(
	'id'		=> 'bulk-actions',
	'title'		=> __('Bulk Actions'),
	'content'	=>
		'<p>' . __('You can also edit or move multiple posts to the trash at once. Select the posts you want to act on using the checkboxes, then select the action you want to take from the Bulk Actions menu and click Apply.') . '</p>' .
				'<p>' . __('When using Bulk Edit, you can change the metadata (categories, author, etc.) for all selected posts at once. To remove a post from the grouping, just click the x next to its name in the Bulk Edit area that appears.') . '</p>'
	) );

	get_current_screen()->set_help_sidebar(
	'<p><strong>' . __('For more information:') . '</strong></p>' .
	'<p>' . __('<a href="http://codex.wordpress.org/Posts_Screen" target="_blank">Documentation on Managing Posts</a>') . '</p>' .
	'<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>'
	);

} elseif ( 'page' == $post_type ) {
	get_current_screen()->add_help_tab( array(
	'id'		=> 'overview',
	'title'		=> __('Overview'),
	'content'	=>
		'<p>' . __('Pages are similar to posts in that they have a title, body text, and associated metadata, but they are different in that they are not part of the chronological blog stream, kind of like permanent posts. Pages are not categorized or tagged, but can have a hierarchy. You can nest pages under other pages by making one the &#8220;Parent&#8221; of the other, creating a group of pages.') . '</p>'
	) );
	get_current_screen()->add_help_tab( array(
	'id'		=> 'managing-pages',
	'title'		=> __('Managing Pages'),
	'content'	=>
		'<p>' . __('Managing pages is very similar to managing posts, and the screens can be customized in the same way.') . '</p>' .
		'<p>' . __('You can also perform the same types of actions, including narrowing the list by using the filters, acting on a page using the action links that appear when you hover over a row, or using the Bulk Actions menu to edit the metadata for multiple pages at once.') . '</p>'
	) );

	get_current_screen()->set_help_sidebar(
	'<p><strong>' . __('For more information:') . '</strong></p>' .
	'<p>' . __('<a href="http://codex.wordpress.org/Pages_Screen" target="_blank">Documentation on Managing Pages</a>') . '</p>' .
	'<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>'
	);
}

add_screen_option( 'per_page', array('label' => $title, 'default' => 20) );

require_once('./admin-header.php');

//START HERE
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2>Add New Main Menu</h2>

<?php if ( isset($_REQUEST['locked']) || isset($_REQUEST['skipped']) || isset($_REQUEST['updated']) || isset($_REQUEST['deleted']) || isset($_REQUEST['trashed']) || isset($_REQUEST['untrashed']) ) {
	$messages = array();
?>
<div id="message" class="updated"><p>
<?php if ( isset($_REQUEST['updated']) && (int) $_REQUEST['updated'] ) {
	$messages[] = sprintf( _n( '%s post updated.', '%s posts updated.', $_REQUEST['updated'] ), number_format_i18n( $_REQUEST['updated'] ) );
	unset($_REQUEST['updated']);
}

if ( isset($_REQUEST['skipped']) && (int) $_REQUEST['skipped'] )
	unset($_REQUEST['skipped']);

if ( isset($_REQUEST['locked']) && (int) $_REQUEST['locked'] ) {
	$messages[] = sprintf( _n( '%s item not updated, somebody is editing it.', '%s items not updated, somebody is editing them.', $_REQUEST['locked'] ), number_format_i18n( $_REQUEST['locked'] ) );
	unset($_REQUEST['locked']);
}

if ( isset($_REQUEST['deleted']) && (int) $_REQUEST['deleted'] ) {
	$messages[] = sprintf( _n( 'Item permanently deleted.', '%s items permanently deleted.', $_REQUEST['deleted'] ), number_format_i18n( $_REQUEST['deleted'] ) );
	unset($_REQUEST['deleted']);
}

if ( isset($_REQUEST['trashed']) && (int) $_REQUEST['trashed'] ) {
	$messages[] = sprintf( _n( 'Item moved to the Trash.', '%s items moved to the Trash.', $_REQUEST['trashed'] ), number_format_i18n( $_REQUEST['trashed'] ) );
	$ids = isset($_REQUEST['ids']) ? $_REQUEST['ids'] : 0;
	$messages[] = '<a href="' . esc_url( wp_nonce_url( "edit.php?post_type=$post_type&doaction=undo&action=untrash&ids=$ids", "bulk-posts" ) ) . '">' . __('Undo') . '</a>';
	unset($_REQUEST['trashed']);
}

if ( isset($_REQUEST['untrashed']) && (int) $_REQUEST['untrashed'] ) {
	$messages[] = sprintf( _n( 'Item restored from the Trash.', '%s items restored from the Trash.', $_REQUEST['untrashed'] ), number_format_i18n( $_REQUEST['untrashed'] ) );
	unset($_REQUEST['undeleted']);
}

if ( $messages )
	echo join( ' ', $messages );
unset( $messages );

$_SERVER['REQUEST_URI'] = remove_query_arg( array('locked', 'skipped', 'updated', 'deleted', 'trashed', 'untrashed'), $_SERVER['REQUEST_URI'] );
?>
</p></div>
<?php }
include '../megamenu-main-menu/connect.php';

mysql_query("SET NAMES 'utf8'"); 
mysql_query('SET CHARACTER SET utf8');
$result1 = mysql_query("SELECT MAX(`order`) as odr FROM mainmenu");
while($row = mysql_fetch_array($result1))
  {
  $odr = $row['odr']+1;

  }
?>
<script type="text/javascript" src="http://ncn.com.my/megamenu-main-menu/ckeditor/ckeditor.js"></script>
<script type='text/javascript' src='http://ncn.com.my/megamenu-main-menu/jquery-1.9.2.js'></script>
<script type='text/javascript' >//<![CDATA[ 
$(window).load(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });
});
</script>

<script type="text/javascript">
function thdlevel(str)
{
var xmlhttp;    
if (str=="0")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","http://ncn.com.my/wp-admin/menu-parent-list2.php",true);
xmlhttp.send();
}
</script>

<form action="http://ncn.com.my/megamenu-main-menu/enter.php?post_type=page" method="post" enctype="multipart/form-data">
<table> 
<tbody>
<tr>
<td>Menu Title</td>
<td>:</td>
<td><input type="text" name="name" size="100" value="">
<input type="hidden" name="odr" size="100" value="<?php echo $odr;?>">
</td>
</tr><tr>
<td>Menu Link(URL)</td>
<td>:</td>
<td><input type="text" name="url" size="100" value=""></td>
</tr>
<tr>
<td>Parent or Child</td>
<td>:</td>
<td><select name="parent" onchange='thdlevel(this.value)'>Parent or Child
<option value="" id="parent">---Please Select the Level---</option>
<option value="0">Parent</option>
<option value="1">Child</option>
</select>
</td>
</tr>
<tr>
<td colspan="3">
<div id="txtHint"></div>
</td>
</tr>
<tr>
<td colspan='3' style='text-align: center;'>
<input type='Submit' value='Submit' name='create'/>
<input type="button" value="Cancel" onclick="document.location.href='http://ncn.com.my/wp-admin/mobile-menu-view2.php?post_type=page'" >
</td>
</tr>
</tbody>
</table>

</form>

<?php


if ( $wp_list_table->has_items() )
	$wp_list_table->inline_edit();
?>

<div id="ajax-response"></div>
<br class="clear" />
</div>

<?php
//END HERE


include('./admin-footer.php');
