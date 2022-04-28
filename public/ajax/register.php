<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$err = [];
$_POST['LOGIN'] = $_POST['EMAIL'];
$email = $_POST['EMAIL'];
$cPassword = $_POST['CONFIRM_PASSWORD'];
$password = $_POST['PASSWORD'];
$birthDay = $_POST['PERSONAL_BIRTHDAY'];
$phone = $_POST['PERSONAL_PHONE'];

// login 
$rsUser = CUser::GetByLogin($email);
if($arUser = $rsUser->Fetch()) {
    $err['EMAIL'] = 'Такой Email уже зарегестрирован';
}else{
    if(strlen($email) == 0){
        $err['EMAIL'] = 'Введите Email';

    } else {
        $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
         preg_match($regex, $email) ? 1 : $err['EMAIL'] = 'Не валидный Email';

    }
}
// password
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        $err['PASSWORD'] = "Минимум 8 символов,заглавные буквы и цыфры";

    } elseif($password != $cPassword){
        $err['CONFIRM_PASSWORD'] = 'Пароли не совпадают';
    }
// phone 
if($phone == ''){
    $err['PERSONAL_PHONE'] = 'Введите номер телефона';

}elseif(!preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', $phone)){
    $err['PERSONAL_PHONE']='Не верный номер телефона';
}
//date

$date_arr = explode('.', preg_replace('/[^0-9\.]/u', '', trim($birthDay)));
if(!checkdate($date_arr[1], $date_arr[0], $date_arr[2])) {
    $err['PERSONAL_BIRTHDAY'] = 'Введите дату в формате дд.мм.гггг';
} elseif(strtotime($birthDay) >= strtotime(date("d.m.y"))){
    $err['PERSONAL_BIRTHDAY'] = 'Не верная дата';
}



if(empty($arr)){
    $user = new CUser;
    $ID = $user->Add($_POST);
    if ($ID){
        echo 0;
    }else{
        echo json_encode($err);
    }      
}