<?php


// Создание сессии для вывода на другую php или html страницу
session_start();

// Создание подключения к бд

$connect = mysqli_connect('localhost', 'root', 'root', 'bd'); // Хост , пользователь, пароль, название бд


// Проверка подключения

if (!$connect) {
    die('Error');
}

// Ввод переменных для запись в бд

$email = trim($_POST['email']);
$password = trim($_POST['password']);
$full_name = $_POST['full_name'];

$_SESSION['email'] = $email;
$_SESSION['full_name'] = $full_name;
$_SESSION['password'] = $password;

// Хеширование пароля

if ($password === $password) {
    $password = md5($password);

    // Подключение к списку в бд для записи данных

    mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `email`, `password`) VALUES (NULL, '$full_name', '$email', '$password')");
}

// Перевод на другую страницу
header('Location: ../auth/login.php');
