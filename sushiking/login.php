<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="login/css/opmaak.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Log in</title>
</head>

<body>
<section class="signup-form">
    <h2>Log In</h2>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="name" placeholder="Username/Email">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit" name="submit">Log In</button>
    </form>
</section>
</body>
</html