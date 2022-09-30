<?php

header('Content-Type: application/json');

require_once 'responses/nuevoResponse.php';
require_once 'request/nuevoRequest.php';
require_once '../../modelo/medioscontacto.php';
require_once '../../modelo/vehiculo.php';

$json = file_get_contents('php://input', true);
$req = json_decode($json);

$resp = new NuevoResponse();
$resp->IsOk = true;


if ($req->NroPoliza > 1000 or $req->NroPoliza < 0) {
    $resp->IsOk = false;
    $resp->Mensaje[] = 'La póliza no existe';
} else {
    if ($req->Vehiculo == null) {
        $resp->IsOk = false;
        $resp->Mensaje[] = 'Debe indicar el vehiculo';
    }

    if ($req->Vehiculo->Marca == null or $req->Vehiculo->Modelo == null or $req->Vehiculo->Version == null or $req->Vehiculo->Anio == null) {
        $resp->IsOk = false;
        $resp->Mensaje[] = 'Debe indicar todas las propiedades del vehiculo';
    }

    $cantmedios = 0;

    foreach ($req->ListMediosContacto as $c) {
        $cantmedios =  $cantmedios + 1;
    }
    if ($cantmedios <= 0) {
        $resp->IsOk = false;
        $resp->Mensaje = 'Debe indicar al menos un medio de contacto';
    }

    foreach ($req->ListMediosContacto as $mc) {

        if ($mc->MedioContactoDescripcion != 'Celular' && $mc->MedioContactoDescripcion != 'Email') {
            $resp->IsOk = false;
            $resp->Mensaje[] = 'Debe indicar medios de contacto válidos';
        }
    }
}
echo json_encode($resp);
