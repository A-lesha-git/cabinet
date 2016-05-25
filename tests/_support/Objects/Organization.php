<?php

namespace Objects;

class Organization{
    public $id;
    public $legalPerson;
    public $name;
    public $email;
    public $phone;
    public $site;
    public $promo;
    public $token;

    public static function create(array $userData) {
        $user = new static;
        $user->setName($userData['name']);
        $user->setEmail($userData['email']);
        $user->setPhone($userData['phone']);
        $user->setSite($userData['site']);
        $user->setPromo($userData['promo']);

        return $user;
    }

    public static function createOrganization(array $organizationData){
        $organization = new static;
        $organization->setId($organizationData['id']);
        $organization->setLegalPerson($organizationData['legalPerson']);

        return $organization;
    }

    public  function setId($id){
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    public  function setLegalPerson($legalPerson){
        $this->legalPerson = $legalPerson;
    }
    public function getLegalPerson() {
        return $this->legalPerson;
    }

    public  function setName($name){
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }

    public  function setEmail($email){
        $this->email = $email;
    }
    public function getEmail() {
        return $this->email;
    }

    public  function setSite($site){
        $this->site = $site;
    }
    public function getSite() {
        return $this->site;
    }

    public  function setPhone($phone){
        $this->phone = $phone;
    }
    public function getPhone() {
        return $this->phone;
    }

    public  function setPromo($promo){
        $this->promo = $promo;
    }
    public function getPromo() {
        return $this->promo;
    }

    public  function setToken($token){
        $this->token = $token;
    }
    public function getToken() {
        return $this->token;
    }
}
