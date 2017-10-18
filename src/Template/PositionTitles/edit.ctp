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
                ['action' => 'delete', $positionTitle->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $positionTitle->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="positionTitles form large-10 medium-9 columns content">
    <?= $this->Form->create($positionTitle) ?>
    <fieldset>
        <legend><?= __('Edit Position Title') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('formations._ids', ['options' => $formations]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
