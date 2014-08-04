<?php
//This is a module for pluck, an opensource content management system
//Website: http://www.pluck-cms.org

//MODULE NAME: RSS Reader
//DESCRIPTION: this modules lets an user add an RSS Feed to a page
//Make sure the file isn't accessed directly
defined('IN_PLUCK') or exit('Access denied!');

function read_style($theme) {
	$temp = 'data/themes/' . $theme . '/style.css';
	$file = file_get_contents($temp);
	return $file;
}

function save_style($theme, $content) {
	$temp = 'data/themes/' . $theme . '/style.css';
	$file = fopen($temp, 'w');
	$content = stripslashes($content);
	fputs($file, $content);
	fclose($file);
}

function read_themes($theme) {
	$temp2 = 'data/themes/' . $theme . '/theme.php';
	$file = file_get_contents($temp2);
	return $file;
}

function save_themes($theme, $content) {
	$temp2 = 'data/themes/' . $theme . '/theme.php';
	$file = fopen($temp2, 'w');
	$content = stripslashes($content);
	fputs($file, $content);
	fclose($file);
}

function editor_pages_admin() {

	$module_page_admin[] = array(
		'func'  => 'Main',
		'title' => 'Choose to edit the template file or the CSS file.'
	);
	$module_page_admin[] = array(
		'func'  => 'Theme',
		'title' => 'Theme Editor'
	);
	$module_page_admin[] = array(
		'func'  => 'CSS',
		'title' => 'CSS Editor'
	);
	
	$module_page_admin[] = array(
		'func'  => 'Info',
		'title' => 'PHP Info'
	);
	
	return $module_page_admin;
}

function editor_page_admin_Main() {
	showmenudiv("Edit your css file","It allows you to edit your css file",'data/modules/editor/images/css.png','admin.php?module=editor&page=CSS',false);
	showmenudiv("Edit your Theme file","It allows you to edit your template file",'data/modules/editor/images/theme.png','admin.php?module=editor&page=Theme',false);
	showmenudiv("Info","PHPInfo",'data/modules/editor/images/theme.png','admin.php?module=editor&page=Info',false);
}

function editor_page_admin_Theme() {
	//Allow modules to manipulate theme
	$page_theme = THEME;
	run_hook('site_theme', array(&$page_theme));
	$temp2 = read_themes($page_theme);
?>
	<form method="post" action="">
		<label class="kop2" for="cont1">Content of theme file</label>
		<br />
		<textarea name="cont1" id="cont1" cols="90" rows="20"><?php echo $temp2; ?></textarea>
		<br />
		<input type="submit" name="Submit" value="Submit" />
		<input type="button" name="Cancel" value="Cancel" onclick="javascript: window.location='admin.php?module=editor';" />
	</form>
<?php
	//Save style.
	if (isset($_POST['Submit'])) {
		$cont1 = $_POST['cont1'];
		save_themes($page_theme, $cont1);
		redirect('admin.php?module=editor', 0);
	}
	echo "<p><a href=\"?module=editor\"><<< Back</a></p>";
}
 
function editor_page_admin_CSS() {
$page_theme = THEME;
run_hook('site_theme', array(&$page_theme));

	$temp2 = read_style($page_theme);
?>
	<form method="post" action="">
		<label class="kop2" for="cont1">Content of CSS file</label>
		<br />
		<textarea name="cont1" id="cont1" cols="90" rows="20"><?php echo $temp2; ?></textarea>
		<br />
		<input type="submit" name="Submit" value="Submit" />
		<input type="button" name="Cancel" value="Cancel" onclick="javascript: window.location='admin.php?module=editor';" />
	</form>
<?php
	//Save style.
	if (isset($_POST['Submit'])) {
		$cont1 = $_POST['cont1'];
		save_style($page_theme, $cont1);
		redirect('admin.php?module=editor', 0);
	}
	echo "<p><a href=\"?module=editor\"><<< Back</a></p>";
}
 
function editor_page_admin_Info() {
	phpinfo();
	echo "<p><a href=\"?module=editor\"><<< Back</a></p>";
}
?>
