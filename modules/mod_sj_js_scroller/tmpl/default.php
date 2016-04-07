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
	$tag_id = 'news_scroller_'.rand().time();
	JHtml::stylesheet('modules/'.$module->module.'/assets/css/styles.css');
	$app = JFactory::getApplication();
	$option = $app->input->get('option');
	$controller = $app->input->get('controller');
	$task = $app->input->get('task');

	 if($option == 'com_jshopping' && $controller == 'product' && $task == 'view'){
	 
	 }else{
		if( !defined('SMART_JQUERY') && $params->get('include_jquery', 0) == "1" ){
			JHtml::script('modules/'.$module->module.'/assets/js/jquery-1.8.2.min.js');
			JHtml::script('modules/'.$module->module.'/assets/js/jquery-noconflict.js');
			define('SMART_JQUERY', 1);
		}
	}

	JHtml::script('modules/'.$module->module.'/assets/js/raphael-min.js');
	JHtml::script('modules/'.$module->module.'/assets/js/jquery.easing.js');
	JHtml::script('modules/'.$module->module.'/assets/js/iview.js');	
	ob_start();
?>
	<?php if($params->get('controlNav') != 1){ ?>
		#<?php echo $tag_id; ?> .scroller-container.nav-style2 .iview-controlNav,
		#<?php echo $tag_id; ?> .scroller-container.nav-style3 .iview-controlNav{
			display:none;
		}
		#<?php echo $tag_id; ?> .scroller-container.nav-style1 .iview-controlNav div.iview-items{
			display:none;
		}
	<?php } ?>
	#<?php echo $tag_id; ?> .scroller-container{
		max-width:<?php echo $params->get('imgcfg_width') ; ?>px;
		max-height:<?php echo $params->get('imgcfg_height'); ?>px;
	}
	#<?php echo $tag_id; ?> .scroller-container .iviewSlider{
		width:<?php echo $params->get('imgcfg_width') ; ?>px;
		height:<?php echo $params->get('imgcfg_height'); ?>px;
	}
	<?php if((int)$params->get('timer_display') == 0){?>
		#<?php echo $tag_id; ?> .scroller-container .iview-timer{
			display:none!important;
		}
	<?php } ?>
<?php 
	$css = ob_get_contents();
	ob_end_clean();
	$document  = & JFactory::getDocument();
	$document->addStyleDeclaration($css);

	ImageHelper::setDefault($params);
	
	$small_image_config=array(
		'type'			=> $params->get('imgcfgnav_type'),
		'width' 		=> $params->get('imgcfgnav_width'),
		'height' 		=> $params->get('imgcfgnav_height'),
		'quality' 		=> 90,
		'function' 		=> ($params->get('imgcfgnav_function') == 'none')?null:'resize',
		'function_mode' => ($params->get('imgcfgnav_function') == 'none')?null:substr($params->get('imgcfgnav_function'), 7),
		'transparency'  => $params->get('imgcfgnav_transparency', 1)?true:false,
		'background' 	=> $params->get('imgcfgnav_background')
	);
	
	$start = ($params->get('startSlide') <= 0 || $params->get('startSlide') > count($list))?0:$params->get('startSlide') - 1;
	$controlNavNextPrev = ($params->get('nav_style') == 'nav-style1' && $params->get('directionNav') == 1)?'true':'false';
	$directionNav = (($params->get('nav_style') == 'nav-style2' || $params->get('nav_style') == 'nav-style3') && $params->get('directionNav') == 1)?'true':'false';
	$controlNavThumbs = ($params->get('nav_style') == 'nav-style3' && $params->get('directionNav') == 1)?'true':'false';
