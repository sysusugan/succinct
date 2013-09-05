 
CREATE TABLE IF NOT EXISTS `msgboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `reply_to` int(11) NOT NULL DEFAULT '0' ,
  `is_reply` int(11) NOT NULL DEFAULT '1',
  `rt` datetime NOT NULL,
  `ut` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 
