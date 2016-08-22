<!--option page start-->
<div class="wrap">
    <h2>Prism Syntax Highlighter
        <small>(v<?php echo APFW_PLUGIN_VERSION ?>)</small>
    </h2>
    <form action="<?php echo admin_url('options.php') ?>" method="post" id="apfw_form">
        <?php
        settings_fields(APFW_OPTION_NAME);
        ?>
        <p style="text-align: center">
            <button class="button button-primary" type="submit" name="save_apfw_form" value="Save »">Save
                Settings
            </button>
        </p>
        <div id="poststuff">
            <div class="postbox meta-col">
                <h3 class="hndle"><i class="dashicons-before dashicons-admin-appearance"
                                     style="color: #02af00"> </i><span>Select a Theme</span></h3>

                <div class="inside">
                    <?php
                    for ($i = 1; $i <= count($theme_list); $i++) {
                        echo '<input ';
                        echo ($db['theme'] == $i) ? ' checked ' : '';
                        echo 'name="' . APFW_OPTION_NAME . '[theme]" value="' . $i . '" id="ptheme-' . $i . '" type="radio">';
                        echo '<label for="ptheme-' . $i . '">' . $theme_list[$i]['name'] . "</label>";
                        echo '&emsp;<a target="_blank" href="' . $theme_list[$i]['url'] . '">Preview</a><br>';
                    }
                    ?>
                </div>
            </div>
            <!--end post box-->
            <div class="postbox meta-col">
                <h3 class="hndle"><i class="dashicons-before dashicons-format-aside"
                                     style="color: #5b27af"> </i><span>Select Languages</span></h3>

                <div class="inside" id="plang-list">
                    <?php
                    for ($i = 1; $i <= count($lang_list); $i++) {
                        echo '<input ';
                        echo (in_array($i, $db['lang'])) ? ' checked ' : '';
                        echo ($lang_list[$i]['require'] !== '') ? ' data-require="' . $lang_list[$i]['require'] . '" ' : '';
                        echo ' name="' . APFW_OPTION_NAME . '[lang][]" value="' . $i . '" id="plang-' . $lang_list[$i]['id'] . '" type="checkbox">';
                        echo '<label for="plang-' . $lang_list[$i]['id'] . '">' . $lang_list[$i]['name'] . "</label>";
                        echo ($lang_list[$i]['require'] !== '') ? '&emsp;<i>(Requires: ' . $lang_list[$i]['require'] . ')</i>' : '';
                        echo '<br>';
                    }
                    ?>
                </div>
            </div>
            <!--end post box-->
            <div class="postbox meta-col">
                <h3 class="hndle"><i class="dashicons-before dashicons-admin-plugins"
                                     style="color: #af0013"> </i><span>Select Plugins</span></h3>

                <div class="inside">
                    <?php
                    for ($i = 1; $i <= count($plugin_list); $i++) {
                        echo '<input ';
                        echo (in_array($i, $db['plugin'])) ? ' checked ' : '';
                        echo ' name="' . APFW_OPTION_NAME . '[plugin][]" value="' . $i . '" id="pplugin-' . $i . '" type="checkbox">';
                        echo '<label for="pplugin-' . $i . '">' . $plugin_list[$i]['name'] . "</label>";
                        echo '&emsp;<a target="_blank" href="' . $plugin_list[$i]['url'] . '">View Demo</a><br>';
                    }
                    ?>
                </div>
            </div>
            <!--end post box-->
        </div>
        <!--end post stuff-->
        <hr>
        <p>
            <input name="<?php echo APFW_OPTION_NAME ?>[onlyOnPost]" id="p_onlyOnPost"
                   type="checkbox" <?php checked($db['onlyOnPost'], 1); ?>>
            <label for="p_onlyOnPost">Enqueue Prism files (CSS+JS) only to post/single pages</label>&ensp;
            <input name="<?php echo APFW_OPTION_NAME ?>[noAssistant]" id="p_noAssistant"
                   type="checkbox" <?php checked($db['noAssistant'], 1); ?>>
            <label for="p_noAssistant">Don't show Assistant Button in editor</label>
        </p>
        <hr>
    </form>
    <!--end form-->
    Created with &hearts; by <a target="_blank" href="http://ankurk91.github.io/"> Ankur Kumar</a> |
    View <a target="_blank" href="http://www.prismjs.com">Original Developer Site </a>for Demos |
    Fork on <a target="_blank" href="https://github.com/ankurk91/wp-prism-js">GitHub</a>
    <!--end dev info-->
    <?php if (WP_DEBUG == true) {
        echo '<hr><p><h5>Showing Debugging Info:</h5><pre>';
        var_dump($db);
        echo '</pre></p><hr>';
    } ?>
</div> <!--end wrap-->
<!--options page ends here -->