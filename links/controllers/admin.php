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
     * Le listing des elements
     */
    public function index($pagination_offset = 0)
    {
		$extra = array(
            'title'				=> lang('links.title'),
            'buttons'			=> array(
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

        $this->streams->cp->entries_table('links', 'links', 10, 'admin/links/index', TRUE, $extra);
    }

    /**
     * La creation d'un element
     */
    public function create()
    {
        $extra = array(
			'title'				=> lang('links.create.title'),
			'success_message'	=> lang('links.create.messages.success'),
			'failure_message'	=> lang('links.create.messages.failure'),
			'return'			=> 'admin/links'
		);
		
		$this->streams->cp->entry_form('links', 'links', 'new', NULL, TRUE, $extra);
    }

    /**
     * L'edition d'un element
     */
    public function edit($id = 0)
    {
        $extra = array(
            'title'				=> lang('links.edit.title'),
			'success_message'	=> lang('links.edit.messages.success'),
			'failure_message'	=> lang('links.edit.messages.failure'),
			'return'			=> 'admin/links'
		);

        $this->streams->cp->entry_form('links', 'links', 'edit', $id, TRUE, $extra, array());
    }

    /**
     * La suppression d'un element
     */
    public function delete($id = 0)
    {
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