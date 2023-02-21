<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log-in Your Account</title>

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://db.onlinewebfonts.com/c/983b45b54c4a57f87d0b6fee11a92aa9?family=averox" rel="stylesheet" type="email/css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
    @vite(['../resources/css/signup.css'])

</head>

<body class="log-body">
    <header class="login-header">
        <img src="{{asset('../images/logo.png')}}" class ="logo" id="logo">
        <div class="title-spec">
            <h1>New on Board?</h1>
            <h1>no worry</h1>
            <h1>Join your Future!</h1>
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
                <form class="form-user" name="signForm" method="post" id="userForm" autocomplete ="off">
                    <input type="text" name="name" placeholder="First and Last name" required>
                    <input type="email" name="email" placeholder="Enter e-mail address" required>
                    <input type="password" name="password" placeholder="Password (6 characters min)" required>
                    <input type="text" name="phone" placeholder="Your phone number" required>
                    <button type="submit" name="submit" id="sign-button">Start.</button>
                    <a href="login"> Already have an account?</a>
                </form>
            </div>
        </div>
    
    </main>
    @vite(['../resources/js/signup.js'])
</body>
</html>


