<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrapeSEED - Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        
        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 350px;
            text-align: center;
        }
        
        .logo {
            margin-bottom: 20px;
            font-size: 32px;
            font-weight: bold;
            color: #5a2c88;
        }
        
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #5a2c88;
        }
        
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #5a2c88;
        }
        
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        input:focus {
            outline: none;
            border-color: #5a2c88;
            box-shadow: 0 0 5px rgba(90, 44, 136, 0.2);
        }
        
        button {
            background-color: #5a2c88;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #461e6d;
        }
        
        .forgot-password {
            margin-top: 15px;
            font-size: 14px;
        }
        
        .forgot-password a {
            color: #5a2c88;
            text-decoration: none;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .signup-link {
            margin-top: 20px;
            font-size: 14px;
        }
        
        .signup-link a {
            color: #5a2c88;
            font-weight: bold;
            text-decoration: none;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: #ff3860;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        
        .remember-me input[type="checkbox"] {
            width: auto;
            margin-right: 8px;
        }
        
        .remember-me label {
            color: #333;
            font-weight: normal;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">GrapeSEED</div>
        <h1>Welcome to GrapeSEED</h1>
    
        <!-- Session Status -->
        @if (session('status'))
            <div class="error-message">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="input-group">
                <label for="email">이메일</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="이메일을 입력하세요" required autofocus autocomplete="username">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="password">비밀번호</label>
                <input id="password" type="password" name="password" placeholder="비밀번호를 입력하세요" required autocomplete="current-password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="remember-me">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">로그인 상태 유지</label>
            </div>
            
            <button type="submit">로그인</button>
        </form>
        
        @if (Route::has('password.request'))
            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
        @endif
        
        <div class="signup-link">
            New to GrapeSEED? <a href="{{ route('register') }}">Create an account</a>
        </div>
    </div>
</body>
</html>
