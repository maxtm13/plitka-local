<p class="messages"><? ShowNote(implode("<br />", $arResult["MESSAGES"])); ?></p>
<? if(!$arResult['ERRORS']['CAPTCHA']): ShowError(implode("<br />", $arResult["ERRORS"])); endif; ?>
<? if($arResult['A_NAME'] != '') $arResult['saveName'] = $arResult['A_NAME']; ?>

<?

if($_SESSION['SCROLL_TO_COMMENT'])
{
	$arResult['SCROLL_TO_COMMENT'] = $_SESSION['SCROLL_TO_COMMENT'];
	$_SESSION['SCROLL_TO_COMMENT'] = 0;
}

?>

<script type="text/javascript">
	<? if($arResult['SCROLL_TO_COMMENT']):?>
	var scroll = <?=$arResult['SCROLL_TO_COMMENT']?>;
	<? else: ?>
	var scroll = 0;
	<? endif;?>
	var save_id = <?= $arResult['P_ID'] ?>;

	<? if($arResult['TO_MOD'] == 1):?>
	var to_moderate = 1;
	<? else: ?> 
	var to_moderate = 0;
	<? endif; ?>
	var PLEASE_ENTER_COMMENT = <?= '"'.GetMessage('PLEASE_ENTER_COMMENT').'"';?>;
	var PLEASE_ENTER_NAME = <?= '"'.GetMessage('PLEASE_ENTER_NAME').'"';?>;
	var INVALID_EMAIL = <?= '"'.GetMessage('INVALID_EMAIL').'"';?>;
	var CONFIRMATION_MULTI = <?= '"'.GetMessage('CONFIRMATION_MULTI').'"';?>;
	var CONFIRMATION_SINGLE = <?= '"'.GetMessage('CONFIRMATION_SINGLE').'"';?>;
	var DEL_SUCCESS_MULTI = <?= '"'.GetMessage('DEL_SUCCESS_MULTI').'"';?>;
	var DEL_SUCCESS_SINGLE = <?= '"'.GetMessage('DEL_SUCCESS_SINGLE').'"';?>;
	
	var TYPE_LINK = <?= '"'.GetMessage('TYPE_LINK').'"';?>;
	var TYPE_IMAGE = <?= '"'.GetMessage('TYPE_IMAGE').'"';?>;
	var TYPE_LINK_TEXT = <?= '"'.GetMessage('TYPE_LINK_TEXT').'"';?>;
	
</script>
<div style="width:auto;">

