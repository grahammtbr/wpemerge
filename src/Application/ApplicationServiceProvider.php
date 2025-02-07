<?php
/**
 * @package   WPEmerge
 * @author    Atanas Angelov <atanas.angelov.dev@gmail.com>
 * @copyright 2018 Atanas Angelov
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://wpemerge.com/
 */

namespace WPEmerge\Application;

use WPEmerge\Helpers\MixedType;
use WPEmerge\ServiceProviders\ExtendsConfigTrait;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

/**
 * Provide application dependencies.
 *
 * @codeCoverageIgnore
 */
class ApplicationServiceProvider implements ServiceProviderInterface {
	use ExtendsConfigTrait;

	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
		$this->extendConfig( $container, 'providers', [] );

		$upload_dir = wp_upload_dir();
		$cache_dir = MixedType::addTrailingSlash( $upload_dir['basedir'] ) . 'wpemerge' . DIRECTORY_SEPARATOR . 'cache';
		$this->extendConfig( $container, 'cache', $cache_dir );
	}

	/**
	 * {@inheritDoc}
	 */
	public function bootstrap( $container ) {
		$cache_dir = $container[ WPEMERGE_CONFIG_KEY ]['cache'];
		wp_mkdir_p( $cache_dir );
	}
}
