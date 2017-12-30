<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen\Exceptions;

class NotFoundException extends PrettyException
{
    /**
     * NotFoundException constructor.
     *
     * @param string $message
     */
    public function __construct($message = 'Item not found')
    {
        parent::__construct($message, 404);
    }
}
