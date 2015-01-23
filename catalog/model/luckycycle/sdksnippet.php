<?php
class ModelLuckycycleSdksnippet extends Model {
	public function addSdksnippet($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "luckycycle_sdksnippet` SET hash = '" . $this->db->escape($data['hash']) . "',
		banner_url = '" . $data['banner_url'] . "', id_order = '" . $this->db->escape($data['id_order']) . "',
		operation_id = '" . $this->db->escape($data['operation_id']) . "', type = '" . $this->db->escape($data['type']) . "',
		id_customer = '" . $this->db->escape($data['id_customer']) . "', create_at = NOW(), total_played = " . $data['total_played']);
		$order_id = $this->db->getLastId();
		return $order_id;
	}

    public function countHash($hash) {
        $sql = "SELECT * FROM " . DB_PREFIX . "luckycycle_sdksnippet WHERE hash = '" . $hash . "'";
        $query = $this->db->query($sql);
        return $query->num_rows;
    }
}
?>