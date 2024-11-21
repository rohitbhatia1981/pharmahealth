<?php

function calculatePrice($baseprice, $quantity, $medicationCost) {
    // Initialize the multipliers
    $multipliers = array(1, 0.6, 0.4, 0.3);

    // Calculate the sum of multipliers
    $sumMultipliers = 0;
    for ($i = 0; $i < $quantity; $i++) {
        if ($i < count($multipliers)) {
            $sumMultipliers += $multipliers[$i];
        } else {
            $sumMultipliers += $multipliers[count($multipliers) - 1]; // use the last multiplier (0.3) for remaining quantities
        }
    }

    // Calculate the base cost using the multipliers
    $baseCost = $baseprice * $sumMultipliers;

    // Calculate the total cost
    $totalCost = $baseCost + ($medicationCost - 4);

    return $totalCost;
}

// Example usage:
$baseprice = 24; // Base price of 20
$medicationCost = 44.13; // Example medication cost
$quantity=3;
// Calculate the total cost for quantity 1
$totalCost1 = calculatePrice($baseprice, $quantity, $medicationCost);
echo "Total Cost " . $totalCost1 . "\n";



?>
