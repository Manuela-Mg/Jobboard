<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Joab board</title>

</head>

<body class="antialiased">
    <form id"create-user">
        <input type="text" name="name" placeholder="First and Last name" id="name">
        <input type="email" name="email" placeholder="Enter e-mail address">
        <input type="password" name="password" placeholder="Choose a Password">
        <input type="text" name="phone" placeholder="Your phone number">
        <button type="submit" name="submit" id="sign-button">Start.</button>
    </form>
    @vite(['../resources/js/admin/create.js'])
</body>


</html>