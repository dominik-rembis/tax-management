<?php

namespace App\User\Data\Command;

use App\User\Data\Factory\UserDataFactory;
use App\User\Data\Repository\UserDataRepository;
use App\User\Data\Service\PasswordGenerator;
use App\User\Permission\Repository\UserPermissionRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(
    name: 'user:initialize',
    description: 'First user initialization',
)]
final class UserCreateCommand extends Command
{
    private PasswordGenerator $passwordGenerator;

    public function __construct(
        private readonly UserDataRepository $userDataRepository,
        private readonly UserPermissionRepository $userPermissionRepository,
        private readonly ValidatorInterface $validator
    ) {
        $this->passwordGenerator = new PasswordGenerator();
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED)
            ->addArgument('surname', InputArgument::REQUIRED)
            ->addArgument('email', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($this->userDataRepository->isUser()) {
            $output->writeln('First user already exists in the database');
            return Command::INVALID;
        }

        $userData = UserDataFactory::create(...$this->prepareUserData($input));

        if ($this->validator->validate($userData)->count() > 0) {
            $output->writeln('Invalid data provided');
            return Command::INVALID;
        }

        $this->userDataRepository->save($userData);

        $output->writeln(sprintf('User password: %s', $this->passwordGenerator->getPlainPassword()));

        return Command::SUCCESS;
    }

    private function prepareUserData(InputInterface $input): array
    {
        return [
            ...array_slice($input->getArguments(), 1),
            'password' => $this->passwordGenerator->getPasswordHash(),
            'permissions' => $this->userPermissionRepository->findAll()
        ];
    }
}
