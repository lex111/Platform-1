<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

return [
    'pdf' => [
        'enabled' => true,
        'binary'  => file_exists(base_path('wkhtmltopdf')) ? base_path('wkhtmltopdf') : env('WKHTMLTOPDF', false),
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],
    'image' => [
        'enabled' => false,
        'binary'  => '/usr/local/bin/wkhtmltoimage',
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],
];
