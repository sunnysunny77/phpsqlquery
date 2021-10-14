<?php

$root = $_SERVER['DOCUMENT_ROOT'] . "/daniel";

include_once $root . "/includes/db.inc.php";

if (isset($_POST['action']) && $_POST['action'] == 'Remove Author') {

  if ($_POST['id'] == '') {
    $output  = 'You must choose an author. Click &lsquo;back&rsquo; and try again.';
    include_once $root . '/components/error.html.php';
    exit();
  }

  try {
    $sql = 'DELETE FROM authorrole WHERE authorid = :id';
    $result = $pdo->prepare($sql);
    $result->bindValue(':id', $_POST['id']);
    $result->execute();
  } catch (PDOException $e) {
    $output = 'Error deleting author role: ' . $e->getMessage();
    include_once $root . '/components/error.html.php';
    exit();
  }

  try {
    $sql = 'SELECT id FROM joke WHERE authorid = :id';
    $result = $pdo->prepare($sql);
    $result->bindValue(':id', $_POST['id']);
    $result->execute();
  } catch (PDOException $e) {
    $output = 'Error fetching list of jokes to delete: ' . $e->getMessage();
    include_once $root . '/components/error.html.php';
    exit();
  }

  $results = $result ->fetchAll();

  try {
    $sql = 'DELETE FROM jokecategory WHERE jokeid = :id';
    $result = $pdo->prepare($sql);
    foreach ($results as $row) {
      $jokeId = $row['id'];
      $result->bindValue(':id', $jokeId);
      $result->execute();
    }
  } catch (PDOException $e) {
    $output = 'Error deleting category entries for joke: ' . $e->getMessage();
    include_once $root . '/components/error.html.php';
    exit();
  }

  try {
    $sql = 'DELETE FROM joke WHERE authorid = :id';
    $result = $pdo->prepare($sql);
    $result->bindValue(':id', $_POST['id']);
    $result->execute();
  } catch (PDOException $e) {
    $output = 'Error deleting jokes for author: ' . $e->getMessage();
    include_once $root . '/components/error.html.php';
    exit();
  }

  try {
    $sql = 'DELETE FROM author WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  } catch (PDOException $e) {
    $output = 'Error deleting author: ' . $e->getMessage();
    include_once $root . '/components/error.html.php';
    exit();
  }
 

  header('Location: ./');
  
  exit();

}

try {
  $sql = 'SELECT name, id
  FROM author';
  $result = $pdo->query($sql);
} catch (PDOException $e) {
  $output = 'Error fetching authors: ' . $e->getMessage();
  include_once $root . '/components/error.html.php';
  exit();
}

if ($result->rowCount() == 0) {
  $output = "Error no authors found.";
  include_once $root . '/components/error.html.php';
  exit();
}

while ($row = $result->fetch()) {
  $authors[] = array(
    'id' => $row['id'],
    'name' => $row['name']
  );
}

include_once $root . "/components/remove-author.html.php";

exit();

?>