<? if($arResult['NO_INDEX'] == 'Y'):?><noindex><? endif;?>
<div class="comments_block">
	<? if($arResult['SHOW_COUNT'] == 'Y'):?>
		<p class="comments_block_title"><strong><?=GetMessage('COMMENTS_COUNT')?> (<?=$arResult['COMMENTS_COUNT']?>)</strong></p>
	<? endif; ?>
	<div class="comments_list">
	<? foreach($arResult['COMMENTS'] as $COMMENT): ?>
	<? if((($COMMENT['ACTIVATED'] == 0 && $arResult['GROUPS']) || $arResult['ISADMIN']) || $COMMENT['ACTIVATED'] == 1): ?>
		<div class="comment_item <? if($COMMENT['ACTIVATED'] == 0 && ($arResult['GROUPS'] || $arResult['ISADMIN'])): echo "not_approved"; endif; ?>" style="margin-left: <?=$COMMENT['LEFT_MARGIN']?>px;" id="comment_<?=$COMMENT['ID']?>">
			<div <? if($arResult['SHOW_USERPIC'] == "Y"): ?> class="user_icon" <? endif; ?>>
				<? if($arResult['SHOW_USERPIC'] == 'Y'):?>

				<? if($COMMENT['USER']['USERLINK'] != ''): ?><a href="<?= $COMMENT['USER']['USERLINK'] ?>"><? endif; ?>
				<? if($COMMENT['USER']['PERSONAL_PHOTO']): ?>
				<img width="48" height="48" src="<?= $COMMENT['USER']['PERSONAL_PHOTO'];?>" alt="<?=$COMMENT['USER']['LOGIN']?>" />
				<? else: ?><img width="48" height="48" src="<?=$this->__folder?>/images/nophoto.gif" alt="<?=$COMMENT['USER']['LOGIN']?>" /><? endif; ?>
				<? if($COMMENT['USER']['USERLINK'] != ''): ?></a><? endif; ?>
				<? endif; ?>
			</div>
			<div class="comment_item_container">
          
			<? if($COMMENT['USER']['LOGIN']): ?>
				<div class="comment_item_top" <? if($arResult['SHOW_USERPIC'] != "Y"): echo 'style="margin-left:0px;"'; endif; ?>><? if($COMMENT['USER']['USERLINK'] != ''): ?><a href="<?=$COMMENT['USER']['USERLINK'] ?>" alt="<?=$COMMENT['USER']['LOGIN']?>"><?= $COMMENT['USER']['LOGIN']?></a><? else : ?><strong><?=$COMMENT['USER']['LOGIN']?></strong><? endif; ?><? if($arResult['SHOW_DATE'] == 'Y'): ?>, <?=$COMMENT['DATE_CREATE'] ?><? endif; ?></div>
			<div class="comment_item_controls">
				<? if($arResult['CURRENT_USER'] != 0): ?>
					<? if($arResult['ALLOW_RATING'] == 'Y'): ?>
						<a href="javascript://" onclick="javascript:VoteUp(<?=$COMMENT['ID']?>)"><img src="<?=$this->__folder?>/images/up.png" alt="+1" /></a><span id="up_<?= $COMMENT['ID'] ?>" class="green"><?= $COMMENT['VoteUp']; ?></span>
						<a href="javascript://" onclick="javascript:VoteDown(<?=$COMMENT['ID']?>)"><img src="<?=$this->__folder?>/images/down.png" alt="-1" /></a><span id="down_<?= $COMMENT['ID'] ?>" class="red"><?= $COMMENT['VoteDown']; ?></span>
					<? endif; ?>
				<? endif; ?>
				<? if($arResult['GROUPS'] || $arResult['ISADMIN']): ?>
						<span class="admin-control">
							<? if($COMMENT['ACTIVATED'] != 1): ?> <a id="activate_<?= $COMMENT['ID'] ?>" onclick="javascript:Activate(<?=$COMMENT['ID']?>, <?= "'".$arResult['SEND_TO_USER_AFTER_ACTIVATE']."'" ?>);" href="javascript://"><img src="<?=$this->__folder?>/images/approve.png" alt="<?= GetMessage("CONFIRM") ?>" /></a><? endif; ?>
							<a onclick="javascript:DeleteComment(<?=$COMMENT['ID']?>);" href="javascript://"><img src="<?=$this->__folder?>/images/delete.png" alt="<?= GetMessage("DELETE") ?>" /></a>
						</span>
					<? endif; ?>
				</div>
				<br class="clear" />
			<? endif; ?>
			<? if(!$COMMENT['USER']['LOGIN']): ?>
			<div class="comment_item_top" <? if($arResult['SHOW_USERPIC'] != "Y"): echo "style='margin-left:0px;'"; endif; ?>><strong><?=$COMMENT['AUTHOR_NAME']?></strong><? if($arResult['SHOW_DATE'] == 'Y'): ?>, <?= $COMMENT['DATE_CREATE'] ?><? endif; ?></div>
				<div class="comment_item_controls">
					<? if($arResult['CURRENT_USER'] != 0): ?>
						<? if($arResult['ALLOW_RATING'] == 'Y'): ?>
						<a href="javascript://" onclick="javascript:VoteUp(<?=$COMMENT['ID']?>)"><img src="<?=$this->__folder?>/images/up.png" alt="+1" /></a><span id="up_<?= $COMMENT['ID'] ?>" class="green"><?= $COMMENT['VoteUp']; ?></span>
						<a href="javascript://" onclick="javascript:VoteDown(<?=$COMMENT['ID']?>)"><img src="<?=$this->__folder?>/images/down.png" alt="-1" /></a><span id="down_<?= $COMMENT['ID'] ?>" class="red"><?= $COMMENT['VoteDown']; ?></span>
						<? endif; ?>
					<? endif; ?>
						<? if($arResult['GROUPS'] || $arResult['ISADMIN']): ?>
						<span class="admin-control">
							<? if($COMMENT['ACTIVATED'] != 1): ?> <a id="activate_<?= $COMMENT['ID'] ?>" onclick="javascript:Activate(<?=$COMMENT['ID']?>, <?= "'".$arResult['SEND_TO_USER_AFTER_ACTIVATE']."'" ?>);" href="javascript://"><img src="<?=$this->__folder?>/images/approve.png" alt="<?= GetMessage("CONFIRM") ?>" /></a><? endif; ?>
							<a onclick="javascript:DeleteComment(<?=$COMMENT['ID']?>);" href="javascript://"><img src="<?=$this->__folder?>/images/delete.png" alt="<?= GetMessage("DELETE") ?>" /></a>
						</span>
					<? endif; ?>
				</div> 
				<br class="clear" />           
			<? endif; ?>
			<div class="comment_item_content"><?=$COMMENT['COMMENT']?></div>
			<? if($arResult['CAN_COMMENT'] == 'Y' && $arResult['MAX_DEPTH_LEVEL'] > 1 && $COMMENT['ACTIVATED'] == 1):?>
			<div id="reply_to_<?=$COMMENT['ID']?>">
				<a id="comment_<?=$COMMENT['ID']?>" onclick="javascript:ReplyToComment(<?=$COMMENT['ID']?>);" href="javascript://" title="<?=GetMessage('REPLY')?>" class="comment_item_reply_link"><?=GetMessage('REPLY')?></a>
			</div>
			<? endif; ?>
			<br class="clear" />
		</div>
		<br class="clear" />
		</div>

	<? endif; ?>
	<? endforeach; ?>
	</div>

	<? if($arResult['CAN_COMMENT'] == 'Y'):?>    
	<div class="comment_reply"><div id="reply_to_0"><a onclick="javascript:ReplyToComment(0);" href="javascript://" id="leave_comment_link"><?=GetMessage('LEAVE_COMMENT')?></a></div></div>
	<? else: ?>
	<a href="<?=$arResult['AUTH_PATH']?>"><?=GetMessage('AUTH')?></a>
	<? endif; ?>

