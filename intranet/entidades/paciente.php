<?php

	class paciente {

		var $pac_id;
		var $pers_id;
		var $fecha_reg;
		var $estado;

		public function getPacID() {
			return $this->pac_id;
		}
		public function getPersID() {
			return $this->pers_id;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setPacID($pac_id) {
			$this->pac_id = $pac_id;
		}
		public function setPersID($pac_pers_id) {
			$this->pers_id = $pac_pers_id;
		}
		public function setFechaReg($pac_fecha_reg) {
			$this->fecha_reg = $pac_fecha_reg;
		}
		public function setEstado($pac_estado) {
			$this->estado = $pac_estado;
		}
	}
