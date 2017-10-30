<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Attachment $attachment
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Attachment'), ['action' => 'edit', $attachment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Attachment'), ['action' => 'delete', $attachment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attachment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Attachments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attachment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Formation Completes'), ['controller' => 'FormationCompletes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Formation Complete'), ['controller' => 'FormationCompletes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="attachments view large-9 medium-8 columns content">
    <h3><?= h($attachment->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Formation Complete') ?></th>
            <td><?= $attachment->has('formation_complete') ? $this->Html->link($attachment->formation_complete->id, ['controller' => 'FormationCompletes', 'action' => 'view', $attachment->formation_complete->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td> <?= $this->Html->link($attachment->name, ['controller' => 'Attachments', 'action' => 'download', $attachment->name])?>
                </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Path') ?></th>
            <td><?= h($attachment->path) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($attachment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($attachment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($attachment->modified) ?></td>
        </tr>
    </table>
</div>
