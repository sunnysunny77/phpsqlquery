<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update Date</title>
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

    require $root . "/requires/helpers.php";

    foreach ($jokes as $joke) {
        echo "<blockquote>";
        markdownout($joke['text']);
        echo " ( by <a href=\"mailto:";
        htmlout($joke['email']);
        echo  "\">";
        htmlout($joke['name']);
        echo "</a> )";
        echo "</blockquote>";
        echo "<form action=\"?\" method=\"post\">";
        echo "<label for=\"date";
        htmlout($joke['id']);
        echo "\">Enter Date:</label>";
        echo "<br>";
        echo "<input type=\"date\" id=\"date";
        htmlout($joke['id']);
        echo "\" name=\"date\" value=\"";
        htmlout($joke['date']);
        echo "\"/>";
        echo "<input type=\"hidden\" name=\"id\" value=\"";
        htmlout($joke['id']);
        echo "\"/>";
        echo "<input name=\"action\" type=\"submit\" value=\"Update Date\"/>";
        echo "</form>";
        echo "<br>";
        echo "<br>";
    }

    ?>

</body>

</html>