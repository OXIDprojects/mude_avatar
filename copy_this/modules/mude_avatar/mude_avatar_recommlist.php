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
 * class to load a user and show its avatar next to his recomm list
 */
class mude_avatar_recommlist extends mude_avatar_recommlist_parent
{
    /**
     * Extension to load the user who wrote the recomm list.
     * @param dbrecord $dbRecord
     * @return boolean
     */
    public function assign( $dbRecord )
    {
        $blRet = parent::assign( $dbRecord );

        $this->_oUser = oxnew ('oxuser');
        $this->_oUser->load($this->oxrecommlists__oxuserid->value);
        return $blRet;
    }


    /**
     * Returns the absolute url of the avatar of the user who created the recomm list.
     *
     * @return string   absolute url of the avatar
     */
    public function getMudeAvatarUrl()
    {
        return $this->_oUser->getMudeAvatarUrl();
    }
}