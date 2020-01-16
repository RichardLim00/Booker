<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Book Info</title>
</head>

<body>
    <?php include "./components/navbar.php" ?>
    <?php
        # connection to database
        require_once './configurations/login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        $conErrorMessage = "Connection to Database Failed!";
        if($conn->connect_error) die ($conErrorMessage);
    ?>
    <?php   
        # Acquire result from database
        $bookISBN = htmlentities( $_GET['bookISBN']);
        $getName_query = "SELECT * FROM classics WHERE isbn=$bookISBN";

        $queryResult = $conn->query($getName_query);
        $book = $queryResult->fetch_all(MYSQLI_BOTH)[0];
    ?>
    <?php
        $attrFields = array('Author', 'Title', 'Category', 'Year', 'ISBN');
        $desc_file_name = str_replace(" ", "_",strtolower($book['title'])) . ".txt";
        $desc_path = "./BooksInfo/descriptions/$desc_file_name";
        $desc = "";
        
        if(file_exists($desc_path)){
            $desc = file_get_contents($desc_path);
        } else {
            $desc = "No Description Available!";
        }
        
        $cover_img_name = str_replace(" ", "_",strtolower($book['title'])) . ".png";
        $cover_img_path = "./BooksInfo/images/$cover_img_name";
        if(!file_exists($cover_img_path)){
            $cover_img_path = "./BooksInfo/images/placeholder.png";
        }
    ?>

    <div class="container-md my-5">
        <h1 id="bookTitle"class="text-center mb-5" ><?= $book['title'] ?></h1>
        <div class="text-center">
            <img class="mb-5 text-center" src="<?= $cover_img_path  ?>" width="250" height="400">
        </div>

        <table class="table table-bordered">
        <?php
            foreach($attrFields as $index=>$field){
                print("
                    <tr>
                        <th>$field</th>
                        <td>$book[$index]</td>
                    </tr>
                ");
            }
        ?> 
        </table>
        <h3>Description</h3>
        <div class="card">
            <div class="card-body">
                <p class="text-justify"><?= $desc  ?></p>
            </div>
        </div>
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
    <script src="./javascripts/re-title.js"></script>
</body>

</html>