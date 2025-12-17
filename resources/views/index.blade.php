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

        .search-icon {
            cursor: pointer;
        }
        .search-panel {
            margin-top: 1px;
            display: none;
            background: #0c3d63;
            padding: 5px;
            color: #fff;
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
            {{-- TOP BAR --}}
            <div class="top-bar">
                {{-- LEFT side --}}
                <div class="top-left">
                    <div class="date">{{ now()->translatedFormat('l, d F Y') }}</div>
                </div>
                {{-- CENTER - LOGO --}}
                <div class="logo fw-bold text-center">বাংলা টেলিগ্রাফ</div>
                {{-- RIGHT side --}}
                <div class="top-right">
                    <div class="search-icon">🔍</div>
                </div>
            </div>

            <!-- SEARCH PANEL -->
            <div class="search-panel" id="searchPanel">
                <div class="container">
                </div>
                <form action="" method="get"></form>
                <input type="text" class="form-control search-input" placeholder="অনুসন্ধান করুন...">
            </div>

        </header>

        {{-- CATEGORY BAR --}}
        <div class="category-bar" id="categoryBar">
            <div class="d-flex justify-content-center flex-wrap">
                @foreach ($categories as $cat)
                    <a href="{{ url('category/' . $cat->slug) }}">{{ $cat->title }}</a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        const categoryBar = document.getElementById("categoryBar");
        const searchIcon = document.querySelector(".search-icon");
        const searchPanel = document.getElementById("searchPanel");

        let menuOpen = false;
        let searchOpen = false;

        // Initialize
        updatePanels();

        function updatePanels() {
            // Category bar is hidden if any panel is open
            categoryBar.style.display = (searchOpen) ? "none" : "block";

            // Search panel
            searchPanel.style.display = searchOpen ? "block" : "none";
        }

        // Search toggle
        searchIcon.addEventListener("click", function() {
            searchOpen = !searchOpen;
            if (searchOpen) menuOpen = false; // close menu if opening search
            updatePanels();
        });
    </script>

</body>

</html>
