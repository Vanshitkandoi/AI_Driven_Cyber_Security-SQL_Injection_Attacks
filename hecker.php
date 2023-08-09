<!DOCTYPE html>
<html>
<head>
    <style>
        iframe {
            background-size: cover;
            width: 100%;
            height: 600px;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;color:red">A Malicious Activity was
        Detected From your IP As a consequence we have Blocked Your Ip -
        <?php
        $ipadd = $_GET['msg'];
        echo $ipadd;
        ?>
    </h2>
</body>
</html>