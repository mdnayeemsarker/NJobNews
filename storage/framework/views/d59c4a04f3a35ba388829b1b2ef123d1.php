<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    
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
            
            <div class="top-bar">
                
                <div class="top-left">
                    <div class="menu-icon" id="menuToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div class="date"><?php echo e(now()->translatedFormat('l, d F Y')); ?></div>
                </div>
                
                <div class="logo fw-bold text-center">বাংলা টেলিগ্রাফ</div>
                
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

            
            <div class="mega-menu" id="megaMenu">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">

                        
                        <div class="col-auto mega-section">
                            <a href="<?php echo e(url('subcategory/' . $category->slug)); ?>"><?php echo e($category->title); ?></a>
                        </div>

                        
                        <div class="col-auto mega-section">
                            <?php if($category->subCategories->count()): ?>
                                <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(url('subcategory/' . $sub->slug)); ?>"><?php echo e($sub->title); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </header>

        
        <div class="category-bar" id="categoryBar">
            <div class="d-flex justify-content-center flex-wrap">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(url('category/' . $cat->slug)); ?>"><?php echo e($cat->title); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <script>
        const menuToggle = document.getElementById("menuToggle");
        const megaMenu = document.getElementById("megaMenu");
        const categoryBar = document.getElementById("categoryBar");

        const searchIcon = document.querySelector(".search-icon");
        const searchPanel = document.getElementById("searchPanel");

        let menuOpen = false;
        let searchOpen = false;

        // Initialize
        updatePanels();

        function updatePanels() {
            // Category bar is hidden if any panel is open
            categoryBar.style.display = (menuOpen || searchOpen) ? "none" : "block";

            // Mega menu
            megaMenu.style.display = menuOpen ? "block" : "none";
            menuToggle.classList.toggle("menu-open", menuOpen);

            // Search panel
            searchPanel.style.display = searchOpen ? "block" : "none";
        }

        // Mega menu toggle
        menuToggle.addEventListener("click", function() {
            menuOpen = !menuOpen;
            if (menuOpen) searchOpen = false; // close search if opening menu
            updatePanels();
        });

        // Search toggle
        searchIcon.addEventListener("click", function() {
            searchOpen = !searchOpen;
            if (searchOpen) menuOpen = false; // close menu if opening search
            updatePanels();
        });
    </script>

</body>

</html>
<?php /**PATH /var/www/html/Njobs/resources/views/index.blade.php ENDPATH**/ ?>