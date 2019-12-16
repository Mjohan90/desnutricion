<?php

	class categvariable {

		var $catvar_id;
		var $nombre;
		var $estado;

		public function getCatvarID() {
			return $this->catvar_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setCatvarID($catvar_id) {
			$this->catvar_id = $catvar_id;
		}
		public function setNombre($catvar_nombre) {
			$this->nombre = $catvar_nombre;
		}
		public function setEstado($catvar_estado) {
			$this->estado = $catvar_estado;
		}
	}
