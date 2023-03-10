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
    <link rel="stylesheet" href="{{asset('public/dashboard/css/bootstrap.rtl.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/dashboard/css/forms-style.css')}}" />
    <style>
        small {
            color: #a4a4a4;
        }
    </style>
</head>
<body>
<div class="table-container section-style">
    <h3 class="mb-4 pb-2" style="border-bottom: 1px solid #ddd">
        معلومات المهمة
    </h3>
    @include('dashboard.errors.alert')

    <div style="padding-right: 20px">
        <div class="row">
            <div class="col-sm-6">
                <small>العنوان:</small>
                <p>{{$task->title}}</p>
            </div>
            <div class="col-sm-6">
                <small>حالة المهمة:</small>

                <p>
                    @if($task->status == 'closed')
                        <span class="text-success">{{$task->status}}</span>
                    @else
                        <span class="text-warning">{{$task->status}}</span>
                    @endif
                </p>

            </div>
            <div class="col-sm-6">
                <small>تاريخ البداية:</small>
                <p>{{$task->start_date}}</p>
            </div>
            <div class="col-sm-6">
                <small>تاريخ النهاية:</small>
                <p>{{$task->end_date}}</p>
            </div>
            <div class="col-sm-12 pb-2" style="border-bottom: 1px solid #eee">
                <small>الوصف:</small>
                <p>{{$task->description}}</p>
            </div>
            <div class="col-sm-12 mt-4">
                <h5>الموظفين:</h5>
            </div>
            <div class="col-sm-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الاسم</th>
                        <th scope="col">رقم الهاتف</th>
                        <th scope="col">حالة المهمة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($task->userTask as $user)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$user->UserTask->full_name}}</td>
                            <td>{{$user->UserTask->phone_NO}}</td>
                            <td>
                                @if($user->status == '1')
                                    <span class="text-success">تم انجاز المهمة</span>
                                @else
                                    <span class="text-danger">لم يتم انجاز المهمة</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">لا يوجد موظفين</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
            <div class="col-sm-12" style="display: flex;justify-content: space-around;">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                >
                    الملاحظات
                </button>
                @if($task->status == 'closed')
                    <button class="btn btn-primary" disabled>إغلاق المهمة</button>
                @else
                    <button class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#closedModal"
                        {{ $task->userTask->every('status', 1) ? '' : 'disabled' }}>إغلاق المهمة</button>
                @endif

                <button class="btn btn-secondary" onclick="history.back()">رجوع</button>
            </div>
        </div>
    </div>
</div>
<!-- NOTE MODAL -->
<div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="task-add-form{{$task->id}}" method="POST" action="{{ route('tasks.addNote', ['task' => $task->id]) }}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">الملاحظات</h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label for="desc" class="form-label">إضافة ملاحظة:</label>
                            <textarea
                                name="note"
                                id="desc"
                                cols="20"
                                rows="2"
                                class="form-control @error('note') is-invalid @enderror"
                                placeholder="إضافة ملاحظة"
                            ></textarea>
                            @error('note')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">

                            <div class="note-wrapper">
                                @foreach($task->notes as $note)
                                    <div class="note-40 {{$note->admin_id == NULL ? '': 'admin-note'}}">
                                        <small class="text-muted">{{$note->admin_id == NULL ? $note->UserTask->full_name : $note->AdminTask->full_name}}</small>
                                        <div class="note">{{$note->note}}</div>
                                        <small class="text-muted">{{$note->created_at->format('m:d h:i')}}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display: flex; justify-content: space-around">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        الغاء
                    </button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('task-add-form{{$task->id}}').submit();">
                        اضافة
                    </a>

                </div>
            </form>

        </div>
    </div>
</div>


<div
    class="modal fade"
    id="closedModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">هل تريد انهاء المهمة<span class="text-vela">{{$task->title}}</span> ؟</div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    لا
                </button>
                <a class="btn btn-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('task-closed-form{{$task->id}}').submit();">
                    حذف
                </a>
                <form id="task-closed-form{{$task->id}}" method="POST" action="{{ route('tasks.closed', ['task' => $task->id]) }}">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('public/dashboard/js/bootstrap.bundle.min.js')}}"></script>
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
