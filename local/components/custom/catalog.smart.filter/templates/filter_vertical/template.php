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
global $arrFilter;

// CJSCore::Init(array("fx"));
?>
<?php /*---bgn 2015-07-08---*/
//подготавливаем данные для области Назначение
$obMenu = $APPLICATION->GetMenu('left', false, false, '/collections/'); //получаем левое меню для раздела collections
$arNames = array(); //названия плиток
$arLinks = array(); //адреса страниц плиток
foreach($obMenu->arMenu as $arMenuItem) {
  $name = trim($arMenuItem[0]);
  if (!empty($name)) {
    $arNames[] = $name;
    $arLinks[] = $arMenuItem[1];
  }
}
//получаем список св-в инфоблока описаний для фильтра
$rProp = CIBlockProperty::GetList(array('name'=>'asc'), array('IBLOCK_ID'=>FLTR_PROP_DESC_ID, 'ACTIVE'=>'Y'));
$arDescIBProps = array();
while($arProp = $rProp->Fetch()) {
  $arDescIBProps[] = $arProp['CODE'];
}
//получаем соответствие id св-ва страны url странице раздела
$arCountrySection = array();
$file_name = 'country_prop_id__sec_url.txt';
$file_path = $_SERVER['DOCUMENT_ROOT'].'/'.$file_name;
if (file_exists($file_path)) {
  $f = fopen($file_path, 'r');
  while($line = fgets($f)) {
    $line = explode(' ', $line);
    $arCountrySection[$line[0]] = $line[1];
  }
  fclose($f);
}
//проверим находимся ли на странице плитки по назначению
$isNazn = FALSE;
if (in_array($arResult["FORM_ACTION"], $arLinks)) {
  $isNazn = TRUE;
}

