<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Back'), ['controller' => 'Formations', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="formations form large-10 medium-9 columns content">
    <?= $this->Form->create($formation) ?>
    <fieldset>
        <legend><?= __('Add Formation') ?></legend>
        <?php
            echo $this->Form->control('number');
            echo $this->Form->control('title');
            echo $this->Form->control('categorie_id', ['options' => $categories]);
            echo $this->Form->control('frequencie_id', ['options' => $frequencies]);
            echo $this->Form->control('notification_id', ['options' => $frequencies]);
            echo $this->Form->control('modalitie_id', ['options' => $modalities]);
            echo $this->Form->control('duration');
            echo $this->Form->control('note');
            echo $this->Form->control('position_titles._ids', ['options' => $positionsTitles]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
