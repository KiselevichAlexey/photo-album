<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>

<div class="text-center">
	<form class="form-register" name="<?= $arResult['FORM_ID'];?>" method="post" target="_top" >
		<img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
		<h1 class="h3 mb-3 font-weight-normal"><?=GetMessage("AUTH_REGISTER")?></h1>
		<div class="mess"></div>

		<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
				<label for="REGISTER[<?=$FIELD?>]" class="sr-only"><?=GetMessage("REGISTER_FIELD_".$FIELD)?></label>
				<?
				switch ($FIELD)
				{	
					case "LOGIN":?>
						<input type="text" name="<?=$FIELD?>" class="form-control mt-1 d-none" id="REGISTER[<?=$FIELD?>]" 
							placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>*<?endif?>" value="<?=$arResult["VALUES"][$FIELD]?>" />
					<?	break;		
					case "PASSWORD":
					case "CONFIRM_PASSWORD":
						?>
						<input type="password" name="<?=$FIELD?>" class="form-control mt-1" id="REGISTER[<?=$FIELD?>]" 
							placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>*<?endif?>" autocomplete="off" value="<?=$arResult["VALUES"][$FIELD]?>" />
						<?
						break;
					default:
					?>
						<input type="text" name="<?=$FIELD?>" class="form-control mt-1" id="REGISTER[<?=$FIELD?>]" 
							placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>*<?endif?>" value="<?=$arResult["VALUES"][$FIELD]?>" />
				<?}?>
			
		<?endforeach?>

		<input type="submit" class="btn btn-lg btn-primary btn-block mt-3" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" />	
		<hr class="bxe-light">
				<div class="bx-authform-link-container">
					<a href="/auth/" rel="nofollow">
						<?=GetMessage('AUTH');?>
					</a>
				</div>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.form-register').submit(function(e){
			e.preventDefault();
			let form = $(this);
			let mess = $('.mess');
			let btn = form.find('input[type="submit"]');
			let password = form.find('input[type="password"]')
			mess.html('');
			$('smal.text-danger').remove();
			btn.addClass('progress-bar-striped progress-bar-animated')
			$.ajax({
				url: "/ajax/register.php",
				type: 'POST',
				data: form.serialize(),
				success: function (json) {
					let data = JSON.parse(json);
					btn.removeClass('progress-bar-striped progress-bar-animated')
					if(data){
						for (key in data) {
							$('input[name="'+ key +'"]').after(()=> '<smal class="text-danger">' + data[key] + '</smal>')
						}
					} else {
						mess.html('<div class="alert alert-success"><?=GetMessage('MAIN_REGISTER_AUTH');?></div>');
						window.setTimeout(document.location.replace('/auth/'),1000);
					}
				},
				error: function () {
					btn.removeClass('progress-bar-striped progress-bar-animated')
					mess.html('<div class="alert alert-danger"><?=GetMessage('ERR');?></div>');
				}
			})
		})
	});
</script>
