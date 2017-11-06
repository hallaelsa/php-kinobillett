<?php
    session_start();
    include("business/filmService.php");
    include("business/dbService.php");
    include("business/billettService.php");
    include("feil.php");    
    
    $fnavn = $_SESSION['fnavn'];
    $enavn = $_SESSION['enavn'];
    $tlf =  $_SESSION['tlf'];
    $epost = $_SESSION['epost'];
    $antall = $_SESSION['antall'];
    $visning_id = $_SESSION['visning_id'];
    $type_id = $_SESSION['type_id'];
    
    $dbService = new dbService("student.cs.hioa.no", "s315579", "", "s315579");
    $filmService = new filmService($dbService);
    $billettService = new billettService($dbService);
    
    $visningsInfo = $filmService->hentVisning($visning_id);
    $filmInfo = $filmService->hentFilm($visningsInfo->film_id);
    $typeInfo = $filmService->hentBillettype($type_id);
    $tid = date('H:i', strtotime($visningsInfo->dato));
    $dato = date('d.m', strtotime($visningsInfo->dato));        
    $filmNavn = $filmInfo->navn;
    $filmBilde = $filmInfo->bildeUrl;
    $typeNavn = $typeInfo->navn;
    $typePris = $typeInfo->pris;
    $total = $typePris*$antall;
    
    if(isset($_POST['registrer'])){
        $registreringsID = $billettService->registrerBillett($visning_id, $type_id, $antall, $total, $fnavn, $enavn, $tlf, $epost);
        $ref_nr = $registreringsID.":".rand(0,99);
        $referanse = rtrim(base64_encode($ref_nr), '=');
        $billettService->registrerRegNr($referanse, $registreringsID);
        $_SESSION['referanse'] = $referanse;
        header("Location: ferdig.php");
        die();
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
            <form action="" method="post">
                <table class="reg">
                    <tr>
                        <td colspan="4">
                            <p id="bestillingsdato">Bestillt: <?= date('d.m.Y');?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <h1>Din billett:</h1>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <h2><u>Film: <?= $filmNavn?></u></h2>
                        </td>
                        <td rowspan="3">
                            <img id="bildevisning" src="<?=$filmBilde?>">
                        </td>
                    </tr>
                    <tr>
                        <td> 
                            <h4>Kl.<?= $tid?> </h4>
                        </td>
                        <td>
                            <h4>Den <?= $dato?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <h4><?=$typeNavn?> x <?=$antall?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"> 
                            <h2><u>Kr: <?= $total ?></u></h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" id="tilbake">Tilbake</button>
                        </td>
                        <td colspan="3">
                            <input type="submit" name="registrer" class="submit" value="bekreft">
                        </td>
                    </tr>
                </table>
            </form>
        </div>    
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>


    

