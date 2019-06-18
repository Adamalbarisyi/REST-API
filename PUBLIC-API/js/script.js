function searchMovie() {
    $('#movie-list').html('');

    $.ajax({
        url: 'http://omdbapi.com',
        type: 'get',
        dataType: 'json',
        data: {
            'apikey': '8d1acc08',
            's': $('#search-input').val()
        },
        success: function (result) {
            console.log(result);
            if (result.Response == "True") {

                let movies = result.Search;
                console.log(movies);

                $.each(movies, function (i, data) {
                    $('#movie-list').append(`
                    <div class="col-md-4">
                    <div class="card mb-4">
                    <img src="` + data.Poster + `" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">` + data.Title + `</h5>
                        <h6 class="card-subtitle mb-2 text-muted">` + data.Year + `</h6>
                        <a href="#" class="card-link see-detail" data-toggle="modal" data-target="#exampleModal" data-id="` + data.imdbID + `">See Detail Info</a>
                    </div>
                    </div>
                    </div>
                    `);

                });

                $('#search-input').val('');



            } else {
                $('#movie-list').html(`
                <div class="col">
                    <h1 class="text-center">` + result.Error + `</h1>
                </div>
                `)
            }
        }
    });
}

$('#search-button').on('click', function () {
    searchMovie();

});

$('#search-input').on('keyup', function (event) {
    if (event.keyCode === 13) {
        searchMovie();
    }
});


$('#movie-list').on('click', '.see-detail', function () {
    // console.log($(this).data('id'));
    $.ajax({
        url: 'http://omdbapi.com',
        dataType: 'json',
        type: 'get',
        data: {
            'apikey': '8d1acc08',
            'i': $(this).data('id')
        },
        success: function (movie) {
            if (movie.Response === "True") {
                $('.modal-body').html(`
                    <div class="container-fluid">
                        <div class="row">
                             <div class="col-md-4">
                                <img src="` + movie.Poster + `" class="img-fluid">
                             </div>
                   
                             <div class="col-md-8">
                                <ul class="list-group">
                                <li class="list-group-item">Title :` + movie.Title + `</li>
                                <li class="list-group-item"> Released :` + movie.Released + `</li>
                                <li class="list-group-item"> Genre :` + movie.Genre + `</li>
                                <li class="list-group-item"> Director :` + movie.Director + `</li>
                                <li class="list-group-item"> Actors :` + movie.Actors + `</li>
                              
                                </ul>
                             </div>
                        </div>
                    </div>
                `)
            }
        }

    });



});