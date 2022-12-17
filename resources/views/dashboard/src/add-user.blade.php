<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Vela: الموظفين اضافة</title>
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
        <div style="border-bottom: 1px solid #ddd; margin-bottom: 50px; padding-bottom: 10px">
            <h4>اضافة موظف</h4>
        </div>
        <form
            class="row"
            style="row-gap: 20px"
            method="post"
            action="{{route('users.store')}}"
            onsubmit="(e)=>e.preventDefault()"
            enctype="multipart/form-data">
            @csrf

            <div class="col-md-6">
                <label for="full_name" class="form-label">الإسم رباعي <span style="color:red;">*</span></label>
                <input value="{{old('full_name')}}" type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" id="full_name" />

                @error('full_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">البريد الإلكتروني <span style="color:red;">*</span></label>
                <input value="{{old('email')}}" type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" />
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="password" class="form-label">كلمة السر <span style="color:red;">*</span></label>
                <input value="{{old('password')}}" type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" />
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="phone_NO" class="form-label">رقم الجوال <span style="color:red;">*</span></label>
                <input value="{{old('phone_NO')}}" type="text" name="phone_NO" class="form-control @error('phone_NO') is-invalid @enderror" id="phone_NO" />
                @error('phone_NO')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="job" class="form-label">الوظيفة <span style="color:red;">*</span></label>
                <input value="{{old('job')}}" type="text" name="job" class="form-control @error('job') is-invalid @enderror" id="job" />
                @error('job')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="formFile" class="form-label">الصورة الشخصية <span style="color:red;">*</span></label>
                <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="image" />
                @error('image')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div style="display: flex; justify-content: space-around">
                <button class="btn btn-primary">اضافة</button>
                <button
                    type="button"
                    onclick="history.back()"
                    class="btn btn-secondary"
                >
                    إلغاء
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
        if (localStorage.getItem("body-padding-top") == "true") {
          document.body.classList.add("body-padding-top");
        } else {
          document.body.classList.remove("body-padding-top");
        }
      }
    </script>
  </body>
</html>
