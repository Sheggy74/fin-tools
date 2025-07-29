<?php

namespace App\Command;

use App\Services\SecurityService\SecurityService;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'SecurityCommand',
    description: 'Add a short description for your command',
)]
class SecurityCommand extends Command
{
    public function __construct(private LoggerInterface $logger, private SecurityService $service)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('Получает сообщение из RabbitMQ и возвращает список ценных бумаг');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $connection = new AMQPStreamConnection('rabbitmq', 5672, $_ENV['RABBITMQ_USER'], $_ENV['RABBITMQ_PASS']);
        $channel = $connection->channel();

        $channel->queue_declare('security', false, true, false, false);

        $io->success('Ожидание сообщений...');

        $callback = function (AMQPMessage $msg) use ($io,$channel){
            $data = json_decode($msg->body, true);

            $io->writeln(sprintf('Отбираем ценные бумаги по запросу: %s', $data['query']));
            $this->logger->info(sprintf('Отбираем ценные бумаги по запросу: %s', $data['query']));

            $response = $this->service->getSecurities($data['query']);

            if(!empty($msg->get('reply_queue')))
            $channel->basic_publish(new AMQPMessage($response, [
                'correlation_id' => $msg->get('correlation_id')
            ]), '', $msg->get('reply_queue'));

            $msg->ack();
        };

        $channel->basic_qos(null, 1, null);
        $channel->basic_consume('security', '', false, false, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();

        return Command::SUCCESS;
    }
}
