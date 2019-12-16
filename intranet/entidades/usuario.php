<?php

	class usuario {

		var $usu_id;
		var $nombre;
		var $contrasena;
		var $empl_id;
		var $rol_id;
		var $fecha_reg;
		var $estado;

		public function getUsuID() {
			return $this->usu_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getContrasena() {
			return $this->contrasena;
		}
		public function getEmplID() {
			return $this->empl_id;
		}
		public function getRolID() {
			return $this->rol_id;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setUsuID($usu_id) {
			$this->usu_id = $usu_id;
		}
		public function setNombre($usu_nombre) {
			$this->nombre = $usu_nombre;
		}
		public function setContrasena($usu_contrasena) {
			$this->contrasena = $usu_contrasena;
		}
		public function setEmplID($usu_empl_id) {
			$this->empl_id = $usu_empl_id;
		}
		public function setRolID($usu_rol_id) {
			$this->rol_id = $usu_rol_id;
		}
		public function setFechaReg($usu_fecha_reg) {
			$this->fecha_reg = $usu_fecha_reg;
		}
		public function setEstado($usu_estado) {
			$this->estado = $usu_estado;
		}
	}
