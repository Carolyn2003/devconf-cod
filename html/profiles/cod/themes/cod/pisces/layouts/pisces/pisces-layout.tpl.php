<div<?php print $attributes; ?>>
  <header class="l-header" role="banner">
    <div class="l-constrained">
      <div class="l-branding site-branding">
        <?php if ($logo): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="site-branding__logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
        <?php endif; ?>
        <?php if ($site_name): ?>
          <a href="<?php print $front_page; ?>" class="site-branding__name" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
        <?php endif; ?>
        <?php if ($site_slogan): ?>
          <h2 class="site-branding__slogan"><?php print $site_slogan; ?></h2>
        <?php endif; ?>
        <?php print render($page['branding']); ?>
      </div>
      <?php print render($page['header']); ?>
    </div>
    <div class="l-navigation">
      <div class="l-constrained">
        <?php print render($page['navigation']); ?>
      </div>
    </div>
  </header>

  <?php print render($page['hero']); ?>

  <?php if (!empty($page['highlighted'])): ?>
    <div class="l-highlighted-wrapper">
      <?php print render($page['highlighted']); ?>
    </div>
  <?php endif; ?>

  <div class="l-main-wrapper">
    <div class="l-main l-constrained">
      <a id="main-content"></a>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>

      <div class="l-content" role="main">
        <?php if (!$is_front): ?>
          <?php print render($page['preface']); ?>
          <?php print render($title_prefix); ?>
          <?php if ($title): ?>
      
          <?php endif; ?>
          <?php print render($title_suffix); ?>
        <?php endif; ?>
        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
        <?php print render($page['content']); ?>
        <?php print $feed_icons; ?>
      </div>

      <?php print render($page['sidebar']); ?>
    </div>
  </div>

  <?php if (!empty($page['footer'])): ?>
    <footer class="l-footer-wrapper" role="contentinfo">
      <?php print render($page['footer']); ?>
    </footer>
  <?php endif; ?>
</div>
