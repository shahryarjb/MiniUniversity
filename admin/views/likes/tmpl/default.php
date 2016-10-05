<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_miniuniversity
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);

echo "</br>";
?>
<form action="index.php?option=com_miniuniversity&view=likes" method="post" id="adminForm" name="adminForm">
	<div class="row-fluid">
		<div class="span6">

		<!---- cod search va  ..... khode joomla  -->
			<?php echo JText::_('COM_MINIUNIVERSITY_LIKES_FILTER'); ?>
			<?php
				echo JLayoutHelper::render(
					'joomla.searchtools.default',
					array('view' => $this)
				);
			?>
		<!---- cod search va  ..... khode joomla  -->
		</div>
	</div>
	<table class="table table-striped table-hover">
		<thead>
		<tr>
		<!---- header balaye filde -->
			<th width="1%"><?php echo JText::_('COM_MINIUNIVERSITY_NUM'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
			<th width="20%">
				<?php echo JHtml::_('grid.sort', 'COM_MINIUNIVERSITY_TECHID', 'tech_id', $listDirn, $listOrder); ?>
			</th>
			<th width="70%">
				<?php echo JHtml::_('grid.sort','COM_MINIUNIVERSITY_USERID' , 'user_id', $listDirn, $listOrder); ?>
			</th>
			<th width="5%">
				<?php echo JHtml::_('grid.sort', 'COM_MINIUNIVERSITY_DATE', 'date', $listDirn, $listOrder); ?>
			</th>
			<th width="2%">
				<?php echo JHtml::_('grid.sort', 'COM_MINIUNIVERSITY_IP', 'ip', $listDirn, $listOrder); ?>
			</th>
		<!---- header balaye filde -->
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
					$link = JRoute::_('index.php?option=com_miniuniversity&task=like.edit&id=' . $row->id);
				?>
					<tr>
						<td><?php echo $this->pagination->getRowOffset($i); ?></td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINIUNIVERSITY_EDIT_LIKE'); ?>">
							<?php echo $row->tech_id; ?>
							</a>
						</td>
						<td>
							<?php echo $row->user_id; ?>
						</td>
						<td align="center">
							<?php echo $row->date; ?>
						</td>
						<td align="center">
							<?php echo $row->ip; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<?php echo JHtml::_('form.token'); ?>
</form>

