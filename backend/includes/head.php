<?php
// Ожидаемые переменные: $pageTitle, $pageDescription
$pageTitle = $pageTitle ?? 'Саженцы-Иркутск';
$pageDescription = $pageDescription ?? 'Сад Мелентьевых';
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="format-detection" content="telephone=no">

  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">

  <link rel="stylesheet" href="/assets/css/style.css">

  <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/icons/favicon-16x16.png">
  <link rel="manifest" href="/assets/img/icons/site.webmanifest">
  <link rel="shortcut icon" href="/assets/img/icons/favicon.ico">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-config" content="/assets/img/icons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
</head>
