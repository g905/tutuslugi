<?php

use Illuminate\Support\Facades\Route;

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

//Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'Index'])->name('home');
Route::get('/contacts/', [App\Http\Controllers\HomeController::class, 'Contacts'])->name('contacts');

Route::get('/userterms/', [App\Http\Controllers\HomeController::class, 'Userterms'])->name('userterms');
Route::get('/news/', [App\Http\Controllers\HomeController::class, 'News'])->name('News');
Route::get('/userpolitics/', [App\Http\Controllers\HomeController::class, 'Userpolitics'])->name('userpolitics');
Route::post('/contacts/', [App\Http\Controllers\HomeController::class, 'ContactsSend'])->name('contacts.send');
Route::get('/region/', [App\Http\Controllers\RegionsController::class, 'ShowRegionList'])->name('region.index');
Route::get('/wishlist/', [App\Http\Controllers\AdvertsController::class, 'WishList'])->name('wishlist');
Route::get('/region/{region}/', [App\Http\Controllers\RegionsController::class, 'ShowRegionCityList'])->name(
    'region.city'
);
Route::get('/registration/confirm/{hash}/', [App\Http\Controllers\HomeController::class, 'confirmsend'])->name(
    'user.confirm'
);

Route::get('/profile/confirm/', [App\Http\Controllers\HomeController::class, 'confirm'])->name(
    'user.confirm.page'
);


Route::get('/system/cachemanager', [App\Http\Controllers\CacheManager::class, 'AdvertsCountManager']);
Route::get('/system/cachemanagerv2', [App\Http\Controllers\CacheManager::class, 'AdvertsCountManagerV2']);
Route::get('/system/seopagesreload', [App\Http\Controllers\CacheManager::class, 'SeoPagesReload']);

Route::get('/user/{id}/', [App\Http\Controllers\UserController::class, 'CurrentUser'])->name(
    'user.current'
);

