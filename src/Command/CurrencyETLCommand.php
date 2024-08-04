<?php

namespace App\Command;

use App\Entity\Currency;
use App\Entity\UidFactory;
use App\Repository\CurrencyRepository;
use DateTime;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'movyn:import:currencies')]
class CurrencyETLCommand extends Command
{
    public function __construct(private CurrencyRepository $currencyRepository) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $rawCurrencies = json_decode(file_get_contents(__DIR__ . '/../../data/currencies.json'), true);
        $currentDatetime = new DateTime();

        $this->currencyRepository->setIsFlushDisabled(true);
        foreach ($rawCurrencies as $data) {
            $currency = new Currency();

            $currency->setUid(UidFactory::create(Currency::class))
                ->setCode($data['code'])
                ->setName($data['name'])
                ->setSymbol($data['symbol'])
                ->setNativeSymbol($data['symbol_native'])
                ->setCreatedAt($currentDatetime)
                ->setUpdatedAt($currentDatetime);

            $this->currencyRepository->persist($currency);
        }
        $this->currencyRepository->flush();

        $output->writeln(sprintf('%s - %d currencies imported - OK', CurrencyETLCommand::class, count($rawCurrencies)));

        return Command::SUCCESS;
    }
}
