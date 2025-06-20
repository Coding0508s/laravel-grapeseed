<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrapeSEED E-OrderingSystem</title>
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
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar-header {
            text-align: center;
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
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 5px 10px;
            position: relative;
            overflow: hidden;
        }

        .sidebar-nav a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(90, 44, 136, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .sidebar-nav a:hover {
            background-color: #f8f9fa;
            transform: translateX(10px);
            box-shadow: 0 4px 15px rgba(90, 44, 136, 0.2);
            color: #5a2c88;
        }

        .sidebar-nav a:hover::before {
            left: 100%;
        }

        .sidebar-nav a:hover svg {
            transform: rotate(15deg) scale(1.1);
            color: #5a2c88;
        }

        /* 서브메뉴가 있는 메뉴 항목 스타일 */
        .sidebar-nav .menu-item:hover>a {
            background-color: #5a2c88;
            color: white;
        }

        .sidebar-nav .menu-item:hover>a svg {
            color: white;
            transform: rotate(15deg) scale(1.1);
        }

        /* 화살표 회전 효과 */
        .sidebar-nav .menu-item:hover .arrow-down {
            transform: rotate(180deg) !important;
        }

        .sidebar-nav a.active {
            background-color: #5a2c88;
            color: white;
            transform: translateX(5px);
            box-shadow: 0 4px 20px rgba(90, 44, 136, 0.3);
        }

        .sidebar-nav svg {
            transition: all 0.3s ease;
        }



        /* 사이드바 서브메뉴 - 인라인 스타일 */
        .sidebar-nav .menu-item {
            position: relative;
        }

        .sidebar-nav .menu-item .submenu {
            max-height: 0;
            overflow: hidden;
            background-color: #f8f9fa;
            margin: 0 10px;
            border-radius: 0 0 8px 8px;
            transition: all 0.3s ease;
            opacity: 0;
        }

        .sidebar-nav .menu-item:hover .submenu {
            max-height: 300px;
            opacity: 1;
            padding: 10px 0;
        }

        .sidebar-nav .menu-item .submenu a {
            display: block;
            padding: 8px 20px;
            margin: 2px 10px;
            font-size: 13px;
            color: #666;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-nav .menu-item .submenu a:hover {
            background-color: #5a2c88;
            color: white;
            border-left-color: #461e6d;
            transform: translateX(5px);
            box-shadow: 0 2px 8px rgba(90, 44, 136, 0.2);
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            background-color: rgb(19, 163, 39);
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

        .user-actions a,
        .user-actions form button {
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

        .user-actions a:hover,
        .user-actions form button:hover {
            background-color: #461e6d;
        }

        nav ul {
            display: flex;
            list-style: none;
            padding: 15px 5%;
            justify-content: center;
            align-items: center;
            gap: 20px;
            background-color: rgb(133, 95, 170);
        }

        nav ul li {
            margin-right: 20px;
            position: relative;
            transition: all 0.3s ease;
            opacity: 0.8;
            transform: translateY(0);
        }

        nav ul li a {
            padding: 10px 15px;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            display: block;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        nav ul li:hover {
            font-weight: 500;
            background-color: rgb(82, 28, 137);
            border-radius: 10px;
            opacity: 1;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(82, 28, 137, 0.4);
        }

        nav ul li:hover a {
            color: #fff;
            transform: scale(1.05);
        }

        /* 상단 네비게이션 서브메뉴 */
        nav ul li {
            position: relative;
        }

        nav ul li .submenu {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            padding: 15px;
            min-width: 250px;
            opacity: 0;
            visibility: hidden;
            transform: translateX(-50%) translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            gap: 10px;
        }

        nav ul li:hover .submenu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        nav ul li .submenu a {
            padding: 8px 12px;
            margin: 0;
            font-size: 12px;
            color: #666;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.3s ease;
            text-align: center;
            min-width: 70px;
            display: block;
        }

        nav ul li .submenu a:hover {
            background-color: #5a2c88;
            color: white;
            border-color: #5a2c88;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(90, 44, 136, 0.3);
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

        /* Header animation */
        .hero-content>h1 {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            animation: slideup 4s linear infinite;
        }

        .hero-content>div>h1 {
            display: block;
        }

        @keyframes slideup {
            0% {
                opacity: 0;
                margin-top: 50px;
            }

            20% {
                opacity: 1;
                margin-top: 0;
            }

            80% {
                opacity: 1;
                margin-top: 0;
            }

            100% {
                opacity: 0;
                margin-top: 0;
            }
        }

        /* 사이드바 헤더 애니메이션 */
        .sidebar-header>h3>span {
            display: inline-block;
        }

        .sidebar-header span {
         /*    font-weight: 100px; */
            animation: wave 1.3s ease-in-out;
            animation-iteration-count: infinite;
        }

        @keyframes wave {

            0%,
            40%,
            100% {
                transform: translateY(0);
            }

            20% {
                transform: translateY(-15px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .sidebar-header span:nth-child(1) {
            animation-delay: 0.1s;
        }

        .sidebar-header span:nth-child(2) {
            animation-delay: 0.10s;
        }

        .sidebar-header span:nth-child(3) {
            animation-delay: 0.16s;
        }

        .sidebar-header span:nth-child(4) {
            animation-delay: 0.19s;
        }

        .sidebar-header span:nth-child(5) {
            animation-delay: 0.22s;
        }
        .sidebar-header span:nth-child(6) {
            animation-delay: 0.27s;
        }
        .sidebar-header span:nth-child(7) {
            animation-delay: 0.30s;
        }
        .sidebar-header span:nth-child(8) {
            animation-delay: 0.36s;
        }
        .sidebar-header span:nth-child(9) {
            animation-delay: 0.42s;
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
            <h3>
                <span>G</span>
                <span>r</span>
                <span>a</span>
                <span>p</span>
                <span>e</span>
                <span>S</span>
                <span>E</span>
                <span>E</span>
                <span>D</span>
            </h3>
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
            <div class="menu-item">
                <a href="#products">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    상품 관리
                    <svg class="arrow-down" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-left: auto; transition: transform 0.3s ease;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <div class="submenu">
                    <a href="#add-product">상품 등록</a>
                    <a href="#product-list">상품 목록</a>
                    <a href="#edit-product">상품 수정</a>
                    <a href="#inventory">재고 관리</a>
                    <a href="#pricing">가격 관리</a>
                </div>
            </div>
            <!-- <div class="menu-item">
                <a href="#categories">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    카테고리
                    <svg class="arrow-down" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-left: auto; transition: transform 0.3s ease;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <div class="submenu">
                    <a href="#category-manage">카테고리 관리</a>
                    <a href="#category-add">카테고리 추가</a>
                    <a href="#category-sort">정렬 관리</a>
                    <a href="#category-display">진열 설정</a>
                </div>
            </div> -->
            <div class="menu-item">
                <a href="#orders">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    주문 관리
                    <svg class="arrow-down" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-left: auto; transition: transform 0.3s ease;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <div class="submenu">
                    <a href="#orders-list">주문 목록</a>
                    <a href="#orders-status">주문 상태</a>
                    <a href="#shipping">배송 관리</a>
                    <a href="#returns">반품/교환</a>
                    <a href="#payment">결제 관리</a>
                </div>
            </div>
            <div class="menu-item">
                <a href="#customers">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    고객 관리
                    <svg class="arrow-down" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-left: auto; transition: transform 0.3s ease;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <div class="submenu">
                    <a href="#customers-list">고객 목록</a>
                    <a href="#customer-info">고객 정보</a>
                    <a href="#customer-service">고객 서비스</a>
                    <a href="#reviews">리뷰 관리</a>
                    <a href="#loyalty">멤버십</a>
                </div>
            </div>
            <!-- <div class="menu-item">
                <a href="#settings">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    설정
                    <svg class="arrow-down" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-left: auto; transition: transform 0.3s ease;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <div class="submenu">
                    <a href="#general">일반 설정</a>
                    <a href="#security">보안 설정</a>
                    <a href="#notification">알림 설정</a>
                    <a href="#theme">테마 설정</a>
                    <a href="#backup">백업/복원</a>
                </div>
            </div> -->
        </nav>
    </aside>

    <!-- 사이드바 토글 버튼 -->
    <button @click="sidebarOpen = !sidebarOpen" class="sidebar-toggle" :class="{ 'moved': sidebarOpen }">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
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
                    <li>
                        <a href="#home">홈</a>
                        <!--  <div class="submenu">
                            <a href="#dashboard">대시보드</a>
                            <a href="#recent">최근 활동</a>
                            <a href="#quick">빠른 설정</a>
                        </div> -->
                    </li>
                    <li>
                        <a href="#products">상품</a>
                        <!-- div class="submenu">
                            <a href="#add">상품 등록</a>
                            <a href="#list">상품 목록</a>
                            <a href="#category">분류 관리</a>
                            <a href="#inventory">재고 관리</a>
                        </div> -->
                    </li>
                    <li>
                        <a href="#categories">카테고리</a>
                        <!-- <div class="submenu">
                            <a href="#clothing">의류</a>
                            <a href="#shoes">신발</a>
                            <a href="#bags">가방</a>
                            <a href="#accessories">액세서리</a>
                        </div> -->
                    </li>
                    <li>
                        <a href="https://www.grapeseed.com" target="_blank">회사소개</a>
                        <!-- <div class="submenu">
                            <a href="#history">회사 연혁</a>
                            <a href="#team">팀 소개</a>
                            <a href="#vision">비전</a>
                        </div> -->
                    </li>
                    <li>
                        <a href="#contact">고객센터</a>
                        <div class="submenu">
                            <a href="#faq">자주묻는질문</a>
                            <a href="#inquiry">1:1 문의</a>
                            <a href="#support">기술지원</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </header>

        <section class="hero">
            <div class="hero-content">
                <h1>Welcome to GrapeSEED<br>
                    E-Ordering System!<br>
                </h1></br>

                <!-- <p>전 세계 16개국, 900여개의 학교에서약 70,000명의 학생이 GrapeSEED로 영어를 배우고 있습니다.</p> -->
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