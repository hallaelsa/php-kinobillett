$(function(){
    var validate = function(element, regex, validID) {
        element.blur(function() {
            var value = element.val();

            if(value.length == 0) {
              element.addClass('invalid');
              $(validID).addClass('feilmelding');
              $(validID).text("*Feltet må fylles ut");
            } else if(!(regex.test(value))) {
              element.addClass('invalid');
              $(validID).addClass('feilmelding');
              $(validID).text("*Ugyldige eller feil antall tegn");
            } else{
              element.removeClass('invalid');
              $(validID).removeClass('feilmelding');
              $(validID).text("*");
            }
        });
        
        element.focus(function() {
            $(validID).removeClass('feilmelding');
            $(validID).text("*");
        });
    };
    
    validate($("#fnavn"), /^[a-zA-ZøæåØÆÅ .\- ]*$/, "#fnavnValid");
    validate($("#enavn"), /^[a-zA-ZøæåØÆÅ .\- ]*$/, "#enavnValid");
    validate($("#tlf"), /(^[0-9]{8}$)|(^[0-9]{3}[ ][0-9]{2}[ ][0-9]{3}$)|(^[0-9]{2}[ ][0-9]{2}[ ][0-9]{2}[ ][0-9]{2}$)/, "#tlfValid");
    validate($("#epost"), /^[A-ZÆØÅa-zæøå0-9._+-]+@[A-ZÆØÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,4}$/, "#epostValid");
    
    
    $('.tid').on('click', function(){
        $('#tid').val($(this).text());
        $('#tid_t').val($(this).text());
        $('#film').val($(this).siblings('h3').text());
        $('#film_t').val($(this).siblings('h3').text());
        $('#visning_id').val($(this).val());
        
        $('#antall').html("<option disabled='disabled'>Antall</option>");
        for (var i = 1; i <= (($(this).next().val() > 10 ? 10 : $(this).next().val())); i++) {
            $('#antall').append("<option name='antall'>"+i+"</option>");
        }
    });
   
   
    $("#dateselect").change(function(e) {
        window.location.href = "?dato=" + e.currentTarget.value;
    });
   
    
    $('#tilbake').on('click', function() {
        history.back(1);
    });
});