<table>
    <tr>
        <td>Имя</td>
        <td>{{ $request->name }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{ $request->email }}</td>
    </tr>
    <tr>
        <td>Есть номер накладной?</td>
        <td>{{ $request->have_invoice?'есть':'нет' }}</td>
    </tr>
    @if($request->have_invoice)
        <tr>
            <td>Номер</td>
            <td>{{ $request->invoice_number }}</td>
        </tr>
    @endif
    <tr>
        <td>Тема вопроса</td>
        <td>{{ $request->summary }}</td>
    </tr>
    <tr>
        <td>Тип заказа</td>
        <td>{{ $request->order_type }}</td>
    </tr>
    <tr>
        <td>Вопрос</td>
        <td>{{ $request->question }}</td>
    </tr>
    <tr>
        <td>Со страницы</td>
        <td>{{ $request->url }}</td>
    </tr>
    <tr>
        <td></td>
        <td>{{ $currentTime }}</td>
    </tr>
</table>
