<?php

	class indicador {

		var $indic_id;
		var $nombre;
		var $var1_id;
		var $var2_id;
		var $estado;

		public function getIndicID() {
			return $this->indic_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getVar1ID() {
			return $this->var1_id;
		}
		public function getVar2ID() {
			return $this->var2_id;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setIndicID($indic_id) {
			$this->indic_id = $indic_id;
		}
		public function setNombre($indic_nombre) {
			$this->nombre = $indic_nombre;
		}
		public function setVar1ID($indic_var1_id) {
			$this->var1_id = $indic_var1_id;
		}
		public function setVar2ID($indic_var2_id) {
			$this->var2_id = $indic_var2_id;
		}
		public function setEstado($indic_estado) {
			$this->estado = $indic_estado;
		}
	}
