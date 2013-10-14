<?php namespace Mrjuliuss\SyntaraLogviewer;

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