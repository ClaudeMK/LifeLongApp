<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="col-md-2" id="actions-sidebar">
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
<div class="buildings form col-md-10 content">
    <?= $this->Form->create($building) ?>
    <fieldset>
        <legend><?= __('Edit Building') ?></legend>
        <?php
            echo $this->Form->control('address', ['class' => 'form-control', 'id' => 'inputDefault']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-filter']) ?>
    <?= $this->Form->end() ?>
</div>
