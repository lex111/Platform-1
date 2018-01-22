<?php

namespace DocsPen\Console\Commands;

use DocsPen\Services\PermissionService;
use Illuminate\Console\Command;

class RegeneratePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docspen:permissions {--database= : The database connection to use.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate all system permissions';

    /**
     * The service to handle the permission system.
     *
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * Create a new command instance.
     *
     * @param PermissionService $permissionService
     */
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $connection = \DB::getDefaultConnection();
        if ($this->option('database') !== null) {
            \DB::setDefaultConnection($this->option('database'));
            $this->permissionService->setConnection(\DB::connection($this->option('database')));
        }

        $this->permissionService->buildJointPermissions();

        \DB::setDefaultConnection($connection);
        $this->comment('Permissions regenerated');
    }
}
