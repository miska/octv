<?php
/**
 * @author Michal Hrusecky <michal@hrusecky.net>
 *
 * @copyright Copyright (c) 2015, Michal Hrusecky
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */
?>
<?php
//load the required files
OCP\Util::addStyle( 'octv', 'style');
OCP\App::addNavigationEntry(array(
        'id' => 'octv_index', 
        'order' => 80, 
        'href' => OCP\Util::linkToRoute('octv.view.index'), 
        'icon' => OCP\Util::imagePath('octv', 'app.svg'), 
        'name' => 'OCTV')
);
OCP\Util::addscript( 'octv', 'octv_player');
?>
