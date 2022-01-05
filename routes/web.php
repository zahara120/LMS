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
use App\Http\Controllers\ApproverController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SubcategoryTrainingController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\RegistController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\QuestionOptionController;
use App\Http\Controllers\TraineeController;
use App\Models\Role;
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


Route::view('/', 'welcome');

//change password
Route::put('/user/changePassword', [UserController::class, 'updatePassword'])->name('user.changePassword');

//home page tampilan pendaftaran training
Route::get('/dashboard',[HomeController::class,'index'])->name('home');

//tampilan quiz test
//Route::resource('/test', TestController::class);
Route::get('/test', [TestController::class, 'index']);

//input test 
Route::get('training/{id}', [TestController::class,'test']);

//approver
Route::get('/approver', [ApproverController::class,'index']);
Route::post('/approver', [ApproverController::class,'store']);

//strore test
Route::post('/test/{id}/training', [TestController::class,'store']);

//strore test
Route::post('/test/{id}/training', [TestController::class,'store']);

Route::name('regist.')->group(function () {
    //detail pendaftaran training
    Route::get('/regist/{training_id}/create', [RegistController::class, 'create'])->name('create');
    
    //store pendaftaran training
    Route::post('/regist/{training_id}/store', [RegistController::class, 'store'])->name('store');
    
    //record pendaftaran training
    Route::get('/regist', [RegistController::class, 'index'])->name('index');
});

Route::name('approval.')->group(function () {
    //pengajuan training
    Route::get('/approval/create', [ApprovalRecordController::class, 'create'])->name('create');
    
    //store pengajuan training
    Route::post('/approval', [ApprovalRecordController::class,'store'])->name('store');
    
    //record pengajuan training
    Route::get('/approval', [ApprovalRecordController::class,'index'])->name('index');
    
    //edit approval detail
    Route::get('/approval/{approval}/edit', [ApprovalRecordController::class, 'edit'])->name('edit');
    
    //update approval detail
    Route::put('/approval/{id}/update', [ApprovalRecordController::class, 'update'])->name('update');
});

//dropdown subcategory
Route::post('api/fetch-subcategory', [TrainingController::class, 'getSubcategory']);

Route::resource('/forum',ForumController::class);

Route::resource('comment.forum',CommentController::class);

//delete comment
Route::delete('/comment/{comment_id}/delete',[CommentController::class, 'destroy']);
Route::delete('/comment/{child_id}/deleteChild',[CommentController::class, 'destroyChild']);

//like comment
Route::get('/like/{forum_id}',[ForumController::class,'toggle']);

Auth::routes();

