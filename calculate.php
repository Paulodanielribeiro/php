<?php
function calculateTax($invoiceValue, $taxType) {
    $taxRate = 0;
    switch ($taxType) {
        case "iss":
            $taxRate = 0.05;
            break;
        case "icms":
            $taxRate = 0.12;
            break;
        case "pis_cofins":
            $taxRate = 0.0925;
            break;
    }
    return $invoiceValue * $taxRate;
}
?>
