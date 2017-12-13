<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="col-md-2" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Back'), ['controller' => 'Formations', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="formations form col-md-10 content">
    <?= $this->Form->create($formation) ?>
    <fieldset>
        <legend><?= __('Add Formation') ?></legend>
        <?php
            echo $this->Form->control('number', ['class' => 'form-control', 'id' => 'inputDefault']);
            echo $this->Form->control('title', ['class' => 'form-control', 'id' => 'inputDefault']);
            echo $this->Form->control('categorie_id', ['options' => $categories, 'class' => 'form-control', 'id' => 'exampleSelect1']);
            echo $this->Form->control('frequencie_id', ['options' => $frequencies, 'class' => 'form-control', 'id' => 'exampleSelect1']);
            echo $this->Form->control('notification_id', ['options' => $frequencies, 'class' => 'form-control', 'id' => 'exampleSelect1']);
            echo $this->Form->control('modalitie_id', ['options' => $modalities, 'class' => 'form-control', 'id' => 'exampleSelect1']);
            echo $this->Form->control('duration');
            echo $this->Form->control('note', ['class' => 'form-control', 'id' => 'exampleTextarea', 'rows' => '3']);
            echo $this->Form->control('position_titles._ids', ['options' => $positionsTitles, 'class' => 'form-control', 'id' => 'exampleSelect2']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-filter']) ?>
    <?= $this->Form->end() ?>
</div>
