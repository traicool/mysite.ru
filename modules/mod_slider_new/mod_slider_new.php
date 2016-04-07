<?php
//Проверка переменной Joomla
defined('_JEXEC') or die;

$img = array();
$link = array();
$text = array();
for($i=1;$i<8;$i++)
{
	if($params->get('img_'.$i)!='')
	{
		$img[$i] = $params->get('img_'.$i);
		$link[$i] = $params->get('link_'.$i);
		$text[$i] = $params->get('text_'.$i);
	}
}
?>
<div class="slider_new<?php echo $params->get('moduleclass_sfx'); ?>  well">

	<script type="text/javascript" src="/modules/mod_slider_new/script_slider_new.js"></script>
	<link type="text/css" href="/modules/mod_slider_new/style_slider_new.css" rel="stylesheet" />

	<?php if($module->showtitle==1) { echo '<h3 class="page-header">'.$module->title.'</h3>'; } ?>
	<div class="obert_sl_new">
		<div class="left_sl_new">&lt;</div>
		<div class="mid_sl_new">
			<div class="scroll_sl_new">
				<?php
				foreach($img as $key => $value)
				{
					echo '<div class="img_sl_new">';
					if($link[$key]=='')
					{
						echo '<div><img src="/'.$value.'" width="100%"/></div>';
					}else{
						echo '<div><a href="'.$link[$key].'"><img src="/'.$value.'" width="100%"/></a></div>';
					}
					if($text[$key]!='')
					{
						echo '<div class="text_sl_new">'.$text[$key].'</div>';
					}
					echo '</div>';
				}
				?>
			</div>
		</div>
		<div class="right_sl_new">&gt;</div>
	</div>
</div>