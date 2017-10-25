INSERT INTO `position_title` (`title`) VALUES
(`finance coordinator`),
(`CAD coordinator`),
(`CMMS coordinator`),
(`SGEI manager`),
(`finance manager`),
(`program manager`), --------------------------------
(`property manager`),
(`team project manager`),
(`technical support manager`),
(`operation director`),
(`wallet director`),
(`operation specialist`),
(`manager of security`),
(`security adjoint`),
(`maintenance supervisor`),
(`member of the Health, Security and Environnement`),
(`Technician`),
(`electrician`),
(`property service coordinator`),
(`energy manager`),
(`Health and Security coordonator`),
(`Environnement coordinator`),
(`quality specialist`),
(``)

<table cellpadding="0" cellspacing="0">
      <tr>
          <th scope="col"><?= __('title') ?></th>
          <th scope="col"><?= __('status') ?></th>
          <th scope="col"><?= __('lastTimeCompleted') ?></th>
          <th scope="col" class="actions"><?= __('Actions') ?></th>
      </tr>

      <?php foreach($formationComplete as $formationComplete): ?>
            <?php
                $frequency = $employee->position_title->formations[$compteur]->frequency->title;
                $frequence = new Time($frequency);
                $lastTimeCompleted = new Time($formationComplete->lastTime_completed);
                if($lastTimeCompleted->wasWithinLast($frequency)){
                    $Completed = true;
                }else{
                    $Completed = false;
                }?>
            <tr>
                <td><?= ($employee->position_title->formations[$compteur]->title) ?></td>
                <td>
                <?php if($Completed == true){
                    echo __('completé');
                } else {
                    echo __('Non complété');
                } ?>
                </td>
                <td>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'formationCompletes', 'action' => 'edit', $formationComplete->id]) ?>
                </td>
                <?= ($formationComplete->lastTime_completed) ?>
                <td>

                </td>
            </tr>

      <?php endforeach; ?>
</table>
