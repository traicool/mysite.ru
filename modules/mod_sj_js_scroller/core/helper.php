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

include_once dirname(__FILE__).'/helper_base.php';

class JSScrollerHelper extends JSScrollerBaseHelper{

	public static function getList(&$params){
		$db = JFactory::getDBO();
		$jshopConfig = JSFactory::getConfig();
		$jshopConfig->cur_lang = $jshopConfig->frontend_lang;
		JSFactory::loadCssFiles();
		JSFactory::loadLanguageFile();
		$lang = JSFactory::getLang();
		$jshopConfig = JSFactory::getConfig();
		$filters = array();
		$order_by = $params->get('product_order_by');
		if( $order_by == 'name' ){
			$order_by = "prod.`".$lang->get('name')."`";
		}
		$order_dir = $params->get('product_order_dir');
		$limit = (int)$params->get('count_products',10);
		if($limit > 20 || $limit == 0){
			$limit = 20;
		}
		$desc_maxlength = $params->get('item_desc_max_characs',50);
		$catids = $params->get('catids',0);
		$_catids = array();
		$list = array();
		settype($catids,'array');
		if(!empty($catids)){
			$filters['categorys'] = $catids;
			$product = JTable::getInstance('product', 'jshop');
			$items = $product->getAllProducts(array_unique($filters), $order_by, " ".$order_dir, 0, $limit);
			foreach($items as $item){
				$product->load($item->product_id);
				$product->getDescription();
				$item->title = $item->name;	
				$item->description = $product->description;
				self::getJSAImages($item, $params);
				$item->short_desc = self::_cleanText($product->short_description);
				$item->_description =  self::_cleanText($item->description);
				$item->_description = ($item->_description !='')?self::truncate($item->_description,$desc_maxlength):self::truncate($item->short_desc,$desc_maxlength);
				$item->link = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id=' . $item->category_id.'&product_id=' . $item->product_id ,1);
				$list[] = $item;
			}
		}
		return $list;	
	}
	
	public static   function getCategory($catid, $order = 'id', $ordering = 'asc', $publish = 0) {
		$_db = JFactory::getDBO();
		$lang = JSFactory::getLang();
        $user = JFactory::getUser();
        $add_where = ($publish)?(" AND category_publish = '1' "):("");
        $groups = implode(',', $user->getAuthorisedViewLevels());
        $add_where .=' AND access IN ('.$groups.')';
        if ($order=="id") $orderby = "category_id";
        if ($order=="name") $orderby = "`".$lang->get('name')."`";
        if ($order=="ordering") $orderby = "ordering";
        if (!$orderby) $orderby = "ordering";
        
        $query = "SELECT `".$lang->get('name')."` as name,`".$lang->get('description')."` as description,`".$lang->get('short_description')."` as short_description, category_id, category_publish, ordering, category_image FROM `#__jshopping_categories`
                   WHERE category_id IN (".$catid.") ".$add_where."
                   ORDER BY ".$orderby." ".$ordering;
        $_db->setQuery($query);
        $categories = $_db->loadObjectList();
        foreach($categories as $key=>$value){
            $categories[$key]->link = SEFLink('index.php?option=com_jshopping&controller=category&task=view&category_id='.$categories[$key]->category_id, 1);
        }        
        return $categories;
    }
	
	

}
