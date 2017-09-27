<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Frequency $frequency
  */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Frequency'), ['action' => 'edit', $frequency->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Frequency'), ['action' => 'delete', $frequency->id], ['confirm' => __('Are you sure you want to delete # {0}?', $frequency->id)]) ?> </li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="frequencies view large-10 medium-9 columns content">
    <h3><?= h($frequency->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($frequency->title) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Formations') ?></h4>
        <?php if (!empty($frequency->formations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col"><?= __('title') ?></th>
                <th scope="col"><?= __('Category') ?></th>
                <th scope="col"><?= __('Notification') ?></th>
                <th scope="col"><?= __('Modality') ?></th>
                <th scope="col"><?= __('Duration') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($frequency->formations as $formations): ?>
            <tr>
                <td><?= h($formations->number) ?></td>
                <td><?= h($formations->title) ?></td>
                <td><?= h($formations->category->title) ?></td>
                <td><?= h($formations->notification->title) ?></td>
                <td><?= h($formations->modality->title) ?></td>
                <td><?= h($formations->duration) ?></td>
                <td><?= h($formations->note) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Formations', 'action' => 'view', $formations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Formations', 'action' => 'edit', $formations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Formations', 'action' => 'delete', $formations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
