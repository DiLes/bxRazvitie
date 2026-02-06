<?
/**
 * Склонение слов по типу и количеству
 *
 * @param int $count Количество
 * @param string $type Тип сущности: product, review, service, news и т.д.
 * @param bool $withNumber Показывать ли число
 * @return string
 */

function plural(int $count, string $type, bool $withNumber = true): string
{
    $dict = [
        'product' => ['товар', 'товара', 'товаров'],
        'project' => ['проект', 'проекта', 'проектов'],
        'review'  => ['отзыв', 'отзыва', 'отзывов'],
        'service' => ['услуга', 'услуги', 'услуг'],
        'news'    => ['новость', 'новости', 'новостей'],
        'docs'    => ['документ', 'документа', 'документов'],
    ];

    if (!isset($dict[$type])) {
        return $withNumber ? (string)$count : '';
    }

    $forms = $dict[$type];
    $count = abs($count);

    if ($count % 100 >= 11 && $count % 100 <= 19) {
        $word = $forms[2];
    } else {
        switch ($count % 10) {
            case 1:
                $word = $forms[0];
                break;
            case 2:
            case 3:
            case 4:
                $word = $forms[1];
                break;
            default:
                $word = $forms[2];
        }
    }

    return $withNumber ? "{$count} {$word}" : $word;
}



function pre($result) {
    global $USER;
    if($USER->GetID() == 1){
        echo '<pre>'; print_r($result); echo '</pre>';
    }
}
function cartProductsText($count) {
    $words = ["товар", "товара", "товаров"];
    $num = $count % 100;
    if ($num > 10 && $num < 20) {
        $word = $words[2];
    } else {
        $num = $count % 10;
        if ($num == 1) {
            $word = $words[0];
        } elseif ($num > 1 && $num < 5) {
            $word = $words[1];
        } else {
            $word = $words[2];
        }
    }
    return "{$count} {$word}";
}

function numWord($value, $words) {
    $num = $value % 100;
    if ($num > 10 && $num < 20) return $words[2];
    $num = $value % 10;
    if ($num == 1) return $words[0];
    if ($num > 1 && $num < 5) return $words[1];
    return $words[2];
}
