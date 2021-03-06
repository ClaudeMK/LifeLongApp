<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $supervisors
  */
$loguser = $this->request->session()->read('Auth.User');
?>
<nav class="col-md-2" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Navigation') ?></li>
        <li><?= $this->Html->link(__('Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
    </ul>
    <br /><br />
    <ul class="side-nav">
        <li class="heading"><?= __('Actions Supervisors') ?></li>
        <li><?= $this->Html->link(__('Edit Rapport#4'), ['controller' => 'Supervisors', 'action' => 'rapportFour']) ?> </li>
    </ul>
</nav>
<div class="employees index col-md-10 content">
    <h3><?= __('Employees') ?></h3>
    
    
    <table class="table table-hover" cellpadding="0" cellspacing="0" style="margin-top:20px;">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cell_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($supervisors as $supervisor): ?>       
                <tr>
                    <td><?= h($supervisor->number) ?></td>
                    <td><?= h($supervisor->last_name) ?></td>
                    <td><?= h($supervisor->first_name) ?></td>
                    <td><?= h($supervisor->cell_number) ?></td>
                    <td><?= h($supervisor->email) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $supervisor->id]) ?>
                        <?= $this->Html->link(__('Rapport#2'), ['action' => 'rapportTwo', $supervisor->id], array('target' => '_blank')) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <ul class="pagination pagination-small">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="pagination-counter"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
