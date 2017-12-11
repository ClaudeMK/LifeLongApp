<?php

use Cake\I18n\Time;
use App\Controller\FormationsPositionTitlesController;
?>
<html>
    <head>
        <title>Formation plan</title>
        <style>
            th,td,tr,table{
                border:1px solid; color:black; border-collapse: collapse;
            }
            td, th{
                text-align: center;
            }
            tr{
                height: 60px;
            }
        </style>
    </head>
    <body>
        <h1><img src="/home/lifelong/public_html/webroot/img/logo/lifelongBlue.png" alt="Logo">Rapport #4 | Superviseurs actif</h1>
        <hr/>
        <?php
        $this->loadModel('Formations');
        $compteur = true;
        ?>
        <br/>
        <table cellpadding="0" cellspacing="0" style="border:1px solid; color:black; border-collapse: collapse">
            <tr style="background-color: #FFE4E1">
                <th scope="col" style="width: 180px;"><?= __('Supervisor') ?></th>
                <th scope="col" style="width: 80px;"><?= __('Expired') ?></th>
                <th scope="col" style="width: 80px;"><?= __('Expected') ?></th>
                <th scope="col" style="width: 90px;"><?= __('Never done') ?></th>
                <th scope="col" style="width: 80px;"><?= __('Updated') ?></th>
                <th scope="col" style="width: 60px;"><?= __('Total') ?></th>
                <th scope="col" style="width: 60px;"><?= __('%') ?></th>
            </tr>
            <?php
            $style_gray = "background-color: #DCDCDC;";
            $style_white = "background-color = white;";
            foreach ($tabSuperviseurEmployeesFormations as $ligneSupervisor) {
                if ($compteur) {
                    $style = $style_gray;
                } else {
                    $style = $style_white;
                }
                $compteur = !$compteur;
                ?>
                <tr style="<?= $style ?>">
                    <td><?= $ligneSupervisor[0]->last_name . ", " . $ligneSupervisor[0]->first_name ?></td>
                    <?php
                    $nbExpired = 0.0;
                    $nbExpected = 0.0;
                    $nbNeverDone = 0.0;
                    $nbUpdated = 0.0;
                    $nbCompleted = 0.0;
                    foreach ($ligneSupervisor[1] as $ligneEmployee) {
                        foreach ($ligneEmployee[1] as $formationComplete) {
                            $formationI = $this->Formations->get($formationComplete->formation_id, [
                                'contain' => ['Frequencies', 'Notifications']
                            ]);
                            $expired = ''; //
                            $expectedOn = ''; //
                            $toCome = ''; //
                            $notificationId = $formationI->notification_id;
                            $frequencyId = $formationI->frequencie_id;
                            $now = new Time();
                            if ($notificationId != 7) {
                                $notification = $formationI->notification->title;
                                $notificationInterval = DateInterval::createFromDateString($notification);
                            } else {
                                $notification = '';
                            }
                            if ($frequencyId != 1 && $frequencyId != 6 && $frequencyId != 7 && $frequencyId != 8) {
                                $frequency = $formationI->frequency->title;
                                $frequencyInterval = DateInterval::createFromDateString($frequency);
                            } else {
                                $frequency = '';
                            }
                            if ($formationComplete->lastTime_completed != null) {
                                $lastTimeCompleted = $formationComplete->lastTime_completed;
                                $expectedOn = $lastTimeCompleted->add($frequencyInterval);
                                $expired = date_diff($now, $expectedOn);
                                $toCome = date_diff($expectedOn, $now);
                                $notificationDays = $notificationInterval->y * 365 + $notificationInterval->m * 30 + $notificationInterval->d;
                                if ($expired->invert == 1) {
                                    $nbExpired++;
                                } else if (($toCome->days - $notificationDays) < 0) {
                                    $nbExpected++;
                                } else {
                                    $nbUpdated++;
                                }
                            } else {
                                $nbNeverDone++;
                            }
                        }
                    }
                    ?>
                    <td><?= $nbExpired ?></td>
                    <td><?= $nbExpected ?></td>
                    <td><?= $nbNeverDone ?></td>
                    <td><?= $nbUpdated ?></td>
                    <td><?= ($nbExpired + $nbUpdated) ?></td>
                    <td><?php
                        if (($nbExpired + $nbUpdated) != 0) {
                            echo number_format(($nbUpdated * 100 / ($nbExpired + $nbUpdated)), 2) . '%';
                        }
                        ?></td>
                </tr>

                <?php
            }
            ?>
        </table>
        <hr/>
        <p>Printed the <?= $curr_timestamp ?></p>
    </body>
<?php die(); ?>
</html>