<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Remove Author</title>
</head>

<body>

    <nav>
        <ul>
            <li>
                <a href="./">Show Jokes </a>
            </li>
            <li>
                <a href="./current-jokes.php">Current-jokes </a>
            </li>
            <li>
                <a href="./update-date.php">Update Date </a>
            </li>
            <li>
                <a href="./show-category.php">Show Category </a>
            </li>
            <li>
                <a href="./remove-author.php">Remove Author </a>
            </li>
            <li>
                <a href="./search-jokes.php">Search Jokes </a>
            </li>
        </ul>
    </nav>

    <?php

    require $root . "/includes/helpers.inc.php";

    echo "<form action=\"?\" method=\"post\">";
    echo "<label for=\"id\">Select Author:</label>";
    echo "<br>";
    echo "<select id=\"id\" name=\"id\">";
    echo "<option value=\"\">Select one</option>";
    foreach ($authors as $author) {
        echo "<option value=\"";
        htmlout($author['id']);
        echo "\">";
        htmlout($author['name']);
        echo "</option>";
    }
    echo "</select>";
    echo "<input name=\"action\" type=\"submit\" value=\"Remove Author\"/>";
    echo "</form>";

    ?>

</body>

</html>