<?php
/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/30/18
 * Time: 4:30 PM
 */

namespace App\patientportal\repositories\repoInterface;
use App\Http\ViewModels\PatientDentalViewModel;
use App\Http\ViewModels\PatientScanViewModel;
use App\Http\ViewModels\PatientUrineExaminationViewModel;
use App\Http\ViewModels\PatientXRayViewModel;
use App\Http\ViewModels\TestResultsViewModel;

/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/27/18
 * Time: 4:24 PM
 */
interface LabInterface
{
public function getAppointment($request);
public function loadLabs($request);
public function loadSubTests($request);
public function getBloodTestsEntries();
public function getMotionTestsEntries();
public function getUrineTestsEntries();
public function getUltrasoundTestsEntries();
public function getScanTestsEntries();
public function getDentalTestsEntries();
public function getXrayTestsEntries();
public function savePatientScanDetailsNew(PatientScanViewModel $patientScanVM);
public function savePatientUrineTests(PatientUrineExaminationViewModel $patientUrineVM);
public function savePatientUrineTestsNew(PatientUrineExaminationViewModel $patientUrineVM);
public function savePatientMotionTests(PatientUrineExaminationViewModel $patientMotionVM);
public function savePatientMotionTestsNew(PatientUrineExaminationViewModel $patientMotionVM);

public function savePatientBloodTestsNew1(PatientUrineExaminationViewModel $patientBloodVM);
public function savePatientUltraSoundTestsNew(PatientUrineExaminationViewModel $patientUltraSoundVM);
public function savePatientDentalTests(PatientDentalViewModel $patientDentalVM);
public function savePatientXRayTests(PatientXRayViewModel $patientXRayVM);
public function getExaminationDates($patientId, $hospitalId);


}