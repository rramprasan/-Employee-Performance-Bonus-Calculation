<!DOCTYPE html>
<html>
<head>
    <title>Bonus Assigned</title>
</head>
<body>
    <p>Dear {{ $employee->name }},</p>

    <p>We are pleased to inform you that you have received an additional bonus!</p>

    <p><strong>Bonus Amount:</strong> {{ number_format($bonus->bonus_amount, 2) }}</p>
    <p><strong>Reason:</strong> {{ $bonus->bonus_reason }}</p>
    <p><strong>Date:</strong> {{ $bonus->created_at->format('d M Y') }}</p>

    <p>Thank you for your hard work and dedication!</p>

    <p>Best Regards,<br>HR Team</p>
</body>
</html>
