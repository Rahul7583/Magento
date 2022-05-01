<?php

    $installer = $this;

    $installer->startSetup();

    $installer->run("

    -- DROP TABLE IF EXISTS {$this->getTable('process_entry')};
    
    CREATE TABLE {$this->getTable('process_entry')} (
      `entry_id` int(11) unsigned NOT NULL auto_increment,
      `process_id` int(11) NOT NULL,
      `identifier` varchar(255) NOT NULL,
      `start_time` datetime DEFAULT NULL,
      `end_time` datetime DEFAULT NULL,
      `data` varchar(255) NOT NULL,
      `created_date` datetime DEFAULT NULL,
      PRIMARY KEY (`entry_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- DROP TABLE IF EXISTS {$this->getTable('process_group')};

     CREATE TABLE {$this->getTable('process_group')} (
      `process_group_id` int(11) unsigned NOT NULL auto_increment,
      `name` varchar(255) NOT NULL,
      PRIMARY KEY (`process_group_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


    -- DROP TABLE IF EXISTS {$this->getTable('process_column')};
    
    CREATE TABLE {$this->getTable('process_column')} (
      `column_id` int(11) unsigned NOT NULL auto_increment,
      `process_id` int(11) NOT NULL,
      `name` varchar(255) NOT NULL,
      `required` tinyint(2) DEFAULT NULL,
      `casting_type` varchar(255) NOT NULL,
      `exception` tinyint(2) DEFAULT NULL,
      `created_date` datetime DEFAULT NULL,
      PRIMARY KEY (`column_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

     -- DROP TABLE IF EXISTS {$this->getTable('process')};

     CREATE TABLE {$this->getTable('process')} (
      `process_id` int(11) unsigned NOT NULL auto_increment,
      `group_id` int(11) NOT NULL,
      `type_id` tinyint(2) NOT NULL,
      `name` varchar(255) DEFAULT NULL,
      `per_request_count` int(11) DEFAULT NULL,
      `request_interval` float NOT NULL,
      `request_model` varchar(255) NOT NULL,
      `file_name` varchar(255) NOT NULL,
      `created_date` datetime DEFAULT NULL,
      PRIMARY KEY (`process_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  ");

  $installer->endSetup();