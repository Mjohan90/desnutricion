<?php

	class resultado {

		var $result_id;
		var $atenc_id;
		var $diag_id;
		var $fecha_reg;

		public function getResultID() {
			return $this->result_id;
		}
		public function getAtencID() {
			return $this->atenc_id;
		}
		public function getDiagID() {
			return $this->diag_id;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}

		public function setResultID($result_id) {
			$this->result_id = $result_id;
		}
		public function setAtencID($result_atenc_id) {
			$this->atenc_id = $result_atenc_id;
		}
		public function setDiagID($result_diag_id) {
			$this->diag_id = $result_diag_id;
		}
		public function setFechaReg($result_fecha_reg) {
			$this->fecha_reg = $result_fecha_reg;
		}
	}
