<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>الصفحة الرئيسية</title>
    <!-- Google Fonts Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400&display=swap"
        rel="stylesheet"
    />
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{asset('public/dashboard/css/all.min.css')}}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/dashboard/css/bootstrap.rtl.min.css')}}" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{asset('public/dashboard/css/tables-style.css')}}" />
    <link rel="stylesheet" href="{{asset('public/dashboard/css/home-style.css')}}" />
</head>
<body>
<div class="loading-screen">
    <div
        class="spinner-border text-primary"
        style="width: 3rem; height: 3rem; color: var(--main-color) !important"
        role="status"
    >
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div class="cards-container">
    <div class="my-card info-card row">
        <div class="col">
            <span class="info-count" data-goal="6423">0</span>
            <strong>عدد الشركات</strong>
        </div>
        <div class="col">
            <i class="fa-solid fa-building"></i>
        </div>
    </div>
    <div class="my-card info-card row">
        <div class="col">
            <span class="info-count" data-goal="3000">0</span>
            <strong>عدد الموظفين</strong>
        </div>
        <div class="col">
            <i class="fa-solid fa-users"></i>
        </div>
    </div>
    <div class="my-card info-card row">
        <div class="col">
            <span class="info-count" data-goal="3000">0</span>
            <strong>عدد المحادثات</strong>
        </div>
        <div class="col">
            <i class="fa-solid fa-comments"></i>
        </div>
    </div>
    <div class="my-card info-card row">
        <div class="col">
            <span class="info-count" data-goal="600">0</span>
            <strong>عدد المسجات</strong>
        </div>
        <div class="col">
            <i class="fa-solid fa-message"></i>
        </div>
    </div>
    <div class="my-card chart-container">
        <canvas id="myChart" style="width: 100%; max-width: 700px"></canvas>
    </div>
    <div class="my-card row progress">
        <div class="col progress-info">
            <div class="icon-container">
                <i class="fa-solid fa-comments"></i>
            </div>
            <strong class="progress-title">نسبة المحادثات</strong>
            <strong class="info-count progress-number" data-goal="1000">0</strong>
        </div>
        <div class="col">
            <div class="circular-progress">
                <div class="value-container" data-goal="65">0%</div>
            </div>
        </div>
    </div>
    <div class="my-card row progress">
        <div class="col progress-info">
            <div class="icon-container">
                <i class="fa-solid fa-message"></i>
            </div>
            <strong class="progress-title">نسبة المسجات</strong>
            <strong class="info-count progress-number" data-goal="1000">0</strong>
        </div>
        <div class="col">
            <div class="circular-progress">
                <div class="value-container" data-goal="80">0%</div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('public/dashboard/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('public/dashboard/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/dashboard/js/all.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="{{asset('public/dashboard/js/reports-script.js')}}"></script>
</body>
</html>
