<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrapeSEED - 회원가입</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }
        
        .signup-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
            text-align: center;
            margin: 20px;
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
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #461e6d;
        }
        
        .login-link {
            margin-top: 20px;
            font-size: 14px;
        }
        
        .login-link a {
            color: #5a2c88;
            text-decoration: none;
            font-weight: bold;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: #ff3860;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="logo">GrapeSEED</div>
        <h1>GrapeSEED 회원가입</h1>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="input-group">
                <label for="name">이름(기관명)</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="email">이메일</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="phone">전화번호(기관 전화번호)</label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" placeholder="010-0000-0000" required>
                @error('phone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="password">비밀번호</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="password_confirmation">비밀번호 확인</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit">회원가입</button>
        </form>
        
        <div class="login-link">
            이미 계정이 있으신가요? <a href="{{ route('login') }}">로그인하기</a>
        </div>
    </div>
</body>
</html>
