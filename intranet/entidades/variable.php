<?php

	class variable {

		var $var_id;
		var $catvar_id;
		var $nombre;
		var $um_id;
		var $tipo_var;
		var $tipo_escala;
		var $formula;
		var $estado;

		public function getVarID() {
			return $this->var_id;
		}
		public function getCatvarID() {
			return $this->catvar_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getUmID() {
			return $this->um_id;
		}
		public function getTipoVar() {
			return $this->tipo_var;
		}
		public function getTipoEscala() {
			return $this->tipo_escala;
		}
		public function getFormula() {
			return $this->formula;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setVarID($var_id) {
			$this->var_id = $var_id;
		}
		public function setCatvarID($var_catvar_id) {
			$this->catvar_id = $var_catvar_id;
		}
		public function setNombre($var_nombre) {
			$this->nombre = $var_nombre;
		}
		public function setUmID($var_um_id) {
			$this->um_id = $var_um_id;
		}
		public function setTipoVar($var_tipo_var) {
			$this->tipo_var = $var_tipo_var;
		}
		public function setTipoEscala($var_tipo_escala) {
			$this->tipo_escala = $var_tipo_escala;
		}
		public function setFormula($var_formula) {
			$this->formula = $var_formula;
		}
		public function setEstado($var_estado) {
			$this->estado = $var_estado;
		}
	}
