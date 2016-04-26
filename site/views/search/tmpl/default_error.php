<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */

defined('_JEXEC') or die;
JHtml::stylesheet(JURI::root().'components/com_miniuniversity/css/style.css');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
JHtml::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
?>

<?php if ($this->error) : ?>
<div class="error">
			<?php echo $this->escape($this->error); ?>
</div>
<?php endif; ?>
