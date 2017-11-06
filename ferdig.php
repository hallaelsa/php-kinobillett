<?php
    session_start();
    include("business/filmService.php");
    include("business/dbService.php");
    include("business/billettService.php");
    include ("feil.php");
    $referanse = $_SESSION['referanse'];
    
    $dbService = new dbService("student.cs.hioa.no", "s315579", "", "s315579");
    $billettService = new billettService($dbService);
    $filmService = new filmService($dbService);
    
    if($billettService->hentBestilling($referanse)) {
        $data = $billettService->hentBestilling($referanse);
        $fnavn = $data->fornavn;
        $enavn = $data->etternavn;
        $epost = $data->epost;
        $antall = $data->antall;
        $pris = $data->pris;
        $typeID = $data->billettype_id;
        $typeInfo = $filmService->hentBillettype($typeID);
        $visningID = $data->visning_id;
        $visningInfo = $filmService->hentVisning($visningID);
        $filmID = $visningInfo->film_id;
        $filmInfo = $filmService->hentFilm($filmID);
        $tid = date('H:i', strtotime($visningInfo->dato));
        $dato = date('d.m', strtotime($visningInfo->dato));  
        $filmNavn = $filmInfo->navn;
        $typeNavn = $typeInfo->navn;
    
    } else {
        $referanse = "<span class='feilmelding'>Feil referanse</span>";
        $tid = $dato = $filmNavn = $typeNavn = $antall = $enavn = $fnavn = $pris = "--";
    }
    
    if(isset($_POST['search'])){
        $referanse = $_POST['searchInput'];
            if((preg_match("/[a-zA-Z0-9]+/", $referanse) || $referanse !== "")) {
            $_SESSION['referanse'] = $referanse;

            header("Location: ferdig.php");
            die();
        }
    }
    
?>

<html>
    <head>
        <title>Oppgave 3</title>
        <link rel="stylesheet" type="text/css" href="css/film.css">
        <meta charset="UTF-8">
       
    </head>
    <body>
        <div id="header"><a href="bestilling.php">KinoBilletten</a>
                <form method="post" class="search" action="">
                    <input type="text" name="searchInput" id="search" value="" placeholder="Ref.nr">
                    <input type="submit" name="search" id="srcbtn" value="Søk">
                </form> 
        </div>
        <div class="content">
            
                <table class="ferdig">
                    <tr>
                        <td>
                            <h2>Ditt referansenummer: <u><?=$referanse?></u></h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Detaljer:</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><u>Film: <?= $filmNavn ?></u></p>
                            <p><?= $typeNavn?> x <?=$antall?></p>
                            <p>Kl. <?= $tid ?> Den <?= $dato?></p>
                            <p>Bestilt av: <?= $fnavn." ".$enavn?></p>
                            <p>Betalt kr <?= $pris ?></p>
                        </td>
                    </tr>
                  
                </table>
           
        </div>    
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>

