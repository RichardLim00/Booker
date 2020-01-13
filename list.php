<html lang="en">
<?php
    require_once './configuration/login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    $conErrorMessage = "Connection to Database Failed!";
    if($conn->connect_error) die ($conErrorMessage);
    
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Booker</title>
</head>

<body>
    <!--NavBar -->
    <nav class="navbar navbar-expand-sm navbar-light bg-warning">
        <a class="navbar-brand" href="index.php">Booker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="list.php">List<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="GET" action="bookInfo.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Book Name" aria-label="Search"
                    name="bookName" autocomplete="off">
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <!--Books List-->
    <?php       # Acquire All Books From Database
        $query = "SELECT * FROM classics";
        $result = $conn->query($query);
        if(!$result) die("No Result!");

        $records = $result->fetch_all(MYSQLI_ASSOC);
    ?>
    <div class="container">
        <table class="mx-auto" border="1">
            <?php
                foreach($records as $resultArray){
                echo 
                    "<tr>
                        <td>$resultArray[isbn]</td>
                        <td>$resultArray[title]</td>
                        <td>$resultArray[author]</td>
                        <td>$resultArray[year]</td>
                    </tr>";
                }
            ?>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>