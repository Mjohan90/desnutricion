<?php

	class um {

		var $um_id;
		var $nombre;
		var $abrev;
		var $estado;

		public function getUmID() {
			return $this->um_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getAbrev() {
			return $this->abrev;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setUmID($um_id) {
			$this->um_id = $um_id;
		}
		public function setNombre($um_nombre) {
			$this->nombre = $um_nombre;
		}
		public function setAbrev($um_abrev) {
			$this->abrev = $um_abrev;
		}
		public function setEstado($um_estado) {
			$this->estado = $um_estado;
		}
	}
