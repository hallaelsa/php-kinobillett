<?php

include("business/filmService.php");
include("business/dbService.php");

$dbService = new dbService("student.cs.hioa.no", "s315579", "", "s315579");


$filmService = new filmService($dbService);
$filmer = $filmService->hentFilmer();

foreach ($filmer as $film) {
    echo $film->navn . "<br>";
    
    for($y = 0; $y <= 14; $y++) {
        $dato = date('Y-m-d\TH:i', strtotime(date('Y-m-d') .'+'.$y.'day'));
        $antall = rand(2,4);
        $startOffset = rand(12, 16);
        $visninger = $filmService->hentVisninger($film->id, $dato);

        if (count($visninger) > 0){
            continue;
        }       

        for($i = 0; $i < $antall; $i++) {
            $tmpDato = date('Y-m-d\TH:i', strtotime($dato .'+'.(($startOffset + ($i * 2.5)) * 60) .'minute'));
            echo $tmpDato . "<br>";
            $dbService->insert("insert into visning (film_id, dato, plasser) values(".$film->id.", '".$tmpDato."', ".(rand(1,5)*10).")");
        }
    }
}

