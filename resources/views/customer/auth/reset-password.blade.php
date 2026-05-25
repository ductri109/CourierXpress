<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu mới - CourierXpress</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; min-height: 100vh; }
        .left-side { width: 50%; background-color: #b81d24; color: white; padding: 60px; display: flex; flex-direction: column; justify-content: space-between; }
        .brand { display: flex; align-items: center; gap: 15px; }
        .brand-logo { width: 45px; height: 45px; background: rgba(255,255,255,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        .brand-title h1 { font-size: 24px; font-weight: bold; line-height: 1; }
        .brand-title span { font-size: 12px; letter-spacing: 2px; text-transform: uppercase; opacity: 0.8; }
        .intro-content { margin-top: 40px; }
        .intro-content h2 { font-size: 42px; margin-bottom: 20px; }
        .intro-content h2 span { color: #fbc02d; }
        .intro-content p { font-size: 16px; line-height: 1.6; opacity: 0.9; margin-bottom: 30px; }
        .features { list-style: none; }
        .features li { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; font-size: 16px; }
        .features li i { background: rgba(255,255,255,0.2); width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }

        .right-side { width: 50%; background: #ffffff; display: flex; align-items: center; justify-content: center; padding: 60px; }
        .form-container { width: 100%; max-width: 450px; text-align: center; }
        .form-container h2 { font-size: 28px; color: #111; margin-bottom: 10px; font-weight: 700; }
        .form-container p.subtitle { color: #666; font-size: 15px; margin-bottom: 30px; }

        .form-group { text-align: left; margin-bottom: 20px; }
        .form-group label { display: block; font-size: 14px; color: #333; margin-bottom: 8px; font-weight: 500; }
        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-wrapper i { position: absolute; left: 15px; color: #999; font-size: 18px; }
        .input-wrapper input { width: 100%; padding: 14px 15px 14px 45px; border: 1px solid #ccc; border-radius: 8px; font-size: 15px; outline: none; transition: all 0.3s; }
        .input-wrapper input:focus { border-color: #b81d24; box-shadow: 0 0 0 3px rgba(184, 29, 36, 0.1); }
        .input-wrapper input[readonly] { background-color: #f5f5f5; color: #777; cursor: not-allowed; }

        .btn-submit { width: 100%; padding: 14px; background: #b81d24; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.3s; margin-top: 10px; }
        .btn-submit:hover { background: #96151a; }
        .text-error { color: #d32f2f; font-size: 13px; margin-top: 5px; display: block; }
    </style>
</head>
<body>

<div class="left-side">
    <div class="brand">
        <div class="brand-logo"><i class="fa-solid fa-box-open"></i></div>
        <div class="brand-title">
            <h1>CourierXpress</h1>
            <span>Logistics</span>
        </div>
    </div>
    <div class="intro-content">
        <h2>Thiết lập<br><span>mật khẩu mới</span></h2>
        <p>Vui lòng cập nhật mật khẩu có độ bảo mật cao để bảo vệ tài khoản giao dịch vận chuyển của bạn.</p>
        <ul class="features">
            <li><i class="fa-solid fa-chart-simple"></i> Hệ thống báo cáo minh bạch</li>
            <li><i class="fa-solid fa-shield-halved"></i> Bảo mật thông tin tuyệt đối</li>
        </ul>
    </div>
    <div></div>
</div>

<div class="right-side">
    <div class="form-container">
        <h2>Đặt lại mật khẩu</h2>
        <p class="subtitle">Nhập mật khẩu mới cho tài khoản của bạn</p>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Địa chỉ Email tài khoản</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required readonly>
                </div>
                @error('email')
                <span class="text-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu mới</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" required placeholder="Nhập tối thiểu 8 ký tự">
                </div>
                @error('password')
                <span class="text-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Nhập lại mật khẩu mới">
                </div>
            </div>

            <button type="submit" class="btn-submit">Xác nhận cập nhật</button>
        </form>
    </div>
</div>

</body>
</html>