//hakakses admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    
    Route::get('/setting',[SettingController::class,'index']);

    Route::resource('/lesson',LessonController::class);

    Route::name('category.')->group(function () {
        // Route::resource('/categorytraining',CategoryTrainingController::class);
        Route::get('/categorytraining', [CategoryTrainingController::class,'index'])->name('index');
        Route::post('/categorytraining', [CategoryTrainingController::class,'store'])->name('store');
        Route::get('/categorytraining/{id}/edit', [CategoryTrainingController::class,'edit'])->name('edit');
        Route::put('/categorytraining/{id}', [CategoryTrainingController::class, 'update'])->name('update');
        Route::delete('/categorytraining/{id}', [CategoryTrainingController::class, 'destroy'])->name('destroy');
        Route::get('/exportCategoryTraining',[CategoryTrainingController::class,'categoryExport'])->name('categoryExport');
        Route::post('/importCategoryTraining',[CategoryTrainingController::class,'categoryImport'])->name('import');
        Route::get('/templateCategoryTraining',[CategoryTrainingController::class,'templateCategory'])->name('template');
    });


    //Route::resource('/subcategorytraining',SubcategoryTrainingController::class);
    Route::get('/subcategorytraining', [SubcategoryTrainingController::class,'index'])->name('subcategory.index');
    Route::post('/subcategorytraining', [SubcategoryTrainingController::class,'store']);
    Route::get('/subcategorytraining/{id}/edit', [SubcategoryTrainingController::class,'edit']);
    Route::put('/subcategorytraining/{id}', [SubcategoryTrainingController::class, 'update']);
    Route::delete('/subcategorytraining/{id}', [SubcategoryTrainingController::class, 'destroy']);
    Route::get('/exportSubcategoryTraining',[SubcategoryTrainingController::class,'subcategoryExport']);
    Route::post('/importSubcategoryTraining',[SubcategoryTrainingController::class,'subcategoryimport'])->name('subcategory.import');
    Route::get('/templateSubcategoryTraining',[SubcategoryTrainingController::class,'templateSubcategory'])->name('subcategory.template');
    

    //Route::resource('/venue',VenueController::class);
    Route::get('/venue', [VenueController::class,'index'])->name('venue.index');
    Route::post('/venue', [VenueController::class,'store']);
    Route::get('/venue/{id}/edit', [VenueController::class,'edit']);
    Route::put('/venue/{id}', [VenueController::class, 'update']);
    Route::delete('/venue/{id}', [VenueController::class, 'destroy']);
    Route::get('/exportVenue',[VenueController::class,'venueExport']);
    Route::post('/importVenue',[VenueController::class,'venueImport'])->name('venue.import');
    Route::get('/templateVenue',[VenueController::class,'templateVenue'])->name('venue.template');
    
    //Route::resource('/room',RoomController::class);
    Route::get('/room', [RoomController::class,'index'])->name('room.index');
    Route::post('/room', [RoomController::class,'store']);
    Route::get('/room/{id}/edit', [RoomController::class,'edit']);
    Route::put('/room/{id}', [RoomController::class, 'update']);
    Route::delete('/room/{id}', [RoomController::class, 'destroy']);
    Route::get('/exportRoom',[RoomController::class,'RoomExport']);
    Route::post('/importRoom',[RoomController::class,'roomImport'])->name('room.import');
    Route::get('/templateRoom',[RoomController::class,'templateRoom'])->name('room.template');

    //Route::resource('/provider',ProviderController::class);
    Route::get('/provider', [ProviderController::class,'index'])->name('provider.index');
    Route::post('/provider', [ProviderController::class,'store']);
    Route::get('/provider/{id}/edit', [ProviderController::class,'edit']);
    Route::put('/provider/{id}', [ProviderController::class, 'update']);
    Route::delete('/provider/{id}', [ProviderController::class, 'destroy']);
    Route::get('/exportProvider',[ProviderController::class,'ProviderExport']);
    Route::post('/importProvider',[ProviderController::class,'ProviderImport'])->name('provider.import');
    Route::get('/templateProvider',[ProviderController::class,'templateProvider'])->name('provider.template');

    //Route::resource('/question',QuestionController::class);
    //create question form test
    Route::get('question/{id}/test/create', [QuestionController::class,'create']);
    //store question
    Route::post('/question/{test_id}/test', [QuestionController::class, 'store']);
    //delete question
    Route::delete('question/{id}', [QuestionController::class,'destroy']);
    //edit question
    Route::get('/question/{id}/edit', [QuestionController::class,'edit']);
    //store/update question
    Route::put('/question/{id}', [QuestionController::class, 'update']);


    //Route::resource('/answer',AnswerController::class);
    //create answer form test
    Route::get('answer/{id}/test/create', [AnswerController::class,'create']);
    //store answer training
    Route::post('/answer/{test_id}/test', [AnswerController::class, 'store']);
    //delete answer
    Route::delete('answer/{id}', [AnswerController::class,'destroy']);
    //edit question
    Route::get('/answer/{id}/edit', [AnswerController::class,'edit']);
    //store/update question
    Route::put('/answer/{id}', [AnswerController::class, 'update']);

    //survey
    //Route::resource('/survey', SurveyController::class);

    //index survey
    Route::get('/survey', [SurveyController::class, 'index']);
    //create store survey
    Route::post('/survey', [SurveyController::class,'store']);
    //delete survey
    Route::delete('/survey/{id}', [SurveyController::class, 'destroy']);

    //create questionoption form survey
    Route::get('/questionoption/{id}/survey/create', [QuestionOptionController::class,'create']);
    //store answer training
    Route::post('/questionoption/{survey_id}/survey', [QuestionOptionController::class, 'store']);
    //delete answer
    Route::delete('questionoption/{id}', [QuestionOptionController::class,'destroy']);
    //edit question
    Route::get('/questionoption/{id}/edit', [QuestionOptionController::class,'edit']);
    //store/update question
    Route::put('/questionoption/{id}', [QuestionOptionController::class, 'update']);

    //create questionner form survey
    Route::get('questionnaire/{id}/survey/create', [QuestionnaireController::class,'create']);
    //store question
    Route::post('/questionnaire/{survey_id}/survey', [QuestionnaireController::class, 'store']);
    //delete question
    Route::delete('questionnaire/{id}', [QuestionnaireController::class,'destroy']);
    //edit question
    Route::get('/questionnaire/{id}/edit', [QuestionnaireController::class,'edit']);
    //store/update question
    Route::put('/questionnaire/{id}', [QuestionnaireController::class, 'update']);

    // Roles
    //Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('/role', RoleController::class);
    

    // Permissions
    //Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('/permission', PermissionController::class);

    // Users
    //Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::get('/user', [UserController::class, 'index']);
    
    // Route::resource('/training', TrainingController::class);
    
    // Route::resource('training.approval', TrainingController::class);

    //melihat data approval record di approval record
    Route::get('/approval/{approval}', [ApprovalRecordController::class, 'show']);

    //submit approval detail
    Route::put('/approval/{id}', [ApprovalRecordController::class, 'updateStatus']);

    //create training tanpa submission
    Route::get('/training/create', [TrainingController::class,'createtraining']);
    Route::post('/training', [TrainingController::class,'storetraining']);
    
    Route::name('training.')->group(function(){
        //view all training
        Route::get('training', [TrainingController::class,'index'])->name('index');
        //create training
        Route::get('training/{id}/approval/create', [TrainingController::class,'create'])->name('create');
        //edit training
        Route::get('training/{training}/{approval}/edit', [TrainingController::class,'edit'])->name('edit');
        //update training
        Route::put('training/{training}/{approval}/update', [TrainingController::class,'update'])->name('update');
        //store training
        Route::post('training/{id}/store', [TrainingController::class,'store'])->name('store');
        // show list user
        Route::get('user/{training}', [TraineeController::class,'index'])->name('user.index');
        // store user
        Route::post('user/{training}/store', [TraineeController::class,'store'])->name('user.store');
        // delete user FROM regist table
        Route::delete('user/{regist}/delete', [TraineeController::class,'destroy'])->name('user.delete');
    });
    

    Route::get('/regist/{regist_id}', [RegistController::class, 'show']);
    

    Route::put('/regist/{regist_id}', [RegistController::class, 'update']);

    //create exam
    //Route::resource('/exam', ExamController::class);
     //create exam
    Route::get('/exam', [ExamController::class,'index'])->name('exam.index');
    //create store exam
    Route::post('/exam', [ExamController::class,'store']);
    //delete exam
    Route::delete('/exam/{id}', [ExamController::class, 'destroy']);
    //import exam
    Route::post('/importExam', [ExamController::class, 'examImport'])->name('exam.import');

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