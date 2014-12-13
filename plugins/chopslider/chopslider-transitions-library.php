<div class="chopslider-wrapper">
  <a id="slide-next" href="#"></a> 
  <a id="slide-prev" href="#"></a>
  <div id="chopslider">
    <div class="chopslider-slide cs-activeSlide"> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>images/admin/1.jpg" width="900" height="300" alt="slide1" /> </div>
    <div class="chopslider-slide"> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>images/admin/2.jpg" width="900" height="300" alt="slide2" /> </div>
    <div class="chopslider-slide"> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>images/admin/3.jpg" width="900" height="300" alt="slide3" /> </div>
    <div class="chopslider-slide"> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>images/admin/4.jpg" width="900" height="300" alt="slide4" /> </div>
  </div>
</div>
<div class="chopslider-wrapper2">
  <h1 class="chopslider-tl-heading">Chop Slider Transitions Library</h1>
  <p style="width:600px; margin:0 auto">Click on the Transition's number you want to preview, and then click on the left or right arrow to navigate through slides with a chosen effect. You will be able to switch to another effect only after the animation will be completed. Also note that some of effects have a little bit different parameters for the "Next" and "Previous" effect, so do not forget to check it too.</p>
  <?php include ("chopslider-transitions-state.php") ?>
  
  <div class="vertical transitions-group" style="border-left:1px solid #eee;">
    <h2>Vertical</h2>
    <a class="active-transition" href="#">0</a>
  <?php for ($chopslider_i=1; $chopslider_i <= $chopsliderTransitions['vertical2d']-1; $chopslider_i++) :?>
  	<a href="#"><?php echo $chopslider_i ?></a>
  <?php endfor; ?>
  </div>
  
  <div class="horizontal transitions-group">
    <h2>Horizontal</h2>
  <?php for ($chopslider_i=0; $chopslider_i <= $chopsliderTransitions['horizontal2d']-1; $chopslider_i++) :?>
  	<a href="#"><?php echo $chopslider_i ?></a>
  <?php endfor; ?>
  </div>
  
  <div class="multi transitions-group">
    <h2>Multi</h2>
  <?php for ($chopslider_i=0; $chopslider_i <= $chopsliderTransitions['multi2d']-1; $chopslider_i++) :?>
  	<a href="#"><?php echo $chopslider_i ?></a>
  <?php endfor; ?>
  </div>
  
  <div class="half transitions-group">
    <h2>Half</h2>
  <?php for ($chopslider_i=0; $chopslider_i <= $chopsliderTransitions['half2d']-1; $chopslider_i++) :?>
  	<a href="#"><?php echo $chopslider_i ?></a>
  <?php endfor; ?>
  </div>
  
  <div class="sexy transitions-group">
    <h2>Sexy</h2>
  <?php for ($chopslider_i=0; $chopslider_i <= $chopsliderTransitions['sexy2d']-1; $chopslider_i++) :?>
  	<a href="#"><?php echo $chopslider_i ?></a>
  <?php endfor; ?>
  </div>
  
  <div class="slide transitions-group">
    <h2>Slide</h2>
  <?php for ($chopslider_i=0; $chopslider_i <= $chopsliderTransitions['slide2d']-1; $chopslider_i++) :?>
  	<a href="#"><?php echo $chopslider_i ?></a>
  <?php endfor; ?>
  </div>
  
  <div class="3DBlocks transitions-group">
    <h2>3D Blocks</h2>
  <?php for ($chopslider_i=0; $chopslider_i <= $chopsliderTransitions['3dblocks']-1; $chopslider_i++) :?>
  	<a href="#"><?php echo $chopslider_i ?></a>
  <?php endfor; ?>
  </div>
  
  <div class="3DFlips transitions-group">
    <h2>3D Flips</h2>
  <?php for ($chopslider_i=0; $chopslider_i <= $chopsliderTransitions['3dflips']-1; $chopslider_i++) :?>
  	<a href="#"><?php echo $chopslider_i ?></a>
  <?php endfor; ?>
  </div>
  
  <div class="sphere transitions-group">
    <h2>3D Sphere</h2>
  <?php for ($chopslider_i=0; $chopslider_i <= $chopsliderTransitions['3dsphere']-1; $chopslider_i++) :?>
  	<a href="#"><?php echo $chopslider_i ?></a>
  <?php endfor; ?>
  </div>
  <div style="clear:both"></div>
  <h1 class="chopslider-tl-heading">noCSS3 Transitions</h1>
  <p style="width:600px; margin:0 auto">These transitions will work only in old browsers or in browsers that do not support CSS3 Transforms (Like IE)</p>
  <div class="noCSS3">
  <?php for ($chopslider_i=0; $chopslider_i <= $chopsliderTransitions['noCSS3']-1; $chopslider_i++) :?>
  	<a href="#"><?php echo $chopslider_i ?></a>
  <?php endfor; ?>
  </div>
  <h1 class="chopslider-tl-heading">Mobile Transitions</h1>
  <p style="width:600px; margin:0 auto">These simple transitions are intended to use with Mobile devices like Android, iOS, Blackberry, etc.</p>
  <div class="mobile">
  <?php for ($chopslider_i=0; $chopslider_i <= $chopsliderTransitions['mobile']-1; $chopslider_i++) :?>
  	<a href="#"><?php echo $chopslider_i ?></a>
  <?php endfor; ?>
  </div>
</div>
