<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Applying Page</title>

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://db.onlinewebfonts.com/c/983b45b54c4a57f87d0b6fee11a92aa9?family=averox" rel="stylesheet" type="email/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
    @vite(['../resources/css/apply.css'])

</head>

<body class="apply-body">
    <header class="header">
        <nav class="navbar">
            <div class="menu" id="menuBtn">
                <i class="fa-solid fa-bars menu-button"></i>
            </div>
            <div id="popUp" class="pop-up">
                <ul class="pop-cnt">
                    <li><a href="#">Companies</a></li>
                    <li class="active"><a href="#">Job Offers</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">My Space</a></li>
                </ul>
            </div>

            <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
            <lord-icon
                src="https://cdn.lordicon.com/bhfjfgqz.json"
                trigger="hover">
            </lord-icon>
            <div class="nav-links">
                <ul>
                    <li><a href="#">Companies</a></li>
                    <li><a href="#">Job Offers</a></li>
                    <li><a href="#">Contact Us</Title></a></li>
                    <li class="account"><a href="#">My Space</a></li>
                </ul>
            </div>
        </nav>

        <div class="finder">
            <h1>F i n d e r.</h1>
            <h1>F i n d e r.</h1>
        </div>
    </header>
    <main class="apply-main">
        <div class="apply-box">

        </div>

    </main>
 
@vite(['../resources/js/apply.js'])
@vite(['../resources/js/button.js'])
</body>

</html>