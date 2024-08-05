<?php

namespace App\Command;

use App\Entity\Country;
use App\Entity\Currency;
use App\Entity\UidFactory;
use App\Repository\CountryRepository;
use App\Repository\CurrencyRepository;
use App\Repository\Exception\NotFoundException;
use DateTime;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'movyn:import:countries')]
class CountryETLCommand extends Command
{
    private $currencies = [];
    public function __construct(
        private string $rootDir,
        private CurrencyRepository $currencyRepository,
        private CountryRepository $countryRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $rawCountries = json_decode(file_get_contents($this->rootDir . '/data/country-by-currency-code.json'), true);
        $currentDatetime = new DateTime();
        foreach ($rawCountries as $data) {
            try {
                $currency = $this->getCurrencyByCode($data['currency_code'] ?? '');
            } catch (NotFoundException) {
                continue;
            }

            $country = new Country();
            $country->setUid(UidFactory::create(Country::class))
                ->setName($data['country'])
                ->setAcronym('TEMP')
                ->setFlag('TEMP')
                ->setCurrency($currency)
                ->setCreatedAt($currentDatetime)
                ->setUpdatedAt($currentDatetime);

            $this->countryRepository->persist($country);
        }
        $this->countryRepository->flush();

        $output->writeln(sprintf('%s - %d countries imported - OK', CountryETLCommand::class, count($rawCountries)));

        return Command::SUCCESS;
    }

    private function getCurrencyByCode(string $code): Currency
    {
        if (array_key_exists($code, $this->currencies)) {
            return $this->currencies[$code];
        }

        $currency = $this->currencyRepository->findByCode($code);
        $this->currencies[$code] = $currency;

        return $currency;
    }
}
