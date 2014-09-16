<?php
/**
 * Description of Cliente
 *
 * @author Pier
 */
class Personale {
    private $username;
    private $password;
    private $nome;
    private $cognome;
    private $telefono;
    private $email;
    private $indirizzo;
    private $cap;
    private $citta;
    private $data;
    private $mansione;
    
    public function __construct() {
        
    }
   
    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($username) {
        $this->username = $username;
        return true;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return true;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
        return true;
    }
    
    public function getNome() {
        return $this->nome;
    }

    
    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }

    public function getCognome() {
        return $this->cognome;
    }

    public function setCognome($cognome) {
        $this->cognome = $cognome;
        return true;
    }
    
   
    public function setIndirizzo($indirizzo) {
        $this->indirizzo = $indirizzo;
        return true;
    }
    public function getIndirizzo() {
        return $this->indirizzo;
    }

   
    public function setEmail($email) {
        $this->email = $email;
        return true;
    }
    public function getEmail() {
        return $this->email;
    }
     
    public function setCap($cap) {
        $this->cap = $cap;
        return true;
    }
    public function getCap() {
        return $this->cap;
    }
    
    public function setCitta($citta) {
        $this->citta = $citta;
        return true;
    }
    public function getCitta() {
        return $this->citta;
    }
    
    public function setData($data) {
        $this->data = $data;
        return true;
    }
    
    public function getData() {
        return $this->data;
    }
    
    
}
