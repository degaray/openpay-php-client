<?php

namespace Openpay\Client\Exception;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 8/01/16
 * Time: 06:02 PM
 */
class OpenpayExceptionsDictionary
{
    public static function get()
    {
        return [       
            1000 => [
                'error_code' => '1000',
                'description' => 'Ocurrió un error interno en el servidor de Openpay',
                'category' => 'general',
                'http_code' => '500'
            ],
            1001 => [
                'error_code' => '1001',
                'description' => 'El formato de la petición no es JSON, los campos no tienen el formato correcto, o la petición no tiene campos que son requeridos.',
                'category' => 'general',
                'http_code' => '400'
            ],
            1002 => [
                'error_code' => '1002',
                'description' => 'La llamada no esta autenticada o la autenticación es incorrecta.',
                'category' => 'general',
                'http_code' => '401'
            ],
            1003 => [
                'error_code' => '1003',
                'description' => 'La operación no se pudo completar por que el valor de uno o más de los parametros no es correcto.',
                'category' => 'general',
                'http_code' => '422'
            ],
            1004 => [
                'error_code' => '1004',
                'description' => 'Un servicio necesario para el procesamiento de la transacción no se encuentra disponible.',
                'category' => 'general',
                'http_code' => '503'
            ],
            1005 => [
                'error_code' => '1005',
                'description' => 'Uno de los recursos requeridos no existe.',
                'category' => 'general',
                'http_code' => '404'
            ],
            1006 => [
                'error_code' => '1006',
                'description' => 'Ya existe una transacción con el mismo ID de orden.',
                'category' => 'general',
                'http_code' => '409'
            ],
            1007 => [
                'error_code' => '1007',
                'description' => 'La transferencia de fondos entre una cuenta de banco o tarjeta y la cuenta de Openpay no fue aceptada.',
                'category' => 'general',
                'http_code' => '402'
            ],
            1008 => [
                'error_code' => '1008',
                'description' => 'Una de las cuentas requeridas en la petición se encuentra desactivada.',
                'category' => 'general',
                'http_code' => '423'
            ],
            1009 => [
                'error_code' => '1009',
                'description' => 'El cuerpo de la petición es demasiado grande.',
                'category' => 'general',
                'http_code' => '413'
            ],
            1010 => [
                'error_code' => '1010',
                'description' => 'Se esta utilizando la llave pública para hacer una llamada que requiere la llave privada, o bien, se esta usando la llave privada desde JavaScript.',
                'category' => 'general',
                'http_code' => '403'
            ],
            2001 => [
                'error_code' => '2001',
                'description' => 'La cuenta de banco con esta CLABE ya se encuentra registrada en el cliente.',
                'category' => 'almacenamiento',
                'http_code' => '409'
            ],
            2002 => [
                'error_code' => '2002',
                'description' => 'La tarjeta con este número ya se encuentra registrada en el cliente.',
                'category' => 'almacenamiento',
                'http_code' => '409'
            ],
            2003 => [
                'error_code' => '2003',
                'description' => 'El cliente con este identificador externo (External ID) ya existe.',
                'category' => 'almacenamiento',
                'http_code' => '409'
            ],
            2004 => [
                'error_code' => '2004',
                'description' => 'El dígito verificador del número de tarjeta es inválido de acuerdo al algoritmo Luhn.',
                'category' => 'almacenamiento',
                'http_code' => '422'
            ],
            2005 => [
                'error_code' => '2005',
                'description' => 'La fecha de expiración de la tarjeta es anterior a la fecha actual.',
                'category' => 'almacenamiento',
                'http_code' => '400'
            ],
            2006 => [
                'error_code' => '2006',
                'description' => 'El código de seguridad de la tarjeta (CVV2) no fue proporcionado.',
                'category' => 'almacenamiento',
                'http_code' => '400'
            ],
            2007 => [
                'error_code' => '2007',
                'description' => 'El número de tarjeta es de prueba, solamente puede usarse en Sandbox.',
                'category' => 'almacenamiento',
                'http_code' => '412'
            ],
            3001 => [
                'error_code' => '3001',
                'description' => 'La tarjeta fue declinada.',
                'category' => 'tarjetas',
                'http_code' => '402'
            ],
            3002 => [
                'error_code' => '3002',
                'description' => 'La tarjeta ha expirado.',
                'category' => 'tarjetas',
                'http_code' => '402'
            ],
            3003 => [
                'error_code' => '3003',
                'description' => 'La tarjeta no tiene fondos suficientes.',
                'category' => 'tarjetas',
                'http_code' => '402'
            ],
            3004 => [
                'error_code' => '3004',
                'description' => 'La tarjeta ha sido identificada como una tarjeta robada.',
                'category' => 'tarjetas',
                'http_code' => '402'
            ],
            3005 => [
                'error_code' => '3005',
                'description' => 'La tarjeta ha sido identificada como una tarjeta fraudulenta.',
                'category' => 'tarjetas',
                'http_code' => '402'
            ],
            3006 => [
                'error_code' => '3006',
                'description' => 'La operación no esta permitida para este cliente o esta transacción.',
                'category' => 'tarjetas',
                'http_code' => '412'
            ],
            3008 => [
                'error_code' => '3008',
                'description' => 'La tarjeta no es soportada en transacciones en linea.',
                'category' => 'tarjetas',
                'http_code' => '412'
            ],
            3009 => [
                'error_code' => '3009',
                'description' => 'La tarjeta fue reportada como perdida.',
                'category' => 'tarjetas',
                'http_code' => '402'
            ],
            3010 => [
                'error_code' => '3010',
                'description' => 'El banco ha restringido la tarjeta.',
                'category' => 'tarjetas',
                'http_code' => '402'
            ],
            3011 => [
                'error_code' => '3011',
                'description' => 'El banco ha solicitado que la tarjeta sea retenida. Contacte al banco.',
                'category' => 'tarjetas',
                'http_code' => '402'
            ],
            3012 => [
                'error_code' => '3012',
                'description' => 'Se requiere solicitar al banco autorización para realizar este pago.',
                'category' => 'tarjetas',
                'http_code' => '412'
            ],
            4001 => [
                'error_code' => '4001',
                'description' => 'La cuenta de Openpay no tiene fondos suficientes.',
                'category' => 'cuentas',
                'http_code' => '412'
            ],
        ];
    }
}