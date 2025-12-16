<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: sans-serif;
        }

        /*=========================================
            TOP BAR
        ==========================================*/
        .top-bar {
            background: #0c3d63;
            padding: 12px 15px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .top-left {
            position: absolute;
            left: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .top-right {
            position: absolute;
            right: 15px;
        }

        /* Hamburger */
        .menu-icon {
            width: 32px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu-icon span {
            height: 3px;
            background: white;
            width: 100%;
            transition: 0.3s;
        }

        /* Cross animation */
        .menu-open span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .menu-open span:nth-child(2) {
            opacity: 0;
        }

        .menu-open span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /*=========================================
            CATEGORY BAR
        ==========================================*/
        .category-bar {
            background: #ddd;
            border-bottom: 1px solid #ccc;
        }

        .category-bar a {
            color: black;
            padding: 12px 15px;
            display: inline-block;
            font-size: 17px;
            text-decoration: none;
        }

        /*=========================================
            TOP WRAPPER (CONTAINER FOR PANEL OVERLAY)
        ==========================================*/
        .top-wrapper {
            position: relative; /* Anchor for absolute positioning */
        }

        /*=========================================
            OVERLAY PANELS (MEGA MENU & SEARCH)
        ==========================================*/
        .mega-menu,
        .search-panel {
            position: absolute;
            top: 100%;     /* directly under the top bar */
            left: 0;
            width: 100%;
            z-index: 999;
            display: none;
        }

        .mega-menu {
            background: #0c3d63;
            color: white;
            padding: 20px;
            animation: fadeSlide 0.3s ease;
        }

        .search-panel {
            background: #0c3d63;
            padding: 20px;
            color: #fff;
            animation: fadeSlide 0.3s ease;
        }

        .mega-section a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 0 4px 0 0;
            border-bottom: 2px solid #ffffff;
        }

        .mega-section a:hover {
            border-bottom: 2px solid #e5f13b;
        }

        .search-icon {
            cursor: pointer;
        }
        .search-input {
            height: 45px;
            border-radius: 6px;
            border: none;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>

            <!-- WRAPPER to anchor dropdown panels -->
            <div class="top-wrapper">

                {{-- TOP BAR --}}
                <div class="top-bar">
                    <div class="top-left">
                        <div class="menu-icon" id="menuToggle">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="date">{{ now()->translatedFormat('l, d F Y') }}</div>
                    </div>

                    <div class="logo fw-bold text-center">বাংলা টেলিগ্রাফ</div>

                    <div class="top-right">
                        <div class="search-icon">🔍</div>
                    </div>
                </div>

                <!-- SEARCH PANEL (OVER CATEGORY BAR) -->
                <div class="search-panel" id="searchPanel">
                    <input type="text" class="form-control search-input" placeholder="অনুসন্ধান করুন...">
                </div>

                <!-- MEGA MENU (OVER CATEGORY BAR) -->
                <div class="mega-menu" id="megaMenu">
                    @foreach ($categories as $category)
                        <div class="row">
                            <div class="col-auto mega-section">
                                <a href="{{ url('subcategory/' . $category->slug) }}">{{ $category->title }}</a>
                            </div>

                            <div class="col-auto mega-section">
                                @if ($category->subCategories->count())
                                    @foreach ($category->subCategories as $sub)
                                        <a href="{{ url('subcategory/' . $sub->slug) }}">{{ $sub->title }}</a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            {{-- CATEGORY BAR (always fixed under top bar) --}}
            <div class="category-bar" id="categoryBar">
                <div class="d-flex justify-content-center flex-wrap">
                    @foreach ($categories as $cat)
                        <a href="{{ url('category/' . $cat->slug) }}">{{ $cat->title }}</a>
                    @endforeach
                </div>
            </div>
        </header>
    </div>

    <script>
        const menuToggle = document.getElementById("menuToggle");
        const megaMenu = document.getElementById("megaMenu");

        const searchIcon = document.querySelector(".search-icon");
        const searchPanel = document.getElementById("searchPanel");

        let menuOpen = false;
        let searchOpen = false;

        // MENU TOGGLE
        menuToggle.addEventListener("click", function () {
            menuOpen = !menuOpen;
            if (menuOpen) {
                menuToggle.classList.add("menu-open");
                megaMenu.style.display = "block";
            } else {
                menuToggle.classList.remove("menu-open");
                megaMenu.style.display = "none";
            }
        });

        // SEARCH TOGGLE
        searchIcon.addEventListener("click", function () {
            searchOpen = !searchOpen;
            searchPanel.style.display = searchOpen ? "block" : "none";
            searchIcon.classList.toggle("search-open", searchOpen);
        });

    </script>

</body>

</html>
