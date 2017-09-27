<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PositionTitle $positionTitle
  */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Position Title'), ['action' => 'edit', $positionTitle->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Position Title'), ['action' => 'delete', $positionTitle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $positionTitle->id)]) ?> </li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="positionTitles view large-10 medium-9 columns content">
    <h3><?= h($positionTitle->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($positionTitle->title) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Employees') ?></h4>
        <?php if (!empty($positionTitle->employees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Cell Number') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Supervisor') ?></th>
                <th scope="col"><?= __('Last Sent Formation Plan') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($positionTitle->employees as $employees): ?>
            <tr>
                <td><?= h($employees->number) ?></td>
                <td><?= h($employees->last_name) ?></td>
                <td><?= h($employees->first_name) ?></td>
                <td><?= h($employees->cell_number) ?></td>
                <td><?= h($employees->email) ?></td>
                <td>
                    <?php if($employee->parent_id !== 0){?>
                    <?= h($employees->parent_employee->first_name . ' ' . $employees->parent_employee->last_name) ?>
                    <?php } ?>
                </td>
                <td><?= h($employees->last_sent_formation_plan) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Employees', 'action' => 'view', $employees->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $employees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employees', 'action' => 'delete', $employees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
