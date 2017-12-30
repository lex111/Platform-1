<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen;

/**
 * Class Attribute.
 */
class Tag extends Model
{
    protected $fillable = ['name', 'value', 'order'];

    /**
     * Get the entity that this tag belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity()
    {
        return $this->morphTo('entity');
    }
}
