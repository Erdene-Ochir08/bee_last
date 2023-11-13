<!DOCTYPE html>
<html>
<head>
    <title>ЗАХИАЛГА БАТАЛГААЖЛАА</title>
</head>
<body>
<h2>ЗАХИАЛГА БАТАЛГААЖЛАА</h2>

<p>Hello {{ $order->fullname }},</p>

<p>Бид таны захиалгийг хянан баталгаажууллаа</p>

<table>
    <thead>
    <tr>
        <th>Бүтээгдэхүүн</th>
        <th>Тоо хэмжээ</th>
        <th>Хямдралын хувь</th>
        <th>Үнэ</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($order->items as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->pivot->quantity }}</td>
            <td>{{ $item->sale_percent }}%</td>
            <td>{{ $item->pivot->price }}₮</td>
        </tr>
    @endforeach
    </tbody>
</table>

<p>Нийт Дүн: {{ $order->totalAmount() }} ₮</p>

<p>Манай үйлчилгээг сонгон үйлчлүүлсэн танд баярлалаа. Хэрэв танд асуулт, санаа зовох зүйл байвал бидэнтэй холбоо барина уу.</p>

<p><strong>Molly.com</strong></p>
</body>
</html>
