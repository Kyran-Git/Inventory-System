<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="sidebar.css">
    <title>Inventory Dashboard</title>
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .home {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logo {
            display: flex;
            flex-direction: row;
            align-items: center;
            width: 50px;
            height: 50px;
            background-color: #181919;
            border-radius: 50%;
            margin-right: 10px;
        }


        .loader {
        --duration: 3s;
        --primary: rgba(39, 94, 254, 1);
        --primary-light: #2f71ff;
        --primary-rgba: rgba(39, 94, 254, 0);
        width: 200px;
        height: 320px;
        position: relative;
        transform-style: preserve-3d;
        }

        @media (max-width: 480px) {
        .loader {
            zoom: 0.44;
        }
        }

        .loader:before, .loader:after {
        --r: 20.5deg;
        content: "";
        width: 320px;
        height: 140px;
        position: absolute;
        right: 32%;
        bottom: -11px;
        background: #18191a;
        transform: translateZ(200px) rotate(var(--r));
        -webkit-animation: mask var(--duration) linear forwards infinite;
        animation: mask var(--duration) linear forwards infinite;
        }

        .loader:after {
        --r: -20.5deg;
        right: auto;
        left: 32%;
        }

        .loader .ground {
        position: absolute;
        left: -50px;
        bottom: -120px;
        transform-style: preserve-3d;
        transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }

        .loader .ground div {
        transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(0);
        width: 200px;
        height: 200px;
        background: var(--primary);
        background: linear-gradient(45deg, var(--primary) 0%, var(--primary) 50%, var(--primary-light) 50%, var(--primary-light) 100%);
        transform-style: preserve-3d;
        -webkit-animation: ground var(--duration) linear forwards infinite;
        animation: ground var(--duration) linear forwards infinite;
        }

        .loader .ground div:before, .loader .ground div:after {
        --rx: 90deg;
        --ry: 0deg;
        --x: 44px;
        --y: 162px;
        --z: -50px;
        content: "";
        width: 156px;
        height: 300px;
        opacity: 0;
        background: linear-gradient(var(--primary), var(--primary-rgba));
        position: absolute;
        transform: rotateX(var(--rx)) rotateY(var(--ry)) translate(var(--x), var(--y)) translateZ(var(--z));
        -webkit-animation: ground-shine var(--duration) linear forwards infinite;
        animation: ground-shine var(--duration) linear forwards infinite;
        }

        .loader .ground div:after {
        --rx: 90deg;
        --ry: 90deg;
        --x: 0;
        --y: 177px;
        --z: 150px;
        }

        .loader .box {
        --x: 0;
        --y: 0;
        position: absolute;
        -webkit-animation: var(--duration) linear forwards infinite;
        animation: var(--duration) linear forwards infinite;
        transform: translate(var(--x), var(--y));
        }

        .loader .box div {
        background-color: var(--primary);
        width: 48px;
        height: 48px;
        position: relative;
        transform-style: preserve-3d;
        -webkit-animation: var(--duration) ease forwards infinite;
        animation: var(--duration) ease forwards infinite;
        transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        .loader .box div:before, .loader .box div:after {
        --rx: 90deg;
        --ry: 0deg;
        --z: 24px;
        --y: -24px;
        --x: 0;
        content: "";
        position: absolute;
        background-color: inherit;
        width: inherit;
        height: inherit;
        transform: rotateX(var(--rx)) rotateY(var(--ry)) translate(var(--x), var(--y)) translateZ(var(--z));
        filter: brightness(var(--b, 1.2));
        }

        .loader .box div:after {
        --rx: 0deg;
        --ry: 90deg;
        --x: 24px;
        --y: 0;
        --b: 1.4;
        }

        .loader .box.box0 {
        --x: -220px;
        --y: -120px;
        left: 58px;
        top: 108px;
        }

        .loader .box.box1 {
        --x: -260px;
        --y: 120px;
        left: 25px;
        top: 120px;
        }

        .loader .box.box2 {
        --x: 120px;
        --y: -190px;
        left: 58px;
        top: 64px;
        }

        .loader .box.box3 {
        --x: 280px;
        --y: -40px;
        left: 91px;
        top: 120px;
        }

        .loader .box.box4 {
        --x: 60px;
        --y: 200px;
        left: 58px;
        top: 132px;
        }

        .loader .box.box5 {
        --x: -220px;
        --y: -120px;
        left: 25px;
        top: 76px;
        }

        .loader .box.box6 {
        --x: -260px;
        --y: 120px;
        left: 91px;
        top: 76px;
        }

        .loader .box.box7 {
        --x: -240px;
        --y: 200px;
        left: 58px;
        top: 87px;
        }

        .loader .box0 {
        -webkit-animation-name: box-move0;
        animation-name: box-move0;
        }

        .loader .box0 div {
        -webkit-animation-name: box-scale0;
        animation-name: box-scale0;
        }

        .loader .box1 {
        -webkit-animation-name: box-move1;
        animation-name: box-move1;
        }

        .loader .box1 div {
        -webkit-animation-name: box-scale1;
        animation-name: box-scale1;
        }

        .loader .box2 {
        -webkit-animation-name: box-move2;
        animation-name: box-move2;
        }

        .loader .box2 div {
        -webkit-animation-name: box-scale2;
        animation-name: box-scale2;
        }

        .loader .box3 {
        -webkit-animation-name: box-move3;
        animation-name: box-move3;
        }

        .loader .box3 div {
        -webkit-animation-name: box-scale3;
        animation-name: box-scale3;
        }

        .loader .box4 {
        -webkit-animation-name: box-move4;
        animation-name: box-move4;
        }

        .loader .box4 div {
        -webkit-animation-name: box-scale4;
        animation-name: box-scale4;
        }

        .loader .box5 {
        -webkit-animation-name: box-move5;
        animation-name: box-move5;
        }

        .loader .box5 div {
        -webkit-animation-name: box-scale5;
        animation-name: box-scale5;
        }

        .loader .box6 {
        -webkit-animation-name: box-move6;
        animation-name: box-move6;
        }

        .loader .box6 div {
        -webkit-animation-name: box-scale6;
        animation-name: box-scale6;
        }

        .loader .box7 {
        -webkit-animation-name: box-move7;
        animation-name: box-move7;
        }

        .loader .box7 div {
        -webkit-animation-name: box-scale7;
        animation-name: box-scale7;
        }

        @-webkit-keyframes box-move0 {
        12% {
            transform: translate(var(--x), var(--y));
        }

        25%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @keyframes box-move0 {
        12% {
            transform: translate(var(--x), var(--y));
        }

        25%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @-webkit-keyframes box-scale0 {
        6% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        14%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @keyframes box-scale0 {
        6% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        14%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @-webkit-keyframes box-move1 {
        16% {
            transform: translate(var(--x), var(--y));
        }

        29%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @keyframes box-move1 {
        16% {
            transform: translate(var(--x), var(--y));
        }

        29%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @-webkit-keyframes box-scale1 {
        10% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        18%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @keyframes box-scale1 {
        10% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        18%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @-webkit-keyframes box-move2 {
        20% {
            transform: translate(var(--x), var(--y));
        }

        33%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @keyframes box-move2 {
        20% {
            transform: translate(var(--x), var(--y));
        }

        33%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @-webkit-keyframes box-scale2 {
        14% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        22%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @keyframes box-scale2 {
        14% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        22%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @-webkit-keyframes box-move3 {
        24% {
            transform: translate(var(--x), var(--y));
        }

        37%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @keyframes box-move3 {
        24% {
            transform: translate(var(--x), var(--y));
        }

        37%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @-webkit-keyframes box-scale3 {
        18% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        26%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @keyframes box-scale3 {
        18% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        26%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @-webkit-keyframes box-move4 {
        28% {
            transform: translate(var(--x), var(--y));
        }

        41%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @keyframes box-move4 {
        28% {
            transform: translate(var(--x), var(--y));
        }

        41%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @-webkit-keyframes box-scale4 {
        22% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        30%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @keyframes box-scale4 {
        22% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        30%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @-webkit-keyframes box-move5 {
        32% {
            transform: translate(var(--x), var(--y));
        }

        45%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @keyframes box-move5 {
        32% {
            transform: translate(var(--x), var(--y));
        }

        45%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @-webkit-keyframes box-scale5 {
        26% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        34%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @keyframes box-scale5 {
        26% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        34%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @-webkit-keyframes box-move6 {
        36% {
            transform: translate(var(--x), var(--y));
        }

        49%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @keyframes box-move6 {
        36% {
            transform: translate(var(--x), var(--y));
        }

        49%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @-webkit-keyframes box-scale6 {
        30% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        38%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @keyframes box-scale6 {
        30% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        38%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @-webkit-keyframes box-move7 {
        40% {
            transform: translate(var(--x), var(--y));
        }

        53%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @keyframes box-move7 {
        40% {
            transform: translate(var(--x), var(--y));
        }

        53%, 52% {
            transform: translate(0, 0);
        }

        80% {
            transform: translate(0, -32px);
        }

        90%, 100% {
            transform: translate(0, 188px);
        }
        }

        @-webkit-keyframes box-scale7 {
        34% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        42%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @keyframes box-scale7 {
        34% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
        }

        42%, 100% {
            transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
        }
        }

        @-webkit-keyframes ground {
        0%, 65% {
            transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(0);
        }

        75%, 90% {
            transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(1);
        }

        100% {
            transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(0);
        }
        }

        @keyframes ground {
        0%, 65% {
            transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(0);
        }

        75%, 90% {
            transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(1);
        }

        100% {
            transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(0);
        }
        }

        @-webkit-keyframes ground-shine {
        0%, 70% {
            opacity: 0;
        }

        75%, 87% {
            opacity: 0.2;
        }

        100% {
            opacity: 0;
        }
        }

        @keyframes ground-shine {
        0%, 70% {
            opacity: 0;
        }

        75%, 87% {
            opacity: 0.2;
        }

        100% {
            opacity: 0;
        }
        }

        @-webkit-keyframes mask {
        0%, 65% {
            opacity: 0;
        }

        66%, 100% {
            opacity: 1;
        }
        }

        @keyframes mask {
        0%, 65% {
            opacity: 0;
        }

        66%, 100% {
            opacity: 1;
        }
        }

    </style>
</head>
<body class="dark">
    <nav class="sidebar close">
        <header>
            <div class="image-text">
            <span><img src="layout\ozelLogo.jpg" alt="ozel chempaka logo" class="logo"></span>
                <div class="text logo-text">
                    <span class="name">OZEL CHEMPAKA</span>
                    <span class="profession">Inventory System</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links">
                <li class="nav-link">
                        <a href="home.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="sales.php">
                            <i class='bx bx-bar-chart-alt-2 icon' ></i>
                            <span class="text nav-text">Sales</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="sales_report.php">
                            <i class='bx bxs-wallet-alt icon'></i>
                            <span class="text nav-text">Sales Report</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="users.php">
                            <i class='bx bx-user-plus icon' ></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="products.php">
                            <i class='bx bxs-package icon'></i>
                            <span class="text nav-text">Products</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="about.html">
                        <i class='bx bxs-info-circle icon'></i>
                            <span class="text nav-text">About Us</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="logout.php">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>

    </nav>

    <section class="home">
        <div class="container">
            <div class="loader">
                <div class="box box0">
                    <div></div>
                </div>
                <div class="box box1">
                    <div></div>
                </div>
                <div class="box box2">
                    <div></div>
                </div>
                <div class="box box3">
                    <div></div>
                </div>
                <div class="box box4">
                    <div></div>
                </div>
                <div class="box box5">
                    <div></div>
                </div>
                <div class="box box6">
                    <div></div>
                </div>
                <div class="box box7">
                    <div></div>
                </div>
                <div class="ground">
                    <div></div>
                </div>
                </div>
        </div>
    </section>

    <script>
        const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");


toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})


modeSwitch.addEventListener("click" , () =>{
    body.classList.toggle("dark");
    
    if(body.classList.contains("dark")){
        modeText.innerText = "Light mode";
    }else{
        modeText.innerText = "Dark mode";
        
    }
});
    </script>

</body>
</html>