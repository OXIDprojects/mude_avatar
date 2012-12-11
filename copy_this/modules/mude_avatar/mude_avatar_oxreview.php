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
 * class to load a user and show its avatar next to a review
 */
class mude_avatar_oxreview extends mude_avatar_oxreview_parent
{
    /**
     * Extension of oxreview assign method to load the user who wrote the review.
     * @param record    $dbRecord
     * @return boolean
     */
    public function assign( $dbRecord )
    {
        $blRet = parent::assign( $dbRecord );

        $this->_oUser = oxnew ('oxuser');
        $this->_oUser->load($this->oxreviews__oxuserid->value);
        return $blRet;
    }

    /**
     * Returns the absolute url of the avatar of the user who wrote the review.
     *
     * @return string   absolute url of avatar
     */
    public function getMudeAvatarUrl()
    {
        return $this->_oUser->getMudeAvatarUrl();
    }

}
