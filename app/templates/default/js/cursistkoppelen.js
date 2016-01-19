
/* FUNCTIES ***
 ================================================================================== */


/* 1. Vul gebruikers multiselect
 ================================================================================== */
function VulGebruikers(gebruikers, BootPlaatsen){

    // variabele genereren
    MultiSelectOptions = '';

    // variabele vullen
    $.each(gebruikers, function(key, value){
        MultiSelectOptions += '<option value="' + value.klant_id + '" title="Opmerking / Voorkeur: \r\n' + value.Opmerkingen + '">' + value.voornaam + ' ' + value.tussenvoegsel + ' ' + value.achternaam + '</option>';
    });
    console.log(MultiSelectOptions);

    // zeggen hoeveel plaatsen er nog op de boot zijn
    $("#KiesGebruikers").attr('data-plaatsen',BootPlaatsen);

    // modal vullen met gegevens
    $("#KiesGebruikers").html(MultiSelectOptions);
}

/* 2. Vul cursustabel
 ================================================================================== */
function VulCursusTabel(cursus){
    CursusTabel = '';

    $.each(cursus, function(key, value){
        if(key == 'cursus_id'){
            CursusTabel += '<tr><th>' + key + '</th><td><input type="hidden" name="cursus" value="' + value + '" />' + value + '</td></tr>';
        }else{
            CursusTabel += '<tr><th>' + key + '</th><td>' + value + '</td></tr>';
        }

    });

    $("#CursusTabel").html(CursusTabel);

}

/* 3. Vul boten select
 ================================================================================== */
function VulBoten(boten){
    SelectOption = '';
    $.each(boten, function(key, value){
        maxplaatsen = value.passagiers - value.BezettePlekken;
        if(maxplaatsen == 1){
            maxplaatsen_II = maxplaatsen + ' plek over';
        }else if(maxplaatsen == 0){
            maxplaatsen_II = 'geen plekken over';
        }else{
            maxplaatsen_II = maxplaatsen + ' plekken over';
        }
        SelectOption += '<option data-max="' + maxplaatsen + '" value="' + value.boot_id + '">' + value.bootnaam + ' (' + value.bouwjaar + '), ' + maxplaatsen_II + '</option>';
    });

    // modal vullen met gegevens
    $("#KiesBoot").html(SelectOption);
}

/* 4. Vul Instructeurs select
 ================================================================================== */
function VulInstructeurs(instructeur){
    SelectOption = '';
    $.each(instructeur, function(key, value){
        console.log(value.bootnaam);
        if(value.bootnaam != null){
            SelectOption += '<option value="' + value.instructeur_id + '">' + value.instructeur_voorletters + ' ' + value.instructeur_tussenvoegsels + ' ' + value.instructeur_achternaam + ' (gekoppeld aan: ' + value.bootnaam + ')</option>';
        }else{
            SelectOption += '<option value="' + value.instructeur_id + '">' + value.instructeur_voorletters + ' ' + value.instructeur_tussenvoegsels + ' ' + value.instructeur_achternaam + '</option>';
        }
    });

    // modal vullen met gegevens
    $("#KiesInstructeur").html(SelectOption);
}

/* 5. Open modal voor Koppelingen
 ================================================================================== */
