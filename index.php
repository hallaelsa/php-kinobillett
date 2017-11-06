<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            body {
                background: url('images/bg1.jpg');
                background-size: cover;
                width: 700px;
                margin: auto;
                margin-bottom: 50px;
                font-family: 'Open Sans', sans-serif;
                
            }
            
            .content {
                background-color: white;
                padding: 20px 40px 40px 40px;
                margin-top: 10px;
            }
            
            #kommentar {
                color: red;
                font-style: italic;
            }
            
        </style>
            
    </head>
    <body>
        <div class="content">
            
        <h1>Oppgave 1</h1>
        <h3>a) Lag et PHP script som lister ut alle tall som er delelige med 3 opp til 100. Bruk en for-løkke.</h3>
        <?php 
            echo "Følgende tall er delelige på 3: <br>";
            echo "for-løkke: ";
            for($i = 1; $i < 100; $i++) {
                if($i % 3 == 0){
                    echo $i.", ";
                }
            }
        ?>
        
        <h3>b) Lag samme utskrift som over med en while-løkke.</h3>
        
        <?php  
            echo "while-løkke: ";
            $j = 1;
            $sumAvTall = 0;
            $antallTall = 0;
            while($j < 100) {
                if($j % 3 == 0){
                    echo $j.", ";
                    $sumAvTall += $j;
                    $antallTall++;
                }
                $j++;
            }
        ?>
        
        <h3>c) Finn så gjennomsnittet av de samme tallene (de som er delelig med 3 opptil 100).</h3>
        
        <?php
            $svar = $sumAvTall / $antallTall;
            echo "gjennomsnittet er: ".$svar;
        ?>
        
        <h1>Oppgave 2</h1>
        <p>Gitt tallrekken: 1,4,8,1,4,10,5,6,2,4,6. Opprett et array for denne rekken av tall. Bruk så dette arrayet til:</p>
        
        <?php 
            $array = array(1,4,8,1,4,10,5,6,2,4,6);
        ?>
        
        <h3>a) Skriv ut alle tallene som er over 5.</h3>
        
        <?php 
        foreach ($array as $value) {
            if($value > 5) {
                echo $value.", ";
            }
        }
        ?>
        
        <h3>b) Tell opp hvor mange tall som er over 5 og vis dette.</h3>
        
        <?php 
            $antallValue = 0;
            foreach($array as $value2) {
                if($value2 > 5) {
                $antallValue++;
                }
            }
            echo "Antall tall over 5 er: ".$antallValue;
        ?>
        
        <h3>c) Liste ut tallene baklengs.</h3>
        
        <?php 
            
            foreach(array_reverse($array) as $value3) {
                echo $value3.", ";
            }
        ?>
        
        <h3>d) Finn det minste tallet ved en løkke. Skriv så tallet ut.</h3>
        
        <?php 
            $minsteTall = 1000;
            
            foreach($array as $value4){
                if($minsteTall > $value4) {
                    $minsteTall = $value4;
                }
            }
            
            echo "Det minste tallet er: ".$minsteTall;
        ?>
        
        <h3>e) Finn det minste tallet ved en PHP funksjon. Skriv så tallet ut.</h3>
        
        <?php 
            $minsteTall2 = min($array);
            echo "Det minste tallet er: ".$minsteTall2;
        ?>
        
        <h3>f) Lag så egendefinerte funksjoner med en innparameter for oppgave a) og b). Parameteren inn
        skal angi tallet som skal testes på i oppgavene. Funksjonene skal returnere verdier (tips, bruk
        et array i oppgave a). </h3>
        <p id="kommentar">Her er det litt uklart hva man skal sende inn. Det står ett tall, 
            men samtidig må det en mengde tall til for å finne hvor mange tall som er over fem. 
            Et alternativ er å lage en funksjon som kun tester om tallet er over 5 eller ikke, 
            og så kalle på funksjonen hver gang man looper igjennom arrayet.
            Jeg har valgt å løse oppgaven på samme måte som i oppgave a og b ved å sende inn et array.
        </p>
        
        <?php 
        echo "Kall på funksjon a: <br>";
        echo tallOverFem($array);
        echo "<br>Kall på funksjon b: <br>";
        echo antallOverFem($array);
        
        function tallOverFem($arrayInput) {
            $string = "";
            foreach ($arrayInput as $value5) {
                if($value5 > 5) {
                    $string .= $value5.", ";
                }
            }
            return $string;
        }
        
        function antallOverFem($arrayInput) {
            $antallValue2 = 0;
            foreach($arrayInput as $value6) {
                if($value6 > 5) {
                $antallValue2++;
                }
            }
            return $antallValue2;
        }
        
        ?>
        
        <h1>Oppgave 3</h1>
        <p>For å kjøre siden må det opprettes en lokal database ved navn 'oblig' og <a href="setup.php">setup.php</a> må kjøres.</p>
        <a href="bestilling.php">Gå til besvarelse av oppgave 3<a>
        </div>
    </body>
</html>
