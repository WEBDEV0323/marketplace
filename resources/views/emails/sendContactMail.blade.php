<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Query Received</title>
</head>
<body>
    <h1>Contact Information</h1>
    
    <p>Email: {{ $data['email'] }}</p>
    <p>Subject: {{ $data['subject'] }}</p>
    <p>Description: {{ $data['description'] }}</p>
    <p>Phone: {{ $data['phone'] }}</p>
    <p>Order Number: {{ $data['order_no'] }}</p>
    <p>Reason: {{ $data['reason'] }}</p>
</body>
</html>