/*---end 2015-07-08---*/ ?>
<div class="bx_filter_vertical bx_<?=$arParams["TEMPLATE_THEME"]?>">
  <div class="bx_filter_section m4">
    <form id="filter-ajax" name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
		<input name="back" value="<?=$arParams["BACK_URL"];?>" type="hidden" />
		<input name="dir" value="<?=$arParams["FORM_ACTION"];?>" type="hidden" />
		<input name="ajax" value="Y" type="hidden" />
      <?$isSecID = false;
      foreach($arResult["HIDDEN"] as $arItem):?>
        <input
        type="hidden"
        name="<?echo $arItem["CONTROL_NAME"]?>"
        id="<?echo $arItem["CONTROL_ID"]?>"
        value="<?echo $arItem["HTML_VALUE"]?>"
        />
        <?if ($arItem["CONTROL_NAME"] == 'sec_id') {
          $isSecID = true;
        }
      endforeach;?>
      <? if (!$isSecID) {?>
        <input type="hidden" name="sec_id" value="<?php echo $arParams['SECTION_ID']; ?>" />
      <?php } ?>
      <?foreach($arResult["ITEMS"] as $key=>$arItem):
            //DISPLAY_EXPANDED Y/N
      $key = md5($key);
      ?>
      <?if(isset($arItem["PRICE"])):?>
      <?
      if (!$arItem["VALUES"]["MIN"]["VALUE"] || !$arItem["VALUES"]["MAX"]["VALUE"] || $arItem["VALUES"]["MIN"]["VALUE"] == $arItem["VALUES"]["MAX"]["VALUE"])
        continue;
      ?>
      <div class="is-filter">
        <div class="is-filter__title">Цена ₽</div>
        <div class="bx_filter_param_area">
          <div class="bx_filter_param_area_block">
            <input class="min-price" type="text" name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM_MIN")?>" size="5" />
          </div>
          <div class="bx_filter_param_area_block">
            <input class="max-price" type="text" name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" placeholder="<?=GetMessage("CT_BCSF_FILTER_TO_MAX")?>" size="5" />
          </div>
          <div style="clear: both;"></div>
        </div>
        <div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
          <div class="bx_ui_slider_range" style="left: 0; right: 0%;"  id="drag_tracker_<?=$key?>"></div>
          <a class="bx_ui_slider_handle left"  href="javascript:void(0)" style="left:0;" id="left_slider_<?=$key?>"></a>
          <a class="bx_ui_slider_handle right" href="javascript:void(0)" style="right:0%;" id="right_slider_<?=$key?>"></a>
        </div>
        <div class="bx_filter_param_area">
          <div class="bx_filter_param_area_block" id="curMinPrice_<?=$key?>"><?=(int)$arItem["VALUES"]["MIN"]["FILTERED_VALUE"]?></div>
          <div class="bx_filter_param_area_block" id="curMaxPrice_<?=$key?>"><?=(int)$arItem["VALUES"]["MAX"]["FILTERED_VALUE"]?></div>
          <div style="clear: both;"></div>
        </div>
      </div>

      <script type="text/javascript">
        var DoubleTrackBar<?=$key?> = new cDoubleTrackBar('drag_track_<?=$key?>', 'drag_tracker_<?=$key?>', 'left_slider_<?=$key?>', 'right_slider_<?=$key?>', {
          OnUpdate: function(){
            BX("<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>").value = this.MinPos;
            BX("<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>").value = this.MaxPos;
          },
          Min: parseFloat(<?=(int)$arItem["VALUES"]["MIN"]["FILTERED_VALUE"]?>),
          Max: parseFloat(<?=(int)$arItem["VALUES"]["MAX"]["FILTERED_VALUE"]?>),
          MinInputId : BX('<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>'),
          MaxInputId : BX('<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>'),
          FingerOffset: 10,
          MinSpace: 1,
          RoundTo: 1, //0.01,
          Precision: 0, //2
        });
      </script>
    <?endif?>
  <?endforeach?>

  <?foreach($arResult["ITEMS"] as $key=>$arItem):?>
          <?if($arItem["PROPERTY_TYPE"] == "N" ):?>
          <?
          /*---bgn 2018-01-30---*/
          //если убрать комментарий, то при мин. значении равном 0 пар-р в фильтре не отображается
          /*if (!$arItem["VALUES"]["MIN"]["VALUE"] || !$arItem["VALUES"]["MAX"]["VALUE"] || $arItem["VALUES"]["MIN"]["VALUE"] == $arItem["VALUES"]["MAX"]["VALUE"])
          continue;*/
          /*---end 2018-01-30---*/
          ?>
          <div class="bx_filter_container <? if ($arItem["DISPLAY_EXPANDED"] == "N" || empty($arItem["DISPLAY_EXPANDED"] )): ?> block-hidden<? endif;?>">
            <div class="is-filter__title prop_<?php echo $arItem['ID']; ?>"><?=$arItem["NAME"]?></div>
            <div class="bx_filter_block">
              <div class="bx_filter_param_area">
                <div class="bx_filter_param_area_block">
                  <input
                  class="min-price"
                  type="text"
                  name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                  id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                  value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                  placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM_MIN")?>"
                  size="5"
                  />
                </div>
                <div class="bx_filter_param_area_block">
                  <input
                  class="max-price"
                  type="text"
                  name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                  id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                  value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                  placeholder="<?=GetMessage("CT_BCSF_FILTER_TO_MAX")?>"
                  size="5"
                  />
                </div>
                <div style="clear: both;"></div>
              </div>
              <div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
                <div class="bx_ui_slider_range" style="left: 0; right: 0%;"  id="drag_tracker_<?=$key?>"></div>
                <a class="bx_ui_slider_handle left"  href="javascript:void(0)" style="left:0;" id="left_slider_<?=$key?>"></a>
                <a class="bx_ui_slider_handle right" href="javascript:void(0)" style="right:0%;" id="right_slider_<?=$key?>"></a>
              </div>
              <div class="bx_filter_param_area">
                <div class="bx_filter_param_area_block" id="curMinPrice_<?=$key?>"><?=$arItem["VALUES"]["MIN"]["VALUE"]?></div>
                <div class="bx_filter_param_area_block" id="curMaxPrice_<?=$key?>"><?=$arItem["VALUES"]["MAX"]["VALUE"]?></div>
                <div style="clear: both;"></div>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            var DoubleTrackBar<?=$key?> = new cDoubleTrackBar('drag_track_<?=$key?>', 'drag_tracker_<?=$key?>', 'left_slider_<?=$key?>', 'right_slider_<?=$key?>', {
              OnUpdate: function(){
                BX("<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>").value = this.MinPos;
                BX("<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>").value = this.MaxPos;
              },
              Min: parseFloat(<?=$arItem["VALUES"]["MIN"]["VALUE"]?>),
              Max: parseFloat(<?=$arItem["VALUES"]["MAX"]["VALUE"]?>),
              MinInputId : BX('<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>'),
              MaxInputId : BX('<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>'),
              FingerOffset: 10,
              MinSpace: 1,
              RoundTo: 1 //100
            });
          </script>
          <?elseif(!empty($arItem["VALUES"]) && !isset($arItem["PRICE"])):?>
          
          <div class="bx_filter_container <? if ($arItem["DISPLAY_EXPANDED"] == "N" || empty($arItem["DISPLAY_EXPANDED"] )): ?> block-hidden<? endif;?>">
            <div class="is-filter__title prop_<?php echo $arItem['ID']; ?>"><?=$arItem["NAME"]?></div>
            <div class="bx_filter_block">
              <? foreach($arItem["VALUES"] as $val => $ar):?>
              <?php
              $itm_key = array_search($ar["VALUE"], $arNames);
              $filter_link = '';
              if ($itm_key !== FALSE) {
              //это пар-р с названиями плиток, делаем ссылку на страницу соотв. плитки
                $filter_link = $arLinks[$itm_key];
              //если на странице плитки по назначению и выводим только это значение
              } else {
                if (in_array('FLTR_'.$arItem['ID'], $arDescIBProps)) {
                //пар-р со страницей описания из инфоблока страниц для фильтра
                  $arDescFilter = array(
                    'IBLOCK_ID'=>FLTR_PROP_DESC_ID,
                    'ACTIVE'=>'Y',
                    'PROPERTY_FLTR_'.$arItem['ID'].'_VALUE'=>'['.$val.'] '.$ar['VALUE']
                  );
                  $rEl = CIBlockElement::GetList(array(), $arDescFilter, false, false, array('ID', 'DETAIL_PAGE_URL'));
                  if ($arEl = $rEl->GetNext()) {
                    $filter_link = $arEl['DETAIL_PAGE_URL'];
                  }
                } else if ($arItem['ID'] == 48) {
                //выводим список стран
                  if (!empty($arCountrySection[$val])) {
                    $filter_link = $arCountrySection[$val];
                  }
                }
              }
              if ($arParams['SECTION_ID'] > 0) {
                $filter_link = '';
              }
				?>
        
        <div class="filter-item <? echo $ar["DISABLED"] ? 'disabled': ''?>">
          <input type="checkbox"
            <?php if (isset($arrFilter['PROPERTY_45']) && $arrFilter['PROPERTY_45'] == $ar['FACET_VALUE']):?> checked readonly 
            <?php elseif ($ar['DISABLED'] && !$ar["CHECKED"]) :?>
              disabled
            <?php endif;?>
            value="<?echo $ar["HTML_VALUE"]?>"
            name="<?echo $ar["CONTROL_NAME"]?>"
            id="<?echo $ar["CONTROL_ID"]?>"
            <?echo $ar["CHECKED"]? 'checked="checked"': ''?>
          />
          <label class="<? echo $ar["DISABLED"] ? 'disabled': ''?>" for="<?echo $ar["CONTROL_ID"]?>">
                <?php 
                if (!empty($filter_link)) { ?>
                  <a href="<?php echo $filter_link; ?>">
                  <?php }
                  echo $ar["VALUE"];
                  if (!empty($filter_link)) { ?>
                  </a>
                <?php } ?>
              </label>
            </div>
            <?endforeach;?>
          </div>
        </div>
        <?endif;?>
        <?endforeach;?>
        <div class="is-filter__btns">
          <input class="is-filter__submit" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
          <a href="<?=$arParams["BACK_URL"];?>" class="is-filter__reset" rel="nofollow"><?=GetMessage("CT_BCSF_DEL_FILTER")?></a>
        </div>
      </form>
      <div style="clear: both;"></div>
    </div>
  </div>
