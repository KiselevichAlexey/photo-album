<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

	<ul class="list-unstyled">
	<?foreach($arResult as $arItem):?>

		<?if ($arItem["PERMISSION"] > "D"):?>
			<li><a href="<?=$arItem["LINK"]?>" class="text-white"><?=$arItem["TEXT"]?></a></li>
		<?endif?>

	<?endforeach;
		if(!CUser::IsAuthorized()){?>
			<li><a href="/auth/" class="text-white"><?=GetMessage('SIGN_IN');?></a></li>
			<li><a href="/register/" class="text-white"><?=GetMessage('REGISTRATION');?></a></li>
		<?}else{?>
			<li><a  class="text-white"
					href="<?echo $APPLICATION->GetCurPageParam("logout=yes&".bitrix_sessid_get(), array(
								"login",
								"logout",
								"register",
								"forgot_password",
								"change_password"));?>"
					><?=GetMessage('LOGOUT');?>
				</a></li>
		<?}?>	
	</ul>
<?endif?>  
                
                