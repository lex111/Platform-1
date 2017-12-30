<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen;

use Images;

class Image extends Ownable
{
    protected $fillable = ['name'];

    /**
     * Get a thumbnail for this image.
     *
     * @param int        $width
     * @param int        $height
     * @param bool|false $keepRatio
     *
     * @return string
     */
    public function getThumb($width, $height, $keepRatio = false)
    {
        return Images::getThumbnail($this, $width, $height, $keepRatio);
    }
}
