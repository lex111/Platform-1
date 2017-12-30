<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen\Console\Commands;

use DocsPen\PageRevision;
use Illuminate\Console\Command;

class ClearRevisions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docspen:clear-revisions
                            {--a|all : Include active update drafts in deletion}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear page revisions';

    protected $pageRevision;

    /**
     * Create a new command instance.
     *
     * @param PageRevision $pageRevision
     */
    public function __construct(PageRevision $pageRevision)
    {
        $this->pageRevision = $pageRevision;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $deleteTypes = $this->option('all') ? ['version', 'update_draft'] : ['version'];
        $this->pageRevision->newQuery()->whereIn('type', $deleteTypes)->delete();
        $this->comment('Revisions deleted');
    }
}
