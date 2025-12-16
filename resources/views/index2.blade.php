<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- <style>
        body {
            margin: 0;
            font-family: sans-serif;
        }

        /* Top bar */
        .top-bar {
            background: #0c3d63;
            color: white;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            justify-content: space-between;
            position: relative;
        }

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

        /* Category Bar */
        .category-bar {
            background: white;
            border-bottom: 1px solid #ddd;
        }

        .category-bar ul {
            margin: 0;
            padding: 10px;
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 20px;
            overflow-x: auto;
        }

        .category-bar a {
            color: black;
            font-size: 18px;
            text-decoration: none;
        }

        /* Mega menu (hidden by default) */
        .mega-menu {
            display: none;
            background: #0c3d63;
            padding: 20px;
            color: white;
        }

        .mega-section {
            border-bottom: 1px solid #144872;
            padding: 10px 0;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .mega-section a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .mega-section a:hover {
            text-decoration: underline;
        }

        /* Cross icon animation */
        .menu-open span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .menu-open span:nth-child(2) {
            opacity: 0;
        }

        .menu-open span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .logo {
                font-size: 18px;
            }

            .category-bar ul {
                flex-wrap: nowrap;
            }
        }
    </style> --}}
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
        }

        .top-bar {
            background: #0c3d63;
            padding: 12px 15px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            /* KEEP LOGO IN CENTER */
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

        /* Toggle */
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

        /* Cross Animation */
        .menu-open span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .menu-open span:nth-child(2) {
            opacity: 0;
        }

        .menu-open span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /* Category bar */
        .category-bar {
            background: ddd;
            border-bottom: 1px solid #ddd;
        }

        .category-bar a {
            color: black;
            padding: 12px 15px;
            display: inline-block;
            font-size: 17px;
            text-decoration: none;
        }

        /* Mega menu */
        .mega-menu {
            margin-top: 1px;
            display: none;
            background: #0c3d63;
            color: white;
            padding: 20px;
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
    </style>
</head>

<body>
    <div class="container">
        <header>
            {{-- TOP BAR --}}
            <div class="top-bar">

                {{-- LEFT side --}}
                <div class="top-left">
                    <div class="menu-icon" id="menuToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div class="date">{{ now()->translatedFormat('l, d F Y') }}</div>
                </div>

                {{-- CENTER - LOGO --}}
                <div class="logo fw-bold text-center">বাংলা টেলিগ্রাফ</div>

                {{-- RIGHT side --}}
                <div class="top-right">
                    <div class="search-icon">🔍</div>
                </div>

            </div>


            {{-- CATEGORY BAR --}}
            <div class="category-bar" id="categoryBar">
                <div class="d-flex justify-content-center flex-wrap">
                    @foreach ($categories as $cat)
                        <a href="{{ url('category/' . $cat->slug) }}">{{ $cat->title }}</a>
                    @endforeach
                </div>
            </div>

            {{-- MEGA MENU --}}

            <div class="mega-menu" id="megaMenu">
                @foreach ($categories as $category)
                    <div class="row">

                        {{-- LEFT SIDE CATEGORY TITLE --}}
                        <div class="col-auto mega-section">
                            <a href="{{ url('subcategory/' . $category->slug) }}">{{ $category->title }}</a>
                        </div>

                        {{-- RIGHT SIDE SUBCATEGORIES --}}
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

        </header>
    </div>

    {{-- <script>
        const menuToggle = document.getElementById("menuToggle");
        const megaMenu = document.getElementById("megaMenu");
        const categoryBar = document.getElementById("categoryBar");

        let menuOpen = false;

        menuToggle.addEventListener("click", function() {
            menuOpen = !menuOpen;

            if (menuOpen) {
                menuToggle.classList.add("menu-open");
                megaMenu.style.display = "block";
                categoryBar.style.display = "none";
            } else {
                menuToggle.classList.remove("menu-open");
                megaMenu.style.display = "none";
                categoryBar.style.display = "block";
            }
        });
    </script> --}}
    <script>
    const menuToggle = document.getElementById("menuToggle");
    const megaMenu = document.getElementById("megaMenu");
    const categoryBar = document.getElementById("categoryBar");

    const searchIcon = document.querySelector(".search-icon");
    const searchPanel = document.getElementById("searchPanel");

    let menuOpen = false;
    let searchOpen = false;

    // HELPER — controls category bar visibility
    function updateCategoryBar() {
        if (!menuOpen || !searchOpen) {
            categoryBar.style.display = "block";   // show only if both menus closed
        } else {
            categoryBar.style.display = "none";    // hide otherwise
        }
    }

    // MENU TOGGLE
    menuToggle.addEventListener("click", function () {
        menuOpen = !menuOpen;

        if (menuOpen) {
            menuToggle.classList.add("menu-open");
            megaMenu.style.display = "block";

            // Close search if open
            searchOpen = false;
            searchPanel.style.display = "none";
        } else {
            menuToggle.classList.remove("menu-open");
            megaMenu.style.display = "none";
        }

        updateCategoryBar();
    });

    // SEARCH TOGGLE
    searchIcon.addEventListener("click", function () {
        searchOpen = !searchOpen;

        if (searchOpen) {
            searchPanel.style.display = "block";

            // Close mega menu if open
            menuOpen = false;
            megaMenu.style.display = "none";
            menuToggle.classList.remove("menu-open");
        } else {
            searchPanel.style.display = "none";
        }

        updateCategoryBar();
    });
</script>

</body>

</html>
