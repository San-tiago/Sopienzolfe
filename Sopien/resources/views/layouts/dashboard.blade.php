<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<h1>Admin!</h1>
<div>
<a href="/admin/menu"><button>Menu</button></a><br>
<a href="/admin/orders"><button>Orders</button></a><br>
    <a href="/admin/pendingorders">Pending Orders</a><br>
    <a href="/admin/approvedorders">Approve Orders</a><br>
    <a href="/admin/processedorders">Processed Orders</a><br>
    <a href="/admin/ondeliveryorders">On Delivery Orders</a><br>
    <a href="/admin/receivedorders">Received Orders</a><br>
    <a href="/admin/canceledorders">Canceled Orders</a><br>
<a href="/admin/sales"><button>Sales</button></a><br>
<a href="/admin/users"><button>Users</button></a><br>
</div>
<main class="py-4">
            @yield('dashboard')
</main>
</body>
</html>