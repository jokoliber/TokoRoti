<?php
namespace frontend\views\site;

use Yii;
use yii\base\Model;
use frontend\models\Account;
use frontend\models\Member;

$command = $connection->createCommand('SELECT * FROM Member');
$reader = $command->query();

while ($row = $reader->read()) {
    $rows[] = $row;
}

// equivalent to:
foreach ($reader as $row) {
    $rows[] = $row;
}

// equivalent to:
$rows = $reader->readAll();