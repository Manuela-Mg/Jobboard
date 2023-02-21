<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Joab board</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://db.onlinewebfonts.com/c/983b45b54c4a57f87d0b6fee11a92aa9?family=averox" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://css.gg/close-o.css' rel='stylesheet'>
    <link href='https://css.gg/close.css' rel='stylesheet'>
        <!-- Styles -->
    @vite(['../resources/css/app.css'])

</head>

<body class="home-body">
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
            <div class="apply" id="mainbox">
                <div class="applyBox">
                    <h3>It's Start Here!</h3>
                    <div class="form-group" id ="colForm">
                        <form action="#" method="get" class="jobs-form" id="app-form">
                            <i class="gg-close" id="close-apply"></i>
                            <label>Enter your informations</label>
                            <input type="text" name="domain" placeholder="Full name">
                            <input type="email" name="domain" placeholder="E-mail">
                            <input type="text" name="domain" placeholder="Phone">
                            
                            <label>Add your CV</label>
                            <input type="text" name="place" placeholder="City or postal code">
                            <button type="submit" name="submit">Send</button> 
                        </form>
                    </div>
                </div>
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
    <main class="home-main">
        <section class="search-section">
            <h2>Ready to find your Job Happiness</h2>
            @if (Auth::check()) {
                <div class="info">
                <h2 class="d-block">{{ Auth::user()->name ?? ""}}?</h2>
                </div>
            }
            @else
                <h2>?</h2>
            @endif
            <div class="search-little">
                <form action="#" method="get" class="jobs-form">
                    <label>What domain?</label>
                    <input type="text" name="domain" placeholder="Job title, key words">
                    <label>Where?</label>
                    <input type="text" name="place" placeholder="City or postal code">
                    <button type="submit" name="submit">Let's get It!</button> 
                </form>
            </div>
            <div class="search-cnt">
                <form action="#" method="post" class="jobs-form">
                    <div class="form-group" id ="rowForm">
                    <label>What domain?</label>
                    <input type="text" name="domain" placeholder="Job title, key words">
                    </div>
                    <div class="form-group">
                    <label>Where?</label>
                    <input type="text" name="place" placeholder="City or postal code">
                    </div>
                    <button type="submit" name="submit">Let's get It!</button> 
                </form>
            </div>
        </section>
        <section class="ads-section">
                <h2>E x p l o r e</h2>
                <h2>new opportunities!</h2>
                <div class="colored-content"></div>
            <div class="ads-mobile" id="ads-container">
            </div>
            <nav class="pagination">
                <div class="switch-ctr">
                    <button id="previousPage" class="switch-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                    </button>
                    <!-- <ul id="page-numbers">
                    </ul> -->
                    <button id="nextPage" class="switch-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                    </button>
                </div>
            </nav>
        </section>
        <div class="article"></div>

    </main>
    @vite(['../resources/js/app.js'])
    @vite(['../resources/js/button.js'])
</body>
</html>
