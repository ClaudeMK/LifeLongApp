<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="col-md-2" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Back'), ['controller' => 'Notifications', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="notifications form col-md-10 content">
    <?= $this->Form->create($notification) ?>
    <fieldset>
        <legend><?= __('Add Notification') ?></legend>
        <?php
            echo $this->Form->control('title', ['class' => 'btn btn-primary btn-filter']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-filter']) ?>
    <?= $this->Form->end() ?>
</div>
