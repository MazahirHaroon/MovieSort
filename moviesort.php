<!DOCTYPE html>
<html>
<head>
  <title>MovieSort</title>
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="line.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Bungee+Inline" rel="stylesheet">

  <style>
  a{
    color:black;
  }
  a:hover {
    color:blue;
  }
  </style>
</head>

 <?php
 $errno = NULL;
 $errstr = NULL;
if ( @fopen("https://www.google.com", "r") )
{
  //error handler function
  function customError($errno, $errstr) {
    $log = fopen("errorlog.txt", "w") or die("Unable to open file!");
    $error = "<b>Error:</b> [$errno] $errstr";
    fwrite($log, $error);
    fclose($log);
  }

  //set error handler
  set_error_handler("customError");

?>

<body background="cinemag.jpg">
<?php
// define variables and set to empty values
$path = $list1 = "";
$req1 = array();
$movienrating1 = array();
//Err
$pathErr = $list1Err = "";

//name

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<div class="container-fluid">
<div class="row">
  <div class="col-sm-12">
<center><h1 style='color:white;font-size:90px;font-family:Bungee Inline, cursive;'>MovieSort</h1></center>
</div>
</div>
<div class="container">
<?php ob_start(); ?>
<br><br>


        <div id="accordion" role="tablist" aria-multiselectable="true">
          <div class="row">
          <div class="col-sm-6">
          <div class="card">
            <div class="card-header" role="tab" id="headingFour">
              <h5 class="mb-0">
                <center>
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <center><h1 style='color:grey;font-size:40px;font-family:Ranga, cursive;'><button>Using Path</button></h1></center>
                </a>
              </h5>
            </div>

            <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
              <div class="card-block">
                <div class="form-group">
                  <center>
                      <form method = "post"  action = " <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> ">
                      <label for="usr" style="color:white;grey;font-size:25px;">Enter the Path: </label>
                      <input type="text" name="path" class="validate" value = "<?php echo htmlspecialchars($path);?>"  />
                      <span class="error" style="color:white;grey;font-size:25px;"><?php echo $pathErr;?></span>
                      <input type="hidden" name="sort" value="sort" />
                      <br>
                      <input type="submit"  value="Get-information" class="button" id="submit">

                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                       Help</button>
                       <div class="collapse" id="collapseExample1">
                        <div class="card card-block">
                          <p style="color:black;font-size:15px;background-color:white">
                          Copy & Paste the path to the folder where you have saved all your movies,
                          'For eg: /home/movies'. And we will dispaly the details of all the movies
                           present in it in tabular format.
                         </p>
                        </div>
                        </div>
                      </center>
                      </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="card">
            <div class="card-header" role="tab" id="headingFive">
              <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                  <center><h1 style='color:grey;font-size:40px;font-family:Ranga, cursive;'><button>Using Name</button></h1></center>
                </a>
              </h5>
            </div>

            <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive">
              <div class="card-block">
                <div class="form-group">
                  <center>
                      <form method = "post"  action = " <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> ">
                        <div class="inline">
                      <label for="usr" style="color:white;grey;font-size:25px;">Enter the movie names: </label>
                      <input type="text" name="list1" class="validate" value = "<?php echo htmlspecialchars($list1);?>"  />
                      <span class="error"><?php echo $list1Err;?></span>
                    </div>
                      <input type="hidden" name="sortlist" value="sortlist" />
                      <div class="inline">
                      <input type="submit"  value="Get-information" class="button" id="submit">
                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                       Help</button>
                       <br><label for="usr" style="color:white;grey;font-size:25px;">(separated by ++):</label>
                       <div class="inline">
                       <div class="collapse" id="collapseExample2">
                        <div class="card card-block">
                          <p style="color:black;font-size:15px;background-color:white">
                          Enter the names of movies of which you need
                           the details, separated by ++
                          For eg: 'FightClub++Manichitrathazhu++Roja'
                          <p>
                        </div>
                        </div>
                      </div>
                      </center>
                      </form>
                </div>
              </div>
            </div>

          </div>
        </div>



        </div>

        </div>









      </div>




</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['sort'])) {
        if (empty($_POST["path"])){
          ?>
          <div class="jumbotron">
            <?php
          $pathErr = "No Path Entered ";
          echo "<center><h2>".$pathErr."</h2></center>";
          sleep(2);
          ?>
          <script>
          window.location = "moviesort.php";
          </script>
          <?php
      }
      else {
        ob_end_clean();
      $path = $_POST["path"];

        $sdir = $path;
        unset($_POST['sort']);
        unset($_POST['path']);
        ?>
        <center>
          <h1> The List </h1>
          </center>
        <div class="jumbotron">
          <table id="test" border="1" style="margin-left:12px;margin-right:12px;">
           <tr>
             <th>Rating</th>
             <th>Name</th>
             <th>Genre</th>
             <th>Director</th>
             <th>Writer</th>
             <th>Cast</th>
             <th>Description</th>
             <th>Release Date</th>
           </tr>
        <?php

        // Open the directory, and read its contents

        //$unwant = array(".srt",".txt");

        function listFolderFiles($dir){
          if (is_dir($dir)) {
            $files = scandir($dir);
            foreach($files as $file){
                if($file != '.' && $file != '..'){
                    if(is_dir($dir.'/'.$file)){
                    if(is_dir($dir.'/'.$file)) listFolderFiles($dir.'/'.$file);
                  }
                    else {
                      $ext = array(".avi",".mp4","m4v","mkv");
                      //echo $file;
                      $filename = $file;
                      foreach ($ext as &$value1){
                        if (strpos($file, $value1) == true) {

                          $replace = array("DvD","TamilRockers","AVC","PROPER.DVDRip.XViD.CD1-DVL","PROPER.DVDRip","E SuB xRG","m4v","mp4","CD2","CD1","DVL","torentz","Stealthmaster","SCRGooN"," Mafiaking","M2Tv","cc ","SCRT0XiCiNK","3xforum",".avi","1.4","5.1","-","DVDRip","BRRip","XviD","1CDRip","aXXo","[","]","(",")","{","}","{{","}}",
                          "x264","720p","DvDScr","MP3","HDRip","WebRip","ETRG","YIFY","StyLishSaLH","StyLish Release","TrippleAudio",
                                  "EngHindiIndonesian","385MB","CooL GuY","a2zRG","x264","Hindi","AAC","AC3","MP3"," R6","HDRip","H264","ESub","AQOS",
                                  "ALLiANCE","UNRATED","ExtraTorrentRG","BrRip","mkv","mpg","DiAMOND","UsaBitcom","AMIABLE","BRRIP","XVID","AbSurdiTy",
                                  "DVDRiP","TASTE","BluRay","HR","COCAIN","_",".","BestDivX","MAXSPEED","Eng","500MB","FXG","Ac3","Feel","Subs","S4A","BDRip","FTW","Xvid","Noir","1337x","ReVoTT",
                                  "GlowGaze","mp4","Unrated","hdrip","ARCHiViST","TheWretched","www","torrentfive","com","1080p","1080","SecretMyth","Kingdom","Release","RISES","DvDrip","ViP3R","RISES","BiDA","READNFO",
                                  "HELLRAZ0R","tots","BeStDivX","UsaBit","FASM","NeroZ","576p","LiMiTED","Series","ExtraTorrent","DVDRIP","~",
                                  "BRRiP","699MB","700MB","greenbud","B89","480p","AMX","007","DVDrip","h264","phrax","ENG","TODE","LiNE",
                                  "XVid","sC0rp","PTpower","OSCARS","DXVA","MXMG","3LT0N","TiTAN","4PlayHD","HQ","HDRiP","MoH","MP4","BadMeetsEvil",
                                  "XViD","3Li","PTpOWeR","3D","HSBS","CC","RiPS","WEBRip","R5","PSiG","'GokU61","GB","GokU61","NL","EE","Rel","NL",
                                  "PSEUDO","DVD","Rip","NeRoZ","EXTENDED","DVDScr","xvid","WarrLord","SCREAM","MERRY","XMAS","iMB","7o9",
                                  "Exclusive","171","DiDee","v2","Scr","SaM","MOV","BRrip","CharmeLeon","Silver RG","1xCD","DDR","1CD","X264","ExtraTorrenRG",
                              "Srkfan","UNiQUE","Dvd","crazy torrent","Spidy","PRiSTiNE","HD","Ganool","TS","BiTo","ARiGOLD","rip","Rets","teh","ChivveZ","song4",
                              "playXD","LIMITED","600MB","700MB","900MB");

                    /* check for differences with above later
                    $replace = array("TamilRockers","AVC","PROPER.DVDRip.XViD.CD1-DVL","PROPER.DVDRip","E SuB xRG","m4v","mp4","CD2","CD1","DVL","torentz","3xforum",".avi","1.4","5.1","-","DVDRip","BRRip","XviD","1CDRip","aXXo","[","]","(",")","{","}","{{","}}",
                      "x264","720p","DvDScr","MP3","HDRip","WebRip","ETRG","YIFY","StyLishSaLH","StyLish Release","TrippleAudio",
                              "EngHindiIndonesian","385MB","CooL GuY","a2zRG","x264","Hindi","AAC","AC3","MP3"," R6","HDRip","H264","ESub","AQOS",
                              "ALLiANCE","UNRATED","ExtraTorrentRG","BrRip","mkv","mpg","DiAMOND","UsaBitcom","AMIABLE","BRRIP","XVID","AbSurdiTy",
                              "DVDRiP","TASTE","BluRay","HR","COCAIN","_",".","BestDivX","MAXSPEED","Eng","500MB","FXG","Ac3","Feel","Subs","S4A","BDRip","FTW","Xvid","Noir","1337x","ReVoTT",
                              "GlowGaze","mp4","Unrated","hdrip","ARCHiViST","TheWretched","www","torrentfive","com","1080p","1080","SecretMyth","Kingdom","Release","RISES","DvDrip","ViP3R","RISES","BiDA","READNFO",
                              "HELLRAZ0R","tots","BeStDivX","UsaBit","FASM","NeroZ","576p","LiMiTED","Series","ExtraTorrent","DVDRIP","~",
                              "BRRiP","699MB","700MB","greenbud","B89","480p","AMX","007","DVDrip","h264","phrax","ENG","TODE","LiNE",
                              "XVid","sC0rp","PTpower","OSCARS","DXVA","MXMG","3LT0N","TiTAN","4PlayHD","HQ","HDRiP","MoH","MP4","BadMeetsEvil",
                              "XViD","3Li","PTpOWeR","3D","HSBS","CC","RiPS","WEBRip","R5","PSiG","'GokU61","GB","GokU61","NL","EE","Rel","NL",
                              "PSEUDO","DVD","Rip","NeRoZ","EXTENDED","DVDScr","xvid","WarrLord","SCREAM","MERRY","XMAS","iMB","7o9",
                              "Exclusive","171","DiDee","v2","Scr","SaM","MOV","BRrip","CharmeLeon","Silver RG","1xCD","DDR","1CD","X264","ExtraTorrenRG",
                          "Srkfan","UNiQUE","Dvd","DvD","crazy torrent","Spidy","PRiSTiNE","HD","Ganool","TS","BiTo","ARiGOLD","rip","Rets","teh","ChivveZ","song4",
                          "playXD","LIMITED","600MB","700MB","900MB");
                          */
                      foreach ($replace as &$value1){
                      if (strpos($file, $value1) == true) {
                      foreach ($replace as &$value) {
                          $file = str_replace($value, '', $file);
                      }
                      $file = str_replace(' ', '+', $file);
        //             echo $file."<br>";
                // Include the library
                include_once('simple_html_dom.php');
        // assigning the link to $html variable
        //echo "File name ".$file;
        $url='http://www.google.co.in/search?q='.$file.'+imdb';
        //echo "URL ".$url;
        $html = file_get_html($url);
        $flag=0;
        $h="";
        //scraping the link from first result of search
        foreach($html->find('h3[class=r]') as $a){
        foreach($a->find('a') as $e){
        if (strpos($e->href, 'www.imdb.com/title/tt') == true){
        $flag=1;
        $h=$e->href;
        break;
        }
        }
        if($flag==1)
        break;
        }

        if ($h!=NULL) {

        //cleaning the url
        $string=explode("=", $e->href);
        $string=$string[1]; // piece1
        $string=explode("/&", $string);
        $string=$string[0]; // piece1

        // assigning the url to $html variable
        $html = file_get_html($string);
        ?>
        <tr>

        <?php
        //if there is folder then add a details.txt there
        //$myfile = fopen('C:/Users/user/Videos/Movies/Yet/' .$file1. '/Details.txt', "ab") or die("Unable to open file!");

        //else add in the main folder along with video file with same name
        //$myfile = fopen('C:\Users\Mazu\Videos\Movies\Movie '.$filename.'.txt', "a") or die("Unable to open file!");

        //fwrite($myfile, "\r\n");

        //scraping the rating from imdb website
        //fwrite($myfile,'Rating : ');
        foreach($html->find('span.itemprop[itemprop=ratingValue]') as $e){
        $rating = $e->innertext;
        }
        foreach($html->find('span.itemprop[itemprop=ratingCount]') as $e){
        $rating1 = $e->innertext;
        }
        //fwrite($myfile, $rating);
        $rating77=$rating;

        ?>

        <td><?php echo $rating."/10 out of ".$rating1." votes" ?></td>

        <?php

        //scraping the name from imdb website
        //fwrite($myfile,'Name : ');
        foreach($html->find('h1[itemprop=name]') as $e)
        $name=$e->innertext;
        $name=explode("&nbsp", $name);
        $name=$name[0]; // piece1
        //fwrite($myfile, $name);
        //fwrite($myfile, "\r\n");
        $name77=$name;
        ?>
        <!--12
        $buffer=substr($buffer,1,12);-->
        <td><?php echo $name ?></td>

        <?php

        $genre="";
        $c=0;
        //scraping the genre from imdb website
        //fwrite($myfile,'Genre : ');
        foreach($html->find('span.itemprop[itemprop=genre]') as $e){
        $genre1 = $e->outertext;
        $genre.=$genre1.",";
        if($c!=0)
        //fwrite($myfile, ",");
        //fwrite($myfile, $genre1);
        $c=$c+1;
        }
        $genre77=$genre;
        ?>

        <td><?php echo $genre ?></td>

        <?php
        //fwrite($myfile, "\r\n");




        //scraping the Director from imdb website
        $Director="";
        $w=0;
        //fwrite($myfile,'Director: ');
        foreach($html->find('span.itemprop[itemprop=director]') as $e){
          $Director1 = $e->innertext;
          if($w!=0){
          $Director.=",".$Director1;
          //fwrite($myfile, ",");
          //fwrite($myfile, $Director);
          $w=$w+1;
          }
          else{
          $Director.=$Director1;
          }
          $w=$w+1;
        }
        $Director=strip_tags($Director, '<br>');
        $Director77=$Director;
        ?>

        <td><?php echo $Director ?></td>

        <?php
        //fwrite($myfile, "\r\n");


        //scraping the Writer from imdb website
        $writer="";
        $w=0;
        //fwrite($myfile,'Writer: ');
        foreach($html->find('span.itemprop[itemprop=creator]') as $e){
          $writer1 = $e->innertext;
          if($w!=0){
          $writer.=",".$writer1;
          //fwrite($myfile, ",");
          //fwrite($myfile, $writer);
          $w=$w+1;
          }
          else{
          $writer.=$writer1;
          }
          $w=$w+1;
        }
        $writer=strip_tags($writer, '<br>');
        $writer77=$writer;
        ?>

        <td><?php echo $writer ?></td>


        <?php


        //fwrite($myfile, "\r\n");

        //scraping the artists from imdb website
        $cast="";
        $d=0;
        //fwrite($myfile,'Cast : ');
        foreach($html->find('td[itemprop=actor]') as $e){
        //<td class="itemprop" itemprop="actor" i
        //foreach($html->find('td.itemprop[itemprop=name]') as $e)
        $cast1 = $e->innertext;
        if($d!=0){
        $cast.=",".$cast1;
        //fwrite($myfile, ",");
        //fwrite($myfile, $cast);

        }
        else{
        $cast.=$cast1;
        }
        $d=$d+1;
        if($d==5)
        break;
        }
        $cast=strip_tags($cast, '<br>');
        $cast77=$cast;
        ?>

        <td><?php echo $cast ?></td>

        <?php
        //fwrite($myfile, "\r\n");


        //parsing the synopsis
        foreach($html->find('div#summary_text[itemprop=description]') as $e){
        $desc1=$e->plaintext;
        //$desc=explode(".", $desc);
        //$desc1=$desc[0]; // piece1
        //fwrite($myfile, $desc1);
        //fwrite($myfile, ".");
        $desc77=$desc1;
          ?>

          <td><?php echo $desc1?></td>
          <?php
          break;
          }

          //parsing the release date
          $date = $html->find("meta[itemprop='datePublished']", 0)->content;
          $date=date("jS M, Y", strtotime($date));
          $date77=$date;
          ?>
          <td><?php echo $date ?></td>

        <?php


        //fwrite($myfile, "\r\n");
        //fwrite($myfile, "\r\n");

        ?>
         </tr>


        <?php
        $html->clear();
        unset($html);
        //fclose($myfile);
        }
        }
        }
        }
        }
        }
        }
        }
        }
        else{
          ob_end_clean();
          echo "<center><h2>Directory path '". $dir. "' has some issues</h2></center>";
        }
        }



        listFolderFiles($sdir);
        ?></table>
      <br>
        <center>
        <table>
        <tr><td><a href="moviesort.php"><button>Back</button></a></td></tr>
        </table>
      </center>
</div>
        </body>
        </html>
      <?php
 }
 }
 if(isset($_POST['sortlist'])) {
          ?>
          <div class="jumbotron">
            <?php
         if (empty($_POST["list1"])) {
           $list1Err = "Please enter some movie names";
           echo "<center><h2>".$list1Err."</h2></center>";
          ?> </div> <?php
           sleep(2);
           ?>
           <script>
           window.location = "moviesort.php";
           </script>
           <?php
         }
         else {
           ob_end_clean();
       $list1 = test_input($_POST["list1"]);


         unset($_POST['sortlist']);
         unset($_POST['list1']);

 //place this before any script you want to calculate time
 $time_start = microtime(true);

 // your script code goes here
 ?>
 <div class="jumbotron">
 <center>
 <h1> The List </h1>
 </center>
<table id="test" border="1" style="margin-left:12px;margin-right:12px;">

<tr>
  <th>Rating</th>
  <th>Name</th>
  <th>Genre</th>
  <th>Director</th>
  <th>Writer</th>
  <th>Cast</th>
  <th>Description</th>
  <th>Release Date</th>
</tr>


 <?php
 $list1=str_replace(" ","",$list1);
 $list = explode("++", $list1);
 $len = count($list);
 for($i=0; $i<$len; $i++){
   $file = $list[$i];
 // Include the library
 include_once('simple_html_dom.php');
 // assigning the link to $html variable
 //echo "File name ".$file;
 $url='http://www.google.co.in/search?q='.$file.'+imdb';
 //echo "URL ".$url;
 $html = file_get_html($url);
 $flag=0;
 $h="";
 //scraping the link from first result of search
 foreach($html->find('h3[class=r]') as $a){
 foreach($a->find('a') as $e){
 if (strpos($e->href, 'www.imdb.com/title/tt') == true){
 $flag=1;
 $h=$e->href;
 break;
 }
 }
 if($flag==1)
 break;
 }

 if ($h!=NULL) {

 //cleaning the url
 $string=explode("=", $e->href);
 $string=$string[1]; // piece1
 $string=explode("/&", $string);
 $string=$string[0]; // piece1

 // assigning the url to $html variable
 $html = file_get_html($string);
 ?>
 <tr>

   <?php
   //fwrite($myfile, "\r\n");

   //scraping the rating from imdb website
   //fwrite($myfile,'Rating : ');
   foreach($html->find('span.itemprop[itemprop=ratingValue]') as $e){
   $rating = $e->innertext;
   }
   foreach($html->find('span.itemprop[itemprop=ratingCount]') as $e){
   $rating1 = $e->innertext;
   }
   //fwrite($myfile, $rating);
   $rating77=$rating;
   ?>

   <td><?php echo $rating."/10 out of ".$rating1." votes" ?></td>



 <?php
 //scraping the name from imdb website
 //fwrite($myfile,'Name : ');
 foreach($html->find('h1[itemprop=name]') as $e)
 $name=$e->innertext;
 $name=explode("&nbsp", $name);
 $name=$name[0]; // piece1
 //fwrite($myfile, $name);
 //fwrite($myfile, "\r\n");
 $name77=$name;
 //$current = array($rating => $name);
 //$movienrating1 = array_merge($movienrating, $current);
 ?>
 <!--12
 $buffer=substr($buffer,1,12);-->
 <td><?php echo $name ?></td>

 <?php

 $genre="";
 $c=0;
 //scraping the genre from imdb website
 //fwrite($myfile,'Genre : ');
 foreach($html->find('span.itemprop[itemprop=genre]') as $e){
 $genre1 = $e->outertext;
 $genre.=$genre1.",";
 if($c!=0)
 //fwrite($myfile, ",");
 //fwrite($myfile, $genre1);
 $c=$c+1;
 }
 $genre77=$genre;
 ?>

 <td><?php echo $genre ?></td>

 <?php
 //fwrite($myfile, "\r\n");




 //scraping the Director from imdb website
 $Director="";
 $w=0;
 //fwrite($myfile,'Director: ');
 foreach($html->find('span.itemprop[itemprop=director]') as $e){
   $Director1 = $e->innertext;
   if($w!=0){
   $Director.=",".$Director1;
   //fwrite($myfile, ",");
   //fwrite($myfile, $Director);
   $w=$w+1;
   }
   else{
   $Director.=$Director1;
   }
   $w=$w+1;
 }
 $Director=strip_tags($Director, '<br>');
 $Director77=$Director;
 ?>

 <td><?php echo $Director ?></td>

 <?php
 //fwrite($myfile, "\r\n");


 //scraping the Writer from imdb website
 $writer="";
 $w=0;
 //fwrite($myfile,'Writer: ');
 foreach($html->find('span.itemprop[itemprop=creator]') as $e){
   $writer1 = $e->innertext;
   if($w!=0){
   $writer.=",".$writer1;
   //fwrite($myfile, ",");
   //fwrite($myfile, $writer);
   $w=$w+1;
   }
   else{
   $writer.=$writer1;
   }
   $w=$w+1;
 }
 $writer=strip_tags($writer, '<br>');
 $writer77=$writer;
 ?>

 <td><?php echo $writer ?></td>


 <?php


 //fwrite($myfile, "\r\n");

 //scraping the artists from imdb website
 $cast="";
 $d=0;
 //fwrite($myfile,'Cast : ');
 foreach($html->find('td[itemprop=actor]') as $e){
 //<td class="itemprop" itemprop="actor" i
 //foreach($html->find('td.itemprop[itemprop=name]') as $e)
 $cast1 = $e->innertext;
 if($d!=0){
 $cast.=",".$cast1;
 //fwrite($myfile, ",");
 //fwrite($myfile, $cast);

 }
 else{
 $cast.=$cast1;
 }
 $d=$d+1;
 if($d==5)
 break;
 }
 $cast=strip_tags($cast, '<br>');
 $cast77=$cast;
 ?>

 <td><?php echo $cast ?></td>

 <?php
 //fwrite($myfile, "\r\n");


 //parsing the synopsis
 foreach($html->find('div#summary_text[itemprop=description]') as $e){
 $desc1=$e->plaintext;
 //$desc=explode(".", $desc);
 //$desc1=$desc[0]; // piece1
 //fwrite($myfile, $desc1);
 //fwrite($myfile, ".");
 $desc77=$desc1;
   ?>

   <td><?php echo $desc1?></td>
   <?php
   break;
   }

   //parsing the release date
   $date = $html->find("meta[itemprop='datePublished']", 0)->content;
   $date=date("jS M, Y", strtotime($date));
   $date77=$date;
   ?>
   <td><?php echo $date ?></td>

 <?php


 //fwrite($myfile, "\r\n");
 //fwrite($myfile, "\r\n");

 ?>
  </tr>


 <?php
 $html->clear();
 unset($html);
 //fclose($myfile);
 }
 }
 ?></table>
 <!--
 <center>
   Sorted Based on Rating
 </center>
 <center>
 <table>
 <tr>
   <th> Rating </th>
   <th> Name </th>
 </tr>
 <tr>
   <?php
 //krsort($movienrating1);
 //foreach ($movienrating1 as $key => $value) {
//     echo "<td>".$key."</td>";
//     echo "<td>".$value."</td></tr>";
 //}
 ?>
</table>
</center>-->
<br>
<br>
 <center>
 <table>
 <tr><td><a href="moviesort.php"><button>Back</button></a></td></tr>
 </table>
</center>
</div>
 </body>
 </html>
<?php
}

 }
?>
</div>
</body>

<?php
}
}
else
{
?>
<br><br>
<div class="row">
<div class="col-sm-4">
</div>
  <div class="col-sm-4">
  <center>
  <h1 style="color:white">We are Sorry!</h1>
  </center>
  </div>

<div class="col-sm-4">
</div>
</div>

<div class="row">
<div class="col-sm-4">
</div>
  <div class="col-sm-4">
  <center>
  <h1 style="color:white">But you must have an active internet connection to enjoy this functionality.</h1>
  <a href="moviesort.php"><button>Reload</button></a>
  </center>
  </div>

<div class="col-sm-4">
</div>
</div>
<?php
}

?>
