<?php

	class diagnostico {

		var $diag_id;
		var $atenc_id;
		var $enferm_id;
		var $fecha_reg;

		public function getDiagID() {
			return $this->diag_id;
		}
		public function getAtencID() {
			return $this->atenc_id;
		}
		public function getEnfermID() {
			return $this->enferm_id;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}

		public function setDiagID($diag_id) {
			$this->diag_id = $diag_id;
		}
		public function setAtencID($diag_atenc_id) {
			$this->atenc_id = $diag_atenc_id;
		}
		public function setEnfermID($diag_enferm_id) {
			$this->enferm_id = $diag_enferm_id;
		}
		public function setFechaReg($diag_fecha_reg) {
			$this->fecha_reg = $diag_fecha_reg;
		}
	}
