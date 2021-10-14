<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Show Category</title>
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
    echo "<label for=\"id\">Select Category:</label>";
    echo "<br>";
    echo "<select id=\"id\" name=\"id\">";
    echo "<option value=\"\">Select one</option>";
    foreach ($categories as $category) {
        echo "<option value=\"";
        htmlout($category['id']);
        echo "\">";
        htmlout($category['name']);
        echo "</option>";
    }
    echo "</select>";
    echo "<input name=\"action\" type=\"submit\" value=\"Show Category\"/>";
    echo "</form>";

    foreach ($jokes as $joke) {
        markdownout($joke['category']);
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