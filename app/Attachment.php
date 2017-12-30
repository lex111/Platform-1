<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen;

class Attachment extends Ownable
{
    protected $fillable = ['name', 'order'];

    /**
     * Get the downloadable file name for this upload.
     *
     * @return mixed|string
     */
    public function getFileName()
    {
        if (str_contains($this->name, '.')) {
            return $this->name;
        }

        return $this->name.'.'.$this->extension;
    }

    /**
     * Get the page this file was uploaded to.
     *
     * @return Page
     */
    public function page()
    {
        return $this->belongsTo(Page::class, 'uploaded_to');
    }

    /**
     * Get the url of this file.
     *
     * @return string
     */
    public function getUrl()
    {
        return baseUrl('/attachments/'.$this->id);
    }
}
