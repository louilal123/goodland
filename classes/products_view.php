<?php

require_once __DIR__ . '/../admin/classes/Main_class.php';

$main_class = new Main_class();
$products = $main_class->get_products();

function getStarRating($rating) {
    $fullStars = floor($rating);
    $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
    $emptyStars = 5 - $fullStars - $halfStar;
    $stars = '';

    for ($i = 0; $i < $fullStars; $i++) {
        $stars .= '<i class="bi bi-star-fill"></i>';
    }
    for ($i = 0; $i < $halfStar; $i++) {
        $stars .= '<i class="bi bi-star-half"></i>';
    }
    for ($i = 0; $i < $emptyStars; $i++) {
        $stars .= '<i class="bi bi-star"></i>';
    }

    return $stars;
}
?>