<?php

use App\Http\Controllers\ApprovalRecordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryTrainingController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\HomeController;
use App\http\Controllers\PageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SubcategoryTrainingController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainingSubmissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\ExamController;
use App\Models\CategoryTraining;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\RegistController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//home page tampilan pendaftaran training
Route::get('/dashboard',[HomeController::class,'index'])->name('home');

//detail pendaftaran training
Route::get('/regist/{training_id}/create', [RegistController::class, 'create']);

//store pendaftaran training
Route::post('/regist/{training_id}/store', [RegistController::class, 'store']);

//record pendaftaran training
Route::get('/regist', [RegistController::class, 'index']);

//tampilan quiz test
Route::resource('/test', TestController::class);

//pengajuan training
Route::get('/approval/create', [ApprovalRecordController::class, 'create']);

//store pengajuan training
Route::post('/approval', [ApprovalRecordController::class,'store']);

//record pengajuan training
Route::get('/approval', [ApprovalRecordController::class,'index']);

//dropdown subcategory
Route::post('api/fetch-subcategory', [TrainingController::class, 'getSubcategory']);

Route::resource('/forum',ForumController::class);

Route::resource('comment.forum',CommentController::class);

//delete comment
Route::delete('/comment/{comment_id}/delete',[CommentController::class, 'destroy']);
Route::delete('/comment/{child_id}/deleteChild',[CommentController::class, 'destroyChild']);

//like commnet
Route::get('/like/{forum_id}',[ForumController::class,'toggle']);

Auth::routes();

//hakakses admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    
    Route::get('/setting',[SettingController::class,'index']);

    Route::resource('/lesson',LessonController::class);

    // Route::resource('/categorytraining',CategoryTrainingController::class);
    Route::get('/categorytraining', [CategoryTrainingController::class,'index']);
    Route::post('/categorytraining', [CategoryTrainingController::class,'store']);
    Route::get('/categorytraining/{id}/edit', [CategoryTrainingController::class,'edit']);
    Route::put('/categorytraining/{id}', [CategoryTrainingController::class, 'update']);
    Route::delete('/categorytraining/{id}', [CategoryTrainingController::class, 'destroy']);
    Route::get('/exportCategoryTraining',[CategoryTrainingController::class,'categoryExport']);


    //Route::resource('/subcategorytraining',SubcategoryTrainingController::class);
    Route::get('/subcategorytraining', [SubcategoryTrainingController::class,'index']);
    Route::post('/subcategorytraining', [SubcategoryTrainingController::class,'store']);
    Route::get('/subcategorytraining/{id}/edit', [SubcategoryTrainingController::class,'edit']);
    Route::put('/subcategorytraining/{id}', [SubcategoryTrainingController::class, 'update']);
    Route::delete('/subcategorytraining/{id}', [SubcategoryTrainingController::class, 'destroy']);
    Route::get('/exportSubcategoryTraining',[SubcategoryTrainingController::class,'subcategoryExport']);

    //Route::resource('/venue',VenueController::class);
    Route::get('/venue', [VenueController::class,'index']);
    Route::post('/venue', [VenueController::class,'store']);
    Route::get('/venue/{id}/edit', [VenueController::class,'edit']);
    Route::put('/venue/{id}', [VenueController::class, 'update']);
    Route::delete('/venue/{id}', [VenueController::class, 'destroy']);
    Route::get('/exportVenue',[VenueController::class,'VenueExport']);

    //Route::resource('/room',RoomController::class);
    Route::get('/room', [RoomController::class,'index']);
    Route::post('/room', [RoomController::class,'store']);
    Route::get('/room/{id}/edit', [RoomController::class,'edit']);
    Route::put('/room/{id}', [RoomController::class, 'update']);
    Route::delete('/room/{id}', [RoomController::class, 'destroy']);
    Route::get('/exportRoom',[RoomController::class,'RoomExport']);

    //Route::resource('/provider',ProviderController::class);
    Route::get('/provider', [ProviderController::class,'index']);
    Route::post('/provider', [ProviderController::class,'store']);
    Route::get('/provider/{id}/edit', [ProviderController::class,'edit']);
    Route::put('/provider/{id}', [ProviderController::class, 'update']);
    Route::delete('/provider/{id}', [ProviderController::class, 'destroy']);
    Route::get('/exportProvider',[ProviderController::class,'ProviderExport']);

    Route::resource('/question',QuestionController::class);

    Route::resource('/answer',AnswerController::class);

    // Roles
    //Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('/role', RoleController::class);
    

    // Permissions
    //Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('/permission', PermissionController::class);

    // Users
    //Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('/user', UserController::class);

    // Route::resource('/training', TrainingController::class);
    
    // Route::resource('training.approval', TrainingController::class);

    //melihat data approval record di approval record
    Route::get('/approval/{id}', [ApprovalRecordController::class, 'show']);

    //submit approval detail
    Route::put('/approval/{id}', [ApprovalRecordController::class, 'update']);


    //view all training
    Route::get('/training', [TrainingController::class,'index']);
    //create training
    Route::get('training/{id}/approval/create', [TrainingController::class,'create']);
    //store training
    Route::post('training/{id}/approval', [TrainingController::class,'store']);

    Route::get('/regist/{regist_id}', [RegistController::class, 'show']);
    

    Route::put('/regist/{regist_id}', [RegistController::class, 'update']);

    //create exam
    Route::resource('/exam', ExamController::class);

    Route::post('api/fetch-room', [TrainingController::class, 'getRoom']);

    Route::post('api/fetch-lesson', [TrainingController::class, 'getLesson']);

});

//hakakses User
// Route::middleware(['auth', 'role:User'])->group(function () {

//     Route::get('/addTrainingSubmission',[TrainingSubmissionController::class,'index']);

//     Route::get('/addTrainingSubmission',[TrainingSubmissionController::class,'create']);
    
// });
Route::get('/product',[PageController::class,'index']);

Route::get('/uploadpage',[PageController::class,'uploadpage']);

Route::post('/uploadproduct',[PageController::class,'store']);

Route::get('/show',[PageController::class,'show']);

Route::get('/download/{file}',[PageController::class,'download']);

Route::get('/view/{is}',[PageController::class,'view']);