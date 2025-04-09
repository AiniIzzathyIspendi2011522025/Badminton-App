<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahan gaya untuk mendukung email */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 12px;
        }

        .card {
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, .15);
            overflow: hidden;
        }

        .card-header {
            background-color: #4e73df;
            color: #fff;
            padding: 1rem;
            font-size: 1.25rem;
            text-align: center;
        }
    </style>
</head>

<body style="background-color: #f8f9fc; font-family: Arial, sans-serif;">

    <div class="container my-5 bg-white">
        <div class="card">
            <div class="card-header">
                Reset Password Request
            </div>
            <div class="card-body p-4">
                <p>Hello,</p>
                <p>You requested a password reset for your account. Please click the button below to reset your
                    password. If you did not make this request, please ignore this email.</p>

                <div class="text-center my-4">
                    <a href="http://127.0.0.1:8000/forgot-password/validate/{{ $token }}" class="btn btn-primary"
                        target="_blank">Reset Password</a>
                </div>

                <p>If the button above doesn’t work, please copy and paste the following URL into your browser:</p>
                {{-- <p><a href="{{ reset_link }}" target="_blank">{{ reset_link }}</a></p> --}}

                <p>Thank you,<br>Your Company Name</p>
            </div>
            <div class="card-footer text-center py-3" style="background-color: #f8f9fc; color: #6c757d;">
                © {{ date('Y') }} Your Company. All rights reserved.
            </div>
        </div>
    </div>

</body>

</html>
