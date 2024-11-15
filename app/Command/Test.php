<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Hyperf\DbConnection\Db;
use Psr\Container\ContainerInterface;

#[Command]
class Test extends HyperfCommand
{
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('test');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Hyperf Demo Command');
    }

    public function handle()
    {
        $default_connection = Db::connection("default");
        $no_ssl_connection = Db::connection("no_ssl");
        echo "No SSL in DB without SSL:\n";
        var_dump(
            $no_ssl_connection->select("Show databases;")
        );
        var_dump(
            $no_ssl_connection->getPdo()->getAttribute(\PDO::ATTR_SERVER_VERSION)
        );

        echo "SSL in DB with SSL:\n";

        var_dump(
            $default_connection->select("Show databases;")
        );
        var_dump(
            $default_connection->getPdo()->getAttribute(\PDO::ATTR_SERVER_VERSION)
        );
    }
}
