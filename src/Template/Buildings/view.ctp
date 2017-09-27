<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Building $building
  */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Building'), ['action' => 'edit', $building->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Building'), ['action' => 'delete', $building->id], ['confirm' => __('Are you sure you want to delete # {0}?', $building->id)]) ?> </li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="buildings view large-10 medium-9 columns content">
    <h3><?= h($building->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($building->address) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Employees') ?></h4>
        <?php if (!empty($building->employees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col"><?= __('Civility') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Language') ?></th>
                <th scope="col"><?= __('Cell Number') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Position Title') ?></th>
                <th scope="col"><?= __('Supervisor') ?></th>
                <th scope="col"><?= __('Last Sent Formation Plan') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($building->employees as $employees): ?>
            <tr>
                <td><?= h($employees->number) ?></td>
                <td><?= h($employees->civility->title) ?></td>
                <td><?= h($employees->last_name) ?></td>
                <td><?= h($employees->first_name) ?></td>
                <td><?= h($employees->language->title) ?></td>
                <td><?= h($employees->cell_number) ?></td>
                <td><?= h($employees->email) ?></td>
                <td><?= h($employees->position_title->title) ?></td>
                <td><?= h($employees->parent_employee->first_name . ' ' . $employees->parent_employee->last_name) ?></td>
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
