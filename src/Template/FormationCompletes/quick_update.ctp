<?php
    $urlToLinkedListFilter = $this->Url->build([
        "controller" => "FormationCompletes",
        "action" => "getFormations",
        "_ext" => "json"
            ]);
    echo $this->Html->scriptBlock('var urlToLinkedListFilter = "' . $urlToLinkedListFilter . '";', ['block' => true]);
    echo $this->Html->script('quickUpdate');
?>
<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
  */
$loguser = $this->request->session()->read('Auth.User');
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Navigation') ?></li>
        <li><?= $this->Html->link(__('Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <?php if($loguser['role'] === 'Administrator') {
            echo '<li>'.$this->Html->link(__('Civilities'), ['controller' => 'Civilities', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Languages'), ['controller' => 'Languages', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Position Titles'), ['controller' => 'PositionTitles', 'action' => 'index']).'</li>';
        } ?>
        <li><?= $this->Html->link(__('Formations'), ['controller' => 'Formations', 'action' => 'index']) ?> </li>
        <?php if($loguser['role'] === 'Administrator') {
            echo '<li>'.$this->Html->link(__('Buildings'), ['controller' => 'Buildings', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Categories'), ['controller' => 'Categories', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Frequencies'), ['controller' => 'Frequencies', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Modalities'), ['controller' => 'Modalities', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Notifications'), ['controller' => 'Notifications', 'action' => 'index']).'</li>';
            echo '<li>'.$this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']).'</li>';
        } ?>
        <br />
        <li><?= '<li>'.$this->Html->link(__('Quick Update - Manual'), ['controller' => 'FormationCompletes', 'action' => 'quickUpdate']).'</li>'; ?></li>
        <li><?= '<li>'.$this->Html->link(__('Quick Update - CSV File'), ['controller' => 'FormationCompletes', 'action' => 'quickUpdateCsv']).'</li>'; ?></li>
    </ul>
</nav>
<div class="formationCompletes form large-9 medium-8 columns content">
    <?= $this->Form->create($formationComplete, ['type' => 'file']) ?>
    <h3><?= __('Quick Update - Manual') ?></h3>
    <?php $this->Html->script('quickUpdate', ['block' => true]); ?>
    <?php
        echo $this->Form->control('employee_id', ['default' => $selectedEmployee->id]);
        echo $this->Form->control('formation_id', ['options'  => $cleanFormations]);
        echo $this->form->control('lastTime_completed', ['type' => 'text', 'id' => 'datepicker', 'placeholder' => date('m-d-y')]);   
        echo $this->Form->control('comment', ['default' => '']);
    ?><br />
    <label for="pieceJointe">Attachment</label>
    <input type="file" name="pieceJointe" />
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<!-- Script pour le date picker -->
<script>
$( function() {
  $( "#datepicker" ).datepicker({
      dateFormat: "m/d/y"
  });
} );
</script>
