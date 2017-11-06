<?php
class filmService {
    private $dbService;
    
    public function __construct($dbService) {
        $this->dbService = $dbService;
    }
    
    public function hentFilmer() {
        return $this->dbService->queryArray("
            select * 
            from film2
            order by navn");
    }
    
    public function hentFilm($id) {
        return $this->dbService->query("
            select *
            from film2
            where id = ".$id);
    }
    
    
    public function hentVisninger($id, $dato) {
        return $this->dbService->queryArray("
            select *
            from visning
            where film_id = ".$id." AND DATE(dato) = '".$dato."'
            order by dato");
    }
    
    public function hentVisning($id) {
        return $this->dbService->query("
            select *
            from visning
            where id = ".$id);
    }
    
    public function hentAntallBestilte($visning_id) {
        return $this->dbService->query("
            select sum(antall) as antall
            from bestilling 
            where visning_id = ".$visning_id)->antall;
    }
    
    public function hentBillettyper() {
        return $this->dbService->queryArray("
            select * 
            from billettype2");
    }
    
    public function hentBillettype($id) {
        return $this->dbService->query("
            select * 
            from billettype2
            where id = ".$id);
    }
}
