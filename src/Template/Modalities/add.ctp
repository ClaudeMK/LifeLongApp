<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="col-md-2" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Back'), ['controller' => 'Modalities', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="modalities form col-md-10 content">
    <?= $this->Form->create($modality) ?>
    <fieldset>
        <legend><?= __('Add Modality') ?></legend>
        <?php
            echo $this->Form->control('title', ['class' => 'form-control', 'id' => 'inputDefault']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-filter']) ?>
    <?= $this->Form->end() ?>
</div>
