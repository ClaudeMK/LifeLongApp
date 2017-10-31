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
        <li>
        <?= $this->Html->link(__('Back'), ['controller' => 'Employees', 'action' => 'edit', $employees->id]) ?>
        </li>
    </ul>
</nav>
<div class="formationCompletes form large-9 medium-8 columns content">
    <?= $this->Form->create($formationComplete) ?>
    <fieldset>
        <legend><?= __('Edit Formation Completion') ?></legend>
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


