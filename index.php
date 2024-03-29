<?php 
try{
    $pdo = new PDO("mysql:host=localhost;dbname=testXSS", 'root', 'admin');
} catch (PDOException $err) {
    print($err);
}

$data = $pdo->query("SELECT * from test_user");

if (isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['presentation'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $text = $_POST['presentation'];

    $pdo->exec("INSERT INTO test_user (username, password, text) VALUES ('$mail' ,'$password', '$text')");
}?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div>
                <label for="exampleInputText">Présentation</label>
                <input type="text" name="presentation" class="form-control" id="exampleInputText" placeholder="Presentation">
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 20px">Submit</button>
        </form>
    </div>
    <div class="container">
        <?php while($fetchedData = $data->fetch())
        {
            ?><div class="row"><?php echo($fetchedData['username'] . '  |  ' . $fetchedData['text']) ?></div>
        <?php }
        $data->closeCusor() ?>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>