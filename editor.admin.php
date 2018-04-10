<?php
//This is a module for pluck, an opensource content management system
//Website: http://www.pluck-cms.org

//MODULE NAME: RSS Reader
//DESCRIPTION: this modules lets an user add an RSS Feed to a page
//Make sure the file isn't accessed directly
defined('IN_PLUCK') or exit('Access denied!');
function read_style($theme) {
	return file_get_contents('data/themes/' . $theme . '/style.css');
}

function save_style($theme, $content) {
	$file = fopen('data/themes/' . $theme . '/style.css', 'w');
	$content = stripslashes($content);
	fputs($file, $content);
	fclose($file);
}

function read_themes($theme) {
	return file_get_contents('data/themes/' . $theme . '/theme.php');
}

function save_themes($theme, $content) {
	$file = fopen('data/themes/' . $theme . '/theme.php', 'w');
	$content = stripslashes($content);
	fputs($file, $content);
	fclose($file);
}

function editor_pages_admin() {
	global $lang;

	$module_page_admin[] = array(
		'func'  => 'Main',
		'title' => $lang['editor']['main']
	);
	$module_page_admin[] = array(
		'func'  => 'Theme',
		'title' => $lang['editor']['theme']
	);
	$module_page_admin[] = array(
		'func'  => 'CSS',
		'title' => $lang['editor']['css']
	);
	
	$module_page_admin[] = array(
		'func'  => 'Info',
		'title' => $lang['editor']['info']
	);
	
	return $module_page_admin;
}

function editor_page_admin_Main() {
	global $lang;

	showmenudiv($lang['editor']['edit_css'],$lang['editor']['edit_css_info'],'data/modules/editor/images/css.png','admin.php?module=editor&page=CSS',false);
	showmenudiv($lang['editor']['edit_theme'],$lang['editor']['edit_theme_info'],'data/modules/editor/images/theme.png','admin.php?module=editor&page=Theme',false);
	showmenudiv($lang['editor']['edit_info'],$lang['editor']['edit_info_info'],'data/modules/editor/images/theme.png','admin.php?module=editor&page=Info',false);
}

function editor_page_admin_Theme() {
	//Allow module to manipulate theme
	$page_theme = THEME;
	run_hook('site_theme', array(&$page_theme));
	global $lang;
?>
	<form method="post" action="">
		<label class="kop2" for="cont1"><?php echo $lang['editor']['content_theme']; ?></label>
		<br />
		<textarea name="cont1" id="cont1" cols="90" rows="20" class="mceNoEditor"><?php echo read_themes($page_theme); ?></textarea>
		<br />
		<input type="submit" name="Submit" value="<?php echo $lang['general']['save']; ?>" />
		<input type="button" name="Cancel" value="<?php echo $lang['general']['cancel']; ?>" onclick="javascript: window.location='admin.php?module=editor';" />
	</form>
	<script type="text/javascript">tinymce.remove('textarea');</script>
<?php
	//Save style.
	if (isset($_POST['Submit'])) {
		$cont1 = $_POST['cont1'];
		save_themes($page_theme, $cont1);
		redirect('admin.php?module=editor', 0);
	}
}
 
function editor_page_admin_CSS() {
	//Allow module to manipulate css
	$page_theme = THEME;
	run_hook('site_theme', array(&$page_theme));
	global $lang;
?>
	<form method="post" action="">
		<label class="kop2" for="cont1"><?php echo $lang['editor']['content_css']; ?></label>
		<br />
		<textarea name="cont1" id="cont1" cols="90" rows="20" class="mceNoEditor"><?php echo read_style($page_theme); ?></textarea>
		<br />
		<input type="submit" name="Submit" value="<?php echo $lang['general']['save']; ?>" />
		<input type="button" name="Cancel" value="<?php echo $lang['general']['cancel']; ?>" onclick="javascript: window.location='admin.php?module=editor';" />
	</form>
	<script type="text/javascript"> tinymce.remove('textarea');</script>
<?php
	//Save style.
	if (isset($_POST['Submit'])) {
		$cont1 = $_POST['cont1'];
		save_style($page_theme, $cont1);
		redirect('admin.php?module=editor', 0);
	}
}
 
function editor_page_admin_Info() {
	echo "<p><a href=\"?module=editor\"><<< Back</a></p>";
	phpinfo();
	echo "<p><a href=\"?module=editor\"><<< Back</a></p>";
}
?>