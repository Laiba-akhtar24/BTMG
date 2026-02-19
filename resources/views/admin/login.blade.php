<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - BTMG Trainings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #ffffff;
            width: 400px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #1f2937;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: 0.3s;
        }

        .login-container input:focus {
            border-color: #09637E;
            outline: none;
            box-shadow: 0 0 5px rgba(9, 99, 126, 0.3);
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background: #09637E;
            border: none;
            color: white;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-container button:hover {
            background: #074c60;
        }

        .error {
            background: #ffe5e5;
            color: #b91c1c;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .brand {
            text-align: center;
            font-size: 13px;
            margin-bottom: 10px;
            color: #6b7280;
        }
    </style>
</head>
<body>

<div class="login-container">

    <div class="brand">BTMG Trainings Admin Panel</div>
    <h2>Admin Login</h2>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/admin/login') }}">
        @csrf

        <input type="email" name="email" placeholder="Enter Email" required>

        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit">Login</button>
    </form>

</div>

</body>
</html>
