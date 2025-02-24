<?php

namespace Liloi\Euphoria;

use Rune\Application\General as GeneralApplication;
use Liloi\Config\Pool;
use Liloi\Config\Sparkle;
use Liloi\Euphoria\Domains\Failures\Manager as FailuresManager;
use Liloi\Euphoria\Domains\Manager as DomainsManager;

class Application extends GeneralApplication
{
    const PREFIX = 'Liloi\Euphoria';

    public function __construct(array $config)
    {
        parent::__construct($config);

        spl_autoload_register(function ($className) {
            if(!str_starts_with($className, self::PREFIX))
            {
                return;
            }

            $className = str_replace(self::PREFIX, '', $className);
            $className = str_replace('\\', '/', $className);

            $file = __DIR__ . $className . '.php';

            if(file_exists($file))
            {
                require_once $file;
            }
        });

        Pool::getSingleton()->set(new Sparkle('connection', function() use ($config) { return $config['connection'];}));
        Pool::getSingleton()->set(new Sparkle('prefix', function() use ($config) { return $config['prefix'];}));
        DomainsManager::setConfig(Pool::getSingleton());
    }

    public function apiLayout(): array
    {
        return [
            'render' => $this->render(__DIR__ . '/Layout.tpl', [
                'config' => $this->getConfig()
            ]),
        ];
    }

    public function apiCreate(): array
    {
        FailuresManager::create();
        return [];
    }

    public function apiShow(): array
    {
        $collection = FailuresManager::loadCollection();

        return [
            'render' => $this->render(__DIR__ . '/Show.tpl', [
                'collection' => $collection
            ])
        ];
    }

    public function apiEdit(): array
    {
        $entity = FailuresManager::load($_POST['parameters']['key']);

        return [
            'render' => $this->render(__DIR__ . '/Edit.tpl', [
                'entity' => $entity
            ])
        ];
    }

    public function apiSave(): array
    {
        $entity = FailuresManager::load($_POST['parameters']['key']);

        $entity->setTitle($_POST['parameters']['title']);
        $entity->setSummary($_POST['parameters']['summary']);
        $entity->setData($_POST['parameters']['data']);

        $entity->save();

        return [];
    }
}