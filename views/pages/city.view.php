<?php

use App\Utility;

/**
 * @var WorldCityModel $city
 */
?>
<h1>City: <?php echo Utility:: e($city->getCityWithCountry()); ?></h1>
<table>
    <tbody>
        <tr>
            <th>City name:</th>
            <td><?php echo Utility::e($city->city); ?></td>
        </tr>
        <tr>
            <th>City name (ascii):</th>
            <td><?php echo Utility:: e($city->cityAscii); ?></td>
        </tr>
        <tr>
            <th>Country:</th>
            <td><?php echo Utility:: e($city->country); ?></td>
        </tr>
        <tr>
            <th>Flag of the country:</th>
            <td><?php echo Utility::e($city->getFlag()); ?></td>
        </tr>
        <tr>
            <th>ISO2 code of country:</th>
            <td><?php echo Utility:: e($city->iso2); ?></td>
        </tr>
        <tr>
            <th>Population:</th>
            <td><?php echo Utility:: e($city->population); ?></td>
        </tr>
    </tbody>
</table>