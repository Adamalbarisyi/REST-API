<?php
function get_CURL($url){
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL, $url);
  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
  $result = curl_exec($curl);
  curl_close($curl);
  
  return json_decode($result,true);
}

$result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCOvke9xmkIZCjWiZxOrcoVA&key=AIzaSyD359WbHRHyOO9TQJwh4v2kDSzpvZJXx2M');


$youtubeProfilePicture = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result ['items'][0]['snippet']['title'];
$subscribers= $result['items'][0]['statistics']['subscriberCount'];

//latest Video
$urlLatestVideo ='https://www.googleapis.com/youtube/v3/search?key=AIzaSyD359WbHRHyOO9TQJwh4v2kDSzpvZJXx2M&channelId=UCOvke9xmkIZCjWiZxOrcoVA&maxResult=1&order=date&part=snippet';
$result = get_CURL($urlLatestVideo);

$latestVideoId = $result['items']['0']['id']['videoId'];

// instagram API
$clientId ='5eac32357edd469a99b042585dce2ca4';
$accessToken ='2057839016.5eac323.19f5d49d52854322982e0bd567d5ea59';

$result = get_CURL('https://api.instagram.com/v1/users/self?access_token=2057839016.5eac323.19f5d49d52854322982e0bd567d5ea59');
$usernameIG =$result['data']['username'];
$profilePictureIG = $result ['data']['profile_picture'];
$followersIG= $result['data']['counts']['followed_by'];


$result = get_CURL('https://api.instagram.com/v1/users/self/media/recent?access_token=2057839016.5eac323.19f5d49d52854322982e0bd567d5ea59&count=16');
$photos=[];
foreach($result['data'] as $photo){
  $photos[]=$photo['images']['thumbnail']['url'];
}


?>  

<!doctype html>
<html lang="en">



<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
    crossorigin="anonymous">

  <!-- My CSS -->
  <link rel="stylesheet" href="css/style.css">

  <title>My Portfolio</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#home">Muhammad Rifki Adam A</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#social">Social Media</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#portfolio">Portofolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="jumbotron" id="home">
    <div class="container">
      <div class="text-center">
        <img src="img/profile1.png" class="rounded-circle img-thumbnail">
        <h1 class="display-4">Muhammad Rifki Adam A</h1>
        <h3 class="lead">Editor | Programmer | Videographer | Photographer</h3>
      </div>
    </div>
  </div>


  <!-- About -->
  <section class="about" id="about">
    <div class="container">
      <div class="row mb-4">
        <div class="col text-center">
          <h2>About</h2>
        </div>
      </div>
      <div class="container mt-3">
        <div id="myCarousel" class="carousel slide">
        
          <!-- Indicators -->
          <ul class="carousel-indicators">
            <li class="item1 active"></li>
            <li class="item2"></li>
            <li class="item3"></li>
          </ul>
        
          <!-- The slideshow -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="./img/3.jpeg" alt="Los Angeles" width="1100" height="500">
            </div>
            <div class="carousel-item">
              <img src="./img/2.jpeg" alt="Chicago" width="1100" height="500">
            </div>
            <div class="carousel-item">
              <img src="./img/1.jpeg" alt="New York" width="1100" height="500">
            </div>
          </div>
        
          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#myCarousel">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#myCarousel">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Social Media -->
  <section class="social bg-light" id="social">
    <div class="container">
      <div class="row pt-4 mb-4">
        <div class="col text-center">
          <h2>Social Media</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4">
              <img src="<?= $youtubeProfilePicture?> " width="100" class="rounded-circle img-thumbnail">
            </div>
            <div class="col-md-8">
              <h5>
                <?= $channelName?>
              </h5>
              <p>
                <?= $subscribers?> Subscribers</p>
                <div class="g-ytsubscribe" data-channelid="UCOvke9xmkIZCjWiZxOrcoVA" data-layout="default" data-count="default"></div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $latestVideoId ?>?rel=0"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col"> <h5>My Video Documentation</h5>
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/PgI9xAFSDak?rel=0"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zSkmtiD7c44?rel=0"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/VoYu_tjbthM?rel=0"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/wmz3mHVEk1A?rel=0"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/neUWji4R2cs?rel=0"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/yeBEzrml194?rel=0"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/5_QNsCb8GRs?rel=0"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/OQSj3F5JAz8?rel=0"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/A8ECD3Ie--g?rel=0"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>

        </div>

        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4">
              <img src="<?= $profilePictureIG; ?>" width="100" class="rounded-circle img-thumbnail">
            </div>
            <div class="col-md-8">
              <h5><?= $usernameIG; ?></h5>
              <p><?= $followersIG;?> Followers</p>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
            <?php foreach ($photos as $photo): ?>
              <div class="ig-thumbnail">
                <img src="<?= $photo;?>">
              </div>
                <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Portfolio -->
  <section class="portfolio " id="portfolio">
    <div class="container">
      <div class="row pt-4 mb-4">
        <div class="col text-center">
          <h2>Portfolio</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/1.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                card's content.</p>
            </div>
          </div>
        </div>

        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/2.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                card's content.</p>
            </div>
          </div>
        </div>

        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/3.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                card's content.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/4.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                card's content.</p>
            </div>
          </div>
        </div>
        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/5.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                card's content.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/6.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                card's content.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Contact -->
  <section class="contact bg-light " id="contact">
    <div class="container">
      <div class="row pt-4 mb-4">
        <div class="col text-center">
          <h2>Contact</h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-4">
          <div class="card bg-primary text-white mb-4 text-center">
            <div class="card-body">
              <h5 class="card-title">Contact Me</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                card's content.</p>
            </div>
          </div>

          <ul class="list-group mb-4">
            <li class="list-group-item">
              <h3>Location</h3>
            </li>
            <li class="list-group-item">My Office</li>
            <li class="list-group-item">Jl.Sunten 08,Banguntapan,Bantul</li>
            <li class="list-group-item">Yogyakarta, Indonesia</li>
          </ul>
        </div>

        <div class="col-lg-6">
          <form method="POST" action="https://formspree.io/rifki7080@gmail.com">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" placeholder="Your email address" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea name="message" placeholder="Your Message" class="form-control" id="message" rows="3"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Send Message</button>
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Terima Kasih
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <!-- footer -->
  <footer class="bg-dark text-white mt-5">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <p>Copyright &copy; 2019.</p>
        </div>
      </div>
    </div>
  </footer>







  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
    crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js"></script>
  
  <script>
  $(document).ready(function () {
    // Activate Carousel
    $("#myCarousel").carousel();

    // Enable Carousel Indicators
    $(".item1").click(function () {
      $("#myCarousel").carousel(0);
    });
    $(".item2").click(function () {
      $("#myCarousel").carousel(1);
    });
    $(".item3").click(function () {
      $("#myCarousel").carousel(2);
    });

    // Enable Carousel Controls
    $(".carousel-control-prev").click(function () {
      $("#myCarousel").carousel("prev");
    });
    $(".carousel-control-next").click(function () {
      $("#myCarousel").carousel("next");
    });
  });
</script>



</body>

</html>