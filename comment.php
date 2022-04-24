<?php

$conn = mysqli_connect("localhost", "root", "", "post&com");



if (isset($_POST['comment'])) {

    $parent_id = $_POST['parent_id'];
    $comment = $_POST['comment'];
    $date_added = date("Y-m-d");
    $date_completed = date("Y-m-d");
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];


    $query = "INSERT INTO comments (`parent_id`,`comment`,`date_added`,`date_completed`,`post_id`,`user_id`) 
    VALUES ('$parent_id','$comment','$date_added','$date_completed','$post_id','$user_id') ";

    $aa = mysqli_query($conn, $query);
}

$query = "SELECT * FROM users";


$data = mysqli_query($conn, $query);
$user = mysqli_fetch_all($data, MYSQLI_ASSOC);

$po = "SELECT * FROM posts";


$data = mysqli_query($conn, $po);
$post = mysqli_fetch_all($data, MYSQLI_ASSOC);

$parent = "SELECT * FROM comments";


$data = mysqli_query($conn, $parent);
$parent_id = mysqli_fetch_all($data, MYSQLI_ASSOC);


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
        <form method="POST" action="#">
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">parent_id</label>
                <select class="form-select" name="parent_id" aria-label="parent_id">
                    <option selected value="0">Open this select menu</option>

                    <?php foreach ($parent_id as $value) : ?>

                        <option value="<?= $value['id'] ?>"><?= $value['comment'] ?> </option>

                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">comment</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="comment">
            </div>
            <!-- <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">date_added</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="date_added">
            </div>
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">date_completed</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="date_completed">
            </div> -->
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">post_id</label>
                <select class="form-select" name="post_id" aria-label="users">
                    <option selected value="0">Open this select menu</option>

                    <?php foreach ($post as $value) : ?>

                        <option value="<?= $value['id'] ?>"><?= $value['title'] ?> </option>

                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">user_id</label>
                <select class="form-select" name="user_id" aria-label="users">
                    <option selected value="0">Open this select menu</option>

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