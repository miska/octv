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
      */
     public function play($directory, $filename) {
         if((substr($directory, -1) != '/') && substr($filename, 0, 1) != '/') {
             $relname = $directory . '/' . $filename;
         } else {
             $relname = $directory .       $filename;
         }
         $realname = \OC\Files\Filesystem::getLocalFile($relname);

         \OCP\Util::writeLog('octv', 'Playing ' . $realname, \OCP\Util::INFO);

         system(\OC::$SERVERROOT . "/apps/octv/player play \"" . $realname . "\"");
         return $realname;
     }
     /**
      * @NoAdminRequired
      */
     public function command($request) {
         system(\OC::$SERVERROOT . "/apps/octv/player " . $request);
     }
 }
?>
