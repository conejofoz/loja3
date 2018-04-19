<?php

require __DIR__ . '/bootstrap.php';

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class Paypal {

    static public function mdlPagoPaypal($datos) {
        $tituloArray = explode(",", $datos["tituloArray"]);
        $cantidadArray = explode(",", $datos["$cantidadArray"]);
        $valorItemArray = explode(",", $datos["$valorItemArray"]);
        $idProductoArray = explode(",", $datos["$idProductoArray"]);

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item = array();
        $variosItem = array();

        for ($i = 0; $i < count($tituloArray); $i++) {
            $item[$i] = new Item();
            $item[$i]->setName($tituloArray[$i])
                    ->setCurrency($datos["divisa"])
                    ->setQuantity($cantidadArray[$i])
                    ->setPrice($valorItemArray[$i] / $cantidadArray[$i]);

            array_push($variosItem, $item[$i]);
        }
        $itemList = new ItemList();
        $itemList->setItems($variosItem);

        $details = new Details();
        $details->setShipping($datos["envio"])
                ->setTax($datos["impuesto"])
                ->setSubtotal($datos["subtotal"]);

        $amount = new Amount();
        $amount->setCurrency($datos["divisa"])
                ->setTotal($datos["total"])
                ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());

        //$baseUrl = getBaseUrl();
        //$baseUrl = "";
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost/loja3/ExecutePayment.php?success=true")
                ->setCancelUrl("http://localhost/loja3/ExecutePayment.php?success=false");
    }

}
