<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$mess = [];

if($_POST["NAME"] !== ''){
    $name = trim($_POST["NAME"]);
    $arParams = array("replace_space" => "-","replace_other" => "-");
    $code = Cutil::translit($_POST['NAME'],"ru",$arParams);
} else {
    $mess['NAME'] = 'Введите название альбома';
};

if($_POST["DESCRIPTION"]){
    $description = trim($_POST["DESCRIPTION"]);
}else{
    $mess['DESCRIPTION'] = 'Введите описание альбома';
}

if(!$mess){
    if(CModule::IncludeModule("iblock")){
        $BS = new CIBlockSection;
        $arFields = Array(
            "MODIFIED_BY"      =>$USER->GetLogin(),
            "ACTIVE"       => "Y",
            "CODE"       => $code,
            "UF_AUTHOR"       => $USER->GetLogin(),
            "IBLOCK_ID"       => "1",
            "NAME"          => $name,
            "SORT"          => "500",
            "DESCRIPTION"    => $description, 
            "DESCRIPTION_TYPE"    => "text" 
            );
    }
    
    if ($ID = $BS->Add($arFields)) {
        $mess['SUCCES'] = "Альбом $name создан";
    } else {
        if($BS->LAST_ERROR == 'Раздел с таким символьным кодом уже существует.<br>'){
            $mess['NAME'] = 'Альбом с таким название существует';
        }
    }
}
echo json_encode($mess);
?>