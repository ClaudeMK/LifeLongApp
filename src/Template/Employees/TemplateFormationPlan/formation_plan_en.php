<?php

use Cake\I18n\Time;
use App\Controller\FormationsPositionTitlesController;
?>
<html>
    <head>
        <title>Formation plan</title>
        <style> td{width: 80px;border: solid}</style>
    </head>
    <body>
        <h1><img src="../../../webroot/img/logo/lifelongBlue.png" alt="Logo">  Formation plan</h1>
        <hr/>
        <?php
        echo 'Employes number : ' . h($employee->number) . "<br>";
        echo 'Employes name : ' . h($employee->civility->title) . " " . h($employee->first_name) . " " . h($employee->last_name) . "<br>";
        echo 'Post Title : ' . h($employee->position_title->title) . "<br>";
        $supervisor = $this->Employees->get($employee->parent_id, [
            'contain' => ['Civilities']
        ]);
        if ($employee->parent_id != 1) :
            echo "Supervisor's name : " . h($supervisor->civility->title) . ' ' . h($supervisor->first_name) . " " . h($supervisor->last_name) . "<br>";
        else:
            echo "Supervisor's name : " . h($supervisor->last_name) . "<br>";
        endif;
        echo 'Building : ' . h($employee->building->address) . "<br>";
        if (!empty($formationCompletes)) :
            ?>
        <br/>
            <table cellpadding="0" cellspacing="0" style="border:1px solid; color:black; border-collapse: collapse">
                <tr>
                    <th scope="col"><?= __('Formation') ?></th>
                    <th scope="col"><?= __('Status') ?></th>
                    <th scope="col"><?= __('frequency') ?></th>
                    <th scope="col"><?= __('Done on') ?></th>
                    <th scope="col"><?= __('Expected on') ?></th>
                    <th scope="col"><?= __('Expired') ?></th>
                    <th scope="col"><?= __('Expected on') ?></th>
                    <th scope="col"><?= __('To do') ?></th>
                    <th scope="col"><?= __('Never done') ?></th>
                </tr>
                <?php
                $style_rouge = "background-color: #FF0000;";
                $style_jaune = "background-color: yellow;";
                $style_gray = "background-color: #DCDCDC;";
                $style_white = "background-color = white;";
                $compteur = 0;
                $this->loadModel('Formations');

                foreach ($formationCompletes as $formationComplete):
                    $formationI = $this->Formations->get($formationComplete->formation_id, [
                        'contain' => ['Frequencies', 'Notifications']
                    ]);
                    $Expired = '';
                    $Todo = '';
                    $NeverDone = '';
                    $ToCome = '';

                    $style_rouge = "background-color: #FF0000;";
                    $style_jaune = "background-color: yellow;";
                    $style_gray = "background-color: #DCDCDC;";
                    $style_white = "background-color = white;";

                    $notificationId = $formationI->notification_id;
                    if ($notificationId != 1 && $notificationId != 7){
                        $notification = $formationI->notification->title;
                        $notificationTime = new Time($notification);
                    }
                    
                    
                    $frequencyId = $formationI->frequencie_id;
                    //1,7
                    //1,6,7,8
                    if ($frequencyId != 1 && $frequencyId != 6 && $frequencyId != 7 && $frequencyId != 8){
                        $frequency = $formationI->frequency->title;
                        $frequencyTime = new Time($frequency);
                    }
                        
                    
                    if ($formationComplete->lastTime_completed != null) {
                        $lastTimeCompleted = new Time($formationComplete->lastTime_completed);


                        if ($lastTimeCompleted->wasWithinLast($frequency)) {
                            $Completed = true;
                            $ToCome = 'To come';
                            If ($compteur % 2 == 0) {
                                $style = $style_gray;
                            } else {
                                $style = $style_white;
                            }
                        } else if (!$lastTimeCompleted->wasWithinLast($notification)) {
                            $style = $style_jaune;
                            $Todo = 'To do';
                        } else if (!$lastTimeCompleted->wasWithinLast($frequency)) {
                            $Completed = false;
                            $Expired = 'Expired';
                            $style = $style_rouge;
                        }
                    } else {
                        $Completed = false;
                        $NeverDone = 'Never done';
                        If ($compteur % 2 == 0) {
                            $style = $style_gray;
                        } else {
                            $style = $style_white;
                        }
                    }
                    echo '<tr style="' . $style . '"><td>' . h($formationI->title) . '</td><td>' . h($formationComplete->status)
                    . '</td><td>' . h($formationI->frequency->title) . '</td><td>' . h($formationComplete->lastTime_completed)
                    . '</td><td>' . h($frequencyTime) . '</td><td>' . h($Expired)
                    . '</td><td>' . h($ToCome) . '</td><td>' . h($Todo) . '</td><td>' . h($NeverDone) . '</td></tr>';
                    $compteur++;

                endforeach;
                ?>
            </table>

        <?php endif;?>
        <hr/>
        <p>Print the <?= $curr_timestamp?></p>
        <?php die() ?>
    </body>
</html>