<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifications</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #a864a8; }
        .notification { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; border-radius: 5px; }
        .new { background-color: #f5e6f5; } /* light version of the color */
        .title { font-weight: bold; color: #a864a8; }
        .date { font-size: 0.85em; color: #a864a8; }
        .new-label { font-size: 0.8em; color: #a864a8; font-weight: bold; margin-left: 5px; }
        a { text-decoration: none; color: #a864a8; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Notifications</h1>

    <!-- Example notifications -->
    <div class="notification new">
        <a href="notification1.html">
            <div class="title">New Account Message</div>
            <div class="message">Your account has been updated successfully...</div>
            <div class="date">2025-09-18 14:30 <span class="new-label">New</span></div>
        </a>
    </div>

    <div class="notification">
        <a href="notification2.html">
            <div class="title">Weekly Update</div>
            <div class="message">Here is your weekly summary of activities...</div>
            <div class="date">2025-09-17 09:15</div>
        </a>
    </div>

</body>
</html>
