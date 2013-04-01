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
		 * The parameters of our stream.
		 */
		$params = array(
			'stream'	=> 'links',
			'namespace'	=> 'links'
		);

		/**
		 * We added a parameter, Where to apply our search filters.
		 *
		 * It is quite possible to combine the filters in this way :
		 * 'slug="'.$slug.'" AND autre_filtre="valeur"'
		 */
		if (($slug = $this->attribute('slug', null)))
		{
			$params['where'] = 'slug="'.$slug.'"';
		}
		
		/**
		 * It is the query to get our data.
		 */
		$entries = $this->streams->entries->get_entries($params);

		/**
		 * It then goes through just to put our input in the format we want.
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