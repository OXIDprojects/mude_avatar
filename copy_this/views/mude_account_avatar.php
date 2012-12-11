<?php
/**
 *    This file is part of Musterdenker Avatar Module for OXID eShop.
 *
 *    Musterdenker Avatar Module for OXID eShop is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with Musterdenker Avatar Module for OXID eShop.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.musterdenker.de
 */

/**
 * administration of the users avatar
 */
class mude_account_avatar extends Account
{
    protected $_sGravatarUrl;

    protected $_aImageTypes = array("GIF" => IMAGETYPE_GIF, "JPG" => IMAGETYPE_JPEG, "PNG" => IMAGETYPE_PNG);


    /**
     * Extension of default init method, loads the Gravatar based on the users mail
     */
    public function init()
    {
        parent::init();
        $this->_sGravatarUrl = $this->_getGravatarUrl($this->getUser()->oxuser__oxusername->value);
    }

    /**
     * Creates the Gravatar url based on the mail and the pre configured default size of the avatars
     *
     * @param string> $sMail
     * @return mixed    url of gravatar or false if mail is invalid
     */
    protected function _getGravatarUrl($sMail)
    {
        if ( oxUtils::getInstance()->isValidEmail($sMail)) {
            $sUrl = "http://www.gravatar.com/avatar.php?gravatar_id=";
            $sUrl = $sUrl . md5( strtolower( trim( $sMail)));
            $sUrl = $sUrl . "&s=" . $this->getConfig()->getConfigParam('mude_avatar_picture_height');
            return $sUrl;
        } else {
            return false;
        }
    }

    /**
     * Returns the proper file ending for the given image array.
     *
     * @param array $aImageArray    image array as created by getimagesize()
     * @return string   image file endig (gif, jpeg, png)
     */
    protected function _getImageFileEnding($aImageArray)
    {
        switch ( $aImageArray[2] ) {    //Image type
            case ( $this->_aImageTypes["GIF"] ):
                return "gif";
                break;
            case ( $this->_aImageTypes["JPG"] ):
                return "jpeg";
                break;
            case ( $this->_aImageTypes["PNG"] ):
                return "png";
                break;
            default:
                return "";
        }
    }

    /**
     * Resizes and copies the updloaded file ($_FILES['mude_picture']['tmp_name']['file'])
     * to the img/mude_avatar_pics/ folder and calles it USERID.FILEENDING.
     * If an image allready exists it will be overwritten.
     *
     * @global $_FILES
     * @return mixed    filename of the created image, or false in case of an error
     */
    protected function _processPicture () //TODO make secure!!!
    {
        global $_FILES;
        $sSource =  $_FILES['mude_picture']['tmp_name']['file'];
        $sType = $_FILES['mude_picture']['type']['file'];

        $aImageInfo = @getimagesize( $sSource );

        if ( $aImageInfo === false) { //no picture
              return false;
        }

        $sEnding = $this->_getImageFileEnding($aImageInfo);


		if ( $sEnding === "") {
			return false;
		}

        $sTargetName = $this->getUser()->getId();
        $sTarget = $this->getConfig()->getAbsImageDir() . 'mude_avatar_pics/' . $sTargetName . "." . $this->_getImageFileEnding($aImageInfo);

        if ( file_exists( $sTarget ) ) {
            $blDeleted = unlink( $sTarget );
        }


        oxUtilsPic::getInstance()->resizeImage($sSource, $sTarget, $this->getConfig()->getConfigParam('mude_avatar_picture_height'), $this->getConfig()->getConfigParam('mude_avatar_picture_width'));

        return $sTargetName . "." . $sEnding;

    }

    /**
     * Determines which image type is selected by the user and stores the information
     * in the oxuser db. Right now 3 types are possible: gravatar, file and none.
     *
     * @return null
     */
    public function setPicture()
    {

        $oUser = $this->getUser();
        $sPictureName = "";
        if ($this->getConfig()->getParameter('avatar_type') == 'gravatar') { //TODO inputfilter mail
            $sPictureName = $this->getConfig()->getParameter('gravatar_text');
            $sPictureName = $this->_getGravatarUrl($sPictureName);
            if ($sPictureName === false) {
                oxUtilsView::getInstance()->addErrorToDisplay('MUDE_AVATAR_ACCOUNT_WRONG_EMAIL_ERROR', false, true);
                return;
            }
            $oUser->oxuser__mude_avatar_picture_type->setValue('GRAVATAR');
        }elseif ($this->getConfig()->getParameter('avatar_type') == 'file') {
            $sPictureName = $this->_processPicture();
            if ($sPictureName === false) {
                oxUtilsView::getInstance()->addErrorToDisplay('MUDE_AVATAR_ACCOUNT_WRONG_PICTURE_ERROR', false, true);
                return;
            }
            $oUser->oxuser__mude_avatar_picture_type->setValue('FILE');
        }elseif ($this->getConfig()->getParameter('avatar_type') == 'none') {
            $sPictureName = "";
            $oUser->oxuser__mude_avatar_picture_type->setValue(null);
        }
        $oUser->oxuser__mude_avatar_picture->setValue($sPictureName);
        $oUser->save();
    }


    /**
     * Extension of the default render method, addes some variables to the template:
     * sGravatarUrl - gravatar url of users mail address
     * sGravatarMail - users mail address
     * iAvatarH - height of avatars as configured in config.inc.php
     * iAvatarW - width of avatars as configured in config.inc.php
     * blEdit - edit mode yes/no
     *
     *
     * @return string   Name of the current template
     */
    public function render()
    {
        parent::render();

        $this->_aViewData['sGravatarUrl'] = $this->_sGravatarUrl;
        $this->_aViewData['sGravatarMail'] = $this->getUser()->oxuser__oxusername->value;

        $this->_aViewData['iAvatarH'] = $this->getConfig()->getConfigParam('mude_avatar_picture_height');
        $this->_aViewData['iAvatarW'] = $this->getConfig()->getConfigParam('mude_avatar_picture_width');

        $this->_aViewData['blEdit'] = ($this->getConfig()->getParameter('edit') == "1");

        $this->_sThisTemplate = "mude_account_avatar.tpl";
        return $this->_sThisTemplate;
    }
}