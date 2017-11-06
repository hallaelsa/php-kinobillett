<?php 
    session_start();
    include("business/dbService.php");
    include("business/filmService.php");
    include("business/billettService.php");
    //include ("feil.php");
    ini_set('display_errors', 1);
    ini_set('display_startut_srrors', 1);
    error_reporting(E_ALL);
    
    $fnavn = isset($_POST['fnavn']) ? $_POST['fnavn'] : null;
    $enavn= isset($_POST['enavn']) ? $_POST['enavn'] : null;
    $tlf = isset($_POST['tlf']) ? preg_replace("/\s+/", "", $_POST['tlf']) : null;
    $epost = isset($_POST['epost']) ? $_POST['epost'] : null;
    $film = isset($_POST['film']) ? $_POST['film'] : null;
    $tid = isset($_POST['tid']) ? $_POST['tid'] : null;
    $visning_id = isset($_POST['visning_id']) ? $_POST['visning_id'] : null;
    $dato = isset($_GET['dato']) ? $_GET['dato'] : date('Y-m-d');
    $typeSelected = isset($_POST['type']) ? $_POST['type'] : null;
    $antall = isset($_POST['antall']) ? $_POST['antall'] : null;
    $fnavnValid = true;
    $enavnValid = true;
    $tlfValid = true;
    $epostValid = true;
    $filmValid = true;
    $antallValid = true;
    $idag = date('d.m.Y');

    $dbService = new dbService("student.cs.hioa.no", "s315579", "", "s315579");
    $filmService = new filmService($dbService);
    $filmer = $filmService->hentFilmer();
    $typer = $filmService->hentBillettyper();
    $billettService = new billettService($dbService);
    
    if(isset($_POST["submit"])){
        $formValid = true;
        
        if(!preg_match("/^[A-ZÆØÅa-zæøå]{2,20}[ ']*[A-ZÆØÅa-zæøå]*$/", $fnavn)){
            $fnavnValid = false;
            $formValid = false;
        } else {
            $_SESSION['fnavn'] = $fnavn;
        }
        if(!preg_match("/^[A-ZÆØÅa-zæøå]{2,20}$/", $enavn)){
            $enavnValid = false;
            $formValid = false;
        } else {
            $_SESSION['enavn'] = $enavn;
        }
        if(!preg_match("/^[0-9]{8}$/", $tlf)){
            $tlfValid = false;
            $formValid = false;
        }else {
            $_SESSION['tlf'] = $tlf;
        }
        if(!preg_match("/^[A-ZÆØÅa-zæøå0-9._+-]+@[A-ZÆØÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,4}$/", $epost)){
            $epostValid = false;
            $formValid = false;
        }else {
            $_SESSION['epost'] = $epost;
        }
        
        if($visning_id == null || $filmService->hentVisning($visning_id) == null){
            $filmValid = false;
            $formValid = false;
        }else {
            $_SESSION['visning_id'] = $visning_id;
        }
        
        if(preg_match("/[1-9]/", $typeSelected)) {
            $_SESSION['type_id'] = $typeSelected;
        } else {
            $formValid = false;
        }
        if(preg_match("/[1-9][0]{0,1}/", $antall)) {
            $_SESSION['antall'] = $antall;
        } else {
            $formValid = false;
            $antallValid = false;
        }
        
        if ($formValid == true) {
            header("Location: reg.php");
            die();
        }
    }
    
    if(isset($_POST['search'])){
        $referanse = $_POST['searchInput'];
        if((preg_match("/[a-zA-Z0-9]+/", $referanse) && !($referanse == ""))) {
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
                <select id="dateselect">
                    <?php 

                    for($i = 0; $i <= 7; $i++) {
                        $selectDato = date('Y-m-d', strtotime($idag .'+'.$i.'day'));
                        $selectDatoNavn = date('d.m.Y', strtotime($idag .'+'.$i.'day'));
                        $selected = $selectDato == $dato ? "selected='selected'" : "";
                        echo "<option value='".$selectDato."' ".$selected.">".$selectDatoNavn."</option>";
                    }
                    
                    ?>  
                </select>
            <form method="post" action="">
                <table class="bestilling">
                    <tr>
                        <td id="overskrift">
                            <span>Bestill billett<span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label for="fnavn">Fornavn</label> <span id="fnavnValid" >*</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text">
                            <input type="text"  class="<?= $fnavnValid ? "" : "invalid"?>" id="fnavn" name="fnavn" value="<?= $fnavn ?>" placeholder="Ola">
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label for="enavn">Etternavn</label> <span id="enavnValid" >*</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text">
                            <input type="text"  class="<?= $enavnValid ? "" : "invalid"?>" id="enavn" name="enavn" value="<?= $enavn ?>" placeholder="Olsen">
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label for="tlf">Telefonnummer</label> <span id="tlfValid">*</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text">
                            <input type="text" class="<?= $tlfValid ? "" : "invalid"?>"  id="tlf"  name="tlf" value="<?= $tlf ?>" placeholder="888 88 888">
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="epost">E-post</label> <span id="epostValid">*</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text">
                            <input type="text" class="<?= $epostValid ? "" : "invalid"?>" id="epost" name="epost" value="<?= $epost ?>" placeholder="eksempel@gmail.com">
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="film">Film og tidspunkt</label> 
                        </td>
                    </tr>
                    <tr>
                        <td class="text">
                            <input type="text" class="<?= $filmValid ? "" : "invalid"?>" disabled="disabled" id="film_t" value="<?= $film ?>" placeholder="klikk på tidspunktet til filmen">
                            <input type="text" class="<?= $filmValid ? "" : "invalid"?>" disabled="disabled" id="tid_t"  value="<?= $tid ?>">
                            <input type="hidden" id="film" name="film" value="<?= $film ?>">
                            <input type="hidden" id="tid" name="tid" value="<?= $tid ?>">
                            <input type="hidden" id="visning_id" name="visning_id" value="<?= $visning_id ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Velg type billett og antall</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text" >
                            <select id="type" name="type">
                                <?php
                                foreach($typer as $type){
                                    $typeNavn = $type->navn;
                                    $typeID = $type->id;
                                    $selected = $typeID == $typeSelected ? "selected='selected'" : "";
                                    echo "<option name='type' value='".$typeID."' ".$selected.">".$typeNavn."</option>";
                                }
                                ?>
                            </select>
                            <select id="antall" name="antall" class="<?=$antallValid ? "" : "invalid"?>">
                                <?php
                                echo "<option disabled='disabled'>Antall</option>";
                                if(isset($visning_id)){
                                    $plasser = $filmService->hentVisning($visning_id)->plasser;
                                    $tattPlasser = $filmService->hentAntallBestilte($visning_id);
                                    
                                    for($i = 1; $i <= (($plasser - $tattPlasser) > 10 ? 10 : ($plasser - $tattPlasser)); $i++){
                                        $selectedAntall = $antall == $i ? "selected='selected'" : "";
                                        echo "<option ".$selectedAntall. ">".$i."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" class="submit" value="Neste">
                        </td>
                    </tr>
                </table>

                <table class="filmer">
<?php

$harVisninger = false;

foreach ($filmer as $film) {
    $visninger = $filmService->hentVisninger($film->id, $dato);
    
    if (count($visninger) == 0)
        continue;
    
    $harVisninger = true;
?>                   
    <tr>
        <td>
            <img src="<?=$film->bildeUrl?>"/>
        </td>
        <td class="innhold">
            <h3><?=$film->navn?></h3>
            <p><?=$film->beskrivelse?></p>
                        
<?php 
    foreach ($visninger as $visning) {
        $tattPlasser = $filmService->hentAntallBestilte($visning->id);
        if(($visning->plasser - $tattPlasser) > 0) { 
?>   
            
            <button type="button" class="tid" value="<?= $visning->id ?>"> <?= date('H:i', strtotime($visning->dato))?> </button> 
            <input type="hidden" id="antall_t" name="antall_t" value="<?= ($visning->plasser - $tattPlasser)?>">

<?php
        }
    }
?>

        </td>
    </tr>
    
<?php
}

if (!$harVisninger) {
    echo "<tr><td>Det er ingen visninger på denne datoen.</td></tr>";
}
?>
                    
            </table>
            </form>
            </div>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>


