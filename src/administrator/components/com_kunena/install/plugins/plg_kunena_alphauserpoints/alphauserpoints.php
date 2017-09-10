<?php
/**
 * Kunena Plugin
 *
 * @package         Kunena.Plugins
 * @subpackage      AlphaUserPoints
 *
 * @copyright       Copyright (C) 2008 - 2016 Kunena Team. All rights reserved.
 * @license         http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/
defined('_JEXEC') or die();

/**
 * KunenaActivityAlphaUserPoints class to handle integration with AlphaUserPoints
 *
 * @since       2.0
 *
 * @deprecated  6.0
 * @since       Kunena
 */
class plgKunenaAlphaUserPoints extends \Joomla\CMS\Plugin\CMSPlugin
{

	/**
	 * plgKunenaAlphaUserPoints constructor.
	 *
	 * @param $subject
	 * @param $config
	 *
	 * @deprecated  6.0
	 * @since       Kunena
	 */
	public function __construct(&$subject, $config)
	{
		// Do not load if Kunena version is not supported or Kunena is offline
		if (!(class_exists('KunenaForum') && KunenaForum::isCompatible('4.0') && KunenaForum::installed()))
		{
			return;
		}

		$aup = JPATH_SITE . '/components/com_alphauserpoints/helper.php';

		if (!file_exists($aup))
		{
			return;
		}

		require_once $aup;

		parent::__construct($subject, $config);

		$this->loadLanguage('plg_kunena_alphauserpoints.sys', JPATH_ADMINISTRATOR) || $this->loadLanguage('plg_kunena_alphauserpoints.sys', KPATH_ADMIN);
	}

	/**
	 * Get Kunena avatar integration object.
	 *
	 * @return KunenaAvatar
	 *
	 * @deprecated  6.0
	 * @since       Kunena
	 */
	public function onKunenaGetAvatar()
	{
		if (!$this->params->get('avatar', 1))
		{
			return null;
		}

		require_once __DIR__ . "/avatar.php";

		return new KunenaAvatarAlphaUserPoints($this->params);
	}

	/**
	 * Get Kunena profile integration object.
	 *
	 * @return KunenaProfile
	 *
	 * @deprecated  6.0
	 * @since       Kunena
	 */
	public function onKunenaGetProfile()
	{
		if (!$this->params->get('profile', 1))
		{
			return null;
		}

		require_once __DIR__ . "/profile.php";

		return new KunenaProfileAlphaUserPoints($this->params);
	}

	/**
	 * Get Kunena activity stream integration object.
	 *
	 * @return KunenaActivity
	 *
	 * @deprecated  6.0
	 * @since       Kunena
	 */
	public function onKunenaGetActivity()
	{
		if (!$this->params->get('activity', 1))
		{
			return null;
		}

		require_once __DIR__ . "/activity.php";

		return new KunenaActivityAlphaUserPoints($this->params);
	}
}