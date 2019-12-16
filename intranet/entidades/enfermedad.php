<?php

	class enfermedad {

		var $enferm_id;
		var $nombre;
		var $tratamiento_sug;
		var $dieta_sug;
		var $estado;

		public function getEnfermID() {
			return $this->enferm_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getTratamientoSug() {
			return $this->tratamiento_sug;
		}
		public function getDietaSug() {
			return $this->dieta_sug;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setEnfermID($enferm_id) {
			$this->enferm_id = $enferm_id;
		}
		public function setNombre($enferm_nombre) {
			$this->nombre = $enferm_nombre;
		}
		public function setTratamientoSug($enferm_tratamiento_sug) {
			$this->tratamiento_sug = $enferm_tratamiento_sug;
		}
		public function setDietaSug($enferm_dieta_sug) {
			$this->dieta_sug = $enferm_dieta_sug;
		}
		public function setEstado($enferm_estado) {
			$this->estado = $enferm_estado;
		}
	}
