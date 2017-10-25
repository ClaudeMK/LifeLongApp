<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\FormationComplete[]|\Cake\Collection\CollectionInterface $formationCompletes
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Formation Complete'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Formations'), ['controller' => 'Formations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Formation'), ['controller' => 'Formations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="formationCompletes index large-9 medium-8 columns content">
    <h3><?= __('Formation Completes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('employee_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('formation_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lastTime_completed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formationCompletes as $formationComplete): ?>
            <tr>
                <td><?= $this->Number->format($formationComplete->id) ?></td>
                <td><?= $formationComplete->has('employee') ? $this->Html->link($formationComplete->employee->full_name, ['controller' => 'Employees', 'action' => 'view', $formationComplete->employee->id]) : '' ?></td>
                <td><?= $formationComplete->has('formation') ? $this->Html->link($formationComplete->formation->title, ['controller' => 'Formations', 'action' => 'view', $formationComplete->formation->id]) : '' ?></td>
                <td><?= h($formationComplete->lastTime_completed) ?></td>
                <td><?= h($formationComplete->comment) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $formationComplete->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $formationComplete->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $formationComplete->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formationComplete->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
