<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $formationComplete->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $formationComplete->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Formation Completes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Formations'), ['controller' => 'Formations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Formation'), ['controller' => 'Formations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="formationCompletes form large-9 medium-8 columns content">
    <?= $this->Form->create($formationComplete) ?>
    <fieldset>
        <legend><?= __('Edit Formation Complete') ?></legend>
        <h5> <?= ('Formation : ' . $formations->title) ?> </h5>
        <h5> <?= ('Employee : ' . $employees->first_name) ?> </h5>
        <?php
            echo $this->Form->control('lastTime_completed');
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
