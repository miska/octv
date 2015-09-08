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
<div class="octv-control-div">
<table>
<tr style>
<td>
<a href="#" alt="eject"  data-command="eject" class="octv-control">    <img src="<?php print_unescaped(OCP\Util::imagePath('octv', 'eject.svg')) ?>"/></a>
</td><td>
<a href="#" alt="<<"     data-command="rrrr" class="octv-control">     <img src="<?php print_unescaped(OCP\Util::imagePath('octv', 'rrrr.svg')) ?>"/></a>
</td><td>
<a href="#" alt="<"      data-command="rr" class="octv-control">       <img src="<?php print_unescaped(OCP\Util::imagePath('octv', 'rr.svg')) ?>"/></a>
</td><td>
<a href="#" alt="||"     data-command="pause" class="octv-control">    <img src="<?php print_unescaped(OCP\Util::imagePath('octv', 'pause.svg')) ?>"/></a>
</td><td>
<a href="#" alt=">"      data-command="ff" class="octv-control">       <img src="<?php print_unescaped(OCP\Util::imagePath('octv', 'ff.svg')) ?>"/></a>
</td><td>
<a href="#" alt=">>"     data-command="ffff" class="octv-control">     <img src="<?php print_unescaped(OCP\Util::imagePath('octv', 'ffff.svg')) ?>"/></a>
</td><td>
<a href="#" alt="vol --" data-command="voldown" class="octv-control">  <img src="<?php print_unescaped(OCP\Util::imagePath('octv', 'vol-.svg')) ?>"/></a>
</td><td>
<a href="#" alt="vol ++" data-command="volup" class="octv-control">    <img src="<?php print_unescaped(OCP\Util::imagePath('octv', 'vol+.svg')) ?>"/></a>
</td>
</tr>
</table>
</div>
