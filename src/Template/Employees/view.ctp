<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Employee $employee
  */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?> </li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="employees view large-10 medium-9 columns content">
    <h3><?= h($employee->id) ?></h3>
    <div style="float: right">
        <?= $this->Html->link(__('Send formation plan'), ['action' => 'sendFormationPlan', $employee->id, 'view']) ?>
        <br/>
        <br/>
    </div>
    
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Number') ?></th>
            <td><?= h($employee->number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Civility') ?></th>
            <td><?= h($employee->civility->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($employee->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($employee->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= h($employee->language->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cell Number') ?></th>
            <td><?= h($employee->cell_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($employee->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Position Title') ?></th>
            <td><?= h($employee->position_title->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Building') ?></th>
            <td><?= h($employee->building->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supervisor') ?></th>
            
            <td>
                <?php if($employee->parent_id !== 0){?>
                <?= h($employee->parent_employee->first_name . ' ' . $employee->parent_employee->last_name) ?>
                <?php } ?>
            </td>
            
        </tr>
        <tr>
            <th scope="row"><?= __('Additional Infos') ?></th>
            <td><?= h($employee->additional_Infos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Sent Formation Plan') ?></th>
            <td><?= h($employee->last_sent_formation_plan) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $employee->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Employees') ?></h4>
        <?php if (!empty($employee->child_employees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Cell Number') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Position Title') ?></th>
                <th scope="col"><?= __('Last Sent Formation Plan') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->child_employees as $childEmployees): ?>
            <tr>
                <td><?= h($childEmployees->number) ?></td>
                <td><?= h($childEmployees->last_name) ?></td>
                <td><?= h($childEmployees->first_name) ?></td>
                <td><?= h($childEmployees->cell_number) ?></td>
                <td><?= h($childEmployees->email) ?></td>
                <td><?= h($childEmployees->position_title->title) ?></td>
                <td><?= h($childEmployees->last_sent_formation_plan) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Employees', 'action' => 'view', $childEmployees->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $childEmployees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employees', 'action' => 'delete', $childEmployees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childEmployees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
