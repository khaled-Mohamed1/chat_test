<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>الأنابيب</title>
    <!-- Google Fonts Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400&display=swap"
        rel="stylesheet"
    />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/css/bootstrap.rtl.min.css')}}" />
    <link rel="stylesheet" href="{{asset('dashboard/css/forms-style.css')}}" />
    <style>
        small {
            color: #a4a4a4;
        }
    </style>
</head>
<body>
<div class="table-container section-style">
    <img
        src="
        {{asset('storage/employee/'. $user->image)}}"
        alt="elliot"
        width="150px"
        height="150px"
        style="object-fit: cover; border-radius: 50%; margin-bottom: 30px"
    />
    <div style="padding-right: 20px">
        <div class="row">
            <div class="col-sm-6">
                <small>الاسم:</small>
                <p>{{$user->full_name}}</p>
                <small>رقم الجوال:</small>
                <p>{{$user->phone_NO}}</p>
                <small>المسمى الوظيفي:</small>
                <p>{{$user->job}}</p>
            </div>
            <div class="col-sm-6">
                <small>الايميل:</small>
                <p>{{$user->email}}</p>
                <small>رقم الشركة:</small>
                <p>{{$user->company_NO}}</p>
                <small>اسم الشركة:</small>
                <p>{{$user->company_name}}</p>
            </div>
            <div class="col-sm-12 mt-3">
                <button onclick="history.back()" class="btn btn-secondary" style="display: block; margin-right: auto; width: 80px;">رجوع</button>
            </div>

        </div>

    </div>
</div>
<script src="{{asset('dashboard/js/bootstrap.bundle.min.js')}}"></script>
<script>
    window.onload = function () {
        setTimeout(() => {
            getPaddinglocalStorage();
            window.ondeviceorientation = function () {
                getPaddinglocalStorage();
            };
            window.onresize = function () {
                getPaddinglocalStorage();
            };
        }, 100);
    };
    function getPaddinglocalStorage() {
        if (localStorage.getItem("body-padding-top") == "true") {
            document.body.classList.add("body-padding-top");
        } else {
            document.body.classList.remove("body-padding-top");
        }
    }
</script>
</body>
</html>
