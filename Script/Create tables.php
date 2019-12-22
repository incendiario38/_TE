<?php

require_once("../config.php");

try {
    $conn = new PDO($dsn, $username, $password, $options);

//    $db = $conn->exec('
//    DROP TABLE IF EXISTS groups;
//    CREATE TABLE groups (
//    id_group integer PRIMARY KEY GENERATED BY DEFAULT AS IDENTITY,
//    name_group varchar(255) NOT NULL
//    )');

//    $db = $conn->exec('
//    DROP TABLE IF EXISTS peoples;
//CREATE TABLE peoples (
//    id_people integer PRIMARY KEY GENERATED BY DEFAULT AS IDENTITY,
//    fio varchar(255) NOT NULL,
//    address varchar(255),
//    email varchar(255),
//    positionJobId int
//    )');
//
//    $db = $conn->exec('
//    DROP TABLE IF EXISTS peoplesInGroup;
//CREATE TABLE peoplesInGroup (
//    id_peoplesInGroup integer PRIMARY KEY GENERATED BY DEFAULT AS IDENTITY,
//    peopleId int NOT NULL,
//    groupId int NOT NULL
//    )');
//
//    $db = $conn->exec('
//    DROP TABLE IF EXISTS phoneRing;
//CREATE TABLE phoneRing (
//    id_phoneRing integer PRIMARY KEY GENERATED BY DEFAULT AS IDENTITY,
//    phoneId int NOT NULL,
//    callerPhone varchar(255) NOT NULL,
//    dateTime timestamp NOT NULL
//    )');
//
//    $db = $conn->exec('
//    DROP TABLE IF EXISTS phones;
//CREATE TABLE phones (
//    id_phone integer PRIMARY KEY GENERATED BY DEFAULT AS IDENTITY,
//    peopleId int NOT NULL,
//    phone varchar(255) NOT NULL
//    )');

    $db = $conn->exec('
    DROP TABLE IF EXISTS positionJob;
CREATE TABLE positionJob (
    id_positionJob integer PRIMARY KEY GENERATED BY DEFAULT AS IDENTITY,
    name_positionJob varchar(255) NOT NULL
    )');
} catch (PDOException $e) {
    echo "Couldn't create tables: {$e->getMessage()}";
}

