<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace Tests;

class CommentSettingTest extends BrowserKitTest
{
    protected $page;

    public function setUp()
    {
        parent::setUp();
        $this->page = \DocsPen\Page::first();
    }

    public function test_comment_disable()
    {
        $this->asAdmin();

        $this->setSettings(['app-disable-comments' => 'true']);

        $this->asAdmin()->visit($this->page->getUrl())
    ->pageNotHasElement('.comments-list');
    }

    public function test_comment_enable()
    {
        $this->asAdmin();

        $this->setSettings(['app-disable-comments' => 'false']);

        $this->asAdmin()->visit($this->page->getUrl())
    ->pageHasElement('.comments-list');
    }
}
