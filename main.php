<?php
require_once ("command.php");
$command = new Command();

$continue = true;
echo "L'intégralité des commandes est disponibles en tapant \"help\"" . PHP_EOL;
while ($continue) {
    $line = readline("Entrez votre commande : ");

    if (preg_match("/^detail (\d+)$/", $line, $matches))
        $line = "detail";
    elseif (preg_match("/^update (\d+)$/", $line, $matches))
        $line = "update";
        elseif (preg_match("/^delete (\d+)$/", $line, $matches))
        $line = "delete";

    switch ($line) {
        case 'help':
            $command->help();
            break;
        case 'list':
            $command->list();
            break;
        case 'create':
            $command->create();
            break;
        case 'detail':
            $command->detail(intval($matches[1], 10));
            break;
        case 'update':
            $command->update(intval($matches[1], 10));
            break;
        case 'delete':
            $command->delete(intval($matches[1],10));
            break;
        case 'exit':
            $continue = false;
            break;
        default:
            echo 'Commande non reconnue' . PHP_EOL;
            break;
    }
}