//Админ
Route::group(
    ['middleware' => ['auth.admin']], function () {

    Route::get('/logout/', [App\Http\Controllers\UserController::class, 'Logout'])->name('user.logout');
    Route::post('/logout/', [App\Http\Controllers\UserController::class, 'Logout'])->name('user.logout');


    Route::get('/pult/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    //Категории
    Route::get('/pult/category/list/', [App\Http\Controllers\AdminController::class, 'CategoryList'])->name(
        'admin.category.list'
    );
    Route::get('/pult/category/edit/{id}/', [App\Http\Controllers\AdminController::class, 'CategoryEdit'])->name(
        'admin.category.edit'
    );
    Route::post('/pult/category/delete/{id}/', [App\Http\Controllers\AdminController::class, 'CategoryDelete'])->name(
        'admin.category.delete'
    );
    Route::get('/pult/category/delete/{id}/', [App\Http\Controllers\AdminController::class, 'CategoryDelete'])->name(
        'admin.category.delete'
    );
    Route::post('/pult/category/edit/', [App\Http\Controllers\AdminController::class, 'CategoryEditSave'])->name(
        'admin.category.save'
    );

    //Регионы
    Route::get('/pult/region/list/', [App\Http\Controllers\AdminController::class, 'RegionList'])->name(
        'admin.region.list'
    );
    Route::get('/pult/region/list/{region}/', [App\Http\Controllers\AdminController::class, 'RegionListCity'])->name(
        'admin.region.list.city'
    );
    Route::get('/pult/region/edit/{id}/', [App\Http\Controllers\AdminController::class, 'RegionEdit'])->name(
        'admin.region.edit'
    );
    Route::post('/pult/region/delete/{id}/', [App\Http\Controllers\AdminController::class, 'RegionDelete'])->name(
        'admin.region.delete'
    );
    Route::get('/pult/region/delete/{id}/', [App\Http\Controllers\AdminController::class, 'RegionDelete'])->name(
        'admin.region.delete'
    );
    Route::post('/pult/region/edit/', [App\Http\Controllers\AdminController::class, 'RegionEditSave'])->name(
        'admin.region.save'
    );

    //Пользователи
    Route::get('/pult/users/list/', [App\Http\Controllers\AdminController::class, 'UsersList'])->name(
        'admin.users.list'
    );
    Route::get('/pult/users/edit/{id}/', [App\Http\Controllers\AdminController::class, 'UsersEdit'])->name(
        'admin.users.edit'
    );
    Route::post('/pult/users/edit/', [App\Http\Controllers\AdminController::class, 'UsersEditSave'])->name(
        'admin.users.save'
    );

    Route::post('/pult/users/delete/{id}/', [App\Http\Controllers\AdminController::class, 'UsersDelete'])->name(
        'admin.users.delete'
    );
    Route::get('/pult/users/delete/{id}/', [App\Http\Controllers\AdminController::class, 'UsersDelete'])->name(
        'admin.users.delete'
    );


    //Объявления
    Route::get('/pult/items/list/', [App\Http\Controllers\AdminController::class, 'ItemsList'])->name(
        'admin.items.list'
    );
    Route::get('/pult/items/import/', [App\Http\Controllers\AdminController::class, 'ItemsListImport'])->name(
        'admin.items.import'
    );
    Route::get('/pult/items/import-info/', [App\Http\Controllers\AdminController::class, 'ItemsListImportUploadInfo']);
    Route::post('/pult/items/import/', [App\Http\Controllers\AdminController::class, 'ItemsListImportUpload'])->name(
        'admin.items.import'
    );
    Route::get('/pult/items/edit/{id}/', [App\Http\Controllers\AdminController::class, 'ItemsEdit'])->name(
        'admin.items.edit'
    );
    Route::get('/pult/items/get/{id}/', [App\Http\Controllers\AdminController::class, 'ItemsGet'])->name(
        'admin.items.get'
    );
    Route::post('/pult/items/edit/', [App\Http\Controllers\AdminController::class, 'ItemsEditSave'])->name(
        'admin.items.save'
    );
    Route::get('/pult/items/delete/{id}/', [App\Http\Controllers\AdminController::class, 'ItemsDelete'])->name(
        'admin.items.delete'
    );
    Route::post('/pult/items/delete/{id}/', [App\Http\Controllers\AdminController::class, 'ItemsDelete'])->name(
        'admin.items.delete'
    );
    Route::post('/pult/items/changestatus/', [App\Http\Controllers\AdminController::class, 'ItemsChangeStatus'])->name(
        'admin.items.changestatus'
    );


    //Сео-подборки
    Route::get('/pult/seopages/list/', [App\Http\Controllers\AdminController::class, 'SeoPagesList'])->name(
        'admin.seopages.list'
    );
    Route::get('/pult/seopages/edit/{id}/', [App\Http\Controllers\AdminController::class, 'SeoPagesEdit'])->name(
        'admin.seopages.edit'
    );
    Route::get('/pult/seopages/reload/{id}/', [App\Http\Controllers\AdminController::class, 'SeoPagesReload'])->name(
        'admin.seopages.reload'
    );

    Route::post('/pult/seopages/edit/', [App\Http\Controllers\AdminController::class, 'SeopagesEditSave'])->name(
        'admin.seopages.save'
    );

    Route::get('/pult/seopages/delete/{id}/', [App\Http\Controllers\AdminController::class, 'SeopagesDelete'])->name(
        'admin.seopages.delete'
    );

    Route::post('/pult/seopages/delete/{id}/', [App\Http\Controllers\AdminController::class, 'SeopagesDelete'])->name(
        'admin.seopages.delete'
    );


    Route::get('/pult/seo/edit/', [App\Http\Controllers\AdminController::class, 'SeoEdit'])->name(
        'admin.seo.edit'
    );
    Route::post('/pult/seo/save/', [App\Http\Controllers\AdminController::class, 'SeoEditSave'])->name(
        'admin.seo.save'
    );

    Route::post('/pult/banners/save/', [App\Http\Controllers\AdminController::class, 'SeoBannersSave'])->name(
        'admin.banners.save'
    );




    Route::get('/pult/pages/list/', [App\Http\Controllers\AdminController::class, 'List'])->name(
        'admin.pages.list'
    );
    Route::get('/pult/contacts/list/', [App\Http\Controllers\AdminController::class, 'ListContacts'])->name(
        'admin.contacts.list'
    );
    Route::get('/pult/contacts-adverts/list/', [App\Http\Controllers\AdminController::class, 'ListAdvertsContacts'])->name(
        'admin.contacts-adverts.list'
    );
    Route::get('/pult/settings/list/', [App\Http\Controllers\AdminController::class, 'List'])->name(
        'admin.settings.list'
    );
    Route::get('/pult/settings/list/', [App\Http\Controllers\AdminController::class, 'List'])->name(
        'admin.downloads.list'
    );

}
);

Route::group(
    ['middleware' => ['guest']], function () {

    Route::get('/profile/reset/', [App\Http\Controllers\UserController::class, 'UserResetForm'])->name(
        'user.reset'
    );
    Route::get('/profile/reset/{hash}/', [App\Http\Controllers\UserController::class, 'UserResetPassForm'])->name(
        'user.reset.password'
    );

    Route::post('/profile/reset/save/', [App\Http\Controllers\UserController::class, 'UserResetSave'])->name(
        'user.reset.save'
    );


    Route::post('/profile/reset/', [App\Http\Controllers\UserController::class, 'UserReset'])->name('user.reset');

    Route::get('/profile/registration/', [App\Http\Controllers\UserController::class, 'UserRegistrationForm'])->name(
        'user.registration'
    );
    Route::post('/profile/registration/', [App\Http\Controllers\UserController::class, 'UserRegistration'])->name(
        'user.registration'
    );
    Route::post('/profile/registration-check/', [App\Http\Controllers\UserController::class, 'UserRegistrationCheck'])->name(
        'user.registration.check'
    );


    Route::get('/profile/login/', [App\Http\Controllers\UserController::class, 'UserLoginForm'])->name(
        'user.login'
    );
    Route::post('/profile/login/', [App\Http\Controllers\UserController::class, 'UserLogin'])->name(
        'user.login'
    );
}
);


Route::group(
    ['middleware' => ['auth']], function () {
    Route::get('/logout/', [App\Http\Controllers\UserController::class, 'Logout'])->name('user.logout');
    Route::post('/logout/', [App\Http\Controllers\UserController::class, 'Logout'])->name('user.logout');


    Route::get('/profile/', [App\Http\Controllers\UserController::class, 'UserProfile'])->name('user.profile');
    Route::get('/profile/settings', [App\Http\Controllers\UserController::class, 'UserSettingsForm'])->name('user.profile.settings');
    Route::get('/profile/about', [App\Http\Controllers\UserController::class, 'UserAboutForm'])->name('user.profile.about');
    Route::get('/profile/discount', [App\Http\Controllers\UserController::class, 'UserDiscountForm'])->name('user.profile.discount');
    Route::get('/profile/portfolio', [App\Http\Controllers\UserController::class, 'UserPortfolioForm'])->name('user.profile.portfolio');
    Route::get('/profile/regions', [App\Http\Controllers\UserController::class, 'UserRegionsForm'])->name('user.profile.regions');
    Route::get('/profile/services', [App\Http\Controllers\UserController::class, 'UserServicesForm'])->name('user.profile.services');

    //Route::get('/cabinet/items/edit/{id}/', [App\Http\Controllers\AdvertsController::class, 'EditForm'])->name('user.items.edit');
   /* Route::get('/cabinet/settings/', [App\Http\Controllers\UserController::class, 'UserSettingsForm'])->name(
        'user.settings'
    );*/
    Route::post('/profile/settings/', [App\Http\Controllers\UserController::class, 'UserSettings'])->name(
        'user.settings'
    );
    Route::post('/profile/about/', [App\Http\Controllers\UserController::class, 'UserAbout'])->name(
        'user.about'
    );
    Route::post('/profile/discount/', [App\Http\Controllers\UserController::class, 'UserDiscount'])->name(
        'user.discount'
    );
    Route::post('/profile/uploadphoto/', [App\Http\Controllers\UserController::class, 'UploadUserPhoto'])->name(
        'user.upload.photo'
    );
    Route::post('/profile/portfolio/upload/', [App\Http\Controllers\UserController::class, 'UploadPortfolio'])->name(
        'user.profile.portfolio.upload'
    );
    Route::post('/profile/regions/', [App\Http\Controllers\UserController::class, 'UserRegions'])->name(
        'user.regions'
    );
    Route::post('/profile/service/', [App\Http\Controllers\UserController::class, 'UserServices'])->name(
        'user.service'
    );
    Route::post('/profile/service/price', [App\Http\Controllers\UserController::class, 'UserServicesPrice'])->name(
        'user.service.price'
    );

    /*Route::get('/cabinet/password/', [App\Http\Controllers\UserController::class, 'UserPasswordForm'])->name(
        'user.password'
    );*/
    Route::post('/cabinet/password/', [App\Http\Controllers\UserController::class, 'UserPassword'])->name(
        'user.password'
    );


    Route::get('/item/add/', [App\Http\Controllers\AdvertsController::class, 'AddForm'])->name('advert.add');
    Route::post('/item/add/', [App\Http\Controllers\AdvertsController::class, 'Add'])->name('advert.add');
    Route::post('/item/edit/', [App\Http\Controllers\AdvertsController::class, 'Edit'])->name('advert.edit');



}
);


Route::prefix('api')->group(
    function () {
        Route::delete('/portfolio/', [App\Http\Controllers\UserController::class, 'deletePortfolio']);
        Route::post('/get-citys-by-region/', [App\Http\Controllers\AdvertsController::class, 'getCitysByRegion']);
        Route::post('/update-wish/', [App\Http\Controllers\AdvertsController::class, 'updateWish']);
        Route::post('/update-advert/', [App\Http\Controllers\AdvertsController::class, 'updateAdvert']);
        Route::post('/delete-advert/', [App\Http\Controllers\AdvertsController::class, 'deleteAdvert']);
        Route::post('/close-advert/', [App\Http\Controllers\AdvertsController::class, 'closeAdvert']);
        Route::post('/getphone/', [App\Http\Controllers\AdvertsController::class, 'getphone']);
        Route::post('/open-advert/', [App\Http\Controllers\AdvertsController::class, 'openAdvert']);
        Route::post(
            '/get-categories-by-parent/', [App\Http\Controllers\AdvertsController::class, 'getCategoriesByParent']
        );
    }
);

//Маршрутизатор для региона
Route::group(
    ['prefix' => '{region}', 'middleware' => 'region'], function () {
    Route::get('/', [App\Http\Controllers\AdvertsController::class, 'CityIndex'])->name('advert.index');
    Route::get('/sitemap/', [App\Http\Controllers\AdvertsController::class, 'Sitemap'])->name('sitemap');
    Route::get('/{category}/', [App\Http\Controllers\AdvertsController::class, 'CategoryPage'])->name('region.category');
    Route::post('/{category}/', [App\Http\Controllers\AdvertsController::class, 'CategoryPageAjax'])->name(
        'region.category.ajax'
    );



    Route::get('/{category}/{subcategory}/', [App\Http\Controllers\AdvertsController::class, 'SubCategoryPage'])->name(
        'region.subcategory'
    );

    Route::get('/{category}/{subcategory}/{advert}/', [App\Http\Controllers\AdvertsController::class, 'AdvertCurrent'])
        ->name('advert.current');


    Route::post(
        '/{category}/{subcategory}/{advert}/', [App\Http\Controllers\AdvertsController::class, 'AdvertCurrentAjax']
    )->name('advert.current');

    Route::post('/{category}/{subcategory}/', [App\Http\Controllers\AdvertsController::class, 'SubCategoryPageAjax'])
        ->name('region.subcategory');


}
);
//Route::get('/{region}/{city}/{page?}', [App\Http\Controllers\HomeController::class, 'Index1'])->name('home1');
