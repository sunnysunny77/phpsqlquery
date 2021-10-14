<?php

$root = $_SERVER['DOCUMENT_ROOT'] . "/daniel";

include_once $root . "/includes/db.inc.php";

if (isset($_POST['action']) && $_POST['action'] == 'Show Category') {

  if ($_POST['id'] == '') {
    $output  = 'You must choose an category. Click &lsquo;back&rsquo; and try again.';
    include_once $root . '/components/error.html.php';
    exit();
  }

  try {
    $sql = 'SELECT author.name AS aname, author.email AS email, category.name AS cname, joketext, jokedate FROM author, category, jokecategory INNER JOIN joke ON joke.id = jokecategory.jokeid WHERE jokecategory.categoryid = :id AND category.id = :id AND author.id = joke.authorid';
    $result = $pdo->prepare($sql);
    $result->bindValue(':id', $_POST['id']);
    $result->execute();
  } catch (PDOException $e) {
    $output = 'Error fetching categories: ' . $e->getMessage();
    include_once $root . '/components/error.html.php';
    exit();
  }

  if ($result->rowCount() == 0) {
    $output = "Error no categories found.";
    include_once $root . '/components/error.html.php';
    exit();
  }

  while ($row = $result->fetch()) {
    $jokes[] = array(
      'name' => $row['aname'],
      'email' => $row['email'],
      'category' => $row['cname'],
      'text' => $row['joketext'],
      'date' => $row['jokedate']
    );
  }
}

try {
  $sql = 'SELECT name, id
  FROM category';
  $result = $pdo->query($sql);
} catch (PDOException $e) {
  $output = 'Error fetching categories: ' . $e->getMessage();
  include_once $root . '/components/error.html.php';
  exit();
}

if ($result->rowCount() == 0) {
  $output = "Error no categories found.";
  include_once $root . '/components/error.html.php';
  exit();
}

while ($row = $result->fetch()) {
  $categories[] = array(
    'id' => $row['id'],
    'name' => $row['name']
  );
}

include_once $root . "/components/show-category.html.php";

exit();

?>
