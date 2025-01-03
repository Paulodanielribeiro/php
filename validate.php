<?php
function validateCNPJ($cnpj) {
    $pattern = "/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/";
    return preg_match($pattern, $cnpj);
}
?>
