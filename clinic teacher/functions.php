<?php
function computeHFAZScore($ageInYears, $heightInCm, $sex)
{
    if ($sex == "M") {
        $referenceHeight = getReferenceHeightForBoy($ageInYears);
    } else {
        $referenceHeight = getReferenceHeightForGirl($ageInYears);
    }

    $zScore = ($heightInCm - $referenceHeight) / getStandardDeviationForHeight($ageInYears);
    return $zScore;
}

function getReferenceHeightForBoy($ageInYears)
{
    switch ($ageInYears) {
        case 5:
            return 107.2;
        case 6:
            return 115.0;
        case 7:
            return 122.4;
        case 8:
            return 129.3;
        case 9:
            return 135.7;
        case 10:
            return 141.7;
        case 11:
            return 147.2;
        case 12:
            return 152.2;
        case 13:
            return 156.7;
        case 14:
            return 161.0;
        case 15:
            return 164.8;
        case 16:
            return 168.2;
        case 17:
            return 171.3;
        case 18:
            return 173.8;
        case 19:
            return 176.2;
        default:
            throw new Exception("Invalid age: $ageInYears");
    }
}

function getReferenceHeightForGirl($ageInYears)
{
    switch ($ageInYears) {
        case 5:
            return 105.0;
        case 6:
            return 112.4;
        case 7:
            return 119.3;
        case 8:
            return 126.0;
        case 9:
            return 132.2;
        case 10:
            return 138.0;
        case 11:
            return 143.3;
        case 12:
            return 148.1;
        case 13:
            return 152.4;
        case 14:
            return 156.2;
        case 15:
            return 159.4;
        case 16:
            return 162.2;
        case 17:
            return 164.6;
        case 18:
            return 166.5;
        case 19:
            return 168.0;
        default:
            throw new Exception("Invalid age: $ageInYears");
    }
}

function getStandardDeviationForHeight($ageInYears)
{
    switch ($ageInYears) {
        case 5:
            return 5.3;
        case 6:
            return 5.4;
        case 7:
            return 5.5;
        case 8:
            return 5.6;
        case 9:
            return 5.7;
        case 10:
            return 5.8;
        case 11:
            return 5.9;
        case 12:
            return 6.0;
        case 13:
            return 6.1;
        case 14:
            return 6.2;
        case 15:
            return 6.3;
        case 16:
            return 6.4;
        case 17:
            return 6.5;
        case 18:
            return 6.6;
        case 19:
            return 6.7;
        default:
            throw new Exception("Invalid age: $ageInYears");
    }
}
