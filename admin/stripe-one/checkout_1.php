<?php

include './stripe-php-master/init.php';
//require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('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');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://myxogos.com/admin';

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
