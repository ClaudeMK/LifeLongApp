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
                ['action' => 'delete', $positionTitle->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $positionTitle->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="positionTitles form col-md-10 content">
    <?= $this->Form->create($positionTitle) ?>
    <fieldset>
        <legend><?= __('Edit Position Title') ?></legend>
        <?php
            echo $this->Form->control('title', ['class' => 'btn btn-primary btn-filter']);
            echo $this->Form->control('formations._ids', ['options' => $formations, 'class' => 'form-control', 'id' => 'exampleSelect2']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-filter']) ?>
    <?= $this->Form->end() ?>
</div>
