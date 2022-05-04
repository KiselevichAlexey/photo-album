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
            <a href="/albums/add_album/" class="btn btn-primary my-2"><?=GetMessage('ADD_ALBUM')?></a>
            <!-- <a href="#" class="btn btn-secondary my-2">Secondary action</a> -->
          </p>
        </div>
      </section>
	  <div  class="album py-5 bg-light">
        <div class="container">  
			  <div class="row">
<?foreach($arResult["SECTIONS"] as $arSection):?>
	<?
	$this->AddEditAction('section_'.$arSection['ID'], $arSection['ADD_ELEMENT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_ADD"), array('ICON' => 'bx-context-toolbar-create-icon'));
	$this->AddEditAction('section_'.$arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction('section_'.$arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BPS_SECTION_DELETE_CONFIRM')));
	?>
	
		<?
			$img = $arSection['ITEMS'][0]['PREVIEW_PICTURE'];
			if($img){
				$resizeImg = CFile::ResizeImageGet( $img, array('width' => 348,'height' => 225), BX_RESIZE_IMAGE_PROPORTIONAL);
				$img = $resizeImg['src'];	
			}else{
				$img =SITE_TEMPLATE_PATH.'/img/no-img.svg';
			}
		?>
            <div id="<?=$this->GetEditAreaId('section_'.$arSection['ID']);?>"  class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" data-src="<?=$img?>" alt="Thumbnail [100%x225]" src="<?=$img?>" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                <div class="card-body">
				<?if($arSection['NAME']):?>
					<p class="card-text"><?=$arSection['NAME']?></p>
				<?endif;?>	
				<?if($arSection['DESCRIPTION']):?>
					<p class="card-text"><?=$arSection['DESCRIPTION']?></p>
				<?endif;?>	
				<?if($arSection['UF_AUTHOR']):?>
					<p class="card-text"><?=$arSection['UF_AUTHOR']?></p>
				<?endif;?>	
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
					<a href="<?=$arSection['SECTION_PAGE_URL']?>"  class="btn btn-sm btn-outline-secondary"><?=GetMessage('VIEW')?></a>
					<?if($USER->GetLogin() == $arSection['UF_AUTHOR']):?>
                    <a href="<?=$arSection['SECTION_PAGE_URL']?>upload/" class="btn btn-sm btn-outline-secondary"><?=GetMessage('ADD')?></a>
					<?endif;?>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
			
			<?endforeach;?>
			</div>    
 		</div>
    </div>
</main>