<div class="wrap">
  <h2>Prism Syntax Highlighter
    <small>(v<?php echo APFW_PLUGIN_VERSION ?>)</small>
  </h2>
  <form action="<?php echo admin_url('options.php') ?>" method="post" id="apfw_form">
      <?php
      settings_fields(APFW_OPTION_NAME);
      ?>
    <div id="poststuff">
      <div class="postbox meta-col">
        <h3 class="hndle"><i class="dashicons-before dashicons-admin-appearance"> </i>Select a theme</h3>

        <div class="inside">
            <?php
            for ($i = 1; $i <= count($themeList); $i++) {
                echo '<input ';
                echo ($db['theme'] == $i) ? ' checked ' : '';
                echo 'name="' . APFW_OPTION_NAME . '[theme]" value="' . $i . '" id="ptheme-' . $i . '" type="radio">';
                echo '<label for="ptheme-' . $i . '">' . $themeList[$i]['name'] . "</label>";
                echo '&emsp;<a target="_blank" href="' . $themeList[$i]['url'] . '">Preview</a><br>';
            }
            ?>
        </div>
      </div>
      <!--end post box-->
      <div class="postbox meta-col">
        <h3 class="hndle"><i class="dashicons-before dashicons-editor-code"
          > </i>Select languages</h3>

        <div class="inside" id="plang-list">
            <?php
            for ($i = 1; $i <= count($langList); $i++) {
                echo '<input ';
                echo (in_array($i, $db['lang'])) ? ' checked ' : '';
                echo ($langList[$i]['require'] !== '') ? ' data-require="' . $langList[$i]['require'] . '" ' : '';
                echo ' name="' . APFW_OPTION_NAME . '[lang][]" value="' . $i . '" id="plang-' . $langList[$i]['id'] . '" type="checkbox">';
                echo '<label for="plang-' . $langList[$i]['id'] . '">' . $langList[$i]['name'] . "</label>";
                echo ($langList[$i]['require'] !== '') ? '&emsp;<i>(Requires: ' . $langList[$i]['require'] . ')</i>' : '';
                echo '<br>';
            }
            ?>
        </div>
      </div>
      <!--end post box-->
      <div class="postbox meta-col">
        <h3 class="hndle"><i class="dashicons-before dashicons-admin-plugins"
          > </i>Select plugins</h3>

        <div class="inside">
            <?php
            for ($i = 1; $i <= count($pluginList); $i++) {
                echo '<input ';
                echo (in_array($i, $db['plugin'])) ? ' checked ' : '';
                echo ' name="' . APFW_OPTION_NAME . '[plugin][]" value="' . $i . '" id="pplugin-' . $i . '" type="checkbox">';
                echo '<label for="pplugin-' . $i . '">' . $pluginList[$i]['name'] . "</label>";
                echo '&emsp;<a target="_blank" href="' . $pluginList[$i]['url'] . '">View Demo</a><br>';
            }
            ?>
        </div>
      </div>
      <!--end post box-->
    </div>
    <!--end post stuff-->
    <hr>
    <p style="text-align: center">
      <input name="<?php echo APFW_OPTION_NAME ?>[onlyOnPost]" id="p_onlyOnPost"
             type="checkbox" <?php checked($db['onlyOnPost'], 1); ?>>
      <label for="p_onlyOnPost">Load Prism files (CSS+JS) only to post/single pages</label>&ensp;
      <input name="<?php echo APFW_OPTION_NAME ?>[noAssistant]" id="p_noAssistant"
             type="checkbox" <?php checked($db['noAssistant'], 1); ?>>
      <label for="p_noAssistant">Don't show Assistant Button in editor</label>
    </p>
      <?php submit_button() ?>
    <hr>
  </form>
  <p class="dev-info">
    Created with &hearts; by <a target="_blank" href="https://ankurk91.github.io/"> Ankur Kumar</a> |
    View <a target="_blank" href="http://www.prismjs.com">Original Developer Site </a>for Demos |
    Fork on <a target="_blank" href="https://github.com/ankurk91/wp-prism-js">GitHub</a>
  </p>
    <?php if (defined('WP_DEBUG') && WP_DEBUG == true) {
        echo '<hr><p><h5>Showing Debugging Info:</h5><pre>';
        var_dump($db);
        echo '</pre></p><hr>';
    } ?>
</div>
