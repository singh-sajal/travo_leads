<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\AuthController;
use App\Http\Controllers\Agent\LeadController;
use App\Http\Controllers\Agent\MailController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Agent\WalletController;






// --------Un protected routes----------------------

Route::middleware('guest:agent')->group(function () {
    Route::get('register', [AgentController::class, 'registerPage'])->name('register');
    Route::post('store', [AgentController::class, 'store'])->name('store');
    Route::get('verification', [AgentController::class, 'verification_page'])->name('verification');

    // this stores and verify the agent documents
    Route::post('verifyDetails', [AgentController::class, 'verifyDetails'])->name('verifyDetails');

    // Send OTP (Phone or Email)
    Route::post('send-otp', [MailController::class, 'sendOtp'])->name('sendOtp');

    // Resend OTP
    Route::post('resendOtp', [MailController::class, 'resendOtp'])->name('resendOtp');

    // Verify OTP
    Route::post('verifyOtp', [MailController::class, 'verifyOtp'])->name('verifyOtp');

    // check status for email verification
    Route::get('check-verification-status', [MailController::class, 'checkVerificationStatus'])->name('checkVerificationStatus');


    // Routes after registration is complete...................
    Route::get('login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('login', [AuthController::class, 'verifyLogin'])->name('verifyLogin');
});


Route::middleware(['auth:agent', 'revalidateSession'])->group(function () {

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('change-password', [AuthController::class, 'changePassword'])->name('changePassword');
    Route::post('update-password', [AuthController::class, 'updatePassword'])->name('updatePassword');


    Route::get('home', [AgentController::class, 'home'])->name('home');
    Route::get('myAccount', [AgentController::class, 'myAccount'])->name('myAccount');
    Route::get('analytics_and_report', [AgentController::class, 'analyticsAndReport'])->name('analyticsAndReport');
    Route::get('companyInfo', [AgentController::class, 'companyInfo'])->name('companyInfo');
    Route::post('store-Company-Info', [AgentController::class, 'storeCompanyInfo'])->name('storeCompanyInfo');
    Route::get('personal-details', [AgentController::class, 'personalDetails'])->name('personalDetails');
    Route::get('support', [AgentController::class, 'supportPage'])->name('support');


    Route::get('buyLeads', [LeadController::class, 'buyLeads'])->name('buyLeads');
    Route::get('myLeads', [LeadController::class, 'myLeads'])->name('myLeads');
    Route::get('filter-leads', [LeadController::class, 'filterLeads'])->name('filterLeads');
    Route::get('filter-my-leads', [LeadController::class, 'filterMyLeads'])->name('filterMyLeads');
    Route::post('boughtLead', [LeadController::class, 'boughtLead'])->name('boughtLead');
    Route::get('balance', [LeadController::class, 'balance'])->name('balance');
    Route::post('leads/{lead}/follow-up', [LeadController::class, 'updateFollowUp'])->name('agent.leads.followup');







    Route::get('wallet', [WalletController::class, 'walletPage'])->name('wallet');




});
