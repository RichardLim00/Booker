<html lang="en">
<?php
    require_once './configurations/login.php';
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
    <?php include "./components/navbar.php"?>

    <!--Books List-->
    <?php       # Acquire All Books From Database
        if(isset($_GET['bookName'])){
            $statement = $conn->prepare("SELECT * FROM classics WHERE title = ?");
            $statement->bind_param("s", $_GET['bookName']);
            $statement->execute();
            $result = $statement->get_result();
            $title = "Search Result for '$_GET[bookName]";
            
            $records = $result->fetch_all(MYSQLI_ASSOC);
        } else {   
            $query = "SELECT * FROM classics LIMIT 10";
            $result = $conn->query($query);
            if(!$result) die("No Result!");
            $title = "Book List";
            
            $records = $result->fetch_all(MYSQLI_ASSOC);
        }
    ?>
    <?php if(count($records) != 0 ){ ?>
    <div class="container mt-5">
        <h1><?= $title  ?></h1>
        <div class="table-responsive">
            <table class="table mx-auto">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ISBN</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Year</th>
                    </tr>
                </thead>
                <?php   #Display all Books
                    foreach($records as $resultArray){
                    echo 
                        "
                            <tr>
                                <td>$resultArray[isbn]</td>
                                <td><a href='book.php?bookISBN=$resultArray[isbn]'>$resultArray[title]</a></td>
                                <td>$resultArray[author]</td>
                                <td>$resultArray[year]</td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
    </div>
    <?php } else { ?>
    <h1 class="text-center mt-5">No Result!</h1>
    <?php } ?>

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