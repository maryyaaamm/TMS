<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        /* Inline CSS for background and form styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff; /* Set background color to white */
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            background-color: #ffffff;
            font-size: 1rem;
            color: #333;
        }

        .form-group input:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .btn-primary {
            background-color: #0056b3;
            color: #ffffff;
            border: none;
            border-radius: 0.375rem;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #003d7a;
        }

        .text-gray-600 {
            color: #555;
        }

        .text-gray-400 {
            color: #9ca3af;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="mb-4 text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <!-- Session Status -->
        <!-- Replace this section with your session status logic if needed -->

        <form method="POST" action="/password/email">
            <input type="hidden" name="_token" value="YOUR_CSRF_TOKEN_HERE">

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="" required autofocus>
                <!-- Replace with your error handling if needed -->
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn-primary">
                    Email Password Reset Link
                </button>
            </div>
        </form>
    </div>
</body>
</html>