?>
<?php 
if($params->get('pretext') !=''){ ?>
	<div class="ns-pretext" style="max-width:<?php echo $params->get('imgcfg_width') ; ?>px;">
		<?php echo $params->get('pretext') ?>
	</div>
<?php }	
if(!empty($list)){
?>
<!--[if lt IE 9]><div class="news-scroller pre-load msie lt-ie9" id="<?php echo $tag_id; ?>" ><![endif]--> 
<!--[if IE 9]><div class="news-scroller pre-load msie" id="<?php echo $tag_id; ?>" ><![endif]-->
<!--[if gt IE 9]><!--><div class="news-scroller pre-load " id="<?php echo $tag_id; ?>"><!--<![endif]--> 
	<div  class="scroller-container <?php echo $params->get('nav_style','nav_style1');	?>" style="height:<?php echo $params->get('imgcfg_height',400); ?>px;">
		<?php foreach($list as $item) { 
			$img = JSScrollerHelper::getJSAImage($item, $params);
			//$small_img = JSScrollerHelper::getAImage($item, $params);
			$small_img = ImageHelper::init($img,$small_image_config)->src();
			$img = ImageHelper::init($img)->src();
			$img = (strpos($img,'http://') !== false || strpos($img,'https://') !== false)?$img:(JURI::root().$img);
			$small_img = (strpos($small_img,'http://') !== false || strpos($small_img,'https://') !== false )?$small_img:(JURI::root().$small_img);
		?>
			<div class="ns-item"  data-iview:thumbnail="<?php  echo $small_img; ?>" data-iview:image="<?php  echo $img; ?>">
				<a class="ns-item-image" href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>" <?php echo JSScrollerHelper::parseTarget($params->get('item_link_target','_blank')); ?>></a>
				<?php if($params->get('item_title_display')) { ?>
				<div class="iview-caption " data-x="<?php echo (int)$params->get('item_title_data_x',50); ?>" data-y="<?php echo (int)$params->get('item_title_data_y',80); ?>"  data-transition="<?php echo $params->get('item_title_transition','wipeleft'); ?>" >
					<a class="ns-item-title" href="<?php echo $item->link; ?>" <?php echo JSScrollerHelper::parseTarget($params->get('item_link_target','_blank')); ?> title="<?php echo $item->title; ?>">
						<?php echo JSScrollerHelper::truncate($item->title, $params->get('item_title_max_characs',20)); ?>
					</a>
				</div>
				<?php }
				if($params->get('item_desc_display') == 1 && $item->_description != '') { ?>
				<div class="iview-caption  " data-x="<?php echo (int)$params->get('item_desc_data_x',50); ?>" data-y="<?php echo (int)$params->get('item_desc_data_y',150); ?>"  data-transition="<?php echo $params->get('item_desc_transition','wiperight'); ?>">
					<div class="ns-description">
						<?php echo $item->_description; ?>
					</div>
				</div>
				<?php }
				if((int)$params->get('item_price_display',1)){?>
				<div class="iview-caption  " data-x="<?php echo (int)$params->get('item_price_data_x',50); ?>" data-y="<?php echo (int)$params->get('item_price_data_y',150); ?>"  data-transition="<?php echo $params->get('item_price_transition','wiperight'); ?>">
					<div class="ns-price" data-label="<?php echo JText::_('PRICE_LABEL'); ?>">
						<?php echo formatprice($item->product_price); ?>
					</div>
				</div>
				<?php }
				if((int)$params->get('item_review_display',1)){?>
				<div class="iview-caption " data-x="<?php echo (int)$params->get('item_review_data_x',50); ?>" data-y="<?php echo (int)$params->get('item_review_data_y',220); ?>"  data-transition="<?php echo $params->get('item_review_transition','expanddown'); ?>" >	
					<div class="review_mark" style="min-width:82px;">
						<?php  echo showMarkStar($item->average_rating);?>
					</div>
				</div>
				<?php }
				if($params->get('item_readmore_display') == 1) { ?>
				<div class="iview-caption " data-x="<?php echo (int)$params->get('item_readmore_data_x',50); ?>" data-y="<?php echo (int)$params->get('item_readmore_data_y',220); ?>"  data-transition="<?php echo $params->get('item_readmore_transition','expanddown'); ?>" >
					<a class="ns-readmore" href="<?php echo $item->link; ?>" <?php echo JSScrollerHelper::parseTarget($params->get('item_link_target','_blank')); ?> title="<?php echo $item->title; ?>">
						<?php echo $params->get('item_readmore_text','Read more'); ?>
					</a>
				</div>
				<?php } ?>
			</div><!-- end ns-item -->
		<?php } ?>
	</div><!-- end scroller-container -->
</div><!-- end new-scroller -->
<div class="ns-noitem">
<?php } else {
	echo JText::_('Has no content to show!');
}?>
</div>
<?php
if($params->get('posttext') !=''){ ?>
	<div class="ns-posttext" style="max-width:<?php echo $params->get('imgcfg_width') ; ?>px;">
		<?php echo $params->get('posttext') ?>
	</div>
<?php }	?>

