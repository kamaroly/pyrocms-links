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
    	 * On charge le driver Streams
    	 */
        $this->load->driver('Streams');
	
        $fields = array(
        	/**
			 * Nous paramétrons ensuite chaque champs
			 */
			array(
				/**
				 * On indique le namespace auquel le champ est lie
				 */
				'namespace'			=> 'links',

				/**
				 * On indique également le stream auquel le champ appartient
				 */
				'assign'			=> 'links',

				/**
				 * On donne un nom à notre champ,
				 * on peut y mettre soit un nom soit un tag pour la traduction
				 */
				'name'				=> 'lang:links.fields.name',

				/**
				 * On fournit le slug de notre champ ...
				 */
				'slug'				=> 'name',

				/**
				 * ... et le type de notre champ,
				 * On troue la liste des champs à cette url : http://docs.pyrocms.com/2.2/manual/developers/tools/streams-api/core-field-types
				 */
				'type'				=> 'text',

				/**
				 * Chaque champ peut être personnalise via la variable 'extra'
				 */
				'extra'				=> array(
					// Pour un champ text, nous pouvons personnalise
					// la longueur maximale de la chaine ...
					'max_length'		=> '70',

					// ... Ou encore le texte par defaut.
					'default_value'		=> 'Link title'
				),

				/**
				 * Pour chaque stream, il faut spécifie une de ces variables comme title_column (titre de colonne).
				 * Lorsque vous utiliserait un prochain stream avec un champ 'relationship', et qu'il sera lié
				 * à notre stream courant (rappel, stream : links et namspace : links), se sera la colonne 'name'
				 * qui fera office de titre dans la liste de sélection.
				 */
				'title_column'		=> true,

				/**
				 * Est ce que notre nom est requis lors de l'ajout d'un lien? Ici, oui.
				 */
				'required'			=> true,

				/**
				 * Est ce que notre champ nom est unique? Ici, oui (un lien sera égale a un titre).
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
		 * Maintenant, nous ajoutons notre Stream.
		 */
		$this->streams->streams->add_stream('lang:links.title', 'links', 'links', 'links_', NULL);

		/**
		 * Et maintenant, on ajoute les champs a notre stream.
		 */
		$this->streams->fields->add_fields($fields);


		/**
		 * Nous créons une nouvelle variable pour faire des modifications dans notre stream
		 * et ainsi changer son comportement.
		 */
		$update_data = array(
			/**
			 * L'option 'view_options', permet d'identifier les champs que nous voulons voir apparaitre
			 * dans le listing du panneau d'administration. Ici, nous verrons le nom de notre
			 * lien ainsi que son slug.
			 */
			'view_options'	=> array(
				'name',
				'slug'
			)
		);

		/**
		 * Enfin, nous mettons à jour notre stream avec nos nouveaux paramètres
		 */
		$this->streams->streams->update_stream('links', 'links', $update_data);

		return TRUE;
    }

    public function uninstall()
    {
        $this->load->driver('Streams');
		
		/**
		 * Pour supprimer notre module, nous supprimerons simplement son namespace.
		 */
		$this->streams->utilities->remove_namespace('links');

		return TRUE;
    }

    public function upgrade($old_version) { return TRUE; }
    public function help() { return TRUE; }
}
/* End of file details.php */
/* Location: ./links/details.php */