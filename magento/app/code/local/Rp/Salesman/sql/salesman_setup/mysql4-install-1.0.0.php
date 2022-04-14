<?php

    $installer = $this;

    $installer->startSetup();

    $installer->run("

    -- DROP TABLE IF EXISTS {$this->getTable('salesman')};
    CREATE TABLE {$this->getTable('salesman')} (
      `salesmanId` int(11) unsigned NOT NULL auto_increment,
       `firstName` varchar(256) NOT NULL,
      `lastName` varchar(256) NOT NULL,
      `email` varchar(50) NOT NULL,
      `mobile` int(11) NOT NULL,
      `status` tinyint(1) NOT NULL DEFAULT 2,
      `createdAt` datetime DEFAULT NULL,
      `updatedAt` datetime DEFAULT NULL,
      PRIMARY KEY (`salesmanId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");

    $installer->endSetup();
