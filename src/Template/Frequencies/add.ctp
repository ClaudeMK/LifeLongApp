<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Back'), ['controller' => 'Frequencies', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="frequencies form large-10 medium-9 columns content">
    <?= $this->Form->create($frequency) ?>
    <fieldset>
        <legend><?= __('Add Frequency') ?></legend>
        <?php
            echo $this->Form->control('title');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
