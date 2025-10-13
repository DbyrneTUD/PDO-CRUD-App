<?php

require '../config.php'; //access to login values

try {
    $connection = new PDO($dsn, $username, $password, $options);
    echo "DB Connected ";
}   catch(\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>