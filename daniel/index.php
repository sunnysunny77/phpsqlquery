<?php 

$root = $_SERVER['DOCUMENT_ROOT'] . "/daniel";

include_once $root . "/includes/db.inc.php";

try {
  $sql = 'SELECT joketext, jokedate, name, email
  FROM joke INNER JOIN author
    ON authorid = author.id';
  $result = $pdo->query($sql);
  
}
catch (PDOException $e) {
  $output = 'Error fetching jokes: ' . $e->getMessage();
  include_once $root . '/components/error.html.php';
  exit();
}

if ($result->rowCount() == 0) {
  $output = "Error no jokes found.";
  include_once $root . '/components/error.html.php';
  exit();
}

while ($row = $result->fetch()) {
  $jokes[] = array(
    'text' => $row['joketext'],
    'name' => $row['name'],
    'email' => $row['email'],
    'date' => $row['jokedate']
  );
}

include_once $root . "/components/index.html.php";

exit();

?>
