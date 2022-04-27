<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
	?>
<!DOCTYPE html>
<html>
	<head>
		<?
		use Bitrix\Main\Page\Asset;
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-3.6.0.min.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrap.min.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/popper.min.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/holder.min.js");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/album.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap.min.css");
		?>
		<?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle();?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 	
	</head>
	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>

						