<?php


/**
 * Description of Pianta
 *
 * @author Pier
 */
class Pianta{
   
   
    private $disponibilita;
    private $prezzo;
    private $id;
    private $nome;
    private $immagine;
    private $descrizione;
    
    public function __construct() {    
    }
    
    public function getId() {
        return $this->id;
    }
       
    public function setId($id) {
        $this->id = $id;
        return true;
    } 

    public function getImmagine() {
        return $this->immagine;
    }
       
    public function setImmagine($immagine) {
        $this->immagine = $immagine;
        return true;
    }
    public function getNome() {
        return $this->nome;
    }
       
    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }
    public function getDescrizione() {
        return $this->descrizione;
    }
       
    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
        return true;
    }
    
    
    public function getDisponibilita() {
        return $this->disponibilita;
    }
       
    public function setDisponibilita($disponibilita) {
        $this->disponibilita = intval($disponibilita);
        return true;
    }
    public function getPrezzo() {
        return $this->prezzo;
    }
    public function setPrezzo($prezzo) {
        $this->prezzo = (floatval($prezzo));
        return true;
    }
   
 
}
