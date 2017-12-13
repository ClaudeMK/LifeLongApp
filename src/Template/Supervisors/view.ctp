<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Employee $supervisor
  */
?>
<nav class="col-md-2" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $supervisor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $supervisor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supervisor->id)]) ?> </li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="employees view col-md-10 content">
    <h3><?= h($supervisor->id) ?></h3>
    <table class="table table-hover" cellpadding="0" cellspacing="0" style="margin-top:20px;">
        <tr>
            <th scope="row"><?= __('Number') ?></th>
            <td><?= h($supervisor->number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Civility') ?></th>
            <td><?= h($supervisor->civility->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($supervisor->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($supervisor->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= h($supervisor->language->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cell Number') ?></th>
            <td><?= h($supervisor->cell_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($supervisor->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Position Title') ?></th>
            <td><?= h($supervisor->position_title->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Building') ?></th>
            <td><?= h($supervisor->building->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supervisor') ?></th>

            <td>
                <?php if($supervisor->parent_id !== 0){?>
                <?= h($supervisor->parent_employee->first_name . ' ' . $supervisor->parent_employee->last_name) ?>
                <?php } ?>
            </td>

        </tr>
        <tr>
            <th scope="row"><?= __('Additional Infos') ?></th>
            <td><?= h($supervisor->additional_Infos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Sent Formation Plan') ?></th>
            <td><?= h($supervisor->last_sent_formation_plan) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $supervisor->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Employees') ?></h4>
        <?php if (!empty($supervisor->child_employees)): ?>
        <table class="table table-hover" cellpadding="0" cellspacing="0" style="margin-top:20px;">
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
            <?php foreach ($supervisor->child_employees as $childEmployees): ?>
            <tr>
                <td><?= h($childEmployees->number) ?></td>
                <td><?= h($childEmployees->last_name) ?></td>
                <td><?= h($childEmployees->first_name) ?></td>
                <td><?= h($childEmployees->cell_number) ?></td>
                <td><?= h($childEmployees->email) ?></td>
                <td><?= h($childEmployees->position_title->title) ?></td>
                <td><?= h($childEmployees->last_sent_formation_plan) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $childEmployees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employees', 'action' => 'delete', $childEmployees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childEmployees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
