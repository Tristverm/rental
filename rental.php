<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // check if all required fields are present
    if (!isset($_POST['name']) || !isset($_POST['id']) || !isset($_POST['room'])) {
        echo "Error: Please provide your name, national ID, and room type";
        exit();
    }

    $name = $_POST['name'];
    $id = $_POST['id'];
    $room = $_POST['room'];
    $price = 0;

    if ($room === 'Executive') {
        $price = 5000;
    } elseif ($room === 'Penthouse') {
        $price = 7150;
    } else {
        echo "Error: Invalid room type";
        exit();
    }

    // check if it's April for 10% discount
    $is_april = (date('m') == 4);
    if ($is_april) {
        $discount = 0.1;
        $discount_amount = $price * $discount;
        $price -= $discount_amount;
        $discount_message = "April offer: 10% discount (R $discount_amount)";
    }

    // include 15% VAT
    $vat = 0.15;
    $vat_amount = $price * $vat;
    $price += $vat_amount;

    // display total amount payable and greet user using their name in HTML
    echo "<style>
    .success {
        background-color: #f8f8f8;
        border: 1px solid #eee;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
        font-weight: bold;
      }

      .offer {
        font-weight: bold;
        color: #009933;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #eee;
      }
        </style>";


    echo "<div class='success'>";
    echo "<h1> $room Receipt</h1>";
    echo "<p>Hello $name!</p>";
    

    if (isset($discount_message)) {
        echo "$discount_message";
    }
    echo "<p> VAT payable is $vat_amount (15 %)</p>";
    echo "<p>Your total amount payable is R $price .</p>";

    echo "</div>";
}
