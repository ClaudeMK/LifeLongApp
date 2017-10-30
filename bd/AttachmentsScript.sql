CREATE TABLE `attachments` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `formation_complete_id` int(11) NOT NULL,
    `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `created` datetime NOT NULL,
    `modified` datetime NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (formation_complete_id) REFERENCES formation_complete(id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
