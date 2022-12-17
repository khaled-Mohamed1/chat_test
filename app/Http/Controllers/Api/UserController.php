<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskNote;
use App\Models\ToDoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api', ['except' => [
            'updateInfo',
            'taskGet','taskUpdate','taskGetUser','taskGetNote','taskStoreNoteUser','taskUpdateUser',
            'todolistGet','todolistStore','todolistUpdate'
        ]]);
    }


    public function updateInfo(Request $request){
        try {
            // Find user
            $user = User::find($request->user_id);

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'لا يوجد مستخدم بهذا الإسم'
                ], 404);
            }

                $user->phone_NO2 = $request->phone_NO2;
                $user->phone_NO3 = $request->phone_NO3;
                $user->email = $request->email;

                $validateUser = Validator::make(
                    $request->all(),
                    [
                        'phone_NO2' => 'numeric',
                        'phone_NO3' => 'numeric',
                        'user_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',
                        'email' => 'email'
                    ],
                    [
                        'phone_NO2.numeric' => 'يجب ادخال رقم الجوال 2 بالأرقام!',
                        'phone_NO3.numeric' => 'يجب ادخال رقم الجوال 3 بالأرقام!',
                    ]
                );

                if ($validateUser->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validateUser->errors()
                    ], 401);
                }

            if ($request->image) {
                // Public storage
                $storage = Storage::disk('public');

                if($user->role_id == 3){
                    if ($storage->exists('employee/' . $user->image))
                        $storage->delete('employee/' . $user->image);
                    $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();

                    $user->image = 'https://velatest.pal-lady.com/public/storage/app/public/employee/' . $imageName;

                    $storage->put('employee/' . $imageName, file_get_contents($request->image));
                }else{
                    if ($storage->exists('admins/' . $user->image))
                        $storage->delete('admins/' . $user->image);

                    $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();

                    $user->image = 'https://velatest.pal-lady.com/storage/app/public/admins/' . $imageName;

                    $storage->put('admins/' . $imageName, file_get_contents($request->image));
                }
            }

            // Update user
            $user->save();

            // Return Json Response
            return response()->json([
                'status' => 'success',
                'message' => "تم تعديل هذا المستخدم",
                'user' => $user,
                'error_number' => 200,

            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }



    public function taskGet(Request $request)
    {
        try {
            $tasks = Task::where('admin_id',$request->admin_id)->latest()->get();
                return response()->json([
                    'status' => 'success',
                    'tasks' => $tasks,
                ], 200);



        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    public function taskGetUser(Request $request)
    {
        try {
            $tasks = Task::query();

            if ($request->filled('user_id')) {
                $user_id = $request->user_id;
                $tasks = $tasks->whereHas('userTask', function ($q) use ($user_id) {
                    $q->where('user_id', $user_id);
                });
            }

            $tasks = $tasks->latest()->get();


            return response()->json([
                'status' => 'success',
                'tasks' => $tasks,
            ], 200);



        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage()

            ], 500);
        }
    }

    public function taskGetNote(Request $request)
    {
        try {
            $notes = TaskNote::with('UserTask','AdminTask')->where('task_id',$request->task_id)->latest()->get();
            return response()->json([
                'status' => 'success',
                'notes' => $notes,
            ], 200);

        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function taskStoreNoteUser(Request $request)
    {
        try {

            $taskNote = new TaskNote();

            $taskNote->task_id = $request->task_id;
            if($request->role_id == 2){
                $taskNote->admin_id = $request->user_id;
            }else{
                $taskNote->user_id = $request->user_id;
            }
            $taskNote->note = $request->note;

            $taskNote->save();


            $task = TaskNote::with('TaskUserTask','UserTask','AdminTask')->where('task_id',$request->task_id)->latest()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'تم ارسال الرسالة بنجاح',
                'task' => $task,
            ], 200);

        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage()

            ], 500);
        }
    }

    public function taskUpdateUser(Request $request)
    {
        try {
            $tasks = Task::where('id',$request->task_id)->first();
            if (!$tasks) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'لا يوجد مهمة بهذا الإسم'
                ], 404);
            }

            $tasks->status = 'completed';
            $tasks->save();

            return response()->json([
                'status' => 'success',
                'message' => "تم تعديل هذا المهمة بنجاح",
                'task' => $tasks,
                'error_number' => 200,

            ], 200);

        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage()

            ], 500);
        }
    }

//    public function taskUpdate(Request $request)
//    {
//        try {
//
//            $task = Task::find($request->task_id);
//
//            if (!$task) {
//                return response()->json([
//                    'status' => 'error',
//                    'message' => 'لا يوجد تاسك بهذا الإسم'
//                ], 404);
//            }
//
//            $task->status = $request->task_status;
//            $task->save();
//
//            // Return Json Response
//            return response()->json([
//                'status' => 'success',
//                'message' => "تم تعديل هذا المهمة بنجاح",
//                'task' => $task,
//                'error_number' => 200,
//
//            ], 200);
//
//        } catch (\Exception $e) {
//            // Return Json Response
//            return response()->json([
//                'message' => "Something went really wrong!"
//            ], 500);
//        }
//    }


    public function todolistGet(Request $request)
    {
        try {
            $lists = ToDoList::where('user_id',$request->user_id)->latest()->get();
            return response()->json([
                'status' => 'success',
                'lists' => $lists,
            ], 200);

        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage()

            ], 500);
        }
    }

    public function todolistStore(Request $request)
    {
        try {
            // Find user
            $user = User::find($request->user_id);

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'لا يوجد مستخدم بهذا الإسم'
                ], 404);
            }



            $validateUser = Validator::make(
                $request->all(),
                [
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'title' => 'required'
                ],
                [
                    'start_date.required' => 'يجب ادخال تاريخ بداية المهمة',
                    'end_date.required' => 'يجب ادخال تاريخ نهاية المهمة!',
                    'title.required' => 'يجب ادخال وصف المهمة!',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }


            $list = ToDoList::create([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            return response()->json([
                'status' => 'success',
                'list' => $list,
            ], 200);

        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function todolistUpdate(Request $request)
    {
        try {

            $list = ToDoList::find($request->list_id);

            if (!$list) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'لا يوجد مهمة بهذا الإسم'
                ], 404);
            }

            $list->status = true;
            $list->save();

            // Return Json Response
            return response()->json([
                'status' => 'success',
                'message' => "تم تعديل هذا المهمة بنجاح",
                'task' => $list,
                'error_number' => 200,

            ], 200);

        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage()
            ], 500);
        }
    }


}
