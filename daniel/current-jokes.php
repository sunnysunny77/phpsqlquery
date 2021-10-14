<?php 

$root = $_SERVER['DOCUMENT_ROOT'] . "/daniel";

require $root . "/requires/db.inc.php";

try {
  $sql = 'SELECT joketext, jokedate, name, email
  FROM joke INNER JOIN author
    ON authorid = author.id
    WHERE DATE_FORMAT(jokedate, "%Y %m") = DATE_FORMAT(CURDATE(), "%Y %m")';
  $result = $pdo->query($sql);
  
}
catch (PDOException $e) {
  $output = 'Error fetching current jokes: ' . $e->getMessage();
  require $root . '/components/error.html.php';
  exit();
}

$date = date('Y-m');
 
if ($result->rowCount() == 0) {
  $output = "Error no current jokes found for $date.";
  require $root . '/components/error.html.php';
  exit();
}

$querry = "Here are all the current jokes from date: $date, in the database:";

while ($row = $result->fetch()) {
  $jokes[] = array(
    'text' => $row['joketext'],
    'name' => $row['name'],
    'email' => $row['email'],
    'date' => $row['jokedate']
  );
}

require $root . "/components/current-jokes.html.php";

exit();

?>
