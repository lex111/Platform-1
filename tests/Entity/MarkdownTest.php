<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace Tests;

class MarkdownTest extends BrowserKitTest
{
    protected $page;

    public function setUp()
    {
        parent::setUp();
        $this->page = \DocsPen\Page::first();
    }

    protected function setMarkdownEditor()
    {
        $this->setSettings(['app-editor' => 'markdown']);
    }

    public function test_default_editor_is_wysiwyg()
    {
        $this->assertEquals(setting('app-editor'), 'wysiwyg');
        $this->asAdmin()->visit($this->page->getUrl().'/edit')
            ->pageHasElement('#html-editor');
    }

    public function test_markdown_setting_shows_markdown_editor()
    {
        $this->setMarkdownEditor();
        $this->asAdmin()->visit($this->page->getUrl().'/edit')
            ->pageNotHasElement('#html-editor')
            ->pageHasElement('#markdown-editor');
    }

    public function test_markdown_content_given_to_editor()
    {
        $this->setMarkdownEditor();
        $mdContent = '# hello. This is a test';
        $this->page->markdown = $mdContent;
        $this->page->save();
        $this->asAdmin()->visit($this->page->getUrl().'/edit')
            ->seeInField('markdown', $mdContent);
    }

    public function test_html_content_given_to_editor_if_no_markdown()
    {
        $this->setMarkdownEditor();
        $this->asAdmin()->visit($this->page->getUrl().'/edit')
            ->seeInField('markdown', $this->page->html);
    }
}
