<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Created</title>
</head>
<body>
<h1>Ticket Created Successfully</h1>

<p><strong>Title:</strong> {{ $ticket->title }}</p>
<p><strong>Description:</strong> {{ $ticket->description }}</p>
<p><strong>Priority:</strong> {{ $ticket->priority }}</p>
<p><strong>Created By:</strong> {{ $ticket->creator->name }}</p>
<p><strong>Status:</strong> {{ $ticket->status }}</p>

<p>Thank you for using our system!</p>
</body>
</html>
