<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\FormationComplete $formationComplete
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Formation Complete'), ['action' => 'edit', $formationComplete->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Formation Complete'), ['action' => 'delete', $formationComplete->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formationComplete->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Formation Completes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Formation Complete'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Formations'), ['controller' => 'Formations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Formation'), ['controller' => 'Formations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="formationCompletes view large-9 medium-8 columns content">
    <h3><?= h($formationComplete->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $formationComplete->has('employee') ? $this->Html->link($formationComplete->employee->full_name, ['controller' => 'Employees', 'action' => 'view', $formationComplete->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Formation') ?></th>
            <td><?= $formationComplete->has('formation') ? $this->Html->link($formationComplete->formation->title, ['controller' => 'Formations', 'action' => 'view', $formationComplete->formation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment') ?></th>
            <td><?= h($formationComplete->comment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($formationComplete->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LastTime Completed') ?></th>
            <td><?= h($formationComplete->lastTime_completed) ?></td>
        </tr>
    </table>
</div>
