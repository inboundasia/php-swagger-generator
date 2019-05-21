<?php

require __DIR__ . '/vendor/autoload.php';

use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;
use Doctrine\Common\Inflector\Inflector;

class Command extends CLI
{
    // register options and arguments
    protected function setup(Options $options)
    {
        $options->setHelp('A very minimal example that does nothing but print a version');
        $options->registerOption('version', 'print version', 'v');
        $options->registerOption('model', 'model name', 'm', 'model');
        $options->registerOption('path', 'write path name', 'm', 'path');
    }

    // implement your code
    protected function main(Options $options)
    {
        $ModelName = $options->getOpt('model');
        $Path = $options->getOpt('path') . '/';

        if (!$Path) {
            $Path = './';
        }

        $ClassifyModelName = Inflector::classify($ModelName);
        $CamelizeModelName = Inflector::camelize($ModelName);
        $PluralizeModelName = Inflector::pluralize($CamelizeModelName);
        $PluralizeModelNameU = Inflector::pluralize($ModelName);

        mkdir($Path . $PluralizeModelName);

        $content = file_get_contents('./stubs/index.yaml.stub');
        $content = str_replace('{{ ClassifyModelName }}', $ClassifyModelName, $content);
        $content = str_replace('{{ CamelizeModelName }}', $CamelizeModelName, $content);
        $content = str_replace('{{ PluralizeModelName }}', $PluralizeModelName, $content);
        $content = str_replace('{{ PluralizeModelNameU }}', $PluralizeModelNameU, $content);
        file_put_contents($Path . $PluralizeModelName . '/index.yaml', $content);

        $content = file_get_contents('./stubs/_id.yaml.stub');
        $content = str_replace('{{ ClassifyModelName }}', $ClassifyModelName, $content);
        $content = str_replace('{{ CamelizeModelName }}', $CamelizeModelName, $content);
        $content = str_replace('{{ PluralizeModelName }}', $PluralizeModelName, $content);
        $content = str_replace('{{ PluralizeModelNameU }}', $PluralizeModelNameU, $content);
        file_put_contents($Path . $PluralizeModelName . '/_id.yaml', $content);
    }
}
// execute it
$cli = new Command();
$cli->run();
