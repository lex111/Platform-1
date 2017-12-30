<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */
use Illuminate\Database\Migrations\Migration;

class UpdateDbEncodingToUt8mb4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Migration removed due to issues during live migration.
        // Instead you can run the command `artisan docspen:db-utf8mb4`
        // which will generate out the SQL request to upgrade your DB to utf8mb4.
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
