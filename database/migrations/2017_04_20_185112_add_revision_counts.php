<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRevisionCounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->integer('revision_count');
        });
        Schema::table('page_revisions', function (Blueprint $table) {
            $table->integer('revision_number');
            $table->index('revision_number');
        });

        // Update revision count
        $pTable = DB::getTablePrefix().'pages';
        $rTable = DB::getTablePrefix().'page_revisions';
        DB::statement("UPDATE ${pTable} SET ${pTable}.revision_count=(SELECT count(*) FROM ${rTable} WHERE ${rTable}.page_id=${pTable}.id)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('revision_count');
        });
        Schema::table('page_revisions', function (Blueprint $table) {
            $table->dropColumn('revision_number');
        });
    }
}
