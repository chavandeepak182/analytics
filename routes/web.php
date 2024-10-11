<?php

use App\Http\Controllers\Admin\Blogs\BlogController;
use App\Http\Controllers\Admin\Career_application\CareerApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Admin\Login\LoginController;
use App\Http\Controllers\Admin\Login\ForgotPasswordController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CMS\AboutUsController;
use App\Http\Controllers\Admin\CMS\career\CareerController;
use App\Http\Controllers\Admin\CMS\home\HomeController;
use App\Http\Controllers\Admin\CMS\privacy_policy\PrivacyPolicyController;
use App\Http\Controllers\Admin\CMS\research_methdology\ResearchMethdologyController;
use App\Http\Controllers\Admin\CMS\Services\ConsultingServiceController;
use App\Http\Controllers\Admin\CMS\Services\CustomResearchServiceController;
use App\Http\Controllers\Admin\CMS\Services\SubscriptionServiceController;
use App\Http\Controllers\Admin\CMS\Services\WeMarketClientSupportServiceController;
use App\Http\Controllers\Admin\CMS\terms_we_use\TermsWeUseController;
use App\Http\Controllers\Admin\CMS\Testimonial\TestimonialController;
use App\Http\Controllers\Admin\ContactUs\AdminContactController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\Settings\GeneralSettings;
use App\Http\Controllers\Admin\Settings\EmailSettings;
use App\Http\Controllers\Admin\Settings\VisualSettings;
use App\Http\Controllers\Front\FrontReportController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\Infographics\InfographicsController;
use App\Http\Controllers\Admin\Payment_details\PaymentDetailsController;
use App\Http\Controllers\Front\FrontContactUsEnqueryController;
use App\Http\Controllers\Front\FrontEnquiryController;
use App\Http\Controllers\Front\FrontPaypalController;
use App\Http\Controllers\Front\CookieController;
use App\Http\Controllers\Front\FrontUpcomingReportController;
use App\Http\Controllers\Front\NewsLetterController;
use App\Http\Controllers\Admin\RolesPrivilegesController;
use App\Http\Controllers\Admin\SystemUserController;
use App\Http\Controllers\Admin\RelatedReportController;
use App\Http\Controllers\Front\NotFoundController;
use App\Http\Controllers\Front\FrontPaymentController;
use App\Http\Controllers\Front\SiteMapController;


// Laravel Development Admin
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'storage linked';
});

Route::get('clear', function () {
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    return 'clear';
});

//Sitemap
Route::get('sitemap.xml', [SiteMapController::class, 'index']);

// login
Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/admin', [LoginController::class, 'index']);
});
Route::post('login-action', [LoginController::class, 'admin_login'])->name('login');
Route::post('send-otp', [LoginController::class, 'send_otp']);
Route::post('otp-verify', [LoginController::class, 'otp_verify']);
// Route::post('reset-password', [LoginController::class, 'reset_password']);

// Forget Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('reset-password', function(){ return abort(404); }); // 404 Not Found On Get Request

// FrontEnd Routes
Route::get('/', [HomeController::class, 'show'])->name('home');

//Reports
Route::get('research-reports/all/{page_range?}', [FrontReportController::class, 'index']);
Route::get('research-reports/{category_slug}/{category_id}/{page_range?}', [FrontReportController::class, 'category_wise_report']);
Route::get('reports/{report_slug}/{report_id}/', [FrontReportController::class, 'report_details']);
Route::get('searchresults/', [FrontReportController::class, 'globalSearch']);
Route::post('reports/enquiry', [FrontEnquiryController::class, 'store'])->name('report.enquiry.store');
Route::get('reports/enquiry', function(){ return abort(404); }); // 404 Not Found On Get Request

Route::get('sample-request/{url}/{report_id}', [FrontEnquiryController::class, 'index']);
Route::get('customization/{url}/{report_id}', [FrontEnquiryController::class, 'index']);
Route::get('analyst/{url}/{report_id}', [FrontEnquiryController::class, 'index']);
Route::get('discount/{url}/{report_id}', [FrontEnquiryController::class, 'index']);
Route::get('blog/{url}/{report_id}', [FrontEnquiryController::class, 'index']);

Route::get('reports/toc/{report_slug}/{report_id}/', [FrontReportController::class, 'report_details']);
Route::get('reports/research-methodology/{report_slug}/{report_id}/', [FrontReportController::class, 'report_details']);
Route::get('reports/infographics/{report_slug}/{report_id}/', [FrontReportController::class, 'report_details']);
Route::get('reports/request-free-sample-pdf/{report_slug}/{report_id}/', [FrontReportController::class, 'report_details']);

Route::get('thank-you/{request_type}/{url}/{report_id}', [FrontEnquiryController::class, 'thankyou']);

