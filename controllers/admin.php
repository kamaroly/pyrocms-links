<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is a links manager for PyroCMS
 *
 * @author Antoine Benevaut <antoine@cavaencoreparlerdebits.fr>
 * @website www.cavaencoreparlerdebits.fr
 */
class Admin extends Admin_Controller
{
	protected	$section	= 'links';
	
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('links');

        $this->load->driver('Streams');
    }

    /**
     * Le listing des éléments.
     * Note: la variable $pagination_offset n'est pas utilise,
     * mais permet de mettre en oeuvre la pagination automatise par Streams CP.
     */
    public function index($pagination_offset = 0)
    {
        /**
         * Dans l'administration, et cela grâce au Stream CP, il suffit maintenant de configurer
         * ce que nous voulons voir apparaitre, et cela sans effort!
         */
		$extra = array(

            // On renseigne le titre de la page courante
            'title'				=> lang('links.title'),

            /**
             * Pour chaque ligne de notre listing, nous allons vouloir effectuer des actions
             * comme l'édition ou la suppression de lien.
             */
            'buttons'			=> array(
                /**
                 * Un bouton est constitue d'un label (un titre)
                 * et d'une URL (le chemin de la page a exécuter).
                 * On note que l'URL est une URI (une URL sans le domaine, autrement dit la fin de l'URL)
                 * et que l'on utilise '-entry_id-' pour spécifier l'id du lien de la ligne courante.
                 */
                array(
                    'label'     => lang('global:edit'),
                    'url'       => 'admin/links/edit/-entry_id-'
                ),
                array(
                    'label'     => lang('global:delete'),
                    'url'       => 'admin/links/delete/-entry_id-',
                    'confirm'   => true
                )
			)
		);

        /**
         * Pour l'affichage, rien de plus simple! Le Stream CP surcharge les vues. Il n'y a plus besoin
         * de faire du HTML, Stream CP s'occupe de tout!
         */
        $this->streams->cp->entries_table('links', 'links', 10, 'admin/links/index', TRUE, $extra);
    }

    /**
     * La création d'un élément
     */
    public function create()
    {
        /**
         * Comme pour le listing à l'accueil, il suffit de renseigner quelques paramètres.
         */
        $extra = array(
            // On retrouve le titre de la page
			'title'				=> lang('links.create.title'),

            /**
             * Et puisque cette fois il s'agit d'une insertion, nous spécifions:
             * - Le message de succès.
             * - Le message d'erreur.
             * - Et le lien de redirection une fois l'insertion finit.
             */
			'success_message'	=> lang('links.create.messages.success'),
			'failure_message'	=> lang('links.create.messages.failure'),
			'return'			=> 'admin/links'
		);
		
        /**
         * La encore, nous utiliserons le Stream CP qui s'occupera de tout en fonction de son paramétrage.
         */
		$this->streams->cp->entry_form('links', 'links', 'new', NULL, TRUE, $extra);
    }

    /**
     * L’édition d'un élément
     */
    public function edit($id = 0)
    {
        /**
         * De la même façon que l'insertion de nouveaux liens, l’édition paramètre le Stream CP.
         */
        $extra = array(
            'title'				=> lang('links.edit.title'),
			'success_message'	=> lang('links.edit.messages.success'),
			'failure_message'	=> lang('links.edit.messages.failure'),
			'return'			=> 'admin/links'
		);

        $this->streams->cp->entry_form('links', 'links', 'edit', $id, TRUE, $extra, array());
    }

    /**
     * La suppression d'un élément
     */
    public function delete($id = 0)
    {
        /**
         * Ici, rien de plus simple. Nous supprimons l'élément de notre stream
         * avec le Stream entries, grâce à son id.
         */
        if ($this->streams->entries->delete_entry($id, 'links', 'links'))
        {
            $this->session->set_flashdata('success', lang('links.delete.messages.success'));
        }
        else
        {
            $this->session->set_flashdata('error', lang('links.delete.messages.failure'));
        }
        redirect('admin/links');
    }
}
/* End of file admin.php */
/* Location: ./links/controllers/admin.php */