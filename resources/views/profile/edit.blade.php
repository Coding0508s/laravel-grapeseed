<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrapeSEED - 프로필 편집</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #5a2c88;
            margin-bottom: 10px;
        }
        
        h1 {
            font-size: 24px;
            color: #5a2c88;
            margin-bottom: 20px;
        }
        
        .section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .section h2 {
            color: #5a2c88;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .input-group {
            margin-bottom: 15px;
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
            transition: background-color 0.3s;
            margin-right: 10px;
        }
        
        button:hover {
            background-color: #461e6d;
        }
        
        .btn-danger {
            background-color: #dc3545;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
        }
        
        .error-message {
            color: #ff3860;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .success-message {
            color: #28a745;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: #5a2c88;
            text-decoration: none;
            font-weight: bold;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">GrapeSEED</div>
            <h1>프로필 편집</h1>
        </div>

        <div class="section">
            <h2>프로필 정보</h2>
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="input-group">
                    <label for="name">이름(기관명)</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="email">이메일</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                이메일 주소가 인증되지 않았습니다.
                                <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    인증 메일 다시 보내기
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    새로운 인증 링크가 이메일 주소로 전송되었습니다.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="input-group">
                    <label for="phone">전화번호(기관 전화번호)</label>
                    <input id="phone" name="phone" type="tel" value="{{ old('phone', $user->phone) }}" placeholder="010-0000-0000">
                    @error('phone')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit">저장</button>

                @if (session('status') === 'profile-updated')
                    <div class="success-message">저장되었습니다.</div>
                @endif
            </form>
        </div>

        <div class="section">
            <h2>비밀번호 변경</h2>
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="input-group">
                    <label for="update_password_current_password">현재 비밀번호</label>
                    <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password">
                    @error('current_password', 'updatePassword')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="update_password_password">새 비밀번호</label>
                    <input id="update_password_password" name="password" type="password" autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="update_password_password_confirmation">새 비밀번호 확인</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                    @error('password_confirmation', 'updatePassword')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit">비밀번호 변경</button>

                @if (session('status') === 'password-updated')
                    <div class="success-message">비밀번호가 변경되었습니다.</div>
                @endif
            </form>
        </div>

        <div class="section">
            <h2>계정 삭제</h2>
            <p>계정을 삭제하면 모든 데이터가 영구적으로 삭제됩니다. 계속하기 전에 보관하고 싶은 데이터나 정보를 다운로드하세요.</p>
            
            <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('정말로 계정을 삭제하시겠습니까? 이 작업은 되돌릴 수 없습니다.')">
                @csrf
                @method('delete')

                <div class="input-group">
                    <label for="password">비밀번호를 입력하여 계정 삭제를 확인하세요</label>
                    <input id="password" name="password" type="password" placeholder="비밀번호">
                    @error('password', 'userDeletion')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-danger">계정 삭제</button>
            </form>
        </div>

        <div class="back-link">
            <a href="{{ route('dashboard') }}">← 메인으로 돌아가기</a>
        </div>
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
    @endif
</body>
</html>
