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
<div class="octv-video-item">
	<a href="#" class="octv-video"
		data-dir=""
		data-name="<?php p($_['video']['path']); ?>">
		<img class="octv-preview" alt="Movie Preview" src="<?php print_unescaped($_['video']['preview']); ?>"/>
	</a>
	<a href="#" data-dir="<?php p(dirname($_['video']['path'])); ?>" data-name="<?php p(basename($_['video']['path'])); ?>" class="octv-delete">
		<img alt="Delete Movie" src="<?php print_unescaped(\OCP\Util::imagePath('core', 'actions/delete.svg')); ?>"/>
	</a>
	<a href="#" class="octv-video"
		data-dir=""
		data-name="<?php p($_['video']['path']); ?>">
		<p class="octv-videotitle"><?php p($_['video']['name']); ?></p>
	</a>
</div>
