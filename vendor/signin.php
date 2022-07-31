<?php

session_start(); // Создание сессии для вывода на другую php или html страницу

// Создание подключения к бд

$connect = mysqli_connect('localhost', 'root', 'root', 'db'); // Хост , пользователь, пароль, название бд

// Проверка подключения к бд
if (!$connect) {
    die('Error connect to database');
}

// Ввод переменных для запись в бд

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = md5($_POST['password']);

// Подключение к списку и вывод данных

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) {

    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        "id" => $user['id'],
        "email" => $user['email'],
        "full_name" => $user['full_name'],
    ];

    // Перевод на другую страницу
    header('Location: ../auth/profile.php');
}
