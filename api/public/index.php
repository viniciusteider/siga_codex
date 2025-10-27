<?php

require '../vendor/autoload.php';
include_once('../../includes/config/banco.php');

use App\Router;
use App\Controllers\ApiController;
use App\Controllers\AuthController;
use App\Controllers\ConfigurationController;
use App\Controllers\HospitalController;
use App\Controllers\OccurrenceController;
use App\Controllers\PatientController;

$router = new Router();
$authController = new AuthController();

// Middleware para autenticação JWT
function authenticate($handler)
{
    return function(...$params) use ($handler) {
        $headers = getallheaders();
        if (isset($headers['Authorization']) || isset($headers['authorization'])) {
            $token = str_replace('Bearer ', '', ($headers['Authorization'] ?? $headers['authorization']));
            global $authController;
            $user = $authController->validateToken($token);
            if ($user) {
                if (!is_array($params)) {
                    $params = [];
                }
                array_unshift($params, $user);
                call_user_func_array($handler, $params);
                return;
            }
        }
        http_response_code(401);
        echo json_encode(['message' => 'Unauthorized']);
    };
}

// Rota de login
$router->addRoute('POST', '/api/login', function() use ($authController) {
    $authController->login();
});

$router->addRoute('GET', '/api/hospital', authenticate(function($user) {
    (new HospitalController)->get($user);
}));

$router->addRoute('GET', '/api/hospital/search', authenticate(function($user) {
    (new HospitalController)->search($user);
}));    

$router->addRoute('GET', '/api/config/dropdown', authenticate(function($user) {
    (new ConfigurationController)->getDropdown($user);
}));

$router->addRoute('GET', '/api/config/medicamentos/search', authenticate(function($user) {
    (new ConfigurationController)->searchMedicamentos($user);
}));

$router->addRoute('GET', '/api/config/materiais/search', authenticate(function($user) {
    (new ConfigurationController)->searchMateriais($user);
}));

$router->addRoute('GET', '/api/config/resource/information', authenticate(function($user) {
    (new ConfigurationController)->getResourceInformation($user);
}));

$router->addRoute('GET', '/api/occurrence', authenticate(function($user) {
    (new OccurrenceController)->getActualOccurrence($user);
}));

$router->addRoute('PUT', '/api/occurrence/qth', authenticate(function($user) {
    (new OccurrenceController)->updateQTH($user);
}));

$router->addRoute('POST', '/api/occurrence/request_support', authenticate(function($user) {
    (new OccurrenceController)->requestSupport($user);
}));

$router->addRoute('POST', '/api/occurrence/confirm', authenticate(function($user) {
    (new OccurrenceController)->confirmOccurrence($user);
}));

$router->addRoute('POST', '/api/patient', authenticate(function($user) {
    (new PatientController)->createPatient($user);
}));

$router->addRoute('GET', '/api/patient/{id}', authenticate(function($user, $id) {
    (new PatientController)->getPacient($user, $id);
}));
$router->addRoute('GET', '/api/patients', authenticate(function($user) {
    (new PatientController)->listPatients($user);
}));
$router->addRoute('PUT', '/api/patient/{id}', authenticate(function($user, $id) {
    (new PatientController)->updatePacient($user, $id);
}));

$router->addRoute('DELETE', '/api/patient/{id}', authenticate(function($user, $id) {
    (new PatientController)->deletePatient($user, $id);
}));

$router->addRoute('PUT', '/api/patient/material/{id}/signature', authenticate(function($user, $id) {
    (new PatientController)->updateSignature($user, $id);
}));

// $router->addRoute('DELETE', '/api/{id}', authenticate(function($user, $id) {
//     (new ApiController)->delete($id);
// }));

// Lidar com a requisição
$router->handleRequest();
