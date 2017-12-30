<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace Tests;

use DocsPen\JointPermission;
use DocsPen\Page;
use DocsPen\Repos\EntityRepo;

class CommandsTest extends TestCase
{
    public function test_clear_views_command()
    {
        $this->asEditor();
        $page = Page::first();

        $this->get($page->getUrl());

        $this->assertDatabaseHas('views', [
            'user_id'     => $this->getEditor()->id,
            'viewable_id' => $page->id,
            'views'       => 1,
        ]);

        $exitCode = \Artisan::call('docspen:clear-views');
        $this->assertTrue($exitCode === 0, 'Command executed successfully');

        $this->assertDatabaseMissing('views', [
            'user_id' => $this->getEditor()->id,
        ]);
    }

    public function test_clear_activity_command()
    {
        $this->asEditor();
        $page = Page::first();
        \Activity::add($page, 'page_update', $page->book->id);

        $this->assertDatabaseHas('activities', [
            'key'       => 'page_update',
            'entity_id' => $page->id,
            'user_id'   => $this->getEditor()->id,
        ]);

        $exitCode = \Artisan::call('docspen:clear-activity');
        $this->assertTrue($exitCode === 0, 'Command executed successfully');

        $this->assertDatabaseMissing('activities', [
            'key' => 'page_update',
        ]);
    }

    public function test_clear_revisions_command()
    {
        $this->asEditor();
        $entityRepo = $this->app[EntityRepo::class];
        $page = Page::first();
        $entityRepo->updatePage($page, $page->book_id, ['name' => 'updated page', 'html' => '<p>new content</p>', 'summary' => 'page revision testing']);
        $entityRepo->updatePageDraft($page, ['name' => 'updated page', 'html' => '<p>new content in draft</p>', 'summary' => 'page revision testing']);

        $this->assertDatabaseHas('page_revisions', [
            'page_id' => $page->id,
            'type'    => 'version',
        ]);
        $this->assertDatabaseHas('page_revisions', [
            'page_id' => $page->id,
            'type'    => 'update_draft',
        ]);

        $exitCode = \Artisan::call('docspen:clear-revisions');
        $this->assertTrue($exitCode === 0, 'Command executed successfully');

        $this->assertDatabaseMissing('page_revisions', [
            'page_id' => $page->id,
            'type'    => 'version',
        ]);
        $this->assertDatabaseHas('page_revisions', [
            'page_id' => $page->id,
            'type'    => 'update_draft',
        ]);

        $exitCode = \Artisan::call('docspen:clear-revisions', ['--all' => true]);
        $this->assertTrue($exitCode === 0, 'Command executed successfully');

        $this->assertDatabaseMissing('page_revisions', [
            'page_id' => $page->id,
            'type'    => 'update_draft',
        ]);
    }

    public function test_regen_permissions_command()
    {
        JointPermission::query()->truncate();
        $page = Page::first();

        $this->assertDatabaseMissing('joint_permissions', ['entity_id' => $page->id]);

        $exitCode = \Artisan::call('docspen:regenerate-permissions');
        $this->assertTrue($exitCode === 0, 'Command executed successfully');

        $this->assertDatabaseHas('joint_permissions', ['entity_id' => $page->id]);
    }
}
