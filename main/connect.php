<?php

    $conn = new mysqli("localhost", "root", "", "arsgarage");

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

?>