<?php

	class tipodocident {

		var $tdi_id;
		var $nombre;
		var $abrev;
		var $estado;

		public function getTdiID() {
			return $this->tdi_id;
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

		public function setTdiID($tdi_id) {
			$this->tdi_id = $tdi_id;
		}
		public function setNombre($tdi_nombre) {
			$this->nombre = $tdi_nombre;
		}
		public function setAbrev($tdi_abrev) {
			$this->abrev = $tdi_abrev;
		}
		public function setEstado($tdi_estado) {
			$this->estado = $tdi_estado;
		}
	}
