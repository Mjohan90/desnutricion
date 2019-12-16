<?php

	class parentesco {

		var $parent_id;
		var $pers1_id;
		var $pers2_id;
		var $tparent_id;
		var $es_apoderado;
		var $estado;

		public function getParentID() {
			return $this->parent_id;
		}
		public function getPers1ID() {
			return $this->pers1_id;
		}
		public function getPers2ID() {
			return $this->pers2_id;
		}
		public function getTparentID() {
			return $this->tparent_id;
		}
		public function getEsApoderado() {
			return $this->es_apoderado;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setParentID($parent_id) {
			$this->parent_id = $parent_id;
		}
		public function setPers1ID($parent_pers1_id) {
			$this->pers1_id = $parent_pers1_id;
		}
		public function setPers2ID($parent_pers2_id) {
			$this->pers2_id = $parent_pers2_id;
		}
		public function setTparentID($parent_tparent_id) {
			$this->tparent_id = $parent_tparent_id;
		}
		public function setEsApoderado($parent_es_apoderado) {
			$this->es_apoderado = $parent_es_apoderado;
		}
		public function setEstado($parent_estado) {
			$this->estado = $parent_estado;
		}
	}
