<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>

    <p>Dear {{ $order->user_email }},</p>

    <p>Your order with ID {{ $order->id }} has been successfully placed.</p>

    <p>Order Details:</p>
    <ul>
        <li>User Email: {{ $order->user_email }}</li>
        <li>Order Amount: ${{ $order->order_amount }}</li>
    </ul>

    <p>Thank you for shopping with us!</p>
</body>
</html>
