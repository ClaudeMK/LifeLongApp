<html>
            <head>
                <title>Formation plan</title>
            </head>
            <body>
                <div style="color: <?php if($employee->id > 10){ echo 'red';}else{echo 'blue';}?>">
                    <img src="C:/Program Files (x86)/Ampps/www/LifeLongApp/webroot/img/logo/lifelongBlue.png" alt="Logo">
                    <hr/>
                    <p>Employes number : <?= h($employee->number) ?></p>
                    <p>Employes name : <?= h($employee->first_name) ?> <?= h($employee->last_name) ?></p>
                    <p>Post title : <?= h($employee->position_title->title) ?></p>
                    <p>Building : <?= h($employee->building_id) ?></p>
                    </br>
                </div>
            </body>
        </html>