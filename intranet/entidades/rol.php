<?php

	class rol {

		var $rol_id;
		var $nombre;
		var $fecha_reg;
		var $estado;

		public function getRolID() {
			return $this->rol_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setRolID($rol_id) {
			$this->rol_id = $rol_id;
		}
		public function setNombre($rol_nombre) {
			$this->nombre = $rol_nombre;
		}
		public function setFechaReg($rol_fecha_reg) {
			$this->fecha_reg = $rol_fecha_reg;
		}
		public function setEstado($rol_estado) {
			$this->estado = $rol_estado;
		}
	}
