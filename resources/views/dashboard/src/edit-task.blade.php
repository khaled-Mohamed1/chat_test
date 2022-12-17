<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vela: المهام تعديل</title>
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
</head>
<body>
<div class="table-container section-style">
    <form
        method="POST"
        action="{{route('tasks.update',['task'=>$task])}}"
        class="row"
        style="row-gap: 20px"
        onsubmit="(e)=>e.preventDefault()"
    >
        @csrf
        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">العنوان</label>
            <input type="text" value="{{$task->title}}" name="title" class="form-control @error('title') is-invalid @enderror" id="inputEmail4" placeholder="عنوان المهمة" />
            @error('title')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="start" class="form-label">تاريخ البداية</label>
            <input type="date" value="{{$task->start_date}}" name="start_date" class="form-control @error('start_date') is-invalid @enderror" id="start" />
            @error('start_date')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="end" class="form-label">تاريخ النهاية</label>
            <input type="date" value="{{$task->end_date}}" name="end_date" class="form-control @error('end_date') is-invalid @enderror" id="end" />
            @error('end_date')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-12">
            <label for="desc" class="form-label">الوصف</label>
            <textarea
                name="description"
                id="desc"
                cols="20"
                rows="5"
                class="form-control @error('description') is-invalid @enderror"
                placeholder="وصف المهمة"
            >{{$task->description}}</textarea>

            @error('description')
            <span class="text-danger">{{$message}}</span>
            @enderror</div>
{{--        <div class="col-md-12">--}}
{{--            إضافة مستخدمين:--}}
{{--            --}}{{--            <input type="text" name="user_id" class="form-control mb-2 mt-2" placeholder="بحث عن مستخدمين" />--}}
{{--            <div class="users-wrapper">--}}
{{--                @forelse($users  as $key => $user)--}}
{{--                    <label>--}}
{{--                        <input type="checkbox"  name="user_id[]" class="form-check-input @error('user_id') is-invalid @enderror" value="{{$user->id}}"/>--}}
{{--                        {{$user->full_name}}--}}
{{--                    </label>--}}
{{--                @empty--}}
{{--                    <label>لا يوجد موظفين</label>--}}
{{--                @endforelse--}}


{{--            </div>--}}
{{--            @error('user_id')--}}
{{--            <span class="text-danger">{{$message}}</span>--}}
{{--            @enderror--}}

{{--        </div>--}}
<div class="col-md-12"></div>
        <div style="display: flex; justify-content: space-around">
    <button class="btn btn-primary">موافق</button>
    <button
        type="button"
        onclick="history.back()"
        class="btn btn-secondary"
    >
        رجوع
    </button>
</div>
</form>
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
        if (localStorage.getItem("body-padding-top") === "true") {
            document.body.classList.add("body-padding-top");
        } else {
            document.body.classList.remove("body-padding-top");
        }
    }
</script>
</body>
</html>
