<?php 

$root = $_SERVER['DOCUMENT_ROOT'] . "/daniel";

include_once $root . "/includes/db.inc.php";

if (isset($_POST['action']) && $_POST['action'] == 'Update Date') {
  
  try {
    $sql = 'UPDATE joke SET jokedate = :date WHERE id = :id';
    $result = $pdo->prepare($sql);
    $result->bindValue(':date', $_POST['date']);
    $result->bindValue(':id', $_POST['id']);
    $result->execute();
  }

  catch (PDOException $e) {
    $output = 'Error updating joke date.' . $e->getMessage();
    include_once $root . '/components/error.html.php';
    exit();
  }

  header('Location: ./');
  
  exit();

}

try {
  $sql = 'SELECT joke.id, joketext, jokedate, name, email
  FROM joke INNER JOIN author
    ON authorid = author.id';
  $result = $pdo->query($sql);
  
}
catch (PDOException $e) {
  $output = 'Error fetching list of dates:' . $e->getMessage();
  include_once $root . '/components/error.html.php';
  exit();
}

if ($result->rowCount() == 0) {
  $output = "Error no dates found.";
  include_once $root . '/components/error.html.php';
  exit();
}


while ($row = $result->fetch()) {
  $jokes[] = array(
    'id' => $row['id'],
    'text' => $row['joketext'],
    'name' => $row['name'],
    'email' => $row['email'],
    'date' => $row['jokedate']
  );
}

include_once $root . "/components/update-date.html.php";

exit();

?>
