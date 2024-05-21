<?php
require_once ('db.php');
require_once ('contact.php');


class ContactManager
{

    private $db;
    private $contactList = [] ;
    public function __construct()
    {
        require_once ('configDB.php');
        $instance = new DbConnect($mysql_database, $mysql_user, $mysql_password);
        $this->db = $instance->getPDO();
    }

    private function executeRequest(string $request, array $params = null)
    {
        $state = $this->db->prepare($request);
        $state->execute($params);

        return $state->fetchAll();
    }

    public function getAll()
    {
        $datas = $this->executeRequest('SELECT * FROM contacts');
        foreach ($datas as $contact) {
            $newContact = new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
            array_push($this->contactList,$newContact);
            var_dump($this->contactList);
        }

    }

    public function getOne($id)
    {
        $datas = $this->executeRequest('SELECT * FROM contacts WHERE id=?', [$id]);
    }

    public function modifyOne()
    {
    }

    public function deleteOne($id)
    {
        $this->executeRequest('DELETE FROM contacts WHERE id=? ', [$id]);
    }
    public function create($name, $email, $phone_number)
    {
        $this->executeRequest('INSERT INTO contacts (name,email,phone_number) VALUES (?,?,?)', [$name, $email, $phone_number]);

    }

}