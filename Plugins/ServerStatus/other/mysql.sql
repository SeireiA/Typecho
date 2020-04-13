CREATE TABLE `typecho_ServerStatus_server` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sign` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL DEFAULT 'default',
  `url` varchar(255) NOT NULL DEFAULT 'http://example.com/ServerStatus.php',
  `key` varchar(255) NOT NULL DEFAULT '123456',
  `ajax` varchar(255) NOT NULL DEFAULT '10',
  `desc` text NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=%charset%;
