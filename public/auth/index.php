<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (CUser::IsAuthorized()){
	 LocalRedirect('/'); 
};

$APPLICATION->SetTitle("Авторизация");
?>
<?$APPLICATION->IncludeComponent("bitrix:main.auth.form", "auth", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"AUTH_FORGOT_PASSWORD_URL" => "",	// Страница для восстановления пароля
		"AUTH_REGISTER_URL" => "/register/",	// Страница для регистрации
		"AUTH_SUCCESS_URL" => "/",	// Страница после успешной авторизации
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>