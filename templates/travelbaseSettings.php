<div class="wrap">
  <h1>Travelbase settings</h1>
  <?php settings_errors(); ?>

  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab-1">Activate Libs</a></li>
    <li><a href="#tab-2">Website settings</a></li>
  </ul>

  <div class="tab-content">
    <div id="tab-1" class="tab-pane active">

      <form method="post" action="options.php">
        <?php
        settings_fields('travelbase_plugin_actions');
        do_settings_sections('travelbase_plugin_actions');
        submit_button();
        ?>
      </form>

    </div>

    <div id="tab-2" class="tab-pane">
      <form method="post" action="options.php">
        <?php
        settings_fields('travelbase_plugin_fields');
        do_settings_sections('travelbase_plugin_fields');
        submit_button();
        ?>
      </form>
    </div>
  </div>
</div>