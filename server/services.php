<?php

$app = \Slim\Slim::getInstance();

$app->post('/get-patient', function() use ($app) {
	$input = (object) $app->request->getBody();
	
	$app->log->debug('get-patient called: ' . $input->patientId);
});
