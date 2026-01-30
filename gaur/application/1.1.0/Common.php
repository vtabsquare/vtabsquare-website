<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */

(function () {
    $folders = [
        [
            'time' => '-12 hours',
            'path' => __DIR__ . '/../../writable/session/'
        ],
    ];

    foreach ($folders as $folder) {
        if (!is_dir($folder['path'])) {
            continue;
        }

        $gctime = strtotime($folder['time']);
        $files = array_slice(scandir($folder['path']), 2);

        foreach ($files as $file) {
            $fpath = $folder['path'] . $file;

            if (filemtime($fpath) <= $gctime) {
                unlink($fpath);
            }
        }
    }
})();
