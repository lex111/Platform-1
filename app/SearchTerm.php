<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen;

class SearchTerm extends Model
{
    protected $fillable = ['term', 'entity_id', 'entity_type', 'score'];
    public $timestamps = false;

    /**
     * Get the entity that this term belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity()
    {
        return $this->morphTo('entity');
    }
}
