<?php 

$root = $_SERVER['DOCUMENT_ROOT'] . "/daniel";

require $root . "/requires/db.inc.php";

if (isset($_POST['action']) && $_POST['action'] == 'Search Jokes') {

  try {
    $sql = 'SELECT joketext, jokedate, name, email
    FROM joke INNER JOIN author
      ON authorid = author.id WHERE joketext LIKE :querry';
    $result = $pdo->prepare($sql);
    $result->bindValue(':querry', "%{$_POST['querry']}%");
    $result->execute();
  } catch (PDOException $e) {
    $output = 'Error fetching jokes: ' . $e->getMessage();
    require $root . '/components/error.html.php';
    exit();
  }

  if ($result->rowCount() == 0) {
    $output = "Error no jokes found.";
    require $root . '/components/error.html.php';
    exit();
  }
  
  $querry = "Here are all the jokes from the database for the querry \"{$_POST['querry']}\":";

  while ($row = $result->fetch()) {
    $jokes[] = array(
      'name' => $row['name'],
      'email' => $row['email'],
      'text' => $row['joketext'],
      'date' => $row['jokedate']
    );
  }

}

require $root . "/components/search-jokes.html.php";

exit();

?>
