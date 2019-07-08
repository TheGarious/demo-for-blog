<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';

    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Command for create user')
            ->addArgument('firstName', InputArgument::REQUIRED, 'User firstname')
            ->addArgument('lastName', InputArgument::OPTIONAL, 'User lastname optional')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Command Create User',
            '============'
        ]);

        $user = new User();

        $user->setFirstName($input->getArgument("firstName"));
        $output->writeln("With firstname : ". $user->getFirstName());

        $lastName = $input->getArgument("lastName");

        if (!$lastName) {
            $output->writeln("User doesn't have a lastname");
        } else {
            $user->setLastName($lastName);
            $output->writeln("With lastname : ". $user->getLastName());
        }

        $this->manager->persist($user);
        $this->manager->flush();
        $output->writeln('Successful you have created the user : '. $user->getFirstName() . " ". $user->getLastName());
    }
}
