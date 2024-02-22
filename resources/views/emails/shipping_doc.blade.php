<strong>Hello, </strong> {{ $name }}

<p>Your order has been shipped. Please find the attached documents</p>

<strong>Order Details:</strong>

<p>Order Date: {{ date_format($date, 'd/m/Y - H:i') }}</p>
<p>Reference Number: {{ $reference }}</p>
<p>Order ID: {{ $order_id }}</p>

