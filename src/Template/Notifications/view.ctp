<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Notification $notification
  */
?>
<nav class="col-md-2" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notification'), ['action' => 'edit', $notification->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notification'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id)]) ?> </li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="notifications view col-md-10 content">
    <h3><?= h($notification->title) ?></h3>
    <table class="table table-hover" cellpadding="0" cellspacing="0" style="margin-top:20px;">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($notification->title) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Formations') ?></h4>
        <?php if (!empty($notification->formations)): ?>
        <table class="table table-hover" cellpadding="0" cellspacing="0" style="margin-top:20px;">
            <tr>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Category') ?></th>
                <th scope="col"><?= __('Frequency') ?></th>
                <th scope="col"><?= __('Modality') ?></th>
                <th scope="col"><?= __('Duration') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($notification->formations as $formations): ?>
            <tr>
                <td><?= h($formations->number) ?></td>
                <td><?= h($formations->title) ?></td>
                <td><?= h($formations->category->title) ?></td>
                <td><?= h($formations->frequency->title) ?></td>
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
