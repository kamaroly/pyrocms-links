<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is a links manager for PyroCMS
 *
 * @author Antoine Benevaut <antoine@cavaencoreparlerdebits.fr>
 * @website www.cavaencoreparlerdebits.fr
 */
class Plugin_links extends Plugin
{    
	/**
	 *
	 * Plugin optional arguments:
	 * - type : youtube, display video related by link
	 * - slug : the link slug
	 * - width : the video width
	 * - height : the video height
	 *
	 * {{links:show type="youtube" slug="" width="" height=""}}
	 * 	{{link}}
	 *
	 * Optional link attribute, if no type is attributed
	 *
	 * 	{{id}}
	 * 	{{created}}
	 * 	{{updated}}
	 * 	{{created_by.user_id}}
	 * 	{{created_by.display_name}}
	 * 	{{created_by.email}}
	 * 	{{created_by.username}}
	 * 	{{ordering_count}}
	 * 	{{name}}
	 * 	{{slug}}
	 *
	 * {{/links:show}}
	 */
	public function show()
	{
		$html = array();

		$type = $this->attribute('type', null);

		/**
		 * Les paramètres de notre stream.
		 */
		$params = array(
			'stream'	=> 'links',
			'namespace'	=> 'links'
		);

		/**
		 * On ajout un paramètre, where pour appliquer nos filtres de
		 * recherche.
		 *
		 * Il est tout a fait possible de cumuler les filtres de cette façon :
		 * 'slug="'.$slug.'" AND autre_filtre="valeur"'
		 */
		if (($slug = $this->attribute('slug', null)))
		{
			$params['where'] = 'slug="'.$slug.'"';
		}
		
		/**
		 * On fait la requête pour obtenir nos données.
		 */
		$entries = $this->streams->entries->get_entries($params);

		/**
		 * On parcourt ensuite simplement nos entrées pour les mettre
		 * au format que nous voulons.
		 */
		foreach ($entries['entries'] as $link)
		{
			switch ($type)
			{
				case 'youtube':
				{
					$html[] = array('link' => '<iframe width="'.$this->attribute('width', 420).'"
						height="'.$this->attribute('height', 315).'"
						src="'.$link['link'].'"
						frameborder="0" allowfullscreen></iframe>');
					break;
				}
				default:
				{
					$html = array('link' => $link);
				}
			}
		}
		return $html;
	}
}
/* End of file plugin.php */
/* Location: ./link/plugin.php */