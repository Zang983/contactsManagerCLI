<?php
include_once('contactManager.php');


$CM = new ContactManager();
$CM->getAll();

$continue = true;
while ($continue) {
    $line = readline("Entrez votre commande : ");

    if ($line === "STOP") {
        $continue = false;
    }

    echo "Vous avez saisi : $line\n";

}