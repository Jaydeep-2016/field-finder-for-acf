<?php
defined('ABSPATH') || exit;

// Add submenu page
add_action('admin_menu', function () {
    add_submenu_page(
        'tools.php',
        'Field Finder for ACF',
        'Field Finder for ACF',
        'manage_options',
        'field-finder-for-acf',
        'fielffoa_render_admin_page'
    );
});

function fielffoa_render_admin_page()
{
    // Handle form submission
    $results = [];
    $search_field = '';
    $show_full_path = false;

    if (isset($_POST['fielffoa_field_name']) && check_admin_referer('fielffoa_search_field', 'fielffoa_nonce')) {
        $search_field = sanitize_text_field(wp_unslash($_POST['fielffoa_field_name']));
        $show_full_path = isset($_POST['fielffoa_show_full_path']);

        if (!empty($search_field)) {
            $results = fielffoa_find_field_usage_in_theme($search_field, $show_full_path);
        }
    }    
?>
    <div class="wrap fielffoa-wrapper">
        <h1>ACF Field Finder</h1>
        <form method="post">
            <?php wp_nonce_field('fielffoa_search_field', 'fielffoa_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="fielffoa_field_name">ACF Field Name</label></th>
                    <td><input name="fielffoa_field_name" type="text" id="fielffoa_field_name" value="<?php echo esc_attr($search_field); ?>" required></td>
                </tr>
                <tr>
                    <th scope="row">Display Full File Path</th>
                    <td>
                        <label>
                            <input type="checkbox" name="fielffoa_show_full_path" value="1" <?php checked(isset($_POST['fielffoa_show_full_path'])); ?>>
                            Show full file path in results
                        </label>
                    </td>
                </tr>
            </table>
            <?php submit_button('Find Field Usage'); ?>
        </form>

        <?php if (!empty($results)) : ?>
            <div class="fielffoa-results">
                <h2>Results</h2>
                <ul>
                    <?php foreach ($results as $file) : ?>
                        <li><code><?php echo esc_html($file); ?></code></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php elseif ($search_field && empty($results)) : ?>
            <div class="fielffoa-results">
                <p><em>No usage found for "<strong><?php echo esc_html($search_field); ?></strong>" in theme files.</em></p>
            </div>
        <?php endif; ?>
    </div>
<?php
}
