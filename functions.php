<?php
// Disable theme updates
add_filter('site_transient_update_themes', function ($updates) {
    if (isset($updates->response)) {
        $updates->response = array();
    }
    return $updates;
});

// Disable update page
add_action('admin_menu', function () {
    if (!current_user_can('update_core')) {
        return;
    }
    remove_submenu_page('index.php', 'update-core.php');
});

// Hide update notifications
add_filter('pre_site_transient_update_core', function () {
    global $wp_version;
    return (object)array('last_checked' => time(), 'version_checked' => $wp_version);
});
add_filter('pre_site_transient_update_plugins', function () {
    global $wp_version;
    return (object)array('last_checked' => time(), 'version_checked' => $wp_version);
});
add_filter('pre_site_transient_update_themes', function () {
    global $wp_version;
    return (object)array('last_checked' => time(), 'version_checked' => $wp_version);
});

?>
