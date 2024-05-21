$(function () {

    // var prof1 = {
    //     nombre: "juan",
    //     edad: 23,
    // };
    // var prof2 = {
    //     nombre: "maría",
    //     edad: 24,
    // };
    // var prof3 = {
    //     nombre: "antonio",
    //     edad: 28,
    // };
    
    // var profesores = [prof1, prof2, prof3];

    // console.log(profesores);




    
    var profesores = [
        { nombre: "juan", edad: 23 },
        { nombre: "maría", edad: 24 },
        { nombre: "antonio", edad: 28 }
    ];

    var teacherProfilesDiv = $('#teacherProfiles');

    // Iterate through the profesores array
    $.each(profesores, function(index, profesor) {
        // Create a Bootstrap card for each teacher
        // var cardDiv = $('<div>')
        // cardDiv.class=""
        var cardBodyDiv = $('<div class="card-body prof"></div>');
        var cardTitle = $('<h5 class="card-title">' + profesor.nombre + '</h5>');
        var cardText = $('<p class="card-text">Edad: ' + profesor.edad + '</p>');

        // Append elements to cardBodyDiv
        cardBodyDiv.append(cardTitle);
        cardBodyDiv.append(cardText);

        // Append cardDiv to teacherProfilesDiv
        teacherProfilesDiv.append(cardBodyDiv);
    });
})