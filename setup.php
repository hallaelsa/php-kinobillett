<?php
    include("business/dbService.php");
    $dbService = new dbService("student.cs.hioa.no", "s315579", "", "s315579");
    $tables = true;

    
    //lager filmtabell
    $filmtabell = $dbService->create("
        CREATE TABLE film2 (
        id int(11) NOT NULL AUTO_INCREMENT,
        navn varchar(100) NOT NULL,
        beskrivelse blob NOT NULL,
        bildeUrl varchar(255) NOT NULL,
        PRIMARY KEY (id)
      ) ");
    
    if($filmtabell){
        //inserte filmene
        $dbService->insert("
            INSERT INTO film2
            (
            navn,
            beskrivelse,
            bildeUrl)
            VALUES
            (
            'Guardians of the galaxy 2',
            'Action',
            'images/galaxys.jpg');");

            //inserte filmene
        $dbService->insert("
            INSERT INTO film2
            (
            navn,
            beskrivelse,
            bildeUrl)
            VALUES
            (
            'La La Land',
            'Dramafilm/Romantisk film',
            'images/lalalands.jpg');");

            //inserte filmene
        $dbService->insert("
            INSERT INTO film2
            (
            navn,
            beskrivelse,
            bildeUrl)
            VALUES
            (
            'Moonlight',
            'Dramafilm',
            'images/moonlights.jpg');");

            //inserte filmene
        $dbService->insert("
            INSERT INTO film2
            (
            navn,
            beskrivelse,
            bildeUrl)
            VALUES
            (
            'Passengers',
            'Fantasyfilm/Science fiction',
            'images/passengerss.jpg');");

            //inserte filmene
        $dbService->insert("
            INSERT INTO film2
            (
            navn,
            beskrivelse,
            bildeUrl)
            VALUES
            (
            'Trolls',
            'Fantasyfilm/Eventyrfilm',
            'images/trollss.jpg');");

        //inserte filmene
        $dbService->insert("
            INSERT INTO film2
            (
            navn,
            beskrivelse,
            bildeUrl)
            VALUES
            (
            'X-Men: Apocalypse',
            'Fantasyfilm/Science fiction',
            'images/xmens.jpg');");
    } else {
        echo "Noe gikk galt med opprettelsen av film";
        $tables = false;
    }
    
    //lage billettype
    $billettyper = $dbService->create("
        CREATE TABLE billettype2 (
        id int(11) NOT NULL AUTO_INCREMENT,
        pris int(11) NOT NULL,
        navn varchar(45) NOT NULL,
        PRIMARY KEY (id)
      )");
    
    if(!$billettyper){
        echo "noe gikk galt med opprettelsen av billettyper";
        $tables = false;
    }
    
    //lage visning
    $visning = $dbService->create("
        CREATE TABLE `visning` (
        id int(11) NOT NULL AUTO_INCREMENT,
        film_id int(11) NOT NULL,
        dato datetime NOT NULL,
        plasser int(11) NOT NULL,
        PRIMARY KEY (id),
        KEY film_id_idx (film_id),
        CONSTRAINT film_id FOREIGN KEY (film_id) REFERENCES film2 (id) ON DELETE NO ACTION ON UPDATE NO ACTION
      )");
    
    if(!$visning){
        echo "Noe gikk galt med opprettelse av visning";
        $tables = false;
    }
    
    //lager bestilling
    $bestilling = $dbService->create("
        CREATE TABLE bestilling (
        id int(11) NOT NULL AUTO_INCREMENT,
        visning_id int(11) NOT NULL,
        billettype_id int(11) NOT NULL,
        antall int(11) NOT NULL,
        pris int(11) NOT NULL,
        referanse varchar(10) DEFAULT NULL,
        fornavn varchar(45) NOT NULL,
        etternavn varchar(45) NOT NULL,
        telefonnummer varchar(45) DEFAULT NULL,
        epost varchar(45) DEFAULT NULL,
        PRIMARY KEY (id),
        KEY visning_id_idx (visning_id),
        KEY billettype_id_idx (billettype_id),
        CONSTRAINT billettype_id FOREIGN KEY (billettype_id) REFERENCES billettype2 (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT visning_id FOREIGN KEY (visning_id) REFERENCES visning (id) ON DELETE NO ACTION ON UPDATE NO ACTION
      )");
    
    if(!$bestilling){
        echo "Noe gikk galt med opprettelse av bestilling";
        $tables = false;
    }
    
    if($tables){
        
        echo "Insert complete!";
        header("Location: generatefilms.php");
        die();
    }