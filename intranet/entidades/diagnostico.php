<?php

	class diagnostico {

		var $diag_id;
		var $nombre;
		var $tratamiento_sug;
		var $dieta_sug;
		var $estado;

		public function getDiagID() {
			return $this->diag_id;
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

		public function setDiagID($diag_id) {
			$this->diag_id = $diag_id;
		}
		public function setNombre($diag_nombre) {
			$this->nombre = $diag_nombre;
		}
		public function setTratamientoSug($diag_tratamiento_sug) {
			$this->tratamiento_sug = $diag_tratamiento_sug;
		}
		public function setDietaSug($diag_dieta_sug) {
			$this->dieta_sug = $diag_dieta_sug;
		}
		public function setEstado($diag_estado) {
			$this->estado = $diag_estado;
		}
	}
