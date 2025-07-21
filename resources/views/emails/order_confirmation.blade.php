<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; }
        h1 { color: #333; }
        p { color: #555; }
        .order-details { border: 1px solid #ddd; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>تأیید سفارش شماره {{ $order->id }}</h1>
        <p>سفارش شما با موفقیت ثبت شد. جزئیات سفارش:</p>
        <div class="order-details">
            <p><strong>رستوران:</strong> {{ $order->restaurant->name }}</p>
            <p><strong>مبلغ:</strong> {{ number_format($order->total_price) }} تومان</p>
            <p><strong>وضعیت:</strong> {{ $order->status }}</p>
            <p><strong>آدرس:</strong> {{ $order->address->address }}</p>
        </div>
        <p>با تشکر از خرید شما!</p>
    </div>
</body>
</html>
