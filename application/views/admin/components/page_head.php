<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $meta_title; ?></title>
	<!-- Bootstrap -->
	<link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo site_url('assets/css/admin.css?css=' . time()); ?>" rel="stylesheet">

	<script src="<?php echo site_url('assets/js/jquery-1.9.1.min.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/handlebars.min.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/bootstrap.min.js'); ?>"></script>

	<?php if(isset($sortable) && $sortable === TRUE): ?>
		<script src="<?php echo site_url('assets/js/jquery-ui-1.9.1.custom.min.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/jquery.mjs.nestedSortable.min.js'); ?>"></script>
	<?php endif; ?>

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="icon" href="favicon.ico" type="image/x-icon" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- TinyMCE -->
	<script type="text/javascript" src="<?php echo site_url('assets/js/tiny_mce/tiny_mce.js'); ?>"></script>
	<script type="text/javascript">
		tinyMCE.init({
			// General options
			mode : "textareas",
			theme : "advanced",
			editor_selector : "tinymce",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
		});
	</script>
	<!-- /TinyMCE -->
</head>