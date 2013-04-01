<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * This is a links manager for PyroCMS
 *
 * @author Antoine Benevaut <antoine@cavaencoreparlerdebits.fr>
 * @website www.cavaencoreparlerdebits.fr
 */
class Module_links extends Module
{
    public $version		= '1.0';

    public function info()
    {
        return array(
			'name'		=> array(
                'en'	=> 'Links',
                'fr'	=> 'Liens'
            ),
            'description'	=> array(
                'en'		=> 'Links manager.',
                'fr'		=> 'Manager de liens.'
            ),
            'frontend'	=> false,
            'backend'	=> true,
            'menu'		=> 'content',
            'sections'	=> array(
				'links' => array(
					'name'	=> 'links.title',
					'uri'	=> 'admin/links',
					'shortcuts' => array(
						'links.shotcuts.create' => array(
							'name'	=> 'links.shotcuts.create',
							'uri'	=> 'admin/links/create',
							'class' => ''
						)
					)
				),
			)
        );
    }

    public function install()
    {
    	/**
    	 *
    	 *
    	 */
        $this->load->driver('Streams');
	
        $fields = array(
        	/**
			 *
			 *
			 *
			 */
			array(
				/**
				 *
				 *
				 *
				 */
				'namespace'			=> 'links',

				/**
				 *
				 *
				 *
				 */
				'assign'			=> 'links',

				/**
				 *
				 *
				 *
				 */
				'name'				=> 'lang:links.fields.name',

				/**
				 *
				 *
				 *
				 */
				'slug'				=> 'name',

				/**
				 *
				 *
				 *
				 */
				'type'				=> 'text',

				/**
				 *
				 *
				 *
				 */
				'extra'				=> array(
					'max_length'		=> '70',
					'default_value'		=> 'Link title'
				),

				/**
				 *
				 *
				 *
				 */
				'title_column'		=> true,

				/**
				 *
				 *
				 *
				 */
				'required'			=> true,

				/**
				 *
				 *
				 *
				 */
				'unique'			=> false
			),
			array(
				'namespace'			=> 'links',
				'assign'			=> 'links',
				'name'				=> 'lang:links.fields.slug',
				'slug'				=> 'slug',
				'type'				=> 'slug',
				'extra'				=> array(
					'space_type'		=> '-',
					'slug_field'		=> 'name'
				),
				'title_column'		=> false,
				'required'			=> true,
				'unique'			=> false
			),
			array(
				'namespace'			=> 'links',
				'assign'			=> 'links',
				'name'				=> 'lang:links.fields.link',
				'slug'				=> 'link',
				'type'				=> 'url',
				'extra'				=> array(
				),
				'title_column'		=> false,
				'required'			=> true,
				'unique'			=> false
			),
        );

		$update_data = array(
			/**
			 *
			 *
			 *
			 */
			'view_options'	=> array(
				'name',
				'slug'
			)
		);

		/**
		 *
		 *
		 *
		 */
		$this->streams->streams->add_stream('lang:links.title', 'links', 'links', 'links_', NULL);

		/**
		 *
		 *
		 *
		 */
		$this->streams->fields->add_fields($fields);

		/**
		 *
		 *
		 *
		 */
		$this->streams->streams->update_stream('links', 'links', $update_data);

		return TRUE;
    }

    public function uninstall()
    {
        $this->load->driver('Streams');
		
		/**
		 *
		 *
		 *
		 */
		$this->streams->utilities->remove_namespace('links');

		return TRUE;
    }

    public function upgrade($old_version) { return TRUE; }
    public function help() { return TRUE; }
}
/* End of file details.php */
/* Location: ./links/details.php */