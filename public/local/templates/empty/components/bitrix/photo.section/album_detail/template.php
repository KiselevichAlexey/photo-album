<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<main role="main">
	<section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Album example</h1>
          <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
          <p>
            <a href="<?=$arResult['SECTION_PAGE_URL']?>upload/" class="btn btn-primary my-2"><?=GetMessage('ADD_PHOTO')?></a>
            <!-- <a href="#" class="btn btn-secondary my-2">Secondary action</a> -->
          </p>
        </div>
      </section>
	  <div  class="album py-5 bg-light">
        <div class="container">  
			  <div class="row">

	<?foreach($arResult["ROWS"] as $arItems):?>
		<?foreach($arItems as $arItem):?>
			<?if(is_array($arItem)):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BPS_ELEMENT_DELETE_CONFIRM')));
				$resizeImg = CFile::ResizeImageGet( $arItem['PREVIEW_PICTURE'], array('width' => 348,'height' => 225), BX_RESIZE_IMAGE_PROPORTIONAL);
				$img = $resizeImg['src'];	
				?>
				<div id="<?=$this->GetEditAreaId($arItem['ID']);?>"  class="col-md-4">
				<div class="card mb-4 box-shadow">
					<img class="card-img-top" data-src="<?=$img?>" alt="Thumbnail [100%x225]" src="<?=$img?>" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
					<div class="card-body">
						<?if($arItem['NAME']):?>
							<p class="card-text"><?=$arItem['NAME']?></p>
						<?endif;?>	
						<?if($arItem['DESCRIPTION']):?>
							<p class="card-text"><?=$arItem['DESCRIPTION']?></p>
						<?endif;?>		
					<div class="d-flex justify-content-between align-items-center">
						<small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
			
		<?endif;?>
		<?endforeach?>
	<?endforeach?>
	</div>    
 		</div>
    </div>
</main>