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
	 * {{links:show type="youtube" slug="" width="" height=""}}
	 * 	{{link}}
	 * {{/links:show}}
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
	 */
	public function show()
	{
		$html = array();

		$type = $this->attribute('type', null);

		/**
		 * Les parametres de notre stream.
		 */
		$params = array(
			'stream'	=> 'links',
			'namespace'	=> 'links'
		);

		/**
		 * On ajout un parametre, where pour appliquer nos filtres de
		 * recherche.
		 *
		 * Il est tout a fait possible de cumuler les filtres de cette facon :
		 * 'slug="'.$slug.'" AND autre_filtre="valeur"'
		 */
		if (($slug = $this->attribute('slug', null)))
		{
			$params['where'] = 'slug="'.$slug.'"';
		}
		
		/**
		 * On fait la requette pour obtenir nos donnees.
		 */
		$entries = $this->streams->entries->get_entries($params);

		/**
		 * On parcours ensuite simplement nos entrees pour les mettre au format
		 * que nous voulons.
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