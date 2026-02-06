<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$newResult=array();

//pre($arResult);
foreach ($arResult as $key => $arItem)
{
    //pre($arItem);
    if($arItem["DEPTH_LEVEL"]==1)
    {
        $f=$key;
        $newResult[$key]=$arItem;
    }elseif($arItem["DEPTH_LEVEL"]==2)
    {
        $s=$key;
        $newResult[$f]["CHILD"][$key]=$arItem;
    }elseif($arItem["DEPTH_LEVEL"]==3)
    {
        $n=$key;
        $newResult[$f]["BIG_MENU"] = true;
        $newResult[$f]["CHILD"][$s]["CHILD"][$key]=$arItem;
    }
    elseif($arItem["DEPTH_LEVEL"]==4)
    {
        $newResult[$f]["CHILD"][$s]["CHILD"][$n]['CHILD'][$key]=$arItem;
    }

}
$arResult=$newResult;
unset($newResult);

?>