<?php
/**
 * TableShell
 *
 * @author Piotr Olaszewski
 */
namespace Console;

use Psf\Interfaces\ApplicationInterface;
use Psf\Shell;

class TableShell extends Shell implements ApplicationInterface
{
    public function configure()
    {
    }

    public function main()
    {
        $table = $this->getHelper('Table');
        $table
            ->setHeaders(array('ID', 'Name', 'Surname'))
            ->setRows(array(
                array('1', 'John', 'Smith'),
                array('2', 'Brad', 'Pitt'),
                array('3', 'Denzel', 'Washington'),
                array('4', 'Angelina', 'Jolie')
            ));
        $table->addRow(array('5', 'Peter', 'Nosurname'));
        $table->render($this->getStdout());
    }
}