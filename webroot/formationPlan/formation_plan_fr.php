<?php

use Cake\I18n\Time;
use App\Controller\FormationsPositionTitlesController;
?>
<html>
    <head>
        <title>Plan de formation</title>
        <style>
            th,td,tr,table{
                border:1px solid; color:black; border-collapse: collapse;
            }
            td{
                text-align: center;
            }
            tr{
                height: 60px;
            }
        </style>

    </head>
    <body>
        <h1><img src="../../../webroot/img/logo/lifelongBlue.png" alt="Logo">  Plan de formation</h1>
        <hr/>
        <?php
        echo "Numéro d'employé : " . h($employee->number) . "<br>";
        echo "Nom de l'employé : " . h($employee->civility->title) . " " . h($employee->first_name) . " " . h($employee->last_name) . "<br>";
        echo 'Titre du poste : ' . h($employee->position_title->title) . "<br>";
        $supervisor = $this->Employees->get($employee->parent_id, [
            'contain' => ['Civilities']
        ]);
        if ($employee->parent_id != 1) :
            echo "Nom du superviseur : " . h($supervisor->civility->title) . ' ' . h($supervisor->first_name) . " " . h($supervisor->last_name) . "<br>";
        else:
            echo "Nom du superviseur : " . h($supervisor->last_name) . "<br>";
        endif;
        echo 'Batiment : ' . h($employee->building->address) . "<br>";
        if (!empty($formationCompletes)) :
            ?>
            <br/>
            <table cellpadding="0" cellspacing="0" style="border:1px solid; color:black; border-collapse: collapse">
                <tr>
                    <th scope="col" style="width: 130px;"><?= __('Formation') ?></th>
                    <th scope="col" style="width: 80px;"><?= __('Statut') ?></th>
                    <th scope="col" style="width: 80px;"><?= __('Fréquence') ?></th>
                    <th scope="col" style="width: 80px;"><?= __('Fait le') ?></th>
                    <th scope="col" style="width: 80px;"><?= __('Prévue le') ?></th>
                    <th scope="col" style="width: 70px;"><?= __('Expirée') ?></th>
                    <th scope="col" style="width: 60px;"><?= __('À venir') ?></th>
                    <th scope="col" style="width: 60px;"><?= __('À faire') ?></th>
                    <th scope="col" style="width: 60px;"><?= __('Jamais faite') ?></th>
                </tr>
                <?php
                $style_rouge = "background-color: #FF0000;";
                $style_jaune = "background-color: yellow;";
                $style_gray = "background-color: #DCDCDC;";
                $style_white = "background-color = white;";
                $compteur = true;
                $this->loadModel('Formations');
                $tabDone = array();
                $tabExpected = array();
                $tabNever = array();
                $tabCompleted = array();
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
                    $expired = '';
                    $expectedOn = '';
                    $Todo = '';
                    $expiredDisplay = '';
                    $toCome = '';
                    $toComeDisplay = '';
                    if ($formationComplete->lastTime_completed != null) {
                        $lastTimeCompleted = $formationComplete->lastTime_completed;
                        $expectedOn = $lastTimeCompleted->add($frequencyInterval);
                        $expired = date_diff($now, $expectedOn);
                        $toCome = date_diff($expectedOn, $now);

                        $notificationDays = $notificationInterval->y * 365 + $notificationInterval->m * 30 + $notificationInterval->d;


                        if ($expired->invert == 1) {
                            $style = $style_rouge;
                            $Todo = 'À faire';
                            $expiredDisplay = $expired->days . ' jours';
                            array_push($tabDone, [
                                $style,
                                $formationI,
                                $formationComplete,
                                $expectedOn,
                                $expiredDisplay,
                                $toComeDisplay,
                                $Todo,
                                $NeverDone
                            ]);
                        } else if (($toCome->days - $notificationDays) < 0) {
                            $toComeDisplay = 'À venir';
                            $style = $style_jaune;
                            $Todo = 'À faire';
                            array_push($tabExpected, [
                                $style,
                                $formationI,
                                $formationComplete,
                                $expectedOn,
                                $expiredDisplay,
                                $toComeDisplay,
                                $Todo,
                                $NeverDone
                            ]);
                            $toComeDisplay = ($notificationDays - $toCome->days) . ' jours';
                        } else {
                            if ($compteur) {
                                $style = $style_gray;
                            } else {
                                $style = $style_white;
                            }
                            $compteur = !$compteur;
                            array_push($tabCompleted, [
                                $style,
                                $formationI,
                                $formationComplete,
                                $expectedOn,
                                $expiredDisplay,
                                $toComeDisplay,
                                $Todo,
                                $NeverDone
                            ]);
                        }
                    } else {
                        $Completed = false;
                        $NeverDone = 'Jamais faite';
                        if ($frequencyId == 1) {
                            if ($formationComplete->status == 'Obligatory') {
                                $style = $style_rouge;
                                $Todo = 'À faire';

                                array_push($tabDone, [
                                    $style,
                                    $formationI,
                                    $formationComplete,
                                    $expectedOn,
                                    $expiredDisplay,
                                    $toComeDisplay,
                                    $Todo,
                                    $NeverDone
                                ]);
                            } else {
                                If ($compteur) {
                                    $style = $style_gray;
                                } else {
                                    $style = $style_white;
                                }
                                $compteur = !$compteur;
                                array_push($tabNever, [
                                    $style,
                                    $formationI,
                                    $formationComplete,
                                    $expectedOn,
                                    $expiredDisplay,
                                    $toComeDisplay,
                                    $Todo,
                                    $NeverDone
                                ]);
                            }
                        } else {
                            if ($frequencyId == 8) {
                                $Todo = 'A faire';
                            }

                            If ($compteur) {
                                $style = $style_gray;
                            } else {
                                $style = $style_white;
                            }
                            $compteur = !$compteur;
                            array_push($tabNever, [
                                $style,
                                $formationI,
                                $formationComplete,
                                $expectedOn,
                                $expiredDisplay,
                                $toComeDisplay,
                                $Todo,
                                $NeverDone
                            ]);
                        }
                    }

                endforeach;
                foreach ($tabDone as $done) {
                    echo '<tr style="' . $done[0] . '"><td>' . h($done[1]->title) . '</td><td>' . h($done[2]->status)
                    . '</td><td>' . h($done[1]->frequency->title) . '</td><td>' . h($done[2]->lastTime_completed)
                    . '</td><td>' . h($done[3]) . '</td><td>' . h($done[4])
                    . '</td><td>' . h($done[5]) . '</td><td>' . h($done[6]) . '</td><td>' . h($done[7]) . '</td></tr>';
                }
                foreach ($tabExpected as $done) {
                    echo '<tr style="' . $done[0] . '"><td>' . h($done[1]->title) . '</td><td>' . h($done[2]->status)
                    . '</td><td>' . h($done[1]->frequency->title) . '</td><td>' . h($done[2]->lastTime_completed)
                    . '</td><td>' . h($done[3]) . '</td><td>' . h($done[4])
                    . '</td><td>' . h($done[5]) . '</td><td>' . h($done[6]) . '</td><td>' . h($done[7]) . '</td></tr>';
                }
                foreach ($tabCompleted as $done) {
                    echo '<tr style="' . $done[0] . '"><td>' . h($done[1]->title) . '</td><td>' . h($done[2]->status)
                    . '</td><td>' . h($done[1]->frequency->title) . '</td><td>' . h($done[2]->lastTime_completed)
                    . '</td><td>' . h($done[3]) . '</td><td>' . h($done[4])
                    . '</td><td>' . h($done[5]) . '</td><td>' . h($done[6]) . '</td><td>' . h($done[7]) . '</td></tr>';
                }
                foreach ($tabNever as $done) {
                    echo '<tr style="' . $done[0] . '"><td>' . h($done[1]->title) . '</td><td>' . h($done[2]->status)
                    . '</td><td>' . h($done[1]->frequency->title) . '</td><td>' . h($done[2]->lastTime_completed)
                    . '</td><td>' . h($done[3]) . '</td><td>' . h($done[4])
                    . '</td><td>' . h($done[5]) . '</td><td>' . h($done[6]) . '</td><td>' . h($done[7]) . '</td></tr>';
                }
                ?>
            </table>

            <?php endif; ?>
        <hr/>
        <p>Imprimé le <?= $curr_timestamp ?></p>
        
    </body>
</html>