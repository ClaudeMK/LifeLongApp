<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Civility $civility
  */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Civility'), ['action' => 'edit', $civility->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Civility'), ['action' => 'delete', $civility->id], ['confirm' => __('Are you sure you want to delete # {0}?', $civility->id)]) ?> </li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="civilities view large-10 medium-9 columns content">
    <h3><?= h($civility->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($civility->title) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Employees') ?></h4>
        <?php if (!empty($civility->employees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Cell Number') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Position Title') ?></th>
                <th scope="col"><?= __('Supervisor') ?></th>
                <th scope="col"><?= __('Last Sent Formation Plan') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($civility->employees as $employees): ?>
            <tr>
                <td><?= h($employees->number) ?></td>
                <td><?= h($employees->last_name) ?></td>
                <td><?= h($employees->first_name) ?></td>
                <td><?= h($employees->cell_number) ?></td>
                <td><?= h($employees->email) ?></td>
                <td><?= h($employees->position_title->title) ?></td>
                
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
