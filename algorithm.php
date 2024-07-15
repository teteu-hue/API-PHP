<?php
function calcula_aumento($atual_payment = null)
{

    if($atual_payment == null)
    {
       echo "Please insert a value";
       return;
    }

    if($atual_payment < 0)
    {
        echo "Please insert a valid value";
        return;
    }

    $percentualA = 0.5; // Menos de 3k
    $percentualB = 0.2; // Entre R$3.000,01 e R$10.000 
    $percentualC = 0.15; // Para os acima de R$10k

    if($atual_payment <= 3000)
    {
        $reajusted_payment = $atual_payment * $percentualA;
    } else if($atual_payment > 3000 && $atual_payment <= 10000)
    {
        $reajusted_payment = $atual_payment * $percentualB;
    } else if($atual_payment > 10000)
    {
        $reajusted_payment = $atual_payment * $percentualC;
    }

    $novo_salario = $atual_payment + $reajusted_payment;

    return $novo_salario;
}
echo calcula_aumento();
echo "<br>";
echo calcula_aumento(-1);
echo "<br>";
echo calcula_aumento(3000);
echo "<br>";
echo calcula_aumento(3002);
echo "<br>";
echo calcula_aumento(4000);
echo "<br>";
echo calcula_aumento(15000);
echo "<br>";
?>
