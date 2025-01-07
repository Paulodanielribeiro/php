<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verifique se as chaves existem no array $_GET antes de acessá-las
    $companyName = $_GET["companyName"] ?? '';
    $cnpj = $_GET["cnpj"] ?? '';
    $invoiceValue = isset($_GET["invoiceValue"]) ? floatval($_GET["invoiceValue"]) : 0;
    $taxType = $_GET["taxType"] ?? '';

    // Validações
    if (empty($cnpj) || !preg_match("/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/", $cnpj)) {
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
    $taxRate = match ($taxType) {
        "iss" => 0.05,
        "icms" => 0.12,
        "pis_cofins" => 0.0925,
        default => 0
    };

    $taxValue = $invoiceValue * $taxRate;
    $finalValue = $invoiceValue - $taxValue;

    // Exibição dos resultados
    echo "<h1>Resultado do Cálculo</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Nome da Empresa</th><td>" . htmlspecialchars($companyName) . "</td></tr>";
    echo "<tr><th>CNPJ</th><td>" . htmlspecialchars($cnpj) . "</td></tr>";
    echo "<tr><th>Tipo de Imposto</th><td>" . strtoupper(htmlspecialchars($taxType)) . "</td></tr>";
    echo "<tr><th>Valor Inicial</th><td>" . number_format($invoiceValue, 2, ',', '.') . "</td></tr>";
    echo "<tr><th>Valor do Imposto</th><td>" . number_format($taxValue, 2, ',', '.') . "</td></tr>";
    echo "<tr><th>Valor Final</th><td>" . number_format($finalValue, 2, ',', '.') . "</td></tr>";
    echo "</table>";
}
?>
