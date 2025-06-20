<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrapeSEED - 스타일 쇼핑몰</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
        
        /* 사이드바 스타일 */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 250px;
            background-color: #fff;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }
        
        .sidebar.hidden {
            transform: translateX(-100%);
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            background-color: #5a2c88;
            color: white;
        }
        
        .sidebar-nav {
            padding: 20px 0;
        }
        
        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .sidebar-nav a:hover {
            background-color: #f8f9fa;
        }
        
        .sidebar-nav a.active {
            background-color: #5a2c88;
            color: white;
        }
        
        .sidebar-nav svg {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }
        
        /* 메인 콘텐츠 영역 */
        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }
        
        .main-content.expanded {
            margin-left: 0;
        }
        
        /* 사이드바 토글 버튼 */
        .sidebar-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background-color: #5a2c88;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: left 0.3s ease;
        }
        
        .sidebar-toggle.moved {
            left: 270px;
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
            width: 20%;
            font-weight: bold;
        }
        .search-bar button:hover {
            background-color:rgb(19, 163, 39);
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
            justify-content: center;
            align-items: center;
            gap: 20px;
            background-color:rgb(133, 95, 170);
        }
        
        nav ul li {
            margin-right: 20px;
        }
        
        nav ul li a {
            padding: 10px;
            color:#fff;
            text-decoration: none;
            font-weight: 500;
        }
        
        nav ul li:hover {
            font-weight: 500;
            background-color:rgb(82, 28, 137);
            border-radius: 10px;
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
            justify-content: center;
            align-items: center;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 50px;
            margin-left: 100px;
            margin-right: 100px;
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
        
        /* 반응형 */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar-toggle {
                left: 20px;
            }
        }
    </style>
</head>
<body x-data="{ sidebarOpen: true }">
    <!-- 사이드바 -->
    <aside class="sidebar" :class="{ 'hidden': !sidebarOpen }">
        <div class="sidebar-header">
            <h3>GrapeSEED 메뉴</h3>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                </svg>
                대시보드
            </a>
            <a href="{{ route('profile.edit') }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                프로필
            </a>
            <a href="#products">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                상품 관리
            </a>
            <a href="#categories">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                카테고리
            </a>
            <a href="#orders">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                주문 관리
            </a>
            <a href="#customers">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                고객 관리
            </a>
            <a href="#settings">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                설정
            </a>
        </nav>
    </aside>

    <!-- 사이드바 토글 버튼 -->
    <button @click="sidebarOpen = !sidebarOpen" class="sidebar-toggle" :class="{ 'moved': sidebarOpen }">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>

    <!-- 메인 콘텐츠 -->
    <div class="main-content" :class="{ 'expanded': !sidebarOpen }">
        <header>
            <div class="header-top">
                <div class="logo"><img src="{{ asset('images/logo.png') }}" alt="GrapeSEED"></div>
                <div class="search-bar">
                    <input type="text" placeholder="상품을 검색하세요...">
                    <button type="submit">검색</button>
                </div>
                <div class="user-actions">
                    <div class="user-info">{{ Auth::user()->name }}님 환영합니다!</div>
                    <a href="{{ route('profile.edit') }}">회원정보</a>
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
                <h1>Welcome to GrapeSEED</h1></br>
                <p>전 세계 16개국, 900여개의 학교에서약 70,000명의 학생이 GrapeSEED로 영어를 배우고 있습니다.</p>
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
                        <li>전화번호: {{ Auth::user()->phone ?? '미등록' }}</li>
                        <li>가입일: {{ Auth::user()->created_at->format('Y-m-d') }}</li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
