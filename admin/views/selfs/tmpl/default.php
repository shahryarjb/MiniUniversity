<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  COM_MINIUNIVERSITY
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);
?>
<form action="index.php?option=com_miniuniversity&view=selfs" method="post" id="adminForm" name="adminForm">
	<div class="row-fluid">
		<div class="span6">
			<?php echo JText::_('COM_MINIUNIVERSITY_ADMIN_PANEL_LIB'); ?>
			<?php
				echo JLayoutHelper::render(
					'joomla.searchtools.default',
					array('view' => $this)
				);
			?>
		</div>
	</div>
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%"><?php echo JText::_('COM_MINIUNIVERSITY_NUM'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
			<th width="30%">
				<?php echo JHtml::_('grid.sort', 'COM_MINIUNIVERSITY_SELFS_NAME', 'name', $listDirn, $listOrder); ?>
			</th>
			<th width="30%">
				<?php echo JHtml::_('grid.sort', 'COM_MINIUNIVERSITY_SELFS_FAMILY', 'family', $listDirn, $listOrder); ?>
			</th>
			<th width="30%">
				<?php echo JHtml::_('grid.sort', 'COM_MINIUNIVERSITY_SELF_IP_NUM', 'ip', $listDirn, $listOrder); ?>
			</th>
			<th width="5%">
				<?php echo JHtml::_('grid.sort', 'COM_MINIUNIVERSITY_SELF_STU_NUM', 'stu_num', $listDirn, $listOrder); ?>
			</th>
			<th width="2%">
				<?php echo JHtml::_('grid.sort', 'COM_MINIUNIVERSITY_SELF_PAID', 'paid', $listDirn, $listOrder); ?>
			</th>
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
			<?php if (!empty($this->items)) { ?>
				<?php foreach ($this->items as $i => $row) :
					$link = JRoute::_('index.php?option=com_miniuniversity&task=self.edit&id=' . $row->id);
				?>
					<tr>
						<td><?php echo $this->pagination->getRowOffset($i); ?></td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINIUNIVERSITY_EDIT_TEACHER'); ?>">
								<?php echo htmlspecialchars($row->name); ?>
							</a>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINIUNIVERSITY_EDIT_TEACHER'); ?>">
								<?php echo htmlspecialchars($row->family); ?>
							</a>
						</td>
						<td>
								<?php echo htmlspecialchars($row->ip); ?>
						</td>
						<td align="center">
							<?php echo $row->stu_num; ?>
						</td>
						<td align="center">
	                   <?php  echo JHtml::_('jgrid.published', $row->paid, $i, 'selfs.', true, 'cb'); ?>
						</td>
						
						
					</tr>
				<?php endforeach; ?>
			<?php } else {
				echo JText::_('COM_MINIUNIVERSITY_LIB_EMPTY');

			} ?>
		</tbody>
	</table>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>

