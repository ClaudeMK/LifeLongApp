<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="employees form large-10 medium-9 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Add Employee') ?></legend>
        <?php
            echo $this->Form->control('number');
            echo $this->Form->control('civilitie_id');
            echo $this->Form->control('last_name');
            echo $this->Form->control('first_name');
            echo $this->Form->control('language_id', ['options' => $languages]);
            echo $this->Form->control('cell_number');
            echo $this->Form->control('email');
            echo $this->Form->control('position_title_id', ['options' => $positionTitles]);
            echo $this->Form->control('building_id', ['options' => $buildings]);
            echo $this->Form->control('parent_id', ['options' => $parentEmployees, 'value' => '1']);
            echo $this->Form->control('additional_Infos');
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
