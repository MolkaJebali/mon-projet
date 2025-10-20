<?php

namespace App\Command;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddAuthorsCommand extends Command
{
    protected static $defaultName = 'app:add-authors';
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Add sample authors to database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $authors = [
            ['Victor Hugo', 'victor.hugo@gmail.com', 100],
            ['William Shakespeare', 'william.shakespeare@gmail.com', 200],
            ['Taha Hussein', 'taha.hussein@gmail.com', 300],
        ];

        foreach ($authors as $authorData) {
            $author = new Author();
            $author->setUsername($authorData[0]);
            $author->setEmail($authorData[1]);
            $author->setNbBooks($authorData[2]);

            $this->entityManager->persist($author);
        }

        $this->entityManager->flush();

        $output->writeln('Authors added successfully to PostgreSQL!');
        return Command::SUCCESS;
    }
}