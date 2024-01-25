<?php

include './stripe-php-master/init.php';
//require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('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');

header('Content-Type: application/json');

$base_url = (isset($_SERVER['HTTPS'])
  && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
  . "://" . $_SERVER['HTTP_HOST'];


$domain_name = $base_url . ($_SERVER['HTTP_HOST'] == 'localhost' ? '/xogos' : '');
$YOUR_DOMAIN = $domain_name . '/stripe-one';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price' => 'price_1MGsf1JaC8AzBwqG9STUCHb0',
    'quantity' => 1,
  ]],
  'mode' => 'subscription',
  'success_url' => $YOUR_DOMAIN . '/success.php',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
  'automatic_tax' => [
    'enabled' => true,
  ],
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
