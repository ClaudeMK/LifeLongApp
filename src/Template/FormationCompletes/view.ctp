<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\FormationComplete $formationComplete
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Formation Complete'), ['action' => 'edit', $formationComplete->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Formation Complete'), ['action' => 'delete', $formationComplete->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formationComplete->id)]) ?> </li>
        <li>
        <?= $this->Html->link(__('Back'), ['controller' => 'Employees', 'action' => 'edit', $formationComplete->employee->id]) ?>
        </li>
    </ul>
</nav>
<div class="formationCompletes view large-9 medium-8 columns content">
    <h3><?= h($formationComplete->formation->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= h($formationComplete->employee->full_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment') ?></th>
            <td><?= h($formationComplete->comment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LastTime Completed') ?></th>
            <td><?= h($formationComplete->lastTime_completed) ?></td>
        </tr>
    </table>

    <div class="related">
        <h4><?= __('Related Attachments') ?></h4>
        <?php if (!empty($formationComplete->attachments)): ?>
        <table class="table table-striped table-hover ">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
            </tr>
            <?php foreach ($formationComplete->attachments as $attachments): ?>
            <tr>
                <td><a href="<?= $this->request->webroot . 'img/Files/'.h($attachments->name); ?>"><?= h($attachments->name) ?></a></td>
                <td><?= h($attachments->created) ?></td>
                <td><?= h($attachments->modified) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
