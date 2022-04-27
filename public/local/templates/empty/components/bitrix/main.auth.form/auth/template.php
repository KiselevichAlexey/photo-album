<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>
<div class="text-center">
	<form class="form-signin" name="<?= $arResult['FORM_ID'];?>" method="post" target="_top" >
	  <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
	  <h1 class="h3 mb-3 font-weight-normal"><?= Loc::getMessage('MAIN_AUTH_FORM_HEADER');?></h1>
	  <div class="mess"></div>
	  <label for="inputEmail" class="sr-only"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_LOGIN');?></label>
	  <input type="text" name="<?= $arResult['FIELDS']['login'];?>" id="inputEmail" class="form-control" placeholder="<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_LOGIN');?>"  value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>" autofocus="">
	  <label for="inputPassword" class="sr-only"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_PASS');?></label>
	  <input type="password" name="<?= $arResult['FIELDS']['password'];?>" id="inputPassword" class="form-control mt-1" placeholder="<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_PASS');?>"  autocomplete="off">
	  
		<?if ($arResult['STORE_PASSWORD'] == 'Y'):?>
			<div class="checkbox mb-3">
			<label>
				<input type="checkbox" id="USER_REMEMBER" name="<?= $arResult['FIELDS']['remember'];?>" value="Y"> <?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_REMEMBER');?>
			</label>
			</div>
	  	<?endif?>

	  <input type="submit" class="btn btn-lg btn-primary btn-block" name="<?= $arResult['FIELDS']['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_SUBMIT');?>" />
		<?if ($arResult['AUTH_FORGOT_PASSWORD_URL'] || $arResult['AUTH_REGISTER_URL']):?>
			<hr class="bxe-light">
			<noindex>

			<?if ($arResult['AUTH_FORGOT_PASSWORD_URL']):?>
				<div class="bx-authform-link-container">
					<a href="<?= $arResult['AUTH_FORGOT_PASSWORD_URL'];?>" rel="nofollow">
						<?= Loc::getMessage('MAIN_AUTH_FORM_URL_FORGOT_PASSWORD');?>
					</a>
				</div>
			<?endif;?>
			<?if ($arResult['AUTH_REGISTER_URL']):?>
				<div class="bx-authform-link-container">
					<a href="<?= $arResult['AUTH_REGISTER_URL'];?>" rel="nofollow">
						<?= Loc::getMessage('MAIN_AUTH_FORM_URL_REGISTER_URL');?>
					</a>
				</div>
			<?endif;?>
			</noindex>
		<?endif;?>

	  <p class="mt-5 mb-3 text-muted"><?= Loc::getMessage('COPY');?></p>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.form-signin').submit(function(e){
			e.preventDefault();
			let form = $(this);
			let mess = $('.mess');
			let btn = form.find('input[type="submit"]');
			let password = form.find('input[type="password"]')
			mess.html('');
			btn.addClass('progress-bar-striped progress-bar-animated')
			$.ajax({
				url: "/ajax/auth.php",
				type: 'POST',
				data: form.serialize(),
				success: function (data) {
					btn.removeClass('progress-bar-striped progress-bar-animated')
					if(JSON.parse(data)){
						mess.html('<div class="alert alert-success"><?= Loc::getMessage('MAIN_AUTH_FORM_SUCCESS');?></div>');
						window.setTimeout(document.location.replace('/'),1000);
					} else {
						mess.html('<div class="alert alert-danger"><?= Loc::getMessage('AUTH_ERR');?></div>');
						password.val("");
					}
				},
				error: function () {
					btn.removeClass('progress-bar-striped progress-bar-animated')
					mess.html('<div class="alert alert-danger"><?= Loc::getMessage('ERR');?></div>');
				}
			})
		})
	});
</script>

<script type="text/javascript">
	<?if ($arResult['LAST_LOGIN'] != ''):?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>