<?php
function fielffoa_find_field_usage_in_theme($field_name, $full_path = false) {
    $theme_dir = get_stylesheet_directory();
    $matched_files = [];

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($theme_dir, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if ($file->getExtension() !== 'php') {
            continue;
        }

        $contents = file_get_contents($file->getRealPath());

        if (preg_match_all("/\b(get_field|get_sub_field|the_field)\s*\(\s*[\"']{$field_name}[\"']/", $contents)) {
            $matched_files[] = $full_path ? $file->getRealPath() : str_replace($theme_dir . '/', '', $file->getRealPath());
        }
    }

    return $matched_files;
}
