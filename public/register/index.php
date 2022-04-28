<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if (CUser::IsAuthorized()){
    LocalRedirect('/'); 
};
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	"register", 
	array(
		"AUTH" => "Y",
		"REQUIRED_FIELDS" => array(
			0 => "PERSONAL_BIRTHDAY",
			1 => "PERSONAL_PHONE",
		),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array(
			0 => "PERSONAL_BIRTHDAY",
			1 => "PERSONAL_PHONE",
		),
		"SUCCESS_PAGE" => "",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y",
		"COMPONENT_TEMPLATE" => "register"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>