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

// Route::view('/dashboard','home-page');

Route::get('/dashboard',[HomeController::class,'index'])->name('home');

//hakakses
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Auth::routes();

//hakakses admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    
    Route::get('/setting',[SettingController::class,'index']);

    Route::resource('comment.forum',CommentController::class);

    Route::delete('/comment/{comment_id}/delete',[CommentController::class, 'destroy']);
    Route::delete('/comment/{child_id}/deleteChild',[CommentController::class, 'destroyChild']);

    Route::resource('/forum',ForumController::class);

    Route::resource('/lesson',LessonController::class);

    Route::resource('/categorytraining',CategoryTrainingController::class);
    Route::get('/exportCategoryTraining',[CategoryTrainingController::class,'categoryExport']);

    Route::resource('/subcategorytraining',SubcategoryTrainingController::class);
    Route::resource('/venue',VenueController::class);
    Route::resource('/room',RoomController::class);
    Route::resource('/provider',ProviderController::class);

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

    //test
    Route::resource('/test', TestController::class);

    Route::resource('/approval', ApprovalRecordController::class);

    Route::resource('training.approval', TrainingController::class);

    //create exam
    Route::resource('/exam', ExamController::class);

    Route::post('api/fetch-room', [TrainingController::class, 'getRoom']);
    Route::post('api/fetch-subcategory', [TrainingController::class, 'getSubcategory']);
    Route::post('api/fetch-lesson', [TrainingController::class, 'getLesson']);
    Route::get('/approval/{id}', [ApprovalRecordController::class, 'update'])->name('status.update');

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