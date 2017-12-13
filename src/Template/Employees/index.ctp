<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
  */
$loguser = $this->request->session()->read('Auth.User');
?>
<nav class="col-md-2" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Navigation') ?></li>
        <li><?= $this->Html->link(__('Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <?php if($loguser['role'] === 'Administrator') {
            echo '<li>'.$this->Html->link(__('Civilities'), ['controller' => 'Civilities', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Languages'), ['controller' => 'Languages', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Position Titles'), ['controller' => 'PositionTitles', 'action' => 'index']).'</li>';
        } ?>
        <li><?= $this->Html->link(__('Formations'), ['controller' => 'Formations', 'action' => 'index']) ?> </li>
        <?php if($loguser['role'] === 'Administrator') {
            echo '<li>'.$this->Html->link(__('Buildings'), ['controller' => 'Buildings', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Categories'), ['controller' => 'Categories', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Frequencies'), ['controller' => 'Frequencies', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Modalities'), ['controller' => 'Modalities', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Notifications'), ['controller' => 'Notifications', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']).'</li>';
        } ?>
        <br />
        <li><?= '<li>'.$this->Html->link(__('List of supervisors'), ['controller' => 'Supervisors', 'action' => 'index']).'</li>'; ?></li>
        <li><?= '<li>'.$this->Html->link(__('Quick Update - Manual'), ['controller' => 'FormationCompletes', 'action' => 'quickUpdate']).'</li>'; ?></li>
        <li><?= '<li>'.$this->Html->link(__('Quick Update - CSV File'), ['controller' => 'FormationCompletes', 'action' => 'quickUpdateCsv']).'</li>'; ?></li>

    </ul>
    <br /><br />
    <ul class="side-nav">
        <li class="heading"><?= __('Actions Employees') ?></li>
        <li><?= $this->Html->link(__('New Employees'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employees index col-md-10 content">
    <h3><?= __('Employees') ?></h3>
    <?php
    echo $this->Form->create(null, ['valueSources' => 'query']);
    echo $this->Form->input('number', ['class' => 'btn btn-primary btn-filter']);
    echo $this->Form->input('first_name', ['class' => 'btn btn-primary btn-filter']);
    echo $this->Form->input('last_name', ['class' => 'btn btn-primary btn-filter']);
    echo $this->Form->button('Filter', ['type' => 'submit', 'class' => 'btn btn-primary btn-filter']);
    echo $this->Html->link('Reset', ['action' => 'index', 'class' => 'reset-link']);
    echo $this->Form->end();
    ?>
    
    <table class="table table-hover" cellpadding="0" cellspacing="0" style="margin-top:20px;">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cell_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('position_title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Supervisor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_sent_formation_plan') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
            <?php if($employee->id != 1) { ?>          
                <tr>
                    <td><?= h($employee->number) ?></td>
                    <td><?= h($employee->last_name) ?></td>
                    <td><?= h($employee->first_name) ?></td>
                    <td><?= h($employee->cell_number) ?></td>
                    <td><?= h($employee->email) ?></td>
                    <td><?= h($employee->position_title->title) ?></td>
                    <td>
                        <?php if($employee->parent_id != 1){?>
                            <?= h($employee->parent_employee->first_name . ' ' . $employee->parent_employee->last_name) ?>
                        <?php } ?>
                    </td>
                    <td><?= h($employee->last_sent_formation_plan) ?></td>
                    <td class="actions">
                        <!--<?= $this->Html->link(__('View'), ['action' => 'view', $employee->id]) ?>-->
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employee->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employee->id], ['confirm' => __('Êtes-vous sûr de vouloir supprimer # {0}?', $employee->id)]) ?>
                        <?= $this->Html->link(__('Send'), ['action' => 'sendFormationPlan', $employee->id, 'index']) ?>
                    </td>
                </tr>
            <?php } ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="pagination-counter"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
