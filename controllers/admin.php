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
     * The listing of items.
     * Note: The variable $ pagination_offset is not used,
     * but can implement automated pagination Streams by CP.
     */
    public function index($pagination_offset = 0)
    {
        /**
         * In the administration, thanks to Stream PC,
         * now just configure what we want to see appear, without effort!
         */
		$extra = array(

            // It informs the title of the current page
            'title'				=> lang('links.title'),

            /**
             * For each row in our list, we want to perform actions
             * such as editing or deleting a link.
             */
            'buttons'			=> array(
                /**
                 * A button is a label (a title)
                 * and a URL (the page path to execute).
                 * Note that the URL is a URI (a URL without the domain, ie the end of the URL)
                 * and it uses '-entry_id-' to specify the id of the link of the current line.
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
         * For display, nothing could be easier! Stream PC overhead views.
         * There is no need to HTML, Stream CP takes care of everything!
         */
        $this->streams->cp->entries_table('links', 'links', 10, 'admin/links/index', TRUE, $extra);
    }

    /**
     * The creation of a link
     */
    public function create()
    {
        /**
         * As for listing the home, simply enter a few parameters.
         */
        $extra = array(
            // We find again the title of the page
			'title'				=> lang('links.create.title'),

            /**
             * And since this time it is an insertion, we specify:
             * - The success message.
             * - The error message.
             * - And the redirect link after the insertion ends.
             */
			'success_message'	=> lang('links.create.messages.success'),
			'failure_message'	=> lang('links.create.messages.failure'),
			'return'			=> 'admin/links'
		);
		
        /**
         * Again, we will use the Stream CP takes care of everything in terms of its setting.
         */
		$this->streams->cp->entry_form('links', 'links', 'new', NULL, TRUE, $extra);
    }

    /**
     * Editing an element
     */
    public function edit($id = 0)
    {
        /**
         * The same way that the insertion of new links, edit the Stream parameter CP.
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
     * Deleting an element
     */
    public function delete($id = 0)
    {
        /**
         * Here, nothing is simple. We remove the element of our
         * stream with Stream entries through its id.
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