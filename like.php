<?php
include './dbconn.php';

//echo "<pre>";
//$sql = "select * from camp";  // select All


//$sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES ('John', 'Doe', 'john@example.com')"; // insert
//$sql = "UPDATE depart SET islike='1' WHERE ipadd= ::1 "; // update


$sql = "select * from camp where remote_address_ip = '$ipaddress'";  // where 
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $sql = "INSERT INTO camp (remote_address_ip) VALUES ('$ipaddress')"; // insert
    $conn->query($sql);
}


//echo "<pre>";
//print_r($result);
//die;

$ipdata = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <style>
            a{
                font-size: 50px;
            }
        </style>
    </head>
    <body>

        <div class="container">
            <h2>Campign Page</h2>


            <?php if (!empty($ipdata) && $ipdata['is_like'] == 0) { ?>

                <a href="#"  onclick="makelike($(this))">
                    <span class="glyphicon glyphicon-heart-empty"></span>
                </a>
            <?php } else { ?>

                <a href="#"  onclick="makedislike($(this))">
                    <span class="glyphicon glyphicon-heart"></span>
                </a>
                <br>
                <p> You Have liked this video </p>

            <?php }
            ?>

        </div>

    </body>
    <?php
    $conn->close();
    ?>

    <script>

        let url = "http://localhost/card_css/updateLike.php";
        let ip = "<?php echo $ipaddress ?>";
        function makelike(obj) {
            console.log("-----")

            $.ajax({
                method: "POST",
                url: url,
                data: {ip: ip, is_like: 1},
                success: function (res) {
                    var res = $.parseJSON(res);
                    console.log(res)
                    if (res.status == "success") {
//                        alert("You have successfully liked the video...")
                        location.reload();
                    }

                }
            });
        }

        function makedislike(obj) {
            console.log("*****")

            $.ajax({
                method: "POST",
                url: url,
                data: {ip: ip, is_like: 0},
                success: function (res) {
                    var res = $.parseJSON(res);
                    console.log(res)

                    if (res.status == "success") {
//                        alert("You have successfully disliked the video...")
                        location.reload();
                    }

                }
            });
        }

    </script>

</html>
