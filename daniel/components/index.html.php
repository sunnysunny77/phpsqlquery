<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Show Jokes</title>
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

    echo "<p>Here are all the jokes from the database:</p>";

    foreach ($jokes as $joke) {
        echo "<blockquote>";
        markdownout($joke['text']);
        echo " ( by <a href=\"mailto:";
        htmlout($joke['email']);
        echo  "\">";
        htmlout($joke['name']);
        echo "</a> )";
        markdownout($joke['date']);
        echo "</blockquote>";
    }

    ?>

</body>

</html>