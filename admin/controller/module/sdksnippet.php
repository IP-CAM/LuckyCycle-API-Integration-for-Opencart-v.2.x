<?php
class ControllerModuleSdksnippet extends Controller {
	private $error = array(); // This is used to set the errors, if any.

    public function install() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "luckycycle_sdksnippet` (
		  `id_poke` int(11) NOT NULL auto_increment,
          `hash` varchar(255) COLLATE utf8_bin,
          `banner_url` varchar(255) COLLATE utf8_bin,
          `type` varchar(255) COLLATE utf8_bin,
          `id_customer` varchar(255) COLLATE utf8_bin,
          `id_order` varchar(255) COLLATE utf8_bin,
          `create_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
          `operation_id` varchar(255) COLLATE utf8_bin,
          `total_played` float,
          PRIMARY KEY  (`id_poke`)
		)ENGINE=MyISAM DEFAULT CHARSET=utf8");
    }
 
	public function index() {   // Default function 
		$this->load->language('module/sdksnippet'); // Loading the language file of sdksnippet
	 
		$this->document->setTitle($this->language->get('heading_title')); // Set the title of the page to the heading title in the Language file i.e., Hello World
	 
		$this->load->model('setting/setting'); // Load the Setting Model  (All of the OpenCart Module & General Settings are saved using this Model )

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) { // Start If: Validates and check if data is coming by save (POST) method
			if (isset($this->request->post['sdksnippet_sdkextension'])) {
				$this->request->post['sdksnippet_sdkextension'] = serialize($this->request->post['sdksnippet_sdkextension']);
			} else {
				$this->request->post['sdksnippet_sdkextension'] = '';
			}
			$this->model_setting_setting->editSetting('sdksnippet', $this->request->post);      // Parse all the coming data to Setting Model to save it in database.
	 
			$this->session->data['success'] = $this->language->get('text_success'); // To display the success text on data save

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		} // End If
	 
		/*Assign the language data for parsing it to view*/
		$data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
	 
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_content_top'] = $this->language->get('text_content_top');
		$data['text_content_bottom'] = $this->language->get('text_content_bottom');      
		$data['text_column_left'] = $this->language->get('text_column_left');
		$data['text_column_right'] = $this->language->get('text_column_right');
	 
		$data['api_id'] = $this->language->get('api_id');
		$data['operation_id'] = $this->language->get('operation_id');
        $data['use_mode'] = $this->language->get('use_mode');
		$data['iframe_width'] = $this->language->get('iframe_width');
		$data['iframe_height'] = $this->language->get('iframe_height');
        $data['upload_banner'] = $this->language->get('upload_banner');
        $data['text_image_manager'] = $this->language->get('text_image_manager');
        $data['text_browse'] = $this->language->get('text_browse');
        $data['text_clear'] = $this->language->get('text_clear');
        $data['other_information_label'] = $this->language->get('other_information_label');
        $data['after_information_label'] = $this->language->get('after_information_label');
        $data['entry_payment_method'] = $this->language->get('entry_payment_method');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
	 
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_module'] = $this->language->get('button_add_module');
		$data['button_remove'] = $this->language->get('button_remove');
        $data['token'] = $this->session->data['token'];
	 
		/*This Block returns the warning if any*/
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		/*End Block*/
	 
		/*This Block returns the error code if any*/
		if (isset($this->error['code'])) {
			$data['error_api_id'] = $this->error['code'];
		} else {
			$data['error_api_id'] = '';
		}
        if (isset($this->error['code_operation_id'])) {
            $data['error_operation_id'] = $this->error['code_operation_id'];
        } else {
            $data['error_operation_id'] = '';
        }
		/*End Block*/
	 
	 
		/* Making of Breadcrumbs to be displayed on site*/
		$data['breadcrumbs'] = array();
	 
		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);
	 
		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
	 
		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/sdksnippet', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
	 
		/* End Breadcrumb Block*/

		$data['action'] = $this->url->link('module/sdksnippet', 'token=' . $this->session->data['token'], 'SSL'); // URL to be directed when the save button is pressed
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'); // URL to be redirected when cancel button is pressed
		 
		/* This block checks, if the hello world text field is set it parses it to view otherwise get the default hello world text field from the database and parse it*/
	 
		if (isset($this->request->post['sdksnippet_text_field'])) {
			$data['sdksnippet_text_field'] = $this->request->post['sdksnippet_text_field'];
		} else {
			$data['sdksnippet_text_field'] = $this->config->get('sdksnippet_text_field');
		}

        if (isset($this->request->post['sdksnippet_operation_id'])) {
            $data['sdksnippet_operation_id'] = $this->request->post['sdksnippet_operation_id'];
        } else {
            $data['sdksnippet_operation_id'] = $this->config->get('sdksnippet_operation_id');
        }

        if (isset($this->request->post['sdksnippet_use_mode'])) {
            $data['sdksnippet_use_mode'] = $this->request->post['sdksnippet_use_mode'];
        } else {
            $data['sdksnippet_use_mode'] = $this->config->get('sdksnippet_use_mode');
        }

        $this->load->model('luckycycle/api_mode');

        $data['use_mode_datas'] = $this->model_luckycycle_api_mode->getModeData();


        if (isset($this->request->post['sdksnippet_sdkextension'])) {
			$data['sdksnippet_sdkextension'] = $this->request->post['sdksnippet_sdkextension'];
		} else {
			$data['sdksnippet_sdkextension'] = unserialize($this->config->get('sdksnippet_sdkextension'));
		}

        if (isset($this->request->post['sdksnippet_iframe_width'])) {
            $data['sdksnippet_iframe_width'] = $this->request->post['sdksnippet_iframe_width'];
        } else {
            $data['sdksnippet_iframe_width'] = $this->config->get('sdksnippet_iframe_width');
        }

        if (isset($this->request->post['sdksnippet_iframe_height'])) {
            $data['sdksnippet_iframe_height'] = $this->request->post['sdksnippet_iframe_height'];
        } else {
            $data['sdksnippet_iframe_height'] = $this->config->get('sdksnippet_iframe_height');
        }

        $this->load->model('tool/image');
        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        if (isset($this->request->post['sdksnippet_luckycycle_banner'])) {
            $data['sdksnippet_luckycycle_banner'] = $this->request->post['sdksnippet_luckycycle_banner'];
        } else {
            $data['sdksnippet_luckycycle_banner'] = $this->config->get('sdksnippet_luckycycle_banner');
        }

        if (isset($this->request->post['sdksnippet_luckycycle_banner']) && is_file(DIR_IMAGE . $this->request->post['sdksnippet_luckycycle_banner'])) {
            $data['banner'] = $this->model_tool_image->resize($this->request->post['sdksnippet_luckycycle_banner'], 100, 100);
        } elseif ($this->config->get('sdksnippet_luckycycle_banner') && is_file(DIR_IMAGE . $this->config->get('sdksnippet_luckycycle_banner'))) {
            $data['banner'] = $this->model_tool_image->resize($this->config->get('sdksnippet_luckycycle_banner'), 100, 100);
        } else {
            $data['banner'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        if (isset($this->request->post['sdksnippet_other_information'])) {
            $data['sdksnippet_other_information'] = $this->request->post['sdksnippet_other_information'];
        } else {
            $data['sdksnippet_other_information'] = $this->config->get('sdksnippet_other_information');
        }
        if (isset($this->request->post['sdksnippet_after_information'])) {
            $data['sdksnippet_after_information'] = $this->request->post['sdksnippet_after_information'];
        } else {
            $data['sdksnippet_after_information'] = $this->config->get('sdksnippet_after_information');
        }
//        if (isset($this->request->post['sdksnippet_position_information'])) {
//            $data['sdksnippet_position_information'] = $this->request->post['sdksnippet_position_information'];
//        } else {
//            $data['sdksnippet_position_information'] = $this->config->get('sdksnippet_position_information');
//        }
//
//        $this->load->model('luckycycle/position_information');
//
//        $data['position_information_datas'] = $this->model_luckycycle_position_information->getPositionData();


        /* End Block*/
	 
		$data['modules'] = array();

		$data['extensions'] = array();
		$files = glob(DIR_APPLICATION . 'controller/payment/*.php');
		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');
				$status = $this->config->get($extension . '_status');
				//if (in_array($extension, $extensions_installed) && $status) {
				if ($status) {
					$this->load->language('payment/' . $extension);
					$data['extensions'][] = array(
						'name'      => $this->language->get('heading_title'),
						'alias' 	=> $extension
					);
				}
			}
		}

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/sdksnippet.tpl', $data));
	}
	
	/* Function that validates the data when Save Button is pressed */
    protected function validate() {
 
        /* Block to check the user permission to manipulate the module*/
        if (!$this->user->hasPermission('modify', 'module/sdksnippet')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        /* End Block*/
 
        /* Block to check if the sdksnippet_text_field is properly set to save into database, otherwise the error is returned*/
        if (!$this->request->post['sdksnippet_text_field']) {
            $this->error['code'] = $this->language->get('error_api_id');
        }
        if (!$this->request->post['sdksnippet_operation_id']) {
            $this->error['code_operation_id'] = $this->language->get('error_operation_id');
        }
        /* End Block*/
 
        /*Block returns true if no error is found, else false if any error detected*/
        if (!$this->error) {
            return true;
        } else {
            return false;
        }   
        /* End Block*/
    }
    /* End Validation Function*/
}
?>