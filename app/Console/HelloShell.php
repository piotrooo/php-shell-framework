<?php
/**
 * HelloShell
 *
 * @author Piotrooo
 */
namespace Console;

use Psf\Interfaces\ShellApplicationInterface;
use Psf\Shell;

class HelloShell extends Shell implements ShellApplicationInterface
{
    public function configure()
    {
        $this
            ->addArgument('n', 'name');
    }

    public function main()
    {
        $this->out("Dzien dobry");
    }
}