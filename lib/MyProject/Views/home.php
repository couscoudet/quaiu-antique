<h1>Bienvenue</h1>

<!-- Slider main container -->
<div class="swiper">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <?php
    foreach($data as $image) {
      ?>

    <div class="swiper-slide"> <img class="gallery-image" src="<?= $image->getImageURL() ?>"/></div>
    
    <?php
    }
    ?>
    ...
  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

  <!-- If we need navigation buttons -->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>

  <!-- If we need scrollbar -->
  <div class="swiper-scrollbar"></div>
</div>
