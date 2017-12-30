<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen\Exceptions;

class NotifyException extends \Exception
{
    public $message;
    public $redirectLocation;

    /**
     * NotifyException constructor.
     *
     * @param string $message
     * @param string $redirectLocation
     */
    public function __construct($message, $redirectLocation)
    {
        $this->message = $message;
        $this->redirectLocation = $redirectLocation;
        parent::__construct();
    }
}
