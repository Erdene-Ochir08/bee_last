<!DOCTYPE html>
<html>
<head>
    <title>Шинэ захиалга орж ирлээ</title>
</head>
<body>
<h2>Шинэ захиалга</h2>

<p>Hello Admin</p>

<p>Шинэ захиалга орж ирлээ, admin-panel ын order хэсгээс захиалгийн талаар дэлгэрэнгүй мэдээллийг харна уу</p>

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

<p>Нийт Дүн: {{ $order->totalAmount()}} ₮</p>

<p>Хэрэглэгчийн мэдээлэл:</p>
<ul>
    <li>Нэр: {{ $order->fullname }}</li>
    <li>Email: {{ $order->email }}</li>
    <li>Утас: {{ $order->phone }}</li>
    <li>Хаяг: {{ $order->address }}</li>
</ul>

</body>
</html>
