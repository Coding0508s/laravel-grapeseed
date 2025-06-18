<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrapeSEED - 스타일 쇼핑몰</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
        }
        
        header {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            border-bottom: 1px solid #eee;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #5a2c88;
        }
        
        .search-bar {
            display: flex;
            width: 40%;
        }
        
        .search-bar input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
        }
        
        .search-bar button {
            padding: 10px 15px;
            background-color: #5a2c88;
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info {
            color: #5a2c88;
            font-weight: bold;
        }
        
        .user-actions a, .user-actions form button {
            margin-left: 10px;
            color: #333;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            background-color: #5a2c88;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        
        .user-actions a:hover, .user-actions form button:hover {
            background-color: #461e6d;
        }
        
        nav ul {
            display: flex;
            list-style: none;
            padding: 15px 5%;
        }
        
        nav ul li {
            margin-right: 20px;
        }
        
        nav ul li a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }
        
        .hero {
            background: linear-gradient(135deg, #5a2c88, #461e6d);
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        
        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        
        .hero-content p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        
        .btn {
            padding: 12px 25px;
            background-color: #fff;
            color: #5a2c88;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
        }
        
        .products {
            padding: 50px 5%;
        }
        
        .section-title {
            font-size: 28px;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .product-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-image {
            height: 200px;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #666;
        }
        
        .product-info {
            padding: 15px;
        }
        
        .product-title {
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        .product-price {
            font-weight: bold;
            color: #5a2c88;
        }
        
        .categories {
            background-color: #f1f1f1;
            padding: 50px 5%;
        }
        
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .category-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
        }
        
        .category-image {
            height: 150px;
            background-color: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #666;
        }
        
        .category-name {
            padding: 15px;
        }
        
        footer {
            background-color: #333;
            color: white;
            padding: 30px 5%;
            margin-top: 50px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .footer-section h3 {
            margin-bottom: 15px;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 8px;
        }
        
        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
        }
        
        .footer-section ul li a:hover {
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-top">
            <div class="logo">GrapeSEED</div>
            <div class="search-bar">
                <input type="text" placeholder="상품을 검색하세요...">
                <button type="submit">검색</button>
            </div>
            <div class="user-actions">
                <div class="user-info">{{ Auth::user()->name }}님 환영합니다!</div>
                <a href="{{ route('profile.edit') }}">프로필</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit">로그아웃</button>
                </form>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#home">홈</a></li>
                <li><a href="#products">상품</a></li>
                <li><a href="#categories">카테고리</a></li>
                <li><a href="#about">회사소개</a></li>
                <li><a href="#contact">고객센터</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to GrapeSEED</h1>
            <p>최고의 품질과 스타일을 제공하는 온라인 쇼핑몰</p>
            <a href="#products" class="btn">쇼핑하기</a>
        </div>
    </section>

    <section class="products" id="products">
        <h2 class="section-title">인기 상품</h2>
        <div class="product-grid">
            <div class="product-card">
                <div class="product-image">상품 이미지</div>
                <div class="product-info">
                    <div class="product-title">프리미엄 티셔츠</div>
                    <div class="product-price">29,000원</div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">상품 이미지</div>
                <div class="product-info">
                    <div class="product-title">데님 재킷</div>
                    <div class="product-price">89,000원</div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">상품 이미지</div>
                <div class="product-info">
                    <div class="product-title">스니커즈</div>
                    <div class="product-price">129,000원</div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">상품 이미지</div>
                <div class="product-info">
                    <div class="product-title">크로스백</div>
                    <div class="product-price">59,000원</div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">상품 이미지</div>
                <div class="product-info">
                    <div class="product-title">원피스</div>
                    <div class="product-price">79,000원</div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">상품 이미지</div>
                <div class="product-info">
                    <div class="product-title">부츠</div>
                    <div class="product-price">159,000원</div>
                </div>
            </div>
        </div>
    </section>

    <section class="categories" id="categories">
        <h2 class="section-title">카테고리</h2>
        <div class="category-grid">
            <div class="category-card">
                <div class="category-image">의류</div>
                <div class="category-name">의류</div>
            </div>
            <div class="category-card">
                <div class="category-image">신발</div>
                <div class="category-name">신발</div>
            </div>
            <div class="category-card">
                <div class="category-image">가방</div>
                <div class="category-name">가방</div>
            </div>
            <div class="category-card">
                <div class="category-image">액세서리</div>
                <div class="category-name">액세서리</div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>회사정보</h3>
                <ul>
                    <li><a href="#">회사소개</a></li>
                    <li><a href="#">채용정보</a></li>
                    <li><a href="#">이용약관</a></li>
                    <li><a href="#">개인정보처리방침</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>고객센터</h3>
                <ul>
                    <li><a href="#">공지사항</a></li>
                    <li><a href="#">자주묻는질문</a></li>
                    <li><a href="#">1:1 문의</a></li>
                    <li><a href="#">상품문의</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>쇼핑안내</h3>
                <ul>
                    <li><a href="#">주문/결제</a></li>
                    <li><a href="#">배송안내</a></li>
                    <li><a href="#">교환/반품</a></li>
                    <li><a href="#">환불안내</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>사용자 정보</h3>
                <ul>
                    <li>이름: {{ Auth::user()->name }}</li>
                    <li>이메일: {{ Auth::user()->email }}</li>
                    <li>전화번호: {{ Auth::user()->phone }}</li>
                    <li>가입일: {{ Auth::user()->created_at->format('Y-m-d') }}</li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>
