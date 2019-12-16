<?php

	class especialidad {

		var $espec_id;
		var $nombre;
		var $estado;

		public function getEspecID() {
			return $this->espec_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setEspecID($espec_id) {
			$this->espec_id = $espec_id;
		}
		public function setNombre($espec_nombre) {
			$this->nombre = $espec_nombre;
		}
		public function setEstado($espec_estado) {
			$this->estado = $espec_estado;
		}
	}
