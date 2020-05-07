<?php

use App\SensitiveDataFilter;
use App\DbIterator;

require 'vendor/autoload.php';

$config=require 'config.php';

try {
    $pdo=new PDO(
        $config['db']['connection'].';dbname='.$config['db']['name'].';charset=utf8',
        $config['db']['user'],
        $config['db']['password'],
        $config['db']['options']
    );
} catch(PDOException $e) {
    exit($e->getMessage());
}
        
$sql='SELECT * FROM `messages` ORDER BY `message_id` ASC';
$stmt=$pdo->prepare($sql,[PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL]);
$stmt->execute();

$messages=new DbIterator($stmt);

$filtered_messages=new SensitiveDataFilter($messages);

foreach($filtered_messages as $message) {
    $sql='UPDATE `messages` SET `infected_flag`=? WHERE `message_id`=?';
    $stmt=$pdo->prepare($sql);
    $stmt->execute(['1',$message->message_id]);
    
    $sql='INSERT INTO `infected_messages` (`message_id`) VALUES(?)';
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$message->message_id]);
}
