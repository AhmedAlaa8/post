<?php


$conn = mysqli_connect("localhost", "root", "", "post&com");



$query = "SELECT * FROM users";


$data = mysqli_query($conn, $query);
$user = mysqli_fetch_all($data, MYSQLI_ASSOC);


$po = "SELECT * FROM posts join users on posts.user_id = users.id";


$data = mysqli_query($conn, $po);
$post = mysqli_fetch_all($data, MYSQLI_ASSOC);


$parent = "SELECT * FROM comments";

$data = mysqli_query($conn, $parent);
$parent_id = mysqli_fetch_all($data, MYSQLI_ASSOC);


$x = [];
foreach ($parent_id as $z) {


    $x[$z['parent_id']][] = $z;
}


// var_dump($post);
// die;



function R_comment($com)
{
    global $x;

    echo "<ol>";
    foreach ($com as $m) {
        echo "<li>" . $m['comment'];
        if (isset($x[$m['id']])) {

            R_comment($x[$m['id']]);
        }
        echo   "</li>";
    }
    echo "</ol>";
}

// R_comment($x[0]);
// die;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin-top: 20px;
        }

        /*==================================================
            Post Contents CSS
        ==================================================*/

        .post-content {
            background: #f8f8f8;
            border-radius: 4px;
            width: 100%;
            border: 1px solid #f1f2f2;
            margin-bottom: 20px;
            overflow: hidden;
            position: relative;
        }

        .post-content img.post-image,
        video.post-video,
        .google-maps {
            width: 55%;
            height: 300px;
            margin-left: 300px;
        }

        .post-content .google-maps .map {
            height: 300px;
        }

        .post-content .post-container {
            padding: 20px;
        }

        .post-content .post-container .post-detail {
            margin-left: 65px;
            position: relative;
        }

        .post-content .post-container .post-detail .post-text {
            line-height: 24px;
            margin: 0;
        }

        .post-content .post-container .post-detail .reaction {
            position: absolute;
            right: 0;
            top: 0;
        }

        .post-content .post-container .post-detail .post-comment {
            display: inline-flex;
            margin: 10px auto;
            width: 100%;
        }

        .post-content .post-container .post-detail .post-comment img.profile-photo-sm {
            margin-right: 10px;
        }

        .post-content .post-container .post-detail .post-comment .form-control {
            height: 30px;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            margin: 7px 0;
            min-width: 0;
        }

        img.profile-photo-md {
            height: 50px;
            width: 50px;
            border-radius: 50%;
        }

        img.profile-photo-sm {
            height: 40px;
            width: 40px;
            border-radius: 50%;
        }

        .text-green {
            color: #8dc63f;
        }

        .text-red {
            color: #ef4136;
        }

        .following {
            color: #8dc63f;
            font-size: 12px;
            margin-left: 20px;
        }
    </style>
</head>

<body>

    <?php foreach ($post as $value) : ?>







        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="post-content">



                        <form action="./delete.php" method="POST">
                            <img src="./image/post43887.jpeg" alt="post-image" class="img-responsive post-image">


                            <input type="hidden" name="id" value="<?= $value['id']; ?>">

                            <button type="submit" name="dm" value="<?= $value['image']; ?>">Delete</button>




                        </form>
                        <div class="post-container">
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="user" class="profile-photo-md pull-left">
                            <div class="post-detail">
                                <div class="user-info">


                                    <h5><a href="timeline.html" class="profile-link"><?= $value['name'] ?></a> <span class="following">following</span></h5>


                                    <p class="text-muted"><?= $value['title']   ?></p>

                                </div>




                                <div class="reaction">
                                    <a class="btn text-green"><i class="fa fa-thumbs-up"></i> 13</a>
                                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
                                </div>
                                <div class="line-divider"></div>
                                <div class="post-text">
                                    <p><?= $value['text']   ?></p>
                                </div>




                                <div class="line-divider"></div>
                                <div class="post-comment">
                                    <p><i class="em em-laughing"> </i>

                                        <?php




                                        // if ($x[0][0]['parent_id'] == 0) {



                                        //     foreach ($x[0] as $value) {

                                        //         if ($value['parent_id'] == 0) {

                                        //             echo $value['comment'];
                                        //             echo "<br>";
                                        //         }
                                        //     }
                                        // }


                                        R_comment($x[0]);

                                        // for ($j = 0; $j < ; $j++) {


                                        //     for ($i = 0; $i < 2; $i++) {

                                        //         echo $x[$j][$i]['comment'];
                                        //         echo "<br>";
                                        //     }
                                        // }


                                        ?>
                                    </p>
                                </div>



                                <div class="post-comment">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="profile-photo-sm">
                                    <input type="text" class="form-control" placeholder="Post a comment">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php endforeach ?>
</body>

</html>