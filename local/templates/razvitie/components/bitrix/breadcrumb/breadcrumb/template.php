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


$strReturn .= '<ul class="breadcrumb_z" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? '<li><img src="'.SITE_TEMPLATE_PATH.'/src/assets/svgicons/arrow-right.svg" alt="" /></li>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
				'.$arrow.'
				<li itemprop="name">
                    <a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">
                        '.$title.'
                    </a>
				</li>';
	}
	else
	{
		$strReturn .= '
			
				'.$arrow.'
				<li>'.$title.'</li>
			';
	}
}

$strReturn .= '<div style="clear:both"></div></ul>';

return $strReturn;
