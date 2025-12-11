<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تقرير شهري - {{ $month }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; padding: 40px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1 style="text-align:center;">تقرير شهري - {{ $month }}</h1>
    <h2 style="text-align:center;">{{ $name }}</h2>

    <table>
        <tr><th>البند</th><th>القيمة</th></tr>
        <tr><td>الإجازات</td><td>{{ $vacations }}</td></tr>
        <tr><td>الإذونات</td><td>{{ $permissions }}</td></tr>
        <tr><td>الغيابات</td><td>{{ $absences }}</td></tr>
        <tr><td>ساعات التأخير</td><td>{{ $delay_hours }}</td></tr>
        <tr><td>ساعات الانصراف المبكر</td><td>{{ $early_hours }}</td></tr>
        <tr><td>ساعات العمل الإضافي</td><td>{{ $overtime_hours }}</td></tr>
        <tr><td>الراتب الأساسي</td><td>{{ number_format($base_salary) }} جم</td></tr>
        <tr><td>الخصومات</td><td>{{ number_format($deductions) }} جم</td></tr>
        <tr><td>أجر العمل الإضافي</td><td>{{ number_format($ot_pay) }} جم</td></tr>
        <tr style="background:#e6ffe6"><td><strong>الراتب الصافي</strong></td><td><strong>{{ number_format($net_salary) }} جم</strong></td></tr>
    </table>
</body>
</html>