<?php namespace MrJuliuss\SyntaraLogviewer;

use Illuminate\Support\ServiceProvider;
use Config;

class SyntaraLogviewerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		$this->package('mrjuliuss/syntara-logviewer');

		// include start file
		include ( __DIR__ . '/../../start.php');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// load package config
		$this->app['config']->package('kmd/logviewer', 'kmd/logviewer/config');

		$this->app['config']->set('logviewer::base_url', Config::get('syntara::config.uri').'/logviewer');
		$this->app['config']->set('logviewer::filters.global', array('before' => 'basicAuth|hasPermissions:superuser'));
		$this->app['config']->set('logviewer::view', 'syntara-logviewer::viewer');
		$this->app['config']->set('logviewer::log_order', 'desc');

		// add the install command to the application
		$this->app['logviewer:install'] = $this->app->share(function($app)
		{
			return new Commands\InstallCommand($app);
		});

		// add the update command to the application
		$this->app['logviewer:update'] = $this->app->share(function($app)
		{
			return new Commands\UpdateCommand($app);
		});

		// add commands
		$this->commands('logviewer:install');
		$this->commands('logviewer:update');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}
}
