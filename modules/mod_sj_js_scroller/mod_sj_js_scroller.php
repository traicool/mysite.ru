<?php
/**
 * @package Sj Scroller for JoomShopping
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2013 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_JEXEC') or die;

if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}
	
require_once dirname( __FILE__ ).'/core/helper.php';

$layout = $params->get('layout', 'default');
$cacheid = md5(serialize(array ($layout, $module->id)));
$cacheparams = new stdClass;
$cacheparams->cachemode = 'id';
$cacheparams->class = 'JSScrollerHelper';
$cacheparams->method = 'getList';
$cacheparams->methodparams = $params;
$cacheparams->modeparams = $cacheid;
$list = JModuleHelper::moduleCache ($module, $params, $cacheparams);

if($params->get('nav_style') == 'nav-style3' && count($list) > 6){
	$list = array_slice($list,1,6);
}
require JModuleHelper::getLayoutPath($module->module, $layout);
