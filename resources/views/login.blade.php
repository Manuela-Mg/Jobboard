<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log-in Your Account</title>

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://db.onlinewebfonts.com/c/983b45b54c4a57f87d0b6fee11a92aa9?family=averox" rel="stylesheet" type="email/css"/>

    @vite(['../resources/css/login.css'])

</head>

<body class="log-body">
    <header class="login-header">
        <img src="{{asset('../images/logo.png')}}" class ="logo" id="logo">
        <div class="title-spec">
            <h1>Log Back in,</h1>
            <h1>And see what</h1>
            <h1>You've missed.</h1>
        </div>
    </header>
    <main class="log-main">
        <div class="log-ctr">
            <div class="log-user">
                <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/bhfjfgqz.json"
                    trigger="hover">
                </lord-icon>
                <form class="form-user" method="post" name="logForm" id="logInf">
                    <input type="email" name="email" placeholder="Username/Company e-mail" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="submit">Log In.</button>
                    <a href="#"> Lost Your Password?</a>
                    <a href="signup"> Doesn't Have an Account?</a>
                </form>
            </div>
        </div>
    
    </main>
    @vite(['../resources/js/login.js'])
</body>
</html>


