<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="/css/admin.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div class="sidebar">
    <a href="/admin/menu">Menu</a><br>
    <a href="/admin/pendingorders">Pending Orders</a><br>
    <a href="/admin/approvedorders">Approve Orders</a><br>
    <a href="/admin/processedorders">Processed Orders</a><br>
    <a href="/admin/ondeliveryorders">On Delivery Orders</a><br>
    <a href="/admin/receivedorders">Received Orders</a><br>
    <a href="/admin/canceledorders">Cancelled Orders</a><br>
    <a href="/admin/sales">Sales</a><br>
    <a href="/admin/users">Users</a><br>
    <a href="/admin/users">Tutorial</a><br>

</div>
<main class="content">
            @yield('dashboard')
</main>
</body>
</html>