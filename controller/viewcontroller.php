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

 use OC\Files\Filesystem;
 use OC\Files\View;
 use OC\Files\Cache\Cache;
 use OCP\IRequest;
 use OCP\AppFramework\Http\TemplateResponse;
 use OCP\AppFramework\Controller;

class VideosManager {

        private $cache;
        private $fileview;

        private $videos;

        public function __construct() {
                $user = \OCP\User::getUser();
                $root = $user . '/files/';
                list($storage, $internalPath) = Filesystem::resolvePath($root);

                $this->fileview = new View($root);
                $this->cache = new Cache($storage);
        }

        public function getVideos() {
                if(!empty($this->videos)) {
                        return $this->videos;
                }

                $videos = $this->cache->searchByMime('video');

                foreach($videos as $video) {
                        if(substr($video['path'], 0, 6) !== 'files/') {
                                continue;
                        }
                        $url = substr($video['path'], 5);
                        $entry = array(
                                'url' => $url,
                                'dir' => substr($url, 0, strlen($url) - strlen($video['name'])),
                                'name' => $video['name'],
                                'size' => $video['size'],
                                'mtime' => $video['mtime'],
                                'mime' => $video['mimetype'],
                        );

                        $this->videos[] = $entry;
                }
                return $this->videos;
        }
}


 class ViewController extends Controller {

     public function __construct($AppName, IRequest $request){
         parent::__construct($AppName, $request);
     }

     /**
      * @NoAdminRequired
      * @NoCSRFRequired
      */
     public function index() {
        \OCP\App::setActiveNavigationEntry( 'octv_index' );
        $manager = new VideosManager();
        $videos = $manager->getVideos();
	return new TemplateResponse('octv', 'videos', [ 'videos' => $videos ]);
     }

 }
?>
