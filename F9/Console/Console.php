<?php namespace F9\Console;

use F9\Providers\MigrationServiceProvider;
use F9\Providers\SeedServiceProvider;
use F9\Support\Provider\EloquentServiceProvider;
use Illuminate\Console\Application;
use Illuminate\Filesystem\ClassFinder;
use Nine\Collections\ConfigInterface;
use Nine\Collections\Paths;
use Nine\Containers\Forge;
use Nine\Exceptions\CannotAddNonexistentClass;
use Nine\Library\Lib;
use Pimple\Container;

/**
 * @package Nine
 * @version 0.4.2
 * @author  Greg Truesdell <odd.greg@gmail.com>
 */
class Console extends Application
{
    /** @var array */
    protected $appCommands = [];

    /** @var ConfigInterface */
    protected $config;

    /** @var array */
    protected $frameworkCommands = [];

    /** @var Paths */
    protected $paths;

    /**
     * Console constructor.
     *
     * @param ConfigInterface $config
     * @param Paths           $paths
     * @param string          $version
     */
    public function __construct(ConfigInterface $config, Paths $paths, $version = \F9\Application\Application::VERSION)
    {
        $this->config = $config;
        $this->paths = $paths;

        /** @var Container $app */
        $app = Forge::find('app');

        // the parent is a hijacked copy of the illuminate console application.
        // we hijacked it mainly to override a few properties - such as the title.
        parent::__construct(forge('illuminate.container'), forge('illuminate.events'), $version);

        //$this->bootSettings();
        $this->configureEnvironment();

        // in all cases, register the framework commands
        $this->registerFrameworkCommands();

        // register the cloned artisan commands
        $this->registerArtisanCommands();
    }

    /**
     * @return array
     */
    public function getAppCommands()
    {
        return $this->appCommands;
    }

    /**
     * @return array
     */
    public function getFrameworkCommands()
    {
        return $this->frameworkCommands;
    }

    /**
     * Accepts a single-dimension array of Command class names.
     *
     * @param array $commandList
     */
    public function registerAppCommands(array $commandList)
    {
        foreach ($commandList as $command) {
            $this->appCommands[] = Lib::get_class_name($command);
            $this->add(new $command);
        }
    }

    /**
     * Registers an array of application mode Command class names.
     *
     * Reads all classes located in the given path, so only Commands
     * should be the only classes in the path.
     *
     * @param string $commandPath
     */
    public function registerAppCommandsIn(string $commandPath)
    {
        $commands = $this->registerCommandsIn($commandPath);

        // this may not be the only call to register application mode commands,
        // so merge with the app commands array.
        $this->appCommands = array_merge($this->appCommands, $commands);
    }

    /**
     * Apply and register `Application` settings.
     *
     * @throws CannotAddNonexistentClass
     */
    private function bootSettings()
    {
        // contextual use for routes and di
        $app = $this;

        // load the local environment
        date_default_timezone_set($this['timezone']);
        mb_internal_encoding($this['mb_internal_encoding']);
        setlocale(LC_ALL, $this['locale']);

        //$this['nine.container'] = $this->container; # Forge::getInstance();
        //$this['nine.events'] = function () { return $this->events; };
        //
        //// For DI, associate the Pimple\Container with this instance of F9\Application.
        //$this->container->add([\Pimple\Container::class, Application::class], function () use ($app) { return $this; });
        //
        //// set native dependencies
        //$this->container->has('config') ?: $this->container->add([get_class($this->config), 'config'], $this->config);
        //$this->container->add([self::class, 'app'], $this);
    }

    /**
     *
     */
    private function configureEnvironment()
    {

    }

    /**
     *  Register the Artisan seed and migration commands.
     */
    private function registerArtisanCommands()
    {
        $this->add(app('command.migrate'));
        $this->add(app('command.migrate.install'));
        $this->add(app('command.migrate.make'));
        $this->add(app('command.migrate.refresh'));
        $this->add(app('command.migrate.reset'));
        $this->add(app('command.migrate.rollback'));
        $this->add(app('command.migrate.status'));
        $this->add(app('command.seed'));
    }

    /**
     * Registers any commands found the the provided path.
     *
     * Note: All classes found in the folder are loaded, so don't put anything
     *       but commands there.
     *
     * @param string $commandPath
     *
     * @return array
     */
    private function registerCommandsIn(string $commandPath) : array
    {
        $commands = [];

        foreach ((new ClassFinder)->findClasses($commandPath) as $command) {
            $commands[] = Lib::get_class_name($command);
            $this->add(new $command);
        }

        return $commands;
    }

    /**
     *  Registers the framework commands found in the framework Console\Commands path.
     */
    private function registerFrameworkCommands()
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . 'Commands/';
        $this->frameworkCommands = $this->registerCommandsIn($path);
    }

}
