<?php

	class claseenfermedad {

		var $id;
		var $nombre;
		var $fecha_reg;
		var $estado;

		public function getId() {
			return $this->id;
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

		public function setId($clsenferm_id) {
			$this->id = $clsenferm_id;
		}
		public function setNombre($clsenferm_nombre) {
			$this->nombre = $clsenferm_nombre;
		}
		public function setFechaReg($clsenferm_fecha_reg) {
			$this->fecha_reg = $clsenferm_fecha_reg;
		}
		public function setEstado($clsenferm_estado) {
			$this->estado = $clsenferm_estado;
		}
	}
