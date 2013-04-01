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
    	 * Load the driver Streams
    	 */
        $this->load->driver('Streams');
	
        $fields = array(
        	/**
			 * Then we configure each field
			 */
			array(
				/**
				 * It indicates the namespace to which the field is bound
				 */
				'namespace'			=> 'links',

				/**
				 * It also indicates the stream to which the field belongs to
				 */
				'assign'			=> 'links',

				/**
				 * It gives a name to our field,
				 * we can put a name or is a tag for the translation
				 */
				'name'				=> 'lang:links.fields.name',

				/**
				 * We provide our field slug ...
				 */
				'slug'				=> 'name',

				/**
				 * ... the type of our field.
				 * There is the list of fields to this url : http://docs.pyrocms.com/2.2/manual/developers/tools/streams-api/core-field-types
				 */
				'type'				=> 'text',

				/**
				 * Each field can be personalized via the variable 'extra'
				 */
				'extra'				=> array(
					// For a text field,
					// we can customize the maximum length of the string ...
					'max_length'		=> '70',

					// ... Or the default text.
					'default_value'		=> 'Link title'
				),

				/**
				 * For each stream must specify one of these variables as title_column (column heading).
				 * When you utilize a stream next to a field 'relationship',
				 * and will be linked to our current stream (recall stream: links and namspace: links),
				 * it will be the column 'name' which will act as the list selection.
				 */
				'title_column'		=> true,

				/**
				 * Is what our name is required when adding a link? Here, yes.
				 */
				'required'			=> true,

				/**
				 * Is what our name field is unique? Here, yes (a link will be equal to a title).
				 */
				'unique'			=> true
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
				'unique'			=> true
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

		/**
		 * Now we add our Stream.
		 */
		$this->streams->streams->add_stream('lang:links.title', 'links', 'links', 'links_', NULL);

		/**
		 * And now we add the fields to our stream.
		 */
		$this->streams->fields->add_fields($fields);


		/**
		 * We create a new variable to changes in our stream and thus change its behavior.
		 */
		$update_data = array(
			/**
			 * The option View_Options' identifies the fields that we want
			 * to appear in the listing of the administration panel.
			 * Here we see the name of our relationship and its slug.
			 */
			'view_options'	=> array(
				'name',
				'slug'
			)
		);

		/**
		 * Finally, we update our stream with our new settings
		 */
		$this->streams->streams->update_stream('links', 'links', $update_data);

		return TRUE;
    }

    public function uninstall()
    {
        $this->load->driver('Streams');
		
		/**
		 * To remove our module, we simply delete the namespace.
		 */
		$this->streams->utilities->remove_namespace('links');

		return TRUE;
    }

    public function upgrade($old_version) { return TRUE; }
    public function help() { return TRUE; }
}
/* End of file details.php */
/* Location: ./links/details.php */