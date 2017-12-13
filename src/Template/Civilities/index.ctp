<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Civility[]|\Cake\Collection\CollectionInterface $civilities
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
        <li><?= '<li>'.$this->Html->link(__('Quick Update - Manual'), ['controller' => 'FormationCompletes', 'action' => 'quickUpdate']).'</li>'; ?></li>
        <li><?= '<li>'.$this->Html->link(__('Quick Update - CSV File'), ['controller' => 'FormationCompletes', 'action' => 'quickUpdateCsv']).'</li>'; ?></li>
    </ul>
    <br /><br />
    <ul class="side-nav">
        <li class="heading"><?= __('Actions Civilities') ?></li>
        <li><?= $this->Html->link(__('New Civilities'), ['controller' => 'Civilities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="civilities index col-md-10 content">
    <h3><?= __('Civilities') ?></h3>
    <table class="table table-hover" cellpadding="0" cellspacing="0" style="margin-top:20px;">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($civilities as $civility): ?>
            <tr>
                <td><?= h($civility->title) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $civility->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $civility->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $civility->id], ['confirm' => __('Are you sure you want to delete # {0}?', $civility->id)]) ?>
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
