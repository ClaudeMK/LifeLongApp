<div style="text-align: center; margin-top: 60px; margin-bottom: 30px;">
    <?= $this->Html->image('logo/lifelongBlue.png', ["alt" => "Lifelong Application"]); ?>
</div>
<div class="users form">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('username', ['class' => 'form-control', 'id' => 'inputDefault']) ?>
        <?= $this->Form->control('password', ['class' => 'form-control', 'id' => 'exampleInputPassword1']) ?>
        <?= $this->Form->hidden('form', ['value' => '1']) ?>
    </fieldset>
<?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary btn-filter']); ?>
<?= $this->Form->end() ?>
</div>
<br /><br /><br />
<div class="email form">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email address to receive your formation plan') ?></legend>
        <?= $this->Form->control('email', ['class' => 'form-control', 'id' => 'exampleInputEmail1']) ?>
        <?= $this->Form->hidden('form', ['value' => '2']) ?>
    </fieldset>
<?= $this->Form->button(__('Send'), ['class' => 'btn btn-primary btn-filter']); ?>
<?= $this->Form->end() ?>
</div>
