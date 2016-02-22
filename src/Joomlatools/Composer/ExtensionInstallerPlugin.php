<?php
/**
 * Joomlatools Composer plugin - https://github.com/joomlatools/joomlatools-composer
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/joomlatools/joomlatools-composer for the canonical source repository
 */

namespace Joomlatools\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;

/**
 * Composer installer plugin
 *
 * @author  Steven Rombauts <https://github.com/stevenrombauts>
 * @package Joomlatools\Composer
 */
class ExtensionInstallerPlugin implements PluginInterface, EventSubscriberInterface
{
    private static $__instance   = null;
    private static $__extensions = array();

    public static function getInstance()
    {
        if (!self::$__instance) {
            self::$__instance = new ExtensionInstallerPlugin();
        }

        return self::$__instance;
    }

    /**
     * Apply plugin modifications to composer
     *
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        self::$__instance = $this;

        $installer = new ExtensionInstaller($io, $composer);

        $composer->getInstallationManager()->addInstaller($installer);
    }

    public function installExtensions(Event $event)
    {
        foreach (self::$__extensions as $extension)
        {

        }
    }

    public function addExtension($package)
    {
        self::$__extensions[] = $package;
    }

    public static function getSubscribedEvents()
    {
        return array(
            ScriptEvents::POST_AUTOLOAD_DUMP => 'installExtensions',
        );
    }
}