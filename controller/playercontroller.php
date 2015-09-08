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
 namespace OCA\octv\Controller;

 use OCP\IRequest;
 use OCP\Files\File;
 use OCP\Files\Filesystem;
 use OCP\AppFramework\Controller;

 class PlayerController extends Controller {

     public function __construct($AppName, IRequest $request){
         parent::__construct($AppName, $request);
     }

     /**
      * @NoAdminRequired
      * @NoCSRFRequired
      */
     public function play($directory, $filename) {
         $finfo = \OC\Files\Filesystem::getFileInfo('/', false);
         $relpath = $finfo->getPath();
         $datadir = \OC_Config::getValue('datadirectory', \OC::$SERVERROOT . '/data/');
         $realname = $datadir . $relpath . $directory . $filename;
         system(\OC::$SERVERROOT . "/apps/octv/player play \"" . $realname . "\"");
         return $realname;
     }
     public function command($request) {
         system(\OC::$SERVERROOT . "/apps/octv/player " . $request);
     }
 }
?>