<script type="text/javascript">
//<![CDATA[
	jQuery(document).ready(function($){
		;(function(element){
			var $element = $(element);
			var $container = $('.scroller-container', $element);
				$element.removeClass('pre-load');
			$container.iView({
				fx: 						'<?php echo $params->get('fx','random'); ?>',
				easing: 					'easeOutQuad',
				strips: 					<?php echo (int)$params->get('strips',20); ?>,
				blockCols: 					<?php echo (int)$params->get('blockCols',10); ?>,
				blockRows: 					<?php echo (int)$params->get('blockRows',5); ?>,
				animationSpeed: 			<?php echo (int)$params->get('animationSpeed', 500); ?>,
				startSlide: 				<?php echo $start; ?>,
				directionNav: 				<?php echo $directionNav; ?>,
				directionNavHide: 			false,
				directionNavHoverOpacity:	0.6,
				controlNav: 				true,
				controlNavNextPrev: 		<?php echo $controlNavNextPrev  ?>,
				controlNavHoverOpacity: 	0.6,
				controlNavThumbs: 			<?php echo $controlNavThumbs; ?>,
				controlNavTooltip: 			<?php echo ($params->get('controlNavTooltip') == 1)?'true':'false'; ?>,
				captionSpeed: 				500,
				captionEasing: 				'easeInOutSine',
				captionOpacity: 			1,
				autoAdvance: 				<?php echo (int)$params->get('play',1); ?>,
				keyboardNav: 				<?php echo ($params->get('keyboardNav') == 1)?'true':'false' ?>,
				touchNav: 					<?php echo ($params->get('touchNav') == 1)?'true':'false' ?>,
				pauseOnHover: 				<?php echo ($params->get('pauseOnHover') == 1)?'true':'false'; ?>,
				directionNavHoverOpacity: 0,
				timer: 						'<?php echo $params->get('timer','360Bar'); ?>',
				timerBg: 					'<?php echo $params->get('timerBg','#000000'); ?>',
				timerColor:					'<?php echo $params->get('timerColor','#EEEEEE'); ?>',
				timerOpacity: 				<?php echo $params->get('timerOpacity',0.5); ?>,
				timerDiameter: 				<?php echo $params->get('timerDiameter',30); ?>,
				timerPadding:				<?php echo $params->get('timerPadding',4); ?> ,
				timerStroke: 				<?php echo $params->get('timerStroke',3); ?>,
				timerBarStroke: 			<?php echo $params->get('timerBarStroke',1); ?>,
				timerBarStrokeColor:		'<?php echo $params->get('timerBarStrokeColor','#EEEEEE'); ?>',
				timerBarStrokeStyle:		'<?php echo $params->get('timerBarStrokeStyle','solid'); ?>',
				timerPosition:				'<?php echo $params->get('timerPosition','top-right'); ?>',
				tooltipY: <?php echo ($params->get('nav_style') == 'nav-style1')?"-15":"-10"; ?>
				
			});
			
		})('#<?php echo $tag_id; ?>')
	});
//]]>
</script>
	