<script>
  itshefHeighter ();
  function itshefHeighter () {

    $('.bx_filter_block').each(function (i,t) {
      var index = i;
      var toggle = $(t).find('.js-heighter-toggle'), 
        elements = $(t).children(), 
        height = $(t).outerHeight(), 
        heightMin = 0;

      var clinker_index;
      var clinker_index_reserve;
      var $outer_block;
      if(i==1){
        $outer_block = $(this);
        // console.log('this.children=',$(this).children());
        $(this).children().each(function(k, elem){
          // console.log($.trim($(this).find('label a').text()));
          if($.trim($(this).find('label a').text())=='Клинкер (ступени)'){
            // console.log('TRUE');
            clinker_index = k;
          }

					if($.trim($(this).find('label').text())=='Клинкер (ступени)'){
            //  console.log('Reserve TRUE');
            clinker_index_reserve = k;
          }

        });

        // console.log('clinker_index=',clinker_index);
        // console.log('clinker_index_reserve=',clinker_index_reserve);
        if(typeof clinker_index === 'undefined'){
          clinker_index = clinker_index_reserve;
        }

        if(typeof clinker_index !== 'undefined'){
          $element = jQuery($(this).children()[clinker_index]);//Клинкер
          $element.appendTo(this);
          $($(this)[0]).addClass('my-height');
        }

      }
    });
  }
										 
  $('.is-filter__title').click(function () {
    var t = $(this).parent('.bx_filter_container');
    if(t.hasClass('block-hidden')){
      t.removeClass('block-hidden');
    } else {
      t.addClass('block-hidden');
    }
  });

  $("form#filter-ajax").submit(function(e){
    if(!$('#filter-ajax').hasClass('wait')){
      var datastring = $('#filter-ajax').serialize();

      $.ajax({
        url: '/ajax/filter_new_v2.php',
        type: 'POST',
        data: datastring,
        dataType: 'json',
        beforeSend: function () {
          $('#filter-ajax').addClass('wait');
        },
        success: function (data) {
          $('#filter-ajax').removeClass('wait');
          window.location.href = data.link;
        }
      });
    }
    e.preventDefault();
    return false;
  });
	/*
  $('[type=checkbox]').click(function(){

    if(!$('#filter-ajax').hasClass('wait')){
      var datastring = $('#filter-ajax').serialize();
      if($(".bx_catalog_tile_ul").length>0) {
        datastring += "&is_section";
      }

      url = '/ajax/filter_new_count.php';
      curUrl = $('#filter-ajax input[name="dir"]').val().split('/');

      if(curUrl[1] == 'napolnye-pokrytiya') {
        url = '/ajax/filter_new_count_pol.php';
      }
      if(curUrl[1] == 'santekhnika') {
        url = '/ajax/filter_new_count_san.php';
      }

      $.ajax({
        url: url,
        type: 'POST',
        data: datastring,
        dataType: 'json',
        beforeSend: function () {
          $('#filter-ajax').addClass('wait');
        },
        success: function (data) {
          $('#filter-ajax').removeClass('wait');

          try {
            if(data.count > 0) {
              $("#set_filter").val("Показать ("+data.count+")");
            } else {
              $("#set_filter").val("Показать").attr("disabled", true);
            }
          } catch (err) {}
          
        }
      });
    }
  });
*/
</script>