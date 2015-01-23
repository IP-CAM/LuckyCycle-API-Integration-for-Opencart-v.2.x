<?php
class ModelLuckycyclePositionInformation extends Model {
	
	public function getPositionData() {
        $positionData = array();
        $positionData[] = array(
            'name'      => $this->language->get('before_iframe_banner'),
            'alias' 	=> 0
        );
        $positionData[] = array(
            'name'      => $this->language->get('after_iframe_banner'),
            'alias' 	=> 1
        );
		return $positionData;
	}
}
?>