<?php
define('COLORS', [
    "set1" => [
        "#FF5733", "#FFBD33", "#DBFF33", "#75FF33", "#33FF57", "#33FFBD",
        "#33DBFF", "#3375FF", "#5733FF", "#BD33FF", "#FF33DB", "#FF3375"
    ],
    "set2" => [
        "#A1FFCE", "#FAFFD1", "#FFD8A8", "#FFA8A8", "#FFC6FF", "#D5A8FF",
        "#A8B8FF", "#A8EFFF", "#A8FFD8", "#D4FFA8", "#FFFDA8", "#FFE7A8"
    ]
]);

function getColorSet($setNumber) {
    return COLORS["set" . $setNumber] ?? [];
}

// // المصفوفة الكاملة للألوان
// $colors = array(
//     "#F0F8FF", // Alice Blue
//     "#FAEBD7", // Antique White
//     "#7FFFD4", // Aquamarine
//     "#F5F5DC", // Beige
//     "#FFE4C4", // Bisque
//     "#D2B48C", // Tan
//     "#FF7F50", // Coral
//     "#6495ED", // Cornflower Blue
//     "#FFF8DC", // Cornsilk
//     "#DC143C", // Crimson
//     "#00FFFF", // Cyan
//     "#F0E68C", // Khaki
//     "#E6E6FA", // Lavender
//     "#FFF0F5", // Lavender Blush
//     "#7CFC00", // Lawn Green
//     "#FFFACD", // Lemon Chiffon
//     "#ADD8E6", // Light Blue
//     "#F08080", // Light Coral
//     "#E0FFFF", // Light Cyan
//     "#FAFAD2", // Light Goldenrod Yellow
//     "#D3D3D3", // Light Gray
//     "#FFB6C1", // Light Pink
//     "#FFA07A", // Light Salmon
//     "#20B2AA"  // Light Sea Green
// );

// // تقسيم الألوان إلى مجموعتين
// $colorSet1 = array_slice($colors, 0, 12); // المجموعة الأولى (الألوان من 1 إلى 12)
// $colorSet2 = array_slice($colors, 12, 12); // المجموعة الثانية (الألوان من 13 إلى 24)

// // دالة لاختيار مجموعة واحدة
// if (!function_exists('chooseColorSet')) {
//     function chooseColorSet($setNumber) {
//         global $colorSet1, $colorSet2;

//         if ($setNumber == 1) {
//             return json_encode($colorSet1);
//         } elseif ($setNumber == 2) {
//             return json_encode($colorSet2);

//         } else {
//             return array(); // إذا كان الرقم غير صحيح، نرجع مصفوفة فارغة
//         }
//         header('Content-Type: application/json');

//     }
// }

// // دالة لاختيار مجموعة عشوائية
// if (!function_exists('chooseRandomSet')) {
//     function chooseRandomSet() {
//         global $colorSet1, $colorSet2;
//         return (rand(0, 1) == 0) ? $colorSet1 : $colorSet2;
//     }
// }


// // Define two sets of colors
// $colorSets = [
//     "1" => [
//         "#FF6F61", // Coral Red
//         "#6B5B95", // Purple Haze
//         "#88B04B", // Soft Green
//         "#F7CAC9", // Pale Pink
//         "#92A8D1", // Cool Blue
//         "#955251", // Muted Rose
//         "#B565A7", // Purple Orchid
//         "#009B77", // Teal Green
//         "#DD4124", // Fiery Red
//         "#45B8AC", // Aqua Green
//         "#EFC050", // Mustard Yellow
//         "#5B5EA6"  // Soft Indigo
//     ],
//     "2" => [
//         "#D65076", // Bright Pink
//         "#45B39D", // Aqua Blue
//         "#58D68D", // Fresh Green
//         "#AF7AC5", // Lavender Purple
//         "#F4D03F", // Sunflower Yellow
//         "#DC7633", // Warm Orange
//         "#AED6F1", // Light Sky Blue
//         "#A2D9CE", // Pastel Turquoise
//         "#F1948A", // Peach Pink
//         "#76D7C4", // Mint Green
//         "#7FB3D5", // Ocean Blue
//         "#F0B27A"  // Sandy Beige
//     ]
// ];

// /**
//  * Function to get a specific color set
//  *
//  * @param string $setName The name of the color set (e.g., "set1" or "set2")
//  * @return array|null Returns the color set array if found, or null if not found
//  */
// function getColorSet($setName)
// {
//     global $colorSets;

//     if (array_key_exists($setName, $colorSets)) {
//         return $colorSets[$setName];
//     }

//     return null; // Return null if the set name is invalid
// }