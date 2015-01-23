<?php
class ModelLuckycycleApiMode extends Model {
	
	public function getModeData() {
        $modeData = array();
        $modeData[] = array(
            'name'      => $this->language->get('use_iframe'),
            'alias' 	=> 0
        );
        $modeData[] = array(
            'name'      => $this->language->get('use_banner'),
            'alias' 	=> 1
        );
		return $modeData;
	}
}
?>