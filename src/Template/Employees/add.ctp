<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="col-md-2" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="employees form col-md-10 content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Add Employee') ?></legend>
        <?php
            echo $this->Form->control('number', ['class' => 'form-control', 'id' => 'inputDefault']);
            echo $this->Form->control('civilitie_id', ['class' => 'form-control', 'id' => 'exampleSelect1']);
            echo $this->Form->control('last_name', ['class' => 'form-control', 'id' => 'inputDefault']);
            echo $this->Form->control('first_name', ['class' => 'form-control', 'id' => 'inputDefault']);
            echo $this->Form->control('language_id', ['options' => $languages, 'class' => 'form-control', 'id' => 'exampleSelect1']);
            echo $this->Form->control('cell_number', ['class' => 'form-control', 'id' => 'inputDefault']);
            echo $this->Form->control('email', ['class' => 'form-control', 'id' => 'inputDefault']);
            echo $this->Form->control('position_title_id', ['options' => $positionTitles, 'class' => 'form-control', 'id' => 'exampleSelect1']);
            echo $this->Form->control('building_id', ['options' => $buildings, 'class' => 'form-control', 'id' => 'exampleSelect1']);
            echo $this->Form->control('parent_id', ['options' => $parentEmployees, 'value' => '1', 'class' => 'form-control', 'id' => 'exampleSelect1']);
            echo $this->Form->control('additional_Infos', ['class' => 'form-control', 'id' => 'exampleTextarea', 'rows' => '3']);

            echo $this->Form->control('active', ['class' => 'form-check-input']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-filter']) ?>
    <?= $this->Form->end() ?>
</div>