// Upcoming Report
Route::get('upcomingreports/{page_range?}', [FrontUpcomingReportController::class, 'index']);
Route::get('upcomingreport/{category_slug}/{category_id}/{page_range?}', [FrontUpcomingReportController::class, 'category_wise_report']);
Route::get('upcomingreports/{report_slug}/{report_id}/', [FrontUpcomingReportController::class, 'report_details']);

Route::get('upcomingreports/toc/{report_slug}/{report_id}/', [FrontUpcomingReportController::class, 'report_details']);
Route::get('upcomingreports/research-methodology/{report_slug}/{report_id}/', [FrontUpcomingReportController::class, 'report_details']);
Route::get('upcomingreports/infographics/{report_slug}/{report_id}/', [FrontUpcomingReportController::class, 'report_details']);
Route::get('upcomingreports/request-free-sample-pdf/{report_slug}/{report_id}/', [FrontUpcomingReportController::class, 'report_details']);

Route::get('purchase/{url}/{id}', [FrontPaypalController::class, 'index']);
Route::post('payment', [FrontPayPalController::class, 'payment'])->name('pay');
Route::get('payment', function(){ return abort(404); }); // 404 Not Found On Get Request
Route::get('paypal/success', [FrontPayPalController::class, 'paypal_success'])->name('paypal_success');
Route::get('stripe/success', [FrontPayPalController::class, 'stripe_success'])->name('stripe_success');
Route::get('payment/cancel', [FrontPayPalController::class, 'payment_cancel'])->name('payment_cancel');

Route::get('/aboutus', [AboutUsController::class, 'show']);
Route::get('/contactus', [GeneralSettings::class, 'showContacts']);
Route::get('/careers', [CareerController::class, 'show']);
Route::view('/services', 'front/services');
Route::get('/research-methodology',[ResearchMethdologyController::class,'show']);

Route::get('/services/consulting',[ConsultingServiceController::class,'show']);
Route::get('/services/subscription', [SubscriptionServiceController::class, 'show']);
Route::get('/services/custom-market-research', [CustomResearchServiceController::class, 'show']);
Route::get('/services/we-market-client-support', [WeMarketClientSupportServiceController::class, 'show']);
Route::post('contact-us-query-store', [FrontContactUsEnqueryController::class, 'store'])->name('contact.us.query');
Route::get('contact-us-query-store', function(){ return abort(404); }); // 404 Not Found On Get Request

Route::get('/blog/{slug_url?}', [BlogController::class, 'show_blogs']);
// Route::get('/blog-details/{id}', [BlogController::class, 'show_blog_details']);
Route::get('/press-release-data-show', [BlogController::class, 'show_press_release_data']);
Route::get('/press-release/{slug_url?}', [BlogController::class, 'show_press_releases']);
// Route::get('/press-release/{slug_url?}', [BlogController::class, 'show_press_release_details']);
Route::post('/press-releases/search', [BlogController::class,'search_press_releases'])->name('press_releases.search');
Route::get('/press-releases/search', function(){ return abort(404); }); // 404 Not Found On Get Request

Route::get('/infographics',[InfographicsController::class,'show']);
Route::get('/infographics-details/{id}',[InfographicsController::class, 'show_detail']);
Route::get('/terms-of-use', [TermsWeUseController::class, 'show']);
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show']);
Route::post('/infographics-search', [InfographicsController::class,'infographics_search'])->name('infographics.search');
Route::get('/infographics-search', function(){ return abort(404); }); // 404 Not Found On Get Request

Route::post('/newsletter', [NewsLetterController::class, 'store']);
Route::get('/newsletter', function(){ return abort(404); }); // 404 Not Found On Get Request

route::get('/404', [NotFoundController::class, 'index']);
route::view('/thankyou', 'front/request_form/contactus-thankyou');
Route::get('reload-captcha', [BaseController::class, 'reloadCaptcha']);
// route::get('/store-newsletters-country', [NewsLetterController::class, 'store_newsletters_country']);
// route::get('/store-paymentdetails-country', [NewsLetterController::class, 'store_paymentdetails_country']);
// route::get('/store-enqiries-country', [NewsLetterController::class, 'store_enqiries_country']);
// route::get('/store-contactus-country', [NewsLetterController::class, 'store_contactus_country']);
// route::get('/store-careerenquiry-country', [NewsLetterController::class, 'store_careerenquiry_country']);
// Route::view('/mail-template', 'front/layout/mail_layout');