function KoppelRijById(id){
    //gegevens ophalen
    $.ajax({
        method: "POST",
        url: "/zeilschooldewaai/app/api/koppelen.php?action=1",
        data: {
            cursus_id: id
        },
        success: function( data ) {
            // data verzamelen

            data = JSON.parse(data);
            console.log(data);
            /* definen */
            cursus = data[1];
            gebruikers = data[2];
            instructeurs = data[4];


            if(gebruikers != ''){
                boten = data[3];
                if(boten != ''){
                    max_plaatsen = data[3][0].passagiers - data[3][0].BezettePlekken;

                    // functies
                    VulGebruikers(gebruikers, max_plaatsen);
                    VulCursusTabel(cursus);
                    VulBoten(boten, max_plaatsen);
                    VulInstructeurs(instructeurs);
                    // input velden genereren

                    // modal vullen met gegevens
                    $("#KoppelModalHeader").html('Boot koppelen');
                    $("#KiesGebruikers").html(MultiSelectOptions);
                    $('#SaveBtn').attr('data-action','2');
                    // modal laten zien
                    $("#ModalMessages").html('');
                    $('#KoppelModal').modal('show');
                }else{
                    $("#ModalMessages").html('<div class="alert alert-danger" role="alert">Er zijn geen boten beschikbaar om te koppelen.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }

            }else{
                $("#ModalMessages").html('<div class="alert alert-danger" role="alert">Er zijn geen cursisten (meer) beschikbaar om te koppelen.   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }


        }
    });
}

/* 6. Open modal voor het bekijken van koppelingen
 ================================================================================== */
function BekijkRijById(id){
    $.ajax({
        method: "POST",
        url: "/zeilschooldewaai/app/api/koppelen.php?action=3",
        data: {
            cursus_id: id
        },
        success: function( data ) {
            // data verzamelen

            data = JSON.parse(data);
            console.log(data);

            var body = '';
            var i = 1;
            // functies
            $.each(data, function(key, value){
                console.log(value);
                body += '<tr>' +
                    '<td>' + i + '.</td>' +
                    '<td>' + value.voorletters + ' ' + value.tussenvoegsel + ' ' + value.achternaam + '</td>' +
                    '<td>' + value.bootnaam + '</td>' +
                    '<td>' + value.instructeur_voorletters + ' ' + value.instructeur_tussenvoegsels + ' ' + value.instructeur_achternaam + '</td>' +
                    '<td onclick="DeleteConnection(this)" data-cursusid="' + value.cursus_id + '" data-klantid="' + value.klant_id + '" data-bootid="' + value.boot_id + '"><i class="fa fa-trash"></i></td>' +
                    '</tr>';
                i++;
            });

            // input velden genereren

            // modal vullen met gegevens
            $("#BotenTabel").html(body);
            // modal laten zien

            $('#BekijkModal').modal('show');

        }
    });
}

/* 6. Connectie verwijderen
 ================================================================================== */
function DeleteConnection(p){
    klant_id = $(p).data('klantid');
    boot_id = $(p).data('bootid');
    cursus_id = $(p).data('cursusid');

    $.ajax({
        method: "POST",
        url: "/zeilschooldewaai/app/api/koppelen.php?action=4",
        data: {
            cursus_id: cursus_id,
            klant_id: klant_id,
            boot_id: boot_id
        },
        success: function (data) {
            console.log(data);
            BekijkRijById(cursus_id);
        }
    });
}

/* TRIGGERS ***
 ================================================================================== */

/* Trigger om koppelingen te bekijken
 ================================================================================== */
$(".BekijkKoppelingen").click(function() {
    // id ophalen
    var id = $(this).attr('data-id');
    BekijkRijById(id);
    //gegevens ophalen

});

/* Trigger om Rijen te koppelen
 ================================================================================== */
$(".KoppelRij").click(function() {
    // id ophalen
    var id = $(this).attr('data-id');
    KoppelRijById(id);

});

$(".DownloadCursus").click(function(){
    $.ajax({
        method: "POST",
        url: "/zeilschooldewaai/app/api/koppelen.php?action=5",
        data: {
            cursus_id: 'test'
        },
        success: function (data) {
            console.log(data);
        }
    });
});

/* Als een boot gekozen is zal het aantal plekken veranderen
================================================================================== */
$('#KiesBoot').on('change', function() {
    var max = $("#KiesBoot").find(':selected').data('max');
    $("#KiesGebruikers").attr('data-plaatsen',max);
});

/* Kijken hoeveel plekken er nog mogelijk zijn en of het limiet overschreden is
 ================================================================================== */
$('#KiesGebruikers').on('change', function() {
    var max = $(this).attr('data-plaatsen');
    console.log(max);
    var current = this.selectedOptions.length;
    if (current > max) {
        $("#messages").html('<div class="alert alert-danger" role="alert"><b>Waarschuwing:</b> u heeft het maximaal aantal cursusten dat op deze boot past overschreden, het maximale aantal is: <b>' + max + '</b></div>');
    }else{
        $("#messages").html('');
    }
});

/* Formulier afhandelen
 ================================================================================== */
$('#KoppelForm').submit(function (e) {
    // zorgt ervoor dat het formulier niet submit
    e.preventDefault();
    // type CRUD defineren
    var action = 2;//$('#SaveBtn').attr('data-action');
    // send dem data to validation
    $.post( "/zeilschooldewaai/app/api/koppelen.php?action=" + action, $('form').serialize())
        .done(function( data ) {
            console.log(data);
            location.reload();
        });
});