CREATE TABLE `formation_completes` (
  id int(11) NOT NULL AUTO_INCREMENT,
  employee_id int(11) NOT NULL,
  formation_id int(11) NOT NULL,
  lastTime_completed DATE NOT NULL,
  comment VARCHAR(255),
  PRIMARY KEY (id),
  FOREIGN KEY (employee_id) REFERENCES employees(id),
  FOREIGN KEY (formation_id) REFERENCES formations(id)
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
