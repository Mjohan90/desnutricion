<?php

	class tipoparentesco {

		var $tparent_id;
		var $nombre;
		var $estado;

		public function getTparentID() {
			return $this->tparent_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setTparentID($tparent_id) {
			$this->tparent_id = $tparent_id;
		}
		public function setNombre($tparent_nombre) {
			$this->nombre = $tparent_nombre;
		}
		public function setEstado($tparent_estado) {
			$this->estado = $tparent_estado;
		}
	}
