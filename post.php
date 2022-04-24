<?php

$conn = mysqli_connect("localhost", "root", "", "post&com");

if (isset($_POST['title'])) {

    if (isset($_FILES['image'])) {

        $image = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image = explode("/", $image);
        $image = end($image);

        if ($image == 'png' || $image == 'jpg' || $image == 'jpeg') {

            $name = rand(100, 1000000);

            $nameim = "post$name.$image";

            move_uploaded_file($tmp_name, "./image/$nameim");
        }
    }



    $title = $_POST['title'];
    $user_id = $_POST['user_id'];






    $text = $_POST['text'];


    $query = "INSERT INTO posts (`title`,`text`,`image`,`user_id`) VALUES ('$title','$text',' $nameim',$user_id)";


    mysqli_query($conn, $query);
}

$query = "SELECT * FROM users";


$data = mysqli_query($conn, $query);
$user = mysqli_fetch_all($data, MYSQLI_ASSOC);


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>


    <pre></pre>
    <pre></pre>
    <pre></pre>

    <div class="container">
        <form method="POST" action="#" enctype="multipart/form-data">
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="title">
            </div>
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">text</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="text">
            </div>
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">image</label>
                <input type="file" class="form-control" id="exampleInputEmail1" name="image">
            </div>
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">users</label>
                <select class="form-select" name="user_id" aria-label="users">
                    <option selected>Open this select menu</option>

                    <?php foreach ($user as $value) : ?>

                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?> </option>

                    <?php endforeach ?>
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>