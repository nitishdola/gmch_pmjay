<?php

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

Route::get('/pass', function () {
    return Hash::make('gmch1234');
});

Route::group(['prefix' => 'cron'], function () {
  Route::get('/', 'Cron\CronJobController@completeProcess')->name('cron.process_complete');
});

Route::group(['prefix' => 'rest'], function () {
  Route::get('/add-claims-info', 'REST\ApiController@addClaimsInfo')->name('rest.add_claims_info');
  Route::get('/get-blood-transfusion-info', 'REST\ApiController@getBloodTransfusionRate')->name('rest.get_blood_transfusion_info');
  Route::get('/get-patient-count', 'REST\ApiController@getPatientCount')->name('rest.getPatientCount');
  Route::get('/get-claims-received-data', 'REST\ApiController@getClaimReceivedInfo')->name('rest.claims_received_data');
  Route::get('/get-claims-pending-data', 'REST\ApiController@getPendingClaimsInfo')->name('rest.claims_pending_data');
});

Route::get('/get-beneficiary-details', 'REST\ApiController@getBeneficiaryDetails')->name('api.beneficiary_details');
Route::get('/get-test-details', 'REST\ApiController@labTestDetails')->name('api.test_details');
Route::get('/get-package-details', 'REST\ApiController@pmjayPackageDetails')->name('api.pmjay.package_details');

Route::get('/get-remaining-amount', 'REST\ApiController@getBalance')->name('api.pmjay.get_balance');

Route::get('/upload-data', 'Upload\UploadsController@uploadData')->name('updata');
Route::post('/save-data', 'Upload\UploadsController@saveData')->name('savedata');

Route::get('/upload-ward-data', 'Upload\UploadsController@uploadWards')->name('updatawards');
Route::post('/save-ward-data', 'Upload\UploadsController@saveWards')->name('savedatawards');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'beneficary-details'], function () {
  Route::get('/', 'BeneficiaryDetailController@viewAll')->name('beneficary_details.view_all');
  Route::get('{num}/view-details', 'BeneficiaryDetailController@viewBeneficiary')->name('beneficary_details.view_beneficiary');
  Route::get('/create', 'BeneficiaryDetailController@create')->name('beneficary_details.create');
  Route::post('/save', 'BeneficiaryDetailController@save')->name('beneficary_details.save');

  Route::group(['prefix' => 'cancel'], function () {
    Route::get('/{num}', 'BeneficiaryCancelController@create')->name('beneficary_details.cancel.create');
    Route::post('/save', 'BeneficiaryCancelController@save')->name('beneficary_details.cancel.save');
  });

  Route::group(['prefix' => 'additional-package'], function () {
    Route::get('/add', 'BeneficiaryDetailsAdditionalPackagesController@create')->name('beneficary_details.additional_package.create');
    Route::get('/', 'BeneficiaryDetailsAdditionalPackagesController@index')->name('beneficary_details.additional_package.index');
    Route::post('/save', 'BeneficiaryDetailsAdditionalPackagesController@save')->name('beneficary_details.additional_package.save');
  });



  Route::group(['prefix' => 'investigation'], function () {
  	Route::get('/add', 'BeneficiaryInvestigationController@create')->name('beneficary_details.investigation.create');
  	Route::post('/save', 'BeneficiaryInvestigationController@save')->name('beneficary_details.investigation.save');

  	Route::group(['prefix' => 'srl'], function () {
  		Route::get('/add', 'BeneficiarySrlController@create')->name('beneficary_details.investigation.srl.create');
  		Route::post('/save', 'BeneficiarySrlController@save')->name('beneficary_details.investigation.srl.save');
  	});

    Route::group(['prefix' => 'blood-transfusions'], function () {
      Route::get('/add', 'BeneficiaryDetailsBloodTransfusionController@create')->name('beneficary_details.blood_transfusions.create');
      Route::post('/save', 'BeneficiaryDetailsBloodTransfusionController@save')->name('beneficary_details.blood_transfusions.save');
    });

    Route::group(['prefix' => 'ot-charges'], function () {
      Route::get('/add', 'BeneficiaryDetailsOTChargeController@create')->name('beneficary_details.ot_charges.create');
      Route::post('/save', 'BeneficiaryDetailsOTChargeController@save')->name('beneficary_details.ot_charges.save');
    });

    Route::group(['prefix' => 'blood-test'], function () {
      Route::get('/add', 'BeneficiaryDetailsBloodTestController@create')->name('beneficary_details.blood_test.create');
      Route::post('/save', 'BeneficiaryDetailsBloodTestController@save')->name('beneficary_details.blood_test.save');
    });

    Route::group(['prefix' => 'icu-charge'], function () {
      Route::get('/add', 'BeneficiaryDetailsIcuChargeController@create')->name('beneficary_details.icu.create');
      Route::post('/save', 'BeneficiaryDetailsIcuChargeController@save')->name('beneficary_details.icu.save');
    });


    Route::group(['prefix' => 'bed-charge'], function () {
      Route::get('/add', 'BeneficiaryDetailsBedChargeController@create')->name('beneficary_details.bed_charge.create');
      Route::post('/save', 'BeneficiaryDetailsBedChargeController@save')->name('beneficary_details.bed_charge.save');
    });

    Route::group(['prefix' => 'dialysis'], function () {
      Route::get('/add', 'BeneficiaryDetailDialysisChargeController@create')->name('beneficary_details.dialysis.create');
      Route::post('/save', 'BeneficiaryDetailDialysisChargeController@save')->name('beneficary_details.dialysis.save');
    });


    Route::group(['prefix' => 'endorscopy'], function () {
      Route::get('/add', 'BeneficiaryDetailEndorscopyChargeController@create')->name('beneficary_details.endorscopy.create');
      Route::post('/save', 'BeneficiaryDetailEndorscopyChargeController@save')->name('beneficary_details.endorscopy.save');
    });


    Route::group(['prefix' => 'pet-ct'], function () {
      Route::get('/add', 'BeneficiaryDetailPetCtController@create')->name('beneficary_details.pet_ct.create');
      Route::post('/save', 'BeneficiaryDetailPetCtController@save')->name('beneficary_details.pet_ct.save');
    });


    Route::group(['prefix' => 'discharge-info'], function () {
      Route::get('/add', 'BeneficiaryDetailController@createDischargeInfo')->name('beneficary_details.discharge_info.create');
      Route::post('/save', 'BeneficiaryDetailController@saveDischargeInfo')->name('beneficary_details.discharge_info.save');
    });

  });


  Route::group(['prefix' => 'medicine'], function () {
  	Route::get('/add', 'BeneficiaryMedicineController@create')->name('beneficary_details.medicine.create');
  	Route::post('/save', 'BeneficiaryMedicineController@save')->name('beneficary_details.medicine.save');

  	Route::group(['prefix' => 'return'], function () {
  		Route::get('/add', 'BeneficiaryMedicineReturnController@create')->name('beneficary_details.medicine_return.create');
  		Route::post('/save', 'BeneficiaryMedicineReturnController@save')->name('beneficary_details.medicine_return.save');
  	});
  });

  Route::group(['prefix' => 'reimbursement'], function () {
  	Route::group(['prefix' => 'vendor'], function () {
  		Route::get('/add', 'BeneficiaryVendorReimbursementController@create')->name('beneficary_details.reimbursement.vendor.create');
  		Route::post('/save', 'BeneficiaryVendorReimbursementController@save')->name('beneficary_details.reimbursement.vendor.save');
  	});

  	Route::group(['prefix' => 'beneficiary'], function () {
  		Route::get('/add', 'BeneficiaryReimbursementController@create')->name('beneficary_details.reimbursement.beneficiary.create');
  		Route::post('/save', 'BeneficiaryReimbursementController@save')->name('beneficary_details.reimbursement.beneficiary.save');
  	});

  });

});

