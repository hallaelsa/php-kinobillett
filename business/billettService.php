<?php

class billettService {
    private $dbService;

    public function __construct($dbService) {
        $this->dbService = $dbService;
    }
    
    public function registrerBillett($visning_id, $type_id, $antall, $pris, $fnavn, $enavn, $tlf, $epost) {
        return $this->dbService->insert("
            INSERT INTO bestilling
            (visning_id,
            billettype_id,
            antall,
            pris,
            fornavn,
            etternavn,
            telefonnummer,
            epost)
            VALUES
            ("
            .$visning_id.","
            .$type_id.","
            .$antall.","
            .$pris.",'"
            .$fnavn."','"
            .$enavn."','"
            .$tlf."','"
            .$epost."')");
    }
    
    public function hentBestilling($referanse) {
        return $this->dbService->query("
            select *
            from bestilling
            where referanse = '".$referanse."'");
    }
    
    
    public function registrerRegNr($referanse, $id) {
        return $this->dbService->insert("
            UPDATE bestilling
            SET referanse = '".$referanse."' WHERE id =".$id);      
    }
}
