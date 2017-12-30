<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    /**
     * Provides public access to get the raw attribute value from the model.
     * Used in areas where no mutations are required but performance is critical.
     *
     * @param $key
     *
     * @return mixed
     */
    public function getRawAttribute($key)
    {
        return parent::getAttributeFromArray($key);
    }
}
