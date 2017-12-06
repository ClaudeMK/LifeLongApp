<html>
  <head>
  </head>
  <body>
    <?php foreach ($Employees as $employee):
        $this->sendFormationPlan($employee->id);
        endforeach; ?>
  </body>
</html>