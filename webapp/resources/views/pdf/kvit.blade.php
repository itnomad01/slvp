<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Квитанция на оплату</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>* {font-family: "DejaVu Sans", sans-serif, liberation-serif;} table, tr, td {border:1px solid #000;border-collapse:collapse;} td { padding:4px;}</style>
</head>
<body>
    <div style="width: 100%; max-width: 960px; margin: auto; padding: 20px">
        <h1>{{$org->title}}</h1>
        <h2>Квитанция на оплату</h2>
        <img src="data:image/svg+xml;base64, {{ base64_encode(QrCode::encoding('UTF-8')->format('svg')->size(320)->errorCorrection('M')->generate($ms)) }}">
        <p>Отсканируйте QR-код в приложении Вашего банка</p>
        <table style="width:100%">
            <tr><td>Наименование получателя</td><td><b>{{$org->fintitle}}</b></td></tr>
            <tr><td>ИНН получателя</td><td><b>{{$org->inn}}</b></td></tr>
            <tr><td>КПП получателя</td><td><b>{{$org->kpp}}</b></td></tr>
            <tr><td>Расчётный счёт получателя</td><td><b>{{$org->personal_acc}}</b></td></tr>
            <tr><td>Корреспондентский счёт банка получателя</td><td><b>{{$org->corresp_acc}}</b></td></tr>
            <tr><td>Наименование банка получателя</td><td><b>{{$org->bank_name}}</b></td></tr>
            <tr><td>БИК банка получателя</td><td><b>{{$org->bic}}</b></td></tr>
            <tr><td>КБК</td><td><b>{{$org->kbk}} {{$org->titlekbk}}</b></td></tr>
            <tr><td>ОКТМО</td><td><b>{{$org->oktmo}}</b></td></tr>
            <tr><td>Назначение платежа</td><td><b>{{$org->purpose}}</b></td></tr>
            <tr><td>Статус плательщика</td><td><b>{{$org->drawer_status}}</b></td></tr>
            <tr><td>ID плательщика</td><td><b>{{$user->id}}</b></td></tr>
        </table>
    </div>
</body>
</html>