Route::group(['prefix' => 'reports'], function () {
  Route::group(['prefix' => 'pmjay'], function () {
    Route::get('/not-discharged-reports', 'Reports\PmjayReportsController@beneficiaryDischargeReport')->name('reports.pmjay.beneficiary_discharge_report');

    Route::get('/not-paid-reports', 'Reports\PmjayReportsController@beneficiaryClaimReportSha')->name('reports.pmjay.not_paid_sha');

    Route::get('/investigation', 'Reports\PmjayReportsController@investigationReport')->name('reports.pmjay.investigation');

    Route::get('/medicine-bills', 'Reports\PmjayReportsController@medicineReport')->name('reports.pmjay.medicine');

    Route::get('/medicine-return-bills', 'Reports\PmjayReportsController@medicineReturnReport')->name('reports.pmjay.medicine_return');

    Route::get('/srl', 'Reports\PmjayReportsController@srlReport')->name('reports.pmjay.srl');

    Route::get('/vendor-reimbursements', 'Reports\PmjayReportsController@vendorPaymentReport')->name('reports.pmjay.vendor_reimbursement');

    Route::get('/beneficiary-reimbursements', 'Reports\PmjayReportsController@beneficiaryPaymentReport')->name('reports.pmjay.beneficiary_reimbursement');

    Route::get('/blood-transfusions', 'Reports\PmjayReportsController@bloodTransfusionReport')->name('reports.pmjay.blood_transfusions');

    Route::get('/ot', 'Reports\PmjayReportsController@otReport')->name('reports.pmjay.ot');
    Route::get('/icu', 'Reports\PmjayReportsController@icuReport')->name('reports.pmjay.icu');
    Route::get('/bed', 'Reports\PmjayReportsController@bedChargeReport')->name('reports.pmjay.bed');
    Route::get('/dialysis', 'Reports\PmjayReportsController@dialysisReport')->name('reports.pmjay.dialysis');
    Route::get('/pet-ct', 'Reports\PmjayReportsController@petCtReport')->name('reports.pmjay.pet_ct');

  });
});

Route::group(['prefix' => 'change-password'], function () {
  Route::get('/', 'UsersController@changePassword')->name('change_password');
  Route::post('/', 'UsersController@savePassword')->name('change_password.save');
});


Route::group(['prefix' => 'user'], function () {
  Route::get('/create', 'UsersController@create')->name('user.create');
  Route::post('/save', 'UsersController@save')->name('user.save');
  Route::get('/', 'UsersController@index')->name('user.index');

  Route::get('/edit/{id}', 'UsersController@edit')->name('user.edit');
  Route::post('/update/{id}', 'UsersController@update')->name('user.update');
});


Route::group(['prefix' => 'honorarium'], function () {
  Route::get('/create', 'HonorariumsController@create')->name('honorarium.create');
  Route::post('/save', 'HonorariumsController@save')->name('honorarium.save');
  Route::get('/', 'HonorariumsController@index')->name('honorarium.index');
});



