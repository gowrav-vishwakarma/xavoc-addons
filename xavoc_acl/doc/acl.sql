DROP TABLE IF EXISTS `acl_pages` ;

CREATE TABLE `acl_pages` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`name` varchar( 60 ) DEFAULT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = InnoDB DEFAULT CHARSET = latin1;


DROP TABLE IF EXISTS `acl_users` ;

CREATE TABLE `acl_users` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`acl_user_id` int( 11 ) DEFAULT NULL ,
`page_id` int( 60 ) DEFAULT NULL ,
`allowed` tinyint( 4 ) DEFAULT '0',
`permissions` varchar( 50 ) DEFAULT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = InnoDB DEFAULT CHARSET = latin1;


DROP TABLE IF EXISTS `users` ;

CREATE TABLE `users` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`username` varchar( 255 ) DEFAULT NULL ,
`password` varchar( 255 ) DEFAULT NULL ,
`is_system_admin` tinyint( 4 ) DEFAULT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = InnoDB DEFAULT CHARSET = latin1;


INSERT INTO `school`.`users` (
`id` ,
`username` ,
`password` ,
`is_system_admin`
)
VALUES (
NULL , 'admin', 'admin', '1'
);
