<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * tdmcreate module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         tdmcreate
 * @since           2.5.0
 * @author          Txmod Xoops http://www.txmodxoops.org
 * @version         $Id: footer.php 11084 2013-02-23 15:44:20Z timgno $
 */
echo "<div align='center'><a href='http://www.xoops.org' title='Visit XOOPS' target='_blank'>
         <img src='".$pathIcon32."/xoopsmicrobutton.gif' alt='XOOPS' /></a></div>";
echo "<div class='center smallsmall italic pad5'>
          <strong>" . $xoopsModule->getVar('name') . "</strong> is maintained by the 
            <a href='http://xoops.org/forums/newbb' title='Visit Support Forum' class='tooltip' rel='external'>Support Forum</a></div>";
xoops_cp_footer();