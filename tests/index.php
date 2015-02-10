<?php

require 'Test.php';
require 'SignUpTest.php';
require 'EditUserTest.php';

//echo bin2hex(hash_pbkdf2('sha512', hex2bin('00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000'), hex2bin('00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000'), 64000, 0, true));
//0d041dbc8cd38a8d989a5a19a8746d79b706d28b72a1d1112f96ffd72d7d5cd2950034f1bd7a145959c84b49fcacb56d8d75069527a62ffaf886852255c305f3

(new SignUpTest())->execute();
(new EditUserTest())->execute();







//require 'private/scripts/Controller/Account/Get.php';
//require 'private/scripts/Controller/Account/RecoverPassword.php';
//require 'private/scripts/Controller/Background/Create.php';
//require 'private/scripts/Controller/Background/Delete.php';
//require 'private/scripts/Controller/Background/Edit.php';
//require 'private/scripts/Controller/Background/Get.php';
//require 'private/scripts/Controller/Background/Search.php';
//require 'private/scripts/Controller/ClinicalImpression/Create.php';
//require 'private/scripts/Controller/ClinicalImpression/Delete.php';
//require 'private/scripts/Controller/ClinicalImpression/Edit.php';
//require 'private/scripts/Controller/ClinicalImpression/Get.php';
//require 'private/scripts/Controller/ClinicalImpression/Search.php';
//require 'private/scripts/Controller/Consultation/Create.php';
//require 'private/scripts/Controller/Consultation/Delete.php';
//require 'private/scripts/Controller/Consultation/Edit.php';
//require 'private/scripts/Controller/Consultation/Get.php';
//require 'private/scripts/Controller/Diagnosis/Create.php';
//require 'private/scripts/Controller/Diagnosis/Delete.php';
//require 'private/scripts/Controller/Diagnosis/Edit.php';
//require 'private/scripts/Controller/Diagnosis/Get.php';
//require 'private/scripts/Controller/Diagnosis/Search.php';
//require 'private/scripts/Controller/Experiment/Create.php';
//require 'private/scripts/Controller/Experiment/Delete.php';
//require 'private/scripts/Controller/Experiment/Edit.php';
//require 'private/scripts/Controller/Experiment/Get.php';
//require 'private/scripts/Controller/Experiment/Search.php';
//require 'private/scripts/Controller/File/Download.php';
//require 'private/scripts/Controller/File/Get.php';
//require 'private/scripts/Controller/File/Upload.php';
//require 'private/scripts/Controller/ImageTest/Create.php';
//require 'private/scripts/Controller/ImageTest/Delete.php';
//require 'private/scripts/Controller/ImageTest/Edit.php';
//require 'private/scripts/Controller/ImageTest/Get.php';
//require 'private/scripts/Controller/ImageTest/Search.php';
//require 'private/scripts/Controller/LaboratoryTest/Create.php';
//require 'private/scripts/Controller/LaboratoryTest/Delete.php';
//require 'private/scripts/Controller/LaboratoryTest/Edit.php';
//require 'private/scripts/Controller/LaboratoryTest/Get.php';
//require 'private/scripts/Controller/LaboratoryTest/Search.php';
//require 'private/scripts/Controller/Log/Get.php';
//require 'private/scripts/Controller/Log/Search.php';
//require 'private/scripts/Controller/Medication/Create.php';
//require 'private/scripts/Controller/Medication/Delete.php';
//require 'private/scripts/Controller/Medication/Edit.php';
//require 'private/scripts/Controller/Medication/Get.php';
//require 'private/scripts/Controller/Medication/Search.php';
//require 'private/scripts/Controller/NeurocognitiveTest/Create.php';
//require 'private/scripts/Controller/NeurocognitiveTest/Delete.php';
//require 'private/scripts/Controller/NeurocognitiveTest/Edit.php';
//require 'private/scripts/Controller/NeurocognitiveTest/Get.php';
//require 'private/scripts/Controller/NeurocognitiveTest/Search.php';
//require 'private/scripts/Controller/Patient/Create.php';
//require 'private/scripts/Controller/Patient/Delete.php';
//require 'private/scripts/Controller/Patient/Edit.php';
//require 'private/scripts/Controller/Patient/Get.php';
//require 'private/scripts/Controller/Patient/Search.php';
//require 'private/scripts/Controller/RecoverPasswordPermission/Create.php';
//require 'private/scripts/Controller/SignUpPermission/Create.php';
//require 'private/scripts/Controller/Study/Conduct.php';
//require 'private/scripts/Controller/Study/Create.php';
//require 'private/scripts/Controller/Study/Delete.php';
//require 'private/scripts/Controller/Study/Edit.php';
//require 'private/scripts/Controller/Study/Get.php';
//require 'private/scripts/Controller/Treatment/Create.php';
//require 'private/scripts/Controller/Treatment/Delete.php';
//require 'private/scripts/Controller/Treatment/Edit.php';
//require 'private/scripts/Controller/Treatment/Get.php';
//require 'private/scripts/Controller/Treatment/Search.php';
//require 'private/scripts/Controller/User/Delete.php';
//require 'private/scripts/Controller/User/Get.php';
