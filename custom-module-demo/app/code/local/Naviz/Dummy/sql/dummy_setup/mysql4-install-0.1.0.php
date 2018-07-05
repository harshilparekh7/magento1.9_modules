<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
create table dummy (dummy_id int not null auto_increment, title varchar(100), content text(200), status varchar(100),primary key(dummy_id));
   
SQLTEXT;

$installer->run($sql);
 
$installer->endSetup();
	 