<?php


//Functions
function getResult($result){
  if($result == "Approved"){
    return "green";
  }else if($result == "Rejected"){
    return "red";
  }else{
    return "grey";
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="Model United Nations Training Resources and Conference Support.">
  <meta name="author" content="MUNiverse">
  <link rel="icon" type="image/png" href="img/MUNiverseIconSquare.png">
  <title>Haileybury Approvals</title>

  <!-- Custom styles for this template -->
  <link href="web.css" rel="stylesheet">

</head>

<body>
  <h1>Haileybury MUN 2017 APPROVALS</h1>
  <table>
  <?php

  $committees = array('50','51','52','53','54','55','56','57','58','59');
  $committeeNames = array('Disarmament','Ecology & Environment 1','Ecology & Environment 2','Economic & Social 1','Economic & Social 2', 'Human Rights 1', 'Human Rights 2', 'Political 1', 'Political 2', 'Security Council');
  $committeeCount = 0;

  foreach($committees as $committee){

    $xml= simplexml_load_file("https://api.muniverse.co.uk/1.0/xml/hmun17/".$committee) or die("Error: Cannot create object");
    echo '<tr><td class="committee" colspan="2"><h2>'.$committeeNames[$committeeCount].'</h2></td></tr>';
    foreach($xml->children()->children() as $results) {
      if($results->title != ""){
        echo '<tr class="delegation"><td class="title">'.$results->title .'</td><td class="result '.getResult($results->category).'">';
        echo $results->category . "</td></tr>";
      }

    }
    $committeeCount++;
  }


  ?>
  </table>
  <hr>
  <p>Created by Oliver Hirschfield for Haileybury MUN 2017</p>
</body>
</html>
