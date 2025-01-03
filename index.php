<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'validate.php';
    include 'calculate.php';

    $companyName = $_POST["companyName"];
    $cnpj = $_POST["cnpj"];
    $invoiceValue = floatval($_POST["invoiceValue"]);
    $taxType = $_POST["taxType"];

    // Validações
    if (!validateCNPJ($cnpj)) {
        echo "CNPJ no formato incorreto!";
        return;
    }
    if ($invoiceValue <= 0) {
        echo "O valor da nota fiscal deve ser um número positivo!";
        return;
    }
    if (empty($companyName)) {
        echo "O campo Nome da Empresa deve ser preenchido!";
        return;
    }

    // Cálculo do imposto
    $taxValue = calculateTax($invoiceValue, $taxType);
    $finalValue = $invoiceValue - $taxValue;

    // Retorno dos resultados
    echo json_encode([
        "companyName" => $companyName,
        "cnpj" => $cnpj,
        "taxType" => strtoupper($taxType),
        "invoiceValue" => number_format($invoiceValue, 2, ',', '.'),
        "taxValue" => number_format($taxValue, 2, ',', '.'),
        "finalValue" => number_format($finalValue, 2, ',', '.')
    ]);
}
?>
