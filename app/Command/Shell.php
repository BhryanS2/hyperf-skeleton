<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Hyperf\DbConnection\Db;
use Psr\Container\ContainerInterface;

#[Command]
class Shell extends HyperfCommand
{
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('shell');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Hyperf Demo Command');
    }

    public function handle()
    {
        shell_exec("php /opt/www/bin/shell-test.php");
    }
}
