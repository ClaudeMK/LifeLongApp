<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Back'), ['controller' => 'PositionTitles', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="positionTitles form large-10 medium-9 columns content">
    <?= $this->Form->create($positionTitle) ?>
    <fieldset>
        <legend><?= __('Add Position Title') ?></legend>
        <?php
            echo $this->Form->control('title');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
