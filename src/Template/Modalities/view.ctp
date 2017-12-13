<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Modality $modality
  */
?>
<nav class="col-md-2" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Modality'), ['action' => 'edit', $modality->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Modality'), ['action' => 'delete', $modality->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modality->id)]) ?> </li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="modalities view col-md-10 content">
    <h3><?= h($modality->title) ?></h3>
    <table class="table table-hover" cellpadding="0" cellspacing="0" style="margin-top:20px;">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($modality->title) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Formations') ?></h4>
        <?php if (!empty($modality->formations)): ?>
        <table class="table table-hover" cellpadding="0" cellspacing="0" style="margin-top:20px;">
            <tr>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col"><?= __('title') ?></th>
                <th scope="col"><?= __('Category') ?></th>
                <th scope="col"><?= __('Frequency') ?></th>
                <th scope="col"><?= __('Notification') ?></th>
                <th scope="col"><?= __('Duration') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($modality->formations as $formations): ?>
            <tr>
                <td><?= h($formations->number) ?></td>
                <td><?= h($formations->title) ?></td>
                <td><?= h($formations->category->title) ?></td>
                <td><?= h($formations->frequency->title) ?></td>
                <td><?= h($formations->notification->title) ?></td>
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
