 -- create user
 GRANT USAGE ON *.* TO 'wmfh520160830'@'localhost' IDENTIFIED BY '56Yzm&DXBfLU0v@pHx' WITH GRANT OPTION;
 -- create database
 CREATE DATABASE wmfh520160830  CHARACTER SET  utf8  COLLATE utf8_general_ci;
 -- grant user 权限1,权限2select,insert,update,delete,create,drop,index,alter,grant,references,reload,shutdown,process,file等14个权限
 GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP,LOCK TABLES,index,alter ON wmfh520160830.*  TO 'wmfh520160830'@'localhost' IDENTIFIED BY '56Yzm&DXBfLU0v@pHx';

 -- mysqldump -uwmfh520160830 -p56Yzm&DXBfLU0v@pHx wmfh520160830 > /var/tmp/mysqlbackup/mysqlbak_wmfh520160830_201608111839.sql