// Backend Routes Admin Start
Route::group(['prefix' => 'admin', 'middleware' => ['prevent-back-history', 'is_admin']], function () {

    Route::get('/dashboard', [LoginController::class, 'dashboard_view'])->name('dashboard');

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category-data-table', 'category_data_table');
        Route::post('/category/store', 'store');
        Route::get('/category/store', function(){ return abort(404); }); // 404 Not Found On Get Request
        Route::get('/category/{id}/edit', 'edit');
    });

    Route::controller(ReportController::class)->group(function () {
        Route::get('/report', 'index');
        Route::get('/report/create', 'create');
        Route::get('/report-data-table', 'report_data_table');
        Route::post('/report/store', 'store');
        Route::post('/report/import', 'report_import')->name('import');
        Route::post('/report/export', 'report_export')->name('export');
        Route::get('/report/sample-report', 'downloadSampleReport')->name('sample_report');
        Route::get('/report/{id}/edit', 'edit');
        Route::post('/report/change-top-selling-report-status', 'change_top_selling_report_status')->name('change-top-selling-report-status');
        Route::post('/report/change-upcoming-report-status', 'change_upcoming_report_status')->name('change-upcoming-report-status');
        Route::get('/report/check-url-exist', 'check_url_exists');
        Route::get('/report/testing', 'store_published_date');
    });

    Route::controller(RelatedReportController::class)->group(function () {
        Route::get('/report/related-reports/{id}', 'index');
        Route::post('/report/related-reports/store', 'store')->name('report.related_report.store');
        Route::get('/report/related-report/related-report-data-table', 'related_report_data_table');
        Route::get('/report/related-report/get-reports-in-category', 'get_reports_in_ctaegory')->name("get_reports_under_category");
    });

    Route::controller(EnquiryController::class)->group(function () {
        Route::get('/enquiry', 'index');
        Route::get('/enquiry-data-table', 'enquiry_data_table');
        Route::post('/enquiry-export/','exportEnqueryData');
    });

    Route::controller(PaymentDetailsController::class)->group(function () {
        Route::get('payment-transaction-details','index');
        Route::get('payment-details-data-table', 'data_table');
        Route::get('export-payment-details','exportPaymentDetails');
    });

    Route::get('page-content', [HomeController::class, 'page_content']);
    // Route::view('page-content', 'admin/cms/pages_content/page_content');

    Route::controller(TestimonialController::class)->group(function () {
        Route::get('testimonials', 'index');
        //Route::get('add-testimonials','admin/cms/testimonials/add_testimonials');
        Route::post('testimonial-store', 'store')->name('testimonial.store');
        Route::get('testimonial-data-table', 'data_table');
        Route::get('testimonial/{id}/edit', 'edit');
    });

    Route::controller(PrivacyPolicyController::class)->group(function () {
        Route::get('privacy-policy', 'index');
        Route::post('privacy-policy-store', 'store')->name('privacy.policy.store');
    });

    Route::controller(TermsWeUseController::class)->group(function () {
        Route::get('terms-of-use', 'index');
        Route::post('terms-of-use-store', 'store')->name('terms.of.use.store');
    });

    Route::controller(BlogController::class)->group(function () {
        Route::get('blogs', 'index');
        Route::get('add-blogs', 'add_blogs');
        Route::post('add-blogs-store', 'store')->name('blog.store');
        Route::get('blog-data-table', 'blog_data_table');
        Route::get('/blog/{id}/edit', 'edit');
        Route::get('/blog/check-blog-slug-url-exist', 'check_blog_slug_url_exist');
    });

    Route::view('add-press-release', 'admin/media/blogs/add_press_release');

    Route::controller(InfographicsController::class)->group(function (){
        Route::get('infographics','index');
        Route::get('add-infographics','add_anfographics');
        Route::post('infographics-store','store')->name('infographics.store');
        Route::get('infographics-data-table', 'data_table');
        Route::get('infographics/{id}/edit','edit');
    });

    Route::view('publishar-or-reports', 'admin/publisher_or_reports/publisher_or_reports');
    Route::view('add-publishar-or-reports', 'admin/publisher_or_reports/add_publisher_or_reports');

    Route::controller(CareerController::class)->group(function () {
        Route::get('careers', 'index');
        Route::post('career-store', 'store')->name('career.store');
        Route::post('career-openings-store', 'store_job_openings')->name('openings.store');
        Route::get('openings-data-table', 'data_table');
        Route::get('openings/{id}/edit', 'edit');
        Route::get('/openings-form-heading', 'form_heading');
    });

    Route::controller(AdminContactController::class)->group(function () {
        Route::get('contact-enquiry','index');
        Route::get('contact-us-listing-data-table', 'data_table');
        Route::get('/export/contact-us','exportContactUs');
    });

    Route::controller(CareerApplicationController::class)->group(function (){
        Route::get('career-applicant', 'index');
        Route::post('career-applicant-store','store')->name('career.application.store');
        Route::get('career-application-data-table', 'data_table');
        Route::get('/export/career-application','exportCareerApplication');
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('homepage', 'index');
        Route::post('homepage-store', 'store')->name('home.store');
        Route::post('client-logo-store', 'store_client_logo')->name('store.client.logo');
        Route::post('delete-client-logo', 'delete_client_logo');
        Route::post('home-banner-image', 'delete_banner_image');
    });

    Route::controller(AboutUsController::class)->group(function () {
        Route::get('about-us', 'index');
        Route::post('about-store', 'store')->name('about.store');
        Route::post('why-choose-us-store', 'store_why_choose_us_content')->name('why.choose.us.store');
        Route::get('why-us-content-data-table', 'data_table');
        Route::get('/why-us-content/{id}/edit', 'why_us_content_edit');
    });

    Route::controller(ConsultingServiceController::class)->group(function () {
        Route::get('services-consulting', 'index');
        Route::post('services-consulting-stote', 'store')->name('consulting.service.store');
    });

    Route::controller(SubscriptionServiceController::class)->group(function () {
        Route::get('services-subscription', 'index');
        Route::post('services-subscription-stote', 'store')->name('subscription.service.store');
    });

    Route::controller(CustomResearchServiceController::class)->group(function () {
        Route::get('services-custom-market-research', 'index');
        Route::post('services-custom-market-research-store', 'store')->name('custom.market.research.service.store');
    });

    Route::controller(WeMarketClientSupportServiceController::class)->group(function () {
        Route::get('services-we-market-client-support', 'index');
        Route::post('services-we-market-client-support-store', 'store')->name('we.market.client.support.service.store');
    });

    Route::controller(GeneralSettings::class)->group(function () {
        Route::get('general-settings-contact', 'index');
        Route::get('general-settings-social-media', 'social_media_index');
        Route::post('general-settings-store', 'store')->name('geraral.settings.store');
    });

    Route::controller(VisualSettings::class)->group(function () {
        Route::get('visual-settings', 'index');
        Route::post('visual-settings-store', 'store')->name('visual.settings.store');
    });
    
    Route::controller(EmailSettings::class)->group(function () {
        Route::get('email-settings', 'index');
        Route::post('email-settings-store', 'store')->name('email.settings.store');
    });

    Route::controller(ResearchMethdologyController::class)->group(function () {
        Route::get('research-methodology','index');
        Route::post('/research-methodology-store', 'store')->name('research.methodology.store');
        Route::post('/research-methodology-store-bannner-image','store_banner_image')->name('research.methodology.banner.store');
        Route::post('research-methodology-banner-image', 'delete_banner_image');
    });

    Route::controller(NewsLetterController::class)->group(function () {
        Route::get('subscriber','index');
        Route::get('subscriber-data-table','data_table');
    });

    Route::controller(RolesPrivilegesController::class)->group(function () {
        Route::get('roles-privileges','index');
        Route::get('roles-privileges/create','create');
        Route::post('roles-privileges/store','store')->name('roles-previllages.store');
        Route::get('roles-privileges/data-table','role_privileges_data_table');
        Route::get('roles-privileges/{id}/edit','edit');
    });

    Route::controller(SystemUserController::class)->group(function () {
        Route::get('system-user-list','index');
        Route::get('system-user/create','create');
        Route::get('system-user/check-user-exist','check_user_exist');
        Route::post('system-user/store','store')->name('system-user.store');
        Route::get('system-user/data-table','system_user_data_table');
        Route::get('system-user/{id}/edit','edit');
    });

    // Route::view('email-settings', 'admin/settings/email_settings');
    // Route::view('visual-settings', 'admin/settings/visual_settings');
    Route::get('change-password', [LoginController::class, 'view_change_password']);
    Route::post('change-password', [LoginController::class, 'change_password']);
    Route::get('logout', [LoginController::class, 'logout']);

    Route::get('common-delete', [BaseController::class, 'delete']);
    Route::post('change-status', [BaseController::class, 'status'])->name('change-status');
    // Route::get('country', function () {
    //     return view('admin.master.country.country');
    // });
});


// Route::get('forgot-password-new', function () {
//     // return 'asdsa';
//     return view('admin/login/forgot-password-new');
// });
// Route::get('reset-password-new', function () {
//     // return 'asdsa';
//     return view('admin/login/reset-password-new');
// });
// Route::get('otp-new', function () {
//     // return 'asdsa';
//     return view('admin/login/otp-new');
// });
// Route::get('change-password-new', function () {
//     // return 'asdsa';
//     return view('admin/login/change-password-new');
// });

Route::fallback(function () {
    return redirect('/404');
});
