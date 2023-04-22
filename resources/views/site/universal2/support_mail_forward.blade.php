<html>
<body>
<h2>Имя</h2>
<div>{{ $request->name }}</div>
<h2>Email</h2>
<div>{{ $request->email }}</div>
<h2>Есть номер накладной?</h2>
<div>{{ $request->have_invoice?'есть':'нет' }}</div>
@if($request->have_invoice)
    <h2>Номер</h2>
    <div>{{ $request->invoice_number }}</div>
@endif
<h2>Тема вопроса</h2>
<div>{{ $request->summary }}</div>
<h2>Тип заказа</h2>
<div>{{ $request->order_type }}</div>
<h2>Вопрос</h2>
<div>{{ $request->question }}</div>
<h2>Со страницы</h2>
<div>{{ $request->url }}</div>
</body>
</html>
