<?php
require_once ('db.php');
require_once ('contact.php');

/*
I use a public variable $contactList to easily access different contacts. For a real project, I find it more relevant to modify this array at the same time as changes are made to the database rather than re-querying to fetch all the contacts again with each update/delete. Even the getOne could be done on the array rather than a database query. However, following the discussion with my project mentor, making the code heavier is not relevant since efficiency is not the goal of the exercise.
*/

class ContactManager
{

    private $db;
    public $contactList = [];
    public function __construct()
    {
        require_once('db.php');
        $this->db = DataBase::getDB();
    }
/*
Check if the ID provided by the user matches an existing entry.
*/

    public function idIsValid(int $id)
    {
        $trouve = array_filter($this->contactList, function ($contact) use ($id) {
            return $contact->getId() == $id;
        });
        return !empty($trouve);
    }
/*
Retrieve all contacts from the database and reset the array after an update/delete.
*/

    public function getAll()
    {
        if (!empty($this->contactList))
            $this->contactList = [];
        
        $datas = $this->db->executeRequest('SELECT * FROM contacts');
        foreach ($datas as $contact) {
            $newContact = new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
            $this->contactList[] = $newContact;
        }
        return $this->contactList;
    }

    public function getOne(int $id): Contact|null
    {
        $contact = $this->db->executeRequest('SELECT * FROM contacts WHERE id=?', [$id]);
        if ($contact)
            return new Contact($contact[0]['id'], $contact[0]['name'], $contact[0]['email'], $contact[0]['phone_number']);
        return null;
    }

    public function updateOne(Contact $contact)
    {
        $this->db->executeRequest('UPDATE contacts SET name=?, email=?, phone_number=? WHERE id=?', [$contact->getName(), $contact->getEmail(), $contact->getPhone(), $contact->getId()]);
        $this->getAll();
    }
    public function deleteOne(int $id)
    {
        $this->db->executeRequest('DELETE FROM contacts WHERE id=? ', [$id]);
        $this->getAll();
    }
    public function create($name, $email, $phone_number)
    {
        $this->db->executeRequest('INSERT INTO contacts (name,email,phone_number) VALUES (?,?,?)', [$name, $email, $phone_number]);
        $this->contactList[] = new Contact($this->db->lastId(), $name, $email, $phone_number);
    }

}