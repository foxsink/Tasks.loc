<?php


namespace App\Command;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class ModeUserCommand extends Command
{
    private EntityManagerInterface $entityManager;
    protected static $defaultName = 'app:user:role';

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addArgument('email', InputArgument::OPTIONAL, 'The email of user')
            ->addArgument('role', InputArgument::OPTIONAL, 'The role of user')
            ->setDescription('Change user role')
            ->setHelp('This command allows you to change user.')
        ;
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $this->addArgument('confirm', InputArgument::OPTIONAL);
        do {
            $helper = $this->getHelper('question');
            if (!$input->getArgument('email')) {
                $questionEmail = new Question("Enter user email to change his role\n");
                $input->setArgument('email', $helper->ask($input, $output, $questionEmail));
            }

            if (!$input->getArgument('role')) {
                $questionRole = new ChoiceQuestion(
                    "User role change to [\"ROLE_USER\",\"ROLE_ADMIN\",\"ROLE_SUPERADMIN\"] (default: ROLE_ADMIN)\n",
                    ["ROLE_USER", "ROLE_ADMIN" ,"ROLE_SUPERADMIN"],
                    "ROLE_ADMIN"
                );
                $input->setArgument('role', $helper->ask($input, $output, $questionRole));
            }
            $questionConfirm = new ConfirmationQuestion(
                sprintf(
                    "Give to %s role %s? [y/N]\n",
                    $input->getArgument('email'),
                    $input->getArgument('role')
                ),
                false,
                '/^(y|yes|ye|yep|sure)/i'
            );
            $input->setArgument('confirm', $helper->ask($input, $output, $questionConfirm));
            if (!$input->getArgument('confirm')) {
                $input->setArgument('email', null);
                $input->setArgument('role', null);
            }
        } while (!preg_match("/^1$/i", $input->getArgument('confirm')));


    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $input->getArgument('email')]);
        if ($user) {
            $output->writeln('Email: ' . $user->getEmail() . ' found');
            $output->writeln('Previous roles: ' . join(", ", $user->getRoles()));
            $user->setRoles([$input->getArgument('role')]);
            $this->entityManager->flush();
            return 0;
        }
        return 1;
    }

}