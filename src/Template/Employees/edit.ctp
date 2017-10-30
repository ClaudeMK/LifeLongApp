<?php
/**
  * @var \App\View\AppView $this
  */
  use Cake\I18n\Time;
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Send formation plan'), ['action' => 'sendFormationPlan', $employee->id, 'edit']) ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $employee->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?></li>
        
    </ul>
</nav>
<div class="employees form large-10 medium-9 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Edit Employee') ?></legend>
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
            echo $this->Form->control('parent_id', ['options' => $parentEmployees]);
            echo $this->Form->control('additional_Infos');
            echo $this->Form->control('last_sent_formation_plan', ['empty' => true]);
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

    <div class="related">
      <h4><?= __('Related Formations') ?></h4>
      <?php $compteur = 0; ?>
      <?php if(!empty($employee->position_title->formations)): ?>
        <table cellpadding="0" cellspacing="0">
          <tr>
              <th scope="col"><?= __('title') ?></th>
              <th scope="col"><?= __('Category') ?></th>
              <th scope="col"><?= __('lastTimeCompleted') ?></th>
              <th scope="col" class="actions"><?= __('Actions') ?></th>
          </tr>

          <?php foreach ($employee->position_title->formations as $index => $formations): ?>

                <?php
                $date = null;
                    foreach($formationComplete as $FC):
                        if($FC->formation_id == $formations->id){
                            $formationC = $FC;
                        }
                    endforeach;
                ?>
                <tr>
                    <td><?= h($formations->title) ?></td>
                    <td><?= h($formations->category->title) ?></td>
                    <td><?php if($formationC->lastTime_completed == null){
                        echo(__('The formation was never completed'));
                    } else {
                        echo($formationC->lastTime_completed);
                    }?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'formationCompletes', 'action' => 'view', $formationC->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'formationCompletes', 'action' => 'edit', $formationC->id]) ?>
                    </td>
                </tr>

          <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>

    <?php /*foreach($formationComplete as $formationComplete): ?>
      <?= ($formationComplete->id) ?>
    <?php endforeach; */?>


</div>
