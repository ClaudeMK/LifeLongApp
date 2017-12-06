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
    <h3><?= __('Quick Update - CSV File') ?></h3>
    <label for="csvFile">CSV File</label>
    <input type="file" name="csvFile" />
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    
    <?php 
    if(!empty($csvErrors)) { ?>
        <br /><br /><br />
        <h4>Errors</h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col">Line</th>
                <th scope="col">Error</th>
            </tr>
            <?php foreach($csvErrors as $error): ?>
            <tr>
                <td>
                    <?= $error[0]; ?>
                </td>
                <td>
                    <?= $error[1]; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php } ?>
</div>
