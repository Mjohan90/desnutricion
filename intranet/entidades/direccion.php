<?php

	class direccion {

		var $direc_id;
		var $pers_id;
		var $ubig_id;
		var $descripcion;
		var $fecha_reg;
		var $estado;

		public function getDirecID() {
			return $this->direc_id;
		}
		public function getPersID() {
			return $this->pers_id;
		}
		public function getUbigID() {
			return $this->ubig_id;
		}
		public function getDescripcion() {
			return $this->descripcion;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setDirecID($direc_id) {
			$this->direc_id = $direc_id;
		}
		public function setPersID($direc_pers_id) {
			$this->pers_id = $direc_pers_id;
		}
		public function setUbigID($direc_ubig_id) {
			$this->ubig_id = $direc_ubig_id;
		}
		public function setDescripcion($direc_descripcion) {
			$this->descripcion = $direc_descripcion;
		}
		public function setFechaReg($direc_fecha_reg) {
			$this->fecha_reg = $direc_fecha_reg;
		}
		public function setEstado($direc_estado) {
			$this->estado = $direc_estado;
		}
	}
