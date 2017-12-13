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
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form col-md-10 content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('username', ['class' => 'form-control', 'id' => 'inputDefault']);
            echo $this->Form->control('password', ['class' => 'form-control', 'id' => 'exampleInputPassword1']);
            echo $this->Form->control('role', [
            'options' => ['Administrator' => 'Administrator', 'Coordinator' => 'Coordinator'], 'class' => 'form-control', 'id' => 'exampleSelect1'
            ])
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-filter']) ?>
    <?= $this->Form->end() ?>
</div>
