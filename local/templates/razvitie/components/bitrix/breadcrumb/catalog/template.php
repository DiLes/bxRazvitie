<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';


$strReturn .= '<div class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? '<img src="'.SITE_TEMPLATE_PATH.'/src/assets/svgicons/arrow-right-gray.svg" alt="" />' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
				'.$arrow.'	
                    <a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">
                        '.$title.'
                    </a>';
	}
	else
	{
		$strReturn .= '
			
				'.$arrow.'
				<a href="javascript:void(0);">'.$title.'</a>
			';
	}
}

$strReturn .= '</div>';

return $strReturn;