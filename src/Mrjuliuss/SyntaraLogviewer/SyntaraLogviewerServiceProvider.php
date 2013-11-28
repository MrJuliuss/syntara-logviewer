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
		//Load package config
		$this->app['config']->package('kmd/logviewer', 'kmd/logviewer/config');

		$this->app['config']->set('logviewer::base_url', 'dashboard/logviewer');
		$this->app['config']->set('logviewer::filters.global', array('before' => 'basicAuth|hasPermissions:superuser'));
		$this->app['config']->set('logviewer::view', 'syntara-logviewer::viewer');
		$this->app['config']->set('logviewer::view_p', 'pagination::slider-3');
		$this->app['config']->set('logviewer::log_order', 'desc');

		 // add the install command to the application
		$this->app['logviewer:install'] = $this->app->share(function($app)
		{
			return new Commands\InstallCommand($app);
		});

		$this->commands('logviewer:install');
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