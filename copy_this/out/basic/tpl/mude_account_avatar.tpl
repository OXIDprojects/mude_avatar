[{assign var="template_title" value="MUDE_AVATAR_ACCOUNT_PICTURE_TITLE"|oxmultilangassign }]
[{include file="_header.tpl" title=$template_title location="MUDE_AVATAR_ACCOUNT_PICTURE_LOCATION"|oxmultilangassign|cat:$template_title}]

[{include file="inc/account_header.tpl" active_link=10 }]<br>

<strong id="test_personalSettingsHeader" class="boxhead">[{ oxmultilang ident="MUDE_AVATAR_ACCOUNT_PICTURE_HEADLINE" }]</strong>
<div class="box info mude-avatar">

        <div class="account">

             [{if $oxcmp_user->hasMudeAvatar() && !$blEdit}]
                 <div>
                     <h4>[{ oxmultilang ident="MUDE_AVATAR_ACCOUNT_CURRENT_PICTURE" }]</h4>
                     <div class="dot_sep"></div>
                     [{include file="inc/error.tpl" Errorlist=$Errors.user errdisplay="inbox"}]
                     <img src="[{$oxcmp_user->getMudeAvatarUrl()}]">
                     <p>
                         [{ oxmultilang ident="MUDE_AVATAR_ACCOUNT_CURRENT_PICTURE_TEXT" }]
                     </p>
                     <div class="dot_sep"></div>
                     <span class="left"><a href="[{ oxgetseourl ident=$oViewConf->getSslSelfLink()|cat:"cl=mude_account_avatar&edit=1" }]">[{ oxmultilang ident="MUDE_AVATAR_ACCOUNT_CURRENT_CHANGE" }]</a></span>
                 </div>
             [{else}]
                 <form action="[{ $oViewConf->getSelfActionLink() }]" name="mude_picture" method="post" enctype="multipart/form-data">
                [{ $oViewConf->getHiddenSid() }]
                <input type="hidden" name="fnc" value="setPicture">
                <input type="hidden" name="cl" value="mude_account_avatar">
                <input type="hidden" name="cnid" value="[{ $oViewConf->getActCatId() }]">
                <input type="hidden" name="CustomError" value='user'>

                
                <strong class="h4">[{ oxmultilang ident="MUDE_AVATAR_ACCOUNT_PICTURE_CHOOSE" }]</strong>
                <div class="dot_sep"></div>
                [{include file="inc/error.tpl" Errorlist=$Errors.user errdisplay="inbox"}]
                <small><span class="note">[{ oxmultilang ident="MUDE_AVATAR_ACCOUNT_SIZE_NOTE" }] </span><span class="def_color_1">[{ oxmultilang ident="MUDE_AVATAR_ACCOUNT_SIZE_NOTE_TEXT" }]: [{$iAvatarH}] x [{$iAvatarW}]</span></small><br><br>

                    <div class="mude-avatar-element">
                    <div class="mude-avatar-element-head"><input type="radio" name="avatar_type" value="gravatar">
                    <label>[{ oxmultilang ident="MUDE_AVATAR_ACCOUNT_PICTURE_GRAVATAR_LABEL" }]</label></div>
                    <div class="mude-avatar-element-content">
                        <img src="[{$sGravatarUrl}]" class="float">
                        <input type="text" name="gravatar_text" value="[{$sGravatarMail}]">
                        <span>[{ oxmultilang ident="MUDE_AVATAR_ACCOUNT_PICTURE_GRAVATAR_TEXT" }]</span>
                    </div>
                    
                </div>
                <div class="mude-avatar-element">
                    <div class="mude-avatar-element-head">
                    <input type="radio" name="avatar_type" value="file">
                    <label>[{ oxmultilang ident="MUDE_AVATAR_ACCOUNT_PICTURE_FILE_LABEL" }]</label>
                    </div>
                    <div class="mude-avatar-element-content">
                    <input type="file" name="mude_picture[file]" class="editinput"/>
                    </div>
                </div>
                <div class="mude-avatar-element">
                    <div class="mude-avatar-element-head">
                    <input type="radio" name="avatar_type" value="none" checked>
                    <label>[{ oxmultilang ident="MUDE_AVATAR_NO_PICTURE_LABEL" }]</label>
                    </div>
                </div>

                 <div class="dot_sep"></div>
                 <span class="left"><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=mude_account_avatar" }]">[{ oxmultilang ident="MUDE_AVATAR_CANCEL" }]</a></span>
                 <div class="right">
                   <span class="btn"><input id="test_savePass" type="submit" value="[{ oxmultilang ident="ACCOUNT_PASSWORD_SAVE" }]" class="btn"></span>
                 </div>
                <br><br>
           </form>
     [{/if}]
   </div>
</div>

<div class="bar prevnext">
    <form action="[{ $oViewConf->getSelfActionLink() }]" name="order" method="post">
      <div>
          [{ $oViewConf->getHiddenSid() }]
          <input type="hidden" name="cl" value="start">
          <div class="right">
               <input id="test_BackToShop" type="submit" value="[{ oxmultilang ident="MUDE_AVATAR_ACCOUNT_BACKTOSHOP" }]">
          </div>
      </div>
    </form>
</div>


[{insert name="oxid_tracker" title=$template_title }]
[{include file="_footer.tpl" }]
