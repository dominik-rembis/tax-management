<?php

namespace App\User\Permission\Command;

use App\User\Permission\Dictionary\Permission;
use App\User\Permission\Model\UserPermission;
use App\User\Permission\Repository\UserPermissionRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'permission:seed',
    description: 'Supplementing the database with priorities',
)]
class PermissionSeedCommand extends Command
{
    public function __construct(
        private readonly UserPermissionRepository $permissionRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $permissions = [];
        $existingPermissions = $this->permissionRepository->findAllNames();

        foreach (Permission::cases() as $permission) {
            if (!in_array($permission->name, $existingPermissions)) {
                $permissions[] = new UserPermission($permission->name);
            }
        }

        $this->permissionRepository->save(...$permissions);

        return Command::SUCCESS;
    }
}
