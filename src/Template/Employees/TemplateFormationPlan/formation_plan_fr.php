<html>
            <head>
                <title>Formation plan</title>
            </head>
            <body>
                <div style="color: <?php if($employee->id > 10){ echo 'red';}else{echo 'blue';}?>">
                    <img src="C:/Program Files (x86)/Ampps/www/LifeLongApp/webroot/img/logo/lifelongBlue.png" alt="Logo">
                    <hr/>
                    <p>Numero de l'employé : <?= h($employee->number) ?></p>
                    <p>Nom de l'employé : <?= h($employee->first_name) ?> <?= h($employee->last_name) ?></p>
                    <p>Titre du poste : <?= h($employee->position_title->title) ?></p>
                    <p>Immeuble : <?= h($employee->building_id) ?></p>
                    </br>
                </div>
            </body>
        </html>