<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Khôi phục mật khẩu - CourierXpress</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #ffffff;
        }

        .left-side {
            width: 50%;
            background-color: #b81d24;
            color: white;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-logo {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .brand-title h1 {
            font-size: 24px;
            font-weight: bold;
            line-height: 1;
        }

        .brand-title span {
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0.8;
        }

        .intro-content {
            margin-top: 40px;
        }

        .intro-content h2 {
            font-size: 42px;
            margin-bottom: 20px;
        }

        .intro-content h2 span {
            color: #fbc02d;
        }

        .intro-content p {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .features {
            list-style: none;
        }

        .features li {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .features li i {
            background: rgba(255,255,255,0.2);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .right-side {
            width: 50%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
        }

        .form-container {
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .form-container h2 {
            font-size: 28px;
            color: #111;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .form-container p.subtitle {
            color: #666;
            font-size: 15px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .form-group {
            text-align: left;
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            color: #999;
            font-size: 18px;
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: all 0.3s;
        }

        .input-wrapper input:focus {
            border-color: #b81d24;
            box-shadow: 0 0 0 3px rgba(184, 29, 36, 0.1);
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #b81d24;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background 0.3s;
            margin-bottom: 25px;
        }

        .btn-submit:hover {
            background: #96151a;
        }

        .back-links {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .back-links a {
            color: #555;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: color 0.3s;
        }

        .back-links a:hover {
            color: #b81d24;
        }

        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            text-align: left;
            margin-bottom: 20px;
            border-left: 4px solid #2e7d32;
        }

        .alert-error {
            background-color: #fdecea;
            color: #d32f2f;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            text-align: left;
            margin-bottom: 20px;
            border-left: 4px solid #d32f2f;
        }

        .text-error {
            color: #d32f2f;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .left-side,
            .right-side {
                width: 100%;
            }

            .left-side {
                padding: 35px;
            }

            .right-side {
                padding: 35px;
            }

            .intro-content h2 {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>

<div class="left-side">
    <div class="brand">
        <div class="brand-logo">
            <i class="fa-solid fa-box-open"></i>
        </div>

        <div class="brand-title">
            <h1>CourierXpress</h1>
            <span>Logistics</span>
        </div>
    </div>

    <div class="intro-content">
        <h2>Khôi phục<br><span>mật khẩu!</span></h2>
        <p>
            Nhập email tài khoản khách hàng để nhận liên kết đặt lại mật khẩu.
        </p>

        <ul class="features">
            <li>
                <i class="fa-solid fa-envelope"></i>
                Nhận liên kết đặt lại mật khẩu qua email
            </li>
            <li>
                <i class="fa-solid fa-shield-halved"></i>
                Bảo mật thông tin tài khoản khách hàng
            </li>
        </ul>
    </div>

    <div></div>
</div>

<div class="right-side">
    <div class="form-container">
        <h2>Khôi phục mật khẩu</h2>

        <p class="subtitle">
            Nhập email tài khoản của bạn để nhận liên kết đặt lại mật khẩu.
        </p>

        @if (session('status'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $error }}
                    </div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Địa chỉ Email tài khoản</label>

                <div class="input-wrapper">
                    <i class="fa-regular fa-envelope"></i>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="Nhập email của bạn"
                        autocomplete="email"
                    >
                </div>

                @error('email')
                <span class="text-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                Gửi liên kết khôi phục
                <i class="fa-regular fa-paper-plane"></i>
            </button>
        </form>

        <div class="back-links">
            @if (Route::has('login'))
                <a href="{{ route('login') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                    Quay lại đăng nhập
                </a>
            @else
                <a href="/login">
                    <i class="fa-solid fa-arrow-left"></i>
                    Quay lại đăng nhập
                </a>
            @endif

            <a href="/">
                <i class="fa-solid fa-house"></i>
                Quay lại trang chủ
            </a>
        </div>
    </div>
</div>

</body>
</html>
