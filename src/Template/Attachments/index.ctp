<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Attachment[]|\Cake\Collection\CollectionInterface $attachments
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Attachment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Formation Completes'), ['controller' => 'FormationCompletes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Formation Complete'), ['controller' => 'FormationCompletes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="attachments index large-9 medium-8 columns content">
    <h3><?= __('Attachments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('formation_complete_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('path') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attachments as $attachment): ?>
            <tr>
                <td><?= $this->Number->format($attachment->id) ?></td>
                <td><?= $attachment->has('formation_complete') ? $this->Html->link($attachment->formation_complete->id, ['controller' => 'FormationCompletes', 'action' => 'view', $attachment->formation_complete->id]) : '' ?></td>
                <td><?= h($attachment->name) ?></td>
                <td><?= h($attachment->path) ?></td>
                <td><?= h($attachment->created) ?></td>
                <td><?= h($attachment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $attachment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attachment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attachment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attachment->id)]) ?>
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
