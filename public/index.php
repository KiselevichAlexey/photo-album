<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?><?$APPLICATION->IncludeComponent(
	"bitrix:photo.sections.top", 
	"albums", 
	array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"ELEMENT_COUNT" => "1",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "content",
		"LINE_ELEMENT_COUNT" => "1",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SECTION_COUNT" => "10",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_SORT_FIELD" => "timestamp_x",
		"SECTION_SORT_ORDER" => "asc",
		"SECTION_URL" => "#SITE_DIR#/albums/#SECTION_CODE#/",
		"SECTION_USER_FIELDS" => array(
			0 => "UF_AUTHOR",
			1 => "",
		),
		"COMPONENT_TEMPLATE" => "albums"
	),
	false
);?><?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>