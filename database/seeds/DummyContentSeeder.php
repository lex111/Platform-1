<?php

use Illuminate\Database\Seeder;

class DummyContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an editor user
        $editorUser = factory(\DocsPen\User::class)->create();
        $editorRole = \DocsPen\Role::getRole('editor');
        $editorUser->attachRole($editorRole);

        // Create a viewer user
        $viewerUser = factory(\DocsPen\User::class)->create();
        $role = \DocsPen\Role::getRole('viewer');
        $viewerUser->attachRole($role);

        factory(\DocsPen\Book::class, 20)->create(['created_by' => $editorUser->id, 'updated_by' => $editorUser->id])
            ->each(function ($book) use ($editorUser) {
                $chapters = factory(\DocsPen\Chapter::class, 5)->create(['created_by' => $editorUser->id, 'updated_by' => $editorUser->id])
                    ->each(function ($chapter) use ($editorUser, $book) {
                        $pages = factory(\DocsPen\Page::class, 5)->make(['created_by' => $editorUser->id, 'updated_by' => $editorUser->id, 'book_id' => $book->id]);
                        $chapter->pages()->saveMany($pages);
                    });
                $pages = factory(\DocsPen\Page::class, 3)->make(['created_by' => $editorUser->id, 'updated_by' => $editorUser->id]);
                $book->chapters()->saveMany($chapters);
                $book->pages()->saveMany($pages);
            });

        $largeBook = factory(\DocsPen\Book::class)->create(['name' => 'Large book'.str_random(10), 'created_by' => $editorUser->id, 'updated_by' => $editorUser->id]);
        $pages = factory(\DocsPen\Page::class, 200)->make(['created_by' => $editorUser->id, 'updated_by' => $editorUser->id]);
        $chapters = factory(\DocsPen\Chapter::class, 50)->make(['created_by' => $editorUser->id, 'updated_by' => $editorUser->id]);
        $largeBook->pages()->saveMany($pages);
        $largeBook->chapters()->saveMany($chapters);
        app(\DocsPen\Services\PermissionService::class)->buildJointPermissions();
        app(\DocsPen\Services\SearchService::class)->indexAllEntities();
    }
}
