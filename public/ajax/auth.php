<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
if (!is_object($USER)) $USER = new CUser;
$USER->Login($_POST['USER_LOGIN'], $_POST['USER_PASSWORD'], "Y");

echo json_encode($USER->IsAuthorized());
