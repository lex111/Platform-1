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

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pdo = \DB::connection()->getPdo();
        $mysqlVersion = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
        $requiresISAM = strpos($mysqlVersion, '5.5') === 0;

        Schema::create('pages', function (Blueprint $table) use ($requiresISAM) {
            if ($requiresISAM) {
                $table->engine = 'MyISAM';
            }

            $table->increments('id');
            $table->integer('book_id');
            $table->integer('chapter_id');
            $table->string('name');
            $table->string('slug')->indexed();
            $table->longText('html');
            $table->longText('text');
            $table->integer('priority');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
