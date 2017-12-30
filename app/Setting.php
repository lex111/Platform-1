<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen;

class Setting extends Model
{
    protected $fillable = ['setting_key', 'value'];

    protected $primaryKey = 'setting_key';
}
