<?php

	class empleado {

		var $empl_id;
		var $pers_id;
		var $carg_id;
		var $fecha_reg;
		var $estado;

		public function getEmplID() {
			return $this->empl_id;
		}
		public function getPersID() {
			return $this->pers_id;
		}
		public function getCargID() {
			return $this->carg_id;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setEmplID($empl_id) {
			$this->empl_id = $empl_id;
		}
		public function setPersID($empl_pers_id) {
			$this->pers_id = $empl_pers_id;
		}
		public function setCargID($empl_carg_id) {
			$this->carg_id = $empl_carg_id;
		}
		public function setFechaReg($empl_fecha_reg) {
			$this->fecha_reg = $empl_fecha_reg;
		}
		public function setEstado($empl_estado) {
			$this->estado = $empl_estado;
		}
	}
