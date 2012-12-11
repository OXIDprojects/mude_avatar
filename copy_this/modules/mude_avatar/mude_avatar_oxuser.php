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
 * class to load a user and show its avatar in the user are or elsewhere in the shop
 */
class mude_avatar_oxuser extends mude_avatar_oxuser_parent
{
    /**
     * Returns true in case the user has an avatar
     *
     * @return boolean
     */
    public function hasMudeAvatar()
    {
        return isset($this->oxuser__mude_avatar_picture_type->value);
    }

    /**
     * Returns the absolute url of the users avatar. Will return defaul.png avatar
     * in case no avatar is selected.
     *
     * @return string   absolute Url of the avatar picture
     */
    public function getMudeAvatarUrl()
    {
        switch ($this->oxuser__mude_avatar_picture_type->value) {
            case 'FILE' :
                $sPath = $this->getConfig()->getImageUrl();
                $sPath = $sPath . 'mude_avatar_pics/' . $this->oxuser__mude_avatar_picture->value;
                break;
            case 'GRAVATAR':
                $sPath = $this->oxuser__mude_avatar_picture->value;
                break;
            default:
                $sPath = $this->getConfig()->getImageUrl();
                $sPath = $sPath . 'mude_avatar_pics/default.png';
                break;
        }
        return $sPath;
    }
}
