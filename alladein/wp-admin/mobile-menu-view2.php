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
<h2>View Menu</h2>

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
error_reporting(E_ERROR|E_PARSE);
$sql = "SELECT * FROM mainmenu";
$res = mysql_query($sql) or die (mysql_error());
$rowcheck = mysql_num_rows($res);

$query = "SELECT * FROM mainmenu";
$result = mysql_query($query) or die (mysql_error());
$row = mysql_fetch_assoc($result);
	if(isset($_POST['Delete']))
	{
	$cnt = array();
	@$cnt = count($_POST['checked']);
	
	foreach(@$_POST['checked'] as $file)
	{
	$query = "SELECT image FROM mainmenu WHERE ID=$file";
	$result = mysql_query($query) or die (mysql_error());
	$row = mysql_fetch_assoc($result);
	$image = $row["image"];
	
	unlink($image) or die ("Failed to <strong class='highlight'>delete</strong> file");

	header("Refresh:0");
	}
	
	for($i=0;$i<$cnt;$i++)
	{
	$id=$_POST['checked'][$i];
	$query="DELETE FROM mainmenu WHERE ID=".$id;
	mysql_query($query);
	}
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

function confirmDelete(str){
var agree=confirm("Are you sure you want to delete the voucher?");
if(agree==true)
{
     window.location="http://ncn.com.my/megamenu-main-menu/delete.php?post_type=page&ID="+str;
	 
	 }
else
{
	 return false;
	 }
}

function selectAll(source) {
		checkboxes = document.getElementsByName('checked[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}
	
</script>
<form action="" method="post" enctype="multipart/form-data">
<center>
<input type="button" name="Add" value="Add" onclick="document.location.href='http://ncn.com.my/wp-admin/mobile-menu-add2.php?post_type=page';"/> 
<input type="Submit" name="Delete" value="Delete" onClick="confirmDelete('<?php echo $row['ID']; ?>')"/>
</center>
<?php 
echo "<center>";
echo "<p>";
if($rowcheck==0){
echo "<center>";
echo "    ";
echo "<font color='000000' size='5' face='Times New Roman'><div align='top'>The record is empty. The data is not found.";
echo "</center>";
}else{		
echo "<table border='1'>
<tbody>
<tr>
<td> <div align ='left'><input type='checkbox' id='selectall' onClick='selectAll(this)'/>Select All</div> </td>
<td> Name </td>
<td> Link </td>
<td> Parent or Child </td>
<td> Delete </td>
<td> Edit </td> 
</tr>";

while($row = mysql_fetch_array($res)){
echo "<tr>
<td>
<input type='checkbox' name='checked[]' value='".$row['ID']."'>
</td>


<td>". $row['name']. "</td>";


echo "<td>". $row['url']. "</td>";

echo "<td>";
if($row['parent']=='0'){
	echo 'Parent';
} else{
	echo 'Child';
}
echo "</td>";


echo "<td>";
echo '<div align="right"><a href="#"' ?> onClick="confirmDelete('<?php echo $row['ID']; ?>')"  <?php echo '>Delete</a>';
echo "</td>";


echo "<td>
<div align='right'><a href='http://ncn.com.my/wp-admin/mobile-menu-edit2.php?post_type=page&ID=".$row['ID']."' onClick='_gap.push([\'_trackEvent\',\'Join',\'Home\',\'BigButton\']);'>Edit</a>
</td>";
}
echo "</tbody>";
echo "</table>";
echo "</p>";
echo "</center>";
}
?></div>
<input type="hidden" name="ID" value="<?php echo $row['ID'];?>">
</form>
</body>
</html>

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
