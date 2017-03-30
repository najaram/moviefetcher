<?php require __DIR__ . '/vendor/autoload.php';

$guzzle = new \GuzzleHttp\Client;
$crawler = new \Symfony\Component\DomCrawler\Crawler;
$parser = new \Najaram\MovieFetcher\Parser\ImdbParser;

$fetcher = new \Najaram\MovieFetcher\MovieFetcher($guzzle, $crawler, $parser);

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>IMDB Movie</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
</head>
<body>
        <h1>Movie Url</h1>

        <form action="#" method="post" id="url-form">
          <div class="form-group">
            <input type="text" name="url" class="form-control" placeholder="http://" required />
            <input type="submit" value="Fetch Movie Details!" class="btn btn-primary" name="submit"/>
          </div>
        </form>

        <?php if (isset($_POST['url']) && !empty($_POST['url'])): ?>
       <?php
       $movie = $fetcher->fetch($_POST['url']);
       ?>
       <hr />
       <table class="table">
           <tr>
               <td>Title</td>
               <td><?= $movie->getTitle(); ?></td>
           </tr>
           <tr>
               <td>Year of Release</td>
               <td><?= $movie->getYearOfRelease(); ?></td>
           </tr>
           <tr>
               <td>Rating</td>
               <td><?= $movie->getRating(); ?>%</td>
           </tr>
           <tr>
               <td>Genres</td>
               <td><?= implode(', ', $movie->getGenres()); ?></td>
           </tr>
           <tr>
               <td>Summary</td>
               <td><?= $movie->getSummary(); ?></td>
           </tr>
       </table>
       <?php endif; ?> 


        <script src="js/jquery.js"></script>
        <script>

        </script>
</body>
</html>
