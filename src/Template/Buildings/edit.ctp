<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $building->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $building->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="buildings form large-10 medium-9 columns content">
    <?= $this->Form->create($building) ?>
    <fieldset>
        <legend><?= __('Edit Building') ?></legend>
        <?php
            echo $this->Form->control('address');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
