<?php

	class cargo {

		var $carg_id;
		var $nombre;
		var $estado;

		public function getCargID() {
			return $this->carg_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setCargID($carg_id) {
			$this->carg_id = $carg_id;
		}
		public function setNombre($carg_nombre) {
			$this->nombre = $carg_nombre;
		}
		public function setEstado($carg_estado) {
			$this->estado = $carg_estado;
		}
	}
