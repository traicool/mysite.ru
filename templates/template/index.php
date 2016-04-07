<?php
defined('_JEXEC') or die;
JHtml::_('behavior.framework', true);
$app = JFactory::getApplication();
?>
<?php echo '<?'; ?>xml version="1.0" encoding="<?php echo $this->_charset ?>"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >

<head>
  <jdoc:include type="head" />

  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/menu.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/search.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/kotyata.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/o_nas.css" type="text/css" />
  <?php
  if($this->countModules('left and right') == 0) $contentwidth = "100";
  if($this->countModules('left or right') == 1) $contentwidth = "80";
  if($this->countModules('left and right') == 1) $contentwidth = "60";
  ?>

</head>


<body>



  <div id="page">
    <div id="top">
      <div id="logo">
        <img src="<?php echo $this->baseurl ?>/templates/template/images/logo.png" alt="Питомник британских кошек г. Ульяновск"/>
        <h1>Питомник британских кошек <?php echo $app->getCfg('sitename'); ?>...</h1>
      </div>
      <div id="search">
        <jdoc:include type="modules" name="search" style="xhtml" />
      </div>

    </div>

    <?php if($this->countModules('header')) : ?>
      <div id="header">
        <jdoc:include type="modules" name="header" style="xhtml" />
      </div>
    <?php endif; ?>

    <?php if($this->countModules('newsline')) : ?>
      <div id="newsline">
        <jdoc:include type="modules" name="newsline" style="xhtml" />
      </div>
    <?php endif; ?>

    <?php if($this->countModules('menu')) : ?>
      <div id="menu">
        <jdoc:include type="modules" name="menu" style="xhtml" />
      </div>
    <?php endif; ?>


    <?php if($this->countModules('left')) : ?>
      <div id="left">
       <jdoc:include type="modules" name="left" style="xhtml" />
     </div>
   <?php endif; ?>

   <div id="content<?php echo $contentwidth; ?>">


    <jdoc:include type="message" />


    <jdoc:include type="component" style="xhtml" />
  </div> <!--РєРѕРЅРµС† Р±Р»РѕРєР° РєРѕРЅС‚РµРЅС‚Р°-->


  <?php if($this->countModules('right')) : ?>
    <div id="rigth">
      <jdoc:include type="modules" name="right" style="xhtml" />
    </div>
  <?php endif; ?>

  <?php if($this->countModules('footer')) : ?>
    <div id="footer">
      <jdoc:include type="modules" name="footer" style="xhtml" />
    </div>
  <?php endif; ?>

</div><!--РєРѕРЅРµС† Р±Р»РѕРєР° page-->
</body><!--РєРѕРЅРµС† Р±Р»РѕРєР° body -->
</html><!--РєРѕРЅРµС† РєРѕРґР°-->


