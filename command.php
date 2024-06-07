<?php
require_once ('contactManager.php');
class Command
{
    private $contactManager;

    public function __construct()
    {
        $this->contactManager = new ContactManager();
        $this->contactManager->getAll();
    }
    /*
    The commands are in an associative array to easily maintain the codebase.
    */
    public function help()
    {
        $commands = [
            ['name' => 'help', 'description' => 'Liste des commandes.'],
            ['name' => 'list', 'description' => 'Liste des contacts enregistrés.'],
            ['name' => 'create', 'description' => 'Ajoute un contact.'],
            ['name' => 'update', 'description' => 'Modifie un contact.'],
            ['name' => 'detail', 'description' => 'Affiche les détails d\'un contact.'],
            ['name' => 'delete', 'description' => 'Supprime un contact.'],
            ['name' => 'exit', 'description' => 'Quitte l\'application.'],
        ];

        echo "Commandes disponibles (sensible à la casse): " . PHP_EOL;
        foreach ($commands as $command)
            echo ' - ' . $command['name'] . ' : ' . $command['description'] . PHP_EOL;
    }
    public function list()
    {
        if (empty($this->contactManager->contactList))
            echo "Vous n'avez pas de contacts enregistrés";
        else {
            echo 'Voici vos contacts enregistrés : ' . PHP_EOL;
            foreach ($this->contactManager->contactList as $contact) {
                echo $contact;
            }
        }
    }

    /*
    We loop as long as the user does not provide valid input. It might be wise to create a validInput method to check the validity of each field with a regex if necessary.
    */
    public function create()
    {
        do {
            $name = readline("Entrez le nom de votre contact : ");
        } while (trim($name) === "");
        do {
            $email = readline("Entrez le mail de votre contact : ");
        } while (trim($email) === "");
        do {
            $phone = readline("Entrez le numéro de votre contact : ");
        } while (trim($phone) === "");

        $this->contactManager->create($name, $email, $phone);
    }
    /*
    Similar to the create operation, instead of asking the user to re-enter the information, it is more relevant to allow them the choice to modify it. Input validation might also be pertinent.
    */
    public function update($id)
    {

        $contact = $this->contactManager->getOne($id);
        if (!$contact) {
            echo 'Le contact indiqué n\'existe pas.' . PHP_EOL;
            return;
        }
        echo 'Voici les informations de votre contact (identifiant | nom | email | numéro de téléphone : ' . PHP_EOL;
        echo $contact;
        echo 'Que désirez vous modifier ?' . PHP_EOL;
        echo '0 - Annuler la modification' . PHP_EOL;
        echo '1 - Le nom.' . PHP_EOL;
        echo '2 - L\'email.' . PHP_EOL;
        echo '3 - Le numéro de téléphone' . PHP_EOL;
        do {
            $choice = readline("Votre choix ? ");
        } while (intval($choice, 10) > 3 && intval($choice, 10) < 0);
        switch ($choice) {
            case 1:
                $contact->setName(readline("Entrez le nom de votre contact : "));
                break;
            case 2:
                $contact->setEmail(readline("Entrez le mail de votre contact : "));
                break;
            case 3:
                $contact->setPhoneNumber(readline("Entrez le numéro de votre contact"));
                break;
        }
        $this->contactManager->updateOne($contact);
    }

    public function detail($id)
    {
        if ($this->contactManager->idIsValid($id)) {
            echo 'Voici les informations de votre contact (identifiant | nom | email | numéro de téléphone : ' . PHP_EOL;
            echo $this->contactManager->getOne($id) . PHP_EOL;
        } else
            echo "Le contact indiqué n'existe pas." . PHP_EOL;


    }
    public function delete($id)
    {
        if ($this->contactManager->idIsValid($id)) {
            $this->contactManager->deleteOne($id);
            echo 'Le contact a bien été supprimé.' . PHP_EOL;
        } else
            echo 'Le contact indiqué n\'existe pas' . PHP_EOL;
    }

}