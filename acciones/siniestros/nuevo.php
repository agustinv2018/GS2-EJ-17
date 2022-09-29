<?php

header('Content-Type: application/json');

require_once 'responses/nuevoResponse.php';
require_once 'request/nuevoRequest.php';

$json = file_get_contents('php://input', true);
$req = json_decode($json);

$resp = new NuevoResponse();
$resp->IsOk = true;


if ($req->NroPoliza > 1000 or $req->NroPoliza < 0) {
    $resp->IsOk = false;
    $resp->Mensaje = 'La póliza no existe';
}

if ($req->Vehiculo = null) {
    $resp->IsOk = false;
    $resp->Mensaje = 'Debe indicar el vehiculo';
}

if ($req->Vehiculo->Marca = null or $req->Vehiculo->Modelo = null or $req->Vehiculo->Version = null or $req->Vehiculo->Anio = null) {
    $resp->IsOk = false;
    $resp->Mensaje = 'Debe indicar todas las propiedades del vehiculo';
}

$cantmedios = 0;

foreach ($req->ListMediosContacto as $c) {
    $cantmedios =  $cantmedios + 1;
}
if ($cantmedios < 0) {
    $resp->IsOk = false;
    $resp->Mensaje = 'Debe indicar al menos un medio de contacto';
}

$m1 = new MediosContacto();
$m1->MedioContactoDescripcion = 'Celular';
$m1->Valor = '';

$m2 = new MediosContacto();
$m2->MedioContactoDescripcion = 'Mail';
$m2->Valor = '';