<form <? if($arResult['CURRENT_USER'] != 0): ?>onsubmit="document.getElementById('submitButton').disabled=true;document.getElementById('submitButton').style.cursor='wait';" <? endif; ?> method="post" action="" id="new_comment_form" style="display: none;" > 
	<fieldset id="addform" style="border: none;"> 
		<? if($arResult["ERRORS"]['CAPTCHA']): echo ShowError($arResult["ERRORS"]['CAPTCHA']); endif; ?>
		<? if(($arResult["USE_CAPTCHA"] == "Y") || ($arResult["NO_CAPTCHA"] == "Y")):?>
		<? if($arResult['PREMODERATION'] == "Y" && !$arResult['ERRORS']['CAPTCHA']): ?><p id="form_show" align="left" style="color: green; margin-bottom: 10px; font-size: 12px; padding-top:15px;"><?=GetMessage('MODERATION');?></p>
		<? endif; ?>
		<p><font color="red">*&nbsp;</font><?= GetMessage("NAME"); ?>:</p><input class="blured" id="AUTHOR_NAME" value="<?= $arResult['saveName'] ?>" type="text" name="AUTHOR_NAME" />
		<p><?= GetMessage("EMAIL"); ?>:</p><input id="EMAIL" value="<?= $arResult['EMAIL'] ?>" type="text" name="EMAIL" />
		<? endif; ?>
		<p><font color="red">*&nbsp;</font><?= GetMessage("YOUR_COMMENT"); ?>:</p>
		
		<? if($arResult['SHOW_FILEMAN'] == 1): ?>
		<div class="editor">
			<a title="<?= GetMessage("b"); ?>" onclick="javascript:encloseSelection('[b]', '[/b]');" href="javascript://"><img alt="<?= GetMessage("b"); ?>" src="<?=$this->__folder?>/images/icons/b.jpg" /></a>
			<a title="<?= GetMessage("i"); ?>" onclick="javascript:encloseSelection('[i]', '[/i]');" href="javascript://"><img alt="<?= GetMessage("i"); ?>" src="<?=$this->__folder?>/images/icons/i.jpg" /></a>
			<a title="<?= GetMessage("u"); ?>" onclick="javascript:encloseSelection('[u]', '[/u]');" href="javascript://"><img alt="<?= GetMessage("u"); ?>" src="<?=$this->__folder?>/images/icons/u.jpg" /></a>
			<a title="<?= GetMessage("s"); ?>" onclick="javascript:encloseSelection('[s]', '[/s]');" href="javascript://"><img alt="<?= GetMessage("s"); ?>" src="<?=$this->__folder?>/images/icons/s.jpg" /></a>
			<a id="quoteIcon" title="<?= GetMessage("q"); ?>" href="javascript://"><img alt="<?= GetMessage("q"); ?>" src="<?=$this->__folder?>/images/icons/quote.jpg" /></a>
			<a title="<?= GetMessage("c"); ?>" onclick="javascript:encloseSelection('[code]', '[/code]');" href="javascript://"><img alt="<?= GetMessage("c"); ?>" src="<?=$this->__folder?>/images/icons/code.jpg" /></a>
			<a title="<?= GetMessage("l"); ?>" id="link" href="javascript://"><img alt="<?= GetMessage("l"); ?>" src="<?=$this->__folder?>/images/icons/link.jpg" /></a>
			<a title="<?= GetMessage("image"); ?>" id="image" href="javascript://"><img alt="<?= GetMessage("image"); ?>" src="<?=$this->__folder?>/images/icons/image.jpg" /></a>
			<? if($arResult['ALLOW_SMILES'] == 1): ?>
			<a href="javascript://" onclick="return insertAtCursor(':)')"><img src="<?=$this->__folder?>/images/icons/smile.jpg" /></a>
			<a href="javascript://" onclick="return insertAtCursor(':D')"><img src="<?=$this->__folder?>/images/icons/xd.jpg" /></a>
			<a href="javascript://" onclick="return insertAtCursor(':(')"><img src="<?=$this->__folder?>/images/icons/sad.jpg" /></a>
			<a href="javascript://" onclick="return insertAtCursor('x_x')"><img src="<?=$this->__folder?>/images/icons/x_x.jpg" /></a>
			<a href="javascript://" onclick="return insertAtCursor('0_0')"><img src="<?=$this->__folder?>/images/icons/0_0.jpg" /></a>
			<? endif; ?>
		</div>
		<? endif; ?>
		<textarea name="COMMENT" id="TEXT"><?=$arResult['TEXT'] ?></textarea>
        <input type="hidden" name="PAGE_COUNT" value="<?=$arResult["PAGE_COUNT"]?>" />
        <input type="hidden" name="SORT" value="<?=$arResult["SORT"]?>" />
		<br class="clear" />
		<? if($arResult["USE_CAPTCHA"] == "Y"):?>
		<p><font color="red">*&nbsp;</font><?= GetMessage("CAPTCHA"); ?>:</p>
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" alt="CAPTCHA" />
		<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
		<input type="text" name="captcha_word" class="comment_captcha" />
		<? endif; ?>
	<button id="submitButton" type="submit" class="comment_submit" name="submit"><?=GetMessage('ADD')?></button>
	</fieldset> 
</form>
<? if($arResult['NO_INDEX'] == 'Y'):?></noindex><? endif;?>
</div><br />

<? if($arResult['COMMENTS_COUNT'] > 0): ?>
    <?=$arResult["NAV_STRING"]?>
<? endif; ?>

</div>